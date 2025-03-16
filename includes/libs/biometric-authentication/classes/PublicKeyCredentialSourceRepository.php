<?php

namespace PasswordlessWP;

if (!defined('ABSPATH')) {
  die();
}

use Webauthn\PublicKeyCredentialUserEntity;
use Webauthn\PublicKeyCredentialSourceRepository as PublicKeyCredentialSourceRepositoryInterface;
use Webauthn\PublicKeyCredentialSource;

/**
 * Repository for managing WebAuthn credentials
 *
 * This class handles storage, retrieval and management of WebAuthn credentials.
 * Direct database queries are necessary for this implementation as we're working
 * with custom tables specifically designed for WebAuthn credential storage.
 */
class PublicKeyCredentialSourceRepository implements PublicKeyCredentialSourceRepositoryInterface
{
  private int $user_id;

  /**
   * Read credential by ID
   *
   * @param string $cred_id The credential ID
   * @return object|null The credential object or null if not found
   */
  public static function ReadCred($cred_id)
  {
    global $wpdb;
    $tables = plwp_table_names();

    // Check if credential is in cache first
    $cache_key = 'plwp_cred_' . md5($cred_id);
    $item = wp_cache_get($cache_key);

    if (false === $item) {
      // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
      $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$tables->creds} WHERE cred_id = %s", $cred_id));

      if ($item) {
        $item->data = unserialize(base64_decode($item->data));
        wp_cache_set($cache_key, $item, 'plwp_creds', 3600); // Cache for 1 hour
      }
    }

    return $item;
  }

  /**
   * Remove all credentials for a user
   *
   * @param int $user_id User ID
   */
  public static function RemoveUserAll($user_id)
  {
    global $wpdb;

    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
    $wpdb->delete(plwp_table_names()->creds, ['user_id' => $user_id], ['%d']);

    // Clear any cached credentials for this user
    wp_cache_delete('plwp_user_creds_' . $user_id, 'plwp_creds');
  }

  /**
   * Read all credentials for a user
   *
   * @param int $user_id User ID
   * @return array An array of credentials
   */
  public static function ReadUserAll($user_id)
  {
    global $wpdb;
    $tables = plwp_table_names();

    // Check cache first
    $cache_key = 'plwp_user_creds_' . $user_id;
    $meta = wp_cache_get($cache_key, 'plwp_creds');

    if (false === $meta) {
      // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
      $items = $wpdb->get_results($wpdb->prepare("SELECT cred_id, data FROM {$tables->creds} WHERE user_id = %d", $user_id));

      $meta = [];

      if (count($items)) {
        foreach ($items as $data) {
          $meta[$data->cred_id] = unserialize(base64_decode($data->data));
        }
      }

      wp_cache_set($cache_key, $meta, 'plwp_creds', 3600); // Cache for 1 hour
    }

    return $meta;
  }

  /**
   * Remove a credential by ID
   *
   * @param string $cred_id Credential ID
   */
  public static function removeCred($cred_id)
  {
    global $wpdb;

    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
    $wpdb->delete(plwp_table_names()->creds, ['cred_id' => $cred_id], ['%s']);

    // Delete the credential from cache
    wp_cache_delete('plwp_cred_' . md5($cred_id), 'plwp_creds');
  }

  /**
   * Constructor
   *
   * @param int $user_id User ID
   */
  function __construct($user_id)
  {
    $this->user_id = $user_id;
  }

  /**
   * Find a credential by its ID
   *
   * @param string $publicKeyCredentialId Credential ID
   * @return PublicKeyCredentialSource|null
   */
  public function findOneByCredentialId(string $publicKeyCredentialId): ?PublicKeyCredentialSource
  {
    $cred = PublicKeyCredentialSourceRepository::ReadCred(base64_encode($publicKeyCredentialId));

    return $cred ? $cred->data : null;
  }

  /**
   * Find all credentials for a user entity
   *
   * @param PublicKeyCredentialUserEntity $publicKeyCredentialUserEntity User entity
   * @return array
   */
  public function findAllForUserEntity(PublicKeyCredentialUserEntity $publicKeyCredentialUserEntity): array
  {
    $user_id = $publicKeyCredentialUserEntity->getId();
    return PublicKeyCredentialSourceRepository::ReadUserAll($user_id);
  }

  /**
   * Save a credential source
   *
   * @param PublicKeyCredentialSource $publicKeyCredentialSource Credential source
   */
  public function saveCredentialSource(PublicKeyCredentialSource $publicKeyCredentialSource): void
  {
    global $wpdb;

    $bKey = $publicKeyCredentialSource->getPublicKeyCredentialId();

    $cred = $this->findOneByCredentialId($bKey);

    $cred_id = base64_encode($bKey);

    if ($cred && property_exists($cred, 'user_id') && $cred->user_id == $this->user_id) {
      // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
      $wpdb->update(
        plwp_table_names()->creds,
        [
          'data' => base64_encode(serialize($publicKeyCredentialSource)),
        ],
        [
          'cred_id' => $cred_id,
          'user_id' => $this->user_id,
        ],
        ['%s'],
        ['%s', '%d']
      );

      // Update cache
      $cache_key = 'plwp_cred_' . md5($cred_id);
      wp_cache_delete($cache_key, 'plwp_creds');
    } else {
      // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
      $wpdb->insert(
        plwp_table_names()->creds,
        [
          'cred_id' => $cred_id,
          'user_id' => $this->user_id,
          'create_date' => current_time('mysql'),
          'data' => base64_encode(serialize($publicKeyCredentialSource)),
        ],
        ['%s', '%d', '%s', '%s']
      );

      // Clear user credentials cache
      wp_cache_delete('plwp_user_creds_' . $this->user_id, 'plwp_creds');
    }
  }

  /**
   * Check if the user has any credentials
   *
   * @return bool
   */
  public function hasCredentials()
  {
    return count($this->read());
  }

  /**
   * Read all credentials for the current user
   *
   * @return array
   */
  private function read()
  {
    return PublicKeyCredentialSourceRepository::ReadUserAll($this->user_id);
  }
}
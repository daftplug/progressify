<?php

namespace PasswordlessWP;

if (!defined('ABSPATH')) {
  die();
}

use Webauthn\PublicKeyCredentialUserEntity;
use Webauthn\PublicKeyCredentialSourceRepository as PublicKeyCredentialSourceRepositoryInterface;
use Webauthn\PublicKeyCredentialSource;

class PublicKeyCredentialSourceRepository implements PublicKeyCredentialSourceRepositoryInterface
{
  private int $user_id;

  public static function ReadCred($cred_id)
  {
    global $wpdb;
    $tables = plwp_table_names();

    $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$tables->creds} WHERE cred_id = %s", $cred_id));

    if ($item) {
      $item->data = unserialize(base64_decode($item->data));
    }

    return $item;
  }

  public static function RemoveUserAll($user_id)
  {
    global $wpdb;
    $wpdb->delete(plwp_table_names()->creds, ['user_id' => $user_id], ['%d']);
  }

  public static function ReadUserAll($user_id)
  {
    global $wpdb;
    $tables = plwp_table_names();

    $items = $wpdb->get_results($wpdb->prepare("SELECT cred_id, data FROM {$tables->creds} WHERE user_id = %d", $user_id));

    $meta = [];

    if (count($items)) {
      foreach ($items as $data) {
        $meta[$data->cred_id] = unserialize(base64_decode($data->data));
      }
    }
    return $meta;
  }

  public static function removeCred($cred_id)
  {
    global $wpdb;
    $wpdb->delete(plwp_table_names()->creds, ['cred_id' => $cred_id], ['%d']);
  }

  function __construct($user_id)
  {
    $this->user_id = $user_id;
  }

  public function findOneByCredentialId(string $publicKeyCredentialId): ?PublicKeyCredentialSource
  {
    $cred = PublicKeyCredentialSourceRepository::ReadCred(base64_encode($publicKeyCredentialId));

    return $cred ? $cred->data : null;
  }

  public function findAllForUserEntity(PublicKeyCredentialUserEntity $publicKeyCredentialUserEntity): array
  {
    $user_id = $publicKeyCredentialUserEntity->getId();
    return PublicKeyCredentialSourceRepository::ReadUserAll($user_id);
  }

  public function saveCredentialSource(PublicKeyCredentialSource $publicKeyCredentialSource): void
  {
    global $wpdb;

    $bKey = $publicKeyCredentialSource->getPublicKeyCredentialId();

    $cred = $this->findOneByCredentialId($bKey);

    $cred_id = base64_encode($bKey);

    if ($cred && $cred->user_id == $this->user_id) {
      $wpdb->update(
        plwp_table_names()->creds,
        [
          'data' => base64_encode(serialize($publicKeyCredentialSource)),
        ],
        [
          'cred_id' => $cred_id,
          'user_id' => $this->user_id,
        ],
        ['%s', '%d', '%s', '%s']
      );
    } else {
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
    }
  }

  public function hasCredentials()
  {
    return count($this->read());
  }

  private function read()
  {
    return PublicKeyCredentialSourceRepository::ReadUserAll($this->user_id);
  }
}

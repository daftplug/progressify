import { config } from '../frontend.js';
import { urlBase64ToUint8Array } from './utils.js';

class PushNotificationsSubscriptionManager {
  constructor() {
    this.subscribers = new Set();
    this.currentState = this.determineInitialState();
    this.initialize();
  }

  determineInitialState() {
    if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
      return 'blocked';
    }
    return 'unsubscribed';
  }

  async initialize() {
    try {
      const permission = Notification.permission;
      if (permission === 'denied') {
        this.updateState('blocked');
        return;
      }

      const state = await this.getSubscriptionState();
      this.updateState(state);
    } catch (error) {
      console.error('Error initializing push notifications:', error);
      this.updateState('blocked');
    }
  }

  subscribe(callback) {
    this.subscribers.add(callback);
    callback(this.currentState);
    return () => this.subscribers.delete(callback);
  }

  updateState(newState) {
    if (!['loading', 'subscribed', 'unsubscribed', 'blocked'].includes(newState)) {
      console.error('Invalid state:', newState);
      return;
    }

    if (this.currentState === newState) return;

    this.currentState = newState;
    this.notifySubscribers();
  }

  notifySubscribers() {
    this.subscribers.forEach((callback) => callback(this.currentState));
  }

  async getSubscriptionState() {
    if (Notification.permission === 'denied') {
      return 'blocked';
    }

    try {
      const registration = await navigator.serviceWorker.ready;
      const subscription = await registration.pushManager.getSubscription();
      return subscription ? 'subscribed' : 'unsubscribed';
    } catch (error) {
      console.error('Error getting subscription state:', error);
      return 'blocked';
    }
  }

  async addSubscription() {
    if (this.currentState === 'loading') return;

    this.updateState('loading');

    try {
      if (Notification.permission === 'default') {
        const permission = await Notification.requestPermission();
        if (permission === 'denied') {
          this.updateState('blocked');
          return;
        }
        if (permission !== 'granted') {
          this.updateState('unsubscribed');
          return;
        }
      }

      const registration = await navigator.serviceWorker.ready;
      const subscription = await registration.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey: urlBase64ToUint8Array(config.jsVars.vapidPublicKey),
      });

      const response = await fetch(`${config.jsVars.restUrl}${config.jsVars.slug}/addSubscription`, {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          endpoint: subscription.endpoint,
          authKey: subscription.getKey('auth') ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))) : null,
          p256dhKey: subscription.getKey('p256dh') ? btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh')))) : null,
          contentEncoding: (PushManager.supportedContentEncodings || ['aesgcm'])[0],
        }),
      });

      if (!response.ok) {
        throw new Error((await response.text()) || 'Subscription failed');
      }

      this.updateState('subscribed');
      return subscription;
    } catch (error) {
      console.error('Subscription error:', error);
      this.updateState(Notification.permission === 'denied' ? 'blocked' : 'unsubscribed');
      throw error;
    }
  }

  async removeSubscription() {
    if (this.currentState === 'loading') return;

    this.updateState('loading');

    try {
      const registration = await navigator.serviceWorker.ready;
      const subscription = await registration.pushManager.getSubscription();

      if (!subscription) {
        this.updateState('unsubscribed');
        return;
      }

      const response = await fetch(`${config.jsVars.restUrl}${config.jsVars.slug}/removeSubscription`, {
        method: 'DELETE',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ endpoint: subscription.endpoint }),
      });

      const responseData = await response.json();
      if (!response.ok || responseData.status !== 'success') {
        throw new Error(responseData.message || 'Failed to remove subscription');
      }

      await subscription.unsubscribe();
      this.updateState('unsubscribed');
    } catch (error) {
      console.error('Unsubscribe error:', error);
      this.updateState('subscribed');
      throw error;
    }
  }
}

const pushNotificationsSubscription = new PushNotificationsSubscriptionManager();
export default pushNotificationsSubscription;

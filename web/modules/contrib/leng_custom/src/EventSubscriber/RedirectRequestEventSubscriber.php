<?php

namespace Drupal\leng_custom\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;


class RedirectRequestEventSubscriber implements EventSubscriberInterface {

  public function checkUserUidRedirection(GetResponseEvent $event) {
    if (\Drupal::currentUser()->isAnonymous()) {
      return;
    }
    $request_uri = urldecode(\Drupal::request()->getRequestUri());  
    $current_user = \Drupal::currentUser()->id();

    // if (preg_match('/\{user\}/', $request_uri)) {
    //   $request_uri = preg_replace('/\{user\}/', $current_user, $request_uri);
    //   $response = new RedirectResponse($request_uri, 301);
    //   $response->send();
    // }
    if ($request_uri == "/user/".$current_user) {
      $request_uri = sprintf("/user/%s/orders", $current_user);
      $response = new RedirectResponse($request_uri, 301);
      $response->send();
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('checkUserUidRedirection');
    return $events;
  }
}
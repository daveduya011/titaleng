<?php

namespace Drupal\leng_custom\EventSubscriber;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\state_machine\Event\WorkflowTransitionEvent;
use Drupal\leng_custom\Event\OrderCompletedEvent;

/**
 * Event subscriber to handle actions on workflow-enabled entities.
 */
class WorkflowTransitionEventSubscriber implements EventSubscriberInterface {

  protected $event_dispatcher;

  public function __construct(EventDispatcherInterface $event_dispatcher) {
      $this->event_dispatcher = $event_dispatcher;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events = [
        'commerce_order.fulfill.post_transition' => 'onCompleteTransition',
    ];
    return $events;
  }


  /**
   * handle action based on the workflow.
   *
   * @param \Drupal\state_machine\Event\WorkflowTransitionEvent $event
   *   The state change event.
   */
  public function onCompleteTransition(WorkflowTransitionEvent $event) {
    $entity = $event->getEntity();
    $orders = $entity->getItems();
    $user = $entity->getCustomer();
    foreach($orders as $order) {
        $product = $order->getPurchasedEntity()->getProduct();
    }
    if ($user->isAnonymous()) {
        return;
    }
    $event = new OrderCompletedEvent($product, $user);
    $this->event_dispatcher->dispatch($event::EVENT_NAME, $event);

    $flag_service = \Drupal::service('flag');
    $flag = $flag_service->getFlagById('bought');
    // check if already flagged
    $flagging = $flag_service->getFlagging($flag, $product, $user);
    if (!$flagging) {
        $flag_service->flag($flag, $product, $user);
    }
  }

}
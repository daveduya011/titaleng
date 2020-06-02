<?php

namespace Drupal\leng_custom\Event;

use Drupal\user\UserInterface;
use Drupal\commerce_product\Entity\ProductInterface;
use Symfony\Component\EventDispatcher\Event;

class OrderCompletedEvent extends Event {

  const EVENT_NAME = 'rules_order_bought';

  public $user;
  public $product;

  public function __construct(ProductInterface $product, UserInterface $user) {
    $this->user = $user;
    $this->product = $product;
  }

}
<?php

namespace Drupal\leng_custom\Plugin\RulesAction;

use Drupal\rules\Core\RulesActionBase;
use Drupal\user\UserInterface;
use Drupal\commerce_product\Entity\ProductInterface;


/**
 * Provides a 'Set Flag To Product' action.
 *
 * @RulesAction(
 *   id = "rules_leng_custom_set_flag_product",
 *   label = @Translation("Set Flag to Product"),
 *   category = @Translation("Flagging"),
 *   context = {
 *     "flag_id" = @ContextDefinition("string",
 *       label = @Translation("Flag Id"),
 *       description = @Translation("The id of the flag")
 *     ),
 *     "user" = @ContextDefinition("entity:user",
 *       label = @Translation("User"),
 *       description = @Translation("The user that owns the flag")
 *     ),
 *     "flag_value" = @ContextDefinition("string",
 *       label = @Translation("Flag Value"),
 *       description = @Translation("true to flag, false to unflag")
 *     ),
 *   }
 * )
 *
 * @todo Add access callback information from Drupal 7.
 */
class SetFlagProduct extends RulesActionBase {

    protected function doExecute($flag_id, UserInterface $user, $flag_value) {
        $flag_service = \Drupal::service('flag');
        $flag = $flag_service->getFlagById($flag_id);
        // check if route is correct
        $current_route = \Drupal::routeMatch();
        foreach ($current_route->getParameters() as $param) {
            if ($param instanceof ProductInterface) {
                $product = $param;
                break;
            }
        }
        if (!isset($product)){
            return;
        }
        // check if already flagged
        $flagging = $flag_service->getFlagging($flag, $product, $user);

        if ($user->isAnonymous()) {
            return;
        }
        if ($flag_value == "true") {
            if (!$flagging) {
                $flag_service->flag($flag, $product, $user);
            }
        } else {
            if ($flagging) {
                $flag_service->unflag($flag, $product, $user);
            }
        }
    }
  
}
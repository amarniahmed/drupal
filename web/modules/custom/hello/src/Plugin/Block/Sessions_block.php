<?php
namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 *provide a HelloBlock block
 *
 * @Block(
 *  id = "session_block",
 *  admin_label = @Translation("Session")
 * )
 */

class Sessions_block extends BlockBase{
    /**
     * Implements Drupal\Core\Block\BlockBase::build().
     */
    public function build(){
        $database=\Drupal::database();
        $session_num = $database->select('sessions')
                                ->countQuery()
                                ->execute()
                                ->fetchField();



        $build = [
          '#markup' => $this->t('il ya acctuellement  %N sessions acitves',
              ['%N' => $session_num]),
        ];

        return $build;
    }

    protected function blockAccess(AccountInterface  $account){
        return  AccessResult::allowedIfHasPermission($account, 'access hello');
    }

}

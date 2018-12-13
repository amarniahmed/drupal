<?php
namespace Drupal\hello\Plugin\Block;
use Drupal\Core\Block\BlockBase;
/**
 *provide a HelloBlock block
 *
 * @Block(
 *  id = "hello_block",
 *  admin_label = @Translation("Hello")
 * )
 */

class Hello_block extends BlockBase{
    /**
     * Implements Drupal\Core\Block\BlockBase::build().
     */
    public function build(){
        $build = [
          '#markup' => $this->t('Bienvenue %name sur notre site. Il est %heure',
              ['%name' => \Drupal::currentUser() ? \Drupal::currentUser()->getAccountName() : $this->t('gest'),
              '%heure' => \Drupal::service('date.formatter')->format(\Drupal::service('datetime.time')->getCurrentTime(), 'custom', 'H:i s\s')]),
           '#cache' => [
            'keys' => ['hello:block'],
           'contexts' => ['user','timezone'],
           // 'max-age' => cache::PERMANENT,
          ],
        ];

        return $build;
    }

}

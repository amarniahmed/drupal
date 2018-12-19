<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Class ConsoleTestsController.
 */
class HelloStatistics extends ConfigFormBase
{

    public function getFormId()
    {
        return 'hello_admin_form'; // TODO: Implement getFormId() method.
    }


     protected function getEditableConfigNames(){
        return ['hello.settings'];
     }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        //$queued_number = $this->queue->numberOfItems();

        //$form['queued_items']=array(
        //   '#items'=> 'markup',
        // '#markup'=> $this-> t('%number of items waiting to be processed',array('%number'=> $queued_number)),
        // );

       $purge_days_number = $this->config('hello.settings')->get('purge_days_number');
     
        $form['value'] = array(
            '#type' => 'select',
            '#options' => array(
                '0' => 'never purge',
                '1' => '1 jour',
                '2' => '2 jours',
                '7' => 'une semaine',
                '14' => '2 semaines',
                '30' => 'un mois',
                           ),
             '#default_value' => $purge_days_number,
                         );

       // $form['create_items'] = array(
         //   '#type' => 'submit',
          //  '#value' => $this->t('enrigistrer configuration'),
       // );
        //$form=\Drupal::formBuilder()->getForm('\Drupal\hello\From\HelloForm');
        return parent::buildForm($form,$form_state);   // TODO: Implement buildForm() method.
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
       parent::submitForm($form,$form_state);
      $this->config('hello.settings')->set('purge_days_number', $form_state->getValue('value'))->save();

    }


}

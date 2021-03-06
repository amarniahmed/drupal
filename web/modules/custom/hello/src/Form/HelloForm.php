<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Class ConsoleTestsController.
 */
class HelloForm extends FormBase
{

    public function getFormId()
    {
        return 'hello form'; // TODO: Implement getFormId() method.
    }


    public function buildForm(array $form, FormStateInterface $form_state)
    {
        //$queued_number = $this->queue->numberOfItems();

        //$form['queued_items']=array(
        //   '#items'=> 'markup',
        // '#markup'=> $this-> t('%number of items waiting to be processed',array('%number'=> $queued_number)),
        // );

        $form['value1'] = array(
            '#type' => 'textfield',
            '#title' => 'first_value',
            '#ajax'=> array(
                   'callback'=> array($this,'validateTextAjax'),
                    'event'=>'change',
                              ),
            '#suffix'=> '<span class="text-message"></span>',
        );

        $form['value2'] = array(
            '#type' => 'radios',
            '#options' => array(
                'ajouter' => '+',
                'soustract' => '-',
                'multiply' => '*',
                'devide' => '/',
            ),
        );
        $form['value3'] = array(
            '#type' => 'textfield',
            '#title' => 'second_value',);

        $form['create_items'] = array(
            '#type' => 'submit',
            '#value' => $this->t('calculer'),
        );
        //$form=\Drupal::formBuilder()->getForm('\Drupal\hello\From\HelloForm');
        return $form;   // TODO: Implement buildForm() method.
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $value_1 = $form_state->getValue('value1');

        $value_3 = $form_state->getValue('value3');


        $value_2 = $form_state->getValue('value2');
        $resultat = 0;

        if ($value_2 == 'ajouter')
            $resultat = $value_1 + $value_3;

        if ($value_2 == 'soustract')
            $resultat = $value_1 - $value_3;

        if ($value_2 == 'multiply')
            $resultat = $value_1 * $value_3;

        if (($value_2 == 'devide') && ($value_3 != 0)) {
            $resultat = $value_1 / $value_3;
        }

        \Drupal::Messenger()->addMessage($resultat);

        \Drupal::state()->set('instant_calculate',REQUEST_TIME);
            }

    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        parent::validateForm($form, $form_state); // TODO: Change the autogenerated stub

        $value_1 = $form_state->getValue('value1');
        $value_2 = $form_state->getValue('value2');

        $value_3 = $form_state->getValue('value3');


        if (!is_numeric($value_1)) {
            $form_state->setErrorByName('value1', $this->t('la premiere value valueur  doit etre numeric'));
            $form_state->setRedirect('hello.hello');
        }
        if (!is_numeric($value_3)) {
            $form_state->setErrorByName('value3', $this->t('la deuxieme valueur  doit etre  numeric'));
            $form_state->setRedirect('hello.hello');
        }
        if ($value_3 == 0 && $value_2=='devide') {
            $form_state->setErrorByName('value2', $this->t('valueur 2 ne doit pas  etre  nulle'));
            $form_state->setRedirect('hello.hello');
        }

    }

    public function validateTextAjax( array &$form, FormStateInterface $form_state){

        $value_1 = $form_state->getValue('value1');
       // $value_2 = $form_state->getValue('value2');

        //$value_3 = $form_state->getValue('value3');

      if (is_numeric($value_1)){
        $css = ['border' => '2px solid green'];
        $message = 'OK'.$form_state->getValue('value1');
        }
    else{
            $css = ['border' => '2px solid red'];
            $message = 'Error   ' . $form_state->getValue('value1');
        }


      $response= new AjaxResponse();
      $response->addCommand(new CssCommand('#edit-value1',$css));
      $response->addCommand(new HtmlCommand('.text-message',$message));
      return $response;

    }



}
<?php
namespace Drupal\hello\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class HelloController extends ControllerBase{

    public function content($param){
        $message=$this->t('you are on the hello page.your name is %username et le parametre pâssé dans lurl %param',[
            '%username'=>$this->currentUser()->getAccountName(),
            '%param'=> $param]);

        //$message= t('voici le parametres passé dans l URL',[$param]);

        return ['#markup'=>$message];
        //return ['#markup'=>$param];
    }
    public function json(){

        $response = new JsonResponse();
        $response-> setData(['1'=>'azert', '2'=>'qert']);
        return $response;
    }
}

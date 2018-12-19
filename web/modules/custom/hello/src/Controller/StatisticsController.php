<?php
namespace Drupal\hello\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;
use Drupal\Core\Datetime\DateFormatter;
use  Drupal\Component\Datetime\Time;

class StatisticsController extends ControllerBase{

    public function content(UserInterface $user){
        $iduser =$user->id();
        $message=$this->t('recuperation des données de  %user passé en paramettre dans lurl',[
            '%user'=> $user->getAccountName()]);
        $stat_user_connexion= \Drupal::database()->select('hello_user_statistics','stat')->fields('stat',[])
                                                                                         ->condition('uid',$iduser)
                                                                                         ->execute();
        $number_connexion=0;
        $rows=[];
foreach ($stat_user_connexion as $stats)
 {if ($stats->action){
     $number_connexion ++;
    $etat='actif';}
  else{
    $etat='desactivé';
      }
     $time= \Drupal::service('date.formatter')->format($stats->time, 'custom', 'H:i s\s');
      $rows[]=[ $etat, $time];
 }

        $tab =[
            '#theme'=> 'table',
            '#header'=> ['Action', 'Time'],
            '#rows'=> $rows,
            ];
        $message =[
            '#theme'=> 'hello',
            '#user'=> $user,
            '#header'=> ['Action', 'Time'],
            '#count'=> $number_connexion,
        ];

        return ['message'=> $message,
            'tab'=> $tab,
        ];



    }
}
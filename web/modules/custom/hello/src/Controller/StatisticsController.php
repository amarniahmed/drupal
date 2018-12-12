<?php
namespace Drupal\hello\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;
class StatisticsController extends ControllerBase{

    public function content(UserInterface $user){
        $iduser =$user->id();
        $message=$this->t('recuperation des données de  %user passé en paramettre dans lurl',[
            '%user'=> $user->getAccountName()]);
        $stat_user_connexion= \Drupal::database()->select('hello_user_statistics','stat')->fields('stat',[])
                                                                                        ->condition('uid',$iduser)
                                                                                         ->execute();
$rows=[];
foreach ($stat_user_connexion as $stats)
 {if ($stats->action){
    $actif='actif';}
  else{
    $actif='desactivé';
      }
      $rows[]=[$stats->time/*->\Drupal::service()->format(('datetime.time'), 'custom', 'H:i s\s'))*/, $actif];
 }

        $tab =[
            '#theme'=> 'table',
            '#header'=> ['Action', 'Time'],
            '#rows'=> $rows,
            ];

        return $tab;



    }
}
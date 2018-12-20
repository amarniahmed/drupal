<?php
namespace Drupal\hello\Routing;
use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\component\Routing\RouteCollection;

class RouteModifing extends RouteSubscriberBase{


 public function alterRoutes(RouteCollection $collection){

 $collection->get('entity.user.canonical')->setRequirements(['_acces_hello'=>'10']);

 }
}

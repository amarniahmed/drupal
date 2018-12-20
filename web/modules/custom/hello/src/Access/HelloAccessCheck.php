<?php
namespace Drupal\hello\Access;



use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class HelloAccessCheck implements AccessCheckInterface {
     public function applies(Route $route)
     {
      return NULL;
     }
    public function access(Route $route,Request $request,AccountInterface $account)
    {
        $param = $route->getRequirement('_access_hello');
        $anciennete = REQUEST_TIME - ($account->getAccount()->created);
        $N = $anciennete / (3600);
        $anonyme = $account->isAnonymous();
        if ((!$anonyme) && ($N >= $param)){
            return AccessResult::allowed()->cachePerUser();
    }
         return AccessResult::forbidden()->cachePerUser();

    }



}
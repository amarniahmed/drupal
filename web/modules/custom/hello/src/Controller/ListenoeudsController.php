<?php
namespace Drupal\hello\Controller;
//use \Drupal\hello\Controller\ListenoeudsController
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListenoeudsController extends ControllerBase{

    public function content($typenoeuds){

        $items=$this->entityTypeManager()->getStorage('node');

        $query = $this->entityTypeManager()->getStorage('node')->getQuery();


        if($typenoeuds){
        $query->condition('type',$typenoeuds);
                  }
      $ids=$query->pager('10')->execute();

    $nodes=$this->entityTypeManager()->getStorage('node')->loadMultiple($ids);

       // ksm($node);

       // $message=$this->t('you are on the hello2 page %typenoeuds  ',[
                    //    '%typenoeuds'=> $typenoeuds,
       // ]);
        $items=[];
        foreach ($nodes as $item) {
           //$url= new(Url('hello.listnoeuds'),[main]);
            $items[]=$item->toLink();
        }


        $list=
            [
             '#theme'=> 'item_list',
              '#items' => $items,
              '#title'=>$this->t('Node list'),
            ];
      $pager = ['#type' => 'pager'];
            return [
              // 'listnoeuds'=> $typenoeuds,
                'list'=> $list,
                'pager'=> $pager,
               '#cache' =>[
                    'keys'=> ['hellos:listnoeuds'],
                    'tags'=> ['listnoeuds'],
                    'contexts'=>['url'],
                     ],
                ];
    }


    public function json(){

        $response = new JsonResponse();
        $response-> setData(['1'=>'azert', '2'=>'qert']);
        return $response;
    }
}

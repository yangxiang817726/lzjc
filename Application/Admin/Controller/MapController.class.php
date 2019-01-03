<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Logic\UpgradeLogic;


/**
 * Class UeditorController
 * @package Admin\Controller
 */
class MapController extends Controller
{


    public function index()
    {
        $address=$_GET['address'];
        $longlat=$_GET['longlat'];

        $this->assign('address',$address);
        $this->assign('longlat',$longlat);
        $this->display();
    }
    

}
<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: 当燃      
 * Date: 2016-05-27
 */

namespace Admin\Controller;
use Admin\Logic\StoreLogic;

class FactoryController extends BaseController{
	


	public function grade_info(){
		$sg_id = I('sg_id');
		if($sg_id){
			$info = M('store_grade')->where("sg_id=$sg_id")->find();
			$this->assign('info',$info);
		}
		$this->display();
	}
	


	//普通店铺列表
	public function index(){
		$model =  M('factory');
		$status = I("status");
		if($status>0)$map['status'] = $status;
		$user_name = I('user_name');
		if($user_name) $map['user_name'] = array('like',"%$user_name%");
		$name = I('name');
		if($name) $map['name'] = array('like',"%$name%");
		$count = $model->where($map)->count();
		$Page = new \Think\Page($count,10);
		$list = $model->where($map)->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('user_name',$user_name);
		$this->assign('name',$name);
		$this->assign('status',$status);

		$show = $Page->show();
		$this->assign('page',$show);
		$this->display();
	}
	
	/*添加店铺*/
	public function store_add(){
		if(IS_POST){
			$store_name = I('store_name');
			$user_name = I('user_name');
			$user_name = I('user_name');
			if(M('store')->where("store_name='$store_name'")->count()>0){
				$this->error("店铺名称已存在");
			}
			if(M('seller')->where("user_name='$user_name'")->count()>0){
				$this->error("此名称已被占用");
			}
			/*$user_id = M('users')->where("email='$user_name' or mobile='$user_name'")->getField('user_id');
			if($user_id){
				if(M('store')->where(array('user_id'=>$user_id))->count()>0){
					$this->error("该会员已经申请开通过店铺");
				}
			}*/
			$store = array('store_name'=>$store_name,'user_name'=>$user_name,'status'=>1,
					'user_name'=>$user_name,'password'=>I('password'),
					'store_time'=>time(),'is_own_shop'=>I('is_own_shop')
			);
			$storeLogic = new StoreLogic();
			if($storeLogic->addStore($store)){
				if(I('is_own_shop') == 1){
					$this->success('店铺添加成功',U('Store/store_own_list'));
				}else{
					$this->success('店铺添加成功',U('Store/store_list'));
				}
				exit;
			}else{
				$this->error("店铺添加失败");
			}
		}
		$is_own_shop = I('is_own_shop',1);
		$this->assign('is_own_shop',$is_own_shop);
		$this->display();
	}

	
	//店铺申请列表
	public function apply_list(){
		$model =  M('seller_apply');
		
		$grade_id = I("grade_id");
		if($grade_id>0) $map['grade_id'] = $grade_id;
		$sc_id =I('sc_id');
		if($sc_id>0) $map['sc_id'] = $sc_id;
		$user_name = I('user_name');
		if($user_name) $map['user_name'] = array('like',"%$user_name%");
		$store_name = I('store_name');
		if($store_name) $map['store_name'] = array('like',"%$store_name%");
		$count = $model->where($map)->count();
		$Page = new \Think\Page($count,10);
		$list = $model->where($map)->order('add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		//print_r($list);
		foreach ($list as $key=>$value){
			//print_r(M('users')->where(array("user_id"=>$value['user_id']))->find());
			$list[$key]['nick_name'] = M('users')->where(array("user_id"=>$value['user_id']))->getField("nick_name");
		}
		$this->assign('list',$list);
		$show = $Page->show();
		$this->assign('page',$show);
		$this->assign('store_grade',M('store_grade')->getField('sg_id,sg_name'));
		$this->assign('store_class',M('store_class')->getField('sc_id,sc_name'));
		$this->display();
	}
	
	public function apply_del(){
		$id = I('del_id');
		M('seller_apply')->where(array('id'=>$id))->delete();
			$this->success('操作成功',U('Store/apply_list'));
		
	}
	
	public function change(){
		D('seller_apply')->where(array("id"=>$_GET['id']))->save($_GET);
	}
}
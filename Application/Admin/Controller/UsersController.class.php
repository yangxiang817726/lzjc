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
use Admin\Logic\UsersLogic;

class UsersController extends BaseController{

	public function qylist(){
		$model =  M('Users_qy');
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
	public function qylist_add(){
		if(IS_POST){
			$mobile = I('mobile');
			$name = I('name');
			if(M('users_qy')->where("mobile='$mobile'")->count()>0){
				$this->error("电话号码已存在");
			}
			if(M('users_qy')->where("name='$name'")->count()>0){
			}
			/*$user_id = M('users')->where("email='$user_name' or mobile='$user_name'")->getField('user_id');
			if($user_id){
				if(M('store')->where(array('user_id'=>$user_id))->count()>0){
					$this->error("该会员已经申请开通过店铺");
				}
			}*/
			$user = array('mobile'=>$mobile,'status'=>1,
					'user_name'=>$mobile,'password'=>I('password'),
					'reg_time'=>time(),'user_type'=>'区域管理员'
			);
			$admin = array('user_name'=>$mobile,'status'=>1,
					'password'=>I('password'),
					'add_time'=>time(),'role_id'=>6
			);
			$add = array('name'=>$name,'status'=>1,
					'mobile'=>$mobile,
					'time'=>time(),'role_id'=>6
			);
			$user['password'] = encrypt($user['password']);
			$user_id = M('users')->add($user);
			if($user_id){
					if(M('admin')->where("user_name='".$admin['user_name']."'or user_name='".$admin['user_name']."'")->count()>0){
			    		return array('status'=>-1,'msg'=>'添加管理员失败，账号已存在');
			    	}
			    	$admin['password'] = encrypt($admin['password']);
			    	$admin_id = M('admin')->add($admin);
					if($admin_id){
						$add['name'] =I('name');
						$add['mobile'] =I('mobile');
						$add['time'] =time();
						$add['shenfen'] =I('shenfen');
						$add['status'] =1;
						$add['user_id'] =$user_id;
						$add['admin_id'] =I('admin_id');
						M('users_qy')->add($add);
						$this->success('区域管理员添加成功',U('users/qylist'));
					}else{
						$this->success('区域管理员添加失败',U('users/qylist'));
					}
					exit;
				}else{
					$this->error("区域管理员添加失败");
				}
		}
		$this->display();
	}
	public function qylist_edit(){
		if(IS_POST){
			$data = I('post.');
			$s['status'] = $data['status'];
			if(M('users_qy')->where("id=".$data['id'])->save($s)){
				$this->success('操作成功',U('Users/qylist'));
				exit;
			}else{
				$this->error('操作失败');
			}
		}
		$id = I('id',0);
		$info = M('users_qy')->where("id=$id")->find();
		$this->assign('info',$info);
		$this->display();
	}

	public function jglist(){
		$model =  M('Users_jg');
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

		public function jglist_add(){
		if(IS_POST){
			$mobile = I('mobile');
			$name = I('name');
			if(M('users_jg')->where("mobile='$mobile'")->count()>0){
				$this->error("电话号码已存在");
			}
			if(M('users_jg')->where("name='$name'")->count()>0){
			}
			/*$user_id = M('users')->where("email='$user_name' or mobile='$user_name'")->getField('user_id');
			if($user_id){
				if(M('store')->where(array('user_id'=>$user_id))->count()>0){
					$this->error("该会员已经申请开通过店铺");
				}
			}*/
			$user = array('mobile'=>$mobile,'status'=>1,
					'user_name'=>$mobile,'password'=>I('password'),
					'reg_time'=>time(),'user_type'=>'加工户'
			);
			$user['password'] = encrypt($user['password']);
			$user_id = M('users')->add($user);
			if($user_id){
						$add['name'] =I('name');
						$add['mobile'] =I('mobile');
						$add['time'] =time();
						$add['shenfen'] =I('shenfen');
						$add['status'] =1;
						$add['user_id'] =$user_id;
						$add['address'] =I('address');
						$add['city_id'] =I('city_id');
						$add['province_id'] =I('province_id');
						$add['district'] =I('district');
						M('users_jg')->add($add);
						$this->success('加工户添加成功',U('users/jglist'));
				
					exit;
				}else{
					$this->error("加工户添加失败");
				}
		}
				$province = M('region')->where(array('parent_id'=>0,'level'=>1))->select();
		$this->assign('province',$province);
		$this->display();
	}
	public function jglist_edit(){
		if(IS_POST){
			$data = I('post.');
			$s['status'] = $data['status'];
			if(M('users_jg')->where("id=".$data['id'])->save($s)){
				$this->success('操作成功',U('Users/qylist'));
				exit;
			}else{
				$this->error('操作失败');
			}
		}
		$id = I('id',0);
		$info = M('users_jg')->where("id=$id")->find();
		$this->assign('info',$info);
		$this->display();
	}

	public function cjlist(){
		$model =  M('Users_cj');
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

		public function cjlist_add(){
		if(IS_POST){
			$mobile = I('mobile');
			$name = I('name');
			if(M('users_cj')->where("mobile='$mobile'")->count()>0){
				$this->error("电话号码已存在");
			}
			if(M('users_cj')->where("name='$name'")->count()>0){
			}
			/*$user_id = M('users')->where("email='$user_name' or mobile='$user_name'")->getField('user_id');
			if($user_id){
				if(M('store')->where(array('user_id'=>$user_id))->count()>0){
					$this->error("该会员已经申请开通过店铺");
				}
			}*/
			$user = array('mobile'=>$mobile,'status'=>1,
					'user_name'=>$mobile,'password'=>I('password'),
					'reg_time'=>time(),'user_type'=>'厂家'
			);
			$user['password'] = encrypt($user['password']);
			$user_id = M('users')->add($user);
			if($user_id){
						$add['name'] =I('name');
						$add['mobile'] =I('mobile');
						$add['time'] =time();
						$add['shenfen'] =I('shenfen');
						$add['status'] =1;
						$add['user_id'] =$user_id;
						$add['address'] =I('address');
						$add['city_id'] =I('city_id');
						$add['province_id'] =I('province_id');
						$add['district'] =I('district');
						M('users_cj')->add($add);
						$this->success('厂家人员添加成功',U('users/cjlist'));
				
					exit;
				}else{
					$this->error("添加失败");
				}
		}
				$province = M('region')->where(array('parent_id'=>0,'level'=>1))->select();
		$this->assign('province',$province);
		$this->display();
	} 
	public function cjlist_edit(){
		if(IS_POST){
			$data = I('post.');
			$s['status'] = $data['status'];
			if(M('Users_cj')->where("id=".$data['id'])->save($s)){
				$this->success('操作成功',U('Users/qylist'));
				exit;
			}else{
				$this->error('操作失败');
			}
		}
		$id = I('id',0);
		$info = M('Users_cj')->where("id=$id")->find();
		$this->assign('info',$info);
		$this->display();
	}
	public function sjlist(){
		$model =  M('Users_sj');
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

		public function sjlist_add(){
		if(IS_POST){
			$mobile = I('mobile');
			$name = I('name');
			if(M('users_sj')->where("mobile='$mobile'")->count()>0){
				$this->error("电话号码已存在");
			}
			if(M('users_sj')->where("name='$name'")->count()>0){
			}
			/*$user_id = M('users')->where("email='$user_name' or mobile='$user_name'")->getField('user_id');
			if($user_id){
				if(M('store')->where(array('user_id'=>$user_id))->count()>0){
					$this->error("该会员已经申请开通过店铺");
				}
			}*/

			$user = array('mobile'=>$mobile,'status'=>1,
					'user_name'=>$mobile,'password'=>I('password'),
					'reg_time'=>time(),'user_type'=>'司机'
			);
			$user['password'] = encrypt($user['password']);
			$user_id = M('users')->add($user);
			if($user_id){
						$add['name'] =I('name');
						$add['mobile'] =I('mobile');
						$add['time'] =time();
						$add['shenfen'] =I('shenfen');
						$add['status'] =1;
						$add['user_id'] =$user_id;
						$add['address'] =I('address');
						$add['city_id'] =I('city_id');
						$add['province_id'] =I('province_id');
						$add['district'] =I('district');
						M('users_sj')->add($add);
						$this->success('司机添加成功',U('users/sjlist'));
				
					exit;
				}else{
					$this->error("添加失败");
				}
		}
				$province = M('region')->where(array('parent_id'=>0,'level'=>1))->select();
		$this->assign('province',$province);
		$this->display();
	} 
	public function sjlist_edit(){
		if(IS_POST){
			$data = I('post.');
			$s['status'] = $data['status'];
			if(M('Users_sj')->where("id=".$data['id'])->save($s)){
				$this->success('操作成功',U('Users/qylist'));
				exit;
			}else{
				$this->error('操作失败');
			}
		}
		$id = I('id',0);
		$info = M('Users_sj')->where("id=$id")->find();
		$this->assign('info',$info);
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
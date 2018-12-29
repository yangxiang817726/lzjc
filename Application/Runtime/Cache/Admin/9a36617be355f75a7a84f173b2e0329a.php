<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>tpshop管理后台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
 	<link href="/Public/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 --
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/Public/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
    	folder instead of downloading all of them to reduce the load. -->
    <link href="/Public/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/Public/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />   
    <!-- jQuery 2.1.4 -->
    <script src="/Public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="/Public/js/global.js"></script>
    <script src="/Public/js/myFormValidate.js"></script>    
    <script src="/Public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/Public/js/layer/layer-min.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
    <script src="/Public/js/myAjax.js"></script>
    <script type="text/javascript">
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
    		    // 确定
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
   						if(data==1){
   							layer.msg('操作成功', {icon: 1});
   							$(obj).parent().parent().remove();
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
//   						layer.closeAll();
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }
    
    function selectAll(name,obj){
    	$('input[name*='+name+']').prop('checked', $(obj).checked);
    }   
    
    function get_help(obj){
        layer.open({
            type: 2,
            title: '帮助手册',
            shadeClose: true,
            shade: 0.3,
            area: ['70%', '80%'],
            content: $(obj).attr('data-url'), 
        });
    }
    </script>        
  </head>
  <body style="background-color:#ecf0f5;">
 

<div class="wrapper">
	<div class="breadcrumbs" id="breadcrumbs">
	<ol class="breadcrumb">
	<?php if(is_array($navigate_admin)): foreach($navigate_admin as $k=>$v): if($k == '后台首页'): ?><li><a href="<?php echo ($v); ?>"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo ($k); ?></a></li>
	    <?php else: ?>    
	        <li><a href="<?php echo ($v); ?>"><?php echo ($k); ?></a></li><?php endif; endforeach; endif; ?>          
	</ol>
</div>

	<section class="content">
       <div class="row">
       		<div class="col-xs-12">
	       		<div class="box">
	             <div class="box-header">
	           	   <nav class="navbar navbar-default">	     
				      <div class="collapse navbar-collapse">
	    				<div class="navbar-form form-inline">
				            <div class="form-group">
				            	<p class="text-success margin blod">店铺管理:</p>
				            </div>
				             <div class="form-group">
				             <?php if($is_own_shop == 0): ?><a class="btn btn-default" href="<?php echo U('Store/store_list');?>">店铺列表</a>&nbsp;&nbsp;&nbsp;&nbsp;                                            
                                 <a class="btn btn-default" href="<?php echo U('Store/apply_list');?>" >开店申请</a>&nbsp;&nbsp;&nbsp;                                          
                                 <a class="btn btn-default" href="<?php echo U('Store/reopen_list');?>" >签约申请</a>&nbsp;&nbsp;&nbsp;
                             <?php else: ?>
                                 <a class="btn btn-default" href="<?php echo U('Store/store_own_list');?>">管理</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                 <a class="btn btn-default" href="javascript:;" >新增</a>&nbsp;&nbsp;&nbsp;<?php endif; ?>
				            </div>
	                        <div class="pull-right">
				                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
				            </div>
				          </div>
				       </div>
	    		 	</nav>	
	               	<nav class="navbar navbar-default">
		            	<?php if($is_own_shop == 1): ?><div class="callout callout-inro">
			            	<p>平台可以在此处添加自营店铺，新增的自营店铺默认为开启状态</p>
							<p>新增自营店铺默认绑定所有经营类目并且佣金为0，可以手动设置绑定其经营类目</p>
							<p>新增自营店铺将自动创建店主会员账号（用于登录网站会员中心）以及商家账号（用于登录商家中心）</p>
						</div>
						<?php else: ?>
						<div class="callout callout-inro">
							<p>1. 平台可以在此处添加外驻店铺，新增的外驻店铺默认为开启状态</p>
					        <p>2. 新增外驻店铺默认绑定所有经营类目并且佣金为0，可以手动设置绑定其经营类目。</p>
					        <p>3. 新增外驻店铺将自动创建店主会员账号（用于登录网站会员中心）以及商家账号（用于登录商家中心）。</p>
		            	</div><?php endif; ?>
	    			</nav>
	             </div>
	             <div class="box-body">
	           	 <div class="row">
	            	<div class="col-sm-12">
	            	  <form method="post" id="store_info">
		              <table class="table table-bordered table-striped dataTable">
                        <tbody> 
                        <tr><td>店铺名称：</td>
                        	<td><input name="store_name" value="<?php echo ($store["store_name"]); ?>" onblur="store_check()"></td>
                        	<td></td>
                        </tr>
                        <tr hidden><td>店主账号：</td>
                        	<td><input type="text" name="user_name" value="<?php echo ($store["user_name"]); ?>" onblur="store_check()"></td>
                        	<td class="text-warning">用于登录会员中心,支持手机或邮箱</td>
                        </tr>
                        <tr>
                            <td>店主卖家账号：</td>
                            <td><input name="seller_name" value="<?php echo ($store["seller_name"]); ?>" onblur="store_check()"></td>
                       		<td class="text-warning">用于登录商家中心</td>
                        </tr> 
                         <tr>
                            <td>登陆密码：</td>
                            <td><input type="password" name="password" value="<?php echo ($store["password"]); ?>"></td>
                       		<td class="text-warning">密码为6-16位字母数字组合</td>
                        </tr> 
                        </tbody>
                        <tfoot>
                        <tr>
                        <td colspan="3" style="text-align:center;">
                        	<a href="javascript:void(0)" onclick="actsubmit()" class="btn btn-info margin">提交</a>
                        	<input type="hidden" name="is_own_shop" value="<?php echo ($is_own_shop); ?>">        
                        </td>
                        </tr>
                        </tfoot>
		               </table>
		               </form>
	               </div>
	            </div>
	          </div>
	        </div>
       	</div>
       </div>
   </section>
<script>
var flag = true;
function actsubmit(){
	if($('input[name=store_name]').val() == ''){
		layer.msg("店铺名称不能为空", {icon: 2,time: 2000});
		return;
	}
	/*var user_name = $('input[name=user_name]').val();
	if(user_name == ''){
		layer.msg("店主账号不能为空", {icon: 2,time: 2000});
		return;
	}
	if(!checkEmail(user_name) && !checkMobile(user_name)){
		layer.msg("前台账号格式有误", {icon: 2,time: 2000});
		return;
	}*/
	if($('input[name=seller_name]').val() == ''){
		layer.msg("店主卖家账号不能为空", {icon: 2,time: 2000});
		return;
	}
	if($('input[name=password]').val() == ''){
		layer.msg("登陆密码不能为空", {icon: 2,time: 2000});
		return;
	}
	if(flag){
		$('#store_info').submit();
	}
}

function store_check(){
	$.ajax({
		type:'post',
		url:"<?php echo U('Store/store_check');?>",
		dataType:'json',
		data:{store_name:$('input[name=store_name]').val(),seller_name:$('input[name=seller_name]').val(),user_name:$('input[name=user_name]').val()},
		success:function(res){
			if(res.stat != 'ok'){
				layer.msg(res.msg, {icon: 2,time: 2000});
				flag = false;
				return;
			}else{
				flag = true;
			}
		}
	});
}
</script>
</div>
</body>
</html>
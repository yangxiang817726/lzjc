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
				            	<p class="text-success margin blod">店铺:</p>
				            </div>
				             <div class="form-group">
                                 <a class="btn btn-default" href="<?php echo U('Store/store_own_list');?>">管理</a>&nbsp;&nbsp;&nbsp;&nbsp;                                            
                                 <a class="btn btn-default" href="<?php echo U('Store/store_add');?>" >新增</a>&nbsp;&nbsp;&nbsp;&nbsp;                                            
                                 <a class="btn btn-primary" href="javascript:;" >编辑</a>
				            </div>
    	                    <div class="pull-right">
				                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
				            </div>
				          </div>
				       </div>
	    		 	</nav>	
	               	<nav class="navbar navbar-default">
              	         <div class="callout callout-inro">
							<p>1. 可以修改自营店铺的店铺名称以及店铺状态是否为开启状态</p>
					        <p>2. 可以修改自营店铺的店主商家中心登录账号。</p>
					        <p>3. 如需修改店主登录密码，请到会员管理中，搜索“店主账号”相应的会员并编辑。</p>
					        <p>4. 已绑定所有类目的自营店，如果将“绑定所有类目”设置为“否”，则会下架其所有商品，请谨慎操作！</p>
		            	</div>
	    			</nav>
	             </div>
	             <div class="box-body">
	           	 <div class="col-xs-12">
	            	 <form method="post" id="store_info">
		              <table class="table table-bordered table-striped dataTable">
                        <tbody>
                        <tr><td>店铺名称：</td>
                        	<td><input name="store_name" value="<?php echo ($store["store_name"]); ?>" class="form-control" onchange="store_check('store')"></td>
                        	<td></td>
                        </tr>
                        <tr>
                        	<td>开店时间：</td>
                        	<td><?php echo (date("Y-m-d H:i:s",$store["store_time"])); ?></td>
                        	<td></td>
                        </tr> 
                        <tr>
                            <td>店主卖家账号：</td>
                            <td><input name="seller_name" value="<?php echo ($store["seller_name"]); ?>" onchange="store_check('seller')"></td>
                       		<td class="text-warning">用于登录商家中心，可与店主账号不同</td>
                        </tr> 

                         <tr>
                            <td>绑定所有类目：</td>
                            <td><input type="radio" name="bind_all_gc" value="1" <?php if($store[bind_all_gc] == 1): ?>checked<?php endif; ?>>是
                            	<input type="radio" name="bind_all_gc" value="0" <?php if($store[bind_all_gc] == 0): ?>checked<?php endif; ?>>否
                            </td>
                       		<td></td>
                        </tr>
                        
                        <tr>
                                    <td>所属分类:</td>
                                    <td>
                                      <select name="sc_id" class="form-control" style="width:200px;">
                                        <option value="0">请选择分类</option>                                      
                                             <?php if(is_array($store_class)): foreach($store_class as $k=>$v): ?><option value="<?php echo ($k); ?>" <?php if($k == $sc_id): ?>selected="selected"<?php endif; ?>>
                                               	<?php echo ($v); ?>
                                               </option><?php endforeach; endif; ?>
                                      </select>                         
                                    </td>
                                </tr>
                                
                                
						<tr>
							<td>商品是否需要审核：</td>
							<td><input type="radio" name="goods_examine" value="1" <?php if($store[goods_examine] == 1): ?>checked<?php endif; ?>>是
								<input type="radio" name="goods_examine" value="0" <?php if($store[goods_examine] == 0): ?>checked<?php endif; ?>>否
							</td>
						</tr>
						<tr>
                            <td>状态：</td>
                            <td><input type="radio" name="store_state" value="1" <?php if($store[store_state] == 1): ?>checked<?php endif; ?>>开启
                            	<input type="radio" name="store_state" value="0" <?php if($store[store_state] == 0): ?>checked<?php endif; ?>>关闭
                            </td>
                       		<td></td>
                        </tr> 
                        <tr> 
                        	<td colspan="3" style="text-align:center;">
                        		<input type="hidden" name="store_id" value="<?php echo ($store["store_id"]); ?>">
	                        	<a href="javascript:void(0)" onclick="actsubmit()" class="btn btn-info margin">提交</a>
	                        </td>
                        </tr>
                        </tbody>
		               </table>
		             </form>
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
	var user_name = $('input[name=user_name]').val();
	if(user_name == ''){
		layer.msg("店主账号不能为空", {icon: 2,time: 2000});
		return;
	}
	if($('input[name=seller_name]').val() == ''){
		layer.msg("店主卖家账号不能为空", {icon: 2,time: 2000});
		return;
	}
	if(flag){
		$('#store_info').submit();
	}else{
		layer.msg("请检查店铺名称和卖家账号", {icon: 2,time: 2000});
	}
}

function store_check(type){
	if(type=="store"){
		$.ajax({
			type:'post',
			url:"<?php echo U('Store/store_check');?>",
			dataType:'json',
			data:{store_name:$('input[name=store_name]').val()},
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
	}else{
		$.ajax({
			type:'post',
			url:"<?php echo U('Store/store_check');?>",
			dataType:'json',
			data:{seller_name:$('input[name=seller_name]').val()},
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
}
</script>
</div>
</body>
</html>
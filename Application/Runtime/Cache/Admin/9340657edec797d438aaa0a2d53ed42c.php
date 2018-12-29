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
				          <form class="navbar-form form-inline" action="<?php echo U('Store/store_list');?>" method="post">
				           	<div class="form-group">
				            	<label class="control-label" for="input-order-id">所属等级</label>
				            	 <select name="grade_id" class="form-control">
                                      <?php if(is_array($store_grade)): $k = 0; $__LIST__ = $store_grade;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?><option value="<?php echo ($k); ?>" <?php if($pid == $k): ?>selected<?php endif; ?>><?php echo ($item); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>                  
                                 </select>   
				            </div>
				           <div class="form-group">
				              	<input type="text" name="seller_name" class="form-control" placeholder="请输入店主名称">
				            </div>
				            <div class="form-group">
				            	<label class="control-label" for="input-order-id">店铺状态</label>
				            	 <select name="pid" class="form-control">
				            	 	   <option>选择状态</option>
									   <option value="1">开启</option>
				            	 	   <option value="2">关闭</option>
                                       <option value="3">即将到期</option>
                                       <option value="4">已到期</option>
                                 </select>   
				            </div>
				           	<div class="form-group">
				            	<label class="control-label" for="input-order-id">店铺类别</label>
				            	 <select name="sc_id" class="form-control">
                                      <?php if(is_array($store_class)): $k = 0; $__LIST__ = $store_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?><option value="<?php echo ($k); ?>"><?php echo ($item); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>                  
                                 </select>   
				            </div>
				            <div class="form-group">
				              	<input type="text" name="store_name" class="form-control" placeholder="请输店铺名称">
				            </div>
				            <button type="submit" class="btn btn-primary">查询</button>
				            <div class="form-group pull-right">
					            <a href="<?php echo U('Store/store_add');?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> 新增店铺</a>
				            </div>		          
				          </form>
				      	</div>
	    			</nav>
	    			<nav class="navbar navbar-default">	                          	
	    			   <div class="callout callout-inro">
							<p>1. 平台在此处统一管理自营店铺，可以新增、编辑、删除平台自营店铺。</p>
					        <p>2. 可以设置未绑定全部商品类目的平台自营店铺的经营类目。</p>
					        <p>3. 已经发布商品的自营店铺不能被删除。</p>
					        <p>4. 删除平台自营店铺将会同时删除店铺的相关图片以及相关商家中心账户，请谨慎操作！</p>
				        </div>
					</nav>	    			
	             </div>
	             <div class="box-body">
	           	 <div class="row">
	            	<div class="col-sm-12">
		              <table id="list-table" class="table table-bordered table-striped dataTable">
		                 <thead>
		                   <tr role="row">
                               <th>店铺名称</th>
                               <th>店主账号</th>
			                   <th>店主卖家账号</th>
                               <th>创建日期</th>
			                   <th>状态</th>
		                  	   <th>绑定所有类目</th>
		                  	   <th>店铺类别</th>
		                  	   <th>操作</th>
		                   </tr>
		                 </thead>
						<tbody>
                          <?php if(is_array($list)): foreach($list as $k=>$vo): ?><tr role="row">    
                             <td><?php echo ($vo["store_name"]); ?></td>
                             <td><?php echo ($vo["user_name"]); ?></td>
		                     <td><?php echo ($vo["seller_name"]); ?></td>                                    
		                     <td><?php echo (date('Y-m-d',$vo["store_time"])); ?></td>
		                     <td><?php if($vo[store_state] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
		                     <td><?php if($vo[bind_all_gc] == 1): ?>是<?php else: ?>否<?php endif; ?></td>
		                     <td><?php echo ($store_class[$vo[sc_id]]); ?></td>   
		                     <td>
		                      <a class="btn btn-primary" href="<?php echo U('Store/store_edit',array('store_id'=>$vo['store_id']));?>"><i class="fa fa-pencil"></i></a>
		                      <a class="btn btn-danger" onclick="delfunc(this)" data-url="<?php echo U('Store/store_del');?>" data-id="<?php echo ($vo["store_id"]); ?>"><i class="fa fa-trash-o"></i></a>
				     		</td>
		                   </tr><?php endforeach; endif; ?>
		                   </tbody>
		                 <tfoot>
		                 
		                 </tfoot>
		               </table>
	               </div>
	          </div>
              <div class="row">
              	    <div class="col-sm-6 text-left">
              	    	<button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
              	    </div>
                    <div class="col-sm-6 text-right"><?php echo ($page); ?></div>		
              </div>
	          </div>
	        </div>
       	</div>
       </div>
   </section>
<script>

</script>
</div>
</body>
</html>
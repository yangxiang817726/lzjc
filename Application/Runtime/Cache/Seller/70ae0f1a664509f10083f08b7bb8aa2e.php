<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>tpshop商家管理后台</title>
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
   						layer.closeAll();
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

    <section class="content" style="padding:0px 15px;">
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
                <a onclick="get_help(this)" data-url="http://www.tp-shop.cn/Doc/Indexbbc/article/id/1064/developer/user.html" class="btn btn-default" href="javascript:;"><i class="fa fa-question-circle"></i> 帮助</a>                
            </div>
            <div class="panel panel-default">           
                <div class="panel-body ">   
                   	<ul class="nav nav-tabs">
    <li <?php if(ACTION_NAME == 'store_setting'): ?>class="active"<?php endif; ?>><a href="javascript:void(0)" data-url="<?php echo U('Store/store_setting');?>" onclick="goset(this)" data-toggle="tab">店铺设置</a></li> 
    <li <?php if(ACTION_NAME == 'store_slide'): ?>class="active"<?php endif; ?>><a href="javascript:void(0)" data-url="<?php echo U('Store/store_slide');?>" onclick="goset(this)" data-toggle="tab">幻灯片设置</a></li> 
    <li <?php if(ACTION_NAME == 'theme'): ?>class="active"<?php endif; ?>><a href="javascript:void(0)" data-url="<?php echo U('Store/theme');?>" onclick="goset(this)" data-toggle="tab">店铺主题</a></li> 
    <li <?php if(ACTION_NAME == 'mobile_slide'): ?>class="active"<?php endif; ?>><a href="javascript:void(0)" data-url="<?php echo U('Store/mobile_slide');?>" onclick="goset(this)" data-toggle="tab">手机店铺设置</a></li>
    <li <?php if(ACTION_NAME == 'distribut'): ?>class="active"<?php endif; ?>><a href="javascript:void(0)" data-url="<?php echo U('Store/distribut');?>" onclick="goset(this)" data-toggle="tab">分销设置</a></li>                        
</ul>
                    <!--表单数据-->
                    <form method="post" id="handlepost" action="<?php echo U('System/handle');?>">                    
                        <!--通用信息-->
                    <div class="tab-content" style="padding:20px 0px;">
                    	<div class="row">
                    		<div class="col-xs-4"><img src="<?php echo ($static_path); ?>/style/<?php echo ($store["store_theme"]); ?>/images/preview.jpg" id="current_theme_img"></div>
                    		<div class="col-xs-4">
                    			<p>店铺模版名称：<?php echo ($store["store_theme"]); ?></p>
                    			<p>店铺风格名称：<?php echo ($template[$store[store_theme]][truename]); ?></p>
                    			<p>店铺名称：<?php echo ($store["store_name"]); ?></p>
                    			<p><a href="<?php echo U('Home/Store/index',array('store_id'=>$store[store_id]));?>" target="blank" class="btn btn-default">店铺首页</a></p>
                    		</div>
                    	</div>
                        <div class="callout"><h3>可用主题</h3></div>             	  
       					<div class="row">
       						<?php if(is_array($template)): foreach($template as $k=>$vo): ?><div class="col-sm-2 col-md-3">
	       							<div class="thumbnail">
		 								<div><a href="javascript:void(0)" onclick="see_theme(this);" data-img="/style/<?php echo ($k); ?>/screenshot.jpg">
							          	<img id="themeimg_<?php echo ($k); ?>" src="<?php echo ($static_path); ?>/style/<?php echo ($k); ?>/images/preview.jpg"></a></div>
		 								<div class="caption">
		 								  <h3>模版名称：<?php echo ($vo["truename"]); ?></h3>
		 								  <p>风格名称：<?php echo ($k); ?></p>
		 								  <p>
		 								  	 <a href="javascript:;" onclick="use_theme('<?php echo ($k); ?>');" class="btn btn-default"><i class="fa fa-gears"></i> 使用</a>
		 								  	 <a href="javascript:;" onclick="see_theme(this);" data-img="<?php echo ($static_path); ?>/style/<?php echo ($k); ?>/screenshot.jpg" class="btn btn-default"><i class="fa fa-eye-slash"></i> 预览</a>
		 								  </p>
		 								</div>
							        </div>
	       						</div><?php endforeach; endif; ?>
       					</div>
       				</div></form><!--表单数据-->
                 </div>            
            </div>
        </div>
    </section>
</div>
<input type="hidden" id="themepath" value="<?php echo ($static_path); ?>">
<script>
function adsubmit(){
	$('#handlepost').submit();
}

function goset(obj){
	window.location.href = $(obj).attr('data-url');
}


function use_theme(style){
	$.ajax({
		url : "<?php echo U('Store/setting_save');?>",
  		type:'post',
  		data:{store_theme:style,act:'update',themepath:$('#themepath').val()},
  		dataType:'json',
  		success:function(res){
			if(res.stat=='ok'){
				layer.msg('设置成功', {icon: 3});
				window.location.reload();
			}else{
				layer.alert(res.msg, {icon: 2});
			}
  		}
  	})
}

function see_theme(obj){
	layer.open({
	  type: 1,
	  title: "效果预览",
	  closeBtn: 1,
	  area: ['1080', '90%'],
	  skin: 'layui-layer-nobg', //没有背景色
	  shadeClose: true,
	  content: "<img src='"+$(obj).attr('data-img')+"'>"
	});
}
</script>
</body>
</html>
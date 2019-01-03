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
  <section class="content">
    <div class="row">
	        <div class="col-xs-3">
	             <select name="cat_id" id="cat_id" onchange="get_category(this.value,'cat_id_2','0');" class="form-control" style="width:220px;">
	               <option value="0">请选择商品分类</option>                                      
	                    <?php if(is_array($cat_list)): foreach($cat_list as $k=>$v): ?><option value="<?php echo ($v['id']); ?>" <?php if($v['id'] == $level_cat['1']): ?>selected="selected"<?php endif; ?> >
	                      		<?php echo ($v['name']); ?>
	                      </option><?php endforeach; endif; ?>
	             </select>
	        </div>
	        <div class="col-xs-3">
	             <select name="cat_id_2" id="cat_id_2" onchange="get_category(this.value,'cat_id_3','0');" class="form-control" style="width:220px;">
	               	<option value="0">请选择商品分类</option>
	             </select>  
	        </div>
	        <div class="col-xs-3">                        
	             <select name="cat_id_3" id="cat_id_3" class="form-control" style="width:220px;">
	               <option value="0">请选择商品分类</option>
	             </select> 
	        </div>  
    </div>
    <div class="row" style="text-align:center;"><a href="javascript:void(0)" onclick="gosubmit()" class="btn btn-info margin">提交</a></div>
  </section>
</div>
<script>
function gosubmit(){
	var cat_id = $('#cat_id').val();
	var cat_id2 = $('#cat_id_2').val();
	var cat_id3 = $('#cat_id_3').val();
	if(cat_id == 0 || cat_id2 == 0 || cat_id3 == 0){
		layer.msg('请选择完整分类', {icon: 2});
		return false;
	}
	$.ajax({
		type:'post',
		url:"<?php echo U('Store/get_bind_class');?>",
		data:{class_1:cat_id,class_2:cat_id2,class_3:cat_id3},
		dataType : 'json',
		success : function(data){
			if(data.stat=='ok'){
				layer.msg('操作成功', {icon: 3});
				window.parent.location.reload();
			}else{
				layer.alert(data.msg, {icon: 2});
			}
		}
	});
}
</script>
</body>
</html>
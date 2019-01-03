<?php if (!defined('THINK_PATH')) exit();?><table class="table table-bordered" id="goods_spec_table1">                                
    <tr>
        <td colspan="2"><b>商品规格:</b></td>
    </tr>
    <?php if(is_array($specList)): foreach($specList as $k=>$vo): ?><tr>
        <td><?php echo ($vo[name]); ?>:</td>
        <td>                            
            <?php if(is_array($vo[spec_item])): foreach($vo[spec_item] as $k2=>$vo2): ?><button type="button" data-spec_id='<?php echo ($vo[id]); ?>' data-item_id='<?php echo ($k2); ?>' class="btn <?php  if(in_array($k2,$items_ids)) echo 'btn-success'; else echo 'btn-default'; ?>" >
                    <?php echo ($vo2); ?>
                </button>
                <?php if(strstr($vo[name],'颜色')): ?><img width="35" height="35" src="<?php echo ((isset($specImageList[$k2]) && ($specImageList[$k2] !== ""))?($specImageList[$k2]):'/Public/images/add-button.jpg'); ?>" id="item_img_<?php echo ($k2); ?>" onclick="GetUploadify3('<?php echo ($k2); ?>');"/>    
                        <input type="hidden" name="item_img[<?php echo ($k2); ?>]" value="<?php echo ($specImageList[$k2]); ?>" /><?php endif; ?>                
                &nbsp;&nbsp;&nbsp;<?php endforeach; endif; ?>
            
            <input type="text" maxlength="20" data-spec_id="<?php echo ($vo[id]); ?>" name="spec_item" placeholder="规格值名称" class="form-control" style="width:80px;vertical-align: middle;display: initial;">
            &nbsp;&nbsp;
            <a href="javascript:void(0);"  onclick="addSpecItem(this)">添加</a>
            <a href="javascript:void(0);"  onclick="delSpecItem(this)">删除</a>            
        </td>
    </tr><?php endforeach; endif; ?>    
</table>
<div id="goods_spec_table2"> <!--ajax 返回 规格对应的库存--> </div>

<script>
    // 添加规格
	function addSpecItem(obj){
		var spec_item = $(obj).siblings('input[name="spec_item"]').val();
		spec_item = $.trim(spec_item);
		var spec_id = $(obj).siblings('input[name="spec_item"]').data('spec_id');
		if(spec_item.length == 0)
		{
			layer.alert('请输入规格值', {icon: 2});  //alert('删除失败');
			return false;
		}
		
		$.ajax({
				type:'POST',
				data:{'spec_item':spec_item,'spec_id':spec_id},
				dataType:'json',
				url:"/index.php?m=Seller&c=Goods&a=addSpecItem",
				success:function(data){                            
					   if(data.status < 0)
					   {
						   layer.alert(data.msg, {icon: 2}); 
					   }else{
						   $("#cat_id2").trigger('change');
					   }						   
				}
		});

	}
	
    // 删除规格
	function delSpecItem(obj){
		var spec_item = $(obj).siblings('input[name="spec_item"]').val();
		spec_item = $.trim(spec_item);
		var spec_id = $(obj).siblings('input[name="spec_item"]').data('spec_id');
		if(spec_item.length == 0)
		{
			layer.alert('请输入规格值', {icon: 2});  //alert('删除失败');
			return false;
		}
		
		$.ajax({
				type:'POST',
				data:{'spec_item':spec_item,'spec_id':spec_id},
				dataType:'json',
				url:"/index.php/Seller/Goods/delSpecItem",
				success:function(data){                            
					   if(data.status < 0)
					   {
						   layer.alert(data.msg, {icon: 2}); 
					   }else{
						   $("#cat_id2").trigger('change');
					   }						   
				}
		});

	}	

    
    // 上传规格图片
    function GetUploadify3(k){        
        cur_item_id = k; //当前规格图片id 声明成全局 供后面回调函数调用
        GetUploadify(1,'','goods','call_back3');
    }
    
    
    // 上传规格图片成功回调函数
    function call_back3(fileurl_tmp){
        $("#item_img_"+cur_item_id).attr('src',fileurl_tmp); //  修改图片的路径
        $("input[name='item_img["+cur_item_id+"]']").val(fileurl_tmp); // 输入框保存一下 方便提交
    }    
    
   // 按钮切换 class
   $("#ajax_spec_data button").click(function(){
	   if($(this).hasClass('btn-success'))
	   {
		   $(this).removeClass('btn-success');
		   $(this).addClass('btn-default');		   
	   }
	   else
	   {
		   $(this).removeClass('btn-default');
		   $(this).addClass('btn-success');		   
	   }
	   ajaxGetSpecInput();	  	   	 
});
	

/**
*  点击商品规格处罚 下面输入框显示
*/
function ajaxGetSpecInput()
{
//	  var spec_arr = {1:[1,2]};// 用户选择的规格数组 	  
//	  spec_arr[2] = [3,4]; 
	  var spec_arr = {};// 用户选择的规格数组 	  	  
	// 选中了哪些属性	  
	$("#goods_spec_table1  button").each(function(){
	    if($(this).hasClass('btn-success'))	
		{
			var spec_id = $(this).data('spec_id');
			var item_id = $(this).data('item_id');
			if(!spec_arr.hasOwnProperty(spec_id))
				spec_arr[spec_id] = [];
		    spec_arr[spec_id].push(item_id);
			//console.log(spec_arr);
		}		
	});
		ajaxGetSpecInput2(spec_arr); // 显示下面的输入框
	
}
    /**
     *  点击商品规格处罚 下面输入框显示
     */
    function ajaxGetSpecInputpt()
    {
//	  var spec_arr = {1:[1,2]};// 用户选择的规格数组
//	  spec_arr[2] = [3,4];
        var spec_arr = {};// 用户选择的规格数组
        // 选中了哪些属性
        $("#goods_spec_table1  button").each(function(){
            if($(this).hasClass('btn-success'))
            {
                var spec_id = $(this).data('spec_id');
                var item_id = $(this).data('item_id');
                if(!spec_arr.hasOwnProperty(spec_id))
                    spec_arr[spec_id] = [];
                spec_arr[spec_id].push(item_id);
                //console.log(spec_arr);
            }
        });
        ajaxGetSpecInput3(spec_arr); // 显示下面的输入框

    }
	
/**
* 根据用户选择的不同规格选项 
* 返回 不同的输入框选项
*/
function ajaxGetSpecInput2(spec_arr)
{		

    var goods_id = $("input[name='goods_id']").val();
	$.ajax({
			type:'POST',
			data:{'spec_arr':spec_arr},
			url:"/index.php/Seller/Goods/ajaxGetSpecInput/goods_id/"+goods_id,
			success:function(data){                            
				   $("#goods_spec_table2").html('')
				   $("#goods_spec_table2").append(data);
				   hbdyg();  // 合并单元格
			}
	});
}
    function ajaxGetSpecInput3(spec_arr)
    {

        var goods_id = $("input[name='goods_id']").val();
        $.ajax({
            type:'POST',
            data:{'spec_arr':spec_arr},
            url:"/index.php/Seller/Goods/ajaxGetSpecInputpt/goods_id/"+goods_id,
            success:function(data){
                $("#goods_spec_table2").html('')
                $("#goods_spec_table2").append(data);
                hbdyg();  // 合并单元格
            }
        });
    }
 // 合并单元格
 function hbdyg() {
            var tab = document.getElementById("spec_input_tab"); //要合并的tableID
            var maxCol = 2, val, count, start;  //maxCol：合并单元格作用到多少列  
            if (tab != null) {
                for (var col = maxCol - 1; col >= 0; col--) {
                    count = 1;
                    val = "";
                    for (var i = 0; i < tab.rows.length; i++) {
                        if (val == tab.rows[i].cells[col].innerHTML) {
                            count++;
                        } else {
                            if (count > 1) { //合并
                                start = i - count;
                                tab.rows[start].cells[col].rowSpan = count;
                                for (var j = start + 1; j < i; j++) {
                                    tab.rows[j].cells[col].style.display = "none";
                                }
                                count = 1;
                            }
                            val = tab.rows[i].cells[col].innerHTML;
                        }
                    }
                    if (count > 1) { //合并，最后几行相同的情况下
                        start = i - count;
                        tab.rows[start].cells[col].rowSpan = count;
                        for (var j = start + 1; j < i; j++) {
                            tab.rows[j].cells[col].style.display = "none";
                        }
                    }
                }
            }
        }
</script>
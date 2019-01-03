<?php if (!defined('THINK_PATH')) exit();?><ul class="nav nav-tabs">
  <?php if(is_array($specList)): $i = 0; $__LIST__ = $specList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class="active"><a data-toggle="tab" href="javascript:void(0);" onclick="ajax_get_data(<?php echo ($list[id]); ?>);"><?php echo ($list["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>    
</ul>          
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="spec_item_table">
            <thead>
            <tr>
               平台没有绑定规格名称
            </tr>
            </tbody>
        </table>

    </div>
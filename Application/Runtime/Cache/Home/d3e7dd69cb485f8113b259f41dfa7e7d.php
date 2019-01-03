<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="UTF-8">
<title><?php echo ($goods["goods_name"]); ?>-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
<meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
<meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="applicable-device" content="pc">
<meta name="mobile-agent" content="">
<meta http-equiv="X-UA-Compatible" content="IE=8"> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!--<link rel="stylesheet" href="/Template/pc/soubao/Static/css/common.css?v=1459218814">-->
</head>
<body class="detailfont">
<script type="text/javascript" src="/Public/js/jquery-1.10.2.min.js"></script>
<script src="/Public/js/global.js"></script>
<script src="/Public/js/layer/layer.js"></script> 
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/common.min.css">
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/main.min.css">
<style>.fn-clear .words{ line-height:1.5}.m-top-nav a{color:#000;}</style>
<div class="fn-cms-top">
<?php $pid =1;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1546408800 and end_time > 1546408800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 1- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$v): $v[position] = $ad_position[$v[pid]]; if($_GET[edit_ad] && $v[not_adv] == 0 ) { $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]"; $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name]; $v[target] = 0; } ?><div fnp="m-top-banner" style="background:<?php echo ($v["bgcolor"]); ?>;" class="m-top-banner rel editable" moduleId="2010053" style="position:relative;min-height:35px;">
	 <div class="bar container">
	 	<a class="img-small" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> href="<?php echo ($v["ad_link"]); ?>"> <img class="img100" src="<?php echo ($v[ad_code]); ?>"  title="<?php echo ($v[title]); ?>" style="<?php echo ($v[style]); ?>"/></a>   
	 </div>
	 <i data-role="close" class="icon icon-close"></i>
</div><?php endforeach; ?>
<div class="m-top-bar editable" moduleId="1539923" style="position:relative;min-height:25px;">
  <div class="container">
    <ul class="fl">
      <li class="fl J_login_status dn nologin">
      	<a class="menu-item fl J_do_login J_chgurl" href="<?php echo U('Home/user/login');?>">
        <span>Hi，请登录</span> </a><a class="menu-item fl ht" href="<?php echo U('Home/user/reg');?>">免费注册</a>
      </li>
      <li class="fl J_login_status dn islogin"><a href="<?php echo U('Home/user/index');?>" class="userinfo" title="" target="_self"></a>
      	<a href="<?php echo U('Home/user/logout');?>" style="margin:0 10px;" title="退出" target="_self">退出</a></li>
      <li class="fl sep"></li>
      <!-- 
      <li class="fl select-city dropdown">
        <span class="menu-item">
        <span>送货至：</span>
        <a title="" alt="" href="" class="J_cur_place"></a><i class="dd"></i></span>
      </li>-->
    </ul>
    <ul class="fr bar-right">
      <li class="fl dropdown my-feiniu"><a class="menu-item" target="_blank" href="<?php echo U('Home/Newjoin/index');?>">
        <span>商家入驻</span><i class="dd"></i></a>
        <ul class="sub-panel">
          <li><a class="J_chgurl" target="_blank" href="<?php echo U('/seller/Admin/login');?>">商家登录</a></li>
        </ul>
      </li>
      <li class="fl dropdown my-feiniu"><a class="menu-item" target="_blank" href="<?php echo U('Home/user/index');?>">
        <span>我的商城</span><i class="dd"></i></a>
        <ul class="sub-panel">
          <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/order_list');?>">我的订单</a></li>
          <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/account');?>">我的积分</a></li>
          <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/coupon');?>">我的优惠券</a></li>
          <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/goods_collect');?>">我的收藏夹</a></li>
          <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/comment');?>">我的评论</a></li>
        </ul>
      </li>
      <li class="fl sep"></li>       
      <li class="fl dropdown mobile-feiniu"><a class="menu-item" href=""><i class="fl ico"></i>
        <span class="fl">手机TPshop网</span>
        <i class="dd"></i></a>
        <div class="sub-panel m-lst">
          <p>扫一扫，下载TPshop客户端</p>
          <dl>
            <dt class="fl mr10"><a target="_blank" href=""><img height="80" width="80" src="/Template/pc/soubao/Static/images/qrcode_vmall_app01.png"></a></dt>
            <dd class="fl mb10"><a target="_blank" href=""><i class="andr"></i> Andiord</a></dd>
            <dd class="fl"><a target="_blank" href=""><i class="iph"></i> iPhone</a></dd>
          </dl>
        </div>
      </li>
      <li class="fl sep"></li>
      <li class="fl"><a class="menu-item" href="<?php echo U('Home/Article/detail',array('article_id'=>17));?>" target="_blank">
        <span>帮助中心</span></a></li>
      <li class="fl sep"></li>
      <li class="fl about-us"><a class="txt fl" style="line-height:unset;" href="">关注我们：</a></li>
      <li class="fl dropdown weixin"><a href="" class="fl ico"></a>
        <div class="sub-panel wx-box">
          <span class="arrow-b">◆</span>
          <span class="arrow-a">◆</span>
          <p class="n"> 扫描二维码 <br>	关注TPshop网官方微信 </p>
          <img src="/Template/pc/soubao/Static/images/qrcode_vmall_app01.png"></div>
      </li>
    </ul>
  </div>
</div>
<div class="m-top-sidebar m-sdb-sale J-sdb " moduleId="2026855" style="z-index:401;" fnp="m-top-sidebar">
  <div class="t-pic"><a href="" target="_blank" class="img-small"><img class="img100" src="/Template/pc/soubao/Static/images/csmrrvbluacaoflbaacb1akwoks248.jpg"></a><a href="" target="_blank" class="img-big"><img class="img100" src="/Template/pc/soubao/Static/images/csmrsfbluaoaejs7aacni7xvdgs548.jpg"></a></div>
  <div class="t-main"><a href="" class="bg-floor"></a>
    <div class="tb-tabs">
      <div class="tb-tabs-up">
      	<a href="<?php echo U('Home/Cart/cart');?>" class="i-cart" data-role="ico-cart"><i></i>
        <span class="text">购物车</span><span id ="miniCartRightQty" class="num">0</span></a>
        <a href="<?php echo U('/Home/User/order_list');?>" target="_blank" class="i-ico i-ico-order" data-role="ico-btn">
        <span>我的订单</span><i class="demo-icon">&#xe807;</i></a>
        <a href="<?php echo U('/Home/User/coupon');?>" target="_blank" class="i-ico i-ico-coupon" data-role="ico-btn">
        <span>我的优惠券</span><i class="demo-icon">&#xe80f;</i></a>
        <a href="<?php echo U('/Home/User/goods_collect');?>" target="_blank" class="i-ico i-ico-fav" data-role="ico-btn">
        <span>我的收藏</span><i class="demo-icon">&#xe808;</i></a>
        <a href="<?php echo U('/Home/User/comment');?>" target="_blank" class="i-ico i-ico-foot" data-role="ico-btn">
        <span>我的评论</span><i class="demo-icon">&#xe805;</i></a>
      </div>
      <div class="tb-tabs-down">
        <div class="rel" style="display: none;" id="cms_share">
          <div data-tag="share_1" class="bdsharebuttonbox"><a data-cmd="more" class="bds_more" href=""></a></div>
          <a class="i-ico i-ico-share" href="">
          <span>分享</span>
          <i></i></a></div>
        <a href="" target="_blank" class="i-ico i-ico-ur" data-role="ico-btn">
        <span>意见反馈</span>
        <i></i></a><a href="" class="i-ico i-ico-gotop" data-role="ico-gotop"><em></em>
        <span>返回顶部</span>
        <i></i></a></div>
      <div class="my-cart-shim"></div>
    </div>
    <div class="my-cart">
      <div class="mn-c-top" ><a href="">我的购物车</a><i data-role="cart-close-btn"></i></div>
      <div class="sub-panel u-fn-cart u-mn-cart">
        <div id="miniCartRight"></div>
        <div class="empty-c fn-hide">
          <span class="ma"><i class="c-i oh"></i>购物车中没有TPshop商品哟！</span>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="m-top-search editable" moduleId="1539927" style="position:relative;min-height:35px;">
  <div class="container">
    <div class="logo fl">
    	<a href="/" target="_blank" class="item fl">
    	<img height="60" width="160" src="<?php echo ($tpshop_config['shop_info_store_logo']); ?>"></a>
    	<!-- <a href="" target="_blank" class="item fl"><img height="60" width="140" src="/Template/pc/soubao/Static/images/csmrrvbluvoamtx8aaeoswlm7gg007.gif"></a>--
    	<a href="http://beauty.tp-shop.cn" target="_blank" class="item fl">
    		<img height="60" width="140" src="http://img14.fn-mart.com/group1/M00/DC/08/CsnBP1Y691GAZQRtAAAGc8GxEf8284.png">
    	</a>-->
    </div>
    <div fnp="m-top-search-form" class="m-top-search-form fl">
       <form name="sourch_form" id="sourch_form" method="post" action="<?php echo U("/Home/Goods/search");?>">
        <div data-role="form-inner" class="s-form"><i class="s-ico"></i>
          <input type="text" data-role="input-search" autocomplete="off" class="fl s-input" name="q" id="q" value="<?php echo I('q'); ?>" placeholder="搜索关键字"/>
          <a data-role="btn" href="javascript:void(0);" class="s-btn fl" onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();">搜索</a>
        </div>
        <div class="s-hotword">           
        	<?php if(is_array($tpshop_config["hot_keywords"])): foreach($tpshop_config["hot_keywords"] as $k=>$wd): ?><a href="<?php echo U('Home/Goods/search',array('q'=>$wd));?>" <?php if($wd == I('q')): ?>class="ht"<?php endif; ?>><?php echo ($wd); ?></a><?php endforeach; endif; ?>
        </div>
        <ul data-role="tip-list" class="s-tip-list">
        </ul>
      </form>
    </div>
    <div class="my-cart fr" id="hd-my-cart">
      <p class="c-n fl">我的购物车</p>
      <p class="c-num fl quantity">(<span class="count cart_quantity" id="cart_quantity"></span>) <i class="i-c oh"></i></p>
      <div id="show_minicart" class="sub-panel u-fn-cart u-mn-cart">
        <div id="minicart" class="minicartContent">
          <div class="empty-c fn-hide">
            <span class="ma"><i class="c-i oh"></i>购物车中没有TPshop商品哟！</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div fnp="m-top-search-fixed" class="m-top-search-fixed"><i class="s-bg"></i>
  <div class="fix-bar">
    <div class="container">
      <div class="u-g-logo fl"><a target="_blank" class="fl logo" href=""><img height="40" width="100" src="/Template/pc/soubao/Static/images/logo3.png"></a></div>
      <div fnp="m-top-search-form" class="m-top-search-form fl">
        <form data-role="form" action="http://search.tp-shop.cn">
          <div data-role="form-inner" class="s-form"><i class="s-ico"></i>
            <input type="text" data-role="input-search" autocomplete="off" class="fl s-input" name="q">
            <input type="hidden" data-role="input-c" name="cpseq" disabled="disabled">
            <a data-role="btn" href="" class="s-btn fl">搜索</a></div>
          <ul data-role="tip-list" class="s-tip-list">
          </ul>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="m-top-nav editable" moduleId="1539926" style="position:relative;min-height:35px;">
  <div class="main-container new-year">
    <div class="main-title-wrap">
    	<a href="javascript:" target="_blank" class="main-title">
      		<span class="ico"><i class="il il-lt"></i><i class="il il-lc"></i><i class="il il-lb"></i>
      		<i class="il il-rt"></i><i class="il il-rc"></i><i class="il il-rb"></i></span>
      		商城商品分类
      	</a>
      <div class="main-slider" style ="display:none;position: absolute;top: 40px;">
          <div fnp="nav-list" class="nav-list eidtModule" moduleId="nav">
            <ul class="nav-list-warpper">
              <?php
 $md5_key = md5("select * from `__PREFIX__goods_category` where is_show = 1 and `level` = 1  limit 15"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from `__PREFIX__goods_category` where is_show = 1 and `level` = 1  limit 15"); S("sql_".$md5_key,$sql_result_v,1); } foreach($sql_result_v as $k=>$v): ?><li data-role="nav-item" class="nav-item" index="<?php echo ($v["id"]); ?>">
	                <span class="nav-menu-item"><i class="iconfont icon"></i>
	                <span class="title"><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v[id]));?>" target="_blank"><?php echo ($v["name"]); ?></a></span>
	                </span>
	              </li><?php endforeach; ?>
            </ul>
           <?php if(is_array($goods_category_tree)): foreach($goods_category_tree as $k=>$vo): ?><div data-role="menu-sub" class="menu-sub" index ="<?php echo ($k); ?>" style="height:440px">
		        <div class="sub-columns">
		        	<?php if(is_array($vo["tmenu"])): foreach($vo["tmenu"] as $k2=>$v2): if($k2%3 == 0): ?><div class="fn-clear column-item">
		                  <div class="tlt">
		                    <span class="name"><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id]));?>" target="_blank"><?php echo ($v2["name"]); ?></a></span>
		                  </div>
		                  <div class="words">
		                  	<?php if(is_array($v2["sub_menu"])): foreach($v2["sub_menu"] as $key=>$v3): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id]));?>" <?php if($v3[is_hot] == 1): ?>class="lh"<?php endif; ?> target="_blank"><?php echo ($v3["name"]); ?></a><?php endforeach; endif; ?>
		                  </div>
		                </div><?php endif; endforeach; endif; ?>
	            </div>
	            
	            <div class="sub-columns">
		        	<?php if(is_array($vo["tmenu"])): foreach($vo["tmenu"] as $k2=>$v2): if($k2%3 == 1): ?><div class="fn-clear column-item">
		                  <div class="tlt">
		                    <span class="name"><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id]));?>" target="_blank"><?php echo ($v2["name"]); ?></a></span>
		                  </div>
		                 <div class="words">
		                  	<?php if(is_array($v2["sub_menu"])): foreach($v2["sub_menu"] as $key=>$v3): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id]));?>" <?php if($v3[is_hot] == 1): ?>class="lh"<?php endif; ?> target="_blank"><?php echo ($v3["name"]); ?></a><?php endforeach; endif; ?>
		                  </div>
		                </div><?php endif; endforeach; endif; ?>
	            </div>
		        <div class="sub-columns">
		        	<?php if(is_array($vo["tmenu"])): foreach($vo["tmenu"] as $k2=>$v2): if($k2%3 == 2): ?><div class="fn-clear column-item">
		                  <div class="tlt">
		                    <span class="name"><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id]));?>" target="_blank"><?php echo ($v2["name"]); ?></a></span>
		                  </div>
		                  <div class="words">
		                  	<?php if(is_array($v2["sub_menu"])): foreach($v2["sub_menu"] as $key=>$v3): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id]));?>" <?php if($v3[is_hot] == 1): ?>class="lh"<?php endif; ?> target="_blank"><?php echo ($v3["name"]); ?></a><?php endforeach; endif; ?>
		                  </div>
		                </div><?php endif; endforeach; endif; ?>
	            </div>
	            <div class="right-wrap">
                <ul class="li-item">
                  <?php if(is_array($vo["brand"])): $i = 0; $__LIST__ = $vo["brand"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$br): $mod = ($i % 2 );++$i;?><li class="item" <?php if(($mod) == "1"): ?>even<?php endif; ?>>
	                  	<a href="<?php echo U('Goods/goodsList',array('brand_id'=>$br[id]));?>" target="_blank">
	                  	<img class="nav-prod" src="/Template/pc/soubao/Static/images/loading.gif" alt="" data-images="<?php echo ($br["logo"]); ?>"></a>
	                  </li><?php endforeach; endif; else: echo "" ;endif; ?>
               	  <li class="item"><a href="" target="_blank"><img class="nav-prod" src="/Template/pc/soubao/Static/images/loading.gif" alt="" data-images="http://img18.fn-mart.com/pic/ceb9133a1f582292acba/BzHznn5T_2tlKguMj2/7imGea0GgaXxzG/CsmRslaV66qAPaFEAAANRKhmwYQ120.png"></a></li>
                  <li class="item even"><a href="" target="_blank"><img class="nav-prod" src="/Template/pc/soubao/Static/images/loading.gif" alt="" data-images="http://img16.fn-mart.com/pic/d0fa133a2028dd2c1cad/Bnq2zz72_2fMKdudf2/1YoaSyWGPykRMy/CsmRsFam0vmAfovCAAB1Wrm172E209.jpg"></a></li>
                </ul>
                <?php $pid =80+$k;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->getField("position_id,position_name,ad_width,ad_height");$result = D("ad")->where("pid=$pid  and enabled = 1 and start_time < 1546408800 and end_time > 1546408800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select(); if(!in_array($pid,array_keys($ad_position)) && $pid) { M("ad_position")->add(array( "position_id"=>$pid, "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ", "is_open"=>1, "position_desc"=>CONTROLLER_NAME."页面", )); delFile(RUNTIME_PATH); } $c = 1- count($result); if($c > 0 && $_GET[edit_ad]) { for($i = 0; $i < $c; $i++) { $result[] = array( "ad_code" => "/Public/images/not_adv.jpg", "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid", "title" =>"暂无广告图片", "not_adv" => 1, "target" => 0, ); } } foreach($result as $key=>$vv): $vv[position] = $ad_position[$vv[pid]]; if($_GET[edit_ad] && $vv[not_adv] == 0 ) { $vv[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; $vv[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$vv[ad_id]"; $vv[title] = $ad_position[$vv[pid]][position_name]."===".$vv[ad_name]; $vv[target] = 0; } ?><a href="<?php echo ($vv["ad_link"]); ?>" target="_blank">
	          	   	  <img title="<?php echo ($vv[title]); ?>" style="<?php echo ($vv[style]); ?>" data-images="<?php echo ($vv[ad_code]); ?>" class="right-img nav-prod" src="/Template/pc/soubao/Static/images/loading.gif">
	          	   </a><?php endforeach; ?> 
                </div>
	        </div><?php endforeach; endif; ?>
       </div>
      </div>
    </div>
    <ul class="main-nav">
      <li class="nav-item"><a class="menu-item <?php if( CONTROLLER_NAME == 'Index' ): ?>menu-item-active"<?php endif; ?> target="_blank" href="/" style="overflow: visible;">首页 </a></li>
      <?php
 $md5_key = md5("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC"); S("sql_".$md5_key,$sql_result_v,1); } foreach($sql_result_v as $k=>$v): ?><li class="nav-item"><a  style="overflow: visible;"   href="<?php echo ($v[url]); ?>" 
       		<?php  if($_SERVER['REQUEST_URI']==str_replace('&amp;','&',$v[url])){ echo "class='menu-item menu-item-active'";} else{ echo "class='menu-item'"; } ?>> <?php echo ($v[name]); ?> </a></li><?php endforeach; ?>
      <li class="nav-item"><a class="menu-item " href="javascript:void();" style="overflow: visible;">TPshop商城<i class="e-hot"></i></a></li>
    </ul>  
   </div>
</div>
<div>
  <div class="J_side_nav_trigger"></div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.main-title').hover(function(){
	 	$('.main-slider').show();
	}, function(){
	 	$('.main-slider').hide();
	});
	
	$('.nav-list-warpper').hover(function(){
	 	$('.main-slider').show();
	}, function(){
	 	$('.main-slider').hide();
	});
	     
	get_cart_num();
	var uname= getCookie('uname');
	if(uname == ''){
		$('.islogin').remove();
		$('.nologin').show();
	}else{
		$('.nologin').remove();
		$('.islogin').show();
		$('.userinfo').html(decodeURIComponent(uname));
	}
});


function get_cart_num(){
  var cart_cn = getCookie('cn');
  if(cart_cn == ''){
	$.ajax({
		type : "GET",
		url:"/index.php?m=Home&c=Cart&a=header_cart_list",//+tab,
		success: function(data){								 
			cart_cn = getCookie('cn');						
		}
	});	
  }
  $('#cart_quantity').html(cart_cn);
  $('#miniCartRightQty').html(cart_cn);
}
</script>
<script type="text/javascript" src="/Template/pc/soubao/Static/js/jquery.jqzoom.js"></script> 
<script src="/Public/js/pc_common.js"></script>
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/detail.css">
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/item_merge.css">
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/jquery.jqzoom.css">
<link rel="stylesheet" href="/Template/pc/soubao/Static/css/location.css" type="text/css"><!-- 收货地址，物流运费 -->
<div class="container" id="tracker_item">
<!--
<div id="region-header" style="background-color:;background-image:url();background-repeat:;background-position:;">
   <div class="header-wrap">
     <div class="layout layout-m0">
       <div class="col-main">
         <div class="main-wrap">
           <div class="module fstore-sys-banner">
             <div class="module-bd">
               <div class="banner-box" onclick="window.open()" style="cursor:pointer;background-image:url('http://img17.fn-mart.com/pic/4e70133a9ca33173ed5e/hT8nTTs2v2LgBMuMP2/79SGmROaQGzGpY/CsmRrFbr89aAG6X0AAEfjxLdTJU201.jpg') ;height:120px"></div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
</div>
<!-- 面包屑导航 -->
<div class="breadcrumb"> <strong><a href="/">首页</a></strong>
  <span>
  	<?php if(is_array($navigate_goods)): foreach($navigate_goods as $k=>$v): ?>&nbsp;<i>></i>&nbsp;<a href="<?php echo U('/Home/Goods/goodsList',array('id'=>$k));?>"><?php echo ($v); ?></a><?php endforeach; endif; ?>
  </span>&nbsp;<i>></i>&nbsp;<em><?php echo ($goods["goods_name"]); ?>...</em> 
</div>
<!-- 面包屑导航 end ]] --> 
<!-- 商品内容部分头部 start [[-->
<div class="product-main fn-clear">
  <div class="product-info">
    <div class="product-info-title">
      <h1 class="superboler"> <?php echo ($goods["goods_name"]); ?></h1>
      <p><?php if($flash_sale['description'] != ''): echo ($flash_sale['description']); else: echo ($goods["goods_remark"]); endif; ?></p>
    </div>
    <!-- 价格、尺寸&评价 start [[-->
    <div class="product-info-mian fn-clear"> 
      <!-- 价格、尺寸 start [[-->
      <form id="buy_goods_form" name="buy_goods_form" method="post" >
        <div class="product-value">
          <div class="product-value-area">
            <ul class="product-value-anything product-value-price hide" style="display: block;">
              <li class="refer fn-clear">
                <!--<em class="send">送积分&nbsp;<span id="point">49</span>
                <a href="" target="_blank" class="help_center_url">详</a></em>-->
                <span class="attr">参&nbsp;考&nbsp;价</span>
                <del> <q class="fn-rmb">¥</q><strong class="fn-rmb-num"><?php echo ($goods["market_price"]); ?></strong> </del> </li>
              <li class="nett fn-clear">
                <?php if($goods['promoting'] == 1): ?><span class="attr ssm-price-label" style="margin-top: 0px;">优&nbsp;惠&nbsp;价&nbsp;</span>
                  <?php else: ?>
                  <span class="attr fn-price-label" style="margin-top: 0px;">商&nbsp;城&nbsp;价&nbsp;</span><?php endif; ?>
                <div class="nett-box fn-clear" id="J_product_value">
                  <div class="nett-box-value"> <q class="fn-rmb">¥</q>
                    <?php if($goods['prom_type'] == 1): ?><strong class="fn-rmb-num"  id="goods_price"> <?php echo ($goods['flash_sale']['price']); ?> </strong> 
                    	 <i class="onlylost">仅剩<em><strong id="countdown" style="color:#db384c">
	                    	 <script type="text/javascript">
	                         function GetRTime2(){						
	                             $("#countdown").text(GetRTime('<?php echo (date("Y/m/d H:i:s",$goods['flash_sale']['end_time'])); ?>'));
	                         }
	                         setInterval(GetRTime2,999);
	                    	 </script>
                    	 </strong></em></i>
	                     <i class="two hide" id="saleCountTime" data-time="23600">仅剩
		                     <strong id="time">0</strong>时
		                     <strong id="minute">0</strong>分
		                     <strong id="second">0</strong>秒
	                     </i>
                      <?php else: ?>
                     <strong class="fn-rmb-num" id="goods_price"> <?php echo ($goods["shop_price"]); ?> </strong> 
                     <i class="clue" style="display: inline;">（<a href="javascript:void(0);" id="toprice">降价通知</a>）</i><?php endif; ?>
                  </div>
                </div>
                <?php if(($goods['shop_price'] >= ($goods['exchange_integral']/$point_rate)) AND $goods['exchange_integral'] > 0): ?><li class="nett fn-clear">
                <span class="attr">促销信息</span>
                <q class="fn-rmb">¥</q><strong class="fn-rmb-num"><?php echo ($goods['shop_price']-$goods['exchange_integral']/$point_rate); ?>+<?php echo ($goods['exchange_integral']); ?>积分</strong>
              </li><?php endif; ?>
              </li>
              <li class="nett fn-clear">
                <span class="attr" style="margin-top: 0px;">运&nbsp;&nbsp;&nbsp;费</span>
                <strong class="fn-rmb-num">满<q class="fn-rmb">¥<?php echo ($freight_free); ?></q>免运费</strong>
              </li>
              <li class="nett fn-clear" style="position: relative;">
                <span class="attr" style="margin-top: 0px;">配&nbsp;送&nbsp;至&nbsp;</span>
                <!-- 收货地址，物流运费 -start-->
                <ul class="list1">
                  <li class="summary-stock">
                    <div class="dd">
                      <!--<div class="addrID"><div></div><b></b></div>-->
                      <div class="store-selector">
                        <div class="text" style="width: 150px;"><div></div><b></b></div>
                        <div onclick="$(this).parent().removeClass('hover')" class="close"></div>
                      </div>
                      <span id="dispatching_msg" style="display: none;">有货</span>
                      <select id="dispatching_select" style="display: none;">
                      </select>
                    </div>
                  </li>
                </ul>
                <!-- 收货地址，物流运费 -end-->
              </li>

            </ul>
          </div>
          <div class="product-norm" id="productNorm">
            <div class="product-minheight">
              <div id="J_color_format"> 
                <!-- 颜色 start [[-->
                <?php if(is_array($filter_spec)): foreach($filter_spec as $k=>$v): if($v[0][src] != ''): ?><dl class="product-color product-select public-pl67 fn-clear marginFR25">
                      <dt class="attr"><?php echo ($k); ?></dt>
                      <dd class="product-color-info">
                        <ul class="selectCtrl matchProduct fn-clear J_color " data-v="color_select">
                          <?php if(is_array($v)): foreach($v as $k2=>$v2): ?><li <?php if($k2 == 0 ): ?>class="select"<?php endif; ?>> 
                              <input type="radio" style="display:none;" rel="<?php echo ($v2[item]); ?>" name="goods_spec[<?php echo ($k); ?>]" value="<?php echo ($v2[item_id]); ?>"  <?php if($k2 == 0 ): ?>checked="checked"<?php endif; ?>/>
                              <span data-spec="" data-id="<?php echo ($v2[item_id]); ?>" title="<?php echo ($v2[item]); ?>"><img src="<?php echo ($v2['src']); ?>"></span>
                              <b class="ok"></b> <i></i> 
                            </li><?php endforeach; endif; ?>
                        </ul>
                      </dd>
                    </dl>
                    <!-- 颜色 end ]]-->
                    <?php else: ?>
                    <!-- 规格 start [[-->
                    <dl class="product-format product-select public-pl67 fn-clear marginFR25">
                      <dt class="attr"><?php echo ($k); ?></dt>
                      <dd class="product-format-info fn-clear">
                        <ul class="selectCtrl matchProduct fn-clear J_etalon " data-v="size_select">
                          <?php if(is_array($v)): foreach($v as $k2=>$v2): ?><li <?php if($k2 == 0 ): ?>class="select"<?php endif; ?>> 
                            <input type="radio" style="display:none;" rel="<?php echo ($v2[item]); ?>" name="goods_spec[<?php echo ($k); ?>]" value="<?php echo ($v2[item_id]); ?>" <?php if($k2 == 0 ): ?>checked="checked"<?php endif; ?>/>
                              <span data-spec="35" data-id="<?php echo ($v2[item_id]); ?>" title="<?php echo ($v2[item]); ?>"><?php echo ($v2[item]); ?></span>
                              <b class="ok"></b> </li><?php endforeach; endif; ?>
                        </ul>
                      </dd>
                    </dl><?php endif; endforeach; endif; ?>
              </div>
              <?php if(!empty($filter_spec)): ?><div id="J_showhide_spec">
                   <dl class="marginFR25 product-opt public-pl67 fn-clear">
                       <dt class="attr">已&nbsp;选&nbsp;择</dt>
                       <dd class="product-opt-info">
                           <p></p>
                       </dd>
                   </dl>
              </div><?php endif; ?>
              <!-- 预约 start ]]-->
              <div id="J_reservation"> </div>
              <!-- 预约 end ]]--> 
              <!-- 预售 start ]]-->
              <div id="J_pre_sale"> </div>
              <!-- 预售 end [[--> 
              <!-- 数量 start [[-->
              <dl class="product-number public-pl67 fn-clear hide marginFR25" style="display: block;">
                <dt class="attr">购买数量</dt>
                <dd class="product-number-select">
                  <ul>
                    <li class="number fn-clear" data-type="match"> <a href="javascript:void(0);" class="mins no-mins" data-carnum="-1">−</a>
                      <input type="text" value="1" class="buyNum tbuyNum" name="goods_num" autocomplete="off">
                      <a href="javascript:void(0)" class="add" data-carnum="1">+</a> </li>
                    <li id="pre_label" style="display:none">已预订数量<strong id="numValue">1</strong>件，剩余数量<strong id="numLast" data-maxnum=""></strong>件</li>
                    <li id="ssm_limit_label" style="display:none">限购<strong id="ssm_limit">99</strong>件
                      <span style="display:none" id="over_limit_label">，超过以购物车结算为准 </span>
                    </li>
                    <li id="ssm_label" style="display:none">促销库存<strong id="ssm_qty">99</strong>件
                      <span style="display:none" id="over_qty_label">，超过以购物车结算为准 </span>
                    </li>
                  </ul>
                </dd>
              </dl>
              <!-- 数量 end ]]--> 
              <!-- 提交按钮 start [[-->
              <div class="product-button public-pl67 fn-clear marginFR25">
                <p class="beforebuy-txt create-txt"></p>
                <div class="btn-con">
                  <input type="hidden" name="goods_id" value="<?php echo ($goods["goods_id"]); ?>" />
                  <a id="btnAddCart" href="javascript:;" onclick="javascript:AjaxAddCart(<?php echo ($goods["goods_id"]); ?>,1,0);" class="btn btn-ent flyShop">加入购物车</a>
                  <a id="addCart_f" href="javascript:;" onclick="javascript:AjaxAddCart(<?php echo ($goods["goods_id"]); ?>,1,1);" class="btn btn-fastpay" style="margin-left: 10px;">立即购买</a>
                  <a id="btnAvailableInform" href="javascript:void(0)" class="btn hide">到货通知</a> </div>
              </div>
              <!-- 提交按钮 end ]]--> 
            </div>
            <!-- 服务承诺 start [[-->
            <dl class="sevice public-pl67 marginFR25">
              <dt class="attr">服务承诺</dt>
              <dd> <a><i class="fn-icon seven"></i>
                <span>支持7天无理由退货</span>
                </a> <a><i class="fn-icon"></i>
                <span>正品保证</span>
                </a> <a><i class="fn-icon"></i>
                <span>假一赔三</span>
                </a>               
                </dd>
            </dl>
            <!-- 服务承诺 end ]]-->
            <!-- 温馨提示 start -->
            <dl class="sevice public-pl67 marginFR25">
              <dt class="attr">温馨提示</dt>
              <dd> 由 <font><?php echo ($store["store_name"]); ?></font> 
              <span style="color:#aaa;">发货并提供售后服务。</span>
              <span style="color:#aaa;">             
              	<a href="tencent://message/?uin=<?php echo ($store["store_qq"]); ?>&Site=TPshop商城&Menu=yes"> <img src="/Public/images/qq.gif" />  </a> 
              </span>
              </dd>
            </dl>
            <!-- 温馨提示 end ]]-->  
          </div>
        </div>
        <!-- 价格、尺寸 end ]]-->
      </form>
      <!-- 店铺信息&评价 start [[-->
      <div class="product-evaluate"> 
        <!-- 看了又看 start [[-->
        <div class="side-public side-look item-cf">
          <div class="side-title fn-clear">
            <span class="title">看了又看</span>
            <div class="side-barter"> <a href="javascript:;" class="renovate"></a> 
            <a href="javascript:;" class="barter" onclick="replace_look()">换一批</a> </div>
          </div>
          <ul id="see_and_see">

          </ul>
        </div>
        <!-- 看了又看 end ]]--> 
      </div>
      <!-- 店铺信息&评价  end ]]--> 
    </div>
    <!-- 价格、尺寸&评价 end ]]--> 
  </div>
  <!-- 商品大图&小图展示  start [[-->
  <div class="product-gallery">
    <div class="product-photo" id="photoBody"> 
      <!-- 商品大图介绍 start [[-->
      <div class="product-img jqzoom"> 
      	<img id="zoomimg" src="<?php echo (goods_thum_images($goods["goods_id"],400,400)); ?>" jqimg="<?php echo (goods_thum_images($goods["goods_id"],800,800)); ?>"> 
      </div>
      <!-- 商品大图介绍 end ]]--> 
      <!-- 商品小图介绍 start [[-->
      <div class="product-small-img fn-clear"> <a href="javascript:;" class="next-left next-btn fl disabled"></a>
        <div class="pic-hide-box fl">
          <ul class="small-pic" style="left:0;">
            <?php if(is_array($goods_images_list)): foreach($goods_images_list as $k=>$v): ?><li class="small-pic-li <?php if($k == 0): ?>active<?php endif; ?>"> 
               	 <a href="javascript:;"><img src="<?php echo (get_sub_images($v,$v[goods_id],60,60)); ?>" data-img="<?php echo (get_sub_images($v,$v[goods_id],400,400)); ?>" data-big="<?php echo (get_sub_images($v,$v[goods_id],800,800)); ?>"> <i></i></a> 
               </li><?php endforeach; endif; ?>
          </ul>
        </div>
        <a href="javascript:;" class="next-right next-btn fl"></a> </div>
      <!-- 商品小图介绍 end ]]-->
    </div>
    <!-- 收藏商品 start [[-->
    <div class="collect"> 
    	<a href="javascript:void(0);" id="collectLink"><i class="collect-ico collect-ico-null"></i>
      	<span class="collect-text">收藏商品</span>
      	<em class="J_FavCount"></em></a> 
      	<!--<a href="javascript:void(0);" id="collectLink"><i class="collect-ico collect-ico-ok"></i>已收藏<em class="J_FavCount">(20)</em></a>--> 
    </div>
    <!-- 分享商品 -->
    <div class="share">
		<div class="jiathis_style">
			<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt" target="_blank"><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border="0" /></a>
		</div>
		<script>
         var jiathis_config = {
                                url:"http://<?php echo ($_SERVER[HTTP_HOST]); ?>/index.php?m=Home&c=Goods&a=goodsInfo&id=<?php echo ($_GET[id]); ?>",
                                pic:"http://<?php echo ($_SERVER[HTTP_HOST]); echo (goods_thum_images($goods[goods_id],400,400)); ?>", 
                            }
        var is_distribut = getCookie('is_distribut');
        var user_id = getCookie('user_id');
        // 如果已经登录了, 并且是分销商
        if(parseInt(is_distribut) == 1 && parseInt(user_id) > 0)
        {									
            jiathis_config.url = jiathis_config.url + "&first_leader="+user_id;									
        }
        </script>        
		<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script> 
	 </div>
  </div>
  <!-- 商品大图&小图展示  end ]]--> 
</div>
<!-- 商品内容部分头部 end ]]--> 
<!-- 商品内容部分左侧侧边栏 start [[-->
<div class="product-about fn-clear">
<!-- 商品内容部分左侧侧边栏 相关分类&同类其他品牌&看了又看&picadd start [[-->
<div class="product-side fl"> 
<div class="dp-middleContentLeft"> 
          <!-- 装修左栏 --> 
          <!-- 评分  -->
          <div class="module fstore-sysdetail-business-info">
            <div class="pro-buiness clearfix"> 
              <!--详情页商家信息-->
              <div class="bus-name">
                <p class="title"><a target="_blank" href="<?php echo U('Store/index',array('store_id'=>$store[store_id]));?>" class="seller-name"><?php echo ($store["store_name"]); ?></a></p>
                <div class="server"> <span class="sev-name">客　　服：</span>
                  <div class="chat-panel fnmm-chat-panel" data-im="">
                    <div class="chat-icon general" title="在线客服"><a class="chat-online web-chat-merchant-201367" href="tencent://message/?uin=<?php echo ($store["store_qq"]); ?>&amp;Site=TPshop商城&amp;Menu=yes" target="_blank"><span>在线客服</span></a></div>
                  </div>
                </div>
              </div>
              <div class="score">
                <table border="0" class="score-table">
                  <thead>
                    <tr>
                      <th class="tr-pfinfo">评分明细</th>
                      <th class="tr-hyxb">与行业相比</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><span>描述相符：<?php echo ($commentStoreStatistics['store_desccredit']); ?></span></td>
                      <td>
                        <?php if($comparisonStatistics['desccredit_match'] > 0): ?><em class="hight"><?php echo ($comparisonStatistics['desccredit_match']); ?>%</em> <?php else: ?> <em class="low"><?php echo (abs($comparisonStatistics['desccredit_match'] )); ?>%</em><?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                      <td><span>卖家服务：<?php echo ($commentStoreStatistics['store_servicecredit']); ?></span></td>
                      <td>
                        <?php if($comparisonStatistics['servicecredit_match'] > 0): ?><em class="hight"><?php echo ($comparisonStatistics['servicecredit_match']); ?>%</em> <?php else: ?> <em class="low"><?php echo (abs($comparisonStatistics['servicecredit_match'] )); ?>%</em><?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <td><span>物流服务：<?php echo ($commentStoreStatistics['store_deliverycredit']); ?></span></td>
                      <td>
                        <?php if($comparisonStatistics['deliverycredit_match'] > 0): ?><em class="hight"><?php echo ($comparisonStatistics['deliverycredit_match']); ?>%</em> <?php else: ?> <em class="low"><?php echo (abs($comparisonStatistics['deliverycredit_match'] )); ?>%</em><?php endif; ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="enterShop">
                <div class="shopBtn"> <a class="enter-Shop" href="<?php echo U('Store/index',array('store_id'=>$store[store_id]));?>" rel="nofollow" target="_blank">进入店铺</a> 
                <a class="collect-Shop" id="favoriteStore" data-id="<?php echo ($store['store_id']); ?>" target="_blank">收藏店铺</a> </div>
              </div>
            </div>
          </div>
          <div class="module fstore-sysdetail-search-inshop">
            <div class="module-hd">
              <h3>新款</h3>
            </div>
            <div class="module-bd module-bd-bdr">
              <div>
                <ul style="overflow: hidden;">
                  <li class="keyword">
                    <label for="keyword">关键字</label>
                    <input type="text" size="18" name="keyword" autocomplete="off" value="" class="keyword-input" maxlength="18">
                  </li>
                  <li class="price">
                    <label for="price">价格</label>
                    <input type="text" name="lowPrice" size="4" value="" placeholder="¥" maxlength="13">
                    <span class="sep">-</span>
                    <input type="text" name="highPrice" size="4" value="" placeholder="¥" maxlength="13">
                  </li>
                  <li class="submit"> <a class="search-btn" href="" target="_blank">搜索</a> </li>
                  <li class="hotkeys"> 
                  	<?php if(is_array($main_cat)): foreach($main_cat as $ko=>$vo): if($ko < 3): ?><a href="<?php echo U('Store/goods_list',array('cat_id'=>$vo[cat_id],'store_id'=>$store[store_id]));?>" class="search-keyword-btn" target="_blank"><?php echo ($vo["cat_name"]); ?></a><?php endif; endforeach; endif; ?> 
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="module fstore-sysdetail-qrcode">
          	<div class="module fstore-sysdetail-qrcode">
				<div class="module-hd"><h3>二维码</h3></div>
				<div class="module-bd  module-bd-bdr">
					<div class="qrcode">
						<img src="<?php echo U('Index/store_qrcode',array('store_id'=>$store[store_id]));?>">
					</div>
				</div>
			</div>
		  </div>
          <div class="module fstore-sysdetail-category-tree">
            <div class="module-hd">
              <h3>商品分类</h3>
            </div>
            <div class="module-bd module-bd-bdr">
              <div class="cates-tree">
                <div class="node-expand">
                  <div class="node-hd"><i></i><a target="_blank" href="">所有商品分类</a></div>
                  <div class="node-sub treesort"> 
	                  <a href="<?php echo U('Store/goods_list',array('store_id'=>$store[store_id],'key'=>'sales_sum'));?>" target="_blank">按综合</a> 
	                  <a href="<?php echo U('Store/goods_list',array('store_id'=>$store[store_id],'key'=>'is_new'));?>" target="_blank">按新品</a> 
	                  <a href="<?php echo U('Store/goods_list',array('store_id'=>$store[store_id],'key'=>'shop_price'));?>" target="_blank">按价格</a> 
                  </div>
                </div>
                <?php if(is_array($main_cat)): foreach($main_cat as $key=>$vo): ?><div>
                  <div class="node-hd"><i></i><a target="_blank" href="<?php echo U('Store/goods_list',array('cat_id'=>$vo[cat_id],'store_id'=>$store[store_id]));?>"><?php echo ($vo["cat_name"]); ?></a></div>
                  <?php if($sub_cat[$vo[cat_id]] != ''): ?><ul class="node-sub">
                  		<?php if(is_array($sub_cat[$vo[cat_id]])): foreach($sub_cat[$vo[cat_id]] as $key=>$v2): ?><li>
	                  			<a target="_blank" class="db" href="<?php echo U('Store/goods_list',array('cat_id'=>$v2[cat_id],'store_id'=>$store[store_id]));?>"><span class="sub-icon"></span><span class="sub-text"><?php echo ($v2["cat_name"]); ?></span></a>
	                  		</li><?php endforeach; endif; ?>
                  	</ul><?php endif; ?>
                </div><?php endforeach; endif; ?>
              </div>
            </div>
          </div>
          <div class="module fstore-sysdetail-item-recommend">
	          <div class="module-hd"><h3>新品推荐</h3></div>
	          <div class="module-bd module-bd-bdr">
				<div class="itemlist item4line1 fix">
					<?php
 $md5_key = md5("select * from `__PREFIX__goods` where is_recommend=1 and store_id=$goods[store_id] order by goods_id desc limit 10"); $result_name = $sql_result_vo = S("sql_".$md5_key); if(empty($sql_result_vo)) { $Model = new \Think\Model(); $result_name = $sql_result_vo = $Model->query("select * from `__PREFIX__goods` where is_recommend=1 and store_id=$goods[store_id] order by goods_id desc limit 10"); S("sql_".$md5_key,$sql_result_vo,1); } foreach($sql_result_vo as $key=>$vo): ?><dl class="item ">
						<dt class="photo">
							<a target="_blank" href="<?php echo U('Goods/goodsInfo',array('id'=>$vo[goods_id]));?>"><img src="<?php echo (goods_thum_images($vo["goods_id"],400,400)); ?>" title="<?php echo (getSubstr($vo["goods_name"],0,30)); ?>" alt=""></a>
						</dt>
						<dd class="detail">
							<a target="_blank" class="item-name" href="<?php echo U('Goods/goodsInfo',array('id'=>$vo[goods_id]));?>"><?php echo (getSubstr($vo["goods_name"],0,56)); ?></a>
						</dd>
						<dd class="attr">
							<span class="symbol">¥</span><span class="price fn_sku_fin_price" fn_sku_id=""><?php echo ($vo["shop_price"]); ?></span>
						</dd>
					</dl><?php endforeach; ?>
				  </div>
				</div>
			</div>
        </div>
</div>
<!-- 商品内容部分左侧侧边栏 相关分类&同类其他品牌&看了又看&picadd end ]]--> 
<!-- 商品内容主题部分 start [[-->
<div class="product-detail fl">
<!-- 优惠套餐&任意搭配 start [[-->
<div class="detail-package detail-tabcont">
<div id="J_package_list"> </div>
<!-- 优惠套餐&任意搭配 end ]]--> 
<!-- 商品介绍&规格包装&评价&售后服务 start [[-->
<div class="product-article detail-tabcont fn-clear">
<!-- tab切换 start [[-->
<div class="detail-tab">
  <ul class="tab fn-clear J_tabFixed">
    <li class="tab-bottn"> <a href="javascript:;"></a> </li>
    <li class="tab-inner" id="tabInner"> 
    	<a href="javascript:void(0);" class="tab-toggle  tab-cur">商品介绍</a> 
    	<a href="javascript:void(0);" class="tab-toggle">属性参数</a> 
      	<a href="javascript:void(0);" class="tab-toggle">评价（<em class="total_comment"><?php echo ($commentStatistics['c0']); ?></em>）</a> 
      	<a href="javascript:void(0);" class="tab-toggle">售后服务</a>
      	<div class="addshop-tab" id="J_addshop_tab"> 
      	</div>
    </li>
  </ul>
</div>
<!-- tab切换 end ]]--> 
<!-- 商品介绍&规格包装&评价&售后服务 内容部分 start [[-->
<div class="detail-public" id="detailTop">
<!-- 商品介绍 start [[-->
<div class="detail-depict detail-box fn-clear show"> 
  <!-- 商品介绍内容部分 start [[-->
  <div class="depict-left fl"> 
    <!-- 商品介绍内容部分__规格参数 start [[ -->
    <div class="depict-text">
    <p class="depict-text-title" id="p1">商品名称：<?php echo ($goods["goods_name"]); ?></p>
      <ul class="depict-list fn-clear"> 
        <li>
          <span>品牌：</span>
          <span><a href="" title=""><?php echo ($goods['brand_name']); ?></a></span>
        </li>
        <li>
          <span>货号：</span>
          <span><?php echo ($goods["goods_sn"]); ?></span>
        </li>
        <?php if(is_array($goods_attr_list)): foreach($goods_attr_list as $k=>$v): if($k < 9): ?><li>
	          <span><?php echo ($goods_attribute[$v[attr_id]]); ?>：</span>
	          <span title="<?php echo ($v[attr_value]); ?>"><?php echo ($v[attr_value]); ?></span>
	        </li><?php endif; endforeach; endif; ?>
      </ul>
    </div>
    <div class="u-rmd-slide slide hide" id="todayRec"></div>
    <?php echo (htmlspecialchars_decode($goods["goods_content"])); ?> 
    <!--  商品介绍内容部分__规格参数 end ]] --> 
  </div>
  <!-- 商品介绍内容部分__右导航部分 end ]]-->
  <div class="depict-right fr">
    <div class="depict-aside">
      <ul class="aside-list J_tabFixed">
        <li class="aside-cur"> <a href="javascript:;" data-id="product_information"><i class="round-icon"></i>商品描述</a> </li>
      </ul>
    </div>
  </div>
  <!-- 商品介绍内容部分 end ]]--> 
</div>
<!-- 商品介绍 end ]]--> 
<!-- 规格包装 start [[-->
<div class="detail-norm detail-box hide">
  <table class="norm-table">
    <tbody>
      <tr class="title">
        <th colspan="2">属性</th>
      </tr>
      <?php if(is_array($goods_attr_list)): foreach($goods_attr_list as $k=>$v): ?><tr>
          <td><?php echo ($goods_attribute[$v[attr_id]]); ?></td>
          <td><?php echo ($v[attr_value]); ?></td>
        </tr><?php endforeach; endif; ?>
    </tbody>
  </table>
</div>
<!-- 规格包装 end ]]--> 
<!-- 评价 start [[-->
<div class="detail-assess detail-box hide">
  <div class="fn-comment" id="comment" style="">
    <div class="fn-comment-title">
      <div class="fn-mt">
        <h3 class="fl">商品评价</h3>
        <span class="c-01">（共
        <span class="red">
        <span data-user-count="1"><?php echo ($commentStatistics['c0']); ?></span>位</span>参加本商品评论）</span>
        <span class="fn-mt-a">所有评论均来自已购买本商品会员</span>
      </div>
      <div class="fn-mc fix">
        <div class="fn-mc-lt">
          <div class="c-01"> <strong>
            <span data-good-comment-pre="1"><?php echo ($commentStatistics['rate1']); ?></span>
            <b>%</b></strong>
            <p>好评率</p>
          </div>
          <dl>
            <dd>好评(
              <span data-good-comment-pre="1"><?php echo ($commentStatistics['rate1']); ?></span>%)</dd>
            <dt>
              <div data-good-bar="1" style="width: <?php echo ($commentStatistics['rate1']); ?>px;"></div>
            </dt>
            <dd>中评(
              <span data-middle-comment-pre="1"><?php echo ($commentStatistics['rate2']); ?></span>%)</dd>
            <dt>
              <div data-middle-bar="1" style="width: <?php echo ($commentStatistics['rate2']); ?>px;"></div>
            </dt>
            <dd>差评(
              <span data-low-comment-pre="1"><?php echo ($commentStatistics['rate3']); ?></span>%)</dd>
            <dt>
              <div data-low-bar="1" style="width: <?php echo ($commentStatistics['rate3']); ?>px;"></div>
            </dt>
          </dl>
        </div>
        <div class="fn-mc-ce">
          <p>达人评价：</p>
          <ul class="fn-comment-yun">
            <?php if(is_array($goodsTotalComment)): $i = 0; $__LIST__ = array_slice($goodsTotalComment,0,8,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><?php echo ($key); ?>(<?php echo ($vo); ?>)</li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
        <div class="fn-mc-rt">
          <a href="<?php echo U('Home/User/comment');?>"><button class="btn">发表评价</button></a>
          <p class="double_points">
            <span>发表评价可让购买者放心购买哦~ <br> 加精置顶还可获得人气<br></span>
          </p>
        </div>
      </div>
      <!-- /.fn-mc --> 
    </div>
    <div class="fn-comment-list">
      <div class="fn-mt fix">
        <ul id="fy-comment-list">
          <li data-t='1' class="on">全部评论(<span data-totel-comment="1"><?php echo ($commentStatistics['c0']); ?></span>)</li>
          <li data-t='2'>好评(<span data-good-comment="1"><?php echo ($commentStatistics['c1']); ?></span>)</li>
          <li data-t='3'>中评(<span data-middle-comment="1"><?php echo ($commentStatistics['c2']); ?></span>)</li>
          <li data-t='4'>差评(<span data-low-comment="1"><?php echo ($commentStatistics['c3']); ?></span>)</li>
          <li data-t='5'>晒单(<span data-image-comment="1"><?php echo ($commentStatistics['c4']); ?></span>)</li>
        </ul>
        <div class="fn-mt-bor" style="left: 0px;"></div>
      </div>
      <div class="fn-comment-not" style="display: none;"> 暂无商品评价！只有购买过该商品的用户才能进行评价哦！ </div>
      <div id="ajax_comment_return"> </div>
    </div>
  </div>
  <div class="loading_box" id="loadingBox" style="display: none;">
    <span class="loading_text"> <i class="loading_icon"></i>
    <span>载入中，请稍等...</span>
    </span>
  </div>
</div>
<!-- 评价 end ]]--> 
<!-- 售后服务 start [[-->
<div class="detail-service detail-box hide">
<!--转单非生鲜-->
	<p style="font-weight: bold;padding: 20px 0 0 30px;">本商品由TPshop网入驻商家提供配送服务，购买前请仔细阅读以下退货说明</p>
	<dl>
	<dt class="red">商家直送的商品退货流程（七天无理由退货）：</dt>
		<dd>
		  <ol>
		    <li>自买家签收商品隔日起七日内可自助提交退货申请，请直接至「<a class="sevice_url" target="_blank" href="<?php echo U('Home/User/order_list');?>">我的订单</a>」→「<a class="sevice_url" target="_blank" href="<?php echo U('Home/User/return_goods_list');?>">退订</a>」提交退货申请。</li>
		    <li>顾客依照「退订」中的退货寄件地址自行安排第三方物流或快递寄回商品，并且支付运费。</li>
		    <li>商品退回检測无误后，TPshop网将提交退款申请, 通过线上支付的订单办理退货, 实际款项会依照各银行作业时间返还至您原支付方式。</li>
		    <li>若退回商品有缺件、影响二次销售状况时，不符合退货条件, 退款作业将暂时停止，TPshop网客服人员会与您联系说明，并由商家将商品返还给您 （如对于结果有异议,可联系<a class="sevice_url" target="_blank" href="">TPshop客服咨询</a>或<a class="sevice_url" target="_blank" href="">重新发起申请退货</a>并补充相关凭证）。</li>
		  </ol>
		</dd>
		<dt class="red">商家直送的商品退货流程（有理由退货）：</dt>
		<dd>
		  <ol>
		    <li>由于商品缺件、寄错商品、产品瑕疵等原因而发起的退货，请直接至「<a class="sevice_url" target="_blank" href="<?php echo U('Home/User/order_list');?>">我的订单</a>」→「<a class="sevice_url" target="_blank" href="">退订</a>」提交退货申请。</li>
		    <li>顾客依照「<a class="sevice_url red">退订</a>」中的退货寄件地址自行安排第三方物流或快递寄回商品，并且垫付运费。</li>
		    <li>商品退回检測无误后，TPshop网将提交退款申请, 通过线上支付的订单办理退货, 实际款项会依照各银行作业时间返还至您原支付方式。同时TPshop网会补贴10元抵用券到您的TPshop网帐户以作为退货运费补偿。</li>
		    <li>若退回商品有缺件、影响二次销售状况时，不符合退货条件, 退款作业将暂时停止，TPshop网客服人员会与您联系说明，并由商家将商品返还给您 （如对于结果有异议,可连系<a class="sevice_url" target="_blank" href="">TPshop客服咨询</a>或<a class="sevice_url" target="_blank" href="">重新发起申请退货</a>并补充相关凭证）。</li>
		  </ol>
		</dd>
		<dt class="red">注意：</dt>
		<dd>
		  <ol>
		    <li>顾客办理退货后，需要自行联系物流公司将退货商品寄回TPshop网指定退货地点；该商品为TPshop入驻商家直送，暂未提供上门取件的服务，不便之处，敬请谅解。</li>
		    <li>TPshop网办理退货不收取任何手续费、入仓费等费用，退货时如遇快递公司要求收取额外费用，建议您更换其他快递。</li>
		    <li>顾客需选择快递方式将商品寄回，并支付快递费用，本商品退货不接受平邮或以到付形式寄回包裹。</li>
		    <li>由“有理由退货”而产生的TPshop运费补贴（10元抵用券）有效期为2个月。</li>
		    <li>多张订单同一包裹寄回，仅补贴一次运费。TPshop网有权对无正当理由多次退货或拒收商品的用户保留不再给予10元抵用券退货补贴的权利。</li>
		    <li>退回来的包裹中用纸条写明退货的订单号和TPshop帐号名称，才可以顺利完成退货。</li>
		    <li>退货发回来以后请顾客留存物流单号和对应快递公司，便于后续追踪退件物流信息。</li>
		  </ol>
		</dd>
		<dt class="red">温馨提醒：</dt>
		<dd>
		  <ol>
		    <li>此商品由入驻TPshop网的商家直接发货，且不支持货到付款。</li>
		    <li>商品会以第三方物流方式配送。</li>
		    <li>配送地址需在快递可送货范围内，如遇偏远地区无法送达的地方，我们会将商品送达当地最近物流点并通知顾客自提。</li>
		    <li>物品需本人签收，收到物品请务必先行检查，确认完好后再签收。</li>
		    <li>如果收货过程中，发现任何问题请第一时间联系TPshop网客服400-920-6565，我们会及时解决您的问题。</li>
		  </ol>
		</dd>
		<dt class="red">以下状况TPshop网将不接受您的退货：</dt>
		<dd>
		  <ol>
		    <li>商品非TPshop网所贩售出之商品，如：商品序号不符。</li>
		    <li>未经授权的维修、误用、碰撞、疏忽、滥用、进液、事故、改动、不正确的安装所造成的商品质量问题，或撕毁、涂改标贴、机器序号、 防伪标记。</li>
		    <li>若有索取发票未随货退回、或发票有经涂改、破损影响识别之状况。</li>
		    <li>食品类、保健品、烟酒类、化妆品、个人卫生用品、耗材、电池、胶卷、虚拟商品、软件类等商品已有拆封状况；服饰、配件类已进行修改。</li>
		    <li>商品说明书、保修卡涂改、污损、缺少未退回。</li>
		    <li>商品包装破损，配件、附件不齐全、污损等。</li>
		    <li>其他依法律/规不受理退货者，如:知识产权保护商品。</li>
		    <li>虚拟类商品，例如礼品卡，购物卡，手机充值、游戏点卡等充值类商品，以及门票、提货券、机票、旅游套餐等一次性消费服务类商品等。</li>
		  </ol>
		</dd>
	</dl>
</div>
<!-- 售后服务 end ]]-->
</div>
<!-- 商品介绍&规格包装&评价&售后服务 内容部分 end ]]-->
</div>
<!-- 商品介绍&规格包装&评价&售后服务 end ]]--> 
</div>
<!-- 商品内容主题部分 end ]]-->
</div>
<!-- 商品内容部分左侧侧边栏 end ]]-->
</div>
</div>

<!-- 弹层内容块 start [[--> 
<!-- 看了又看 -->
<div style="display:none">
      <ul id="look_see">
       <?php if(is_array($look_see)): foreach($look_see as $key=>$look): ?><li>
	     	 <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$look[goods_id]));?>" class="look-img" target="_blank"> <img src="<?php echo (goods_thum_images($look["goods_id"],200,200)); ?>" alt=""></a>
	         <h4 class="look-title">
	         	<a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$look[goods_id]));?>"><?php echo (getSubstr($look["goods_name"],0,30)); ?></a>
	         </h4>
	         <p class="look-price">
	         	<del><q class="fn-rmb">¥</q><strong class="fn-rmb-num"><?php echo ($look["market_price"]); ?></strong></del>
	         	<q class="fn-rmb">¥</q> <strong class="fn-rmb-num"><?php echo ($look["shop_price"]); ?></strong>
	         </p>
       	</li><?php endforeach; endif; ?>
     </ul>
</div>
<div class="fn-cms-footer">
  <div class="m-footer-g">
    <div class="footer-map">
      <ul class="fn-clear">
        <li class="map"><i class="footer-icon z-icon"></i><strong class="tit">正品低价</strong><br/>
          <span class="desc">正品行货 品质保障</span>
        </li>
        <li class="line"></li>
        <li class="map"><i class="footer-icon q-icon"></i><strong class="tit">品类齐全</strong><br/>
          <span class="desc">品类齐全 选择丰富</span>
        </li>
        <li class="line"></li>
        <li class="map"><i class="footer-icon k-icon"></i><strong class="tit">快速配送</strong><br/>
          <span class="desc">多仓直发 极速配送</span>
        </li>
        <li class="line"></li>
        <li class="map"><i class="footer-icon t-icon"></i><strong class="tit">售后无忧</strong><br/>
          <span class="desc">7天无理由退货</span>
        </li>
      </ul>
    </div>
    <div class="server-list">
      <ul class="fn-clear">
	    <?php
 $md5_key = md5("select * from `__PREFIX__article_cat` where parent_id = 2"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from `__PREFIX__article_cat` where parent_id = 2"); S("sql_".$md5_key,$sql_result_v,1); } foreach($sql_result_v as $k=>$v): ?><li><i class="list-icon icon<?php echo ($k+1); ?>"></i>
          <dl class="list-item">
            <dt><?php echo ($v[cat_name]); ?></dt>
            <?php
 $md5_key = md5("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1"); $result_name = $sql_result_v2 = S("sql_".$md5_key); if(empty($sql_result_v2)) { $Model = new \Think\Model(); $result_name = $sql_result_v2 = $Model->query("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1"); S("sql_".$md5_key,$sql_result_v2,1); } foreach($sql_result_v2 as $k2=>$v2): ?><dd><a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id]));?>"><?php echo ($v2[title]); ?></a></dd><?php endforeach; ?>
          </dl>
        </li><?php endforeach; ?>
        <li class="app-item">
          <p>TPshop官网</p>
          <img width="90" height="90" title="" alt="TPshop网客户端" src="/Template/pc/soubao/Static/images/qrcode_vmall_app01.png">
        </li>
      </ul>
    </div>
    <div class="site-info">
      <div class="foot-nav">
        <?php
 $md5_key = md5("select * from `__PREFIX__article` where cat_id = 5 and is_open=1"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from `__PREFIX__article` where cat_id = 5 and is_open=1"); S("sql_".$md5_key,$sql_result_v,1); } foreach($sql_result_v as $k=>$v): ?><a href="<?php echo U('Home/Article/detail',array('article_id'=>$v[article_id]));?>" target="_blank"><?php echo ($v[title]); ?></a>|<?php endforeach; ?>
	      <a href="<?php echo U('Newjoin/index');?>" target="_blank">商家入驻</a>| 
	      <a href="<?php echo U('Article/detail',array('article_id'=>19));?>" target="_blank">招商标准</a>| 
	      <a href="" style="cursor:default;text-decoration:none;">客服热线 <?php echo ($tpshop_config['shop_info_phone']); ?></a>
	  </div>
      <div class="link">
        <p>
        Copyright © 2016-2025 <?php echo ($tpshop_config['shop_info_store_name']); ?>  版权所有 保留一切权利 备案号:<?php echo ($tpshop_config['shop_info_record_no']); ?>
        
        <!--您好,请您给TPshop留个友情链接-->
        &nbsp;&nbsp;<a href="http://www.tp-shop.cn/">TPshop开源商城</a>
        <!--您好,请您给TPshop留个友情链接-->         
        </p>
      </div>
      <div class="inline-box logowall"><a href="" class="item shgs" target="_blank"></a><a href="" class="item shwl" target="_blank"></a><a href="" class="item cxwz" target="_blank"></a><a href="" class="item kxwz" target="_blank"></a><a href="" class="item hyyz" target="_blank"></a></div>
    </div>
  </div>
</div>
<script type="text/javascript" src="/Template/pc/soubao/Static/js/jquery.lazyload.js"></script>
<script type="text/javascript" src="/Template/pc/soubao/Static/js/common.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
	/*商品缩略图放大镜*/
	$(".jqzoom").jqueryzoom({
		xzoom: 500,
		yzoom: 500,
		offset: 1, 
		position: "right", 
		preload:1,
		lens:1
	});
	get_goods_price();
	replace_look();
	commentType = 1; // 评论类型
    ajaxComment(1,1);// ajax 加载评价列表
});

var store_count = <?php echo ($goods["store_count"]); ?>; // 商品起始库存	
//缩略图切换
$('.small-pic-li').each(function(i,o){
	var lilength = $('.small-pic-li').length;
	$(o).hover(function(){
		$(o).siblings().removeClass('active');
		$(o).addClass('active');
		$('#zoomimg').attr('src',$(o).find('img').attr('data-img'));
		$('#zoomimg').attr('jqimg',$(o).find('img').attr('data-big'));
		
		$('.next-btn').removeClass('disabled');
		if(i==0){
			$('.next-left').addClass('disabled');
		}
		if(i+1==lilength){
			$('.next-right').addClass('disabled');
		}
	});
})

//前一张缩略图
$('.next-left').click(function(){
	var newselect = $('.small-pic>.active').prev();
	$('.small-pic>.active').removeClass('active');
	$(newselect).addClass('active');
	$('#zoomimg').attr('src',$(newselect).find('img').attr('data-img'));
	$('#zoomimg').attr('jqimg',$(newselect).find('img').attr('data-big'));
	var index = $('.small-pic>li').index(newselect);
	if(index==0){
		$('.next-left').addClass('disabled');
	}
	$('.next-right').removeClass('disabled');
})

//后前一张缩略图
$('.next-right').click(function(){
	var newselect = $('.small-pic>.active').next();
	$('.small-pic>.active').removeClass('active');
	$(newselect).addClass('active');
	$('#zoomimg').attr('src',$(newselect).find('img').attr('data-img'));
	$('#zoomimg').attr('jqimg',$(newselect).find('img').attr('data-big'));
	var index = $('.small-pic>li').index(newselect);
	if(index+1 == $('.small-pic>li').length){
		$('.next-right').addClass('disabled');
	}
	$('.next-left').removeClass('disabled');
})

//商品介绍、规格、评论、售后切换
$('#tabInner .tab-toggle').each(function(i,o){
	$(o).click(function(){
		$(o).addClass('tab-cur');
		$(o).siblings().removeClass('tab-cur');
		$('#detailTop .detail-box').hide();
		$('#detailTop .detail-box').eq(i).show();
	})
});

//购买数量+1
$('.mins').click(function(){
	var buynum = parseInt($('.buyNum').val());
	if(buynum>1){
		$('.buyNum').val(buynum-1);
	}
	if(buynum-1 ==1){
		$('.mins').addClass('no-mins');
	}
	$('.add').removeClass('no-mins');
	return false;
});

//购买数量-1
$('.add').click(function(){
	var buynum = parseInt($('.buyNum').val());
	if(buynum<store_count){
		$('.buyNum').val(buynum+1);
	}
	if(buynum+1 == store_count){
		$('.add').addClass('no-mins');
	}
	$('.mins').removeClass('no-mins');
	return false;
});

//选择规格属性
$('.selectCtrl>li').each(function(){
	if(!$(this).hasClass('nosold')){
		$(this).click(function(){
			$(this).siblings().removeClass('select');
			$(this).siblings().children('input').prop('checked',false);
			$(this).children('input').prop('checked',true);	
			$(this).addClass('select');
			get_goods_price();
		})
	}
})

 /*** 查询商品价格*/  
 function get_goods_price()
 {	 	 	
	var goods_price = <?php echo ($goods["shop_price"]); ?>; // 商品起始价
	var spec_goods_price = <?php echo ($spec_goods_price); ?>;  // 规格 对应 价格 库存表   //alert(spec_goods_price['28_100']['price']);	
	// 如果有属性选择项
	if(spec_goods_price != null)
	{
		var goods_spec_arr = [];
		var select_str = '';
		$("input[name^='goods_spec']:checked").each(function(){
			 goods_spec_arr.push($(this).val());
			 select_str += '<span>"'+$(this).attr('rel')+'"</span>';
		});
		$('.product-opt-info').children().empty().html(select_str);
		var spec_key = goods_spec_arr.sort(sortNumber).join('_');  //排序后组合成 key
		var goods_price = spec_goods_price[spec_key]['price']; // 找到对应规格的价格		
		var store_count = spec_goods_price[spec_key]['store_count']; // 找到对应规格的库存
	}
	var flash_sale_price = parseFloat("<?php echo ($goods['flash_sale']['price']); ?>");
        (flash_sale_price > 0) && (goods_price = flash_sale_price);            
        
         $("#goods_price").html(goods_price); // 变动价格显示
 }
 
//用作 sort 排序用
function sortNumber(a,b) 
{ 
	return a - b; 
} 

// 好评差评 切换
$("#fy-comment-list").children().each(function(i,o){
	$(o).click(function(){
		$(o).siblings().removeClass('on');	
		$(o).addClass('on');
		commentType = $(o).data('t');// 评价类型   好评 中评  差评
		$('.fn-mt-bor').css('left',(commentType-1)*115);
		ajaxComment(commentType,1);
	});
});
								
// 用ajax分页显示评论
function ajaxComment(commentType,page){
     $.ajax({
         type : "GET",
         url:"/index.php?m=Home&c=goods&a=ajaxComment&goods_id=<?php echo ($goods['goods_id']); ?>&commentType="+commentType+"&p="+page,//+tab,
         success: function(data){
             $("#ajax_comment_return").html('');
             $("#ajax_comment_return").append(data);
         }
     });
}
 
//看了又看切换
var tmpindex = 0; 
var look_see_length = $('#look_see').children().length;
function replace_look(){
	var listr='';
	if(tmpindex*3>=look_see_length) tmpindex = 0;
	//console.log(look_see_length);
	$('#look_see').children().each(function(i,o){
		if((i>=tmpindex*3) && (i<(tmpindex+1)*3)){
			listr += '<li>'+$(o).html()+'</li>';
		}
	});
	tmpindex++;
	$('#see_and_see').empty().append(listr);
} 
//收藏商品
$('#collectLink').click(function(){
	if(getCookie('user_id') == ''){
		pop_login();
	}else{
		$.ajax({
			type:'post',
			dataType:'json',
			data:{goods_id:$('input[name="goods_id"]').val()},
			url:"<?php echo U('Home/Goods/collect_goods');?>", 
			success:function(res){
				if(res.status == 1){
					layer.msg('成功添加至收藏夹', {icon: 1});
				}else{
					layer.msg(res.msg, {icon: 3});
				}
			}
		});
	}
});

//收藏店铺
$('#favoriteStore').click(function () {
  if (getCookie('user_id') == '') {
    pop_login();
  } else {
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {store_id: $(this).attr('data-id')},
      url: "<?php echo U('Home/Store/collect_store');?>",
      success: function (res) {
        if (res.status == 1) {
          layer.msg('成功添加至收藏夹', {icon: 1});
        } else {
          layer.msg(res.msg, {icon: 3});
        }
      }
    });
  }
});

//店铺内分类伸缩
$('.node-hd').each(function(i,o){
	$(o).find('i').click(function(){
		if($(o).parent().hasClass('node-expand')){
			$(o).parent().removeClass('node-expand')
		}else{
			$(o).parent().addClass('node-expand')
		}
	});
});

function pop_login(){
    layer.open({
        type: 2,
        title: '<b>登陆TPshop网</b>',
        skin: 'layui-layer-rim',
        shadeClose: true,
        shade: 0.5,
        area: ['490px', '460px'],
        content: "<?php echo U('Home/User/pop_login');?>", 
    });
}
</script>
<!--------收货地址，物流运费-开始-------------->
<script src="/Template/pc/soubao/Static/js/location.js"></script>
<!--------收货地址，物流运费--结束-------------->
<script src="/Public/js/jqueryUrlGet.js"></script><!--获取get参数插件-->
<script> set_first_leader(); //设置推荐人 </script>
</body>
</html>
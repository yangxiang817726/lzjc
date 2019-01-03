<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
        #allmap{width:100%;height:600px;}
    </style>
    <link rel="stylesheet" type="text/css" href="/Public/plugins/uploadify/uploadify.css" />
    <script type="text/javascript" src="/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6036MxVB7ZUFSGtCm2DZedkjIVA502i0"></script>
    <script type="text/javascript"
            src="/public/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/public/js/bootstrap.min.css"/>
</head>
<body>
<br/>
<table style="position: fixed;
    z-index: 99999;
    top: 10px;">
    <tr>
        <td>
            <input style="width:400px;" type="text" class="form-control" placeholder="请输入需要检索的地址" name="address" id="address" onkeyup="searchAddress();" value="<?php echo ($address); ?>"/>
            <input type="hidden" id="addressLonglat" name="addressLonglat" value="<?php echo ($longlat); ?>"/>
        </td>
        <td style="width: 10px;">

        </td>
        <td>
            <button type="button" class="btn btn-success btn-s-xs" onclick="setAddress();">设为公司地址
                <button type="button" class="btn btn-success btn-s-xs" onclick="closeA();">取消
            </button>
        </td>
    </tr>

</table>
<div id="allmap"></div>
</body>
<script type="text/javascript">

    var map = new BMap.Map("allmap");
    var point =new BMap.Point(<?php echo ($longlat); ?>);
    map.enableScrollWheelZoom(true);
    map.centerAndZoom(point, 15);

    var local = new BMap.LocalSearch(map, {
        renderOptions:{map: map}
    });
    function searchAddress() {
        var address = $("#address").val();
        if (address != '' && address != null && typeof(address) != "undefined") {
            local.search(address);
        }
    }
    //根据IP定位到城市
    function myFun(result){
        var longlat = '<?php echo ($longlat); ?>';
        if (longlat != '' && longlat != null && typeof(longlat) != "undefined") {
            map.centerAndZoom(new BMap.Point(longlat.split(",")[0], longlat.split(",")[1]), 18);
            var marker = new BMap.Marker(new BMap.Point(longlat.split(",")[0], longlat.split(",")[1]));
            map.addOverlay(marker);
        }else {
            var cityName = result.name;
            map.setCenter(cityName);
        }
    }
    var marker = new BMap.Marker(point);  // 创建标注
    map.addOverlay(marker);               // 将标注添加到地
    var geoc = new BMap.Geocoder();
    <?php if(empty($longlat)): ?>var address = $("#address").val();
    if (address != '' && address != null && typeof(address) != "undefined") {
        local.search(address);
    }<?php endif; ?>
    map.addEventListener("click", function(e){
        //清楚地图上的marker
        map.clearOverlays();
        //通过点击百度地图，可以获取到对应的point, 由point的lng、lat属性就可以获取对应的经度纬度
        var pt = e.point;
        var marker = new BMap.Marker(new BMap.Point(pt.lng, pt.lat));
        map.addOverlay(marker);
        geoc.getLocation(pt, function(rs){
            //addressComponents对象可以获取到详细的地址信息
            var addComp = rs.addressComponents;
            var site = addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber;
            $("#address").val(site);
            map.centerAndZoom(new BMap.Point(pt.lng, pt.lat), 18);
            //将对应的HTML元素设置值
            $("#addressLonglat").val(pt.lng+","+pt.lat);
        });
    });
    //关闭遮罩层，返回地址信息给父页面
    function setAddress(){

        parent.$("#address").val($("#address").val());
        parent.$("#addressLonglat").val($("#addressLonglat").val());

        $(window.parent.document).find("iframe.uploadframe").remove();
    }
    function closeA(){

        $(window.parent.document).find("iframe.uploadframe").remove();
    }
</script>
</html>
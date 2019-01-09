var server = require('../../../utils/server');
Page({
	data: {
		orderId: ''
	},
	onLoad: function (options) {
		
		var app = getApp();
		var order = app.globalData.order;
		var orderId = order.order_id;
    this.setData({ order: order, orderId: orderId});
		console.log('order id : ' + orderId);

    server.getJSON('/Cart/getWXPayData/user_id/' + 1 +"/order_id/" + orderId,function(res){
app.globalData.wxdata = res.data.result;
		});
	},
	pay: function () {
		var app = getApp();
		
		var wxdata =       app.globalData.wxdata.wdata
		var timeStamp = wxdata.timeStamp + "";
		var nonceStr = wxdata.nonceStr + "";
		var package1 = wxdata.package
		var sign = wxdata.sign;
			 wx.requestPayment({
			    
			    'nonceStr': nonceStr,
		       'package': package1,
			    'signType': 'MD5',
				'timeStamp': timeStamp,
			    'paySign': sign,
			    'success':function(res){
			    		console.log(res);
							wx.showToast({ title: '支付成功', icon: 'success', duration: 2000 })
                setTimeout(function doHandler(){
                  wx.navigateBack({
                    delta: 1, // 回退前 delta(默认为1) 页面
                    success: function(res){
                      // success
                    },
                    fail: function() {
                      // fail
                    },
                    complete: function() {
                      // complete
                    }
                  })
                },2000);
			    },
			    'fail':function(res){
			    		console.log(res);
							wx.showToast({ title: '支付失败', icon: 'success', duration: 2000 })
                setTimeout(function doHandler(){
                  wx.navigateBack({
                    delta: 1, // 回退前 delta(默认为1) 页面
                    success: function(res){
                      // success
                    },
                    fail: function() {
                      // fail
                    },
                    complete: function() {
                      // complete
                    }
                  })
                },2000);
			    }
			 })

			// update order
			/*var query = new AV.Query('Order');
			query.get(this.data.orderId).then(function (order) {
				order.set('status', 1);
				order.save();
				console.log('status: ' + 1);
			}, function (err) {
				
			});*/
	},
  	
  xianxia_pay: function () {      //线下支付
    var user_id = getApp().globalData.userInfo.user_id
    var order_id = this.data.orderId
    server.getJSON('/Cart/xianxia_pay/orderid/' + order_id + "/user_id/" + user_id, function (res) {
      if (res.status == -1) {
        wx.showToast({
          title: '操作失败',
          icon: 'success',
          duration: 2000
        })
      } else {
        wx.showToast({
          title: '等待商家确认',
          icon: 'success',
          duration: 2000
        })
      }


    })

  }
})
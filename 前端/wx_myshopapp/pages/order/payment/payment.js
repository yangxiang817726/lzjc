
Page({
	data: {
		orderId: ''
	},
	onLoad: function (options) {
		var orderId = options.order_id;
		var app = getApp();
		var order = app.globalData.order;
		var wxdata = app.globalData.wxdata
		console.log('order id : ' + orderId);
		this.setData({
			order: order,
			wxdata:wxdata,
      orderId:orderId
		})
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
				wx.showToast({
			  title: '支付成功',
			  icon: 'success',
			  duration: 2000
			})	
			    		setTimeout(function () {
               
			   
				wx.switchTab({
			url: "../../member/index/index"
		});
			}, 2000);
			    },
			    'fail':function(res){
			    		wx.showToast({
			  title: '支付失败',
			  icon: 'success',
			  duration: 2000
			})
			    }
			 })

			
	},
  	xianxia_pay: function () {      //线下支付
     var user_id = getApp().globalData.userInfo.user_id
     var order_id = this.data.orderId
     server.getJSON('/Cart/xianxia_pay/master_order_sn/' + order_id + "/user_id/" + user_id, function (res) {
        if(res.status==-1){
          wx.showToast({
            title: res.msg,
            icon: 'success',
            duration: 2000
          })
        }else{
          wx.showToast({
            title: res.msg,
            icon: 'success',
            duration: 2000
          })
        }
       

      })
      
  }
})

var server = require('./utils/server');
var md5 = require('./utils/md5.js');
// 授权登录 
App({
	onLaunch: function () {
    // 展示本地存储能力
    var logs = wx.getStorageSync('logs') || []
    logs.unshift(Date.now())
    wx.setStorageSync('logs', logs)
		// auto login via SDK
		var that = this;
		//AV.User.loginWithWeapp();
		// 设备信息
    that.login();
		wx.getSystemInfo({
			success: function (res) {
				that.screenWidth = res.windowWidth;
				that.pixelRatio = res.pixelRatio;
			}
		});
	},
  globalData: {
    'openid': null,
    'userInfo': null,
    'login': false,
    'url': "http://www.fengshop.com/index.php/WXAPI"
  },
  login: function () {
    var that = this;
    var user_info = wx.getStorageSync('user_info');

    console.log('1');
    console.log(user_info);

    if (!user_info) {//是否存在用户信息，如果不存在跳转到首页
      wx.showToast({
        title: '用户信息获取失败',
        icon: 'none',
        duration: 1500,
      })
      setTimeout(function () {
        wx.navigateTo({
          url: '/pages/load/load',
        })
      }, 1500)
    }
  },
	getOpenId: function (cb) {
		wx.login({
			success: function (res) {
				if (res.code) {
          console.log(res.code)
          server.getJSON("/User/getOpenid", { url:'https://api.weixin.qq.com/sns/jscode2session?appid=wx9b11a4dbba7383a4&secret=4ec16aaf92801483167c4245063ee84e&js_code=' + res.code + '&grant_type=authorization_code&code=' + res.code },function(res){
// 获取openId
							var openId = res.data.openid;
							// TODO 缓存 openId
							var app = getApp();
							var that = app;
							that.globalData.openid = openId;

							//验证是否关联openid

							typeof cb == "function" && cb()
					});
					//发起网络请求
				}}});


	}

})

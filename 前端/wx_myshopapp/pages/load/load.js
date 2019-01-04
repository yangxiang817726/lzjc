var app = getApp();
Page({
  data: {
    logo: '',
    name: '',
    url: app.globalData.url,
  },
  onLoad: function (options) {
    var that = this;
    app.getOpenId();
  },

  //获取用户信息并且授权
  getUserInfo: function(e){
    var userInfo = e.detail.userInfo;
    userInfo.spid = app.globalData.spid;
    wx.login({
      success: function (res) {
        if (res.code) {
          //userInfo.code = res.code;
          userInfo.open_id = app.globalData.openid;
          wx.request({
            url: app.globalData.url + '/User/register',
            method: 'get',
            dataType  : 'json',
            data: {
              info: userInfo
            },
            success: function (res) {
              console.log(res.data.res);
              wx.setStorageSync('user_info',res.data.res);
              app.globalData.userInfo = res.data.res;
              app.globalData.login = true;
              console.log(app.globalData);
              if (app.globalData.openPages != '' && app.globalData.openPages != undefined) {//跳转到指定页面
                wx.navigateTo({
                  url: app.globalData.openPages
                })
              } else {//跳转到首页
                if(res.data.page){
                    wx.navigateTo({
                        url: res.data.page
                    })
                }else{
                    wx.reLaunch({
                        url: '/pages/index/index'
                    })
                }
              }
            }
          })
        } else {
          console.log('登录失败！' + res.errMsg)
        }
      }
    })
  },
})
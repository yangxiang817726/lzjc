var server = require('../../../utils/server');
Page({
	isDefault: false,
	formSubmit: function(e) {
		// user 
		var mobile = this.data.mobile;
		// realname
		// mobile
		var address = this.data.address;
    var shenfen = this.data.shenfen;
    var password = this.data.password;

		//var user_id = getApp().globalData.userInfo.user_id
		var country = 1;

    var user_id = getApp().globalData.userInfo.user_id;
		var province = this.data.provinceObjects[this.data.provinceIndex].id;

		var city = this.data.cityObjects[this.data.cityIndex].id;

		var district = this.data.regionObjects[this.data.regionIndex].id;
		

    var province1 = this.data.province1;

    var city1 = this.data.city1;

    var district1 = this.data.district1;

		var that = this;
    server.postJSON('/User/addUsersj/',{user_id:user_id,shenfen:shenfen,mobile:mobile,password:password,address:address,province:province,city:city,district:district,province1:province1,city1:city1,district1:district1},function(res){

if(res.data.status == 1)
			{
				wx.showToast({
        title: res.data.msg,
				duration: 1000
			});


			if(that.data.returnTo == 1)
            setTimeout(function () {
				wx.navigateTo({
			url: '../../order/ordersubmit/index'
		});
			}, 1000);
            else
			{
				wx.navigateBack();
			}
			}


		});


		
	},
	nameChange: function(e) {
		
		var value = e.detail.value;
		
		this.setData({
			consignee: value
		});
	},
	addressChange: function(e) {
		
		var value = e.detail.value;
		
		this.setData({
			address: value
		});
	},
  shenfenChange : function(e) {
		
		var value = e.detail.value;
		
		this.setData({
			shenfen: value
		});
	},
  passwordChange: function (e) {

    var value = e.detail.value;

    this.setData({
      password: value
    });
  },
  phoneChange: function (e) {

    var value = e.detail.value;

    this.setData({
      mobile: value
    });
  },
	yzChange: function(e) {
		
		var value = e.detail.value;
		
		this.setData({
			zipcode: value
		});
	},
	data: {
		current: 0,
		province: [],
		city: [],
		region: [],
		town: [],
		provinceObjects: [],
		cityObjects: [],
		regionObjects: [],
		townObjects: [],
		areaSelectedStr: '请选择省市区',
    areaSelectedStr1: '请选择省市区',
		maskVisual: 'hidden',
		provinceName: '请选择'
	},
	getArea: function (pid, cb) {
		var that = this;
		
		server.getJSON('/User/getArea/parent_id/' + pid,function(res){
			cb(res.data.result);
		})
	},
	onLoad: function (options) {
		var returnTo = options.returnTo;
		this.setData({returnTo:returnTo});
		var that = this;
		// load province
		this.getArea(0, function (area) {
			var array = [];
			for (var i = 0; i < area.length; i++) {
				array[i] = area[i].name;
			}
			that.setData({
				province: array,
				provinceObjects: area
			});
		});
		// if isDefault, address is empty
		this.setDefault();
		// this.cascadePopup();
		this.loadAddress(options);
		// TODO:load default city...
	},
	loadAddress: function (options) {
		var that = this;
		if (options.objectId != undefined) {
			// 第一个参数是 className，第二个参数是 objectId
		  	var address = AV.Object.createWithoutData('Address', options.objectId);
		  	address.fetch().then(function () {
		  		that.setData({
		  			address: address,
		  			areaSelectedStr: address.get('province') + address.get('city') + address.get('region')
		  		});
			}, function (error) {
			    // 异常处理
			});
		}
	},
	setDefault: function () {
		var that = this;
		var user = AV.User.current();
		// if user has no address, set the address for default
		var query = new AV.Query('Address');
		query.equalTo('user', user);
		query.count().then(function (count) {
			if (count <= 0) {
				that.isDefault = true;
			}
		});
	},
	cascadePopup: function() {
		var animation = wx.createAnimation({
			duration: 500,
			timingFunction: 'ease-in-out',
		});
		this.animation = animation;
		animation.translateY(-285).step();
		this.setData({
			animationData: this.animation.export(),
			maskVisual: 'show',
      daohuo:'1',
		});
	},
  cascadePopup1: function () {
    var animation = wx.createAnimation({
      duration: 500,
      timingFunction: 'ease-in-out',
    });
    this.animation = animation;
    animation.translateY(-285).step();
    this.setData({
      animationData: this.animation.export(),
      maskVisual: 'show',
      daohuo: '2'
    });
  },
	cascadeDismiss: function () {
		this.animation.translateY(285).step();
		this.setData({
			animationData: this.animation.export(),
			maskVisual: 'hidden'
		});
	},
	provinceTapped: function(e) {
    	// 标识当前点击省份，记录其名称与主键id都依赖它
    	var index = e.currentTarget.dataset.index;
    	// current为1，使得页面向左滑动一页至市级列表
    	// provinceIndex是市区数据的标识
    	this.setData({
    		provinceName: this.data.province[index],
    		regionName: '',
    		townName: '',
    		provinceIndex: index,
    		cityIndex: -1,
    		regionIndex: -1,
    		townIndex: -1,
    		region: [],
    		town: []
    	});
    	var that = this;
    	//provinceObjects是一个LeanCloud对象，通过遍历得到纯字符串数组
    	// getArea方法是访问网络请求数据，网络访问正常则一个回调function(area){}
    	this.getArea(this.data.provinceObjects[index].id, function (area) {
    		var array = [];
    		for (var i = 0; i < area.length; i++) {
    			array[i] = area[i].name;
    		}
			// city就是wxml中渲染要用到的城市数据，cityObjects是LeanCloud对象，用于县级标识取值
			that.setData({
				cityName: '请选择',
				city: array,
				cityObjects: area
			});
			// 确保生成了数组数据再移动swiper
			that.setData({
				current: 1
			});
		});
    },
    cityTapped: function(e) {
    	// 标识当前点击县级，记录其名称与主键id都依赖它
    	var index = e.currentTarget.dataset.index;
    	// current为1，使得页面向左滑动一页至市级列表
    	// cityIndex是市区数据的标识
    	this.setData({
    		cityIndex: index,
    		regionIndex: -1,
    		townIndex: -1,
    		cityName: this.data.city[index],
    		regionName: '',
    		townName: '',
    		town: []
    	});
    	var that = this;
    	//cityObjects是一个LeanCloud对象，通过遍历得到纯字符串数组
    	// getArea方法是访问网络请求数据，网络访问正常则一个回调function(area){}
    	this.getArea(this.data.cityObjects[index].id, function (area) {
    		var array = [];
    		for (var i = 0; i < area.length; i++) {
    			array[i] = area[i].name;
    		}
			// region就是wxml中渲染要用到的城市数据，regionObjects是LeanCloud对象，用于县级标识取值
			that.setData({
				regionName: '请选择',
				region: array,
				regionObjects: area
			});
			// 确保生成了数组数据再移动swiper
			that.setData({
				current: 2
			});
		});
    },
    regionTapped: function(e) {
    	// 标识当前点击镇级，记录其名称与主键id都依赖它
    	var index = e.currentTarget.dataset.index;
    	// current为1，使得页面向左滑动一页至市级列表
    	// regionIndex是县级数据的标识
    	this.setData({
    		regionIndex: index,
    		townIndex: -1,
    		regionName: this.data.region[index],
    		townName: ''
    	});
    	var that = this;
    	//townObjects是一个LeanCloud对象，通过遍历得到纯字符串数组
    	// getArea方法是访问网络请求数据，网络访问正常则一个回调function(area){}
    	this.getArea(this.data.regionObjects[index].id, function (area) {
			// 假如没有镇一级了，关闭悬浮框，并显示地址
			if (area.length == 0) {
				var areaSelectedStr = that.data.provinceName + that.data.cityName + that.data.regionName;

        var daohuo = that.data.daohuo;
        if (daohuo == 2) {
          that.setData({
            areaSelectedStr1: areaSelectedStr,
            province1: that.data.provinceObjects[that.data.provinceIndex].id,
            city1: that.data.cityObjects[that.data.cityIndex].id,
            district1: that.data.regionObjects[that.data.regionIndex].id
          });

        } else {
          that.setData({
            areaSelectedStr: areaSelectedStr
          });
        }
				that.cascadeDismiss();
				return;
			}
			var array = [];
			for (var i = 0; i < area.length; i++) {
				array[i] = area[i].name;
			}
			// region就是wxml中渲染要用到的县级数据，regionObjects是LeanCloud对象，用于县级标识取值
			that.setData({
				townName: '请选择',
				town: array,
				townObjects: area
			});
			// 确保生成了数组数据再移动swiper
			that.setData({
				current: 3
			});
		});
    },
    townTapped: function (e) {
    	// 标识当前点击镇级，记录其名称与主键id都依赖它
    	var index = e.currentTarget.dataset.index;
    	// townIndex是镇级数据的标识
    	this.setData({
    		townIndex: index,
    		townName: this.data.town[index]
    	});
    	var areaSelectedStr = this.data.provinceName + this.data.cityName + this.data.regionName + this.data.townName;

      var daohuo = this.data.daohuo;
      if(daohuo==2){
        this.setData({
          areaSelectedStr1: areaSelectedStr,
          province1 : this.data.provinceObjects[this.data.provinceIndex].id,
          city1: this.data.cityObjects[this.data.cityIndex].id,
          district1: this.data.regionObjects[this.data.regionIndex].id
        });

      }else{
        this.setData({
          areaSelectedStr: areaSelectedStr
        });  
      }
    	this.cascadeDismiss();
    },
    currentChanged: function (e) {
    	// swiper滚动使得current值被动变化，用于高亮标记
    	var current = e.detail.current;
    	this.setData({
    		current: current
    	});
    },
    changeCurrent: function (e) {
    	// 记录点击的标题所在的区级级别
    	var current = e.currentTarget.dataset.current;
    	this.setData({
    		current: current
    	});
    }
})
<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx12e7532c14cde217", "aa7df34e2a43db49155cf9138bfba7e4");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>微信JS-SDK的使用</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <link rel="stylesheet" href="css/mui.min.css">
  <script src="js/mui.min.js"></script>
  <script src="js/zepto-1.1.6.min.js"></script>
  <style>
      body{
          padding: 8px;
      }
      img{
          width: 200px;
          height: 100px;
      }
      .row{
          height: 50px;
          width: 98%;
          padding: 5px 0;
          text-align: center;   
          margin: 0 auto;
          overflow: auto;
      }
      button{
          width: 100%;
      }
  </style>
</head>
<body>
    <div class="row"><button type="button" id="btn" class="mui-btn mui-btn-primary">chooseImage(上传图片接口)</button></div>
    <div id="box"></div>
    <div class="row"><button type="button" id="checkJsApi" class="mui-btn mui-btn-primary">checkJsApi(判断当前客户端是否支持JS接口)</button></div>
    <div class="row"><button type="button" id="onMenuShareTimeline" class="mui-btn mui-btn-primary">onMenuShareTimeline(分享到朋友圈)</button></div>
    <div class="row"><button type="button" id="previewImage" class="mui-btn mui-btn-primary">previewImage(预览图片)</button></div>
    <div class="row"><button type="button" id="getNetworkType" class="mui-btn mui-btn-primary">getNetworkType(获取网络状态接口)</button></div>
    <div class="row"><button type="button" id="openLocation" class="mui-btn mui-btn-primary">openLocation(使用微信内置地图查看位置接口)</button></div>
    <div class="row"><button type="button" id="scanQRCode" class="mui-btn mui-btn-primary">scanQRCode(调起微信扫一扫接口)</button></div>
    <div class="mui-switch">
		  <div class="mui-switch-handle"></div>
		</div>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */

    //   禁止分享
    // function onBridgeReady(){
    //     WeixinJSBridge.call('hideOptionMenu');
    // }
    // if (typeof WeixinJSBridge == "undefined"){
    //     if( document.addEventListener ){
    //         document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
    //     }else if (document.attachEvent){
    //         document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
    //         document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
    //     }
    // }else{
    //     onBridgeReady();
    // }
  
  mui('.mui-switch')['switch']();
  
  wx.config({
    // debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
      "chooseImage",
      "onMenuShareTimeline",
      "onMenuShareAppMessage",
      "onMenuShareQQ",
      "onMenuShareWeibo",
      "previewImage",
      "openLocation",
      "uploadImage",
      "scanQRCode",
      'hideMenuItems'
    ]
  });
  wx.ready(function () {

    // 隐藏分享到qq
    // wx.hideMenuItems({
    //     menuList: ['menuItem:share:qq'], // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
    //     success:function(res){
    //         alert("隐藏");
    //     }
    // });

    wx.onMenuShareTimeline({
        title: '分享到朋友圈测试', // 分享标题
        link: 'http://1.chenyt.applinzi.com', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        imgUrl: 'https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1500538796&di=d06a353e54a4a5a6897283019e02c1e2&src=http://pic.58pic.com/58pic/11/72/81/58p58PICBwS.jpg', // 分享图标
        success: function () { 
            // 用户确认分享后执行的回调函数
            alert('成功');
        },
        cancel: function () { 
            // 用户取消分享后执行的回调函数
        }
    });

    wx.onMenuShareQQ({
        title: '分享到qq', // 分享标题
        link: 'http://1.chenyt.applinzi.com', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        desc: '分享到qq描述',
        imgUrl: 'https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1500538796&di=d06a353e54a4a5a6897283019e02c1e2&src=http://pic.58pic.com/58pic/11/72/81/58p58PICBwS.jpg', // 分享图标
        success: function () { 
            // 用户确认分享后执行的回调函数
            alert('成功');
        },
        cancel: function () { 
            // 用户取消分享后执行的回调函数
        }
    });


    // 在这里调用 API
    //选择手机的图片
    $('#btn').on('touchstart', function(){
        wx.chooseImage({
            count: 9, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                //将图片显示至box盒子
                //var str = "";
                //for (var i = 0; i < localIds.length; i++) {
                //    var img = document.createElement('img');
                //    img.src = localIds[i];
                //    $('#box').append(img);
                //}
                
                //上传图片接口
                wx.uploadImage({
                    localId: localIds[0], // 需要上传的图片的本地ID，由chooseImage接口获得
                    isShowProgressTips: 1, // 默认为1，显示进度提示
                    success: function (res) {
                        var serverId = res.serverId; // 返回图片的服务器端ID
                    }
                });
            }
        });
    });
      
    //判断当前客户端版本是否支持指定JS接口
    $('#checkJsApi').on('touchstart', function(){
    	 wx.checkJsApi({
            jsApiList: ['chooseImage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
            success: function(res) {
                // 以键值对的形式返回，可用的api值true，不可用为false
                // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
                alert(res.errMsg);
            }
        });
    });
    
    //分享到朋友圈
    $('#onMenuShareTimeline').on('touchstart', function(){
    	 wx.onMenuShareTimeline({
            title: '分享到朋友圈测试', // 分享标题
            link: 'http://1.chenyt.applinzi.com', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: 'https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1500538796&di=d06a353e54a4a5a6897283019e02c1e2&src=http://pic.58pic.com/58pic/11/72/81/58p58PICBwS.jpg', // 分享图标
            success: function () { 
                // 用户确认分享后执行的回调函数
                alert('成功');
            },
            cancel: function () { 
                // 用户取消分享后执行的回调函数
            }
        });
    });
      
    //预览图片接口
    $('#previewImage').on('touchstart', function(){
        wx.previewImage({
            current: 'https://hbimg.b0.upaiyun.com/189b0722587c4b5141f1123902d5dcf91c7c5691d679-O2WPP0_fw658', // 当前显示图片的http链接
            urls: [// 需要预览的图片http链接列表
            	'https://hbimg.b0.upaiyun.com/189b0722587c4b5141f1123902d5dcf91c7c5691d679-O2WPP0_fw658',
            	'https://hbimg.b0.upaiyun.com/d23869e769b3843fb9d110693db3b8763e1f2ba72b47b-2ZvLHN_fw658',
                'https://hbimg.b0.upaiyun.com/8644401a2013fcb49dd9e87b7ed8fdd6e0fea21b1da0e-JH05It_fw658'
            ] 
        });
    });
      
    //获取网络状态接口
    $('#getNetworkType').on('touchstart', function(){
        wx.getNetworkType({
            success: function (res) {
                var networkType = res.networkType; // 返回网络类型2g，3g，4g，wifi
            }
        });
    });

    //使用微信内置地图查看位置接口
    $('#openLocation').on('touchstart', function(){
        wx.openLocation({
            latitude:  -23.03, // 纬度，浮点数，范围为90 ~ -90
            longitude: -113.75, // 经度，浮点数，范围为180 ~ -180。
            name: '不知道哪里', // 位置名
            address: '乱定位的', // 地址详情说明
            scale: 14, // 地图缩放级别,整形值,范围从1~28。默认为最大
            infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
        });
    });

    //调起微信扫一扫接口
    $('#scanQRCode').on('touchstart', function(){
        wx.scanQRCode({
            needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
            scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
            success: function (res) {
           		var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                // window.location.href = result;
                alert(result)
        	}
        });
    });
    
    wx.error(function(res){
    		alert(res);
    })
       
  });
</script>
</html><!--

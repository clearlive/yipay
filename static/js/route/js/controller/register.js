moduleApp.controller("RegisterController",function($scope,$rootScope,$http,$location,$timeout){
    /*协议框的初始信息*/
//    $scope.agreeConf = {
//        showAgreementContent: false
//    }
    $scope.tipConf = {
        showTipContent: false
    };
//    $scope.showAgreement = function(){
//        $scope.agreeConf.showAgreementContent = true;
//    }
    $scope.register = {};
    $scope.register.type = 2;
    $scope.logoText = "点击注册";
    $scope.logoTextFn = function(){
        $scope.logoText == "点击注册" ?
            ($scope.logoText = "注册中...", $scope.isLogin = true)
            : ($scope.logoText = "点击注册", $scope.isLogin = false);
    };
    $scope.keyLogin = function($event){
        if($event.keyCode == 13) $scope.registerSubmit();
    };
    //注册动画
    $scope.$all = $('.btn-group-type button');
    $scope.$btnActive = $('.btn-active');
    $scope.register.type = 2;
    $scope.changeType = function($event, index){
        $scope.$all.removeClass('change');
        $scope.$cur = $scope.$all.eq(index);
        $scope.$btnActive.animate({
            left: $scope.$cur.outerWidth() * index + 5
        }, 250);
        $timeout(function() {
             $scope.$cur.addClass('change');
        }, 150);
        if(index==0){
            $scope.register.type = 2;//个人1，企业2
        }else{
            $scope.register.type = 1;//个人1，企业2
        }

    };
    /*点击注册按钮*/
    $scope.registerSubmit = function(){
        if($scope.registerForm.$invalid) return false;
        $scope.logoTextFn();
        $http({
            method: "POST",
            url: $rootScope.basePath+'regist.do',
            data: $.param($scope.register),
            headers:{
                'Content-Type':'application/x-www-form-urlencoded'
            }
        })
        .success(function(data){
            if(data.respCode == "failure_session"){
                $location.path('/login');
            }else{
                if(data.respCode == "success"){
                    $rootScope.registerName=$scope.register.username;
                    $scope.tipConf.showTipContent = true;
                    $scope.tipConf.src = "image/outer-yes.png";
                    $scope.tipConf.title =$rootScope.registerName+",欢迎您使用聚合平台！"  ;
                    $scope.tipConf.subtitle ="请登录您的邮箱，激活账号，激活信息24小时内有效！"  ;
                    $scope.tipConf.clickfunction=function(){
                        var mail=$scope.register.username.split('@')[1];
                        window.open("http://mail."+mail)
                    }
                    $scope.logoTextFn();
                }else{
                    $rootScope.registerErrorReason=data.respMsg;
                    $scope.tipConf.showTipContent = true;
                    $scope.tipConf.src = "image/outer-error.png";
                    $scope.tipConf.title ="对不起，注册失败，请重新注册"  ;
                    $scope.tipConf.subtitle ="失败原因,"+ data.respMsg ;
                    $scope.tipConf.clickfunction=function(){
                        $location.path('/register');
                    };
                    $scope.logoTextFn();
                }
            }
        })
    }

})



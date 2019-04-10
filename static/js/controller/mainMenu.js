/*var mainMenuModule=angular.module("mainMenuModule",[]);*/
moduleApp.controller('MainMenuController',function($rootScope,$scope,$http,$location, cookies,$state){
    $rootScope.jurisdiction={}
   // $rootScope.realNameRoot={}
    /*获取邮箱*/
//    $http({
//        method:"POST",
//        url:$rootScope.basePath+"mchInfo/mchInfo.do",
//        dataType:'json',
//        headers : {
//            'Content-Type': 'application/x-www-form-urlencoded'
//        }
//    })
//        .success(function(data) {
//            if (data.respCode=='failure_session') {
//                $scope.$emit("NOTDOWNLOADS");
//                $location.path('/index');
//            } else {
//                $scope.$emit("DOWNLOADS");
//                $rootScope.permissionMap=data.dataObject.permissionMap;
//                $rootScope.merchantResp=data.dataObject.merchantResp;
//                $rootScope.realNameRoot=data.dataObject.merchantResp;
//                $rootScope.accountNo=data.dataObject.username;
//                if(data.dataObject.merchantResp.agentModel==5){
//                    $rootScope.permissionShopCSH=true;
//                }else{
//                    $rootScope.permissionShopCSH=false;
//                }
//
//                if(data.dataObject.merchantResp.agentModel==5||data.dataObject.merchantResp.agentModel==4){
//                    $rootScope.permissionShopCSHandJXH=true;
//                }else{
//                    $rootScope.permissionShopCSHandJXH=false;
//                }
//
//               /* $rootScope.permissionShop=data.dataObject.agentModel;*/
//                /*  $rootScope.jurisdiction.agentCenterAuth=data.dataObject.permissionMap.agentCenter;*/
//            }
//        });

    /*点击退出登录按钮*/
    $scope.logout=function(){
        $http({
            method:"POST",
            url:$rootScope.basePath+"login/logOut.do",
            dataType:'json',
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
            .success(function(data) {

                if (data.respCode=='failure_session') {
                    $scope.$emit("NOTDOWNLOADS");
                    //$state.go("login",{},{reload:true});
                    $location.path('/login');
                    $rootScope.$emit("userId", null);
                    cookies.del('userId');
                } else {
                    alert(data.respMsg);
                }
            });
    };
    setStyle();
})

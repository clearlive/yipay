var mchInfo=angular.module("mchInfo",[]);
mchInfo.directive('mchInfo',function($http,$rootScope,$location){
    return {
        restrict : 'EA',
        transclude : true,
        scope : {
            info : '='
        },
        templateUrl:'page/directive/mchInfo.html',
        link : function(scope, element, attrs) {
            scope.info.showContent=false;
            scope.trans={};
            scope.mchPaginationConf = {
                currentPage: 1
            };
            scope.tipConf={
                showTipContent:false
            }
            scope.trans.ignoreType=scope.info.ignoreType;
            scope.getAllEmployee = function () {
                scope.$emit("BUSY");
                scope.trans.currentPage=scope.mchPaginationConf.currentPage;
                $http({
                    method:"POST",
                    url:$rootScope.basePath+'bankmechanism/merchantList.do',
                    data: $.param(scope.trans),
                    headers:{
                        'Content-Type':'application/x-www-form-urlencoded'
                    },
                    timeout: 60000
                })
                    .success(function(data){
                        scope.$emit("NOTBUSY");
                        if(data.respCode=="failure_session"){
                            //登录超时
                            $location.path('/index');
                        }else{
                            if(data.respCode=="success"){
                                if (data.data == "" || data.data == null) {
                                    scope.mchPaginationConf.totalItems = 0;
                                    scope.emptyData = true;
                                } else {
                                    scope.mchPaginationConf.totalItems = data.data.paginator.totalCount;
                                    scope.mchPaginationConf.currentPage = data.data.paginator.currentPage;
                                    scope.mchPaginationConf.itemsPerPage = data.data.paginator.pageSize;
                                    scope.emptyData = false;
                                    scope.transData=  data.data.list;
                                }
                            }
                        }
                    })
                    .error(function(){
                        scope.$emit("NOTBUSY");
                        scope.tipConf.showTipContent=true;
                        scope.tipConf.src="image/no.png"
                        scope.tipConf.title="系统繁忙，请稍后重试"
                    })

            }

            /***************************************************************
             当页码发生变化时监控后台查询
             ***************************************************************/
            scope.$watch('mchPaginationConf.currentPage', scope.getAllEmployee);
            /*点击查询按钮*/
            scope.searchClick = function () {
                if (scope.mchPaginationConf.currentPage == 1) {
                    scope.getAllEmployee();
                } else {
                    scope.mchPaginationConf.currentPage = 1
                }
            }
            /*选中商户*/
            scope.selectMch=function(mchName,mchId){
                scope.info.mchName=mchName;
                scope.info.mchId=mchId;
                scope.info.showContent =false;
            }
            scope.hideTipContent = function(close) {
                scope.info.showContent =false;
            }


        }
    }
})

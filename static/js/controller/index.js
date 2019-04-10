moduleApp.controller('myApp', function ($rootScope, $scope, cookies, $http, $location,$filter) {
    $scope.paginationDownloadConf = {
        currentPage: 1
    };
    $scope.busy=false;
    $scope.down = {};
    $scope.statList = {
        1: "正在下载",
        2: "下载完成",
        3: "下载失败",
        4: "取消下载",
        5: "已删除"
    }
    var GetAllEmployeeDownload = function () {
        var urlValue=$location.path();
        $scope.checkOutUrl = $filter('checkLogin')(urlValue);
        if($scope.checkOutUrl){
           $scope.$emit("NOTBUSY");
            return;
        }
        $scope.$emit("DOWNLOADS");
        $scope.down.currentPage = $scope.paginationDownloadConf.currentPage;
        $scope.$emit("BUSY");
        $http({
            method: 'POST',
            url: $rootScope.basePath + 'downloadAction/list.do',
            dataType: 'json',
            data: $.param($scope.down),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            timeout: 60000
        })
            .success(function (data) {
                $scope.$emit("NOTBUSY");
                /* if(data.respCode=="failure_session"){
                 //登录超时
                 $location.path('/index');
                 }else{*/
                if (data.respCode == "success") {
                    $scope.paginationDownloadConf.totalItems = data.data.paginator.totalCount;
                    $scope.paginationDownloadConf.currentPage = data.data.paginator.currentPage;
                    $scope.paginationDownloadConf.itemsPerPage = data.data.paginator.pageSize;
                    if (data.data.paginator.totalCount == 0) {
                        $scope.emptyDataDownload = true;
                    } else {
                        $scope.emptyDataDownload = false;
                        var arr = data.data.list;
                        for (var item in arr) {
                            var date = new Date(arr[item].startTime);
                            arr[item].startTime = date.getFullYear() + "-" + ((date.getMonth() + 1) < 10 ? ("0" + (date.getMonth() + 1)) : (date.getMonth() + 1)) + "-" + (date.getDate() < 10 ? ("0" + date.getDate()) : date.getDate()) + " " + (date.getHours() < 10 ? ("0" + date.getHours()) : date.getHours()) + ":" + (date.getMinutes() < 10 ? ("0" + date.getMinutes()) : date.getMinutes()) + ":" + (date.getSeconds() < 10 ? ("0" + date.getSeconds()) : date.getSeconds());
                            var num = arr[item].stat;
                            arr[item].stat = $scope.statList[num];
                        }
                        $scope.downloadData = data.data.list;
                    }
                }
                /*    }*/
            })
            .error(function () {
                $scope.$emit("NOTBUSY");
                $scope.downTipConf.showTipContent = true;
                $scope.downTipConf.src = "image/no.png"
                $scope.downTipConf.title = "系统繁忙，请稍后重试"
            })

    }

    /***************************************************************
     当页码发生变化时监控后台查询
     ***************************************************************/
    $scope.$watch('paginationDownloadConf.currentPage', GetAllEmployeeDownload);
    var getInfo = function () {
        var urlValue=$location.path();
        $scope.checkOutUrl = $filter('checkLogin')(urlValue);
        if($scope.checkOutUrl){
            $scope.$emit("NOTBUSY");
            return;
        }
            $http({
                method: "POST",
                url: $rootScope.basePath + "mchInfo/mchInfo.do",
                dataType: 'json',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
                .success(function (data) {
                    if (data.respCode == 'failure_session') {
                        $scope.$emit("NOTDOWNLOADS");
                        $location.path('/index');
                    } else {
                        $scope.$emit("DOWNLOADS");
                        $rootScope.permissionMap = data.dataObject.permissionMap;
                        $rootScope.merchantResp = data.dataObject.merchantResp;
                        $rootScope.realNameRoot = data.dataObject.merchantResp;
                        $rootScope.accountNo = data.dataObject.username;
                        if (data.dataObject.merchantResp.agentModel == 5) {
                            $rootScope.permissionShopCSH = true;
                        } else {
                            $rootScope.permissionShopCSH = false;
                        }

                        if (data.dataObject.merchantResp.agentModel == 5 || data.dataObject.merchantResp.agentModel == 4) {
                            $rootScope.permissionShopCSHandJXH = true;
                        } else {
                            $rootScope.permissionShopCSHandJXH = false;
                        }

                        /* $rootScope.permissionShop=data.dataObject.agentModel;*/
                        /*  $rootScope.jurisdiction.agentCenterAuth=data.dataObject.permissionMap.agentCenter;*/
                    }
                });


    }
    /*监听userId*/
    $scope.$watch('userId', function () {
//        console.log($scope.userId)
        getInfo();
    });
//    $scope.$watch('accountNo', function () {
//        if (!$rootScope.accountNo) {
//            getInfo();
//        }
//    });

    /*点击查询按钮*/
    $scope.searchFileStatClick = function () {
        if ($scope.paginationDownloadConf.currentPage == 1) {
            GetAllEmployeeDownload();
        } else {
            $scope.paginationDownloadConf.currentPage = 1
        }
    }

    $scope.showDownloadContent = false;
    /*点击管理按钮 ，打开管理中心弹窗 */
    $scope.showDownloadClick = function () {
        $scope.showDownloadContent = true;
        if ($scope.paginationDownloadConf.currentPage == 1) {
            GetAllEmployeeDownload();
        } else {
            $scope.paginationDownloadConf.currentPage = 1
        }
    }
    /*关闭管理中心弹窗*/
    $scope.hideDownloadContent = function () {
        $scope.showDownloadContent = false;
    }

    /*点击保存到本地*/
    $scope.downLoadFile = function (id) {
        window.open($rootScope.basePath + 'downloadAction/downFile.do?id=' + id);
    }
    /*点击取消下载*/
    $scope.cancelLoadFile = function (id) {
        $http({
            method: 'POST',
            url: $rootScope.basePath + 'downloadAction/cancelDownLoad.do',
            dataType: 'json',
            data: $.param({"id": id}),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
            .success(function (data) {
                if (data.respCode == "failure_session") {
                    //登录超时
                    $location.path('/index');

                } else {
                    if (data.respCode == "success") {
                        if ($scope.paginationDownloadConf.currentPage == 1) {
                            GetAllEmployeeDownload();
                        } else {
                            $scope.paginationDownloadConf.currentPage = 1
                        }
                    }
                }
            })
            .error(function () {

            })
    }
    /*提示框的初始信息*/
    $scope.downTipConf = {
        showTipContent: false
    }
    /*提示框的初始信息*/
    $scope.downDeleteTipConf = {
        showTipContent: false
    }
    /*点击删除*/
    $scope.deleteLoadFile = function (id) {
        $scope.downDeleteTipConf = {};
        $scope.downDeleteTipConf.showTipContent = true;
        $scope.downDeleteTipConf.src = "";
        $scope.downDeleteTipConf.title = "确定要删除此条数据吗？";
        $scope.downDeleteTipConf.subtitle = "";
        //自定义点击事件
        $scope.downDeleteTipConf.clickfunction = function () {
            $http({
                method: 'POST',
                url: $rootScope.basePath + 'downloadAction/delete.do',
                dataType: 'json',
                data: $.param({"id": id}),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
                .success(function (data) {
                    if (data.respCode == "failure_session") {
                        //登录超时
                        $location.path('/index');

                    } else {
                        if (data.respCode == "success") {
                            $scope.downTipConf = {};
                            $scope.downTipConf.showTipContent = true;
                            $scope.downTipConf.src = "image/yes.png"
                            $scope.downTipConf.title = "删除成功";
                            $scope.downTipConf.subtitle = "";
                            //自定义点击事件
                            $scope.downTipConf.clickfunction = function () {
                                if ($scope.paginationDownloadConf.currentPage == 1) {
                                    GetAllEmployeeDownload();
                                } else {
                                    $scope.paginationDownloadConf.currentPage = 1
                                }
                            }
                        }
                    }

                })
                .error(function () {

                })
        }

    }
//    if($location.url()=='/index'){
//        cookies.del('userId');
//    };

//    $rootScope.userId = cookies.get('userId');
    $rootScope.userId;
    $rootScope.$on('userId', function (event, msg) {
        $rootScope.userId = msg;
//        cookies.set('userId', msg);
    });
    $scope.$on("BUSY", function () {
        $scope.busy = true;
    });
    $scope.$on("NOTBUSY", function () {
        $scope.busy = false;
    });
    $scope.$on("DOWNLOADS", function () {
        $scope.downloads = true;
    });
    $scope.$on("NOTDOWNLOADS", function () {
        $scope.downloads = false;
    });
    $scope.$emit("NOTBUSY");
    $scope.$emit("NOTDOWNLOADS");
});
moduleApp.factory('cookies', function () {
    var cookie = {
        set: function (key, val, time) {
            var str = key + '=' + escape(val);
            if (time) {
                var date = new Date();
                var ms = time * 3600 * 1000;
                date.setTime(date.getTime() + ms);
                str += ';expries=' + date.toGMTString();
            }
            ;
            document.cookie = str;
        },
        get: function (key) {
            var data = document.cookie.split(';');
            for (var i = 0, l = data.length; i < l; i++) {
                var temp = data[i].split('=');
                if (key == temp[0]) return unescape(temp[1]);
            }
            ;
        },
        del: function (key) {
            var date = new Date();
            date.setTime(date.getTime() - 10000);
            document.cookie = key + "=a; expires=" + date.toGMTString();
        }
    };
    return cookie;
});
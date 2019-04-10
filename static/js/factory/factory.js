var GetData=angular.module("GetData",[]);
GetData.factory('GetDataFactory', function($rootScope,$http,$location) {
    var factory = {};
    //获取省份信息
    factory.getProvince = function() {
        var promise=$http({
            method  : 'POST',
            url     : $rootScope.basePath+'selectCommon/getProvinceList.do',
            dataType:'json',
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        return promise;
    }

    //根据省的id获取市
    factory.getCity = function(provinceId) {
        var provinceId=provinceId;
        var promise=$http({
            method  : 'POST',
            url     : $rootScope.basePath+'selectCommon/getCityList.do',
            data    : $.param({
                "provinceId":provinceId
            }),
            dataType:'json',
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        return promise;
    }

    //根据市的id获取省
    factory.getCountry = function(cityId) {
        var cityId=cityId;
        var promise=$http({
            method  : 'POST',
            url     : $rootScope.basePath+'selectCommon/getCountyList.do',
            data    : $.param({
                "cityId":cityId
            }),
            dataType:'json',
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        return promise;
    }


    //获取后台数据
    factory.getDatas = function(object) {
        var promise=$http({
            method  : 'POST',
            url     : $rootScope.basePath+object.url,
            data    : $.param(object.data),
            dataType:'json',
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        return promise;
    }
    return factory;
});



var filterData=angular.module("filterData",[]);
filterData.filter("checkLogin",function(){
    return function(input){
        var outArray= ['/setPwd','/sendEmail','/register','/registerTimeOut','/registerSuccess',
            '/login','/agreement', '/joinPay','/sdkDownload','/demoExperience','/apiWord','/pcPay','/appPay','/phonePay',
            '/capacityPosPay','/officialPay','/cardPay','/userScanPay','/scanPay','/h5Pay','/mchScan','/publicPay',
            '/userScan','/webPay','/mchScan','/noteServe', '/account','/bankCollaborate','/crossPay','/auth','/joinRegister'
            ,'/joinRegisterSucc','/joinForgetPwd','/joinSetPwd']

        var out=false;
        for(var i=0 ; i<outArray.length; i++){
             if(outArray[i]==input){
                 out=true;
             }
        }
        return out;
    }
});
filterData.filter('payType', function(){//支付场景
    return function(val, ary, key){
        if(!ary) return;
        if(val == '全部') return val;
        var newKey = key ? key : 'id';
        for(var i=0,l=ary.length; i<l; i++){
            if(ary[i][newKey] == val){
                return ary[i].name;
            }
        };
    };
});


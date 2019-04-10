var moduleApp=angular.module('moduleApp',['ui.router','oc.lazyLoad','pagination','paginationAli','ngAnimate','angularFileUpload','ngSanitize',
    'input','docSide','highcharts-ng','datatime','tip','agreement','entry','filterData','GetData','sendEmail','mchInfo']);
/*,'ngFileUpload'*/
moduleApp.config(function ($provide, $compileProvider, $controllerProvider, $filterProvider) {
    moduleApp.controller = $controllerProvider.register;
    moduleApp.directive = $compileProvider.directive;
    moduleApp.filter = $filterProvider.register;
    moduleApp.factory = $provide.factory;
    moduleApp.service = $provide.service;
    moduleApp.constant = $provide.constant;
});

/**
 * 由于整个应用都会和路由打交道，所以这里把$state和$stateParams这两个对象放到$rootScope上，方便其它地方引用和注入。
 * 这里的run方法只会在angular启动的时候运行一次。
 * @param  {[type]} $rootScope
 * @param  {[type]} $state
 * @param  {[type]} $stateParams
 * @return {[type]}
 */
moduleApp.run(function($rootScope, $state, $stateParams,$location,$http,$templateCache,$window,$timeout) {
    var protocol= window.location.protocol
    var host = window.location.host;
    $rootScope.basePath=protocol+"//"+host+'/aggplat_mvc/';
    $rootScope.basePathOuter='http://www.ipaynow.cn/'
    $rootScope.$state = $state;
    $rootScope.$stateParams = $stateParams;
    var stateChangeSuccess = $rootScope.$on('$stateChangeSuccess', stateChangeSuccess);
    function stateChangeSuccess($rootScope) {
        $templateCache.removeAll();
    }

    $rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams){
        var loginStatus = "00";
        /*获取上海银行标志*/
        var obj= setView()[location.href.substring(location.href.lastIndexOf('//') + 2).split('.')[0]];
        if(obj){
            $rootScope.flag= obj.flag;

        }else{
            $rootScope.flag='';
        }
       // console.log($rootScope.flag)
        $rootScope.isActive = function(){   /*/!*设置点击的菜单的样式为active*!/*/
            var str = "/login";
            var href=toState.url;
            var index = href.indexOf("/");
            var index2 = href.indexOf("?");
            if(index != -1){
                if(index2!=-1){
                    str = href.substring(index,index2);
                }else{
                    str = href.substring(index,href.length);
                }
            };
            return str;
        }();
        siteDispose($rootScope);
    });

});

moduleApp.config(function($ocLazyLoadProvider){
    $ocLazyLoadProvider.config({
        debug:false,
        events:false
    });
});


/**
 * 配置路由。
 * 注意这里采用的是ui-router这个路由，而不是ng原生的路由。
 * ng原生的路由不能支持嵌套视图，所以这里必须使用ui-router。
 * @param  {[type]} $stateProvider
 * @param  {[type]} $urlRouterProvider
 * @return {[type]}
 */
moduleApp.config(function($stateProvider,$urlRouterProvider,$locationProvider){
    $urlRouterProvider.otherwise('/login');
    var topIndex = setStyle(true);
    $stateProvider
        .state('registerSuccess',{   /*注册成功页面*/
            url:'/registerSuccess',
            views:{
                '':{
                    templateUrl:'page/registerSuccess.html?v=67e006662c'
                }

            }
        })
        .state('registerTimeOut',{   /*注册超时页面*/
            url:'/registerTimeOut',
            views:{
                '':{
                    templateUrl:'page/registerTimeOut.html?v=eb6ed223be'
                }

            }
        })

        .state('sendEmail',{   /*忘记密码页面发送邮件页面*/
            url:'/sendEmail',
            views:{
                '':{
                    templateUrl:'page/sendEmail.html?v=0ed2e16858',
                    controller:'SendEmailController'
                },
                'developerTopMenu@sendEmail':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@sendEmail':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/sendEmail.js?v=d2bc99fa2b'
                    ])
                }]

            }
        })
        .state('setPwd',{   /*忘记密码页面 设置密码页面*/
            url:'/setPwd',
            views:{
                '':{
                    templateUrl:'page/setPwd.html?v=a298e03510',
                    controller:'SetPwdController'
                },
                'developerTopMenu@setPwd':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@setPwd':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }

            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/setPwd.js?v=bc2cc57afb'
                    ])
                }]

            }
        })
        .state('home',{   /*首页页面*/
            url:'/home',
            views:{
                '':{
                    templateUrl:'page/home.html?v=e3c5027ff1' ,
                    controller:'HomeController'
                },
                'mainMenu@home':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                }

            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/home.js?v=af46f55f02'
                    ])
                }]

            }
        })
        .state('weChatNotification',{   /*首页页面--微信通知*/
            url:'/weChatNotification',
            views:{
                '':{
                    templateUrl:'page/weChatNotification.html?v=63fb4771df' ,
                    controller:'WeChatNotificationController'
                },
                'mainMenu@weChatNotification':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                }

            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/weChatNotification.js?v=9c20640e86'
                    ])
                }]

            }
        })
        .state('batchRefundUpload',{  /*交易中心--批量退款上传*/
            url:'/batchRefundUpload',
            views:{
                '':{
                    templateUrl:'page/transTrade/batchRefundUpload.html?v=a3525f41e9' ,
                    controller:'BatchRefundUploadController'
                },
                'mainMenu@batchRefundUpload':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58'   ,
                    controller:'MainMenuController'
                },
                'transMenu@batchRefundUpload':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/batchRefundUpload.js?v=ba5f9a8dc9'
                    ])
                }]

            }

        })
        .state('batchRefundSearch',{  /*交易中心--批量退款查询*/
            url:'/batchRefundSearch',
            views:{
                '':{
                    templateUrl:'page/transTrade/batchRefundSearch.html?v=e9023e311a' ,
                    controller:'BatchRefundSearchController'
                },
                'mainMenu@batchRefundSearch':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58'   ,
                    controller:'MainMenuController'
                },
                'transMenu@batchRefundSearch':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/batchRefundSearch.js?v=59f7f56d66'
                    ])
                }]

            }

        })
        .state('uploadBatchPayment',{  /*交易中心--批量代付上传*/
            url:'/uploadBatchPayment',
            views:{
                '':{
                    templateUrl:'page/transTrade/uploadBatchPayment.html?v=df40e4a5bf' ,
                    controller:'uploadBatchPaymentController'
                },
                'mainMenu@uploadBatchPayment':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58'   ,
                    controller:'MainMenuController'
                },
                'transMenu@uploadBatchPayment':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/uploadBatchPayment.js?v=dedf19f4f8'
                    ])
                }]

            }

        })
        .state('checkBatchPayment',{  /*交易中心--批量代付审核*/
            url:'/checkBatchPayment',
            views:{
                '':{
                    templateUrl:'page/transTrade/checkBatchPayment.html?v=1e1b44c6b3' ,
                    controller:'CheckBatchPaymentController'
                },
                'mainMenu@checkBatchPayment':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58'  ,
                    controller:'MainMenuController'
                },
                'transMenu@checkBatchPayment':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/checkBatchPayment.js?v=d5ef86d78c'
                    ])
                }]

            }

        })
        .state('detailPayment',{  /*交易中心--代付明细*/
            url:'/detailPayment',
            views:{
                '':{
                    templateUrl:'page/transTrade/detailPayment.html?v=3b2bf3e51d'  ,
                    controller:'DetailPaymentController'
                },
                'mainMenu@detailPayment':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@detailPayment':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/detailPayment.js?v=6b1e2c6320'
                    ])
                }]

            }

        })
        .state('transDetail',{  /*交易中心--交易明细查询*/
            url:'/transDetail',
            views:{
                '':{
                    templateUrl:'page/transTrade/transDetail.html?v=8ded6e61ab'  ,
                    controller:'TransDetailController'
                },
                'mainMenu@transDetail':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@transDetail':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/transDetail.js?v=9c957648fc'
                    ])
                }]

            }

        })
        .state('transDetailHistory',{  /*交易中心--历史交易明细查询*/
            url:'/transDetailHistory',
            views:{
                '':{
                    templateUrl:'page/transTrade/transDetailHistory.html?v=a4728acc25'  ,
                    controller:'TransDetailHistoryController'
                },
                'mainMenu@transDetailHistory':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@transDetailHistory':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/transDetailHistory.js?v=416691dd64'
                    ])
                }]

            }

        })
        .state('orderAccurateInquiry',{  /*交易中心--订单精准查询*/
            url:'/orderAccurateInquiry',
            views:{
                '':{
                    templateUrl:'page/transTrade/orderAccurateInquiry.html?v=ac0aa49e33'  ,
                    controller:'orderAccurateInquiryController'
                },
                'mainMenu@orderAccurateInquiry':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@orderAccurateInquiry':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/orderAccurateInquiry.js?v=32ab7187ab'
                    ])
                }]

            }

        })

        .state('transPrint',{  /*交易中心--打印交易凭证*/
            url:'/transPrint?displayMchId&transId&ownerId&transType&channelId&deviceId&startDate&endDate&today',
            views:{
                '':{
                    templateUrl:'page/transTrade/transPrint.html?v=e35b07f2c5'  ,
                    controller:'TransPrintController'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/transPrint.js?v=8f4deb2dae'
                    ])
                }]

            }

        })
        .state('transDay',{  /*交易中心--日账单*/
            url:'/transDay',
            views:{
                '':{
                    templateUrl:'page/transTrade/transDay.html?v=b5364f350d' ,
                    controller:'TransDayController'
                },
                'mainMenu@transDay':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@transDay':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/transDay.js?v=a41431fa13'
                    ])
                }]

            }

        })
        .state('refundDay',{  /*交易中心--退款退回日账单*/
            url:'/refundDay',
            views:{
                '':{
                    templateUrl:'page/transTrade/refundDay.html?v=1acfe2b5e3' ,
                    controller:'RefundDayController'
                },
                'mainMenu@refundDay':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@refundDay':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/refundDay.js?v=4f70fbeef1'
                    ])
                }]

            }

        })
        .state('refundSettlement',{  /*交易中心--退款退回结算账单*/
            url:'/refundSettlement',
            views:{
                '':{
                    templateUrl:'page/transTrade/refundSettlement.html?v=407c7d90f4' ,
                    controller:'RefundSettlementController'
                },
                'mainMenu@refundSettlement':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@refundSettlement':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/refundSettlement.js?v=b242eef252'
                    ])
                }]

            }

        })
        .state('transSettlement',{  /*交易中心--结算账单*/
            url:'/transSettlement',
            views:{
                '':{
                    templateUrl:'page/transTrade/transSettlement.html?v=122b2aa4b0' ,
                    controller:'TransSettlementController'
                },
                'mainMenu@transSettlement':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@transSettlement':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/transSettlement.js?v=993a25eb13'
                    ])
                }]

            }

        })
        .state('transPay',{  /*交易中心--代付日账单*/
            url:'/transPay',
            views:{
                '':{
                    templateUrl:'page/transTrade/transPay.html?v=21e237b042' ,
                    controller:'TransPayController'
                },
                'mainMenu@transPay':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@transPay':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/transPay.js?v=d6dfad50a7'
                    ])
                }]
            }

        })
        .state('transAgentDay',{  /*交易中心--代理商日账单*/
            url:'/transAgentDay',
            views:{
                '':{
                    templateUrl:'page/transTrade/transAgentDay.html?v=a1ff252697' ,
                    controller:'TransAgentDayController'
                },
                'mainMenu@transAgentDay':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@transAgentDay':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/transAgentDay.js?v=840bd3b334'
                    ])
                }]

            }

        })
        .state('transAgentWeek',{  /*交易中心--代理商周账单*/
            url:'/transAgentWeek',
            views:{
                '':{
                    templateUrl:'page/transTrade/transAgentWeek.html?v=2c8b928ea3' ,
                    controller:'TransAgentWeekController'
                },
                'mainMenu@transAgentWeek':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@transAgentWeek':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/transAgentWeek.js?v=ebcec40f6e'
                    ])
                }]

            }

        })
        .state('serviceBenefitDay',{  /*交易中心--服务商分润日账单*/
            url:'/serviceBenefitDay',
            views:{
                '':{
                    templateUrl:'page/transTrade/serviceBenefitDay.html?v=c9305bef5d' ,
                    controller:'serviceBenefitDayController'
                },
                'mainMenu@serviceBenefitDay':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@serviceBenefitDay':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/serviceBenefitDay.js?v=4359ea050b'
                    ])
                }]

            }

        })
        .state('serviceBenefitSummary',{  /*交易中心--服务商分润汇总账单*/
            url:'/serviceBenefitSummary',
            views:{
                '':{
                    templateUrl:'page/transTrade/serviceBenefitSummary.html?v=f2327a9116' ,
                    controller:'serviceBenefitSummaryController'
                },
                'mainMenu@serviceBenefitSummary':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@serviceBenefitSummary':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/serviceBenefitSummary.js?v=8aab60f2b8'
                    ])
                }]

            }

        })
        .state('transMonth',{  /*交易中心--月账单*/
            url:'/transMonth',
            views:{
                '':{
                    templateUrl:'page/transTrade/transMonth.html?v=aaef1fb27d',
                    controller:'TransMonthController'
                },
                'mainMenu@transMonth':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'transMenu@transMonth':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/transMonth.js?v=9fd7e6cb10'
                    ])
                }]

            }

        })
        .state('transPayMonth',{  /*交易中心--代付月账单*/
            url:'/transPayMonth',
            views:{
                '':{
                    templateUrl:'page/transTrade/transPayMonth.html?v=31aa85bfbc',
                    controller:'TransPayMonthController'
                },
                'mainMenu@transPayMonth':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'transMenu@transPayMonth':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/transPayMonth.js?v=7bafce6dde'
                    ])
                }]

            }

        })
        .state('fundManage',{  /*交易中心--资金信息*/
            url:'/fundManage',
            views:{
                '':{
                    templateUrl:'page/transTrade/fundManage.html?v=81c5b30823',
                    controller:'FundManageController'
                },
                'mainMenu@fundManage':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'transMenu@fundManage':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/fundManage.js?v=e4b64dd4e3'
                    ])
                }]

            }

        })
        .state('fundMonth',{  /*交易中心--资金月账单*/
            url:'/fundMonth',
            views:{
                '':{
                    templateUrl:'page/transTrade/fundMonth.html?v=95e93139af',
                    controller:'FundMonthController'
                },
                'mainMenu@fundMonth':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'transMenu@fundMonth':{
                    templateUrl:'page/menu/transMenu.html?v=52469be5bc'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/fundMonth.js?v=6ed232e2d0'
                    ])
                }]

            }

        })
        .state('accountInfo',{  /*账号中心--安全管理-密码设置*/
            url:'/accountInfo',
            views:{
                '':{
                    templateUrl:'page/account/accountInfo.html?v=622e54e63b',
                    controller:'AccountInfoController'
                },
                'mainMenu@accountInfo':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@accountInfo':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/accountInfo.js?v=1568c66265'
                    ])
                }]
            }

        })
        .state('modifyPhone',{  /*账号中心--安全管理-手机号设置*/
            url:'/modifyPhone',
            views:{
                '':{
                    templateUrl:'page/account/modifyPhone.html?v=02bfb536b7',
                    controller:'AccountInfoController'
                },
                'mainMenu@modifyPhone':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@modifyPhone':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/accountInfo.js?v=1568c66265'
                    ])
                }]
            }

        })
        .state('comRealName',{  /*账号中心--企业实名认证*/
            url:'/comRealName',
            views:{
                '':{
                    templateUrl:'page/account/comRealName.html?v=00bf22fd45' ,
                    controller:'ComRealNameController'
                },
                'mainMenu@comRealName':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@comRealName':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/comRealName.js?v=890d875d8d'
                    ])
                }]
            }

        })
        .state('comRealNameWait',{  /*账号中心--企业实名认证--等待中*/
            url:'/comRealNameWait',
            views:{
                '':{
                    templateUrl:'page/account/comRealNameWait.html?v=a7164805fc',
                    controller:'ComRealNameWaitController'
                },
                'mainMenu@comRealNameWait':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@comRealNameWait':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/comRealNameWait.js?v=8ea1f988b0'
                    ])
                }]
            }

        })
        .state('comRealNameSuccess',{  /*账号中心--企业实名认证--成功*/
            url:'/comRealNameSuccess',
            views:{
                '':{
                    templateUrl:'page/account/comRealNameSuccess.html?v=dc3e0848f4',
                    controller:'ComRealNameSuccessController'
                },
                'mainMenu@comRealNameSuccess':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@comRealNameSuccess':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/comRealNameSuccess.js?v=7aee6a0130'
                    ])
                }]
            }

        })
        .state('comRealNameError',{  /*账号中心--企业实名认证--失败*/
            url:'/comRealNameError',
            views:{
                '':{
                    templateUrl:'page/account/comRealNameError.html?v=c29e249e4b',
                    controller:'ComRealNameErrorController'
                },
                'mainMenu@comRealNameError':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@comRealNameError':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/comRealNameError.js?v=0d75961988'
                    ])
                }]
            }

        })
        .state('personRealName',{  /*账号中心--个人实名认证*/
            url:'/personRealName',
            views:{
                '':{
                    templateUrl:'page/account/personRealName.html?v=e81c8868eb',
                    controller:'PersonRealNameController'
                },
                'mainMenu@personRealName':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@personRealName':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/personRealName.js?v=b5af89ee78'
                    ])
                }]
            }
        })
        .state('personRealNameWait',{  /*账号中心--个人实名认证 --等待中*/
            url:'/personRealNameWait',
            views:{
                '':{
                    templateUrl:'page/account/personRealNameWait.html?v=04c0810e00',
                    controller:'PersonRealNameWaitController'
                },
                'mainMenu@personRealNameWait':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@personRealNameWait':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/personRealNameWait.js?v=1fba8c3938'
                    ])
                }]
            }
        })
        .state('personRealNameSuccess',{  /*账号中心--个人实名认证 --成功*/
            url:'/personRealNameSuccess',
            views:{
                '':{
                    templateUrl:'page/account/personRealNameSuccess.html?v=071c5ad555',
                    controller:'PersonRealNameSuccessController'
                },
                'mainMenu@personRealNameSuccess':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@personRealNameSuccess':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/personRealNameSuccess.js?v=3d85d3f38e'
                    ])
                }]
            }
        })
        .state('personRealNameError',{  /*账号中心--个人实名认证 --失败*/
            url:'/personRealNameError',
            views:{
                '':{
                    templateUrl:'page/account/personRealNameError.html?v=5e9dfc85ef',
                    controller:'PersonRealNameErrorController'
                },
                'mainMenu@personRealNameError':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@personRealNameError':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/personRealNameError.js?v=528f3a7fb7'
                    ])
                }]
            }
        })

        .state('role',{  /*账号中心--角色管理*/
            url:'/role',
            views:{
                '':{
                    templateUrl:'page/account/role.html?v=354afe202e',
                    controller:'RoleController'
                },
                'mainMenu@role':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@role':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/role.js?v=0e67d50b36'
                    ])
                }]
            }

        })
        .state('operator',{  /*账号中心--操作员管理*/
            url:'/operator',
            views:{
                '':{
                    templateUrl:'page/account/operator.html?v=8a47d5ca9d',
                    controller:'OperatorController'
                },
                'mainMenu@operator':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@operator':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/operator.js?v=76a5fb0173'
                    ])
                }]
            }

        })
        .state('protocolManagement',{  /*账号中心--协议管理*/
            url:'/protocolManagement',
            views:{
                '':{
                    templateUrl:'page/account/protocolManagement.html?v=02f8a94416',
                    controller:'ProtocolManagementController'
                },
                'mainMenu@protocolManagement':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@protocolManagement':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/protocolManagement.js?v=57f29a70e1'
                    ])
                }]
            }

        })
        .state('protocolSuccess',{  /*账号中心--协议签署成功*/
            url:'/protocolSuccess',
            views:{
                '':{
                    templateUrl:'page/account/protocolSuccess.html?v=0ad27cef8b'
                }
            }
        })
        .state('apply',{  /*应用中心--应用信息*/
            url:'/apply',
            views:{
                '':{
                    templateUrl:'page/apply/apply.html?v=2346bbcafb11111',
                    controller:'ApplyController'
                },
                'mainMenu@apply':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'accountMenu@apply':{
                    templateUrl:'page/menu/accountMenu.html?v=0a5f26f16f'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/apply.js?v=cc34628e19711'
                    ])
                }]
            }

        })

        .state('agent',{  /*代理商中心--商户管理*/
            url:'/agent',
            views:{
                '':{
                    templateUrl:'page/agent/agent.html?v=dba19ab5d2',
                    controller:'AgentController'
                },
                'mainMenu@agent':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'agentMenu@agent':{
                    templateUrl:'page/menu/agentMenu.html?v=9b94c9fdb0'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/agent.js?v=6c20e5c7d8'
                    ])
                }]
            }

        })
        .state('agentWait',{  /*代理商中心--商户管理--等待审核页面*/
            url:'/agentWait',
            views:{
                '':{
                    templateUrl:'page/agent/agent.html?v=dba19ab5d2',
                    controller:'AgentController'
                },
                'mainMenu@agentWait':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'agentMenu@agentWait':{
                    templateUrl:'page/menu/agentMenu.html?v=9b94c9fdb0'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/agent.js?v=6c20e5c7d8'
                    ])
                }]
            }

        })

        .state('merchantEntry',{  /*代理商中心--商户录入*/
            url:'/merchantEntry',
            views:{
                '':{
                    templateUrl:'page/agent/merchantEntry.html?v=87fa429303',
                    controller:'merchantEntryController'
                },
                'mainMenu@merchantEntry':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'agentMenu@merchantEntry':{
                    templateUrl:'page/menu/agentMenu.html?v=9b94c9fdb0'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/merchantEntry.js?v=49bfc9eba0'
                    ])
                }]
            }

        })
        .state('agentShopManagement',{  /*代理商中心--门店应用管理*/
            url:'/agentShopManagement',
            views:{
                '':{
                    templateUrl:'page/agent/agentShopManagement.html?v=57d641fc89',
                    controller:'agentShopManagementController'
                },
                'mainMenu@agentShopManagement':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'agentMenu@agentShopManagement':{
                    templateUrl:'page/menu/agentMenu.html?v=9b94c9fdb0'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/agentShopManagement.js?v=dd7c688eec'
                    ])
                }]
            }

        })

        .state('agentDay',{  /*代理商中心--商户日账单*/
            url:'/agentDay',
            views:{
                '':{
                    templateUrl:'page/agent/agentDay.html?v=049be1ccb0',
                    controller:'agentDayController'
                },
                'mainMenu@agentDay':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'agentMenu@agentDay':{
                    templateUrl:'page/menu/agentMenu.html?v=9b94c9fdb0'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/agentDay.js?v=2288364421'
                    ])
                }]
            }

        })

        .state('agentSummary',{  /*代理商中心--商户汇总账单*/
            url:'/agentSummary',
            views:{
                '':{
                    templateUrl:'page/agent/agentSummary.html?v=5cfb69fb23',
                    controller:'agentSummaryController'
                },
                'mainMenu@agentSummary':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'agentMenu@agentSummary':{
                    templateUrl:'page/menu/agentMenu.html?v=9b94c9fdb0'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/agentSummary.js?v=c88264b5e4'
                    ])
                }]
            }

        })

        .state('agentBenefitDay',{  /*代理商中心--商户汇总账单*/
            url:'/agentBenefitDay',
            views:{
                '':{
                    templateUrl:'page/agent/agentBenefitDay.html?v=5ee2eac8b4',
                    controller:'agentBenefitDayController'
                },
                'mainMenu@agentBenefitDay':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'agentMenu@agentBenefitDay':{
                    templateUrl:'page/menu/agentMenu.html?v=9b94c9fdb0'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/agentBenefitDay.js?v=91ec5f13e5'
                    ])
                }]
            }

        })

        .state('agentBenefitSummary',{  /*代理商中心--代理商分润汇总账单*/
            url:'/agentBenefitSummary',
            views:{
                '':{
                    templateUrl:'page/agent/agentBenefitSummary.html?v=fc6851d8ad',
                    controller:'agentBenefitSummaryController'
                },
                'mainMenu@agentBenefitSummary':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'agentMenu@agentBenefitSummary':{
                    templateUrl:'page/menu/agentMenu.html?v=9b94c9fdb0'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/agentBenefitSummary.js?v=c3580e5440'
                    ])
                }]
            }

        })



        .state('authSurvey',{  /*增值服务--鉴权中心-综合概况*/
            url:'/authSurvey',
            views:{
                '':{
                    templateUrl:'page/increment/authSurvey.html?v=bdb815b014',
                    controller:'AuthSurveyController'
                },
                'mainMenu@authSurvey':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'incrementMenu@authSurvey':{
                    templateUrl:'page/menu/incrementMenu.html?v=8cff3ff5a6'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/authSurvey.js?v=457b4009be'
                    ])
                }]
            }
        })
        .state('daySurvey',{  /*增值服务--鉴权中心-日综合概况*/
            url:'/daySurvey',
            views:{
                '':{
                    templateUrl:'page/increment/daySurvey.html?v=7fc604a70513',
                    controller:'DaySurveyController'
                },
                'mainMenu@daySurvey':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b5813',
                    controller:'MainMenuController'
                },
                'incrementMenu@daySurvey':{
                    templateUrl:'page/menu/incrementMenu.html?v=8cff3ff5a6113'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/daySurvey.js?v=eb9a63785111'
                    ])
                }]
            }
        })
        .state('dayMessageSurvey',{  /*增值服务--短信-日综合概况*/
            url:'/dayMessageSurvey',
            views:{
                '':{
                    templateUrl:'page/increment/dayMessageSurvey.html?v=d4f46810ea13',
                    controller:'DayMessageSurveyController'
                },
                'mainMenu@dayMessageSurvey':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b5813',
                    controller:'MainMenuController'
                },
                'incrementMenu@dayMessageSurvey':{
                    templateUrl:'page/menu/incrementMenu.html?v=8cff3ff5a6113'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/dayMessageSurvey.js?v=31b41c2bcd11'
                    ])
                }]
            }
        })

        .state('authCard',{  /*增值服务--鉴权中心-卡信息认证*/
            url:'/authCard',
            views:{
                '':{
                    templateUrl:'page/increment/authCard.html?v=8f286911b62',
                    controller:'AuthCardController'
                },
                'mainMenu@authCard':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'incrementMenu@authCard':{
                    templateUrl:'page/menu/incrementMenu.html?v=8cff3ff5a6'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/authCard.js?v=1aab7bc1b34'
                    ])
                }]
            }
        })
        .state('authIdentity',{  /*增值服务--鉴权中心-身份认证*/
            url:'/authIdentity',
            views:{
                '':{
                    templateUrl:'page/increment/authIdentity.html?v=3949b919841',
                    controller:'authIdentifyController'
                },
                'mainMenu@authIdentity':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'incrementMenu@authIdentity':{
                    templateUrl:'page/menu/incrementMenu.html?v=8cff3ff5a6'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/authIdentify.js?v=cb71633373'
                    ])
                }]
            }
        })
        .state('authPhone',{  /*增值服务--鉴权中心-手机号认证*/
            url:'/authPhone',
            views:{
                '':{
                    templateUrl:'page/increment/authPhone.html?v=bf506348e31',
                    controller:'authPhoneController'
                },
                'mainMenu@authPhone':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'incrementMenu@authPhone':{
                    templateUrl:'page/menu/incrementMenu.html?v=8cff3ff5a6'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/authPhone.js?v=4ae9fe8188'
                    ])
                }]
            }
        })
        .state('whiteListCollection',{  /*增值服务--鉴权中心-白名单采集*/
            url:'/whiteListCollection',
            views:{
                '':{
                    templateUrl:'page/increment/whiteListCollection.html?v=00fb46e13a1',
                    controller:'whiteListCollectionController'
                },
                'mainMenu@whiteListCollection':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'incrementMenu@whiteListCollection':{
                    templateUrl:'page/menu/incrementMenu.html?v=8cff3ff5a6'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/whiteListCollection.js?v=ce6014d455'
                    ])
                }]
            }
        })
        .state('messageSurvey',{  /*增值服务--短信中心-综合概况*/
            url:'/messageSurvey',
            views:{
                '':{
                    templateUrl:'page/increment/messageSurvey.html?v=81227edc4d',
                    controller:'MessageSurveyController'
                },
                'mainMenu@messageSurvey':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'incrementMenu@messageSurvey':{
                    templateUrl:'page/menu/incrementMenu.html?v=8cff3ff5a6'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/messageSurvey.js?v=1f292ffdb7'
                    ])
                }]
            }
        })
        .state('authMessage',{  /*增值服务--短信中心-短信认证查询*/
            url:'/authMessage',
            views:{
                '':{
                    templateUrl:'page/increment/authMessage.html?v=2880dc619e',
                    controller:'AuthMessageController'
                },
                'mainMenu@authMessage':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'incrementMenu@authMessage':{
                    templateUrl:'page/menu/incrementMenu.html?v=8cff3ff5a6'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/authMessage.js?v=8814de6fc5'
                    ])
                }]
            }
        })

        .state('dataCount',{  /*数据中心--交易汇总-交易汇总*/
            url:'/dataCount',
            views:{
                '':{
                    templateUrl:'page/data/dataCount.html?v=cfcce6e2b1',
                    controller:'DataCountController'
                },
                'mainMenu@dataCount':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'dataMenu@dataCount':{
                    templateUrl:'page/menu/dataMenu.html?v=a98df657aa'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/dataCount.js?v=3f467f829c'
                    ])
                }]
            }
        })
        .state('dataByTime',{  /*数据中心--按应用查看交易*/
            url:'/dataByTime',
            views:{
                '':{
                    templateUrl:'page/data/dataByTime.html?v=2b490a0ce5',
                    controller:'DataByTimeController'
                },
                'mainMenu@dataByTime':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'dataMenu@dataByTime':{
                    templateUrl:'page/menu/dataMenu.html?v=a98df657aa'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/dataByTime.js?v=8d0161b7ac'
                    ])
                }]
            }
        })
        .state('dataByScene',{  /*数据中心--按支付场景查看交易*/
            url:'/dataByScene',
            views:{
                '':{
                    templateUrl:'page/data/dataByScene.html?v=573632b76b',
                    controller:'DataBySceneController'
                },
                'mainMenu@dataByScene':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'dataMenu@dataByScene':{
                    templateUrl:'page/menu/dataMenu.html?v=a98df657aa'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/dataByScene.js?v=4fb7b7c251'
                    ])
                }]
            }
        })

        .state('dataByChannel',{  /*数据中心--按交易渠道查看交易*/
            url:'/dataByChannel',
            views:{
                '':{
                    templateUrl:'page/data/dataByChannel.html?v=94b6624ddb',
                    controller:'DataByChannelController'
                },
                'mainMenu@dataByChannel':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'dataMenu@dataByChannel':{
                    templateUrl:'page/menu/dataMenu.html?v=a98df657aa'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/dataByChannel.js?v=d4184ca5f2'
                    ])
                }]
            }
        })
        .state('accountCost',{  /*计费中心--电子账户费用明细*/
            url:'/accountCost',
            views:{
                '':{
                    templateUrl:'page/billing/accountCost.html?v=ef76178340',
                    controller:'AccountCostController'
                },
                'mainMenu@accountCost':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@accountCost':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/accountCost.js?v=58313a554c'
                    ])
                }]
            }
        })
        .state('billPayTrade',{  /*计费中心--手续费账户明细--代付交易*/
            url:'/billPayTrade',
            views:{
                '':{
                    templateUrl:'page/billing/billPayTrade.html?v=8851f0435c',
                    controller:'BillPayTradeController'
                },
                'mainMenu@billPayTrade':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billPayTrade':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billPayTrade.js?v=778b143f8c'
                    ])
                }]
            }
        })
        .state('billIdentity',{  /*计费中心--手续费账户明细--身份认证*/
            url:'/billIdentity',
            views:{
                '':{
                    templateUrl:'page/billing/billIdentity.html?v=882721d2a7',
                    controller:'BillIdentityController'
                },
                'mainMenu@billIdentity':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billIdentity':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billIdentity.js?v=6a396a414c'
                    ])
                }]
            }
        })
        .state('billPhone',{  /*计费中心--手续费账户明细--手机号认证*/
            url:'/billPhone',
            views:{
                '':{
                    templateUrl:'page/billing/billPhone.html?v=a139373027',
                    controller:'BillPhoneController'
                },
                'mainMenu@billPhone':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billPhone':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billPhone.js?v=fa5aac655d'
                    ])
                }]
            }
        })
        .state('billCard',{  /*计费中心--手续费账户明细--卡信息认证*/
            url:'/billCard',
            views:{
                '':{
                    templateUrl:'page/billing/billCard.html?v=55fbe719ae',
                    controller:'BillCardController'
                },
                'mainMenu@billCard':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billCard':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billCard.js?v=0a92f27790'
                    ])
                }]
            }
        })
        .state('billWhite',{  /*计费中心--手续费账户明细--白名单采集*/
            url:'/billWhite',
            views:{
                '':{
                    templateUrl:'page/billing/billWhite.html?v=294fd1cd3f',
                    controller:'BillWhiteController'
                },
                'mainMenu@billWhite':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billWhite':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billWhite.js?v=3b998bf08e'
                    ])
                }]
            }
        })
        .state('billMessage',{  /*计费中心--手续费账户明细--短信服务*/
            url:'/billMessage',
            views:{
                '':{
                    templateUrl:'page/billing/billMessage.html?v=0dc6ed9241',
                    controller:'BillMessageController'
                },
                'mainMenu@billMessage':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billMessage':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billMessage.js?v=1714e8a1d6'
                    ])
                }]
            }
        })
        .state('billAccount',{  /*计费中心--手续费账户明细--电子账户*/
            url:'/billAccount',
            views:{
                '':{
                    templateUrl:'page/billing/billAccount.html?v=3f1b6bd87c',
                    controller:'BillAccountController'
                },
                'mainMenu@billAccount':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billAccount':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billAccount.js?v=78797f40d3'
                    ])
                }]
            }
        })
        .state('billMonthPayTrade',{  /*计费中心--手续费账户月账单--代付交易*/
            url:'/billMonthPayTrade',
            views:{
                '':{
                    templateUrl:'page/billing/billMonthPayTrade.html?v=17dbc00763',
                    controller:'BillMonthPayTradeController'
                },
                'mainMenu@billMonthPayTrade':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billMonthPayTrade':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billMonthPayTrade.js?v=07d3258bec'
                    ])
                }]
            }
        })
        .state('billMonthIdentity',{  /*计费中心--手续费账户月账单--身份认证*/
            url:'/billMonthIdentity',
            views:{
                '':{
                    templateUrl:'page/billing/billMonthIdentity.html?v=490f9e9053',
                    controller:'BillMonthIdentityController'
                },
                'mainMenu@billMonthIdentity':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billMonthIdentity':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billMonthIdentity.js?v=ddecb7338b'
                    ])
                }]
            }
        })
        .state('billMonthPhone',{  /*计费中心--手续费账户月账单--手机号认证*/
            url:'/billMonthPhone',
            views:{
                '':{
                    templateUrl:'page/billing/billMonthPhone.html?v=e9213488ba',
                    controller:'BillMonthPhoneController'
                },
                'mainMenu@billMonthPhone':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billMonthPhone':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billMonthPhone.js?v=948bc5ca56'
                    ])
                }]
            }
        })
        .state('billMonthCard',{  /*计费中心--手续费账户月账单--卡信息认证*/
            url:'/billMonthCard',
            views:{
                '':{
                    templateUrl:'page/billing/billMonthCard.html?v=902667f369',
                    controller:'BillMonthCardController'
                },
                'mainMenu@billMonthCard':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billMonthCard':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billMonthCard.js?v=c155031715'
                    ])
                }]
            }
        })
        .state('billMonthWhite',{  /*计费中心--手续费账户月账单--白名单采集*/
            url:'/billMonthWhite',
            views:{
                '':{
                    templateUrl:'page/billing/billMonthWhite.html?v=e774aaf355',
                    controller:'BillMonthWhiteController'
                },
                'mainMenu@billMonthWhite':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billMonthWhite':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billMonthWhite.js?v=5217c658d8'
                    ])
                }]
            }
        })
        .state('billMonthMessage',{  /*计费中心--手续费账户月账单--短信服务*/
            url:'/billMonthMessage',
            views:{
                '':{
                    templateUrl:'page/billing/billMonthMessage.html?v=24bc043b3c',
                    controller:'BillMonthMessageController'
                },
                'mainMenu@billMonthMessage':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billMonthMessage':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billMonthMessage.js?v=7c070fbc6e'
                    ])
                }]
            }
        })
        .state('billMonthAccount',{  /*计费中心--手续费账户月账单--短信服务*/
            url:'/billMonthAccount',
            views:{
                '':{
                    templateUrl:'page/billing/billMonthAccount.html?v=2632b7ccc7',
                    controller:'BillMonthAccountController'
                },
                'mainMenu@billMonthAccount':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'billingMenu@billMonthAccount':{
                    templateUrl:'page/menu/billingMenu.html?v=042b12d31e'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/billMonthAccount.js?v=4b2abbc610'
                    ])
                }]
            }
        })
        /*金融平台*/
        .state('cardManage',{  /*金融平台--卡种管理*/
            url:'/cardManage',
            views:{
                '':{
                    templateUrl:'page/finance/cardManage.html?v=9e28620a97',
                    controller:'CardManageController'
                },
                'mainMenu@cardManage':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'financeMenu@cardManage':{
                    templateUrl:'page/menu/financeMenu.html?v=1e663d44d1'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/cardManage.js?v=c622866c08'
                    ])
                }]
            }
        })
        .state('memberManage',{  /*金融平台--会员管理*/
            url:'/memberManage',
            views:{
                '':{
                    templateUrl:'page/finance/memberManage.html?v=ba821d81bf',
                    controller:'MemberManageController'
                },
                'mainMenu@memberManage':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'financeMenu@memberManage':{
                    templateUrl:'page/menu/financeMenu.html?v=1e663d44d1'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/memberManage.js?v=5c115b7019'
                    ])
                }]
            }
        })
        .state('memberCardInfo',{  /*金融平台--会员卡信息*/
            url:'/memberCardInfo',
            views:{
                '':{
                    templateUrl:'page/finance/memberCardInfo.html?v=fe040ab677',
                    controller:'MemberCardInfoController'
                },
                'mainMenu@memberCardInfo':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'financeMenu@memberCardInfo':{
                    templateUrl:'page/menu/financeMenu.html?v=1e663d44d1'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/memberCardInfo.js?v=fc0bc2c1c2'
                    ])
                }]
            }
        })
        .state('financeTrade',{  /*金融平台--交易查询*/
            url:'/financeTrade',
            views:{
                '':{
                    templateUrl:'page/finance/financeTrade.html?v=99219ecce6',
                    controller:'FinanceTradeController'
                },
                'mainMenu@financeTrade':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'financeMenu@financeTrade':{
                    templateUrl:'page/menu/financeMenu.html?v=1e663d44d1'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/financeTrade.js?v=6643198b49'
                    ])
                }]
            }
        })
        .state('profitTrade',{  /*金融平台--分红查询*/
            url:'/profitTrade',
            views:{
                '':{
                    templateUrl:'page/finance/profitTrade.html?v=9a8ee1072b',
                    controller:'ProfitTradeController'
                },
                'mainMenu@profitTrade':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'financeMenu@profitTrade':{
                    templateUrl:'page/menu/financeMenu.html?v=1e663d44d1'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/profitTrade.js?v=e6ae3626c6'
                    ])
                }]
            }
        })
        .state('bill',{  /*金融平台--账单*/
            url:'/bill',
            views:{
                '':{
                    templateUrl:'page/finance/bill.html?v=a92b74b6e0',
                    controller:'BillController'
                },
                'mainMenu@bill':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                },
                'financeMenu@bill':{
                    templateUrl:'page/menu/financeMenu.html?v=1e663d44d1'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/bill.js?v=aca20a7c64'
                    ])
                }]
            }
        })
        .state('login',{
            url:'/login',
            views:{
                '':{
                    templateUrl:'page/'+topIndex+'.html?v=d0fdc9f823',
                    controller:'LoginController'
                },
                'developerTopMenu@login':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@login':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/login.js?v=45adcb1e83'
                    ])
                }]
            }
        })
        .state('register',{
            url:'/register',
            views:{
                '':{
                    templateUrl:'page/register.html?v=71c4c2de7b',
                    controller:'RegisterController'
                },
                'developerTopMenu@register':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@register':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/register.js?v=29aed89ddb'
                    ])
                }]

            }
        })
        .state('agreement',{
            url:'/agreement',
            views:{
                '':{
                    templateUrl:'page/agreement.html?v=dd43be16cb'
                },
                'developerTopMenu@agreement':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@agreement':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('wsAgreement',{  /*交易中心--打印交易凭证*/
            url:'/wsAgreement?deviceId',
            views:{
                '':{
                    templateUrl:'page/wsAgreement.html?v=c521394099'  ,
                    controller:'WsAgreementController'
                },
                'mainMenu@wsAgreement':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58',
                    controller:'MainMenuController'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/wsAgreement.js?v=08c4d26f80'
                    ])
                }]

            }

        })
        .state('joinPay',{
            url:'/joinPay',
            views:{
                '':{
                    templateUrl:'page/develop/joinPay.html?v=e25ee5796d'
                    //controller:'JoinPayController'
                },
                'developerTopMenu@joinPay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@joinPay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('sdkDownload',{
            url:'/sdkDownload',
            views:{
                '':{
                    templateUrl:'page/develop/sdkDownload.html?v=f28d28bf9e'
                },
                'developerTopMenu@sdkDownload':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@sdkDownload':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }

        })
        .state('demoExperience',{
            url:'/demoExperience',
            views:{
                '':{
                    templateUrl:'page/develop/demoExperience.html?v=bbbc20df44'
                },
                'developerTopMenu@demoExperience':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@demoExperience':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })

        .state('userScan',{    /*API文档主扫*/
            url:'/userScan',
            views:{
                '':{
                    templateUrl:'page/develop/document/userScan.html?v=8773d06f17'
                },
                'developerTopMenu@userScan':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@userScan':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('h5Pay',{    /*H5聚合支付商户服务端*/
            url:'/h5Pay',
            views:{
                '':{
                    templateUrl:'page/develop/document/h5Pay.html?v=555a2a5e4f'
                },
                'developerTopMenu@h5Pay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@h5Pay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('publicPay',{    /*公众号支付文档*/
            url:'/publicPay',
            views:{
                '':{
                    templateUrl:'page/develop/document/publicPay.html?v=2951e222cc'
                },
                'developerTopMenu@publicPay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@publicPay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('webPay',{    /*网页支付文档*/
            url:'/webPay',
            views:{
                '':{
                    templateUrl:'page/develop/document/webPay.html?v=762f271162'
                },
                'developerTopMenu@webPay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@webPay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('mchScan',{    /*被扫商户接口文档*/
            url:'/mchScan',
            views:{
                '':{
                    templateUrl:'page/develop/document/mchScan.html?v=a941950b68'
                },
                'developerTopMenu@mchScan':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@mchScan':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('pcPay',{
            url:'/pcPay',
            views:{
                '':{
                    templateUrl:'page/product/pcPay.html?v=033721b6e7'
                },
                'developerTopMenu@pcPay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@pcPay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('appPay',{
            url:'/appPay',
            views:{
                '':{
                    templateUrl:'page/product/appPay.html?v=386ca1dffa'
                },
                'developerTopMenu@appPay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@appPay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('phonePay',{
            url:'/phonePay',
            views:{
                '':{
                    templateUrl:'page/product/phonePay.html?v=f937314aea'
                },
                'developerTopMenu@phonePay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@phonePay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('capacityPosPay',{//智能pos
            url:'/capacityPosPay',
            views:{
                '':{
                    templateUrl:'page/product/capacityPosPay.html?v=90e2664560'
                },
                'developerTopMenu@capacityPosPay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@capacityPosPay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                },
                'email@capacityPosPay': {
                    templateUrl:'page/menu/email.html?v=182355234e'
                }
            }
        })
        .state('officialPay',{//公众号支付
            url:'/officialPay',
            views:{
                '':{
                    templateUrl:'page/product/officialPay.html?v=20bddb6cdd'
                },
                'developerTopMenu@officialPay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@officialPay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('cardPay',{//卡牌支付
            url:'/cardPay',
            views:{
                '':{
                    templateUrl:'page/product/cardPay.html?v=ead80fd0f1'
                },
                'developerTopMenu@cardPay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@cardPay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                },
                'email@cardPay': {
                    templateUrl:'page/menu/email.html?v=182355234e'
                }
            }
        })
        .state('scanPay',{//扫码支付
            url:'/scanPay',
            views:{
                '':{
                    templateUrl:'page/product/scanPay.html?v=5c1ce56930'
                },
                'developerTopMenu@scanPay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@scanPay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('userScanPay',{//扫码支付
            url:'/userScanPay',
            views:{
                '':{
                    templateUrl:'page/product/userScanPay.html?v=511e85f6bf'
                },
                'developerTopMenu@userScanPay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@userScanPay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                }
            }
        })
        .state('crossPay',{//跨境支付
            url:'/crossPay',
            views:{
                '':{
                    templateUrl:'page/product/crossPay.html?v=fe83891d32'
                },
                'developerTopMenu@crossPay':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@crossPay':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                },
                'email@crossPay': {
                    templateUrl:'page/menu/email.html?v=182355234e'
                }
            }
        })
        .state('auth',{//账户
            url:'/auth',
            views:{
                '':{
                    templateUrl:'page/product/auth.html?v=232cd5545e'
                },
                'developerTopMenu@auth':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@auth':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                },
                'email@auth': {
                    templateUrl:'page/menu/email.html?v=182355234e'
                }
            }
        })
        .state('noteServe',{//短信
            url:'/noteServe',
            views:{
                '':{
                    templateUrl:'page/product/noteServe.html?v=e2f643cc8c'
                },
                'developerTopMenu@noteServe':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@noteServe':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                },
                'email@noteServe': {
                    templateUrl:'page/menu/email.html?v=182355234e'
                }
            }
        })
        .state('account',{//账户
            url:'/account',
            views:{
                '':{
                    templateUrl:'page/product/account.html?v=75e28f5b17'
                },
                'developerTopMenu@account':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@account':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                },
                'email@account': {
                    templateUrl:'page/menu/email.html?v=182355234e'
                }
            }
        })

        .state('bankCollaborate',{//银行支付
            url:'/bankCollaborate',
            views:{
                '':{
                    templateUrl:'page/product/bankCollaborate.html?v=efb4b1f84e'
                },
                'developerTopMenu@bankCollaborate':{
                    templateUrl:'page/menu/developerTopMenu.html?v=7adc43913f'
                },
                'frontFooter@bankCollaborate':{
                    templateUrl:'page/menu/frontFooter.html?v=a266dc8746'
                },
                'email@bankCollaborate': {
                    templateUrl:'page/menu/email.html?v=182355234e'
                }
            }
        })
        /*九盈注册页面*/
        .state('joinRegister',{
            url:'/joinRegister',
            views:{
                '':{
                    templateUrl:'page/join/register.html?v=71c4c2de7b',
                    controller:'JoinRegisterController'
                },
                'joinTopMenu@joinRegister':{
                    templateUrl:'page/join/include/topMenu.html?v=8c73c576e1'
                },
                'joinAgreement@joinRegister':{
                    templateUrl:'page/join/include/joinAgreement.html?v=152f00942d'
                },
                'joinFooter@joinRegister':{
                    templateUrl:'page/join/include/footer.html?v=42685101f9'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/join/joinRegister.js?v=e7190a996e'
                    ])
                }]

            }
        })
        /*九盈注册成功页面*/
        .state('joinRegisterSucc',{
            url:'/joinRegisterSucc',
            views:{
                '':{
                    templateUrl:'page/join/joinRegisterSucc.html?v=24709aec35',
                    controller:'JoinRegisterSuccController'
                },
                'joinTopMenu@joinRegisterSucc':{
                    templateUrl:'page/join/include/topMenu.html?v=8c73c576e1'
                },
                'joinFooter@joinRegisterSucc':{
                    templateUrl:'page/join/include/footer.html?v=42685101f9'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/join/joinRegisterSucc.js?v=fa93e5e3b6'
                    ])
                }]

            }
        })
        /*九盈忘记密码页面*/
        .state('joinForgetPwd',{
            url:'/joinForgetPwd',
            views:{
                '':{
                    templateUrl:'page/join/forgetPwd.html?v=9fad4a98a0',
                    controller:'JoinForgetPwdController'
                },
                'joinTopMenu@joinForgetPwd':{
                    templateUrl:'page/join/include/topMenu.html?v=8c73c576e1'
                },
                'joinFooter@joinForgetPwd':{
                    templateUrl:'page/join/include/footer.html?v=42685101f9'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/join/forgetPwd.js?v=77b9e1656c'
                    ])
                }]

            }
        })
        /*九盈设置密码页面*/
        .state('joinSetPwd',{
            url:'/joinSetPwd',
            views:{
                '':{
                    templateUrl:'page/join/setPwd.html?v=a298e03510',
                    controller:'JoinSetPwdController'
                },
                'joinTopMenu@joinSetPwd':{
                    templateUrl:'page/join/include/topMenu.html?v=8c73c576e1'
                },
                'joinFooter@joinSetPwd':{
                    templateUrl:'page/join/include/footer.html?v=42685101f9'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/join/setPwd.js?v=e0436a82c5'
                    ])
                }]

            }
        })
        .state('todayDealDetail',{  /*银行机构商--今日交易明细*/
            url:'/todayDealDetail',
            views:{
                '':{
                    templateUrl:'page/bankOrgan/todayDealDetail.html?v=b1dd362168'  ,
                    controller:'TodayDealDetailController'
                },
                'mainMenu@todayDealDetail':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@todayDealDetail':{
                    templateUrl:'page/menu/bankOrganMenu.html?v=f511e83293'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/todayDealDetail.js?v=5be5d8b8f1'
                    ])
                }]
            }
        })
        .state('historyDealDetail',{  /*银行机构商--历史交易明细*/
            url:'/historyDealDetail',
            views:{
                '':{
                    templateUrl:'page/bankOrgan/historyDealDetail.html?v=95c242dc94'  ,
                    controller:'HistoryDealDetailController'
                },
                'mainMenu@historyDealDetail':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@historyDealDetail':{
                    templateUrl:'page/menu/bankOrganMenu.html?v=f511e83293'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/historyDealDetail.js?v=832739e755'
                    ])
                }]
            }
        })
        .state('agentDayBill',{  /*银行机构商--机构日账单*/
            url:'/agentDayBill',
            views:{
                '':{
                    templateUrl:'page/bankOrgan/agentDayBill.html?v=384556b8cb'  ,
                    controller:'AgentDayBillController'
                },
                'mainMenu@agentDayBill':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@agentDayBill':{
                    templateUrl:'page/menu/bankOrganMenu.html?v=f511e83293'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/agentDayBill.js?v=c60e1124e6'
                    ])
                }]
            }
        })
        .state('agentMonthBill',{  /*银行机构商--机构月账单*/
            url:'/agentMonthBill',
            views:{
                '':{
                    templateUrl:'page/bankOrgan/agentMonthBill.html?v=d9551086b3'  ,
                    controller:'AgentMonthBillController'
                },
                'mainMenu@agentMonthBill':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@agentMonthBill':{
                    templateUrl:'page/menu/bankOrganMenu.html?v=f511e83293'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/agentMonthBill.js?v=ee9f92c9bc'
                    ])
                }]
            }
        })
        .state('mchManage',{  /*银行机构商--商户管理*/
            url:'/mchManage',
            views:{
                '':{
                    templateUrl:'page/bankOrgan/mchManage.html?v=0ff8b015a3'  ,
                    controller:'MchManageController'
                },
                'mainMenu@mchManage':{
                    templateUrl:'page/menu/mainMenu.html?v=ad3aae2b58' ,
                    controller:'MainMenuController'
                },
                'transMenu@mchManage':{
                    templateUrl:'page/menu/bankOrganMenu.html?v=f511e83293'
                }
            },
            resolve:{
                load:['$ocLazyLoad',function($ocLazyLoad){
                    return $ocLazyLoad.load([
                        'js/controller/mchManage.js?v=2806fcb789'
                    ])
                }]
            }
        })

      $locationProvider.html5Mode(true);

})
function setStyle(createCss){
    var $obj = setView()[location.href.substring(location.href.lastIndexOf('//') + 2).split('.')[0]];
    var  topIndex = 'login';
    if($obj){
        var topIndex = $obj.viewUrl;
        if(createCss) $('body').append('<link rel="stylesheet" href='+$obj['cssUrl']+'>');
        $('.ipaynow-brand').css({
            backgroundImage: 'url('+$obj['logoUrl']+')',
            backgroundPosition: '0',
            backgroundSize: '100% 100%'
        });
        $('.zlogo img').attr('src',$obj['logoUrl']);
    };
    if(createCss) return topIndex;
};
function setView(){
    return {
        'test': {
            logoUrl: 'image/views/csh/logo.png',
            cssUrl:  'css/theme/csh.min.css',
            viewUrl: 'views/index-csh'
        },
        'bosc':{
            logoUrl: 'image/views/sh/shLogoBig.png',
            viewUrl: 'views/index-sh',
            flag:'sh'
        },
        'bosc-test':{
            logoUrl: 'image/views/sh/shLogoBig.png',
            viewUrl: 'views/index-sh',
            flag:'sh'
        }
    }
}
function siteDispose(rootScope) {
    var siteObject = {
        '/joinPay': '接入支付',
        '/sdkDownload': 'SDK下载',
        '/demoExperience': 'Demo体验下载',
        '/pcPay': 'PC网页支付',
        '/appPay': '手机App支付',
        '/phonePay': '手机网页支付',
        '/capacityPosPay': '智能POS支付',
        '/officialPay': '公众号支付',
        '/cardPay': '卡牌支付',
        '/userScanPay': '用户扫码支付',
        '/scanPay': '商户扫码支付',
        '/h5Pay': 'H5支付',
        '/publicPay': '公众号支付',
        '/userScan': '用户扫码',
        '/webPay': 'PC网页支付',
        '/mchScan': '商户扫码',
        '/noteServe': '短信服务',
        '/auth': '鉴权服务',
        '/account': '二类账户',
        '/bankCollaborate': '银行合作',
        '/crossPay': '跨境支付',
        '/login': '登录',
        '/register': '注册',
        '/sendEmail': '找回密码',
        '/setPwd': '重置密码'

    };
    if(siteObject[rootScope.isActive]) rootScope.siteText = siteObject[rootScope.isActive];
    //navbar-product-dark 类名
    rootScope.isProductDark = ['/account','/pcPay', '/crossPay', '/bankCollaborate','/noteServe','/auth'].some(function(item){//红色房子-黑色logo-黑色字体navbar-product-dark
        return rootScope.isActive == item;
    });
    //navbar-product-def
    rootScope.isProductDef = ['/appPay','/phonePay','/officialPay','/scanPay', '/userScanPay', '/cardPay', '/capacityPosPay'].some(function(item){//黑色房子-白色logo-白色字体
        return rootScope.isActive == item;
    });
    //navbar-product-white//红色房子白色字体白色logo 默认
    //高的菜单，开发文档
    rootScope.isMenuHeight = ['/userScan','/h5Pay','/mchScan','/publicPay', '/webPay'].some(function(item){//黑色房子-白色logo-白色字体
        return rootScope.isActive == item;
    });

};

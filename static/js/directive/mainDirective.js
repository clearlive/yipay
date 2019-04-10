var tip=angular.module("tip",[]);tip.directive("tip",function(){return{restrict:"EA",transclude:!0,scope:{conf:"="},templateUrl:"page/directive/tip.html",link:function(scope,element,attrs){scope.conf.showTipContent=!1,scope.hideTipContent=function(close){scope.conf.showTipContent=!1,null==close&&scope.conf.clickfunction&&scope.conf.clickfunction()}}}});var agreement=angular.module("agreement",[]);agreement.directive("agreement",function(){return{restrict:"EA",transclude:!0,scope:{conf:"="},templateUrl:"page/directive/agreement.html",link:function(scope,element,attrs){scope.conf.showAgreementContent=!1,scope.hideAgreementContent=function(){scope.conf.showAgreementContent=!1}}}});var entry=angular.module("entry",[]);entry.directive("entry",function($http,$location,$rootScope){return{restrict:"EA",transclude:!0,scope:{conf:"="},templateUrl:"page/directive/entry.html?datestamp="+(new Date).getTime(),link:function(scope,element,attrs){scope.conf.showEntryContent=!1;var basePath=scope.$parent.basePath;scope.conf.verifyCode=basePath+"login/getAuthCode.do?name="+Math.random(),scope.hideTipContent=function(){scope.conf.showEntryContent=!1},scope.changeCode=function(){scope.conf.verifyCode=basePath+"login/getAuthCode.do?name="+Math.random()},scope.login=function(){var pwd=scope.conf.passWord,email=scope.conf.user.userName,length=pwd.length,pwdMd5=hex_md5(email+length+pwd).substring(16);scope.conf.user.passWord=pwdMd5,$http({method:"POST",url:basePath+"login/login.do",data:$.param(scope.conf.user),dataType:"json",headers:{"Content-Type":"application/x-www-form-urlencoded"}}).success(function(data){"success"==data.respCode?($rootScope.$emit("userId",data.dataObject.id),$location.path("/home")):(alert(data.respMsg),scope.conf.verifyCode=basePath+"login/getAuthCode.do?name="+Math.random())})}}}}),entry.directive("pathContent",function($http,$location,$rootScope){return{restrict:"E",transclude:!0,scope:{cur:"=cur"},templateUrl:"page/directive/path.html?datestamp="+(new Date).getTime(),link:function(scope,element,attrs){scope.$watch("cur",function(newVal){var index=parseInt(newVal)-1;element.find(".common-point-content").removeClass("active-point-content"),element.find(".common-point-content").eq(index).addClass("blue-point-content"),element.find(".common-point-content").eq(index).addClass("active-point-content");for(var i=0;i<index;i++)element.find(".common-point-content").eq(i).addClass("blue-point-content"),element.find(".common-line-content").eq(i).addClass("blue-line-content")})}}});var datatime=angular.module("datatime",[]);datatime.directive("ngTime",function(){return{restrict:"A",link:function($scope,$element,$attrs){var date,startDate,endDate,startView=2;if("today"==$attrs.maxDate){date=new Date;todayPre=new Date(date.getTime()-1728e5);startDate=new Date(todayPre.getFullYear(),todayPre.getMonth(),todayPre.getDate(),"00","00","00"),endDate=new Date(date.getFullYear(),date.getMonth(),date.getDate(),"23","59","59"),startView=1}else if("yesterday"==$attrs.maxDate){date=new Date,startDate="";var preDate=new Date(date.getTime()-864e5);endDate=new Date(preDate.getFullYear(),preDate.getMonth(),preDate.getDate(),"23","59","59")}else if("threemonth"==$attrs.minDate){date=new Date;var todayPre=new Date(date.getTime()-79488e5);startDate=new Date(todayPre.getFullYear(),todayPre.getMonth(),todayPre.getDate(),"00","00","00"),endDate=new Date(date.getFullYear(),date.getMonth(),date.getDate(),"23","59","59")}$element.datetimepicker({format:"yyyy-mm-dd hh:ii:ss",language:"zh-CN",startDate:startDate,endDate:endDate,weekStart:1,todayBtn:1,todayHighlight:1,startView:startView,autoclose:1,minView:1})}}}),datatime.directive("ngDay",function(){return{restrict:"A",link:function($scope,$element,$attrs){$element.datetimepicker({format:"yyyy-mm-dd",language:"zh-CN",weekStart:1,todayBtn:1,todayHighlight:1,startView:2,autoclose:1,minView:2})}}}),datatime.directive("ngMonth",function(){return{restrict:"A",link:function($scope,$element,$attrs){$element.datetimepicker({format:"yyyy-mm",language:"zh-CN",startView:3,autoclose:1,minView:3})}}});var input=angular.module("input",[]);input.directive("commonInput",function(){return{restrict:"A",link:function($scope,$element){$element.focus(function(){$element.prev().animate({top:"-15px"},"fast"),$element.prev().css({color:"#c0c0c0",fontSize:"12px"})}),$element.blur(function(){""==$element.val().trim()&&($element.prev().animate({top:"7px"},"fast"),$element.prev().css({color:"#595959",fontSize:"14px"}))})}}}),input.directive("commonDataTimePicker",function(){return{restrict:"A",link:function($scope,$element){$element.focus(function(){$element.prev().animate({top:"-15px"},"fast"),$element.prev().css({color:"#c0c0c0",fontSize:"12px"})}),$element.blur(function(){var flag=!1;$("body").find(".datetimepicker").each(function(){if($(this).is(":visible"))return flag=!0}),""==$element.val().trim()&&0==flag&&($element.prev().animate({top:"7px"},"fast"),$element.prev().css({color:"#595959",fontSize:"14px"}))})}}}),input.directive("commonInputUl",function(){return{restrict:"A",link:function($scope,$element){$element.focus(function(){$element.prev().animate({top:"-15px"},"fast"),$element.prev().css({color:"#c0c0c0",fontSize:"12px"})}),$element.blur(function(){""==$element.val().trim()&&$element.parent().find("ul").is(":hidden")&&($element.prev().animate({top:"7px"},"fast"),$element.prev().css({color:"#595959",fontSize:"14px"}))})}}}),input.directive("ngFocus",function(){return{restrict:"A",require:"ngModel",link:function(scope,element,attrs,ctrl){ctrl.$focused=!1,element.bind("focus",function(evt){element.addClass("ng-focused"),scope.$apply(function(){ctrl.$focused=!0})}).bind("blur",function(){element.removeClass("ng-focused"),scope.$apply(function(){ctrl.$focused=!1})})}}}),input.directive("compare",function(){var o={};return o.strict="AE",o.scope={orgText:"=compare"},o.require="ngModel",o.link=function(sco,ele,att,con){con.$validators.compare=function(v){return""==v||v==sco.orgText},sco.$watch("orgText",function(){con.$validate()})},o}),input.directive("compareNull",function(){var o={};return o.strict="AE",o.scope={orgText:"=compareNull"},o.require="ngModel",o.link=function(sco,ele,att,con){con.$validators.compareNull=function(v){return v==sco.orgText},sco.$watch("orgText",function(){con.$validate()})},o}),input.directive("compareagent",function(){var o={};return o.strict="AE",o.scope={orgText:"=compareagent"},o.require="ngModel",o.link=function(sco,ele,att,con){con.$validators.compareagent=function(v){return 2!=sco.orgText.type||(""==v||null==v||v==sco.orgText.name)},sco.$watch("orgText",function(){con.$validate()},!0)},o}),input.directive("comparerate",function(){var o={};return o.strict="AE",o.scope={orgText:"=comparerate"},o.require="ngModel",o.link=function(sco,ele,att,con){con.$validators.comparerate=function(v){var regu=/^\d+(\.\d+)?$/,re=new RegExp(regu);return""==v||null==v||!re.test(v)||parseFloat(v)>=parseFloat(sco.orgText)},sco.$watch("orgText",function(){con.$validate()},!0)},o}),input.directive("testcode",function(){var o={};return o.strict="AE",o.scope={orgText:"=testcode"},o.require="ngModel",o.link=function(sco,ele,att,con){con.$validators.testcode=function(v){return""==v||null==v||!!/[\,\\\/\:\*\?\"\<\>\|]+/.test(v)&&void 0},sco.$watch("orgText",function(){con.$validate()},!0)},o}),input.directive("idnumber",function(){return{require:"ngModel",link:function(scope,ele,attrs,ctrl){ctrl.$validators.idnumber=function(modelValue,viewValue){if(modelValue){var Y,JYM,S,idcard=modelValue,area=(new Array("验证通过!","身份证号码位数不对!","身份证号码出生日期超出范围或含有非法字符!","身份证号码校验错误!","身份证地区非法!"),{11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外"}),idcard_array=new Array;if(idcard_array=idcard.split(""),null==area[parseInt(idcard.substr(0,2))])return!1;switch(idcard.length){case 15:return(parseInt(idcard.substr(6,2))+1900)%400==0||(parseInt(idcard.substr(6,2))+1900)%100!=0&&(parseInt(idcard.substr(6,2))+1900)%4==0?ereg=/^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}$/:ereg=/^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}$/,!!ereg.test(idcard);case 18:return parseInt(idcard.substr(6,4))%400==0||parseInt(idcard.substr(6,4))%100!=0&&parseInt(idcard.substr(6,4))%4==0?ereg=/^[1-9][0-9]{5}(19|20)[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}[0-9Xx]$/:ereg=/^[1-9][0-9]{5}(19|20)[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}[0-9Xx]$/,!!ereg.test(idcard)&&(S=7*(parseInt(idcard_array[0])+parseInt(idcard_array[10]))+9*(parseInt(idcard_array[1])+parseInt(idcard_array[11]))+10*(parseInt(idcard_array[2])+parseInt(idcard_array[12]))+5*(parseInt(idcard_array[3])+parseInt(idcard_array[13]))+8*(parseInt(idcard_array[4])+parseInt(idcard_array[14]))+4*(parseInt(idcard_array[5])+parseInt(idcard_array[15]))+2*(parseInt(idcard_array[6])+parseInt(idcard_array[16]))+1*parseInt(idcard_array[7])+6*parseInt(idcard_array[8])+3*parseInt(idcard_array[9]),Y=S%11,"F",JYM="10X98765432",JYM.substr(Y,1)==idcard_array[17]);default:return!1}}return!0}}}}),input.directive("banknum",function(){return{require:"ngModel",link:function(scope,ele,attrs,ctrl){ctrl.$validators.banknum=function(modelValue,viewValue){if(modelValue){for(var bankno=modelValue,lastNum=bankno.substr(bankno.length-1,1),first15Num=bankno.substr(0,bankno.length-1),newArr=new Array,i=first15Num.length-1;i>-1;i--)newArr.push(first15Num.substr(i,1));for(var arrJiShu=new Array,arrJiShu2=new Array,arrOuShu=new Array,j=0;j<newArr.length;j++)(j+1)%2==1?2*parseInt(newArr[j])<9?arrJiShu.push(2*parseInt(newArr[j])):arrJiShu2.push(2*parseInt(newArr[j])):arrOuShu.push(newArr[j]);for(var jishu_child1=new Array,jishu_child2=new Array,h=0;h<arrJiShu2.length;h++)jishu_child1.push(parseInt(arrJiShu2[h])%10),jishu_child2.push(parseInt(arrJiShu2[h])/10);for(var sumJiShu=0,sumOuShu=0,sumJiShuChild1=0,sumJiShuChild2=0,sumTotal=0,m=0;m<arrJiShu.length;m++)sumJiShu+=parseInt(arrJiShu[m]);for(var n=0;n<arrOuShu.length;n++)sumOuShu+=parseInt(arrOuShu[n]);for(var p=0;p<jishu_child1.length;p++)sumJiShuChild1+=parseInt(jishu_child1[p]),sumJiShuChild2+=parseInt(jishu_child2[p]);return sumTotal=parseInt(sumJiShu)+parseInt(sumOuShu)+parseInt(sumJiShuChild1)+parseInt(sumJiShuChild2),lastNum==10-(parseInt(sumTotal)%10==0?10:parseInt(sumTotal)%10)}return!0}}}}),input.directive("mouseOverLeave",function(){return{restrict:"A",scope:{hover:"="},link:function(scope,elem,attr){elem.bind("mouseover",function(){$(".wx-code").fadeIn()}),elem.bind("mouseleave",function(){$(".wx-code").fadeOut()})}}}),input.directive("clickAndDisable",function(){return{scope:{clickAndDisable:"&"},link:function(scope,iElement,iAttrs){iElement.bind("click",function(){iElement.prop("disabled",!0),scope.clickAndDisable().finally(function(){iElement.prop("disabled",!1)})})}}}),input.directive("comparemoney",function(){var o={};return o.strict="AE",o.scope={orgText:"=comparemoney"},o.require="ngModel",o.link=function(sco,ele,att,con){con.$validators.comparemoney=function(v){return(v=parseFloat(v))<=parseFloat(sco.orgText)},sco.$watch("orgText",function(){con.$validate()})},o}),input.directive("ngImgMax",function(){return{restrict:"A",link:function(scope,element,attrs){$(element).viewer({navbar:!1})}}}),input.directive("checkposimg",function(){var o={};return o.strict="AE",o.scope={orgText:"=checkposimg"},o.require="ngModel",o.link=function(sco,ele,att,con){con.$validators.checkposimg=function(v){return!(sco.orgText>3)||""!=v&&void 0!=v&&null!=v},sco.$watch("orgText",function(){con.$validate()})},o}),input.directive("fuzzyModel",function(){return{restrict:"EA",transclude:!0,scope:{fuzzyId:"=fuzzyId",fuzzyName:"=fuzzyName",fuzzyList:"=fuzzyList",fuzzyLabel:"=fuzzyLabel"},template:'<input type="hidden" ng-model="fuzzyId"/><label class="common-label fuzzy_label">{{fuzzyLabel}}</label><input class="form-control common-input" ng-focus="searchList()" autocomplete="off" ng-change="changeName()"   ng-keyup="searchList()" common-input-ul  type="text" ng-model="fuzzyName"/><ul class="bank-select-ul" ng-show="selectContent"><li ng-repeat="item in fuzzyList" ng-click="selectItem(item.id,item.name,$event)">{{item.name}}</li></ul>',link:function(scope,element,attrs){scope.selectContent=!1,setTimeout(function(){if(scope.fuzzyAllList=scope.fuzzyList,null!=scope.fuzzyId&&""!=scope.fuzzyId){for(var index in scope.fuzzyAllList)if(scope.fuzzyAllList[index].id==scope.fuzzyId){scope.fuzzyName=scope.fuzzyAllList[index].name;break}$(".fuzzy_label").css({top:"-15px",color:"rgb(192, 192, 192)",fontSize:"12px"})}},2e3),scope.searchList=function(){scope.selectContent=!0;var bankAll=scope.fuzzyList,newBankList=[];if(void 0!=scope.fuzzyName){for(var index in bankAll)-1!=bankAll[index].name.indexOf(scope.fuzzyName)&&newBankList.push(bankAll[index]);scope.fuzzyList=newBankList}else scope.fuzzyList=bankAll},scope.selectItem=function(id,name,$event){scope.fuzzyName=name,scope.fuzzyId=id,scope.selectContent=!1,$($event.target).parent().parent().find("label").css({top:"-15px",color:"rgb(192, 192, 192)",fontSize:"12px"})},scope.changeName=function(){""!=scope.fuzzyName&&null!=scope.fuzzyName||(scope.fuzzyList=scope.fuzzyAllList)}}}}),input.directive("backToTop",function(){return{restrict:"E",link:function(scope,element,attr){var e=$(element);$(window).scroll(function(){$(document).scrollTop()>300?e.addClass("showme"):e.removeClass("showme")}),e.click(function(){$("html,body").animate({scrollTop:0},500)})}}}),input.directive("export",function($rootScope,$http,$location){return{restrict:"E",template:'<button type="button" class="btn common-btn-white pull-right" ng-disabled="downloadDisabled" ng-click="exportSubAgent()">{{downloadText}}</button>',scope:{data:"="},link:function(scope,element,attrs){scope.downloadText="导出数据",scope.downloadDisabled=!1,scope.exportSubAgent=function(){scope.downloadDisabled=!0,scope.downloadText="导出中",$http({method:"POST",dataType:"json",url:$rootScope.basePath+scope.data.src,data:$.param(scope.data.data),headers:{"Content-Type":"application/x-www-form-urlencoded"},timeout:1e4}).success(function(data){"failure_session"==data.respCode?$location.path("/index"):(scope.downloadDisabled=!1,scope.downloadText="导出数据","success"==data.respCode?(scope.data.tipConf.showTipContent=!0,scope.data.tipConf.src="image/yes.png",scope.data.tipConf.title="账单已加入下载列表",scope.data.tipConf.subtitle="请点击下载管理中心按钮查看"):(scope.data.tipConf.showTipContent=!0,scope.data.tipConf.src="image/no.png",scope.data.tipConf.title=data.respMsg,scope.data.tipConf.subtitle="",scope.downloadText="导出数据",scope.downloadDisabled=!1))}).error(function(){scope.data.tipConf.showTipContent=!0,scope.data.tipConf.src="image/no.png",scope.data.tipConf.title="系统繁忙，请稍后重试",scope.data.tipConf.subtitle="",scope.downloadText="导出数据",scope.downloadDisabled=!1})}}}}),input.directive("reset",function($rootScope){var dataObj;return{restrict:"E",template:'<button type="button" class="btn common-btn-white  center-block" ng-click="resetClick()">重置</button>',scope:{data:"="},link:function(scope,element,attrs){dataObj=attrs.original,dataObj=$.parseJSON(dataObj),scope.resetClick=function(){for(var j in scope.data){scope.data[j]="";for(var k in dataObj){if(k==j){scope.data[j]=dataObj[k];break}scope.data[j]=""}}$(".auth_form .common-label").not(".time-label").css({color:"#595959",fontSize:"14px",top:"7px"})}}}}),input.directive("searchBtn",function(){return{restrict:"A",link:function(scope,element,attrs){element.bind("click",function(){1==scope.paginationConf.currentPage?scope.getAllEmployee():scope.paginationConf.currentPage=1})}}}),input.directive("joinCommonInput",function(){return{restrict:"A",link:function($scope,$element){$element.focus(function(){$element.prev().animate({bottom:"0px"}),$element.prev().css({color:"#2e3a4b"})}),$element.blur(function(){""==$element.val().trim()&&($element.prev().animate({bottom:"-19px"}),$element.prev().css({color:"#9b9b9b"}))})}}});var docSide=angular.module("docSide",[]);docSide.directive("docSideBar",function(){return{restrict:"EA",transclude:!0,scope:{conf:"="},templateUrl:"page/directive/docSide.html",link:function(scope,element,attrs){"noProduct"==attrs.menu?(scope.showProduct=!1,scope.index=2):(scope.showProduct=!0,scope.index=3),scope.docTitle=attrs.doctitle;var hideMenu;attrs.hideMenu&&(hideMenu=attrs.hideMenu.split(","));for(var i=0 in hideMenu){var str=hideMenu[i];$("#"+str).parent().hide()}var screenWidth=parseInt($(window).width());element.find(".drop-down").on("click",function(){$(this).next().slideToggle(),$(this).hasClass("up")?$(this).removeClass("up"):$(this).addClass("up")}),element.find(".menu-item>ol>li>a").on("click",function(){$(".menu-item>ol>li>a").removeClass("active"),$(this).addClass("active"),$(".doc-main-container>.doc-common-content").hide(),$(".doc-main-container>."+$(this).attr("id")).show(),screenWidth<770?$(".doc_top_menu").next().hide():$("html, body").animate({scrollTop:"280px"},100)}),$(".skip_link").click(function(e){var classTar,classArr=$(e.target).attr("class").split(" ");for(var i=0 in classArr)if(classArr[i].indexOf("jump")>=0){classTar=classArr[i].substr(5);break}$(".menu-item>ol>li>a").removeClass("active"),$("#"+classTar).addClass("active"),$(".doc-main-container>.doc-common-content").hide(),$(".doc-main-container>."+classTar).show(),$(".menu-item>ol").hide(),$("#"+classTar).parent().parent().show(),$("html, body").animate({scrollTop:0},100)}),angular.element(document).ready(function(){var headerHeight=$(".navbar_box_wrap").outerHeight(),footerHeight=$(".footer").outerHeight(),$sidebar=$(".doc-sidebar-wrapper"),screenHeight=$(window).height();$(window).on("load scroll resize",function(){var offsetTop=window.scrollY||window.pageYOffset,offsetBottom=document.body.scrollHeight-offsetTop-window.innerHeight,bottom=0;offsetBottom<footerHeight&&(bottom=footerHeight-offsetBottom);var wrapperHeight;screenWidth<765?($sidebar.css({position:"absolute"}),$(".doc-sidebar").css({paddingTop:"0px",height:"auto"})):(wrapperHeight=$(".doc-sidebar-wrapper").height()||0,$sidebar.find(".doc-sidebar").css({height:wrapperHeight}),offsetTop>headerHeight?($sidebar.css({position:"fixed"}),$(".doc-sidebar").css({paddingTop:"10px"}),$sidebar.find(".doc-sidebar").css({height:screenHeight-bottom})):($sidebar.css({position:"absolute"}),$(".doc-sidebar").css({paddingTop:"75px"})))})})}}});var sendEmail=angular.module("sendEmail",[]);sendEmail.directive("ngSendEmail",function($http,$rootScope,$timeout){return{restrict:"A",link:function(scope,element,attrs,ctrl){scope.btnText="发送信息",scope.btnDisabled=!1,element.on("click",function(){if(scope.sendForm.$invalid)return!1;scope.btnText="发送中...",scope.btnDisabled=!0,scope.user.inbox="ipaynow@ipaynow.cn",$http({method:"POST",url:$rootScope.basePath+"mailAction/sendMail.do",data:$.param(scope.user),dataType:"json",headers:{"Content-Type":"application/x-www-form-urlencoded"}}).success(function(data){if("success"==data.respCode){scope.btnText="发送成功",scope.btnDisabled=!1;$timeout(function(){scope.btnText="发送信息"},3e3)}else scope.btnText="发送失败",scope.btnDisabled=!1})})}}}),sendEmail.directive("ngBtnHover",function($http,$rootScope){return{restrict:"A",link:function(scope,element,attrs,ctrl){element.on("mouseenter",function(){$(this).parent(".fifth-contet-btn").addClass("fifth-contet-btn-h")}).on("mouseleave",function(){$(this).parent(".fifth-contet-btn").removeClass("fifth-contet-btn-h")})}}});
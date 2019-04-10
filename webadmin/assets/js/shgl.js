	function xg(obj){//修改用户
		$.ajax({
			url:'',
			data:{
				user:$(obj).attr("val"),
				action:'chakan',
			},
			type:'POST',
			dataType:'JSON',
			success:function(data){
				$('#xgshm').html(data.user);
				$('#xgyhm').attr("val",data.user);
				$('#xgjkms').val(data.apikey);				
				$('#xgfeilv').val(data.feilv);				
				$('#xgshouji').val(data.shouji);				
				$('#xgyouxiang').val(data.mail);				
				$('#xgyue').val(data.yue);				
				$("#xgsmrz option[value='"+data.shiming+"']").attr("selected",true);
				$('#xgsmrz').selected('destroy');
				$('#xgsmrz').selected();
				
				$("#xgapizt option[value='"+data.api+"']").attr("selected",true);
				$('#xgapizt').selected('destroy');
				$('#xgapizt').selected();
				
				$("#xgstatus option[value='"+data.status+"']").attr("selected",true);
				$('#xgstatus').selected('destroy');
				$('#xgstatus').selected();
				$('#xgyh').modal();
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			}
		})
	}
	
	function bc(obj){//保存修改
		$.ajax({
			url:'',
			data:{
				user:$(obj).attr("val"),
				xgstatus:$('#xgstatus').val(),
				xgsmrz:$('#xgsmrz').val(),
				xgapizt:$('#xgapizt').val(),
				xgjkms:$('#xgjkms').val(),
				xgfeilv:$('#xgfeilv').val(),
				xgmima:$('#xgmima').val(),
				xgyouxiang:$('#xgyouxiang').val(),
				xgshouji:$('#xgshouji').val(),
				xgyue:$('#xgyue').val(),
				action:'xiugai',
			},
			type:'POST',
			dataType:'JSON',
			success:function(data){
				if(data.ok){
					$('#ssssss').before('<div id="t1"><div class="am-alert am-alert-success" data-am-alert><button type="button" class="am-close">&times;</button><p>'+data.te+'</p></div></div>');
					setTimeout(function(){
						$("#t1").remove();
						window.location.reload();//刷新
					},1500);
				}else{
					$('#ssssss').before('<div id="t2"><div class="am-alert am-alert-warning" data-am-alert><button type="button" class="am-close">&times;</button><p>'+data.te+'</p></div></div>');
					setTimeout(function(){$("#t2").remove();
					},1500)
				}
			},
			error:function(){
				$('#ssssss').before('<div id="t3"><div class="am-alert am-alert-danger" data-am-alert><button type="button" class="am-close">&times;</button><p>获取数据失败</p></div></div>');
				setTimeout(function(){$("div#t3").remove();
				},1500)
			}
		})
	}

	
	function sc(obj){//删除用户
		$('#scmodal').modal({
			onConfirm: function() {
				$.ajax({
					url:'',
					data:{
						action:'shanchu',
						user:$(obj).attr('val'),
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//刷新
							},1000);
						}
					},
					error:function(){
						$('#ts').modal();
						$('#te').html("获取数据错误");
					}
				})
			},
			onCancel: function() {   //取消
				return
			}
		})
	}
	
	
	function randkey(randomFlag, min, max){//生成KEY
		var str = "",
			range = min,
			arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
 		if(randomFlag){
			range = Math.round(Math.random() * (max-min)) + min;
		}
		for(var i=0; i<range; i++){
			pos = Math.round(Math.random() * (arr.length-1));
			str += arr[pos];
		}
		$('#xgjkms').val(str);
	}
	
	function randmm(randomFlag, min, max){//生成密码
		var str = "",
			range = min,
			arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
 		if(randomFlag){
			range = Math.round(Math.random() * (max-min)) + min;
		}
		for(var i=0; i<range; i++){
			pos = Math.round(Math.random() * (arr.length-1));
			str += arr[pos];
		}
		$('#xgmima').val(str);
	}
	
	function cksm(obj){//查看实名详情
		$.ajax({
			url:'',
			data:{
				user:$(obj).attr("val"),
				action:'cksm',
			},
			type:'POST',
			dataType:'JSON',
			success:function(data){
				$('#yh').html(data.user);
				$('#xm').html(data.xingming);
				$('#xb').html(data.xingbie);
				$('#hm').html(data.sfzhm);
				$('#hj').html(data.hjszd);
				$('#dz').html(data.sfzdz);
				$('#zm').attr("src",data.sfzzm);	
				$('#fm').attr("src",data.sfzfm);
				$('#zmlj').attr("href",data.sfzzm);	
				$('#fmlj').attr("href",data.sfzfm);
				if(data.rzlx=="gr"){
					data.rzlx="个人认证";
				}else{
					data.rzlx="企业认证";
				}
				$('#rz').html(data.rzlx);
				$('#smxq').modal();
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			}
		})
	}

	
	function smts(){//未实名提示
		$("#ts").modal();
		$("#te").html("该商户还未实名认证！");
	}

	function apits(){//API提示
		$("#ts").modal();
		$("#te").html("该商户还未开通接口！");
	}

	function xgapi(obj){//修改API
		$.ajax({
			url:'',
			data:{
				user:$(obj).attr("val"),
				action:'xgapi',
			},
			type:'POST',
			dataType:'JSON',
			success:function(data){
				$('#xgapiyh').attr("val",data.username);
				
				$("#xgzhifubao option[value='"+data.alipay+"']").attr("selected",true);
				$('#xgzhifubao').selected('destroy');
				$('#xgzhifubao').selected();
				
				$("#xgweixin option[value='"+data.weixin+"']").attr("selected",true);
				$('#xgweixin').selected('destroy');
				$('#xgweixin').selected();
				
				$("#xgyinlian option[value='"+data.yinlian+"']").attr("selected",true);
				$('#xgyinlian').selected('destroy');
				$('#xgyinlian').selected();
				
				$("#xgweixingz option[value='"+data.weixingz+"']").attr("selected",true);
				$('#xgweixingz').selected('destroy');
				$('#xgweixingz').selected();
				
				$("#xgweixinh5 option[value='"+data.weixinh5+"']").attr("selected",true);
				$('#xgweixinh5').selected('destroy');
				$('#xgweixinh5').selected();
				
				$("#xgalipaywap option[value='"+data.alipaywap+"']").attr("selected",true);
				$('#xgalipaywap').selected('destroy');
				$('#xgalipaywap').selected();
				
				$('#xgapi').modal();
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			}
		})
	}
	
	function bcapi(obj){//保存商户api设置
//	alert($(obj).attr("val")+$('#xgzhifubao').val()+$('#xgweixin').val()+$('#xgyinlian').val());
//	return
		$.ajax({
			url:'',
			data:{
				user:$(obj).attr("val"),
				alipay:$('#xgzhifubao').val(),
				weixin:$('#xgweixin').val(),
				yinlian:$('#xgyinlian').val(),
				weixingz:$('#xgweixingz').val(),
				weixinh5:$('#xgweixinh5').val(),
				alipaywap:$('#xgalipaywap').val(),
				action:'bcapi',
			},
			type:'POST',
			dataType:'JSON',
			success:function(data){
				if(data.ok){
					$('#szapi').before('<div id="t1"><div class="am-alert am-alert-success" data-am-alert><button type="button" class="am-close">&times;</button><p>'+data.te+'</p></div></div>');
					setTimeout(function(){
						$("#t1").remove();
						window.location.reload();//刷新
					},1500);
				}else{
					$('#szapi').before('<div id="t2"><div class="am-alert am-alert-warning" data-am-alert><button type="button" class="am-close">&times;</button><p>'+data.te+'</p></div></div>');
					setTimeout(function(){$("#t2").remove();
					},1500)
				}
			},
			error:function(){
				$('#szapi').before('<div id="t3"><div class="am-alert am-alert-danger" data-am-alert><button type="button" class="am-close">&times;</button><p>获取数据失败</p></div></div>');
				setTimeout(function(){$("div#t3").remove();
				},1500)
			}
		})
	}

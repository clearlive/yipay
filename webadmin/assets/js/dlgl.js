	function xg(obj){//修改代理
		$.ajax({
			url:'',
			data:{
				agentuser:$(obj).attr("val"),
				action:'chakan',
			},
			type:'POST',
			dataType:'JSON',
			success:function(data){
				$('#xgdlmc').html(data.agentuser);
				$('#xgdlm').attr("val",data.agentuser);
				$('#xgmobile').val(data.mobile);				
				$('#xgemail').val(data.email);				
				$('#xgyue').val(data.yue);				
			//	$('#xgdllx').val(data.dllx);				
			//	$('#xglrlx').val(data.lrlx);				
				$('#xgzsxm').val(data.zsxm);				
				$('#xgtxyh').val(data.txyh);				
				$('#xgtxzh').val(data.txzh);				
				$("#xgstatus option[value='"+data.status+"']").attr("selected",true);
				$('#xgstatus').selected('destroy');
				$('#xgstatus').selected();
				$('#xgdl').modal();
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
				agentuser:$(obj).attr("val"),
				xgstatus:$('#xgstatus').val(),
				xgmima:$('#xgmima').val(),
				xgemail:$('#xgemail').val(),
				xgmobile:$('#xgmobile').val(),
				xgyue:$('#xgyue').val(),
				xgzsxm:$('#xgzsxm').val(),
				xgtxyh:$('#xgtxyh').val(),
				xgtxzh:$('#xgtxzh').val(),
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

	
	function sc(obj){//删除代理
		$('#scmodal').modal({
			onConfirm: function() {
				$.ajax({
					url:'',
					data:{
						action:'shanchu',
						agentuser:$(obj).attr('val'),
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
					},
				})
			},
			onCancel: function() {   //取消
				return
			}
		})
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

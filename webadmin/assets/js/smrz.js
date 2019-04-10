	$("#all").click(function(){	//全选
		//判断全选框是不是checked效果
		if (this.checked){
			//为所有的复选框加选中效果
			$("input[name='x']").prop("checked", true);
			//$("input[name='radio']").attr("checked", true);会出现第一次能选中，再次全选中不好使的现象，可以亲身试验，我的印象很深刻
			}else{
				//取消所有复选框的选中效果
				$("input[name='x']").removeAttr("checked", false);
			}
	});

	function ck(obj){//查看
		$.ajax({
			url:'',
			data:{
				id:$(obj).attr('val'),
				action:'chakan',
			},
			dataType:'JSON',
			type:'POST',
			success:function(data){
				$('#yh').html(data.username);	
				$('#xm').html(data.sfzxm);	
				$('#xb').html(data.xingbie);	
				$('#hm').html(data.sfzhm);	
				$('#dz').html(data.sfzdz);	
				$('#zm').attr("src",data.sfzzmtp);	
				$('#fm').attr("src",data.sfzfmtp);	
				$('#hj').html(data.hjszd);
				if(data.sqlx=='gr'){
					data.sqlx='个人认证';
				}else{
					data.sqlx='企业认证';
				}
				$('#rz').html(data.sqlx);	
				$('#sj').html(data.time);	
				$('#xq').modal();
			},
			error:function(){
				$('#ts').modal();
				$('#te').html("获取数据错误");
			},
		})
	}
	
	
	function tg(obj){//通过
		$('#tgmodal').modal({
			onConfirm: function() {//邮件通知
				$.ajax({
					url:'',
					data:{
						action:'tongguo',
						id:$(obj).attr('val'),
						mail:'yes',
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//页面刷新
							},1000);
						}
					},
					error:function(){
						$('#ts').modal();
						$('#te').html("获取数据错误");
					}
				})
			},
			onCancel: function() {   //不邮件通知
				$.ajax({
					url:'',
					data:{
						action:'tongguo',
						id:$(obj).attr('val'),
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//页面刷新
							},1000);
						}
					},
					error:function(){
						$('#ts').modal();
						$('#te').html("获取数据错误");
					}
				})
			}
		})
	}
	
	
	function pltg(){//批量通过申请
		id=new Array();
		for(var i=0;i<$("input[name='x']").length;i++){
			if($("input[name='x']")[i].checked){
				id.push($("input[name='x']")[i].value);
			}
		}
		if(!id[0]){
			$('#ts').modal();
			$('#te').html("请先选择需要通过的申请");
			return
		}
		$('#tgmodal').modal({
			onConfirm: function() {//邮件通知
				$.ajax({
					url:'',
					data:{
						action:'pltg',
						id:id,
						mail:'yes',
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//页面刷新
							},1000);
						}
					},
					error:function(){
						$('#ts').modal();
						$('#te').html("获取数据错误");
					}
				})
			},
			onCancel: function() {   //不邮件通知
				$.ajax({
					url:'',
					data:{
						action:'pltg',
						id:id,
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//页面刷新
							},1000);
						}
					},
					error:function(){
						$('#ts').modal();
						$('#te').html("获取数据错误");
					}
				})
			}
		})
	}
	
	
	function bh(obj){//驳回
		$('#bhmodal').modal({
			onConfirm: function() {//邮件通知
				$.ajax({
					url:'',
					data:{
						action:'bohui',
						id:$(obj).attr('val'),
						mail:'yes',
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//页面刷新
							},1000);
						}
					},
					error:function(){
						$('#ts').modal();
						$('#te').html("获取数据错误");
					}
				})
			},
			onCancel: function() {   //不邮件通知
				$.ajax({
					url:'',
					data:{
						action:'bohui',
						id:$(obj).attr('val'),
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//页面刷新
							},1000);
						}
					},
					error:function(){
						$('#ts').modal();
						$('#te').html("获取数据错误");
					}
				})
			}
		})
	}

	
	function plbh(){//批量驳回申请
		id=new Array();
		for(var i=0;i<$("input[name='x']").length;i++){
			if($("input[name='x']")[i].checked){
				id.push($("input[name='x']")[i].value);
			}
		}
		if(!id[0]){
			$('#ts').modal();
			$('#te').html("请先选择需要驳回的申请");
			return
		}
		$('#bhmodal').modal({
			onConfirm: function() {//邮件通知
				$.ajax({
					url:'',
					data:{
						action:'plbh',
						id:id,
						mail:'yes',
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//页面刷新
							},1000);
						}
					},
					error:function(){
						$('#ts').modal();
						$('#te').html("获取数据错误");
					}
				})
			},
			onCancel: function() {   //不邮件通知
				$.ajax({
					url:'',
					data:{
						action:'plbh',
						id:id,
					},
					type:'POST',
					dataType:'JSON',
					success:function(data){
						$('#ts').modal();
						$('#te').html(data.te);
						if(data.ok){
							setTimeout(function(){
								window.location.reload();//页面刷新
							},1000);
						}
					},
					error:function(){
						$('#ts').modal();
						$('#te').html("获取数据错误");
					}
				})
			}
		})
	}

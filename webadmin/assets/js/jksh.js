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
	

	function tg(obj){//通过申请
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
	
	
	
	function bh(obj){//驳回申请
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
	

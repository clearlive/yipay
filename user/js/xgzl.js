function xgzl(){
	$.ajax({
		url:"",
		dataType:"json",
		type:"POST",
		data:{
			qq:$("#xgqq").val(),
			sj:$("#xgsj").val(),
			yx:$("#xgyx").val(),
			dz:$("#xgdz").val(),
			xgxzl:$("#xgxzl").val(),
		},
		success:function(data){
			$('#xgte').modal();
			$('#te').html("提示："+data.te);
			if(data.ok =='ok'){
				$('#te').html(data.te);
				setTimeout(function(){
					window.location.reload();//页面刷新
				},1000);
			}
		},
		error:function(){
			$('#xgte').modal();
			$('#te').html("输入有误");
		}
		
	})
}

function xgxmm(){
	$.ajax({
		url:"",
		dataType:"json",
		type:"POST",
		data:{
			ymm:$("#ymm").val(),
			xmm:$("#xmm").val(),
			qrxmm:$("#qrxmm").val(),
			xgxmm:$("#xgxmm").val(),
			xgmmyzm:$("#xgmmyzm").val(),
		},
		success:function(data){
			$('#xgte').modal();
			$('#te').html("提示："+data.te);
			if(data.ok =='ok'){
				$('#te').html(data.te);
				setTimeout(function(){
					window.location="/login/?action=out";//页面刷新
				},1000);
			}
		},
		error:function(){
			$('#xgte').modal();
			$('#te').html("输入有误");
		}
		
	})
}
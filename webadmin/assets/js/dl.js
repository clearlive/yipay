$("#dl").click(function(){
	$("#dl").html("<i class='am-icon-spinner am-icon-pulse'></i>　验证中,请稍后...");
	$.ajax({
		url:"",
		dataType:"JSON",
		type:"POST",
		data:{
			zh:$("#zh").val(),
			mm:$("#mm").val(),
			dl:$("#dl").val(),
		},
		success:function(data){
			$("#dl").html("<i class=am-icon-exclamation-circle></i> "+ data.te);
			setTimeout("$('#dl').html('<i class=am-icon-refresh></i> 重新尝试登陆')",1000);
			if(data.ok =='ok'){
				$('#dl').html('<i class=am-icon-hourglass-start am-icon-spin></i>　正在加载系统...')
				window.location="index.php";
			}
		},
		error:function(){
			alert("ERR");
		}
	})
})
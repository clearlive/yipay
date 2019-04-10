		function xq(hqddh){
			$.ajax({
				type: "POST",
				dataType: "JSON",
				url: "",
				data: {
					ddh:hqddh
				},
				success: function(data){
					$('#ddxq_ddh').html(data.ddh);
					$('#ddxq_ddsj').html(data.ddsj);
					$('#ddxq_ddje').html(data.ddje);
					$('#ddxq_sdje').html(data.sdje);
					$('#ddxq_ddtdmc').html(data.ddtdmc);
					$('#ddxq_ddzt').html(data.ddzt);
					$('#ddxq_ddtbtz').html(data.ddtbtz);
					$('#ddxq_ddybtz').html(data.ddybtz);
					$('#ddxq_shddh').html(data.apiddh);
					$('#ddxq_shddmc').html(data.apiddmc);
					$('#ddxq_shddbz').html(data.apiddbz);
					$('#ddxq_ddtzzt').html(data.ddtzzt);
					$('#xq').modal();			
				},
				error:function(){
					alert("获取数据错误");
				}
				});
		}

		function tz(hqddh){
			$.ajax({
				type: "POST",
				dataType: "JSON",
				url: "",
				data: {
					ddh:hqddh
				},
				success: function(data){
					if(data.ddtzzt=="通知成功"){
						ddtzzt="<span style='color:green'>"+data.ddtzzt+"</span>";
					}else{
						ddtzzt="<span style='color:red'>"+data.ddtzzt+"</span>";
					}
					$('#ddxq_tzzt').html(ddtzzt);
					$('#ddxq_tzdz').html(data.ddybtz);
					$('#tz').modal();			
				},
				error:function(){
					alert("获取数据错误");
				}
				});
		}

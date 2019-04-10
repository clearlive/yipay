<?php
	if(!$weblock){//防止访问单文件
		header("location:../");
		exit;
	}
?>
<div id='ggxq' class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="xxbt" class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p id="xxnr"></p>
		<br>
		<br>
		<hr>
        <p id="xxsj"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="javascript:location.reload();">我已查看(删除)</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> 注销 <strong>登录</strong> ?</div>
                    <div class="mb-content">
                        <p>确定要注销登录吗?</p>                    
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="/login/?action=out" class="btn btn-success btn-lg">确定</a>
                            <button class="btn btn-default btn-lg mb-control-close">取消</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->
				<script>
					function xtxx(id){
						$.ajax({
							type:"POST",
							dataType:"JSON",
							url:"index.php",
							data:{
								xxid:id,
							},
							success:function(data){
								$('#xxbt').html(data.msg_title);
								$('#xxnr').html(data.msg_text);
								$('#xxsj').html("发送时间："+data.msg_time);
								$('#ggxq').modal();	
							},
							error:function(){
								alert("Err");
							}
							

						});
					}
				</script>        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>        
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>                 
        <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>                
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>    
		<!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <!--script type="text/javascript" src="js/settings.js"></script-->        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         

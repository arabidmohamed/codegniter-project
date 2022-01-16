	<div id="content-main">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="<?=getSystemString(211)?>"><a href="<?=base_url('acp/helpAndSupport')?>"><?=getSystemString(211)?></a></li>
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(715)?>"><?=getSystemString(715)?></li>
            </ol>
        </nav>
			<div class="row">
				<div class="col-xs-12">
                    <h3><?=getSystemString(715)?></h3>
				</div>
				<div class=" col-md-12">
					<?PHP
						if($this->session->flashdata('success')){
					?>
					<div class="alert alert-success alert-dismissable">
					  <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
					  <?=getSystemString(265)?>
					</div>
					<?PHP
						}
					?>
				
					<?PHP
						if($this->session->flashdata('error')){
					?>
					<div class="alert alert-danger alert-dismissable">
					  <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
					 <?=getSystemString(266)?>
					</div>
					<?PHP
						}
					?>
					
					<ul class="nav nav-tabs hide">
			          <li class="<?PHP if ($__lang == 'en') { echo 'active'; } ?>"><a data-toggle="tab" href="#lang_en">English</a></li>
			          <li class="<?PHP if ($__lang == 'ar') { echo 'active'; } ?>"><a data-toggle="tab" href="#lang_ar">العربي</a></li>
        			</ul>
					
				<form class="form-horizontal" method="post" data-parsley-validate enctype="multipart/form-data" action="<?=base_url($__controller."/submitTicket")?>">	
		          <div class="panel white" style="padding-bottom: 50px;">								          
				          
				         <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title_en"><?=getSystemString(38)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<input type="text" 
										class="form-control" 
										name="title" placeholder="<?=getSystemString(258)?>"
										required
										data-parsley-trigger="change"
										data-parsley-required-message="<?=getSystemString(213)?>">
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title_en"><?=getSystemString(259)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<select class="form-control" name="category" required data-parsley-trigger="change" data-parsley-required-message="<?=getSystemString(213)?>">
									<option value=""><?=getSystemString(59)?></option>
									<option value="Marketing and sales"><?=getSystemString(267)?></option>
									<option value="Accounting and finance"><?=getSystemString(268)?></option>
									<option value="Support"><?=getSystemString(269)?></option>
									<option value="Others"><?=getSystemString(270)?></option>
								</select>
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="editor1"><?=getSystemString(260)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-8 no-padding-left">
								<textarea class="basic-editor-<?=$__lang?>" id="editor1" name="message" required data-parsley-trigger="change" data-parsley-required-message="<?=getSystemString(213)?>"></textarea>
							</div>
						</div>			
			              
			            <!-- <div class="form-group hide">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="slide_picture"><?=getSystemString(14)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 no-padding-left">
								<input type="file" name="help_support_file" id="fileToUpload" class="fileToUpload">
								<img id="previewHolder" class="previewImg-S" alt="" src="" style="width: 200px;border-radius: 2px;margin-top:10px">
							</div>
						</div> -->

						<div class="form-group">
							<div class="col-xs-12 details images-d" style="padding: 0px;">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="category"> </label>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-8 no-padding-left">
									<div class="dropzone dz-clickable" id="img-dropzone">
										<div class="dz-message needsclick">
											<p><i class="fa fa-cloud-upload fa-2x"></i></p>
											<?=getSystemString(169)?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="files" id="dropzone_ret_ids">
			              
				    </div>
				  
				   
		   			<div class="form-group">
						<div class="col-xs-12 text-right">
							<input type="submit" class="btn btn-primary" value="<?=getSystemString(261)?>" name="submit" />
						</div>
					</div>
				   
		          </form>
				</div>
				</div>
				</div>
				
				<?PHP
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url('style/acp/js/dropzone.js')?>"></script>
<script>

	var _unlink_url = '<?=base_url($__controller.'/unlinkImage')?>';
	var _post_url = '<?=base_url($__controller.'/uploadTicketImages')?>';

	$(function(){
		$('.footer-ul li:eq(3)').addClass('selected');
		$('.footer-ul li:eq(3) a').addClass('active');
		sessionStorage.ActiveMenu = null;
		
		$("form").on("submit", function(){
			var valid = $(this).parsley().validate();
			if(!valid) {
				return false;
			}
		});

		// initializing dropzone
		var _uplOptions = {
			init_id: "div#img-dropzone",
			init_ret_id: "#dropzone_ret_ids",
			post_url: _post_url,
			unlink_url: _unlink_url,
			max_files: 10
		};
		initializeDropzoneAdv(_uplOptions);
	});
</script>
</body>
</html>
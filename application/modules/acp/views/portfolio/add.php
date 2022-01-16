	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
	<style>
		#More-Pic .details img{
			width: 60px;margin: auto; display: inline-block !important;visibility: hidden;
			vertical-align: top;
		}
		#More-Pic .details .fileToUpload{
			display: inline-block;width: 50%;
		}
		.tab-content{
			padding-top: 0px !important;
		}

		.crop-image{
			width: 400px;
			height: 500px;
		}

	    .select2{
		    width: 100% !important;
	    }
	</style>
	<div id="content-main">

		<h3><?=getSystemString(98)?></h3>
			<div class="row">

				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
				<div class="col-md-12">

						<?PHP
							$lang_setting['website_lang'] = $website_lang;
							$lang_setting['extra_targets_en'] = "#lang_en, #lang2_en";
							$lang_setting['extra_targets_ar'] = "#lang_ar, #lang2_ar";
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
        			<form action="<?=base_url($__controller.'/add_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>
						<div class="panel white" style="padding-bottom: 50px;">





								<div class="tab-content">
									<div class="tab-pane fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
										<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="title"><?=getSystemString(151)?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												<input type="text" class="form-control" name="title_en" placeholder="<?=getSystemString(151)?>" required
												data-parsley-required-message="<?=getSystemString(213)?>">

											</div>
										</div>
									</div>

									<div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
										<div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="title"><?=getSystemString(151)?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
												<input type="text" class="form-control" name="title_ar" placeholder="<?=getSystemString(151)?>" required
												data-parsley-required-message="<?=getSystemString(213)?>">

											</div>
										</div>
									</div>

									<div class="form-group hide">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title"><?=getSystemString('website_link')?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="url" class="form-control" name="portfolio_link" placeholder="https://www.dnet.sa">
										</div>
									</div>

								</div>
								<div class="form-group image-e">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="service_picture"><?=getSystemString(146)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 no-padding-left" style="margin-bottom: 30px">
													<div class="crop-image">
														<input type="hidden" name="image-data" id="image-data">
														<input type="hidden" id="check_chng_img" name="check_chng_img" value="-1">
													<input type="file" name="fileToUpload" class="editor-file z-10">
														<div class="ci-preview-labels">
													        <div class="text-xs-center">
														        <i class="fa fa-cloud-upload"></i>
														        <p><?=getSystemString(262)?></p>
														        <p><?=getSystemString(263)?></p>
														        <p><a href="javascript: void(0)"><?=getSystemString(264)?></a></p>
													        </div>
														</div>
														<a href="#" class="change-pic editor z-10 hide"> <i class="fa fa-pencil"></i> <?=getSystemString(171)?></a>
													</div>
						  						</div>
						  					</div>


						</div>
						<div class="form-group">
									<div class="col-xs-12 text-right">
										<input type="submit" class="btn btn-primary" value="<?=getSystemString(52)?>" name="submit" />
									</div>
								</div>
					</form>
				</div>
			</div>
	</div>
<?PHP
	$this->load->view('portfolio/snippets/add_modal');
	$this->load->view('acp_includes/footer');
?>

<script>


	var cropitEditor = Cropit.init.initializeCroppieEditor();

</script>
</body>
</html>

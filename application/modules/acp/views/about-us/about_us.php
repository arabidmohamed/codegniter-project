
	<div id="content-main">
		<?PHP
			$section = "SectionName_".$__lang;
			$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
		?>
		
<!-- 		<h3><?=getSystemString(15)?></h3> -->
			<div class="row">
				<div class="col-md-12">
					<h3>
						<?=getSystemString($slug)?>
					</h3>
				</div>
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-12">
					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
        			 <form action="<?=base_url($__controller.'/updateAboutUs');?>" class="form-horizontal" method="post" enctype="multipart/form-data"> 
		          <div class="panel white" style="padding-bottom: 50px;">
					    <div class="tab-content">
				          <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
					          					         
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="editor1"><?=getSystemString(13)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor1" id="editor1" rows="12" class="margin-bottom editors1" cols="40" >
											<?=$company[0]->Content_en?>
										</textarea>
										<br>
										
									</div>
								</div>
				          
				            </div>
				          
				          <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">				         
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="editor1"><?=getSystemString(13)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor2" id="editor2" rows="12" class="margin-bottom editors2" cols="40" >
										<?=$company[0]->Content_ar?>
										</textarea>
										<br>
										
									</div>
								</div>
							          
                          </div>

                          <input type="hidden" name="slug" value="<?=$company[0]->Slug?>">
                          
                          <div class="form-group hide">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="about_picture"><?=getSystemString(14)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 no-padding-left">
										<input type="file" name="fileToUpload" id="fileToUpload" class="fileToUpload">
										<img id="previewHolder" class="previewImg-S" alt="" src="<?=base_url($GLOBALS['img_ck_dir']).$company[0]->Original_Img?>" style="display: block"/>
									</div>
								</div>
								
								
			         		          </div>
				  </div>
				  
					  <div class="form-group">
							<div class="col-xs-12 text-center">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" />
							</div>
					  </div>
				  
				  </form>
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
</body>
</html>
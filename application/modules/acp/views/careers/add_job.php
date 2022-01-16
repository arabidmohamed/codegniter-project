	<div id="content-main">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="<?=getSystemString(493)?> <"><a href="<?=base_url('acp/acp/manageJobs')?>"><?=getSystemString(493)?></a></li>
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(104)?> <"><?=getSystemString(104)?> </li>
            </ol>
        </nav>
        <div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-10">
					<h1><?=getSystemString(104)?></h1>
					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
					
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			          <form action="<?=base_url($__controller.'/addJob_POST');?>" class="form-horizontal" method="post">
				          
				          <div class="tab-content">
				          
				           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
				          		
						         <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(38)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_en" placeholder="<?=getSystemString(71)?>">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="editor1"><?=getSystemString(72)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor1" id="editor1" rows="12" class="margin-bottom editors1" cols="40" >
										</textarea>
										
									</div>
								</div>
								
				           </div>
				           
				           <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
					           <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(38)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_ar" placeholder="<?=getSystemString(71)?>" dir="rtl">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="editor1"><?=getSystemString(72)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor2" id="editor2" rows="12" class="margin-bottom editors2" cols="40" >
										</textarea>
										
									</div>
								</div>
				           </div>
				           
				          </div>
						
						<div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit"/>
							</div>
						</div>
					          
				          
				          
			          </form>
			          
		          </div>
		          
				</div>
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>

<script>
	menu_track_manual(7,0);
</script>
</body>
</html>
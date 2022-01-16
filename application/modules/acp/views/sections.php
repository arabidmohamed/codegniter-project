
	<style>
	.panel.white{
		min-height: 300px;
	}
</style>
<link href="<?=base_url($GLOBALS['acp_css_dir']."/bootstrap-colorpicker.min.css")?>" rel="stylesheet">
	<div id="content-main">
        <?php $section_lang = "SectionName_".$__lang; ?>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php if (strpos(uri_string(), 'contactus')) : ?>
                <li class="breadcrumb-item" aria-current="<?=$section[0]->$section_lang?>"><a href="<?=base_url('acp/contactus')?>"><?= $section[0]->$section_lang?></a></li>
                <?php elseif (strpos(uri_string(), 'aboutus')) :?>
                <li class="breadcrumb-item" aria-current="<?=$section[0]->$section_lang?>"><a href="<?=base_url('acp/aboutus')?>"><?= $section[0]->$section_lang?></a></li>
                <?php elseif (strpos(uri_string(), 'portfolios')) : ?>
                    <li class="breadcrumb-item" aria-current="<?=$section[0]->$section_lang?>"><a href="<?=base_url('acp/portfolios/listall')?>"><?= $section[0]->$section_lang?></a></li>
                <?php elseif (strpos(uri_string(), 'projects')) : ?>
                    <li class="breadcrumb-item" aria-current="<?=$section[0]->$section_lang?>"><a href="<?=base_url('acp/projects/listall')?>"><?= $section[0]->$section_lang?></a></li>
                <?php elseif (strpos(uri_string(), 'manageJobs')) : ?>
                    <li class="breadcrumb-item" aria-current="<?=$section[0]->$section_lang?>"><a href="<?=base_url('acp/manageJobs/listall')?>"><?= $section[0]->$section_lang?></a></li>
                <?php elseif (strpos(uri_string(), 'manageNews')) : ?>
                    <li class="breadcrumb-item" aria-current="<?=$section[0]->$section_lang?>"><a href="<?=base_url('acp/news/manageNews/listall')?>"><?= $section[0]->$section_lang?></a></li>
                <?php elseif (strpos(uri_string(), 'manageServices')) : ?>
                    <li class="breadcrumb-item" aria-current="<?=$section[0]->$section_lang?>"><a href="<?=base_url('acp/manageServices/listall')?>"><?= $section[0]->$section_lang?></a></li>
                <?php elseif (strpos(uri_string(), 'partners')) : ?>
                    <li class="breadcrumb-item" aria-current="<?=$section[0]->$section_lang?>"><a href="<?=base_url('acp/partners/listall')?>"><?= $section[0]->$section_lang?></a></li>
                <?php elseif (strpos(uri_string(), 'albums')) : ?>
                    <li class="breadcrumb-item" aria-current="<?=$section[0]->$section_lang?>"><a href="<?=base_url('acp/albums/listall')?>"><?= $section[0]->$section_lang?></a></li>
                <?php endif; ?>
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(315)?>"><?=getSystemString(315)?></li>
            </ol>
        </nav>
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
					if(!isset($section_id))
					{
					 ?>
				<div class="col-md-10">
					<h3><?=getSystemString(190)?></h3>
		          <div class="panel white" style="padding-bottom: 50px;">
			        
			          
			        		          
		          </div>
		          
				</div>
					<?PHP
					}
					
					if(isset($section_id))
					{
					?>

				<div class="col-md-12">
					<h3><?=getSystemString(204)?></h3>
					
					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
						
						<form action="<?=base_url($__controller.'/updateSection');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
						
		          <div class="panel white" style="padding-bottom: 50px;">
			          

				          
				          <input type="hidden" name="section_id" value="<?=$section_id?>">
				          <input type="hidden" name="redirect_uri" value="<?=$redirect_uri?>">
			          
			          <div class="tab-content">
				          
				           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
						         <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(191)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="name_en" placeholder="<?=getSystemString(191)?>" value="<?=$section[0]->SectionName_en?>">
										
									</div>
								</div>
				           </div>
				           
				          <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
					          <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(191)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="name_ar" placeholder="<?=getSystemString(191)?>" value="<?=$section[0]->SectionName_ar?>" dir="rtl">
										
									</div>
								</div>
					          
				          </div>  
				           
			          </div>
			          
		            <!-- Disable color picker -->
<!--				        <div class="form-group">-->
<!--							<div class="col-xs-12 col-sm-4 col-md-2">-->
<!--								<label for="title">--><?//=getSystemString(294)?><!--</label>-->
<!--							</div>-->
<!--							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">-->
<!--								<div class="input-group colorpicker-component color-picker">-->
<!--									<input type="text" value="--><?//=$section[0]->Section_BG_Clr?><!--" class="form-control" name="bg_color" />-->
<!--									<span class="input-group-addon"><i></i></span>-->
<!--								</div>-->
<!--								-->
<!--							</div>-->
<!--						</div>-->
<!--						-->
<!--						<div class="form-group">-->
<!--							<div class="col-xs-12 col-sm-4 col-md-2">-->
<!--								<label for="title">--><?//=getSystemString(295)?><!--</label>-->
<!--							</div>-->
<!--							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">-->
<!--								<div class="input-group colorpicker-component color-picker">-->
<!--									<input type="text" value="--><?//=$section[0]->Section_Text_Clr?><!--" class="form-control" name="txt_color" />-->
<!--									<span class="input-group-addon"><i></i></span>-->
<!--								</div>-->
<!--								-->
<!--							</div>-->
<!--						</div>-->
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title"><?=getSystemString(296)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<input type="file" name="bg_picture" class="fileTopUpload">
								<small>Recommended Dimensions: min-width: 1600px, min-height:1200px</small>
								<br>
								<?PHP
									if(strlen($section[0]->Section_BG_Image) > 0){
								?>
								<img src="<?=base_url($GLOBALS['img_section_bg_dir'].$section[0]->Section_BG_Image)?>" style="width: 150px;margin-top: 10px">
								<?PHP
									}
								?>
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
				<?PHP
					}
				?>
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/bootstrap-colorpicker.min.js')?>"></script>
<script>
	$(function(){
		menu_track_manual(1, 0);
		 $('.color-picker').colorpicker();
	});
</script>
</body>
</html>
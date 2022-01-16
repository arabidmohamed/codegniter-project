<style>
	.panel.white {
    	min-height: 150px;
	}
</style>
	<div id="content-main">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="<?=getSystemString(317)?>"><a href="<?=base_url('acp/portfolios/categories_list')?>"><?=getSystemString(317)?></a></li>
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(48)?>"><?=getSystemString(48)?></li>
            </ol>
        </nav>
		<h3><?=getSystemString(48)?></h3>
			<div class="row">
				
								<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-12">
					
					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
        			<form action="<?=base_url($__controller.'/addCategory');?>" class="form-horizontal" method="post">
		          <div class="panel white" style="padding-bottom: 50px;">
			          	
				          
				          <div class="tab-content">
				          
				           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">				         
						         <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(49)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="name_en" placeholder="<?=getSystemString(49)?>">
										
									</div>
								</div>
				           </div>
				           
				           <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
					           <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(49)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="name_ar" placeholder="<?=getSystemString(49)?>" dir="rtl">
										<input type="hidden" name="portfolioFor" value="v1">
									</div>
								</div>
				           </div>
						
				           </div>
						
					          
				          
				          
			          
			          
		          </div>
		          
		          <div class="form-group">
							<div class="col-xs-12 text-center">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(48)?>" name="submit" />
							</div>
						</div>
		          
		          
		          </form>
				</div>
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	menu_track_manual(4, 0);
</script>
</body>
</html>
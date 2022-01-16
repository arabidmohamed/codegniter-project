<style>
	.crop-image{
		width: 170px;
		height: 170px;
	}
</style>
	<div id="content-main">
      
			<div class="row">

								<?PHP
					$this->load->view('acp_includes/response_messages');

					if(!isset($top_id))
					{
					 ?>
				<div class="col-md-12">


					<h3>
						<?=getSystemString('team_work')?>


						<a href="<?=base_url('acp/managements/add')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#fff">
							<i class="fa fa-plus"></i> <?=getSystemString('add_position')?>
						</a>

					</h3>

		          <div class="panel white" style="padding-bottom: 50px;">
			          <h4><?=getSystemString('manage_list')?></h4>
			          <div class="col-xs-12 text-right">
<!-- 				          <a href="<?=base_url('acp/services')?>" class="btn btn-primary" style="color:#fff"><?=getSystemString(93)?></a> -->
			          </div>

			         <table class="table table-hover sortable-tb sortable-1" id="services_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(41)?></th>
						         <th><?=getSystemString(177)?></th>
						         <th><?=getSystemString(14)?></th>
						         <th><?=getSystemString(38)?></th>
						         <th><?=getSystemString('517')?></th>
								 <th><?=getSystemString('25')?></th>
						         <th><?=getSystemString(33)?></th>
						         <th colspan="2"><?=getSystemString(42)?></th>
					         </tr>
				         </thead>
				         <tbody>
					         <?PHP
						         if(count($management)){
							         $i = 0;
							        foreach($management as $row){
								       $i++;
								        $dt = new DateTime($row->Timestamp);
								       ?>
								       <tr id="<?=$row->Top_ID;?>">
									       <td class="hide"><?=$row->Top_ID;?></td>
									       <td class="index hide"><?=$i;?></td>
									       <td><span class="drag-handle"></span><?=$dt->format('d-m-Y');?></td>
									       <td><img src="<?=base_url($GLOBALS['img_users_dir']).$row->Icon;?>" alt='service icon' style="width: 40px;"></td>
									       <?PHP $title = 'Name_'.$__lang; ?>
									       <td><?=$row->$title;?></td>
									       <?PHP $position = 'Position_'.$__lang; ?>
									       <td><?=$row->$position;?></td>
										   <td>
											<?php
												if($row->Twitter){echo'<a href="https://twitter.com/'.$row->Twitter.'" target="_blank"><i class="fa fa-twitter"></i></a> ';}else{echo'';}
												if($row->Facebook){echo'<a href="https://facebook.com/'.$row->Facebook.'" target="_blank"><i class="fa fa-facebook"></i></a>  ';}else{echo'';}
												if($row->LinkedIn){echo'<a href="https://linkedin.com/user/'.$row->LinkedIn.'" target="_blank"><i class="fa fa-linkedin"></i></a> ';}else{echo'';}
											?>
										   </td>
									       <td>
												<div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
												  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="status<?=$i?>">
												  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="status<?=$i?>">
												</div>
											</td>
											<td>
												<div class="btn-group">
													  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editTop/'.$row->Top_ID.'/')?>">
													     <i class="fa fa-edit"></i> <?=getSystemString(43)?>
													  </a>
													  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													  	<span class="fa fa-angle-down"></span>
													  </button>
													  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
														  <li>
														  		<a href="<?=base_url($__controller.'/editTop/'.$row->Top_ID.'/')?>" style="margin: 0px 5px;" class="dropdown-item">
															  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
															  	</a>
														  </li>
														  <li>
														  		<a href="<?=base_url($__controller.'/deleteTop/'.$row->Top_ID.'/')?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
															  		<i class="fa fa-trash"></i>  <?=getSystemString(314)?>
															  	</a>
														  </li>
														</ul>
			   									</div>
											</td>
								       </tr>
								       <?PHP
							        }
						         } else {
							         ?>
							         <tr><td colspan='5' class='text-center'><?=getSystemString(46)?></td></tr>
							         <?PHP
						         }
					         ?>
				         </tbody>
			         </table>
		          </div>

				</div>
					<?PHP
					}

					if(isset($top_id))
					{
					?>

				<div class="col-md-10">
                    
					<h1><?=getSystemString('team_work')?></h1>

					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>

        			<form action="<?=base_url($__controller.'/updateTop');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
		          <div class="panel white" style="padding-bottom: 50px;">

			          <input type="hidden" name="top_id" value="<?=$top_id?>">
			          <div class="tab-content">

				           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
						        <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title_en"><?=getSystemString(38)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="name_en" placeholder="<?=getSystemString(695)?>" value="<?=$management[0]->Name_en?>" >

									</div>
								</div>

								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title_en"><?=getSystemString(517)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="position_en" placeholder="<?=getSystemString(695)?>" value="<?=$management[0]->Position_en?>" >

									</div>
								</div>
				           </div>
				           <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
				             <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title_ar"><?=getSystemString(38)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="name_ar" placeholder="<?=getSystemString(695)?>" dir="rtl" value="<?=$management[0]->Name_ar?>">

									</div>
								</div>

								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title_ar"><?=getSystemString(517)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="position_ar" placeholder="<?=getSystemString(695)?>" dir="rtl" value="<?=$management[0]->Position_ar?>">

									</div>
								</div>
			             </div>

			          </div>

						<!-- Social media -->
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="twitter" class="sr-only"><?=getSystemString(26)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon2"><i class="fa fa-twitter"></i></span>
									<input type="text" name="twitter" class="form-control lv-prev twitter" value="<?=substr($management[0]->Twitter, strrpos($management[0]->Twitter, '/') + 1)?>" aria-describedby="basic-addon2">

								</div>
								<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
									<small class="text-xs-right d-block">https://twitter.com/<span class="sm-upd"><?=substr($management[0]->Twitter, strrpos($management[0]->Twitter, '/') + 1)?></span></small>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="twitter" class="sr-only"><?=getSystemString(27)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon2"><i class="fa fa-linkedin"></i></span>
									<input type="text" name="linkedin" class="form-control lv-prev linkedin" value="<?=substr($management[0]->LinkedIn, strrpos(trim($management[0]->LinkedIn), '/') + 1)?>" >


								</div>
								<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
									<small class="text-xs-right d-block">https://linkedin.com/user/<span class="sm-upd"><?=substr($management[0]->LinkedIn, strrpos(trim($management[0]->LinkedIn), '/') + 1)?></span></small>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="twitter" class="sr-only"><?=getSystemString(28)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon2"><i class="fa fa-facebook"></i></span>
									<input type="text" name="facebook" class="form-control lv-prev facebook" value="<?=substr($management[0]->Facebook, strrpos(trim($management[0]->Facebook), '/') + 1)?>">


								</div>
								<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
									<small class="text-xs-right d-block">https://facebook.com/<span class="sm-upd"><?=substr($management[0]->Facebook, strrpos(trim($management[0]->Facebook), '/') + 1)?></span></small>
								</div>
							</div>
						</div>

						<!-- Ends -->

						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="service_picture"><?=getSystemString(14)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 no-padding-left">
								    <input type="hidden" class="crop_img_url" value="<?=$management[0]->Icon?>">
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

		          </div>
		          		          <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit"/>
							</div>
						</div>

		           </form>

				<?PHP
					}
				?>
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	$(function(){

		menu_track_manual(3,0);

		$(document).on('click',"#services_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'managementTop');
		});

		ChangeOrder('managementTop');

		var cropitEditor = Cropit.init.initializeCroppieEditor();

		if($('.crop-image').length > 0 && $('.crop_img_url').val().length > 0){

			cropitEditor.croppie('bind', {
				url: '<?=base_url($GLOBALS['img_users_dir'])?>'+$('.crop_img_url').val()
			});

			Cropit.init.callbacks.cropImageActive();
		}
	});

</script>
</body>
</html>

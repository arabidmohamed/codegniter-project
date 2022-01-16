<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">
<style>
	.panel.white{
	    min-height: 150px ;
    }
    .dropzone .dz-message{
	    margin: 0px;
	    font-size: 13px;
    }
    .dropzone{
	    min-height: 0px;
    }
    .select2{
	    width: 100% !important;
    }
	#map{
		width: 100%;
		height: 250px;
	}
	#pac-input{
		width: 65%;
		top:10px !important;
	}
</style>

<div id="content-main">
	<h3><?=getSystemString(666)?></h3>
		<div class="row">
			
			<?PHP
				$this->load->view('acp_includes/response_messages');
			?>
			
				<form action="<?=base_url($__controller.'/edit_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data">	

					<div class="col-md-12">
					
					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
					
					
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			          	
				          <div class="tab-content">				         	
				          <input type="hidden" name="Project_ID" id="project_id" value="<?=$Project_ID?>">
			          
			          <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title"><?=getSystemString(58)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<select class="form-control select2" 
										name="category"
										id="select_category"
										data-placeholder="<?=getSystemString(308)?>" 
										required 
										data-parsley-required-message="<?=getSystemString(213)?>"
										data-create-link="#new_category"
										data-create-text="<?=getSystemString(96)?>">
									<?PHP
										foreach($categories as $row){
											$cat_nn = 'Category_'.$__lang;
											?>
											<option value="<?=$row->Category_ID?>" <?PHP
												   	   if($row->Category_ID == $project[0]->Category_ID){
													   	   echo 'selected';
												   	   }
											   	    ?>><?=$row->$cat_nn?></option>
											   	    <?PHP
												   	    }
											   	    ?>
								</select>
								
							</div>
						</div>

			          
				        <div class="tab-pane fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(151)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_en" id="title_en" placeholder="<?=getSystemString(151)?>" value="<?=$project[0]->Title_en?>">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(72)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-8 no-padding-left">
										<textarea id="editor1" name="description_en" class="editors1"><?=$project[0]->Description_en?></textarea>
										
									</div>
								</div>
								
							</div>
							
							<div class="tab-pane fade  <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(151)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="<?=getSystemString(151)?>" dir="rtl" value="<?=$project[0]->Title_ar?>">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(72)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-8 no-padding-left">
										<textarea id="editor2" name="description_ar" class="editors2"><?=$project[0]->Description_ar?></textarea>
										
									</div>
								</div>
								
							</div>
							
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(668)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<div class="input-group">
										
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										
										<input type="text" 
												class="form-control input-date" 
												id="from" 
												name="fromdate" 
												placeholder="20/02/2018"
												value="<?=$project[0]->From_Date?>"
												required
												data-parsley-required-message="<?=getSystemString(213)?>">
										
										
									</div>
									
								</div>
							</div>
								
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(669)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<div class="input-group">
										
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										
										<input type="text" 
												class="form-control input-date" 
												id="to" 
												name="todate"
												placeholder="15/03/2018"
												value="<?=$project[0]->To_Date?>"
												required
												data-parsley-required-message="<?=getSystemString(213)?>">
												
												<input type="hidden" name="duration" class="dt-duration">
									</div>
									<p class="text-primary"><?=getSystemString(670)?> <b><span id="dt-duration"><?=$project[0]->Total_Days?></span></b></p>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(407)?> 1</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="url" class="form-control" id="video_1" placeholder="http://www.youtube.com/dfj34aj" value="<?=$project[0]->Video_Link1?>">
									<input type="hidden" name="video_1" id="embed_video1" value="<?=$project[0]->Video_Link1?>">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(407)?> 2</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="url" class="form-control" id="video_2" placeholder="http://www.youtube.com/dfj34aj" value="<?=$project[0]->Video_Link2?>">
									<input type="hidden" name="video_2" id="embed_video2" value="<?=$project[0]->Video_Link2?>">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(408)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="file" name="pdf_file">
									<?PHP
									if(strlen($project[0]->PDF_File) > 0){
									?>
								<br>
								<a href="<?=base_url($GLOBALS['img_projectPDF_dir'].$project[0]->PDF_File)?>" target="_blank"><?=getSystemString(409)?></a>
								<?PHP
									}
								?>
								</div>
							</div>
							
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(321)?></label>
								</div>
								<div class="col-xs-12 col-sm-8  col-md-9" style="padding: 0px">
						              <input id="pac-input" class="controls form-control" type="text" value="<?=$project[0]->Address?>" placeholder="<?=getSystemString(321)?>"> 
								  	  <div id="map"></div>
									  <input type="hidden" id="latitude" name="lat" value="<?=$project[0]->Latitude?>" >
									  <input type="hidden" id="longitude" name="lng" value="<?=$project[0]->Longitude?>">
									  <input type="hidden" id="frm_address" name="address" value="<?=$project[0]->Address?>">
					            </div>
							</div>
							
				          
				          </div>    
			         
			          
		          </div>
		          
				</div>
				
					<div class="col-md-12">
					<h3><?=getSystemString(311)?></h3>
					<div class="panel white" style="padding-bottom: 50px;">
			         <table class="table table-hover sortable-2 sortable-tb" id="project_details_table">
				         <thead>
					         <tr>
						         <th><?=getSystemString(149)?></th>
						         <th><?=getSystemString(177)?></th>
						         <th><?=getSystemString(150)?></th>
						         <th><?=getSystemString(152)?></th>
						         <th colspan="2"><?=getSystemString(153)?></th>
					         </tr>
				         </thead>
				         <tbody>
					         <?PHP
						         if(count($project_det)){
							         $i = 0;
							        foreach($project_det as $row){
								       $i++;
								        $dt = new DateTime($row->TimeStamp);
								       ?>
								       <tr id="<?=$row->PD_ID;?>">
									       <td class="hide"><?=$row->PD_ID;?></td>
									       <td class="index"><?=$i?></td>
									       <td><?=$dt->format('d-m-Y');?></td>
									       <td>
												<img src="<?=base_url($GLOBALS['img_projects_dir']).$row->Pictures;?>" alt='picture' style="width: 40px;">
									       </td>
									       <td>
												<input type="radio" class="radio" 
										       name="cover_pic" 
										       value="<?=$row->PD_ID?>"
										       <?PHP if($row->Is_Cover == 1) { echo 'checked'; } ?>
										       data-pid = "<?=$row->Project_ID?>" style="margin:auto">
											</td>
										   <td><a href="<?=base_url($__controller.'/deleteDet/'.$row->PD_ID.'/'.$row->Project_ID)?>" onclick="return confirm('<?=getSystemString(45)?>');"><?=getSystemString(155)?></a></td>
								       </tr>
								       <?PHP
							        }
						         } else {
							          echo '<tr><td colspan="5" class="text-center">No Project Details </td></tr>';
						         }
					         ?>
				         </tbody>
			         </table>	
			         <div class="col-xs-12">
				         <div class="dropzone dz-clickable" id="img-dropzone">
                         	<div class="dz-message needsclick">
	                         	<p><i class="fa fa-cloud-upload fa-2x"></i></p>
						 		<?=getSystemString(169)?>
							</div>
						</div>
			         </div>	          
		          </div>
		          
				</div>
				
					<div class="form-group">
						<div class="col-xs-12 text-right">
							<input type="submit" class="btn btn-primary" value="<?=getSystemString(157)?>" />
						</div>
					</div>
		        </form>
		</div>
</div>	           
<?PHP
	$this->load->view('projects/snippets/add_modal');
	$this->load->view('acp_includes/footer');
?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/dropzone.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/add_select2.js')?>"></script>
<script src="<?=base_url($GLOBALS['home_js_dir'].'/utilities/utilities.js')?>"></script>
<script>
	
	var _unlink_url = '<?=base_url($__controller.'/unlinkImage')?>';
	var _post_url = '<?=base_url($__controller.'/uploadProjectImages')?>';
	var _lang = '<?=$__lang?>';
	var _postCategoryURL = '<?=base_url($__controller.'/addCategory_HTTP')?>';
	
	$(function(){
		
		var options = {
		    format : "dd-mm-yy",
		    fromInput : "#from",
		    toInput : "#to",
		    durationInput : ".dt-duration",
		    durationArea : "#dt-duration"
	    };
		Utilities.functions.dateRangeInit(options);
		
		$(".select2").select2({
			theme:'bootstrap'
		}).on('select2:open', function (e) {
			
		  createSelect2Button(e);
		});
		
		var options = {
			formId        : "form_new_category",
			ENNameId      : "category_en",
			ARNameId 	  : "category_ar",
			selectFieldId : "select_category",
			postURL 	  : _postCategoryURL
		};
		Select2Options.init(options);
		
		$("#video_1, #video_2").on("paste", function(){
			var input = $(this);
			setTimeout(function () { 
				var video_id = getYoutubeId($(input).val());
				var embed_url = "https://www.youtube.com/embed/" + video_id;
				if($(input).attr('id') == 'video_1'){
					$("#embed_video1").val(embed_url);
				} else {
					$("#embed_video2").val(embed_url);
				}
			}, 100);
		});
		
		$(document).on("change", "input[name='cover_pic']",function(){
			$('table input[name="cover_pic"]').attr('disabled', 'disabled');
			var id = $(this).val();
			var pid = $(this).attr('data-pid');
			var data = {id: id, pid: pid};
			$.ajax({
		 		url: "<?=base_url($__controller.'/SetProjectCover')?>",
		 		type:"POST",
	            dataType:"JSON",
	            data: data,
		 		success: function(result){
			 		console.log(result);	
			 		$('table input[name="cover_pic"]').removeAttr('disabled', 'disabled');		 		
		 		},
		 		error: function(err, status, xhr){
			 		console.log(err);
					console.log(status);
					console.log(xhr);
	
		 		}
			});
		});
		

		// initializing dropzone
		initializeDropzone(_post_url, _unlink_url, $('#project_id').val());

		
	});
</script>
<script src="<?=base_url($GLOBALS['home_js_dir'].'/utilities/init_map.js')?>"></script>
<script>
	var options = {
		mapID : "map",
		autoCompleteInput: "pac-input"
	};
	Map.init(options);
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC88G_-I2GZl8sVDs95qoxcuqBy9_q36nQ&libraries=places"
         async defer></script>

</body>
</html>
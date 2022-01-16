<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<link rel="stylesheet" href="<?=base_url('style/site/css/bootstrap-tagsinput.css?v=2')?>" type="text/css" media="screen" charset="utf-8">


<style type="text/css">
		.input-group .input-group-addon:hover{
		background-color: #ccc;
		cursor: pointer;
	}
/*	.select2-container{
		z-index: 1112;
	}*/

.dropdown-menu{
	    margin: 40px 0 0 !important;
}

body[dir="rtl"] .dropdown-menu {
    left: unset !important; 
}

input[type=checkbox]
{

  transform: scale(1.4);
  padding: 10px;
}
</style>

<div id="content-main">
	<h3>
      <?=getSystemString(306)?>
    </h3>
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
				<form action="<?=base_url($__controller.'/edit_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data">	
				    

				    <div class="panel white" style="padding-bottom: 50px;">
				      <div class="tab-content">				         	
				        <input type="hidden" name="Class_ID" id="Class_ID" value="<?=$Class_ID?>">



				        
				      <div class="tab-pane col-sm-6 fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
				        <div class="form-group">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString(420)?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <input type="text" class="form-control" name="title_en" id="title_en" placeholder="<?=getSystemString(151)?>" value="<?=$class[0]->Title_en?>">
				          </div>
				        </div>
				        
				        
				        <div class="form-group ">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString(72)?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <textarea  class="form-control" rows="8"  name="content_en"><?=$class[0]->Content_en?></textarea>
				          </div>
				        </div>
				        

				          <div class="form-group hide">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString(421)?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <textarea   id="editor1" class="margin-bottom editors1"  name="description_en"><?=$class[0]->Description_en?></textarea>
				          </div>
				        </div>
				       
				        
				      </div>
				      <div class="tab-pane col-sm-6 fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
				        <div class="form-group">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString(420)?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="<?=getSystemString(151)?>" dir="rtl" value="<?=$class[0]->Title_ar?>">
				          </div>
				        </div>




				         <div class="form-group ">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString(72)?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <textarea  class="form-control" rows="8" name="content_ar"><?=$class[0]->Content_ar?></textarea>
				          </div>
				        </div>

				        
				        
				        <div class="form-group hide">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString(421)?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <textarea  id="editor2" class="margin-bottom editors2" name="description_ar"><?=$class[0]->Description_ar?></textarea>
				          </div>
				        </div>

				      </div>





	<div class="col-xs-6">


				        
				        <div class="form-group ">
							<div class="col-xs-12 col-sm-4 col-md-3">
								<label for="title"><?=getSystemString('branch_name')?></label>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-9 no-padding-left display-select2">
								<select class="form-control select2 " 
										name="branch_id" 
										data-placeholder="<?=getSystemString('branch_name')?>" 
										required 
										data-parsley-required-message="<?=getSystemString(213)?>">
										
									<option value=""><?=getSystemString(308)?></option>
									<?PHP
										$cat_nn = 'Name_'.$__lang;
										foreach($branches as $row)
										{
											?>
											<option value="<?=$row->Branch_ID?>" <?= ($class[0]->Branch_ID == $row->Branch_ID)?'selected':''  ?>><?=$row->$cat_nn?></option>
											<?PHP
										}
									?>
								</select>
								
							</div>
						</div>




				      <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-3">
								<label for="title"><?=getSystemString('teacher_name')?></label>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-9 no-padding-left display-select2">
								<select class="form-control select2 " 
										name="teacher_id" 
										id="teacher_id"
										data-placeholder="<?=getSystemString('teacher_name')?>" 
										required 
										data-parsley-required-message="<?=getSystemString(213)?>"
										>
										
									<option value=""><?=getSystemString(308)?></option>
									<?PHP
								

										// $Teacher_IDS = explode(',',  $class[0]->Teacher_IDS);

										foreach($all_teachers as $row)
										{
											?>
											<option <?= ($row->Customer_ID ==  $class[0]->Teacher_ID)?'selected':''; ?> value="<?=$row->Customer_ID?>" ><?=$row->Fullname?></option>
											<?PHP
										}
									?>
								</select>
								
							</div>
						</div>




<hr>


				        <div class="form-group">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString('Student_Number')?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <input type="text" class="form-control" name="Student_Number" id="Student_Number" placeholder="<?=getSystemString('Student_Number')?>" dir="rtl" value="<?=$class[0]->Student_Number?>" required data-parsley-required-message="<?=getSystemString(213)?>">
				          </div>
				        </div>

				           <div class="form-group">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString('Registered_Number')?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <input readonly type="text" class="form-control" name="weight" id="weight" placeholder="<?=getSystemString('Registered_Number')?>" dir="rtl" value="<?=$class[0]->Registered_Number?>"  >
				          </div>
				        </div>


<hr>


			

				

				       



















</div>














				      
				    </div>    
				  </div>
				  





















				  <h3><?=getSystemString(305)?></h3>
				  <div class="panel white" style="padding-bottom: 50px;">
				    <table class="table table-hover sortable-2 sortable-tb" id="class_details_table">
				      <thead>
				        <tr>
				          <th>
				            <?=getSystemString(149)?>
				          </th>
				          <th>
				            <?=getSystemString(177)?>
				          </th>
				          <th>
				            <?=getSystemString(150)?>
				          </th>
				          <th>
				            <?=getSystemString('main_cover')?>
				          </th>
				          <th colspan="2">
				            <?=getSystemString(153)?>
				          </th>
				        </tr>
				      </thead>
				      <tbody>
				        <?PHP
						if(count($class_det)){
						$i = 0;
						foreach($class_det as $row){
						$i++;
						$dt = new DateTime($row->TimeStamp);
						?>
				        <tr id="<?=$row->PD_ID;?>">
				          <td class="hide">
				            <?=$row->PD_ID;?>
				          </td>
				          <td class="index">
				            <span class="drag-handle"></span><?=$i?>
				          </td>
				          <td>
				            <?=$dt->format('d-m-Y');?>
				          </td>
				          <td>
				            <img src="<?=base_url($GLOBALS['img_class_dir']).$row->Pictures;?>" alt='picture' style="width: 40px;">
				          </td>
				          <td>
				            <input type="radio" class="radio" 
				                   name="cover_pic" 
				                   value="<?=$row->PD_ID?>"
				                   <?PHP if($row->Is_Cover == 1) { echo 'checked'; } ?>
								   data-pid="<?=$row->Class_ID?>" style="margin:auto">
				          </td>
				          <td>
				            <a href="<?=base_url($__controller.'/deleteDet/'.$row->PD_ID.'/'.$row->Class_ID)?>" onclick="return confirm('<?=getSystemString(45)?>');">
				              <?=getSystemString(155)?>
				            </a>
				          </td>
				        </tr>
				        <?PHP
						}
						} else {
						echo '<tr><td colspan="5" class="text-center">No class Details </td></tr>';
						}
						?>
				      </tbody>
				    </table>	
				    <div class="col-xs-12">
				      <div class="dropzone dz-clickable" id="img-dropzone">
				        <div class="dz-message needsclick">
				          <p>
				            <i class="fa fa-cloud-upload fa-2x">
				            </i>
				          </p>
				          <?=getSystemString(169)?>
				        </div>
				      </div>
				    </div>	          
				  </div>





					<div class="form-group" style="position: relative;overflow: hidden;">
						<div class="col-xs-12 text-right">
							<input type="submit" class="btn btn-primary" value="<?=getSystemString(157)?>" name="submit" />
						</div>
					</div>



						</form>




























<div class="panel white size-only hide" >
   <div class="row">
            <div class="col-md-12">
               <div class="tabbable tabbable-custom boxless">
                  <ul class="nav nav-tabs">
  <li class="active"><a  href="#tab_2" data-toggle="tab"><?=getSystemString('colors')?></a></li>
<!-- <li class="active"><a  href="#tab_1" data-toggle="tab" ><?=getSystemString('sizes')?></a></li>  -->      
                   
            
                  </ul>
                  <div class="tab-content">


					  <div class="tab-pane active" id="tab_2">
                        <div class="portlet box">                        
                           <div class="portlet-body">                              
					            <div class="col-md-12 blog-page">
					               <div class="row">
<a href="#" data-toggle="modal" data-target="#optionModal" class="btn btn-primary float-left-right add-btn-toolbar addOptionModal" style="color:#FFF">
							<i class="fa fa-plus"></i> <?=getSystemString('add_color')?>
						</a>

				  		<table class="table table-hover" id="class_options">
							<thead>
								<tr>
									<th>#</th>
									<th><?= getSystemString(38).' en' ?></th>
									<th><?= getSystemString(38).' ar' ?></th>
									<th><?=getSystemString(130)?></th>
								
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
								$i=1;
								$oName = 'OptionTitle_'.$__lang;
								$pTitle = 'Title_'.$__lang;

								if(count($class_colors)):
								foreach($class_colors as $option):

								?>
									<tr>
										<td><?= $i; ?></td>
										<td><?PHP echo $option->OptionTitle_en ?></td>				<td><?PHP echo $option->OptionTitle_ar ?></td>						
										<td><?PHP echo $option->$pTitle ?> - <?= $size->SKU ?></td>

										
										<td>
											

														<div class="btn-group" style="display: block;">
													<a class="btn btn-default dropdown-toggle editOptionModal" type="button" href="#" data-toggle="modal" data-target="#optionModal" data-src='<?=json_encode($option)?>' data-size='<?=json_encode($selected_size)?>'>
														<i class="fa fa-edit"></i> <?= getSystemString(43) ?>  
													</a>

													

													<button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<span class="fa fa-angle-down"></span>
													</button>
													<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
														<li>
															<a href="#" data-toggle="modal" data-target="#optionModal" data-src='<?=json_encode($option)?>' style="margin: 0px 5px;" class="dropdown-item editOptionModal">
																<i class="fa fa-edit"></i>  <?= getSystemString(43) ?>  
															</a>
														</li>
														<li>
															<a href="<?=base_url($__controller.'/deleteOption/'.$option->Id.'/'.$option->Class_ID)?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
																<i class="fa fa-trash"></i>  <?=getSystemString(314)?>
															</a>
														</li>
													</ul>
											</div>



		

											

										    
										</td>
									</tr>
								<?PHP
								$i++;
								endforeach; ?>

							<?php 
				
						else:
							?>
								<tr>
									<td colspan="4"><?=getSystemString(450)?></td>
								</tr>
							<?PHP
							endif;
								?>
							</tbody>
						</table>

					               </div>
					           </div>
					       </div>
					   </div>
					</div>
   </div>
					</div>

                  </div>
</div>



</div>




				</div>
				
				 
		
			
		</div>
	</div>
</div>
<?PHP
	$pDetails['classId'] = $Class_ID;
	$this->load->view('classes/snippets/add_modal', $pDetails);
	$this->load->view('acp_includes/footer');
?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script type="text/javascript" src="<?=base_url('style/acp/js/dropzone.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/add_select2.js')?>"></script>

<script>
	var _unlink_url = '<?=base_url($__controller.'/unlinkImage')?>';
	var _post_url = '<?=base_url($__controller.'/uploadclassImages')?>';
	var _baseController = '<?=base_url($__controller)?>';
	var _placeholder = '<?=getSystemString(309)?>';
	var _lang = '<?=$__lang?>';













    $(".select2").select2({
		theme:'bootstrap'
	}).on('select2:open', function (e) {
		
	  //createSelect2Button(e);
	});
	
	// var options = {
	// 	formId        : "form_new_category",
	// 	ENNameId      : "category_en",
	// 	ARNameId 	  : "category_ar",
	// 	selectFieldId : "select_category",
	// 	postURL 	  : _postCategoryURL
	// };
	// Select2Options.init(options);
     
    $("select[name='category']").change(function(){
		changeCategory($(this).val());
	});                       
                                               
    $(document).on("change", "input[name='cover_pic']",function()
    {
      $('table input[name="cover_pic"]').attr('disabled', 'disabled');
      var id = $(this).val();
      var pid = $(this).attr('data-pid');
      var data = {id: id, pid: pid};
      
	      $.ajax({
	        url: "<?=base_url($__controller.'/SetclassCover')?>",
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
    
    $(document).on('click',"#classes_table tr td .hurkanSwitch", function(){
      ChangeStatusFor($(this), 'classes');
    });
    
    $('#class_details_table').on('click', function(){
      ChangeOrder('class_images');
    });
    
  
    
    // initializing dropzone
	//initializeDropzone(_post_url, _unlink_url, );
	
	var drpZoneOptions = {
		init_id : "div#img-dropzone",
		post_url : _post_url,
		unlink_url : _unlink_url,
		max_files : 8,
		for_id : $('#Class_ID').val()
	};
	initializeDropzoneAdv(drpZoneOptions);




</script>
</body>
</html>

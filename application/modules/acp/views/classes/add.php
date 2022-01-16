	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
	<div id="content-main">
		<h3><?=getSystemString(301)?></h3>
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
        			<form action="<?=base_url($__controller.'/add_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate >
		          <div class="panel white" style="padding-bottom: 50px;">
			          

						
						<div class="tab-content">
							

							<div class="tab-pane col-md-6 fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-3">
										<label for="title"><?=getSystemString(311)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
										<input type="text" class="form-control" name="title_en" id="title_en" placeholder="<?=getSystemString(311)?>">
										
									</div>
								</div>



	
				        

				      <div class="form-group">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString(72)?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
				            <textarea rows="7"  class="form-control"  name="content_en"></textarea>
				          </div>
				        </div>




				               <div class="form-group hide">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString(421)?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
				            <textarea  class="basic-editor-en" id="editor1"  name="description_en"></textarea>
				          </div>
				        </div>
				</div>





							
							<div class="tab-pane col-md-6 fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-3">
										<label for="title"><?=getSystemString(311)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
										<input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="<?=getSystemString(311)?>" dir="rtl">
										
									</div>
								</div>
								
						      <div class="form-group">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString(72)?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
				            <textarea rows="7" class="form-control" name="content_ar"></textarea>
				          </div>
				        </div>


				<div class="form-group hide">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString(421)?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
				            <textarea class="basic-editor-ar" id="editor2" name="description_ar"></textarea>
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
											<option value="<?=$row->Branch_ID?>"><?=$row->$cat_nn?></option>
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
											<option  value="<?=$row->Customer_ID?>" ><?=$row->Fullname?></option>
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
				            <input type="text" class="form-control" name="Student_Number" id="Student_Number" placeholder="<?=getSystemString('Student_Number')?>" dir="rtl"  required  
										data-parsley-required-message="<?=getSystemString(213)?>">
				          </div>
				        </div>


<hr>

		


				



		
<br>
							
			




							





							
		</div>
												
						<input type="hidden" name="class_details" id="dropzone_ret_ids">
						
						
					 				<div class="form-group">
								<div class="col-xs-12 details images-d" style="padding: 0px;">
									<!-- 	<div class="col-xs-12 col-sm-4 col-md-3">
											<label for="category"> </label>
										</div> -->
										<div class="col-xs-12 col-sm-12 no-padding-left">
											<div class="dropzone dz-clickable" id="img-dropzone">
				                                 <div class="dz-message needsclick">
												 <p>
													<i class="fa fa-cloud-upload fa-2x"></i>
												</p>
												    <?=getSystemString(169)?>
  												 </div>
											</div>
										</div>
								</div>																		
							</div>         
				         
			          
			          
		          </div>
		          <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(304)?>" name="submit" />
							</div>
						</div>
		          </form>





				</div>
			</div>
	</div>
<?PHP
	$this->load->view('classes/snippets/add_modal');
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url('style/acp/js/dropzone.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/add_select2.js')?>"></script>
<script>
	var _unlink_url = '<?=base_url($__controller.'/unlinkImage')?>';
	var _post_url = '<?=base_url($__controller.'/uploadclassImages')?>';
	var _baseController = '<?=base_url($__controller)?>';
	var _placeholder = '<?=getSystemString(309)?>';
	var _lang = '<?=$__lang?>';
	var _postCategoryURL = '<?=base_url($__controller.'/addCategoryPOP_POST')?>';
	var _postSubCategoryURL = '<?=base_url($__controller.'/addSubCategory_POST')?>';





	
	$(function()
	{



$('#sku').on('blur',function(e){
	e.preventDefault();
var SKU = $("#sku").val();


$.ajax({
  type:'POST',
  url: "<?php echo base_url($__controller.'/check_sku_exists'); ?>",
  data:{ 'SKU':SKU},
  success:function(response)
  {

console.log(response.unique);
    if (response.exist == 1) 
    {

      $("#skuErrorMsg").text("This SKU Is Already Takken. Please Try Something Else.");
      $(':input[type="submit"]').prop('disabled', true);
    }
    else if (response.exist == 0) 
    {
 $('#skuErrorMsg').text('');
    $(':input[type="submit"]').prop('disabled', false);   
     
    }    
  }
});

});

 $("body").on('click','#addPricingBtn',function(){
           $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "<?php echo base_url($__controller.'/add_pricing_record_POST');?>",
                success: function (response) {
                  $('.pricing-list').append(response.result);  
                  page = 1;                
                }
            });

      });



 $("body").on('click','#removePricingBtn',function(){
         $(this).closest('.form-group').remove();
      });






		$('.select_unit').on('change',function(e){
			let unit_id = $(this).find(":selected").val();
			

			if(unit_id == 12){  //m2
				

			$.ajax({
                type: "POST",
                dataType: "JSON",
                data: {unit_id : unit_id},
                url: "<?php echo base_url($__controller.'/add_pricing_per_meter');?>",
                success: function (response) {
                  $('.pricing-div').html(response.result);  
                  page = 1;                
                }
            });


			}else{


			$.ajax({
                type: "POST",
                dataType: "JSON",
                 data: {unit_id : unit_id},
                url: "<?php echo base_url($__controller.'/add_pricing_per_unit');?>",
                success: function (response) {
                  $('.pricing-div').html(response.result);  
                  page = 1;                
                }
            });


			}
		});











		
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
		
		$("select[name='category']").change(function()
		{
			var _val = $(this).val();
			// alert(_val);
			var _url = _baseController+"/getSubCategoriesByCategory/"+_val;
			
			var _selector = $("#select_subcategory");
			
			$.get(_url, function(r){
				
				var result = JSON.parse(r);
				
				_selector.empty();
				
				var options = '<option value="">'+_placeholder+'</option>';
				for(var i = 0; i < result.length; i++)
				{
					options += '<option value="'+result[i].SubCategory_ID+'">'+result[i].SubCategory+'</option>';
				}
				
				_selector.append(options);
				_selector.closest('.form-group').removeClass('hide');
				
				$("#select_subcategory.select2").select2({
					theme:'bootstrap'
				});
				
				var newOptions = {
					formId        : "form_new_subcategory",
					ENNameId      : "subcategory_en",
					ARNameId 	  : "subcategory_ar",
					selectFieldId : "select_subcategory",
					postURL 	  : _postSubCategoryURL,
					parentId	  : "select_category"
				};
				
				Select2Options.init(newOptions);
				
			});
		});
		
		// initializing dropzone
		initializeDropzone(_post_url, _unlink_url);
	}); 			
</script>
<script>
$("#length,#class_width,#height").on("change paste keyup", function() {
   var length = $( "#length" ).val();
   var class_width = $( "#class_width" ).val();
   var height = $( "#height" ).val();

   if(length != '' && class_width != '' &&  height != ''){

	   var cbm_total = length*class_width*height/1000000;
	   $( "#cbm_total" ).text('CBM = '+cbm_total);
   } else {
	$( "#cbm_total" ).text('');
   }
});


</script>
</body>
</html>
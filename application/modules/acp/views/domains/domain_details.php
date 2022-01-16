	


<!-- 	<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>"> -->
	
	<style>
		.panel.white{
			min-height: 150px;
		}
		table th{
			width: 250px;
		}
		.user-rating{
			text-align: center;
			direction: ltr;
			width:135px;
			margin:auto;
		}
		.user-rating .fa{
			font-size: 22px;
			margin: 1px;
		}
		.star-grey{
			color: #e8e8e8;
		}
		.star-colored{
			color:#ffcc00;
		}
		body[dir="rtl"] .user-rating{
			direction: rtl;
		}
		body[dir="ltr"] #customer_table th, body[dir="ltr"] #customer_table td{
			text-align: left;
		}
		body[dir="rtl"] #customer_table th, body[dir="rtl"] #customer_table td{
			text-align: right;
		}
		#diets_table td:not(.dataTables_empty):first-child{
			display: none;
		}
		#diets_table th:last-child{
			width: 200px; 
		}
		.dataTables_wrapper{
		    max-width: 100% !important;
		}
		#diets_table td:nth-child(7){
			display: none;
		}
	</style>
	<?PHP
		$title = 'Title_'.$__lang;
		$subcategory = 'SubCategory_'.$__lang;
		$category = 'Category_'.$__lang;
		$desc = 'Description_'.$__lang;
		$cat_nn = 'countryName_'.$__lang;
		$name = 'name_'.$__lang;
	?>





					<div id="reject_domain" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	    <form class="form-horizontal" method="post"  action="<?=  base_url('acp/domains/reject_domain') ?>" data-parsley-validate>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"> <i class="fa fa-plus"></i> رفض انشاء نطاق</h4>
	      </div>
	      <div class="modal-body" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">
	         
		  	<input type="hidden" name="request_id" value="<?= $request_id ?>">
	      	<input type="hidden" name="domain_id" value="<?= $domain->Domain_ID ?>">
	      	<input type="hidden" name="do_id" value="<?= $domain->RegisterOrder->DO_ID ?>">



	      					<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label >الحالة</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left display-select2">
								<select class="form-control select2 " 
										name="reject_status" 
										data-placeholder="<?=getSystemString(198)?>" >
										
									<option value="need_modification">بحاجة للتعديل</option>					
									<option value="reject">مرفوض</option>
						
								</select>
								
							</div>
							</div>




	           
		        <div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title">سبب الرفض</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
	

			<textarea required data-parsley-required-message="<?=getSystemString(213)?>" id="reply" name="reject_reasons" class="form-control" rows="6" placeholder="ادخل نص هنا..."></textarea>
					</div>
				</div>
				

	        
	      </div>
	      <div class="modal-footer">
		    <input type="submit" class="btn btn-primary" name="submit" value="<?=getSystemString(16)?>">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString(688)?></button>
	      </div>
      
      </form>
    </div>

  </div>
</div>



					<div id="delete_domain" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	    <form class="form-horizontal" method="post"  action="<?=  base_url('acp/domains/delete_domain') ?>" data-parsley-validate>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"> <i class="fa fa-plus"></i>حذف النطاق</h4>
	      </div>
	      <div class="modal-body" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">
	         
	      	<input type="hidden" name="domain_id" value="<?= $domain->Domain_ID ?>">



	      					<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label >ارجاع المبلغ</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left display-select2">
								<select class="form-control select2 " 
										name="refund_status" 
										data-placeholder="<?=getSystemString(198)?>" >
										
									<option value="1">نعم</option>					
									<option value="0">لا</option>
						
								</select>
								
							</div>
							</div>




	           
		        <div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"> سبب الحذف</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
	

			<textarea required data-parsley-required-message="<?=getSystemString(213)?>" id="reply" name="delete_reasons" class="form-control" rows="6" placeholder="ادخل نص هنا..."></textarea>
					</div>
				</div>
				

	        
	      </div>
	      <div class="modal-footer">
		    <input type="submit" class="btn btn-primary" name="submit" value="<?=getSystemString(16)?>">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString(688)?></button>
	      </div>
      
      </form>
    </div>

  </div>
</div>








<div id="edit_entity" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	    <form class="form-horizontal" method="post"  action="<?=  base_url('acp/domains/save_registrant') ?>" data-parsley-validate>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">  <?= getSystemString('entity') ?></h4>
	      </div>
	      <div class="modal-body" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">


	      	     <input type="hidden" name="contact_id" class="contact_id" value="<?= $domain->Org_Usr_ID ?>">
	             <input type="hidden" name="domain_id" class="domain_id" value="<?= $domain->Domain_ID  ?>">
				 <input type="hidden" name="update_epp" class="update_epp" value="TRUE">

	      			<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?= getSystemString('activity_type') ?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left display-select2">
							                <select class="form-control select"
                              		    id="registrant_activity_type"
                                        name="registrant_activity_type"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        required
                                        >

                                        <option value=""></option>
                                                        <?PHP                                       
                                      foreach ($activity_types as $key => $activity_type) { ?>

                    <option <?= ($domain->Org_Activity_ID == $activity_type->id)?'selected':($activity_type->id == 194)?'selected':'' ?> value="<?=$activity_type->id?>"><?=$activity_type->$name?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>
								
							</div>
					</div>


	           
		        <div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('entity_name') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 <input  class="form-control" value="<?= $domain->Full_Name ?>" id="registrant_entity_name" type="text" name="entity_name" placeholder="<?=getSystemString('entity_name')?>"  required="">
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('first_address') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						<input class="form-control" value="<?= $domain->User_Address1 ?>"  type="text" name="registrant_first_address" placeholder="<?=getSystemString('eg_altaawun')?>"
                                      required="">
					</div>
				</div>

					<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?= getSystemString(234) ?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left display-select2">
							                <select class="form-control select"

                                        name="registrant_country"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        required
                                        >

                                        <option value=""></option>
                                                        <?PHP
                                        foreach($countries as $row){
                                            ?>
                    <option <?= ($row->Country_ID == $domain->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?> value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>
								
							</div>
					</div>


				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('region') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control" value="<?= $domain->User_Region ?>"  type="text" name="registrant_region" placeholder="<?=getSystemString('contact_region_placeholder')?>" >
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(202) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control" value="<?= $domain->User_City ?>" type="text" name="registrant_city" placeholder="<?=getSystemString('contact_city_placeholder')?>"
                               required="">
					</div>
				</div>


			 <div class="form-group hide">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('post_code') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control" value="<?= $domain->User_Post_Code ?>" type="text" name="registrant_post_code" placeholder="<?=getSystemString('post_code')?>"
                               >
					</div>
				</div>




			    <div class="form-group hide">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(206) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						     <input class="form-control" value="<?= $domain->User_Phone ?>"  type="text" name="registrant_phone" placeholder="<?=getSystemString(206)?>"
                             >
					</div>
				</div>

				<div class="form-group hide">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(137) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control " value="<?= $domain->User_Mobile ?>"  type="text" name="registrant_mobile" placeholder="<?=getSystemString(137)?>"
                               required="">
					</div>
				</div>

				<div class="form-group hide">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(1) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control" value="<?= $domain->User_Email ?>"  type="text" name="registrant_email" placeholder="<?=getSystemString(1)?>"
                               required="">
					</div>
				</div>



				

	        
	      </div>
	      <div class="modal-footer">
		    <input type="submit" class="btn btn-primary" name="submit" value="<?=getSystemString(16)?>">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString(688)?></button>
	      </div>
      
      </form>
    </div>

  </div>
</div>














<div id="edit_contact" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	    <form class="form-horizontal edit_contact_frm" method="post"  action="<?=  base_url('acp/domains/save_contact_info') ?>" data-parsley-validate>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title edit_contact_title"></h4>
	      </div>
	      <div class="modal-body" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">
	        

	     <input type="hidden" name="contact_role" class="contact_role" value="">
	     <input type="hidden" name="contact_id" class="contact_id" value="">
	     <input type="hidden" name="domain_id" class="domain_id" value="<?= $domain->Domain_ID  ?>">






	           
		        <div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(81) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 	    <input class="form-control Full_Name" value="" type="text" name="Full_Name" placeholder="<?= getSystemString('entity_name') ?>"
                                                pattern="[a-zA-Zء-ي ][a-zA-Zء-ي ]+[a-zA-Zء-ي ]$"
                                      required=""
                                      data-parsley-trigger="change"
                                      data-parsley-pattern-message="<?=getSystemString(213)?>"
                                      data-parsley-type-message="<?=getSystemString(213)?>"
                                      data-parsley-required-message="<?=getSystemString('required')?>">
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('employer_name') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						<input class="form-control Employer_Name" value="" type="text" name="Employer_Name" placeholder="<?= getSystemString('eg_altaawun') ?>">

					</div>
				</div>



				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('job_title') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						<input class="form-control User_Job_Title" value="" type="text" name="User_Job_Title" placeholder="<?= getSystemString('job_title') ?>"
							                                      >

					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('first_address') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						  <input class="form-control User_Address1" value="" type="text" name="User_Address1" placeholder="<?= getSystemString('contact_address2_placeholder') ?>"  required="">

					</div>
				</div>

				<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?= getSystemString(234) ?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left display-select2">
							                <select class="form-control select User_Country_ID"
                              		    id="User_Country_ID"
                                        name="User_Country_ID"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        required
                                        >

                                        <option value=""></option>
                                                        <?PHP
                                        foreach($countries as $row){
                                            ?>
                    <option  value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>
								
							</div>
					</div>



				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('region') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control User_Region" value="" id="User_Region" type="text" name="User_Region" placeholder="<?=getSystemString('contact_region_placeholder')?>" >
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(202) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control User_City" value="" id="User_City" type="text" name="User_City" placeholder="<?=getSystemString('contact_city_placeholder')?>"
                               required="">
					</div>
				</div>

			    <div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(206) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						     <input class="form-control User_Phone" value="" id="User_Phone" type="text" name="User_Phone" placeholder="<?=getSystemString(206)?>"
                             >
					</div>
				</div>

				<div class="form-group editMobileFrm">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(137) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
					<input class="form-control User_Mobile phone_flag" 
					 id="mobile" type="tel" name="User_Mobile" 
                                     required=""               
                                     dir="ltr" 
                                     value=""
                                     minlength="8" maxlength="12"                                  
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(364)?>"
                                      data-parsley-type-message="<?=getSystemString('enter_phone_no')?>">

                      <input class="form-control mobile_key" 
                         type="hidden"                         
                         name="mobile_key" 
                         value="966"> 

                          <div  class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                          <div  class="hide text-danger"><?=getSystemString('mobile_error')?></div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('post_code') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control User_Post_Code" value="" id="User_Post_Code" type="text" name="User_Post_Code" placeholder="<?=getSystemString('post_code')?>"
                               >
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(1) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control User_Email" value="" id="registrant_city_org" type="text" name="User_Email" placeholder="<?=getSystemString(1)?>"
                               required="">
					</div>
				</div>



	        
	      </div>
	      <div class="modal-footer">
		    <input type="submit" class="btn btn-primary save_contact_btn" name="submit" value="<?=getSystemString(16)?>">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString(688)?></button>
	      </div>
      
      </form>
    </div>

  </div>
</div>










	<div id="content-main">
		
		<div class="row">
			<?PHP
				$this->load->view('acp_includes/response_messages');
			?>
		</div>
		
		<div class="row">
						
			<div class="col-md-12">
				<h3 class="text-primary" onclick="javascript: window.location.reload()" style="cursor: pointer">
					<?=$domain->Domain_Name.$domain->TLD ?>  (# <?= str_pad($domain->Domain_ID, 5, '0', STR_PAD_LEFT); ?>  )
					
					<!-- <a href="<?=base_url('acp/diets/add/'.$customer[0]->Customer_ID)?>" class="btn btn-primary btn-sm pull-right" style="color:#FFF">
					    <i class="fa fa-plus"></i> <?=getSystemString(702)?>
				    </a> -->
				</h3>

	

						
			<div class="col-md-12">

<?php 
if(!$domain->IS_Domain_Created ){ ?>

	<?php if($domain->Domain_Status != 'REJECTED' && !empty($domain->RegisterOrder)){ ?>
 	<a href="<?=base_url('acp/epp/created_domain/'.$domain->Domain_ID.'/'.$request_id)?>" onclick="return confirm('Are you sure you want to create this domain?');" class="btn btn-primary btn-sm pull-left" style="margin-bottom: 20px;
    margin-right: 10px; color:#FFF">
					    <i class="fa fa-plus"></i> انشاء النطاق</a>
		<?php } ?>

<?php if($domain->Domain_Status != 'REJECTED'){ ?>
	<a  data-toggle="modal" data-target="#reject_domain"  class="btn btn-danger btn-sm pull-left" style="margin-bottom: 20px;
                         margin-right: 10px; color:#FFF">
					     رفض الطلب</a>
	<?php } ?>

				   
<?php }elseif($domain->Domain_Status != 'ADMIN DELETE' && $domain->Domain_Status != 'DELETED'  && $domain->Domain_Status != 'PENDING DELETE'){ ?>


			<a  data-toggle="modal" data-target="#delete_domain"  class="btn btn-danger btn-sm pull-left" style="margin-bottom: 20px;
                         margin-right: 10px; color:#FFF">
					     حذف النطاق</a>

			<a href="<?=base_url('acp/epp/update_domain/'.$domain->Domain_ID.'/'.$request_id)?>" class="btn btn-default btn-sm pull-left" style="margin-bottom: 20px;
    margin-right: 10px; color:black;">
					     تحديث النطاق</a>


<?php } ?>


			</div>
  
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					
					
<div class="col-md-6">

		<div style="padding-top: 10px;color:#3498db">
				<h4><?=getSystemString('domain_information')?></h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
		

				<tr>
								<th><?= getSystemString('domain_name') ?></th>
								<td>
									<?PHP
										echo $domain->Domain_Name.$domain->TLD
									?>	
								</td>
							</tr>

							<tr>
								<th><?=getSystemString('domain_status')?></th>
								<td>
									<?PHP
										echo getSystemString($domain->Domain_Status);

	
									?>	
								</td>
							</tr>

							<?php if($domain->Domain_Status == 'ADMIN DELETE'){ ?>

						    <tr>
								<th>سبب الحذف </th>
								<td>
								 <?= $domain->Admin_Delete_Reason ?>
								</td>
							</tr>


						    <tr>
								<th>تاريخ الحذف </th>
								<td>
								 <?= $domain->Admin_Delete_Date ?>
								</td>
							</tr>

							<tr>
								<th>تم الحذف بواسطة </th>
								<td>
								 <?= $domain->Admin_Delete_User_Name ?>
								</td>
							</tr>


							<?php } ?>

				

											<?php $Server_ips = json_decode($domain->Server_ips); ?>

							<tr>
								<th><?=getSystemString('primary_server')?></th>
								<td>
								 <?= $domain->Primary_Server ?>
								</td>
							</tr>

							<?php if(!empty($Server_ips[0])){ ?>
							<tr>
								<th>Ip</th>
								<td>
								 <?= $Server_ips[0] ?>
								</td>
							</tr>
                             <?php } ?>

							<tr>
								<th><?=getSystemString('secondary_server')?></th>
								<td>

								 <?= $domain->Secondery_Server ?>
								</td>
							</tr>
								<?php if(!empty($Server_ips[1])){ ?>
							<tr>
								<th>Ip</th>
								<td>
								 <?= $Server_ips[1] ?>
								</td>
							</tr>
                             <?php } ?>



                                  <?php 
                                                $secondary_servers = json_decode($domain->Secondary_Servers);
                                               
                                                foreach ($secondary_servers as $key => $server) {                                                                                                   
                                      ?>

				                <tr>
								<th><?=getSystemString('secondary_server')?></th>
								<td>

								  <?= $server->name_server ?>
								</td>
							</tr>
								<?php if(!empty($server->ip)){ ?>
							<tr>
								<th>Ip</th>
								<td>
								 <?= $server->ip ?>
								</td>
							</tr>
                             <?php } 
                         }?>

                        <?php if(!empty($domain->Expire_Date)){ ?>
							<tr>
								<th><?= getSystemString('End Date') ?></th>
								<td>
								 <?= $domain->Expire_Date ?>
								</td>
							</tr>
						<?php  } ?>

						 <?php if(!empty($request->Approved_By_Admin)){ ?>
							<tr>
								<th><?= getSystemString('approved_by') ?></th>
								<td>
								 <?= $request->Approved_By_Admin ?>
								</td>
							</tr>
							<tr>
								<th><?= getSystemString('approve_admin_date') ?></th>
								<td>
								 <?= $request->Approved_At_Admin ?>
								</td>
							</tr>
						<?php  } ?>


		

	</tbody>
</table>



		<div style="color:#3498db">
				<h4><?=getSystemString('registrar_information')?></h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
		

				<tr>
								<th><?= getSystemString(81) ?></th>
								<td>
									<a href="<?=base_url('acp/customerDetails/'.$domain->Registrar->Customer_ID)?>"><?=$domain->Registrar->Fullname?></a>	
								</td>
							</tr>

							<tr>
								<th><?=getSystemString(1)?></th>
								<td>
									<?PHP
										echo $domain->Registrar->Email
									?>	
								</td>
							</tr>
							<tr>
								<th><?=getSystemString(206)?></th>
								<td dir="ltr">
									<a href="tel:+<?=$domain->Registrar->Phone_Key.$domain->Registrar->Phone?>">+<?=$domain->Registrar->Phone_Key.$domain->Registrar->Phone?></a>	
								</td>
							</tr>
							<tr>
								<th><?=getSystemString('relation_between_registrar')?></th>
								<td>
									<?PHP
										echo $domain->Relation_Between
									?>	
								</td>
							</tr>

		

	</tbody>
</table>

		<div style="color:#3498db">
				<h4><?=getSystemString('documents')?></h4>
			</div>

 <?php    if(!empty($domain->Docs->support)){ ?>
 <table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>

					<?php if(!empty($domain->Docs->support->Doc_Title)){ ?>

						    <tr>
								<th><?=getSystemString('doc_title')?></th>
								<td>
									<?PHP
										echo $domain->Docs->support->Doc_Title;
									?>	
								</td>
							</tr>
					<?php } ?>

							   <tr>
								<th><?=getSystemString('doc_type')?></th>
								<td>
									   <?=   GetDocTypeById($domain->Docs->support->Doc_Type_ID,$__lang);  ?>
								</td>
							</tr>
							   <tr>
								<th><?=getSystemString('doc_date')?></th>
								<td>
									<?PHP
										echo $domain->Docs->support->Doc_Date;
									?>	
								</td>
							</tr>
					<?php if(!empty($domain->Docs->support->Hijri_Date)){ ?>

							   <tr>
								<th><?=getSystemString('hijri_date')?></th>
								<td>
									<?PHP
										echo $domain->Docs->support->Hijri_Date;
									?>	
								</td>
							</tr>
					<?php } ?>
					<?php if(!empty($domain->Docs->support->Meladi_Date)){ ?>
								   <tr>
								<th><?=getSystemString('gregorian_date')?></th>
								<td>
									<?PHP
										echo $domain->Docs->support->Meladi_Date;
									?>	
								</td>
							</tr>
					<?php } ?>
							   <tr>
								<th><?=getSystemString('doc_number')?></th>
								<td>
									<?PHP
										echo $domain->Docs->support->Doc_Num;
									?>	
								</td>
							</tr>
				
</tbody>
</table>
 <?php  
} ?>
							 		<?php 
							if(!empty($domain->Docs->speech)){
							 ?>                                                
                                                    <div class="col-md-4 text-center">
                                                    
                                                  
                                                   <p><?= getSystemString('speech_document') ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain->Docs->speech->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>
                   
                                                    </div><!-- /.col -->
                                       <?php }
                                       if (!empty($domain->Docs->additional)) { ?>
                                       	 <div class="col-md-4 text-center">
                                                 

                                                           <p><?= getSystemString('addtional_doc') ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain->Docs->additional->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>


                                                    </div><!-- /.col -->
                                       	<?php }
                                       	 if (!empty($domain->Docs->support)) { ?>
                                       		     <div class="col-md-4 text-center">
                                                   
                                                           <p><?= getSystemString('doc_support') ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain->Docs->support->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>


                                                    </div><!-- /.col -->
                                       <?php } ?>
                        

</div>




	<div class="col-md-6">



		<div style="padding-top: 10px;color:#3498db">
			<div class="col-md-4">
				<span><h4><?=getSystemString('entity_information')?></h4></span>
			</div>
			<div class="col-md-3">	

		<?php  if($domain->Domain_Status == 'Done'){ ?>	
				<a  data-toggle="modal" data-target="#edit_entity"  class="btn btn-default btn-sm pull-left btn-block" style="margin-bottom: 20px; margin-right: 10px; color:black;"><i class="fa fa-edit"></i>    <?= getSystemString(43) ?>   </a>
		<?php } ?>
			</div>
		</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
	

					<tr>
								<th><?=getSystemString('activity_type')?></th>
								<td>
									 <?= GetConstantById($domain->Org_Activity_ID,$__lang) ?>	
								</td>
							</tr>

								<tr>
								<th><?=getSystemString('entity_name')?></th>
								<td>
									<?PHP
										echo $domain->Full_Name
									?>	
								</td>
							</tr>

							<tr>
								<th><?=getSystemString('first_address')?></th>
								<td>
									<?PHP
										echo $domain->User_Address1
									?>	
								</td>
							</tr>

						<?php if(!empty($domain->User_Address2)){ ?>
							<tr>
								<th><?=getSystemString('second_address')?></th>
								<td>
									<?PHP
										echo $domain->User_Address2
									?>	
								</td>
							</tr>
						<?php } ?>

							<tr>
								<th><?=getSystemString(234)?></th>
								<td>
                                   <?= GetCountryById($domain->User_Country_ID,$__lang) ?>                                                                                                        									
								</td>
							</tr>

	<?php if(!empty($domain->User_Region)){ ?>
									<tr>
								<th><?=getSystemString('region')?></th>
								<td>
									<?PHP
										echo $domain->User_Region
									?>	
								</td>
							</tr>
						<?php } ?>

									<tr>
								<th><?=getSystemString(202)?></th>
								<td>
									<?PHP
										echo $domain->User_City
									?>	
								</td>
							</tr>
							<?php if(!empty($domain->Org_PostCode)){ ?>
									<tr>
								<th><?=getSystemString('post_code')?></th>
								<td>
									<?PHP
										echo $domain->User_Post_Code
									?>	
								</td>
							</tr>
						<?php } ?>

						
</tbody>
</table>
</div>


	<div class="col-md-6">


	<div style="padding-top: 10px;color:#3498db">
			<div class="col-md-4">
				<span><h4><?=getSystemString('admin_officer')?></h4></span>
			</div>
			<div class="col-md-3">	
			<?php  if($domain->Domain_Status == 'Done'){ ?>		
				<a   data-toggle="modal" data-target="#edit_contact" data-role='admin' data-uid='<?=$domain->Admin->Org_Usr_ID?>'  class="edit_contact_btn btn btn-default btn-sm pull-left btn-block" style="margin-bottom: 20px; margin-right: 10px; color:black;"><i class="fa fa-edit"></i>    <?= getSystemString(43) ?>   </a>
			<?php } ?>
			</div>
		</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
	

					<tr>
								<th><?=getSystemString(81)?></th>
								<td>
									<?PHP
										echo $domain->Admin->Full_Name;
									?>	
								</td>
							</tr>

							<?php if(!empty($domain->Admin->User_Job_Title)){ ?>

								<tr>
								<th><?=getSystemString('job_title')?></th>
								<td>
									<?PHP
										echo $domain->Admin->User_Job_Title
									?>	
								</td>
							</tr>
						<?php } ?>

							<tr>
								<th><?=getSystemString('first_address')?></th>
								<td>
									<?PHP
										echo $domain->Admin->User_Address1
									?>	
								</td>
							</tr>

							<?php if(!empty($domain->Admin->User_Address2)){ ?>
							<tr>
								<th><?=getSystemString('second_address')?></th>
								<td>
									<?PHP
										echo $domain->Admin->User_Address2
									?>	
								</td>
							</tr>
						<?php } ?>

						<?php if(!empty($domain->Admin->User_Country_ID)){ ?>
							<tr>
								<th><?=getSystemString(234)?></th>
								<td>
						
									<?= GetCountryById($domain->Admin->User_Country_ID,$__lang) ?> 
								</td>
							</tr>
						<?php } ?>

						<?php if(!empty($domain->Admin->User_Region)){ ?>

									<tr>
								<th><?=getSystemString('region')?></th>
								<td>
									<?PHP
										echo $domain->Admin->User_Region
									?>	
								</td>
							</tr>
						<?php } ?>

						<?php if(!empty($domain->Admin->User_City)){ ?>

									<tr>
								<th><?=getSystemString(202)?></th>
								<td>
									<?PHP
										echo $domain->Admin->User_City
									?>	
								</td>
							</tr>
						<?php } ?>

						<?php if(!empty($domain->Admin->User_Post_Code)){ ?>

									<tr>
								<th><?=getSystemString('post_code')?></th>
								<td>
									<?PHP
										echo $domain->Admin->User_Post_Code
									?>	
								</td>
							</tr>
						<?php } ?>
						<?php if(!empty($domain->Admin->User_Phone)){ ?>

									<tr>
								<th><?=getSystemString(206)?></th>
								<td>
									<?PHP
										echo $domain->Admin->User_Phone
									?>	
								</td>
							</tr>
						<?php } ?>

								<tr>
								<th><?=getSystemString(137)?></th>
								<td dir="ltr">
									<?PHP
										echo '+'.$domain->Admin->Mobile_Key.$domain->Admin->User_Mobile
									?>	
								</td>
							</tr>
							<?php if(!empty($domain->Admin->User_Fax)){ ?>

								<tr>
								<th><?=getSystemString('fax')?></th>
								<td>
									<?PHP
										echo $domain->Admin->User_Fax
									?>	
								</td>
							</tr>
						<?php } ?>
								<tr>
								<th><?=getSystemString(1)?></th>
								<td>
									<?PHP
										echo $domain->Admin->User_Email
									?>	
								</td>
							</tr>

						
</tbody>
</table>
</div>



	<div class="col-md-6">

		<div style="padding-top: 10px;color:#3498db">
			<div class="col-md-4">
				<span><h4><?=getSystemString('technical_responsible')?></h4></span>
			</div>
			<div class="col-md-3">	
			<?php  if($domain->Domain_Status == 'Done'){ ?>		
				<a   data-toggle="modal" data-target="#edit_contact"  data-uid='<?=$domain->Technical->Org_Usr_ID?>' data-role='technical'  class="edit_contact_btn btn btn-default btn-sm pull-left btn-block" style="margin-bottom: 20px; margin-right: 10px; color:black;"><i class="fa fa-edit"></i>    <?= getSystemString(43) ?>   </a>
			<?php } ?>
			</div>
		</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
	<?php if($domain->Admin_ID == $domain->Technical_ID){ ?>
				<tr>
								<th><?=getSystemString('step1_option1')?></th>
								<td>
							
								</td>
							</tr>
	<?php }elseif(!empty($domain->Technical->Full_Name)){ ?>
						<tr>
								<th><?=getSystemString(81)?></th>
								<td>
									<?PHP
										echo $domain->Technical->Full_Name;
									?>	
								</td>
							</tr>

					<?php if(!empty($domain->Technical->User_Job_Title)){ ?>

								<tr>
								<th><?=getSystemString('job_title')?></th>
								<td>
									<?PHP
										echo $domain->Technical->User_Job_Title
									?>	
								</td>
							</tr>
						<?php } ?>

							<tr>
								<th><?=getSystemString('first_address')?></th>
								<td>
									<?PHP
										echo $domain->Technical->User_Address1
									?>	
								</td>
							</tr>
					<?php if(!empty($domain->Technical->User_Address2)){ ?>

							<tr>
								<th><?=getSystemString('second_address')?></th>
								<td>
									<?PHP
										echo $domain->Technical->User_Address2
									?>	
								</td>
							</tr>
					<?php } ?>
							<tr>
								<th><?=getSystemString(234)?></th>
								<td>

									<?= GetCountryById($domain->Technical->User_Country_ID,$__lang) ?> 

								</td>
							</tr>

					<?php if(!empty($domain->Technical->User_Region)){ ?>

									<tr>
								<th><?=getSystemString('region')?></th>
								<td>
									<?PHP
										echo $domain->Technical->User_Region
									?>	
								</td>
							</tr>
						<?php } ?>

									<tr>
								<th><?=getSystemString(202)?></th>
								<td>
									<?PHP
										echo $domain->Technical->User_City
									?>	
								</td>
							</tr>
					<?php if(!empty($domain->Technical->User_Post_Code)){ ?>

									<tr>
								<th><?=getSystemString('post_code')?></th>
								<td>
									<?PHP
										echo $domain->Technical->User_Post_Code
									?>	
								</td>
							</tr>
						<?php } ?>
					<?php if(!empty($domain->Technical->User_Phone)){ ?>

									<tr>
								<th><?=getSystemString(206)?></th>
								<td>
									<?PHP
										echo $domain->Technical->User_Phone
									?>	
								</td>
							</tr>
					<?php } ?>
								<tr>
								<th><?=getSystemString(137)?></th>
								<td dir="ltr">
									<?PHP
										echo '+'.$domain->Technical->Mobile_Key.$domain->Technical->User_Mobile
									?>	
								</td>
							</tr>
					<?php if(!empty($domain->Technical->User_Fax)){ ?>

								<tr>
								<th><?=getSystemString('fax')?></th>
								<td>
									<?PHP
										echo $domain->Technical->User_Fax
									?>	
								</td>
							</tr>
						<?php } ?>
								<tr>
								<th><?=getSystemString(1)?></th>
								<td>
									<?PHP
										echo $domain->Technical->User_Email
									?>	
								</td>
							</tr>
	<?php } ?>



						
</tbody>
</table>
</div>

	<div class="col-md-6">

		<div style="padding-top: 10px;color:#3498db">
			<div class="col-md-4">
				<span><h4><?=getSystemString('financial_officer')?></h4></span>
			</div>
			<div class="col-md-3">	
			<?php  if($domain->Domain_Status == 'Done'){ ?>		
				<a   data-toggle="modal" data-target="#edit_contact"  data-uid='<?=$domain->Financial->Org_Usr_ID?>'  data-role="financial"  class="edit_contact_btn btn btn-default btn-sm pull-left btn-block" style="margin-bottom: 20px; margin-right: 10px; color:black;">    <?= getSystemString(43) ?>   </a>
			<?php } ?>
			</div>
		</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
	<?php if($domain->Admin_ID == $domain->Financial_ID){ ?>
				<tr>
								<th><?=getSystemString('step1_option1')?></th>
								<td>
										
								</td>
							</tr>
	<?php }elseif(!empty($domain->Financial->Full_Name)){ ?>
						<tr>
								<th><?=getSystemString(81)?></th>
								<td>
									<?PHP
										echo $domain->Financial->Full_Name;
									?>	
								</td>
							</tr>

						  <tr  style="display: none;">
								<th><?=getSystemString('job_title')?></th>
								<td>
									<?PHP
										echo $domain->Financial->User_Job_Title
									?>	
								</td>
							</tr>

							<tr>
								<th><?=getSystemString('first_address')?></th>
								<td>
									<?PHP
										echo $domain->Financial->User_Address1
									?>	
								</td>
							</tr>
							<tr style="display: none;">
								<th><?=getSystemString('second_address')?></th>
								<td>
									<?PHP
										echo $domain->Financial->User_Address2
									?>	
								</td>
							</tr>
							<tr>
								<th><?=getSystemString(234)?></th>
								<td>

									<?= GetCountryById($domain->Financial->User_Country_ID,$__lang) ?> 

								</td>
							</tr>


									<tr  style="display: none;">
								<th><?=getSystemString('region')?></th>
								<td>
									<?PHP
										echo $domain->Financial->User_Region
									?>	
								</td>
							</tr>

									<tr>
								<th><?=getSystemString(202)?></th>
								<td>
									<?PHP
										echo $domain->Financial->User_City
									?>	
								</td>
							</tr>
						<tr  style="display: none;">
								<th><?=getSystemString('post_code')?></th>
								<td>
									<?PHP
										echo $domain->Financial->User_Post_Code
									?>	
								</td>
							</tr>

									<tr>
								<th><?=getSystemString(206)?></th>
								<td>
									<?PHP
										echo $domain->Financial->User_Phone
									?>	
								</td>
							</tr>
								<tr>
								<th><?=getSystemString(137)?></th>
								<td dir="ltr">
									<?PHP
										echo '+'.$domain->Financial->Mobile_Key.$domain->Financial->User_Mobile
									?>	
								</td>
							</tr >
								<tr  style="display: none;">
								<th><?=getSystemString('fax')?></th>
								<td>
									<?PHP
										echo $domain->Financial->User_Fax
									?>	
								</td>
							</tr>
								<tr>
								<th><?=getSystemString(1)?></th>
								<td>
									<?PHP
										echo $domain->Financial->User_Email
									?>	
								</td>
							</tr>
	<?php } ?>



						
</tbody>
</table>
</div>























































											
				</div>
			</div>

			<div class="col-xs-12">
				<ul class="nav nav-tabs">

<li ><a data-toggle="tab" href="#domain_logs"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('domain_logs')?></a></li>

<li class="active"><a data-toggle="tab" href="#payment_info"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('payment_info')?></a></li>

<li ><a data-toggle="tab" href="#application_logs"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('application_logs')?></a></li>
<li ><a data-toggle="tab" href="#dns_records"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('dns_records')?></a></li>

<?php if(!empty($inside_domain_changes)){ ?>
<li ><a data-toggle="tab" href="#inside_domain_changes"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('inside_domain_changes')?></a></li>
 <?php } ?>

<?php if(!empty($transfer_inside_dnet_logs)){ ?>
<li ><a data-toggle="tab" href="#transfer_inside_dnet_logs"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('transfer_inside_dnet_logs')?></a></li>
 <?php } ?>

 <li ><a data-toggle="tab" href="#domain_orders"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('orders')?></a></li>
		

				

				   

				
				</ul>
				
				<div class="tab-content" style="padding-top: 0px !important">







				
					<div class="tab-pane fade " id="domain_orders">
						<div class="panel white">
						<table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
								<tbody>

									<thead>
										<tr>
																				
											<th><?= getSystemString(348) ?></th>								
											<th><?= getSystemString(33) ?></th>	
											<th><?= getSystemString(42) ?></th>
											<th><?= getSystemString(177) ?></th>												<th><?= getSystemString(180) ?></th>																


										</tr>
									</thead>

							
								<?php foreach ($all_change_requests as $row) { 

			     $status = array(
												'pending'    => 'primary',
												'approved' => 'success',
												'refused'   => 'danger',
												'deleted'   => 'danger',
												'canceled'   => 'danger',
												'incomplete'   => 'primary',
												'need_modification'   => 'danger',


											);


			$request_status = $row->DCR_Status;
			$label = $status["$request_status"];

			/* on case transfer in and the domain not saved */
			if($row->DCR_Domain_ID == 0){
				$post_data = json_decode($row->DCR_POST_DATA);
				$domain_ns = $post_data->DTI_Domain_Name.$post_data->DTI_TLD;
			}else{
				$domain_ns = $row->Domain_Name.$domain->TLD;
			}

			if($request_status != 'incomplete' && $request_status != 'canceled' && $request_status != 'deleted'  && $request_status != 'refused' && $request_status != 'need_modification'){


				if($row->Payment_Verified){
					$payment_verified = 1;
				}elseif($row->tr_Payment_Verified){
					$payment_verified = 1;					
				}else{
					$payment_verified = 0;					
				}
				   
				if($row->Need_Payment && !$payment_verified && $row->DCR_Admin_Approve){
						$row->DCR_Status = 'waiting_payments';
						$label = 'warning';
				}
				if(!$row->DCR_Admin_Approve){
					$row->DCR_Status = 'admin_waiting_approve';
					$label = 'warning';
				}
			}

			$num = str_pad($row->DCR_ID, 5, '0', STR_PAD_LEFT);



									?>
									<tr>
										
										<td ># <?= $num; ?></td>																		
										<td >
											
									<span class="title-ticket-tb"><?= getSystemString($row->DCR_Request_Type)?></span>


										</td>
										<td >
								<span class="badge badge-<?=$label?>"><?= getSystemString($row->DCR_Status)?></span>
										</td>

										
										<td ><?= $row->DCR_Created_At ?></td>
										<td ><?= $row->User_Email ?></td>



									</tr>
								<?php } ?>
						    
								</tbody>
							</table>
						</div>
					</div>
             




				<?php if(!empty($transfer_inside_dnet_logs)){ ?>
					<div class="tab-pane fade " id="transfer_inside_dnet_logs">
						<div class="panel white">
						<table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
								<tbody>

									<thead>
										<tr>
											
											<th><?= getsystemstring('request_id') ?></th>
											<th><?= getSystemString('old_owner') ?></th>							
											<th><?= getSystemString('new_owner') ?></th>
											<th><?= getsystemstring(177) ?></th>

									

								
										</tr>
									</thead>

							
								<?php foreach ($transfer_inside_dnet_logs as $row) { ?>
									<tr>
										
										<td ># <?= str_pad($row->Request_ID, 5, '0', STR_PAD_LEFT); ?></td>																		
										<td >
											
											<a href="<?=base_url('acp/customerDetails/'.$row->Old_Owner_ID)?>"><?=$row->old_name?></a>


										</td>
										<td >
												<a href="<?=base_url('acp/customerDetails/'.$row->New_Owner_ID)?>"><?=$row->new_name?></a>
										</td>

										<td ><?= $row->Created_At  ?></td>


									</tr>
								<?php } ?>
						    
  




								</tbody>
							</table>
						</div>
					</div>
               <?php } ?>	




					<div class="tab-pane fade " id="domain_logs">
						<div class="panel white">
						<table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
								<tbody>

									<thead>
										<tr>
											
											<th>TYPE</th>
											<th>MESSAGE</th>							
											<th>Time</th>
									

								
										</tr>
									</thead>

							<?php if(!empty($domain->NIC)){ ?>
								<?php foreach ($domain->NIC as $row) { ?>
									<tr>
										
										<td ><?=$row->type?></td>																		
										<td ><?= $row->msg  ?></td>
										<td ><?= $row->Created  ?></td>

									</tr>
								<?php } 
						           	}else{ ?>

									<tr>
										<td ><?= getSystemString(46)?></td>
							
									</tr>

									<?php } ?>	




								</tbody>
							</table>
						</div>
					</div>



					<div class="tab-pane fade in active" id="payment_info">
						<div class="panel white">
						<table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
								<tbody>

									<thead>
										<tr>
											<th><?=getSystemString(41)?></th>
											<th><?=getSystemString(177)?></th>
								

											<th><?=getSystemString('order')?></th>	
											<th><?=getSystemString('Platform')?></th>
											<th>نوع البطاقه</th>											
								
											<th><?=getSystemString('payment_status')?></th>
											<th><?=getSystemString('Pricing')?></th>
											<th><?=getSystemString(180)?></th>
								
										</tr>
									</thead>

							<?php if(!empty($domain->Orders)){ ?>
								<?php foreach ($domain->Orders as $row) { ?>
									<tr>
										<td ><?='#'.$row->DO_ID?></td>
										<td ><?=$row->Created_AT?></td>										
										<td ><?=getSystemString($row->Order_Type) ?></td> 
										<td ><?=$row->Payment_Gateway?></td>
										<td ><?=$row->Cart_Type?></td>

										<?php 

	
			$payment_label = ($row->Payment_Verified)?'success':'warning';	

		   if($row->Payment_Verified && !$row->Payment_Refunded){
				$payment_status = 102;
			}elseif($row->Payment_Verified && $row->Payment_Refunded){
				$payment_status = 'refunded';
				$payment_label = 'info';				
			}else{
				$payment_status = 'payment_not_verified';								
			}

			$payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';

										 ?>
										<td ><?=$payment?></td>

										<td ><?=$row->Total_Price?></td>
										<td ><?=$row->User_Email?></td>
									


									</tr>
								<?php } 
						           	}elseif(!empty($domain->Transfer_Orders)){  ?>

							<?php foreach ($domain->Transfer_Orders as $row) { ?>
									<tr>
										<td ><?='#'.$row->DTI__ID?></td>
										<td ><?=$row->DTO_Created?></td>										
										<td ><?=  getSystemString('transfer_in') ?></td> 
										<td ><?=$row->Payment_Gateway?></td>
										<td ><?=$row->Cart_Type?></td>

										<?php 

	     $payment_status = ($row->Payment_Verified)?102:'payment_not_verified';
			$payment_label = ($row->Payment_Verified)?'success':'warning';	
			$payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';

										 ?>
										<td ><?=$payment?></td>

										<td ><?=$row->Total_Price?></td>
										<td ><?=$row->Email?></td>
									


									</tr>
								<?php } 

									 }else{ ?>	

									<tr>
										<td ><?= getSystemString(46)?></td>
							
									</tr>

									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="tab-pane fade " id="application_logs">
						<div class="panel white">
						<table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
								<tbody>

									<thead>
										<tr>
											
											<th><?=getSystemString(668)?></th>
											<th><?=getSystemString(33)?></th>							
											<th><?=getSystemString(180)?></th>

								
										</tr>
									</thead>

							<?php if(!empty($app_logs)){ ?>
								<?php foreach ($app_logs as $row) { ?>
									<tr>
										
										<td ><?=$row->DAL_Created?></td>																		
										<td ><?php echo getSystemString($row->DAL_Status);

											if($row->DAL_Status == 'domain_reject'){
												echo ' <b>('.$row->DAL_Reject_Reason.')</b>';
											}
										  ?></td>


		


										<td ><?= $row->user_full_name ?></td>


									</tr>
								<?php } 
						           	}else{ ?>

									<tr>
										<td ><?= getSystemString(46)?></td>
							
									</tr>

									<?php } ?>	




								</tbody>
							</table>
						</div>
					</div>

					<div class="tab-pane fade " id="dns_records">
						<div class="panel white">
						<table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
								<tbody>

									<thead>
										<tr>
											
											<th>Line></th>
											<th>Type</th>
											<th>Name</th>
											<th>Content</th>
											<th>Priority</th>
											<th>ttl</th>
									

								
										</tr>
									</thead>

							<?php if(!empty($dns_records)){ ?>
								<?php foreach ($dns_records as $dns_record) { ?>
									<?php if($dns_record->type != ':RAW' && $dns_record->type != '$TTL'){ ?>
									<tr>
										
										<td ><?=$dns_record->Line?></td>
										<td ><?=$dns_record->type?></td>	
										<td ><?=$dns_record->name?></td>																	
										<td ><?=$dns_record->exchange?><?=$dns_record->mname?><?=$dns_record->nsdname?><?=$dns_record->cname?><?=$dns_record->address?><?=$dns_record->char_str_list[0]?></td>
										<td ><?=$dns_record->preference?></td>
										<td ><?=$dns_record->ttl?></td>

									</tr>
								<?php }}} ?>

								</tbody>
							</table>
						</div>
					</div>


			<?php if(!empty($inside_domain_changes)){ ?>
					<div class="tab-pane fade " id="inside_domain_changes">
						<div class="panel white">
						<table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
								<tbody>

									<thead>
										<tr>
											
											<th>Before </th>
											<th>After</th>
											<th>Type</th>
											<th>Updated By</th>
											<th>Updated At</th>
																											
										</tr>
									</thead>

							
								<?php foreach ($inside_domain_changes as $domain_change_log) { ?>
								
									<tr>
										
										<td ><?php echo '<pre>'; print_r(json_decode($domain_change_log->Old_Data)); ?></td>
										<td ><?php echo '<pre>'; print_r(json_decode($domain_change_log->New_Data)); ?></td>	
										<td ><?= getSystemString($domain_change_log->Type) ?></td>																	
										<td ><?=$domain_change_log->Updated_By?></td>
										<td ><?=$domain_change_log->Updated_At?></td>
									

									</tr>

								<?php } ?>

								</tbody>
							</table>
						</div>
					</div>
			<?php } ?>


				</div>
				
			</div>
						
		</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	var _customer_id = '<?=$customer_id?>';
	var _baseController = '<?=base_url('acp/diets')?>';


	function print_speech(url)
  {


    var w = 900;
    var h = 600;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    window.open(url,"_blank","resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width="+w+",height="+h+",left="+left+",top="+top);
  }


</script>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>

  <script src="<?=base_url('style/site/assets/')?>js/intlTelInputScriptGeneral.js"></script> 

<script src="<?=base_url($GLOBALS['home_js_dir'].'/utilities/utilities.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/moment.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/bootstrap-datetimepicker.js')?>"></script>
<script>
	var _baseController = '<?=base_url($__controller)?>';
	$(function(){
		$(".input-date").datetimepicker({
			format: 'YYYY-MM-DD',
			minDate: '<?= date("Y-m-d") ?>'
		});
	});
</script>

<script type="text/javascript">
	
	$('.change_start_date').on('click',function(e){
		e.preventDefault();
			$('.cancelForm').removeClass('hide');
	});

		$('.cancel_change').on('click',function(e){
		e.preventDefault();

			$('.cancelForm').addClass('hide');
	});









  $('.edit_contact_btn').on('click', function (e) {

  		var role = $(this).data('role');
  		if(role == 'admin'){
  			var title = '<?= getSystemString("admin") ?>';
  		}else if(role == 'financial'){
  			var title = '<?= getSystemString("financial") ?>';  			
  		}else if(role == 'technical'){
  			var title = '<?= getSystemString("technical") ?>';  		
  		}
  		$('.edit_contact_title').html(title);
  		var uid = $(this).data('uid');
       
  		 $('.edit_contact_frm')[0].reset();
  		 $('.contact_role').val('');
  		 $('.contact_id').val('');


  		 $('.contact_role').val(role);

  		    jQuery.ajax({
                type: "GET",
                   dataType: "JSON",
                  enctype: 'multipart/form-data',
                      url: '<?= base_url('acp/domains/contact_info').'?uid='?>'+uid,
                      success: function(data) {

                            if(data.status === true){
                                  $('.Full_Name').val(data.contact_info.Full_Name);
                                  $('.User_City').val(data.contact_info.User_City);
                                  $('.User_Country_ID').val(data.contact_info.User_Country_ID).change();
                                  $('.Employer_Name').val(data.contact_info.Employer_Name);
                                  $('.User_Address1').val(data.contact_info.User_Address1);
                                  $('.User_Post_Code').val(data.contact_info.User_Post_Code);
                                  $('.User_Mobile').val('+'+data.contact_info.Mobile_Key+data.contact_info.User_Mobile);
                                  $('.mobile_key').val(data.contact_info.Mobile_Key);
                                  $('.User_Email').val(data.contact_info.User_Email);
                                  $('.contact_id').val(data.contact_info.Org_Usr_ID);
                                  $('.User_Job_Title').val(data.contact_info.User_Job_Title);
                                  $('.User_Phone').val(data.contact_info.User_Phone);
                                  $('.User_Region').val(data.contact_info.User_Region);

            var input = document.querySelector("#mobile");     
							window.intlTelInput(input, {        
									        placeholderNumberType: 'MOBILE',
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js"     
									});

                            }else{

                            }





                      }
                  });


  		//console.log(uid);
	});


</script>

</body>
</html>



















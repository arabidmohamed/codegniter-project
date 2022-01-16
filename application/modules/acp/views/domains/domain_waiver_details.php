	


	<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">
	
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
	?>
	<div id="content-main">
		
		<div class="row">
			<?PHP
				$this->load->view('acp_includes/response_messages');
			?>
		</div>
		
		<div class="row">
						
			<div class="col-md-12">
				<h3 class="text-primary" onclick="javascript: window.location.reload()" style="cursor: pointer">
					<?=$domain->Domain_Name.$domain->TLD?>
					
				
				</h3>

	

						
						
			<div class="col-md-12">

<?php if(!$domain_waivers[0]->IS_Admin_Approve && !empty($domain_waivers[0]->Admin_Email_Sent) && !empty($domain_waivers[0]->Second_Admin_Email)){ ?>
 	<a href="<?=base_url('acp/epp/approve_domain_waiver/'.$domain_waivers[0]->DW_ID.'/'.$domain->Domain_ID)?>" class="btn btn-primary btn-sm pull-left" style="margin-bottom: 20px;
    margin-right: 10px; color:#FFF">
					    <i class="fa fa-plus"></i> تنازل عن النطاق</a>
<?php } ?>
			</div>
  
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					
					
<div class="col-md-6">

		<div style="padding-top: 10px;color:#3498db">
				<h4><?=getSystemString('domain_information')?></h4>
			</div>

			<?php 
				if(!empty($domain->Chg_Name_Server_history)){
					$his_servers    = json_decode($domain->Chg_Name_Server_history); 
					$domain->Primary_Server = $his_servers->Primary_Server;
					$domain->Secondery_Server = $his_servers->Secondery_Server;
					
					$domain->Server_ips = json_decode($his_servers->Server_ips);
					$domain->Secondary_Servers = json_decode($his_servers->Secondary_Servers);
				} 
			?>

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
										echo $domain->Domain_Status
									?>	
								</td>
							</tr>
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
									<a href="<?=base_url('acp/customerDetails/'.$domain->Registrar->Customer_ID)?>">
										<?=$domain->Registrar->Fullname?>
									</a>
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
								<td>	
									<a href="tel:0<?=$domain->Registrar->Phone?>">0<?=$domain->Registrar->Phone?></a>	
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

 <?php    if(!empty($domain->Docs->speech)){ ?>
 <table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>

						    <tr>
								<th><?=getSystemString('doc_title')?></th>
								<td>
									<?PHP
										echo $domain->Docs->speech->Doc_Title;
									?>	
								</td>
							</tr>

							   <tr>
								<th><?=getSystemString('doc_type')?></th>
								<td>
									<?PHP
										echo $domain->Docs->speech->Doc_Type;
									?>	
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
                                                 

                                                           <p><?= GetConstantById($domain->Docs->support->Doc_Type_ID,$__lang) ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain->Docs->additional->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>


                                                    </div><!-- /.col -->
                                       	<?php }
                                       	 if (!empty($domain->Docs->support)) { ?>
                                       		     <div class="col-md-4 text-center">
                                                   
                                                           <p><?= GetConstantById($domain->Docs->support->Doc_Type_ID,$__lang) ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain->Docs->support->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>


                                                    </div><!-- /.col -->
                                       <?php } ?>
                        

</div>




	<div class="col-md-6">

		<div style="padding-top: 10px;color:#3498db">
				<h4><?=getSystemString('entity_information')?></h4>
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
	
							<tr>
								<th><?=getSystemString(234)?></th>
								<td>
                                   <?= GetCountryById($domain->User_Country_ID,$__lang) ?>                                                                                                        									
								</td>
							</tr>


		
									<tr>
								<th><?=getSystemString('post_code')?></th>
								<td>
									<?PHP
										echo $domain->User_Post_Code
									?>	
								</td>
							</tr>

						
</tbody>
</table>
</div>


	<div class="col-md-6">

		<div style="padding-top: 10px;color:#3498db">
				<h4><?=getSystemString('admin_officer')?></h4>
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


							<tr>
								<th><?=getSystemString('first_address')?></th>
								<td>
									<?PHP
										echo $domain->Admin->User_Address1
									?>	
								</td>
							</tr>

							<tr>
								<th><?=getSystemString(234)?></th>
								<td>
						
									<?= GetCountryById($domain->Admin->User_Country_ID,$__lang) ?> 
								</td>
							</tr>



									<tr>
								<th><?=getSystemString(202)?></th>
								<td>
									<?PHP
										echo $domain->Admin->User_City
									?>	
								</td>
							</tr>


			
								<tr>
								<th><?=getSystemString(206)?></th>
								<td>
									<?PHP
										echo $domain->Admin->Mobile_Key.$domain->Admin->User_Mobile
									?>	
								</td>
							</tr>
				
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
				<h4><?=getSystemString('technical_responsible')?></h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
	<?php if($domain->Admin_ID == $domain->Technical_ID){ ?>
				<tr>
								<th><?=getSystemString('step1_option1')?></th>
								<td>
									<?PHP
										echo $domain->Technical->Full_Name;
									?>	
								</td>
							</tr>
	<?php }else{ ?>
						<tr>
								<th><?=getSystemString(81)?></th>
								<td>
									<?PHP
										echo $domain->Technical->Full_Name;
									?>	
								</td>
							</tr>



							<tr>
								<th><?=getSystemString('first_address')?></th>
								<td>
									<?PHP
										echo $domain->Technical->User_Address1
									?>	
								</td>
							</tr>
	
							<tr>
								<th><?=getSystemString(234)?></th>
								<td>

									<?= GetCountryById($domain->Technical->User_Country_ID,$__lang) ?> 

								</td>
							</tr>



									<tr>
								<th><?=getSystemString(202)?></th>
								<td>
									<?PHP
										echo $domain->Technical->User_City
									?>	
								</td>
							</tr>



								<tr>
								<th><?=getSystemString(206)?></th>
								<td>	
									<a href="tel:<?='+'.$domain->Technical->Mobile_Key.$domain->Technical->User_Mobile?>"><?='+'.$domain->Technical->Mobile_Key.$domain->Technical->User_Mobile?></a>	
								</td>
							</tr>
	
								<tr>
								<th><?=getSystemString(1)?></th>
								<td>
									<a href="mailto:<?=$domain->Technical->User_Email?>"><?=$domain->Technical->User_Email?></a>	
								</td>
							</tr>
	<?php } ?>



						
</tbody>
</table>
</div>

	<div class="col-md-6">

		<div style="padding-top: 10px;color:#3498db">
				<h4><?=getSystemString('financial_officer')?></h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
	<?php if($domain->Admin_ID == $domain->Financial_ID){ ?>
				<tr>
								<th><?=getSystemString('step1_option1')?></th>
								<td>
									<?PHP
										echo $domain->Financial->Full_Name;
									?>	
								</td>
							</tr>
	<?php }else{ ?>
						<tr>
								<th><?=getSystemString(81)?></th>
								<td>
									<?PHP
										echo $domain->Financial->Full_Name;
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

							<tr>
								<th><?=getSystemString(234)?></th>
								<td>

									<?= GetCountryById($domain->Financial->User_Country_ID,$__lang) ?> 

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


								<tr>
								<th><?=getSystemString(206)?></th>
								<td>
									<a href="tel:<?='+'.$domain->Financial->Mobile_Key.$domain->Financial->User_Mobile?>">+<?='+'.$domain->Technical->Mobile_Key.$domain->Financial->User_Mobile?></a>	
								</td>
							</tr>

								<tr>
								<th><?=getSystemString(1)?></th>
								<td>
									<a href="mailto:<?=$domain->Financial->User_Email?>"><?=$domain->Financial->User_Email?></a>
								</td>
							</tr>
	<?php } ?>



						
</tbody>
</table>
</div>

</div>




































				<h3 class="text-primary" onclick="javascript: window.location.reload()" style="cursor: pointer">
					معلومات الجهة المتنازل اليها
					
				</h3>

	



				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					
					
<div class="col-md-6">

		<div style="padding-top: 10px;color:#3498db">
				<h4><?=getSystemString('domain_information')?></h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
		
         <?php  $domain_name_servers = json_decode($domain_waivers[0]->Name_Servers_Data);   ?>
  <?php   $server_ips = json_decode($domain_name_servers->Server_ips);?>


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
										echo $domain->Domain_Status
									?>	
								</td>
							</tr>
								



							<tr>
								<th><?=getSystemString('primary_server')?></th>
								<td>
								 <?= $domain_name_servers->Primary_Server ?>
								</td>
							</tr>

							<?php if(!empty($server_ips[0])){ ?>
							<tr>
								<th>Ip</th>
								<td>
								 <?= $server_ips[0] ?>
								</td>
							</tr>
                             <?php } ?>

							<tr>
								<th><?=getSystemString('secondary_server')?></th>
								<td>

								 <?= $domain_name_servers->Secondery_Server ?>
								</td>
							</tr>
								<?php if(!empty($server_ips[1])){ ?>
							<tr>
								<th>Ip</th>
								<td>
								 <?= $server_ips[1] ?>
								</td>
							</tr>
                             <?php } ?>



                                  <?php 
                                                $secondary_servers = json_decode($domain_name_servers->Secondary_Servers);
                                               
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






								<tr>
								<th>سبب التنازل</th>
								<td>

								 <?= $domain_waivers[0]->Waivers_Reasons ?>
								</td>
							</tr>

		

	</tbody>
</table>



		<div style="color:#3498db">
				<h4><?=getSystemString('registrar_information')?></h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
		                     <?php 
                             $__lang = 'ar';

                 $domain_org = json_decode($domain_waivers[0]->Registrant_Data);


                 ?>

				<tr>
								<th><?= getSystemString(81) ?></th>
								<td>
									<?PHP
										echo $domain_org->Full_Name
									?>	
								</td>
							</tr>

							<tr>
								<th><?=getSystemString(1)?></th>
								<td>
									<?PHP
										echo $domain_org->User_Email
									?>	
								</td>
							</tr>
							<tr>
								<th><?=getSystemString(206)?></th>
								<td>
									<a href="tel:+<?=$domain_org->Mobile_Key.$domain_org->User_Mobile?>">+<?=$domain_org->Mobile_Key.$domain_org->User_Mobile?></a>	

								</td>
							</tr>
							<tr>
								<th><?=getSystemString('relation_between_registrar')?></th>
								<td>
									<?PHP
										echo $domain_waivers[0]->Relation_Between
									?>	
								</td>
							</tr>

		

	</tbody>
</table>





	<div style="color:#3498db">
				<h4><?=getSystemString('documents')?></h4>
			</div>
  <?php    $domain_support = json_decode($domain_waivers[0]->Support_File); ?>

 <table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>

					<?php if(!empty($domain_support->Doc_Title)){ ?>
						    <tr>
								<th><?=getSystemString('doc_title')?></th>
								<td>
									<?PHP
										echo $domain_support->Doc_Title;
									?>	
								</td>
							</tr>
					<?php } ?>


					<?php if($domain_support->Doc_Type_ID == 77){ ?>
                          <tr>
								<th><?=getSystemString('issuer_name')?></th>
								<td>
								<?= GetIssuerById($domain_support->Doc_Issures_ID,$__lang) ?>
								</td>
							</tr>

                    <?php } ?>



							   <tr>
								<th><?=getSystemString('doc_type')?></th>
								<td>
								   <?= GetConstantById($domain_support->Doc_Type_ID,$__lang) ?>
								</td>
							</tr>
							   <tr>
								<th><?=getSystemString('doc_date')?></th>
								<td>
									<?PHP
										echo $domain_support->Doc_Date;
									?>	
								</td>
							</tr>
							   <tr>
								<th><?=getSystemString('doc_number')?></th>
								<td>
									<?PHP
										echo $domain_support->Doc_Num;
									?>	
								</td>
							</tr>
				
</tbody>
</table>

							 		<?php 

							 		  $domain_speech = json_decode($domain_waivers[0]->Speech_File);


							if(!empty($domain_speech)){
							 ?>                                                
                                                    <div class="col-md-4 text-center">
                                                    
                                                  
                                                   <p><?= getSystemString('speech_document') ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain_speech->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>
                   
                                                    </div><!-- /.col -->
                                       <?php }

                                           $domain_additional = json_decode($domain_waivers[0]->Additional_File);


                                       if (!empty($domain_additional->additional)) { ?>
                                       	 <div class="col-md-4 text-center">
                                                 

                                                           <p>   <?= GetConstantById($domain_additional->Doc_Type_ID,$__lang) ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain_additional->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>


                                                    </div><!-- /.col -->
                                       	<?php }

                                          $domain_support = json_decode($domain_waivers[0]->Support_File);


                                       	 if (!empty($domain_support)) { ?>
                                       		     <div class="col-md-4 text-center">
                                                   
                                                           <p> <?= GetConstantById($domain_support->Doc_Type_ID,$__lang) ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain_support->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>


                                                    </div><!-- /.col -->
                                       <?php } ?>


	<div class="col-md-12">


<div style="padding-top: 10px;color:#3498db">
				<h4><?=getSystemString('technical_responsible')?></h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>

		     <?php  $domain_tech = json_decode($domain_waivers[0]->Tech_Data);  if(!empty($domain_tech)){  ?>



						<tr>
								<th><?=getSystemString(81)?></th>
								<td>
									<?PHP
										echo $domain_tech->Full_Name;
									?>	
								</td>
							</tr>

	

							<tr>
								<th><?=getSystemString('first_address')?></th>
								<td>
									<?PHP
										echo $domain_tech->User_Address1
									?>	
								</td>
							</tr>

							<tr>
								<th><?=getSystemString(234)?></th>
								<td>

									<?= GetCountryById($domain_tech->User_Country_ID,$__lang) ?> 

								</td>
							</tr>



									<tr>
								<th><?=getSystemString(202)?></th>
								<td>
									<?PHP
										echo $domain_tech->User_City
									?>	
								</td>
							</tr>



								<tr>
								<th><?=getSystemString(206)?></th>
								<td>
									<?PHP
										echo $domain_tech->Mobile_Key.$domain_tech->User_Mobile
									?>	
								</td>
							</tr>

								<tr>
								<th><?=getSystemString(1)?></th>
								<td>
									<?PHP
										echo $domain_tech->User_Email
									?>	
								</td>
							</tr>
	<?php }else{ ?>

					   <tr>
								<th><?=getSystemString('step1_option1')?></th>
								<td>
								
								</td>
							</tr>


	<?php } ?>

						
</tbody>
</table>
</div>







                        

                        

</div>



<div class="col-md-6">
			<div style="padding-top: 10px;color:#3498db">
				<h4><?=getSystemString('entity_information')?></h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
	
                     <?php 
                             $__lang = 'ar';

                 $domain_org = json_decode($domain_waivers[0]->Registrant_Data);


                 ?>


					<tr>
								<th><?=getSystemString('activity_type')?></th>
								<td>
									 <?= GetConstantById($domain_waivers[0]->Org_Activity_ID,$__lang) ?>	
								</td>
							</tr>

								<tr>
								<th><?=getSystemString('entity_name')?></th>
								<td>
									<?PHP
										echo $domain_org->Full_Name
									?>	
								</td>
							</tr>

							<tr>
								<th><?=getSystemString('first_address')?></th>
								<td>
									<?PHP
										echo $domain_org->User_Address1
									?>	
								</td>
							</tr>
	
							<tr>
								<th><?=getSystemString(234)?></th>
								<td>
                                   <?= GetCountryById($domain_org->User_Country_ID,$__lang) ?>                                                                                                        									
								</td>
							</tr>


									<tr>
								<th><?=getSystemString(202)?></th>
								<td>
									<?PHP
										echo $domain_org->User_City
									?>	
								</td>
							</tr>


						
</tbody>
</table>

 <?php if(!empty($domain_waivers[0]->Admin_Data)){ $domain_admin = json_decode($domain_waivers[0]->Admin_Data); ?>
<div style="padding-top: 10px;color:#3498db">
				<h4><?=getSystemString('admin_officer')?></h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
	

					<tr>
								<th><?=getSystemString(81)?></th>
								<td>
									<?PHP
										echo $domain_admin->Full_Name;
									?>	
								</td>
							</tr>


							<tr>
								<th><?=getSystemString('first_address')?></th>
								<td>
									<?PHP
										echo $domain_admin->User_Address1
									?>	
								</td>
							</tr>
		
							<tr>
								<th><?=getSystemString(234)?></th>
								<td>
						
									<?= GetCountryById($domain_admin->User_Country_ID,$__lang) ?> 
								</td>
							</tr>

									<tr>
								<th><?=getSystemString(202)?></th>
								<td>
									<?PHP
										echo $domain_admin->User_City
									?>	
								</td>
							</tr>

								<tr>
								<th><?=getSystemString(206)?></th>
								<td>
									<?PHP
										echo $domain_admin->Mobile_Key.$domain_admin->User_Mobile
									?>	
								</td>
							</tr>

								<tr>
								<th><?=getSystemString(1)?></th>
								<td>
									<?PHP
										echo $domain_admin->User_Email
									?>	
								</td>
							</tr>

						
</tbody>
</table>
   <?php } ?>


	<div class="col-md-12">

		<div style="padding-top: 10px;color:#3498db">
				<h4><?=getSystemString('financial_officer')?></h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
	    <?php  $domain_billing = json_decode($domain_waivers[0]->Billing_Data);  if(!empty($domain_billing)){  ?>

						<tr>
								<th><?=getSystemString(81)?></th>
								<td>
									<?PHP
										echo $domain_billing->Full_Name;
									?>	
								</td>
							</tr>

								<tr>
								<th><?=getSystemString('job_title')?></th>
								<td>
									<?PHP
										echo $domain_billing->User_Job_Title
									?>	
								</td>
							</tr>

							<tr>
								<th><?=getSystemString('first_address')?></th>
								<td>
									<?PHP
										echo $domain_billing->User_Address1
									?>	
								</td>
							</tr>
							<tr>
								<th><?=getSystemString('second_address')?></th>
								<td>
									<?PHP
										echo $domain_billing->User_Address2
									?>	
								</td>
							</tr>
							<tr>
								<th><?=getSystemString(234)?></th>
								<td>

									<?= GetCountryById($domain_billing->User_Country_ID,$__lang) ?> 

								</td>
							</tr>


									<tr>
								<th><?=getSystemString('region')?></th>
								<td>
									<?PHP
										echo $domain_billing->User_Region
									?>	
								</td>
							</tr>

									<tr>
								<th><?=getSystemString(202)?></th>
								<td>
									<?PHP
										echo $domain_billing->User_City
									?>	
								</td>
							</tr>
									<tr>
								<th><?=getSystemString('post_code')?></th>
								<td>
									<?PHP
										echo $domain_billing->User_Post_Code
									?>	
								</td>
							</tr>

									<tr>
								<th><?=getSystemString(137)?></th>
								<td>
									<?PHP
										echo $domain_billing->User_Phone
									?>	
								</td>
							</tr>
								<tr>
								<th><?=getSystemString(206)?></th>
								<td>
									<?PHP
										echo $domain_billing->Mobile_Key.$domain_billing->User_Mobile
									?>	
								</td>
							</tr>
								<tr>
								<th><?=getSystemString('fax')?></th>
								<td>
									<?PHP
										echo $domain_billing->User_Fax
									?>	
								</td>
							</tr>
								<tr>
								<th><?=getSystemString(1)?></th>
								<td>
									<?PHP
										echo $domain_billing->User_Email
									?>	
								</td>
							</tr>

		<?php }else{ ?>
		
						<tr>
								<th><?=getSystemString('step1_option1')?></th>
								<td>
									<?PHP
										echo $domain_billing->Full_Name;
									?>	
								</td>
							</tr>

	<?php } ?>



						
</tbody>
</table>
</div>









</div>

	</div>


















































											
			
			</div>

			<div class="col-xs-12">
				<ul class="nav nav-tabs">

<li ><a data-toggle="tab" href="#domain_logs"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('domain_logs')?></a></li>

<li class="active"><a data-toggle="tab" href="#payment_info"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('payment_info')?></a></li>

<li ><a data-toggle="tab" href="#application_logs"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('application_logs')?></a></li>

		

				

				   

				
				</ul>
				
				<div class="tab-content" style="padding-top: 0px !important">




					<div class="tab-pane fade " id="domain_logs">
						<div class="panel white">
						<table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
								<tbody>

									<thead>
										<tr>
											
											<th>TYPE</th>
											<th>MESSAGE</th>							
									

								
										</tr>
									</thead>

							<?php if(!empty($domain->NIC)){ ?>
								<?php foreach ($domain->NIC as $row) { ?>
									<tr>
										
										<td ><?=$row->type?></td>																		
										<td ><?= $row->msg  ?></td>

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
										<td ><?=  getSystemString($row->Order_Type) ?></td> 
										<td ><?=$row->Payment_Gateway?></td>
										<td ><?=$row->Cart_Type?></td>

										<?php 

	     $payment_status = ($row->Payment_Verified)?102:'payment_not_verified';
			$payment_label = ($row->Payment_Verified)?'success':'warning';	
			$payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';

										 ?>
										<td ><?=$payment?></td>

										<td ><?=$row->Total_Price?></td>
										<td ><?=$row->User_Email?></td>
									


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
									

								
										</tr>
									</thead>

							<?php if(!empty($domain->Logs)){ ?>
								<?php foreach ($domain->Logs as $row) { ?>
									<tr>
										
										<td ><?=$row->DAL_Created?></td>																		
										<td ><?= getSystemString($row->DAL_Status)  ?></td>

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
</script>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>

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
</script>

<script type="text/javascript">
      function print_speech(url)
  {


    var w = 900;
    var h = 600;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    window.open(url,"_blank","resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width="+w+",height="+h+",left="+left+",top="+top);
  }
</script>

</body>
</html>



















	


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
					<?=$domain->DTI_Domain_Name.$domain->DTI_TLD?>


					<?php if($domain->DTI_Status == 'APPROVED'){  ?>
					 <a href="<?=base_url('acp/domains/domainDetails/'.$domain_id)?>" class="btn btn-primary btn-sm pull-right" style="color:#FFF">
					    تفاصيل النطاق
				    </a>

				<?php  } ?>

				
				</h3>

	

						

  
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
										echo $domain->DTI_Domain_Name.$domain->DTI_TLD
									?>	
								</td>
							</tr>

							<tr>
								<th><?= getSystemString('order_status') ?></th>
								<td>
									<?PHP
										echo $domain->DTI_Status
									?>	
								</td>
							</tr>

							<tr>
								<th> رمز المصادقه</th>
								<td>
									<?PHP
										echo $domain->DTI_Auth_Code
									?>	
								</td>
							</tr>

							<tr>
								<th>ايميل المنقول منه</th>
								<td>
									<?PHP
										echo $domain->DTI_Admin_Email
									?>	
								</td>
							</tr>
				



		

	</tbody>
</table>



		<div style="color:#3498db">
				<h4>صاحب الحساب</h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
		

				<tr>
								<th><?= getSystemString(81) ?></th>
								<td>
									<a href="<?=base_url('acp/customerDetails/'.$domain->Customer_ID)?>">
										<?=$domain->Fullname?>
									</a>	
								</td>
							</tr>

							<tr>
								<th><?=getSystemString(1)?></th>
								<td>
								<?=$domain->Email?>
								</td>
							</tr>
							<tr>
								<th><?=getSystemString(206)?></th>
								<td>
								0<?=$domain->Phone?>	
								</td>
							</tr>
						

		

	</tbody>
</table>

</div>








<div class="col-md-6">

		<div style="color:#3498db">
				<h4>حالة الطلب</h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
		

				<tr>
								<th>تم ارسال الرساله</th>
								<td>
									<?PHP
										echo $domain->Last_SMS_Sent_Date
									?>	
								</td>
							</tr>

			
						

		

	</tbody>
</table>
</div>






											
				</div>
			</div>

				



							<div class="col-xs-12">
				<ul class="nav nav-tabs">



<li class="active"><a data-toggle="tab" href="#payment_info"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('payment_info')?></a></li>



		

				

				   

				
				</ul>
				
				<div class="tab-content" style="padding-top: 0px !important">








					<div class="tab-pane fade in active" id="payment_info">
						<div class="panel white">
						<table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
								<tbody>

									<thead>
										<tr>
											<th><?=getSystemString(41)?></th>
											<th><?=getSystemString(177)?></th>
								

											<th>تاريخ انتهاء النطاق</th>	
																				
								
											<th><?=getSystemString('payment_status')?></th>
											<th><?=getSystemString('Pricing')?></th>
											<th><?=getSystemString(180)?></th>
								
										</tr>
									</thead>

							<?php if(!empty($orders)){ ?>
								<?php foreach ($orders as $row) { ?>
									<tr>
										<td ><?='#'.$row->DTO_ID?></td>
										<td ><?=$row->DTO_Created?></td>										
										<td ><?=  $row->Expire_Date ?></td> 
									

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



















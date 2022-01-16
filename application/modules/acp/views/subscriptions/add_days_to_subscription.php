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
					<h2><?= getSystemString('add_days_to_subscription') ?></h2>	
			<div class="col-md-12">
				<h3 class="text-primary" onclick="javascript: window.location.reload()" style="cursor: pointer">
					<?=$customer[0]->Fullname?>

				</h3>
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					
							
	<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">



	<?php  $plan_name = 'Plan_Name_'.$__lang;
		       $DType =  'DType_'.$__lang;
		 ?>
		<?PHP if(isset($subscriptions)):
				 if (count($subscriptions) > 0): 
				 $i=1;
				 foreach ($subscriptions as $subscription) { ?>
	<tbody>	




			<tr>
				<th><?=getSystemString(437)?></th>
				<td><?=$subscription->Starts_At?> </td>
			</tr>





			<tr>
				<th><?=getSystemString(438)?></th>
				<?PHP
					$exp_class = 'text-success';
					$expirey_date = new DateTime($subscription->Expires_At);
					$today = new DateTime(date('Y-m-d'));
					if($today >= $expirey_date)
					{
						$exp_class = 'text-danger';
					}
				?>
				<td class="<?=$exp_class?>"><?=$subscription->Expires_At?></td>
			</tr>
			<tr>
				<th><?=getSystemString(415)?></th>
				<td>
					<?php if ($subscription->Balance > 0) {?>
					                        <?=$subscription->Balance?> ريال
					                        <?php } else { ?>
					                        مجانا
					                        <?php } ?>
				</td>
			</tr>

			<tr>
				<th><?=getSystemString('days_number')?></th>
				<td><?= ($subscription->days_number >0)?$subscription->days_number.' '.getSystemString('day') :getSystemString('open') ?></td>
			</tr>

			<tr>
				<th><?=getSystemString('meal_number')?></th>
				<td><?= ($subscription->days_number >0)?$subscription->days_number.' '.getSystemString('meal') :getSystemString('open') ?></td>
			</tr>

			<tr>
				<th><?=getSystemString('consultaion_number')?></th>
				<td><?= ($subscription->consultaion_num >0)?$subscription->consultaion_num.' '.getSystemString('consultaion') :getSystemString('consultaion') ?></td>
			</tr>

			<tr>
				<th><?=getSystemString('include_weekend')?></th>
				<td><?= GetConstantById($subscription->include_weekend,$__lang); ?></td>
			</tr>


		<tr>
			<th><?=getSystemString('no_subscription')?></th>
			<td></td>
		</tr>

		
	</tbody>
	<?PHP
		 $i++; }
		endif;
		
		endif; ?>
</table>
			

<form action="<?=base_url($__controller.'/addDaysRoSubscription_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>
			        	<input type="hidden" name="sch_id" value="<?=$subscriptions[0]->SCH_ID?>">
			        	<input type="hidden" name="customer_id" value="<?=$customer[0]->Customer_ID?>">

							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="editor1"><?=getSystemString('number_of_days')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-4 no-padding-left">
									
									<input type="number" 
											class="form-control" 
											name="days_number" 
											 pattern="^[1-9]\d*(\.\d+)?$"
											placeholder="<?=getSystemString('number_of_days')?>" 
											value="1"
											required="" 
											data-parsley-trigger="change" 
											data-parsley-required-message="<?=getSystemString(213)?>">
									
								</div>


							</div>


									<div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_desc_en"><?=getSystemString('Notes')?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-4 no-padding-left">
													<textarea class="form-control" name="notes" rows="4" placeholder="<?=getSystemString('Notes')?>"></textarea>
												</div>
											</div>


							<div class="col-md-2 ">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit"/>
							</div>

	</form>


				</div>
			</div>








						
		</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>



</body>
</html>
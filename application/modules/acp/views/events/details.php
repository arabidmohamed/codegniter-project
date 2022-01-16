<style>
		.panel.white{
			min-height: 150px;
		}
		.nav-social{
			padding: 0px;
			list-style: none;
			width: auto;
			margin: auto;
			height: 30px;
		}
		table th{
			width: 200px;
		}
		.user-rating{
			text-align: center;
			direction: ltr;
			width:135px;
			margin:auto;
		}
		body[dir="rtl"] .user-rating{
			direction: rtl;
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
		body[dir="ltr"] th, body[dir="ltr"] td{
			text-align: left !important;
		}
		body[dir="rtl"] th, body[dir="rtl"] td{
			text-align: right !important;
		}
	</style>
	<?PHP
		$title = 'Title_'.$__lang;
		$subcategory = 'SubCategory_'.$__lang;
		$category = 'Category_'.$__lang;
	?>
	<div id="content-main">
		
		<div class="row">
			<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
		</div>
		
		<div class="row">
						
			<div class="col-md-12">
			<h3 class="text-primary" onclick="javascript: window.location.reload()" style="cursor: pointer"><?=$event->$title?></h3>
			<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
				
				<table class="table table-hover display" id="members_table" width="100%">
					<tbody>
						<tr>
							<th><?=getSystemString(367)?></th>
							<td>
								<div class="user-rating pull-left">
								 	<span class="d-inline-block rating-cnt-clr float-right-left" style="margin: 4px 1px;">(<?=$rating_count?>)</span>
							 		<span class="d-inline-block float-right-left">
								 <?PHP
									$avg = 'fa-star star-grey';	
									for($j = 0; $j < $avgRating; $j++){
										if($rating_count >= 5){
										    $avg = 'fa-star star-colored';
										}
										 echo '<i class="fa '.$avg.'"></i>';
									}
									 
									for($k = 0; $k < (5 - $avgRating); $k++){
										 echo '<i class="fa fa-star star-grey"></i>';
									}
								 ?>
								 	</span>
							 
								</div>
							</td>
						</tr>
						<tr>
							<th><?=getSystemString(49)?></th>
							<td>
								<?PHP
									echo $event->$category.' -> '.$event->$subcategory;
								?>	
							</td>
						</tr>
						<tr>
							<th><?=getSystemString(303)?></th>
							<td class="text-success"><?=$event->Amount_Person.' '.getSystemString(480)?></td>
						</tr>
						<tr>
							<th><?=getSystemString(138)?></th>
							<td><?=$event->From_Date?></td>
						</tr>
						<tr>
							<th><?=getSystemString(139)?></th>
							<td><?=$event->To_Date?></td>
						</tr>
						<!-- <tr>
							<th><?=getSystemString(688).' - '.getSystemString(689)?></th>
							<td><?=$event->From_Age.' - '.$event->To_Age?></td>
						</tr> -->
						<tr>
							<th><?=getSystemString(361)?></th>
							<td><?=$event->TotalBookings?></td>
						</tr>
						<tr>
							<th><?=getSystemString(362)?></th>
							<td><?=$event->TotalViews?></td>
						</tr>
						<!-- <tr>
							<th><?=getSystemString(691)?></th>
							<td><?php
								if($event->Is_Free){
								?>
									<label class="label label-success"><?=getSystemString('is_free')?></label>
								<?PHP
									
								} else {
									
								?>
									<label class="label label-primary"><?=getSystemString('paid_event')?></label>
									<?PHP
								}
							?></td>
						</tr> -->
						<!-- <tr>
							<th><?=getSystemString(363)?></th>
							<td><?=$event->TotalSales.' SAR'?></td>
						</tr> -->
						<tr>
							<th><?=getSystemString(371)?></th>
							<td><?=$event->Address?></td>
						</tr>
						
						<?PHP
							if(count($event->Pictures) > 0){
								?>
								
								<tr>
									<th><?=getSystemString(366)?></th>
									<td>
										<?PHP
											foreach($event->Pictures as $pic){
												$img = base_url($GLOBALS['img_product_dir'].$pic->Pictures);
												?>
												
												<img src="<?=$img?>" style="width: 200px">
												
												<?PHP
											}
										?>
									</td>
								</tr>
								
								<?PHP
							}
						?>
						
					</tbody>
				</table>
										
			</div>
		</div>
						
		</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>
</body>
</html>
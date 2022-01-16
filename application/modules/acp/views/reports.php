<style>
	.panel.white{
		min-height: 230px;
	}
	.bar-chart {
		width	: 100%;
		height	: 500px;
	}
	.amcharts-chart-div a:last-child, .amcharts-chart-div svg+a{
		display: none !important;
	}
	.line-chart{
		width	: 100%;
		height	: 500px;
	}



</style>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<div id="content-main">
	<div class="content">

			<div class="row" style="width: 100%">




				<div class="col-md-12">
					<div class="panel white" style="min-height: 120px">
						<h3><?=getSystemString('Filter Reports')?></h3>
						<form method="GET" action="<?=base_url($__controller.'/reports')?>">
							<div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')" class="form-control " name="fromDate" id="from" placeholder="<?=getSystemString('from_date')?>" value="<?=$fromDate?>" autocomplete="off">
									
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input  type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')" class="form-control " name="toDate" id="to" placeholder="<?=getSystemString('to_date')?>" value="<?=$toDate?>" autocomplete="off">
									
								</div>
							</div>
							<div class="col-xs-12 col-sm-2 col-md-2 float-right-left">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" />
							</div>
						</form>
					</div>
				</div>



				<div class="col-md-12">

					<div class="col-md-3">
						<div class="dash-stat light-shadow lightblue  rounded">
							<span class="dash-stat-icon"><i class="fa fa-usd"></i></span>
							<div class="dash-stat-cont">
								<span class="dash-stat-main" id="totalSales"></span>
								<span class="dash-stat-sub"><?=getSystemString('total_sales')?></span>
							</div>
						</div>
					</div>


					<div class="col-md-3">
						<div class="dash-stat light-shadow purple  rounded">
							<span class="dash-stat-icon"><i class="fa fa-shopping-cart"></i></span>
							<div class="dash-stat-cont">
								<span class="dash-stat-main" id="used_coupons"></span>
								<span class="dash-stat-sub"><?=getSystemString('used_coupons')?></span>
							</div>
						</div>
					</div>


					<div class="col-md-3">
						<div class="dash-stat light-shadow grey  rounded">
							<span class="dash-stat-icon"><i class="fa fa-shopping-cart"></i></span>
							<div class="dash-stat-cont">
								<span class="dash-stat-main" id="used_coupons_value"></span>
								<span class="dash-stat-sub"><?=getSystemString('used_coupons_value')?></span>
							</div>
						</div>
					</div>


						<div class="col-md-3">
						<div class="dash-stat light-shadow teal   rounded">
							<span class="dash-stat-icon"><i class="fa fa-shopping-cart"></i></span>
							<div class="dash-stat-cont">
								<span class="dash-stat-main" id="total_delivery"></span>
								<span class="dash-stat-sub"><?=getSystemString('total_delivery')?></span>
							</div>
						</div>
					</div>




					<div class="col-md-3">
						<div class="dash-stat light-shadow lightblue  rounded">
							<span class="dash-stat-icon"><i class="fa fa-usd"></i></span>
							<div class="dash-stat-cont">
								<span class="dash-stat-main" id="total_Returned"></span>
								<span class="dash-stat-sub"><?=getSystemString('total_Returned')?></span>
							</div>
						</div>
					</div>


					<div class="col-md-3">
						<div class="dash-stat light-shadow purple  rounded">
							<span class="dash-stat-icon"><i class="fa fa-shopping-cart"></i></span>
							<div class="dash-stat-cont">
								<span class="dash-stat-main" id="total_Canceled"></span>
								<span class="dash-stat-sub"><?=getSystemString('total_Canceled')?></span>
							</div>
						</div>
					</div>


					<div class="col-md-3">
						<div class="dash-stat light-shadow grey  rounded">
							<span class="dash-stat-icon"><i class="fa fa-shopping-cart"></i></span>
							<div class="dash-stat-cont">
								<span class="dash-stat-main" id="total_tax"></span>
								<span class="dash-stat-sub"><?=getSystemString('total_tax')?></span>
							</div>
						</div>
					</div>


						<div class="col-md-3">
						<div class="dash-stat light-shadow teal   rounded">
							<span class="dash-stat-icon"><i class="fa fa-shopping-cart"></i></span>
							<div class="dash-stat-cont">
							<span class="dash-stat-main" id="totalIncome"></span>
								<span class="dash-stat-sub"><?=getSystemString(381)?></span>
							</div>
						</div>
					</div>

					


					
				</div>
				

	<?php  $title = 'Title_'.$this->session->userdata($this->acp_session->__lang()); ?>
				<div class="col-xs-12">
					<div class="panel white" style="padding-bottom: 2em">
						<h3><?=getSystemString('subscription_reports')?></h3>
						<br>
						<table class="table table-hover" id="userReports">
							<thead>
								<tr>
									<th><?=getSystemString('420')?></th>									
									<th><?=getSystemString('Quantity')?></th>
									<th><?=getSystemString('Saled_Quantity')?></th>
									<th><?=getSystemString('Avalible_Quantity')?></th> 
								</tr>
							</thead>
							<tbody>
								<?php foreach ($finished_products as $row) { ?>
									    <tr>
									       <td><?= $row->details->$title ?></td>
									       <td><?= $row->Quantity ?></td>
									       <td><?= $row->Saled_Quantity ?></td>
									       <td><?= ($row->Quantity - $row->Saled_Quantity) ?></td>
									   </tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>					
				
				
											
			</div>

	</div>
</div>
		
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>	
																	
<script type="text/javascript">
     var _urlRow1 = '<?=base_url($__controller.'/getDataRow1')?>';

	
	$(function() {

		
		// data filter
		var _filter = {
			fromDate: $("#from").val(),
			toDate: $("#to").val()
		};
		
		// ajax request 1: For 1st Row
		$.post(_urlRow1, _filter, function(r){
			var result = JSON.parse(r);

			console.log(result.total_Returned);
			$("#totalSales").html(result.totalSales);
			$("#used_coupons").html(result.used_coupons);
			$("#used_coupons_value").html(result.used_coupons_value);

			$("#total_delivery").html(result.total_delivery);
			$("#total_Returned").html(result.total_Returned);
			$("#total_Canceled").html(result.total_Canceled);
			$("#total_tax").html(result.total_tax);
			$("#totalIncome").html(result.totalIncome);

			
		});
		
		
	});
</script>
</body>
</html>
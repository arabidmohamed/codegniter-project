<style>
	.panel.white{
		min-height: 230px;
	}
</style>
<div id="content-main">
		<div class="content">




				<div class="row" style="width: 100%">
					<div class="col-md-12">
			 			<a href="	">
							<div class="col-md-3">
								<div class="dash-stat light-shadow white rounded">
										<span class="dash-stat-icon"></span>
										<div class="dash-stat-cont">
											<span class="dash-stat-main">-</span>
											<span class="dash-stat-sub">SMS balance / Total</span>
										</div>
								</div>
							</div>
						</a>

		  				<a href="">
							<div class="col-md-3">
								<div class="dash-stat light-shadow white rounded">
										<span class="dash-stat-icon"></span>
										<div class="dash-stat-cont">
											<span class="dash-stat-main"><?php echo 56000 - (48 * $total['domain_registered'])?></span>
											<span class="dash-stat-sub"><?=getSystemString('nic_balance')?></span>
										</div>
								</div>
							</div>
						</a>

						<a href="<?=base_url('acp/domains/domains')?>">
							<div class="col-md-3">
								<div class="dash-stat light-shadow white rounded">
										<span class="dash-stat-icon"></span>
										<div class="dash-stat-cont">
											<span class="dash-stat-main"><?=$total['domain_registered']?> </span>
											<span class="dash-stat-sub"><?=getSystemString('Domain registered')?></span>
										</div>
								</div>
							</div>
						</a>
							<a href="<?=base_url('acp/members_list')?>">
							<div class="col-md-3">
								<div class="dash-stat light-shadow white rounded">
										<span class="dash-stat-icon"></span>
										<div class="dash-stat-cont">
											<span class="dash-stat-main"><?=$total['customers']?></span>
											<span class="dash-stat-sub"><?=getSystemString(368)?></span>
										</div>
								</div>
							</div>
						</a>


						<a href="#!">
							<div class="col-md-3">
								<div class="dash-stat light-shadow white rounded">
										<span class="dash-stat-icon"></span>
										<div class="dash-stat-cont">
											<span class="dash-stat-main"><?=$total['completed_domain'].' / '.$total['pending_domain']?></span>
											<span class="dash-stat-sub"><?=getSystemString('completed_domain')?> / <?=getSystemString('under_review')?> </span>
										</div>
								</div>
							</div>
						</a>
						
						
						<a href="#!">
							<div class="col-md-3">
								<div class="dash-stat light-shadow white rounded">
										<span class="dash-stat-icon"></span>
										<div class="dash-stat-cont">
											<span class="dash-stat-main"><?=round($income, 2)?></span>
											<span class="dash-stat-sub"><?=getSystemString('381').' - '.getSystemString('480')?> </span>
										</div>
								</div>
							</div>
						</a>
						
						<a href="#!">
							<div class="col-md-3">
								<div class="dash-stat light-shadow white rounded">
										<span class="dash-stat-icon"></span>
										<div class="dash-stat-cont">
											<span class="dash-stat-main"><?=$total['completed_transfer'].' / '.$total['pending_transfer']?></span>
											<span class="dash-stat-sub"><?=getSystemString('Completed_Orders')?> / <?=getSystemString('pending_transfers')?></span>
										</div>
								</div>
							</div>
						</a>

							<a href="#!">
							<div class="col-md-3">
								<div class="dash-stat light-shadow white rounded">
										<span class="dash-stat-icon"></span>
										<div class="dash-stat-cont">
											<span class="dash-stat-main"><?=$total['tickets_closed'].' / '.$total['tickets_opened']?></span>
											<span class="dash-stat-sub"><?=getSystemString('Closed')?> / <?=getSystemString('tickets_opened')?></span>
										</div>
								</div>
							</div>
						</a>

					</div>
				</div>

				<div class="row" >
					<div class="col-md-12" style=" width: 97%; height:400px;">
						<canvas id="myChart" style="background-color: #fff;"></canvas>
					</div>
				</div>


			</div>
		</div>



		
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
var ctx = document.getElementById('myChart').getContext('2d');

var js_days = JSON.parse('<?= $js_days ?>');

var js_customer = JSON.parse('<?= $js_customer ?>');

var js_registration = JSON.parse('<?= $js_registration ?>');

var js_transfer = JSON.parse('<?= $js_transfer ?>');






const labels = js_days;
const data = {
  labels: labels,
  datasets: [
  {
    label: "<?= getsystemstring('Registered_Number') ?>",
    backgroundColor: 'rgb(230, 158, 55)',
    borderColor: 'rgb(230, 158, 55)',
    data: js_customer,
  },
  {
    label: "<?= getsystemstring('register_domain') ?>",
    backgroundColor: 'rgb(33, 134, 245)',
    borderColor: 'rgb(33, 134, 245)',
    data: js_registration,
  },

   {
    label: "<?= getsystemstring('transfer_in') ?>",
    backgroundColor: 'rgb(43, 116, 33)',
    borderColor: 'rgb(43, 116, 33)',
    data: js_transfer,
  },

  ]
};




var myChart = new Chart(ctx, {
    type: 'line',
    data : data,

    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        fill: false,
        plugins: {
	      legend: {
	        position: 'bottom',
	      },
	    title: {
          display: true,
            text: 'Domain Chart',
          },
	  },
     }
});



</script>

</body>
</html>
<?php
/*
 * Added by Yasir on 31 Oct 2019
 *
 */
if ($is_disabled->Status == 0) {
    show_404();
}
?>
	<style>
		.panel.white{
			min-height: 220px;
		}
		table tr th, table td{
			text-align: left !important;
			padding-left: 20px !important;
		}
	</style>
	<div id="content-main">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(733)?><"><?=getSystemString(733)?></li>
            </ol>
        </nav>
			<h3><?=getSystemString(733)?></h3>
			
			<div class="row">
				
<div class="col-md-12">
						<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
						<?php if($Packages!=1 && $Packages!=0){ ?>	
							<table class="table table-hover display" id="sms" width="100%">
								<thead>
									<tr>
										<th>Date</th>
										<th>Expirey Date</th>
										<th>SMS Package</th>
										<th>Total Sent</th>
										<th>SMS Remaining</th>
										<th>Expired SMS</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($Packages as $key => $packages) { ?>	
										<tr>
											<td><?=$packages['StartDate']?></td>
											<td><?=$packages['ExpireDate']?></td>
											<td><?=$packages['SMS_Bundle']?></td>
											<td><?=$packages['Total_Sent']?></td>
											<?php $Remaining = $packages['SMS_Bundle'] - $packages['Total_Sent']  ?>
											<td><?=$Remaining?></td>
											<td><?=$packages['ExpiredSMS']?></td>
										</tr>
									<?php } ?>	
								</tbody>
							</table>
						<?php }elseif($Packages==1){ ?>
							<p><?=getSystemString('SMS_Bundle_Not_Found')?></p>
						<?php  }else{ ?>
							<p><?=getSystemString('Domain_Not_Found')?></p>
						<?php } ?>	
	
						</div>
					</div>
				
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>

</body>
</html>
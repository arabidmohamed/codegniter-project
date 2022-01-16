	
		<ul class="nav nav-tabs">
			<?php if($__lang == 'en') { ?>
			<li class="active"><a data-toggle="tab" href="#domain_logs" aria-expanded="true"><i class="fa fa-server"></i> <?=getSystemString('domains')?></a></li>
			<li class=""><a data-toggle="tab" href="#payment_info" aria-expanded="false"><i class="fa fa-shopping-cart"></i> <?=getSystemString('orders')?></a></li>

			<li><a data-toggle="tab" href="#credits_tab"  aria-expanded="false"><i class="fa fa-money"></i> <?=getSystemString('wallet')?></a></li>

			<?php } else { ?>
			<li class=""><a data-toggle="tab" href="#payment_info" aria-expanded="false"><i class="fa fa-shopping-cart"></i> <?=getSystemString('orders')?></a></li>
			<li class="active"><a data-toggle="tab" href="#domain_logs" aria-expanded="true"><i class="fa fa-server"></i> <?=getSystemString('domains')?></a></li>
			<li><a data-toggle="tab" href="#credits_tab"  aria-expanded="false"><i class="fa fa-money"></i> <?=getSystemString('wallet')?></a></li>


		
			<?php } ?>
		</ul>
				
		<div class="tab-content" style="padding-top: 0px !important">




					<div class="tab-pane fade  active in" id="domain_logs">
						<div class="panel white">
						<table class="table table-hover" id="domains_table">
							<thead>
								<tr>
									<th>
										ID
									</th>
									<th>
										<?=getSystemString(177)?>
									</th>
									<th>
										<?=getSystemString('domain_name')?>
									</th>
								
									<th>
										<?=getSystemString('domain_status')?>
									</th>
									
									<th>
										<?=getSystemString('Action')?>
									</th>
									
									
								</tr>
							</thead>
                	</table>
						</div>
					</div>

					
					<div class="tab-pane fade " id="payment_info">
						<div class="panel white">
							
							<table class="table table-hover" id="domains_orders_table">
								<thead>
									<tr>
										<th>
											<?=getSystemString(348)?>
										</th>
										<th>
											<?=getSystemString(356)?>
										</th>
										<th>
											<?=getSystemString('domain_name')?>
										</th>
									<!-- 	<th>
											<?=getSystemString('entity_name')?>
										</th> -->

										<th>
										<?=getSystemString('order_type')?>
										</th>

							<!-- 			<th>
											<?=getSystemString('domain_status')?>
										</th> -->
									    <th>
											<?=getSystemString(353)?>
										</th> 
										<th>
											<?=getSystemString('payment_status')?>
										</th>
										<th>
											<?=getSystemString(355)?>
										</th>
										<th>
											<?=getSystemString('Action')?>
										</th>
									
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>



				<div class="tab-pane fade " id="credits_tab">
						<div class="panel white">
						<?PHP                            
							$this->load->view('customers/credits/credits_history',$transactions);
						?>
					</div>
				</div>


				</div>
				
	
				



		

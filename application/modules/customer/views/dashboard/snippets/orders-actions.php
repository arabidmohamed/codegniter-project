							        	<div class="dropdown-btn-container">	
												   <ul class="theme-dropdown">

						     
  					


									<?php

									$domain_id = empty($domain->Domain_ID) ? 0 : $domain->Domain_ID;

									if (
										($domain->DCR_Status == 'pending' || $domain->DCR_Status == 'incomplete' || $domain->DCR_Status == 'waiting_payments' || $domain->DCR_Status == 'admin_waiting_approve')  && 
										($domain->Need_Payment && !$payed_order->Payment_Verified)

										||

										(($domain->DCR_Status == 'pending' || $domain->DCR_Status == 'incomplete' || $domain->DCR_Status == 'waiting_payments' || $domain->DCR_Status == 'admin_waiting_approve')  && 
										(!$domain->Need_Payment ))
									)

									{ 

									?>
  									<li><a href="<?=base_url('order_details/'.encryptIt($domain_id).'/'.encryptIt($domain->DCR_ID))?>"><?= getSystemString(164) ?><i class="fa fa-chevron-down"></i></a>
  									<ul>
  										
												    <li ><a  href="<?=base_url('order_details/'.encryptIt($domain_id).'/'.encryptIt($domain->DCR_ID))?>"><img src="<?=base_url('style/site/assets/')?>images/eye.svg" alt=""><?= getSystemString(164) ?></a></li>
												 
												     <li><a onclick="return confirm(__ConfirmCancelMessage)" href="<?=base_url('cancel_request_customer/'.encryptIt($domain_id).'/'.encryptIt($domain->DCR_ID))?>"><img src="<?=base_url('style/site/assets/')?>images/delete.svg" alt=""> <?= getSystemString('cancel') ?></a></li> 
												  												
									</ul>
									 </li>
								<?php }else{ ?>
									<li><a href="<?=base_url('order_details/'.encryptIt($domain_id).'/'.encryptIt($domain->DCR_ID))?>"><img src="<?=base_url('style/site/assets/')?>images/eye.svg" alt=""> <?= getSystemString(164) ?> </a>
								<?php } ?>
  									



												</ul>
								        	</div><!-- /.dropdown-btn -->
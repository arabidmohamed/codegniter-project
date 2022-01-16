    


         <?php if($cart_type == 'WALLET'){ ?>
                   <div class="row mb-5">
                      <div class="col-lg-4 col-sm-6">
                        <h5 class="wallte-title">رصيد المحفظة</h5>

                     
                        <div class="wallte-box-balance">
                          <h2><?= $current_balance.' '.getSystemString(480) ?></h2>
                        </div> 
       
                      </div>

                    </div>
                   

                     <?php  if(!$can_add_transaction){ ?>  
                      <div class="row ">                                      
                                <h2><?= getSystemString('insufficient_balance_wallet') ?></h2>                                        
                          </div>
                     <?php }else{ ?>

                          <a class="wpwl-button wpwl-button-pay" href="<?=base_url("renew_payment_success").'?id='.$checkout_id?>" ><?= getSystemString('pay_now') ?></a>

          <?php }
        }else{ ?>



     <div class="panel panel-default">
					<div class="panel-body">
							<br>
							<div class="row">


           <?php if($cart_type == 'MADA'){ ?>
                <form action="<?=base_url("renew_payment_success")?>" class="paymentWidgets" data-brands="MADA"></form>
              <?php }elseif($cart_type == 'MASTER'){ ?>
                <form action="<?=base_url("renew_payment_success")?>" class="paymentWidgets" data-brands="MASTER"></form>
              <?php }elseif($cart_type == 'AMEX'){ ?>
                <form action="<?=base_url("renew_payment_success")?>" class="paymentWidgets" data-brands="AMEX"></form>
              <?php }else{ ?>
              	<form action="<?=base_url("renew_payment_success")?>" class="paymentWidgets" data-brands="VISA"></form>
              <?php } ?>


			
							</div>


					</div>
				</div>
<?php if(ENVIRONMENT == 'development') { ?>    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?=$checkout_id?>"></script> <?php } else { ?> <script src="https://oppwa.com/v1/paymentWidgets.js?checkoutId=<?=$checkout_id?>"></script> <?php } ?></script>

<?php } ?>
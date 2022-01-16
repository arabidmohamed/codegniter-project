     <div class="panel panel-default">
					<div class="panel-body">
							<br>
							<div class="row">


           <?php if($cart_type == 'MADA'){ ?>
                <form action="<?=base_url("repay_success")?>" class="paymentWidgets" data-brands="MADA"></form>
              <?php }elseif($cart_type == 'MASTER'){ ?>
                <form action="<?=base_url("repay_success")?>" class="paymentWidgets" data-brands="MASTER"></form>
              <?php }elseif($cart_type == 'AMEX'){ ?>
                <form action="<?=base_url("repay_success")?>" class="paymentWidgets" data-brands="AMEX"></form>
              <?php }else{ ?>
              	<form action="<?=base_url("repay_success")?>" class="paymentWidgets" data-brands="VISA"></form>
              <?php } ?>


			
							</div>


					</div>
				</div>
<?php if(ENVIRONMENT == 'development') { ?>    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?=$checkout_id?>"></script> <?php } else { ?> <script src="https://oppwa.com/v1/paymentWidgets.js?checkoutId=<?=$checkout_id?>"></script> <?php } ?></script>
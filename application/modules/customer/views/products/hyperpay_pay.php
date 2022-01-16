<style>
    .wpwl-button-pay{
        visibility:hidden;
    }
</style>

<script>
    var wpwlOptions = {
        locale: "en"
    }
</script>
<style>
    .wpwl-wrapper{
        direction:ltr;
    }
</style>

<?php if($payment_type == 'WALLET'){ ?>
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

                        <button class="wpwl-button wpwl-button-pay" onclick="location.href='<?=$action.'?id='.$checkout_id?>'" type="button"></button>


          <?php }
        }else{ ?>
            <?php if (ENVIRONMENT == 'development') { ?>    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?= $checkout_id ?>"></script> <?php } else { ?> <script src="https://oppwa.com/v1/paymentWidgets.js?checkoutId=<?= $checkout_id ?>"></script> <?php } ?></script>  
            <form action="<?= $action ?>" class="paymentWidgets" style="direction: ltr !important;"  data-brands="<?= $payment_type ?>"></form>
        <?php } ?>
<script>

    if (document.documentElement.lang.toLowerCase() === "ar") {
        var wpwlOptions = {
            locale: "ar",
            style: "plain",
            paymentTarget: '_top',

        }
    }


    if (document.documentElement.lang.toLowerCase() === "en") {
        var wpwlOptions = {
            locale: "en",
            style: "plain",
            paymentTarget: '_top',

        }
    }

</script>
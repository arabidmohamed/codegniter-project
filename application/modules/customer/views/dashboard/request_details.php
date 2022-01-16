<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('site/includes/header_menu');
	 $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;   ?>

<style>
  header{
    z-index: -1;
  }
  .intro{
    margin: auto;
  }
</style>

<!-- Header -->
  <header class="header header-sub">
    <div class="intro">
      <div class="container pb-5 ">
        <h1 class="text-center pb-2">
        <?= $this->session->userdata($this->site_session->username())  ?> </h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?>
 </p>
      </div>
    </div>
  </header>
  <!-- End Header -->

	<div class="container dashboard">
		<div class="form-container p-lg-5 p-3">
            
			  <?=   $this->load->view('domain_registration/profile_navigation'); ?>
			    <hr class="d-md-none">
			    <div class="mt-5 pb-5">

		<?PHP
			if(strlen($this->session->flashdata('requestMsgSucc')) > 0){
		?>
          <div class="alert alert-success ajax" role="alert">
            <p class="content contents">
              <?= getSystemString($this->session->flashdata('requestMsgSucc')) ?>
            </p>
          </div>
          <?PHP
	          }
          ?>


          <?PHP
			if(strlen($this->session->flashdata('requestMsgErr')) > 0):
		?>
          <div class="alert alert-danger ajax" role="alert">
            <p class="content contents">
              <?= getSystemString($this->session->flashdata('requestMsgErr')) ?>
            </p>
          </div>
          <?PHP
	        endif;
          ?>

			        <div id="orders">
                        <div class="row no-gutters align-items-center">
                            <div class="col-md-4">
                                <h3 class="color-primary py-4 14em">
								<?= getSystemString(351) ?>
                                </h3>
                            </div><!-- /.col-6 -->
                            <div class="col-md-8 text-right">
                               <!--  <a href="#" class="btn btn-primary-inverse">إكمال</a> --><!-- /.btn btn-outline-primary -->
                             <!--    <a href="<?=base_url('cu/support/new_ticket')?>" class="btn btn-primary-inverse"><?= getSystemString('add_new_ticket') ?></a> -->
                                <!-- /.btn btn-outline-primary -->


       <?php

if (
	($request_details->DCR_Status == 'pending' || $request_details->DCR_Status == 'incomplete' || $request_details->DCR_Status == 'need_modification')  && 
	($request_details->Need_Payment && !$order_details->Payment_Verified)

	  ||

	(($request_details->DCR_Status == 'pending' || $request_details->DCR_Status == 'incomplete' || $request_details->DCR_Status == 'need_modification')  && 
	(!$request_details->Need_Payment ))
)

{ 

         	?>


       <?php if($request_details->Need_Payment && !$order_details->Payment_Verified && $request_details->DCR_Request_Type =='create_domain' && $request_details->DCR_Admin_Approve){ ?>
       	<a  href="<?=base_url('process_payment/') . '?do=' . encryptIt($domain_id) . '&to=' . $domain_details->Verify_Page_Token; ?>" class="btn btn-primary-inverse"><?= getSystemString('pay_now') ?></a>
       <?php } ?>

         <?php if($request_details->Need_Payment && !$order_details->Payment_Verified && $request_details->DCR_Request_Type =='domain_transfer_in' && $request_details->DCR_Admin_Approve){ ?>
       	<a  href="<?=base_url('transfer_approved/'). '?id=' . encryptIt($transfer_details->DTI__ID) . '&c_id=' . $transfer_details->DTI_Customer_ID. '&code=' . $transfer_details->DCR_Verify_Page_Token; ?>" class="btn btn-primary-inverse"><?= getSystemString('pay_now') ?></a>
       <?php } ?>


		<?php if($request_details->DCR_Status != 'approved'){  ?>
            			<a onclick="return confirm(__ConfirmCancelMessage)" href="<?=base_url('cancel_request_customer/'.encryptIt($request_details->DCR_Domain_ID).'/'.encryptIt($request_details->DCR_ID))?>" class="btn btn-primary-inverse"><?= getSystemString('cancel') ?></a>
           <?php } ?>





            <?php } ?>



            

		<?php if(($request_details->DCR_Request_Type !='renew' && $request_details->DCR_Status != 'incomplete' && $request_details->DCR_Status != 'canceled' && $request_details->DCR_Status != 'refused' && $request_details->DCR_Status != 'need_modification' && !$request_details->DCR_Admin_Approve ) || ($request_details->DCR_Status == 'incomplete' && $request_details->DCR_Request_Type == 'domain_transfer_in')){ ?>
            			 <a href="<?=base_url('resend_request_email/'.encryptIt($request_details->DCR_Domain_ID).'/'.encryptIt($request_details->DCR_ID))?>" class="btn btn-primary-inverse"><?= getSystemString('resend_request_email') ?></a>
<?php  } ?>













     <?php if($request_details->DCR_Request_Type =='create_domain' && !$request_details->DCR_Admin_Approve &&
        ($request_details->DCR_Status == 'incomplete' || $request_details->DCR_Status == 'need_modification') 
 ){ ?>

            		<a href="<?=base_url('edit_register_domain/'.encryptIt($request_details->DCR_Domain_ID))?>" class="btn btn-primary-inverse"><?= getSystemString('complete_btn') ?></a><!-- /.btn btn-outline-primary -->


     <?php } ?>


      

        <?php if($request_details->DCR_Request_Type !='renew' && $domain_details->Domain_Status == 'Done' && !empty($order_details) && $order_details->Payment_Verified == 0){
            			if($request_details->DCR_Request_Type =='domain_transfer_in'){
            	?>
            
         <a href="<?=base_url('repay_order/').'?or_id='.$order_details->DTO_ID.'&req_id='.encryptIt($request_details->DCR_ID); ?>" class="btn btn-primary-inverse">اكمال  الدفع</a>
            

                     <?php }else{ ?>

	     <a href="<?=base_url('repay_order/').'?or_id='.$order_details->DO_ID.'&req_id='.encryptIt($request_details->DCR_ID); ?>" class="btn btn-primary-inverse">اكمال  الدفع</a>

                     <?php } ?>

        <?php } ?>




                            </div><!-- /.col-6 -->
                        </div><!-- /.row no-gutters -->
		        		<div class="domains mt-5">
							<div class="row no-gutters details align-items-center">

		<?PHP 
			if( 
				
			
				 $request_details->DCR_Status != 'incomplete' && $request_details->DCR_Status != 'canceled' && $request_details->DCR_Status != 'need_modification' && $request_details->DCR_Status != 'refused' && $request_details->DCR_Status != 'deleted'  && !$request_details->DCR_Admin_Approve

				){				
		?>
          <div class="col-7 alert alert-warning ajax" role="alert" style="padding-right: 5px;">
          
              <?= getSystemString('waiting_approve_msg') ?>
          
          </div>
          <div class="col-5"></div>
          <?PHP
	          }
          ?>

						


								<div class="col-lg-2">
									<span class="text-status no-mt text-secondary bold" style="width: auto"><?= getSystemString(348) ?></span>
								</div><!-- /.col-lg-4 -->


								<div class="col-lg-5">
						<?php  $num = str_pad($request_details->DCR_ID, 5, '0', STR_PAD_LEFT); ?>
					
									<span class="text-primary bold">#<?= $num ?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-4"></div>
								<div class="col-12 pb-4"></div>

								<div class="col-lg-2">
									<span class="text-status no-mt text-secondary bold" style="width: auto"><?= getSystemString('domain') ?></span>
								</div><!-- /.col-lg-4 -->

			<?php 
					/* pending and transfer in that mean domain_id = 0 => not saved yet */

				
						if($request_details->DCR_Domain_ID == 0){
							$post_data = json_decode($request_details->DCR_POST_DATA);
							$domain_ns = $post_data->DTI_Domain_Name.$post_data->DTI_TLD;
						}else{
							$domain_ns = $domain_details->Domain_Name.$domain_details->TLD;
						}
			  ?>
								<div class="col-lg-5">
									<span class="text-primary bold"><?= $domain_ns ?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-4"></div>
								<div class="col-12 pb-4"></div>


								<div class="col-lg-2">
									<span class="text-status no-mt text-secondary bold" style="width: auto"><?= getSystemString('Action') ?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-5">
									<span class="text-primary bold"><?= getSystemString($request_details->DCR_Request_Type) ?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-4"></div>
								<div class="col-12 pb-4"></div>


								<div class="col-lg-2">
									<span class="text-status no-mt text-secondary bold" style="width: auto"><?= getSystemString(33) ?></span>
								</div><!-- /.col-lg-4 -->

				<?php 

							     $status = array(
												'pending'    => 'primary',
												'approved' => 'success',
												'refused'   => 'danger',
												'deleted'   => 'danger',
												'canceled'   => 'danger',
												'incomplete'   => 'primary',
												'need_modification' => 'danger',


											);


			$domain_status = $request_details->DCR_Status;
			$label = $status["$domain_status"];

				if($request_details->Need_Payment && !$order_details->Payment_Verified && $request_details->DCR_Status != 'canceled' && $request_details->DCR_Status != 'refused' && $request_details->DCR_Status != 'deleted' && $request_details->DCR_Admin_Approve)
							{$request_details->DCR_Status = 'waiting_payments'; $label = 'warning';}

				if($request_details->DCR_Status != 'incomplete' && $request_details->DCR_Status != 'canceled'  && $request_details->DCR_Status != 'need_modification'  && $request_details->DCR_Status != 'refused' && $request_details->DCR_Status != 'deleted' && !$request_details->DCR_Admin_Approve){
					$request_details->DCR_Status = 'admin_waiting_approve';
					$label = 'warning';
				}

				?>
								<div class="col-lg-5">
									<span class="badge badge-<?= $label ?> bold">
										<?= getSystemString($request_details->DCR_Status) ?>
									</span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-4"></div>
								<div class="col-12 pb-4"></div>

			<?php if($domain_details->Domain_Status == 'REJECTED' || $request_details->DCR_Status == 'need_modification' ){ ?>
								<div class="col-lg-2">
									<span class="text-status no-mt text-secondary bold" style="width: auto"><?= getSystemString('rejection_reseaon') ?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-5">

										<span class="text-primary bold"><?= $reject_reasons ?></span>

								</div><!-- /.col-lg-4 -->
								<div class="col-lg-4"></div>
								<div class="col-12 pb-4"></div>
							<?php } ?>


							</div>
		        		</div><!-- /.domains -->
		        		<div class="my-5"></div><!-- /.mt-3 -->

			        </div>
			    </div>
			</div><!-- /.container -->
		</div>
	</div><!-- /.form-container -->

    <div class="mt-5"></div><!-- /.mt-5 -->


        <div class="mt-5"></div><!-- /.mt-5 -->
  <?=   $this->load->view('site/includes/support', $website_config); ?>
    <?PHP
    $this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>

<script type="text/javascript">
	$(function(){
		$("#my_orders").addClass('active');
	});
</script>

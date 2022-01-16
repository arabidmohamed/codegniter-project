


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
        ID: #<?= $this->session->userdata($this->site_session->random_id())  ?> </p>
      </div>
    </div>
  </header>
  <!-- End Header -->




  <div class="container dashboard">
		<div class="form-container p-lg-5 p-3">
			<?=$this->load->view('domain_registration/profile_navigation'); ?>
            <div class="col-md-10 mx-auto">  
			
			
				<div class="p-lg-5 p-3">  
					
					<div class="row justify-content-center mb-5">
						<div class=" col-sm-6 text-center">
							<h4 class="wallte-title"><?= getSystemString('wallet_balance') ?></h4>
							<div class="dashboard-card wallte-box">
								<h2><?= $current_balance ?> <small class="ml-3"><?= getSystemString(480) ?></small></h2>
							</div> 
						</div> 
					</div>  
					

					<?php if(!empty($transactions)){ ?> 
					<div class="row justify-content-center mb-5">
						<div class="col-lg-12">
							<h4 class="wallet-table-title mb-5"><?= getSystemString('wallet_transactions') ?></h4>
						</div>
						<div class="col-lg-12">
							<div class="domains">
								<table class="table table-wallte">
									<thead>
										<tr>
											<th scope="col"><?= getSystemString('operation_num') ?></th>
											<th scope="col"><?= getSystemString('operation_date') ?></th>
											<th scope="col"><?= getSystemString('operation_type') ?></th> 
											<th scope="col"><?= getSystemString('domain_price') ?>(<?= getSystemString(480) ?>)</th> 
									
										</tr>
									</thead>
									<tbody>

										<?php foreach ($transactions as $key => $row) {
												$label = ($row->Type == '+')?'success':'danger';
										 ?>
												<tr>
													<td><?= str_pad($row->CH_ID, 5, '0', STR_PAD_LEFT)  ?></td>
													<td><?= $row->Created_at ?></td>

								<?php $type = ($row->Type == '-')?getSystemString('credit'):getSystemString('debit') ?>
													<td><?= $type ?></td>
													<td><span class="text-<?= $label ?>">(<?= $row->Credits ?>)</span></td>
											
												</tr>
										<?php } ?>
									  
  
									</tbody>
								</table>
							</div> 
						</div> 
					</div>  
				<?php } ?>
					
					
				</div>
				
				
				
				
				
				
            </div>
        </div><!-- /.container -->
    </div><!-- /.form-container -->


    <div class="mt-5"></div><!-- /.mt-5 -->
 <?=   $this->load->view('site/includes/support', $website_config); ?>

    <?PHP
    $this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>


<script type="text/javascript">
	$(function(){
		$("#my_purchases").addClass('active');
	});
</script>

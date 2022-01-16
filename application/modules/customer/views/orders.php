
<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$data['website_language'] = $__lang;
	$data['product_categories'] = $website_config['product_categories'];
	$this->load->view('site/includes/header_menu', $data);
 $this->load->view('site/includes/custom_styles_header');
	$product = 'Title_'.$__lang;

?>

<?php  $plan_name = 'Plan_Name_'.$__lang;
       $DType =  'DType_'.$__lang;
 ?>


<section class="bg-light">
			<div class="container">
				<div class="row">
					    <?PHP
								$this->load->view('includes/left_side_menu',$customer);
							?>



					<div class="col-lg-9">


<?php if(empty($orders)){ ?>

							<div class="card p-5 text-center mb-5">
							<div class="card-body">
								<img src="<?= base_url('style/site/assets/img/purchase-empty.png');?>" class="img-fluid" alt="purchase-empty">
								<h5 class="py-4"><?= getSystemString('no_order_msg') ?></h5>
								<a href="<?= base_url('categories') ?>" class="btn btn-primary px-5"> <?= getSystemString('Start shopping now') ?> </a>
							</div>
						</div>
<?php }else{ ?>


			<div class="card p-3">
							<div class="card-header">
								<h4 class="title"> <?= getSystemString('My orders') ?> </h4>
							</div>
							<div class="card-body">
								<div class="product-table table-responsive mb-0">
									<table class="table table-sm table-profile">
										<thead class="bg-dark">
											<tr>
											<th ><?= getSystemString(348) ?></th>
											<th ><?= getSystemString(355) ?></th>
											<th ><?= getSystemString('order_date') ?></th>
											<th ><?= getSystemString(33) ?></th>
											<th ><?= getSystemString('bill') ?></th>
											</tr>
										</thead>
										<tbody>


						<?PHP

										$i = 0;
										foreach($orders as $order){
											$status = array(
												'Pending'    => 'warning',
												'Delivered'  => 'success',
												'In Process' => 'primary',
												'Returned'   => 'danger',
												'Completed'   => 'success',
											);
											$order_status = $order->Order_Status;
											$label = $status["$order_status"];
						?>

										<tr>
														<td>#<?= $order->Order_ID ?></td>
														<td><?= $order->OrderTotal_Price.' '.getSystemString(480) ?></td>
														<td>	<?PHP
																$dt = new DateTime($order->Created_At);
															?>
															<?= $dt->format('d/m/Y')?></td>
														<td><?= getSystemString($order_status) ?></td>
														<td>
															<a  onclick="javascript:print_invoice('<?php echo  $order->Order_ID; ?>')" href="#!" >
																<img src="<?= base_url('style/site/assets/img/attachment.svg');?>" alt="">
															</a>
														</td>
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
			 </div>

</section>



		<script type="text/javascript">


  function print_invoice(_orderno)
  {
    url = '<?php echo base_url() ?>pdf/'+_orderno;

    var w = 900;
    var h = 600;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    window.open(url,"_blank","resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width="+w+",height="+h+",left="+left+",top="+top);
  }


</script>












<?PHP
	$this->load->view('site/includes/footer', $website_config);
	$this->load->view('site/includes/custom_scripts_footer');
?>
<script>
	$(function(){

  $(".profile-sidebar #orders_history").addClass('active');

	});
</script>
</body>
</html>

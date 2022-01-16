	<style>
		.panel.white{
			min-height: 150px;
		}
		table th{
			width: 250px;
		}
		.user-rating{
			text-align: center;
			direction: ltr;
			width:135px;
			margin:auto;
		}
		.user-rating .fa{
			font-size: 22px;
			margin: 1px;
		}
		.star-grey{
			color: #e8e8e8;
		}
		.star-colored{
			color:#ffcc00;
		}
		body[dir="rtl"] .user-rating{
			direction: rtl;
		}
		body[dir="ltr"] #customer_table th, body[dir="ltr"] #customer_table td{
			text-align: left;
		}
		body[dir="rtl"] #customer_table th, body[dir="rtl"] #customer_table td{
			text-align: right;
		}
		#diets_table td:not(.dataTables_empty):first-child{
			display: none;
		}
		#diets_table th:last-child{
			width: 200px; 
		}
		.dataTables_wrapper{
		    max-width: 100% !important;
		}
		#diets_table td:nth-child(7){
			display: none;
		}
	</style>
	<div id="content-main">
		
		<div class="row">
			<?PHP
				$this->load->view('acp_includes/response_messages');
			?>
		</div>
		
		<div class="row">
						
			<div class="col-md-12">
				<h3 class="text-primary">
					<?=$customer[0]->Fullname?>
				</h3>
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					
					<?PHP
						$this->load->view('customers/snippets/customer_details');
					?>
											
				</div>
				
				<h3>
					<?=getSystemString('Subscribe Customer')?>
				</h3>
				
				<form action="<?=base_url($__controller.'/subscribeCustomers_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>
					<input type="hidden" name="customerId" value="<?=$customer_id?>" required>
					<div class="panel white" style="min-height: 50px">
			          	<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title"><?=getSystemString(413)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-4 no-padding-left">
								<select id="selector" class="form-control" name="planId" required data-parsley-required-message="<?=getSystemString(213)?>">
									<option value=""><?=getSystemString('-- Select Plan --')?></option>
									<?PHP $plan_name= 'Plan_Name_'.$this->session->userdata($this->acp_session->__lang());
										foreach($plans as $plan):
									?>
										<option value="<?=$plan->Plan_ID?>" data-price="<?=$plan->Plan_Price?>"><?=$plan->$plan_name?></option>
									<?PHP
										endforeach;
									?>
								</select>
							</div>
						</div>
						<!-- Note: added by A (17 July 2019) -->

						  <div class="form-group row price">
						    <label for="inputPassword" class="col-sm-2 col-form-label"> سعر الباقة</label>
						    <div class="col-sm-4">
						      <input type="text" class="form-control" name="planPrice" id="price" readonly disabled value="200">
						    </div>
						  </div>
						  <div class="form-group row">
						    <label for="inputPassword" class="col-sm-2 col-form-label">المبلغ المدفوع</label>
						    <div class="col-sm-4">
						      <input type="text" class="form-control" id="paid" name="paid" placeholder="eg.150" required data-parsley-required-message="<?=getSystemString(213)?>">
						    </div>
						  </div>
						  <div class="form-group row">
						    <label for="inputPassword" class="col-sm-2 col-form-label"> ارفاق إيصال دفع</label>
						    <div class="col-sm-4">
						      <input type="file" class="form-control" name="attach" id="reference" required data-parsley-required-message="<?=getSystemString(213)?>">
						    </div>
						  </div>
						<!-- Ends -->
		          	</div>
		         
				  	<div class="form-group">
						<div class="col-xs-12 text-right">
							<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" />
						</div>
					</div>
					
		        </form>
				
			</div>
						
		</div>
</div>

<!-- Note: added by A (17 July 2019) -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
	$(function() {
	  $('#selector').change(function(){
		var price = $("#selector option:selected").attr("data-price");
		$("input#price").val(price);
		$('.price').show();
	  });
	});
	$('.price').hide();
</script>
<!-- Ends -->	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>
</body>
</html>
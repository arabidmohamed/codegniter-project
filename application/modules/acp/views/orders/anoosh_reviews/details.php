	<style>
		.panel.white{
			min-height: 150px;
		}
		.fs-2{
			font-size: 16px;
		}
		table th{
			width: 200px;
		}
		td.text-right{
			text-align: right !important;
		}
		body[dir="rtl"] td.text-right{
			text-align: left !important;
		}
		body[dir="ltr"] th, body[dir="ltr"] td{
			text-align: left !important;
		}
		body[dir="rtl"] th, body[dir="rtl"] td{
			text-align: right !important;
		}
		.radio{
			padding: 0px 4px;
		}
		.star-grey{
			color: #cccccc;
		}
		.star-colored{
			color: #f8d214;
		}
		.stars{
			font-size: 18px;
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
				<h3><?=getSystemString('Review Details')?></h3>
				
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					
					<table class="table table-hover display" id="order_table" width="100%">
						<tbody>
							<tr>
								<th></th>
								<td>
									<img src="<?=$review->Image?>">
								</td>
							</tr>
							<tr>
								<th><?=getSystemString(1)?></th>
								<td>
									<?PHP
										echo $review->CashierEmail;
									?>
								</td>
							</tr>
							<tr>
								<th><?=getSystemString(81)?></th>
								<td>
									<?PHP
										echo $review->CashierName;
									?>
								</td>
							</tr>
							<tr>
								<th>
									<h4 class="text-primary" style="margin-top: 10px;">
										<?=getSystemString('review')?>
									</h4>
								</th>
								<td></td>
							</tr>
							<tr>
								<th>Overall Rating</th>
								<td>
									<?PHP
										$rating['rating'] = $review->Overall_Rating;
										$this->load->view('orders/reviews/snippets/ratings', $rating);
										echo '<span class="text-muted"> ('.$review->Overall_Rating.') <span>';
									?>
								</td>
							</tr>
							<tr>
								<th>Quality</th>
								<td>
									<?PHP
										$rating['rating'] = $review->Quality;
										$this->load->view('orders/reviews/snippets/ratings', $rating);
										echo '<span class="text-muted"> ('.$review->Quality.') <span>';
									?>
								</td>
							</tr>
							<tr>
								<th>Taste</th>
								<td>
									<?PHP
										$rating['rating'] = $review->Taste;
										$this->load->view('orders/reviews/snippets/ratings', $rating);
										echo '<span class="text-muted"> ('.$review->Taste.') <span>';
									?>
								</td>
							</tr>
							<tr>
								<th>Pricing</th>
								<td>
									<?PHP
										$rating['rating'] = $review->Pricing;
										$this->load->view('orders/reviews/snippets/ratings', $rating);
										echo '<span class="text-muted"> ('.$review->Pricing.') <span>';
									?>
								</td>
							</tr>
							<tr>
								<th>Service</th>
								<td>
									<?PHP
										$rating['rating'] = $review->Service;
										$this->load->view('orders/reviews/snippets/ratings', $rating);
										echo '<span class="text-muted"> ('.$review->Service.') <span>';
									?>
								</td>
							</tr>
							<tr>
								<th><?=getSystemString('review')?></th>
								<td>
									<?PHP
										echo $review->Review;
									?>
								</td>
							</tr>
						</tbody>
					</table>
										
				</div>
			</div>
						
	</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	$(function(){
        
	});
	
</script>
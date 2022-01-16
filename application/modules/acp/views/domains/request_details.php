	


	<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">
	
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
	<?PHP
		$title = 'Title_'.$__lang;
		$subcategory = 'SubCategory_'.$__lang;
		$category = 'Category_'.$__lang;
		$desc = 'Description_'.$__lang;
	?>
	<div id="content-main">
		
		<div class="row">
			<?PHP
				$this->load->view('acp_includes/response_messages');
			?>
		</div>
		
		<div class="row">
						


			<h3 class="text-primary" style="cursor: pointer">
					(# <?= str_pad($request_id, 5, '0', STR_PAD_LEFT); ?>  )
			</h3>

						

  
<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					
					
<div class="col-md-6">

		<div style="padding-top: 10px;color:#3498db">
				<h4><?=getSystemString('domain_information')?></h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
		

				<tr>
								<th><?= getSystemString('domain_name') ?></th>
								<td>
									<?PHP
										echo $request->Domain_Name.$request->TLD
									?>	
								</td>
							</tr>

								<tr>
								<th>نوع الطلب</th>
								<td>
									<?PHP
										echo getSystemString($request->DCR_Request_Type)
									?>	
								</td>
							</tr>

							<tr>
								<th>حالة الطلب</th>
								<td>
									<?PHP
										echo getSystemString($request->DCR_Status)
									?>	
								</td>
							</tr>


	</tbody>
</table>





</div>








<div class="col-md-6">

		<div style="color:#3498db">
				<h4>تفاصيل الطلب</h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
		


						<?PHP
										$post_data =  json_decode($request->DCR_POST_DATA);
										$vars = get_object_vars ( $post_data );
											foreach($vars as $key=>$value) { 
											
												?>
						<tr>
								<th><?= $value ?></th>
								<td style="text-align: end;">
									
									<b><?= $key ?></b>
								</td>
						</tr>
								<?php } ?>
							

			
						

		

	</tbody>
</table>
</div>






											
				</div>
			</div>

				






		</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	var _customer_id = '<?=$customer_id?>';
	var _baseController = '<?=base_url('acp/diets')?>';
</script>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>

<script src="<?=base_url($GLOBALS['home_js_dir'].'/utilities/utilities.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/moment.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/bootstrap-datetimepicker.js')?>"></script>
<script>
	var _baseController = '<?=base_url($__controller)?>';
	$(function(){
		$(".input-date").datetimepicker({
			format: 'YYYY-MM-DD',
			minDate: '<?= date("Y-m-d") ?>'
		});
	});
</script>

<script type="text/javascript">
	
	$('.change_start_date').on('click',function(e){
		e.preventDefault();
			$('.cancelForm').removeClass('hide');
	});

		$('.cancel_change').on('click',function(e){
		e.preventDefault();

			$('.cancelForm').addClass('hide');
	});
</script>

<script type="text/javascript">
      function print_speech(url)
  {


    var w = 900;
    var h = 600;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    window.open(url,"_blank","resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width="+w+",height="+h+",left="+left+",top="+top);
  }
</script>

</body>
</html>



















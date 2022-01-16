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
		#pictures_table td:first-child{
			display: none;
		}
		#pictures_table th:last-child{
			width: 200px; 
		}
		.dataTables_wrapper{
		    max-width: 100% !important;
		}
		#orders .panel.white .panel.white{
			padding: 0px;
			border: 0px;
			box-shadow: none;
		}
		#customer_name{
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
						
			<div class="col-md-12">
				<h3 class="text-primary" onclick="javascript: window.location.reload()" style="cursor: pointer"><?=$customer[0]->Fullname?></h3>
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					
					<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px">
						<tbody>
							<tr>
								<th>
									<?PHP
										$_thumb = base_url($GLOBALS['img_customers_dir'].$customer[0]->Picture);
									?>
									<img src="<?=$_thumb?>" style="border-radius: 50%;margin-bottom: 20px">
								</th>
								<td></td>
							</tr>
							
							<tr>
								<th><?=getSystemString(81)?></th>
								<td class="text-info"><?=$customer[0]->Fullname?></td>
							</tr>
							<tr>
								<th><?=getSystemString(1)?></th>
								<td>
									<?=$customer[0]->Email?>
									<?PHP if ($customer[0]->Email_Verified): ?>
										<label class="label label-success"><?=getSystemString(511)?></label>
									<?PHP endif; ?>
								</td>
							</tr>
							<tr>
								<th><?=getSystemString(137)?></th>
								<td>
								<a href="tel:0<?=$customer[0]->Phone?>">0<?=$customer[0]->Phone?></a>
								</td>
							</tr>
							
							<tr>
								<th style="padding-top: 10px;color:#3498db"><h4><?=getSystemString(479)?></h4></th>
								<td></td>
							</tr>
							
						</tbody>
					</table>
											
				</div>

				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#orders"> <i class="fa fa-shopping-cart"></i> <?=getSystemString('orders')?></a></li>
					<li><a data-toggle="tab" href="#addresses"> <i class="fa fa-map-marker"></i> <?=getSystemString('delivery_address')?></a></li>
				</ul>
				
				<div class="tab-content" style="padding-top: 0px !important">
					<div class="tab-pane fade active in" id="orders">
						<?PHP
							$this->load->view('customers/snippets/orders');
						?>
					</div>
					<div class="tab-pane fade" id="addresses">
						<?PHP
							$this->load->view('customers/addresses/listall');
						?>
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
</script>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script>
	$(function(){
		// datatable initialization
        var dTable = $('#orders_table').DataTable({
            columnDefs: [{
                orderable: false,
                targets: -1
            }],
            order: [
                [0, 'desc']
            ],
            select: true,
            pageLength: 15,
            serverSide: true,
            ajax: {
                url: "<?=base_url('acp/orders/getOrdersList')?>",
                type: "POST",
                cache: false,
                data: function(d) {
                    d.order_no = $('#order_no').val();
                    d.mobile_no = $('#mobile_no').val();
                    d.status = $('#filter_status').val();
                    d.customer_name = $('#customer_name').val();
					d.customer_id = _customer_id;
                }
            },
            drawCallback: function(settings) {
                $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
                $("#filter_orders").find(".disable-btn").remove();
            },
            processing: true,
            filter: true,
            responsive: true,
            autoWidth: false,
            dom: "<'row'<'col-sm-3 text-center'><'col-sm-9'<'toolbar'>l>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            lengthMenu: [
                [15, 25, 50, 100, 1000, -1],
                ['15 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'Show all']
            ]
        });

        // filter products
        $("#filter_orders").on("submit", function() {
            $('#orders_table').DataTable().draw();
            return false;
        });
	});
</script>
</body>
</html>
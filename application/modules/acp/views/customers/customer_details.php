	<style>
		.panel.white{
			min-height: 150px;
		}
		table th{
			width: 250px;
		}
		.edit_docs{ 
			border: 1px solid #BFBFBF;
			border-radius: 5px;
			color: #31708f !important;
			font-size: 12px;
			margin-right: 1rem;
			background: #FFFFFF;
		}
		[dir="ltr"] .edit_docs{  
			margin-right: 0;
			margin-left: 1rem;
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
						
			<div class="col-md-12">
				<h3 class="text-primary" onclick="javascript: window.location.reload()" style="cursor: pointer">
					<?=$customer[0]->Fullname?>
					
					<a href="<?=base_url('acp/editCustomer/'.$customer[0]->Customer_ID)?>" class="btn edit_docs">
					   <i class="fa fa-edit"></i> <?=getSystemString(43)?>
				    </a>

				    <a href="<?=base_url('acp/customers/addCreditsToCustomer/'.$customer[0]->Customer_ID)?>" class="btn edit_docs">
					   <i class="fa fa-plus"></i> <?=getSystemString('manage_customer_wallet')?>
				    </a>

				    <a onclick="return confirm(__ConfirmDeleteMessage)" href="<?=base_url('acp/customers/deleteCustomer/'.$customer[0]->Customer_ID)?>" style="background-color: #a94442; color:#fff !important;" class="btn  edit_docs">
					    <?=getSystemString('delete_account')?>
				    </a>

				</h3>
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					
					<?PHP
						$this->load->view('customers/snippets/customer_details');
					?>
											
				</div>
			</div>





			<!-- Note: Customer domain details  -->
			<div class="col-xs-12">
			<?PHP
				$data[ '__domainStatuses'] = $__domainStatuses; 
				//$this->load->view('domains/snippets/filter_domains', $data); 
				$this->load->view('customers/snippets/customer_domain_details');
			?>		
			</div>	
			<!-- Ends -->
						
		</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>

<script>
	var _customer_id = '<?=$customer[0]->Customer_ID?>';
	var __ConfirmDeleteMessage = '<?= getsystemstring("confirm_delete") ?>';

</script>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script>
	$(function(){
		// datatable initialization
     //    var dTable = $('#orders_table').DataTable({
     //        columnDefs: [{
     //            orderable: false,
     //            targets: -1
     //        }],
     //        order: [
     //            [0, 'desc']
     //        ],
     //        select: true,
     //        pageLength: 15,
     //        serverSide: true,
     //        ajax: {
     //            url: "<?=base_url('acp/datatable/getOrdersByCustomerID/'.$customer[0]->Customer_ID)?>",
     //            type: "POST",
     //            cache: false,
     //            data: function(d) {
     //                // d.order_no = $('#order_no').val();
     //                // d.mobile_no = $('#mobile_no').val();
     //                // d.status = $('#filter_status').val();
     //                // d.customer_name = $('#customer_name').val();
					// d.customer_id = _customer_id;
     //            }
     //        },
     //        drawCallback: function(settings) {
     //            $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
     //            $("#filter_orders").find(".disable-btn").remove();
     //        },
     //        processing: true,
     //        filter: true,
     //        responsive: true,
     //        autoWidth: false,
     //        dom: "<'row'<'col-sm-3 text-center'><'col-sm-9'<'toolbar'>l>>" +
     //            "<'row'<'col-sm-12'tr>>" +
     //            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
     //        lengthMenu: [
     //            [15, 25, 50, 100, 1000, -1],
     //            ['15 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'Show all']
     //        ]
     //    });

     //    // filter products
     //    $("#filter_orders").on("submit", function() {
     //        $('#orders_table').DataTable().draw();
     //        return false;
     //    });
	});
</script>

<!-- Note: used for customer domain details -->
<script>
    $(function() {

        // datatable initialization
        var dTable = $('#domains_table').DataTable({
            columnDefs: [{
                domainable: false,
                targets: -1
            }],
            domain: [
                [0, 'desc']
            ],
            select: true,
            pageLength: 15,
            serverSide: true,
            ajax: {
                url: "<?=base_url('acp/datatable/getDomainsByCustomerID/'.$customer[0]->Customer_ID)?>",
                type: "POST",
                cache: false,
                data: function(d) {
                    d.domain_no = $('#domain_no').val();
                    d.mobile_no = $('#mobile_no').val();
                    d.status = $('#filter_status').val();
                    d.payment = $('#filter_payment').val();
                    d.customer_name = $('#customer_name').val();
                    d.status      = '<?= $status ?>';
                }
            },
            drawCallback: function(settings) {
                $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
                $("#filter_domains").find(".disable-btn").remove();
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
            ],
            language: {
                url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>',
                sLengthMenu: "_MENU_"
            },
            initComplete: function() {
                $("div.toolbar").html('<div class="dropdown">' +
                    '<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>' +
                    '<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">' +
                    '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/domains_csv/")?>">Export to csv</a></li>' +
                    '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/domains_excel/")?>">Export to excel</a></li>' +
                    '</ul>' +
                    '</div>');
            }
        });

        // filter products
        $("#filter_domains").on("submit", function() {
            $('#domains_table').DataTable().draw();
            return false;
        });

    });
</script>
<!-- ends -->
<!-- Note: used to get all orders in customer domain details -->
<script>
    $(function() {

		

		// datatable initialization
		var dTable = $('#domains_orders_table').DataTable({
			columnDefs: [{
				domainable: false,
				targets: -1
			}],
			domain: [
				[0, 'desc']
			],
			select: true,
			pageLength: 15,
			serverSide: true,
			ajax: {
				url: "<?=base_url('acp/datatable/getOrdersByCustomerID/'.$customer[0]->Customer_ID)?>",
				type: "POST",
				cache: false,
				data: function(d) {
					d.domain_no = $('#domain_no').val();
					d.mobile_no = $('#mobile_no').val();
					d.status = $('#filter_status').val();
					d.payment = $('#filter_payment').val();
					d.customer_name = $('#customer_name').val();
					d.status      = '<?= $status ?>';
				}
			},
			drawCallback: function(settings) {
				$('.dataTables_length select, .dataTables_filter input').addClass('form-control');
				$("#filter_domains").find(".disable-btn").remove();
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
			],
			language: {
				url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>',
				sLengthMenu: "_MENU_"
			},
			initComplete: function() {
				$("div.toolbar").html('<div class="dropdown">' +
					'<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>' +
					'<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">' +
					'  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/domains_csv/")?>">Export to csv</a></li>' +
					'  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/domains_excel/")?>">Export to excel</a></li>' +
					'</ul>' +
					'</div>');
			}
		});

		// filter products
		$("#filter_domains").on("submit", function() {
			$('#domains_orders_table').DataTable().draw();
			return false;
		});

		});
</script>
<!-- Ends -->
</body>
</html>
	<style>
		.panel.white{
			min-height: 220px;
		}
		table tr th, table td:not(.dataTables_empty){
			text-align: left !important;
			padding-left: 20px !important;
		}
		.table > thead:first-child > tr:first-child > th:last-child{
			width: 200px !important;
		}
	</style>
	<div id="content-main">
			<h1><?=getSystemString(352)?></h1>
			
			<div class="row">
				
				<?PHP
					$this->load->view('admin/acp_includes/response_messages');
				?>
<div class="col-md-10">
						<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
								<table class="table table-hover display" id="bookings" width="100%">
									<thead>
										<tr>
											<th><?=getSystemString(177)?></th>
											<th><?=getSystemString(353)?></th>
											<th><?=getSystemString(344)?></th>
											<th><?=getSystemString(1)?></th>
											<th><?=getSystemString(345)?></th>
											<th><?=getSystemString(354)?></th>
											<th><?=getSystemString(42)?></th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
	
						</div>
					</div>
				
			</div>
	</div>
<?PHP
	$this->load->view('admin/acp_includes/footer');
?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script>
	menu_track_manual(10, 0);
	$(function(){
		var dTable = $('#bookings').DataTable({
	        processing: true,
	        responsive: true,
	        autoWidth:true,
	        lengthMenu: [ [15, 100, 500, 1000, -1], [15, 100, 500, 1000, "All"] ],
			pageLength: 15,
	        serverSide: true,
	        ajax: {
	            url: "<?=base_url($__controller.'/getBookings')?>",
	            type: "POST"
	        },
			language: {
	           url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>'
			},
			drawCallback:function(){
				$("#bookings_length select").addClass('form-control');
				$("#bookings_filter input").addClass('form-control').css({
					    "width": "180px",
						"display": "inline-block"
				});
			}
		});
	});
</script>
</body>
</html>
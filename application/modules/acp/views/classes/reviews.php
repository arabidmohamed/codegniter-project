	<style>
		.panel.white{
			min-height: 220px;
		}
		table tr th, table td{
			text-align: left !important;
			padding-left: 20px !important;
		}
	</style>
	<div id="content-main">
			<h3><?=getSystemString(376)?></h3>
			
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
<div class="col-md-12">
						<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
								<table class="table table-hover display" id="reviews" width="100%">
									<thead>
										<tr>
											<th><?=getSystemString(41)?></th>
											<th><?=getSystemString(177)?></th>
											<th><?=getSystemString(311)?></th>
											<th><?=getSystemString(206)?></th>
											<th><?=getSystemString(137)?></th>
											<th><?=getSystemString(373)?></th>
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
	$this->load->view('acp_includes/footer');
?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script>
	menu_track_manual(10, 0);
	$(function(){
		var dTable = $('#reviews').DataTable({
	        processing: true,
	        filter:false,
	        responsive: true,
	        autoWidth:false,
	        lengthMenu: [ [15, 100, 500, 1000, -1], [15, 100, 500, 1000, "All"] ],
			pageLength: 15,
	        serverSide: true,
	        ajax: {
	            url: "<?=base_url($__controller.'/getReviews')?>",
	            type: "POST"
	        },
			language: {
	           url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>'
			}
		});
	});
</script>
</body>
</html>
	<link href="<?=base_url($GLOBALS['home_css_dir'].'/jquery-ui.min.css')?>" rel="stylesheet" type="text/css" />
	<style>
		.panel.white{
			min-height: 220px;
		}
	</style>
	<div id="content-main">
		
		<?PHP
			$section = "SectionName_".$__lang;
			$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
		?>
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
				
				<div class="col-md-12">
					<h3>
						<?=getSystemString(494)?> 
						
						<div class="dropdown d-inline-block float-left-right">
							<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>
						    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url($__controller."/editSection/".$section_detail[0]->Section_ID."/".$return_url."/")?>"><i class="fa fa-cog"></i> <?=getSystemString(315)?></a></li>
						    </ul>
						</div>
			
					</h3>
				</div>
				
				<div class="col-md-12">
					<?PHP
						$this->load->view('appointments/snippets/filter');
					?>
					
					<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
						<h4 class="page-title"><?=getSystemString(138)?></h4>
						<br>
						<table class="table table-hover table-bordered display" id="appointments" width="100%">
							<thead>
								<tr>
									<th><?=getSystemString(41)?></th>
									<th><?=getSystemString(136)?></th>
									<th><?=getSystemString(1)?></th>
									<th><?=getSystemString(137)?></th>
									<th><?=getSystemString(177)?></th>
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
	$this->load->view('acp_includes/footer');
?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script>
	menu_track_manual(10, 0);
	$(function(){
		var dTable = $('#appointments').DataTable({
	        columnDefs: [
	           { orderable: false, targets: -1 }
	        ],
	        select: true,
	        order: [[0, "desc"]],
	        pageLength: 15,
	        serverSide: true,
	        ajax: {
	            url: "<?=base_url($__controller.'/getAppointmentsList')?>",
	            type: "POST",
	            data: function(d){
	              d.name = $("#name").val();
				  d.email = $("#email").val();
				  d.no = $("#no").val();
				  d.status = $("#status").val();
				  d.date = $("#date").val();
	            }
	        },
	        drawCallback: function(settings){
	             $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
	             $("#filter_appointments").find(".disable-btn").remove();
	        },
	        processing: true,
	        filter: true,
	        responsive: true,
	        autoWidth:false,
	        dom: "<'row'<'col-sm-3 text-center'><'col-sm-9'<'toolbar'>l>>" +
	             "<'row'<'col-sm-12'tr>>" +
	             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
	        lengthMenu: [
	            [ 15, 25, 50, 100, 1000, -1 ],
	            [ '15 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'Show all' ]
	        ],
			language: {
	           url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>',
	           sLengthMenu: "_MENU_"
			}
	    });
	    
	    $("#date").datepicker();
	    
	    // filter products
	     $("#filter_appointments").on("submit", function(){
		     $('#appointments').DataTable().draw();
		     return false;
	     });
		
		$(document).on("change", ".change_status_app", function()
		{
			var data = { id : $(this).closest('tr').find('td:eq(0)').text() , status : $(this).val() };
			$.ajax({
		 		url: "<?=base_url($__controller.'/ChangeAppointmentStatus')?>",
		 		type:"POST",
                dataType:"JSON",
                data: data,
		 		success: function(result){
			 		console.log(result);
			 	},
		 		error:function(err, status, xhr){
			 		console.log(err);
			 		console.log(status);
			 		console.log(xhr);
		 		}
	 		});
		});
	});
</script>
</body>
</html>
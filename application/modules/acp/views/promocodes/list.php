	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
	<style>
		.placepicker-map {
			min-height: 350px;
		}
		.dropdown-menu{
			min-width: 150px;
		}
		.crop-image{
			width: 250px;
			height: 150px;
		}
		#promos_table td:not(.dataTables_empty):first-child{
			display: none;
		}
		.panel.white{
			min-height: 100px;
		}
	</style>
	<div id="content-main">
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
				<div class="col-md-12">
					<h3>
						<?=getSystemString(7891)?> 
			
						<a href="<?=base_url($__controller.'/add_promocode')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
							<i class="fa fa-plus"></i> <?=getSystemString('Add New Promotion')?>
						</a>
						
					</h3>
					
				  <?PHP
						$this->load->view('promocodes/snippets/filter');
				  ?>	
				 
		          <div class="panel white" style="padding-bottom: 50px;">
			          <h4 class="page-title"><?=getSystemString('Promotions List')?></h4>
					  <br />
			         <table class="table table-hover sortable-tb sortable-1" id="promos_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(41)?></th>
						         <th><?=getSystemString(177)?></th>
								<!--  <th><?=getSystemString(14)?></th> -->
						         <th><?=getSystemString('Promo Code')?></th>
						         <th><?=getSystemString('Promo Title')?></th>
						         <th><?=getSystemString('Start Date')?></th>
						         <th><?=getSystemString('End Date')?></th>
						         <th><?=getSystemString('Discount Value')?></th>
						         <th><?=getSystemString(33)?></th>
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
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script>
	var _baseController = '<?=base_url($__controller)?>';
	$(function(){	
		
		// datatable initialization
	    var dTable = $('#promos_table').DataTable({
	        select: true,
	        searching: false,
	        order: [[0, "desc"]],
	        aoColumnDefs: [{
	           bSortable: false,
	           aTargets: [ 8 ] 
	        }],
	        pageLength: 15,
	        serverSide: true,
	        ajax: {
	            url: "<?=base_url($__controller.'/getPromoCodesList')?>",
	            type: "POST",
	            data: function(d){
		          d.code = $("#filter_code").val();
				  //d.apply_on = $("#filter_applyOn").val();
	            }
	        },
	        drawCallback: function(settings){
	            $(document).find('[data-toggle="hurkanSwitch"]').each(function(){
					$(this).hurkanSwitch({
						'on':function(r){
							alert(r);
						},
					  'off':function(r){
						  alert(r);
					  },
					  'onTitle':'<i class="fa fa-check"></i>',
					  'offTitle':'<i class="fa fa-times"></i>',
					  'width':60
		
					});
			
			  });
			  
             $(".disable-btn").remove();
	        },
	        processing: true,
	        filter: true,
	        responsive: true,
	        autoWidth:false,
	        lengthMenu: [
	            [ 15, 25, 50, 100, 1000, -1 ],
	            [ '15 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'Show all' ]
	        ],
			language: {
	           url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>',
	           sLengthMenu: "_MENU_"
			}
	    });
	    
	    $("form#filter_promos").on("submit", function(){
			$('#promos_table').DataTable().draw();
			return false;
		});
			
		$(document).on('click',"#promos_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'promos');
		});
		
	});
	
</script>

</body>
</html>
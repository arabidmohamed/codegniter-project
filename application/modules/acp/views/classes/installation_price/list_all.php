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
		#installation_price_table td:not(.dataTables_empty):first-child{
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
						<?=getSystemString('installation_price')?> 
			
						<a href="<?=base_url($__controller.'/add_installation_price')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
							<i class="fa fa-plus"></i> <?=getSystemString('add_installation_price')?>
						</a>
						
					</h3>
					
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;margin-bottom: 20px;padding-bottom: 20px">
	      <h4 class="page-title">
	        <?=getSystemString(326)?>
	      </h4>
	      <div class="col-xs-12 no-padding">
	        <form action="" method="post" id="filter_installation_price">
		          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
		            <div class="form-group">
		              <select class="form-control select2 "  id="filter_city" >
			              <option value="">
			              	<?=getSystemString(308)?>
			              </option>
						  <?PHP
						  	$cat_nn = 'City_'.$__lang;
						foreach($cities as $row){
						
						?>
			              <option value="<?=$row->City_ID?>">
			              		<?=$row->$cat_nn?>
			              </option>
	              <?PHP
		              }
	              ?>
	            </select>
		            </div>
		          </div>


		         <div class="col-xs-12 text-center">
						<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
					</div>
	
			
	   </form>
	</div>
</div> 

				 
		          <div class="panel white" style="padding-bottom: 50px;">
			   
			         <table class="table table-hover sortable-tb sortable-1" id="installation_price_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(41)?></th>
						       <th><?=getSystemString('City Name')?></th>  
						         <th><?=getSystemString('installation_price')?></th>
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

	$(function(){	

			$(".select2").select2({
		      theme:'bootstrap',
		      placeholder: '<?=getSystemString(59)?>'
		});

		// datatable initialization
	    var dTable = $('#installation_price_table').DataTable({
	        select: true,
	        searching: false,
	        order: [[0, "desc"]],
	        aoColumnDefs: [{
	           bSortable: false,
	           aTargets: [ 0 ] 
	        }],
	        pageLength: 15,
	        serverSide: true,
	        ajax: {
	            url: "<?=base_url($__controller.'/installation_price_list')?>",
	            type: "POST",
	            data: function(d){
		          d.filter_city = $("#filter_city").val();
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
	    
	    $("form#filter_installation_price").on("submit", function(){
			$('#installation_price_table').DataTable().draw();
			return false;
		});
			
		$(document).on('click',"#installation_price_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'installation_price');
		});
		
	});
	
</script>

</body>
</html>
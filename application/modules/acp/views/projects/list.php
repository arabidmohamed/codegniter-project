	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<style>
	.panel.white{
	    min-height: 150px ;
    }
    .dropzone .dz-message{
	    margin: 0px;
	    font-size: 13px;
    }
    .dropzone{
	    min-height: 0px;
    }
    .select2{
	    width: 100% !important;
    }
	#map{
		width: 100%;
		height: 250px;
	}
	#pac-input{
		width: 65%;
		top:10px !important;
	}
	.dataTables_wrapper .row:first-child{
		top: -55px;
    }
    #projects_table tr td:nth-child(1){
	    display: none;
    }

    <?php if($__lang == 'ar'): ?>
    .toolbar {float: left}
    .dataTables_wrapper .dataTables_length {
        float: left !important;
    }
    table tr th, table td {
        text-align: right !important;
        padding-right: 20px !important;
    }
    <?php else: ?>
    table tr th, table td{
        text-align: left !important;
        padding-left: 20px !important;
    }
    <?php endif; ?>
</style>
	<div id="content-main">
        <?PHP
        $section = "SectionName_".$__lang;
        $return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
        ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="<?=$pageName[0]->$section?> <"><?=$pageName[0]->$section?></li>
            </ol>
        </nav>
			<div class="row">
				
				<?PHP
				$this->load->view('acp_includes/response_messages');
				?>
				<div class="col-md-12">
					
					<?PHP
						$section = "SectionName_".$__lang;
						$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
					?>
					<h3>
						<?=$pageName[0]->$section?> 
						
			<!-- 			<div class="dropdown d-inline-block float-left-right">
							<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>
						    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/editSection/".$pageName[0]->Section_ID."/".$return_url."/")?>"><i class="fa fa-cog"></i> <?=getSystemString(315)?></a></li>
						    </ul>
						</div> -->
						
				<!-- 		<a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
							<i class="fa fa-plus"></i> <?=getSystemString(663)?>
						</a> -->
						
						<a href="<?=base_url($__controller.'/categories_list')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
							<i class="fa fa-plus"></i> <?=getSystemString(441)?>
						</a>
						
					</h3>
		          
				</div>

				<div class="col-md-12">
				
				<?PHP
					$data['categories'] = $categories;
					$this->load->view('projects/snippets/filter_projects', $data);
				?>
					
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			          <h4>
					  	<?=getSystemString(662)?>
					  </h4>
			          
			          <br />
			          
			         <table class="table table-hover" id="projects_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(149)?></th>
						         <th><?=getSystemString(177)?></th>
						         <th><?=getSystemString(350)?></th>
						         <th><?=getSystemString(82)?></th>
						         <th><?=getSystemString(137)?></th>
						         <th><?=getSystemString(58)?></th>
						         <th><?=getSystemString(33)?></th>
						         <th><?=getSystemString(153)?></th>
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
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script>
	
	
	$(function(){
		
		$(".select2").select2({
			theme:'bootstrap',
			placeholder: '<?=getSystemString(59)?>'
		});
		
		
			 // datatable initialization
	    var dTable = $('#projects_table').DataTable({
	        columnDefs: [
	           { orderable: false, targets: -1 }
	        ],
	        responsive: true,
	        select: true,
	        order: [[ 0, 'desc' ]],
		    aoColumnDefs: [{
		       bSortable: false,
		       aTargets: [ 2, 4, 5, 6 ] 
		    }],
	        pageLength: 15,
	        serverSide: true,
	        ajax: {
	            url: "<?=base_url($__controller.'/getDataList')?>",
	            type: "POST",
	            cache: false,
	            data: function(d){
// 	              d.title = location.pathname.split('/').pop()
					d.title = $("#filter_title").val();
					d.category = $("#filter_category").val();
					d.email = $("#filter_email").val();
	            }
	        },
	        drawCallback: function(settings){
	             $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
	             $("#filter_projects").find(".disable-btn").remove();
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
	        },
	        processing: true,
	        filter: true,
// 	        scrollX: true,
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
			},
			initComplete: function(){
				$("div.toolbar").html('<div class="dropdown">'+
	    							'<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>'+
								    '<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">'+
								    '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/projects_csv/")?>">Export to csv</a></li>'+
								    '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/projects_excel/")?>">Export to excel</a></li>'+
								    '</ul>'+
							  '</div>');
			}
	    });
	    
	    // filter products
     $("#filter_projects").on("submit", function(){
	     $('#projects_table').DataTable().draw();
	     return false;
     });   
		

		$(document).on('click',"#projects_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'projects');
		});
		
		$(document).on('click',"#categories_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'project_categories');
		});		
		
		$('#categories_table').on('click', function(){
			ChangeOrder('project_categories');
		});

		
	});
</script>


</body>
</html>
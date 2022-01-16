
	
<?PHP
$section = "SectionName_".$__lang;
$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
?>
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
    #news_table tr td:nth-child(1){
	    display: none;
    }
	/* Note: used for toggle switch */
	.switch {
	  position: relative;
	  display: inline-block;
	  width: 60px;
	  height: 34px;
	}
	
	.switch input { 
	  opacity: 0;
	  width: 0;
	  height: 0;
	}
	
	.slider {
	  position: absolute;
	  cursor: pointer;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #ccc;
	  -webkit-transition: .4s;
	  transition: .4s;
	}
	
	.slider:before {
	  position: absolute;
	  content: "";
	  height: 26px;
	  width: 26px;
	  left: 4px;
	  bottom: 4px;
	  background-color: white;
	  -webkit-transition: .4s;
	  transition: .4s;
	}
	
	input:checked + .slider {
	  background-color: #2196F3;
	}
	
	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}
	
	input:checked + .slider:before {
	  -webkit-transform: translateX(26px);
	  -ms-transform: translateX(26px);
	  transform: translateX(26px);
	}
	
	/* Rounded sliders */
	.slider.round {
	  border-radius: 34px;
	}
	
	.slider.round:before {
	  border-radius: 50%;
	}
	#customer_data .search{
		display: none !important;
	}
</style>
<div id="content-main">

			<div class="row">
				<!-- Note: used for advanced filer -->
		        <div class="col-md-12">
		          <?PHP
		            $data['categories'] = $categories;
		            $this->load->view('localization/snippets/filter_strings', $data);
		          ?>
		        </div>
		        <!-- Ends -->
			</div>
			<div class="row">	         
					<?PHP
						$this->load->view('acp_includes/response_messages');
					?>		
					<div class="col-md-12">
						<div class="col-md-6">
							<h1><?=getSystemString('strings')?></h1>
						</div>
						<div class="col-md-6">
							<div>
								<div class="dropdown d-inline-block float-left-right">
									<button class="btn btn-default dropdown-toggle hide" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>
									<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
									<li role="presentation"><a role="menuitem" tabindex="-1" href=""><i class="fa fa-cog"></i> <?=getSystemString(315)?></a></li>
									</ul>
								</div>
								
								<button data-role="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
									<i class="fa fa-plus"></i> <?=getSystemString('add_string')?>
								</button>
								<a href="<?=base_url($__controller.'/manageCategories')?>" class="hide btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
									<i class="fa fa-list"></i> <?=getSystemString(441)?>
								</a>
								<form method="post" id="import_form" enctype="multipart/form-data" class="hide">
										<input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>    
										<input type="submit" name="import" value="Import" class="btn btn-info" />		
								</form>
								<br>	
							</div>
						</div>	
						<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
						<table class="table table-hover display" id="localization" width="100%">
							<thead>
								<tr>
									<th width="20">#</th>
									<th width="185"><?=getSystemString('strings')?></th>
									<th width="280"><?=getSystemString('string_en')?></th>
									<th><?=getSystemString('string_ar')?></th>
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
	</div>

	<!-- Modal to add new string key -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel"><?=getSystemString('add_string')?></h3>
			</div>
			<div class="container-fluid">
				<!-- Form goes here -->
				<form id="formoid" action="<?=base_url($__controller.'/addString_POST')?>" title="" method="post">
					<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					</div>    
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleFormControlInput1"><?=getSystemString('string')?></label>
							<input type="text" class="form-control" id="strings" name="strings" placeholder="eg. login or 123" required>
						</div>
						<div class="form-group">
							<label for="exampleFormControlInput1"><?=getSystemString('string_en')?></label>
							<input type="text" class="form-control" id="string_en" name="string_en" placeholder="eg. Login" required>
						</div>
						<div class="form-group">
							<label for="exampleFormControlInput1"><?=getSystemString('string_ar')?></label>
							<input type="text" class="form-control" id="string_ar" name="string_ar" placeholder="مثال: الدخول" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" id="submitButton" name="submitButton" value="<?=getSystemString('save_now')?>" />
					</div>
				</form>
				<!-- End -->
			</div>
			</div>
		</div>
	</div>

	<!-- Modal to update string key -->

	<div class="modal fade" id="update_string" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel"><?=getSystemString('add_string')?></h3>
			</div>
			<div class="container-fluid">
				<!-- Form goes here -->
				<form id="formoid" action="<?=base_url($__controller.'/updateString_POST')?>" title="" method="post">
					<div class="modal-body">
						<input type="hidden" name="id" id="id" class="form-control-sm">
						<input type="hidden" name="cid" id="cid" class="form-control-sm">
						<div class="form-group">
							<label for="exampleFormControlInput1"><?=getSystemString('string')?></label>
							<input type="text"
								class="form-control" 
								id="key" 
								name="key"
								value="">
						</div>
						<div class="form-group">
							<label for="exampleFormControlInput1"><?=getSystemString('string_en')?></label>
							<input type="text" class="form-control" id="stringen" name="stringen" value="" placeholder="eg. Login" required>
						</div>
						<div class="form-group">
							<label for="exampleFormControlInput1"><?=getSystemString('string_ar')?></label>
							<input type="text" class="form-control" id="stringar" name="stringar" value="" placeholder="مثال: الدخول">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" id="update_data" name="update_data" value="<?=getSystemString('save_now')?>" />
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
					</div>
				</form>
				<!-- End -->
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
		if($('#localization').length > 0){
			var dTable = $('#localization').DataTable({
		        processing: true,
		        filter:false,
		        responsive: true,
		        autoWidth:false,
		        lengthMenu: [ [15, 100, 500, 1000, -1], [15, 100, 500, 1000, "All"] ],
				pageLength: 15,
		        serverSide: true,
		        ajax: {
		            url: "<?=base_url('acp/localization/getDataList')?>",
		            type: "POST",
					cache: false,
	            	data: function(d){
					d.key = $("#filter_key").val();
					d.string_en = $("#filter_string_en").val();
					d.string_ar = $("#filter_string_ar").val();
	            }
		        },
				language: {
		           url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>'
				}
			});
			$("#localization_filter").on("submit", function(){
					$('#localization').DataTable().draw();
					return false;
				});
		}
	});
</script>
<script>
$(document).ready(function() 
{
	$(document).on("click", ".item_edit", function () {
	     var lID = $(this).data('id');
	     var lKey = $(this).data('key');
	     var stringEN = $(this).data('stringen');
	     var stringAR = $(this).data('stringar');
	     $(".modal-body #id").val( lID );
	     $(".modal-body #key").val( lKey );
	     $(".modal-body #stringen").val( stringEN );
	     $(".modal-body #stringar").val( stringAR );
	});

	$(function () 
	{
		$('#update_string').on('.item_edit', function (event) {
			var button = $(event.relatedTarget); 
			var id  = modal.data('id');   // id
			var key = modal.data('key'); // key
			var stringen = modal.data('stringen'); // string_en
			var stringar = $(this).attr("data-stringar");
			var modal = $(this);
			modal.find('#id').val(id);
			modal.find('#key').val(key);
			modal.find('#stringen').val(stringen);
			modal.find('#stringar').val(stringar);
		});
    });
	$(document).on("click", "#update_data", function() { 
		$.ajax({
			url: "<?php echo base_url($__controller.'/updateString_POST');?>",
			type: "POST",
			cache: false,
			data:{
				id: $('#id').val(),
				key: $('#key').val(),
				stringen: $('#stringen').val(),
				stringar: $('#stringar').val(),
			}
		});
	}); 
});
</script>
</body>
</html>
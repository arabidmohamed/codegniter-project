	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
	<style>
		.panel.white{
			min-height: 240px;
			padding-bottom: 20px;
			    overflow: initial;
		}
		.bootstrap-datetimepicker-widget{
			z-index: 999999;
		}
		div.dataTables_wrapper{
			max-width: 100% !important;
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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="<?=getSystemString(493)?> <"><a href="<?=base_url('acp/careers/listall    ')?>"><?=getSystemString(493)?></a></li>
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(208)?> <"><?=getSystemString(208)?> </li>
            </ol>
        </nav>
		<!-- Note: total -->
	<!-- 		<div class="container col-md-3" id="totals">
				<div class="row">
					<div class="col-md-12">
						<h3 class="text-center"><?=getSystemString(208)?></h3>
						<h4><?=$total['TotalApplications']?></h4>
						<p><?=getSystemString(208)?></p>
					</div>
				</div>
			</div>
			<div class="container col-md-8" id="totals">
				<div class="row">
					<div class="col-md-6">
						<h3 class="text-center"><?=$totalMale?></h3>
						<h4>_</h4>
						<p><?=getSystemString(237)?></p>
					</div>
					<div class="col-md-6">
						<h3 class="text-center"><?=$totalFemale?></h3>
						<h4>_</h4>
						<p><?=getSystemString(238)?></p>
					</div>
				</div>
			</div> -->	
			<!-- Ends -->
		<div class="row">
			<?PHP
				
					$this->load->view('acp_includes/response_messages');
				?>
		</div>

<!--		<h3>--><?//=getSystemString(530)?><!--</h3>-->
			<div class="row">
				
			 	<div class="col-md-12">
			 			
			 	<?PHP
					$this->load->view('careers/snippets/filter_applications');
				?>
			 			
						<br />
						
						<div class="panel white" style="height: auto;overflow: initial; padding-bottom: 40px;margin-bottom: 20px">
							<h4 class="page-title"><?=getSystemString(203)?></h4>
							<br />
								<table class="table table-hover display" id="applications" width="100%">
									<thead>
										<tr>
											<th><?=getSystemString(41)?></th>
											<th><?=getSystemString(177)?></th>
											<th><?=getSystemString(136)?></th>
											<th><?=getSystemString(1)?></th>
											<th><?=getSystemString(137)?></th>
                                            <th><?=getSystemString(71)?></th>
										<!-- 	<th><?=getSystemString(200)?></th> -->
                                         
											<th><?=getSystemString(42)?></th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
	<div id="popover-content" class="hide">
		<ul class="ul-flags">
			<li><a href="#" data-state="blue"><i class="fa fa-flag color-blue"></i></a>
			</li>
			<li><a href="#" data-state="green"><i class="fa fa-flag color-green"></i></a>
			</li>
			<li><a href="#" data-state="red"><i class="fa fa-flag color-red"></i></a>
			</li>
			<li><a href="#" data-state="yellow"><i class="fa fa-flag color-yellow"></i></a>
			</li>
			<li><a href="#" data-state="grey"><i class="fa fa-flag color-grey"></i></a>
			</li>
		</ul>
	</div>
								</div>
					</div>
				
			</div>
	</div>
	
	
	<div id="detail_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-transform: capitalize"><?=getSystemString(69)?></h4>
      </div>
      <div class="modal-body">
        <div class="col-xs-12">
	        <img src="" id='pp' onerror="this.src='<?=base_url('style/acp/img/avatar1.png')?>'" style="width: 120px; max-height: 100%;margin: 20px 0px" >
	        <table class="table table-hover">
				<tbody>
				</tbody>
			</table>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/moment.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/bootstrap-datetimepicker.js')?>"></script>
<script>
	
	var strings = {
		name : '<?=getSystemString(344)?>',
		number: '<?=getSystemString(345)?>',
		email: '<?=getSystemString(346)?>',
		birthdate: '<?=getSystemString(347)?>',
		nationality:'<?=getSystemString(348)?>',
		city: '<?=getSystemString(349)?>',
		gender: '<?=getSystemString(350)?>',
		date: '<?=getSystemString(351)?>'
	};
	
	$(function(){
		menu_track_manual(7, 0);
		
		var job_id = location.pathname.split('/').pop();
		if(typeof job_id == Number){
		 	$("#filter_job").val(job_id);
		}
		
		$(".select2").select2({
		      theme:'bootstrap',
		      placeholder: '<?=getSystemString(59)?>'
		});
		
		$("#filter_birthdate").datetimepicker({
			format: 'DD-MM-YYYY'
		});
		
		 // datatable initialization
    var dTable = $('#applications').DataTable({
        columnDefs: [
           { orderable: false, targets: -1 }
        ],
        select: true,
        order: [[0, "desc"]],
        pageLength: 15,
        serverSide: true,
        ajax: {
            url: "<?=base_url('acp/datatable/getApplicationsList')?>",
            type: "POST",
            data: function(d){
              d.name = $("#filter_name").val();
			  d.email = $("#filter_email").val();
			  d.number = $("#filter_number").val();
			  d.nationality = $("#filter_nationality").val();
			  d.city = $("#filter_city").val();
			  d.gender = $("#filter_gender").val();
			  d.birthdate = $("#filter_birthdate").val();
			  d.job = $("#filter_job").val();
            }
        },
        drawCallback: function(settings){
             dataTableCallback();
             $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
             $("#filter_applications").find(".disable-btn").remove();
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
		},
		initComplete: function(){
			$("div.toolbar").html('<div class="dropdown">'+
    							'<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>'+
							    '<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">'+
							    '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/csv/".@$job_id)?>">Export to csv</a></li>'+
							    '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/excel/".@$job_id)?>">Export to excel</a></li>'+
							    '</ul>'+
						  '</div>');
		}
    });
    
    // filter products
     $("#filter_applications").on("submit", function(){
	     $('#applications').DataTable().draw();
	     return false;
     });
		
		var currentPopover = '';
		var currentPopoverClass = '';
		$('[data-toggle="popover"]').each(function(ele){
			$(this).popover({
				html: true, 
				content: function() {
			        return $('#popover-content').html();
			    }
		    }).click(function(e) {
			    $(document).find('.popover-content .ul-flags').attr('data-target-id', $(this).closest('tr').find('td:eq(0)').text());
			    currentPopover = $(this).closest('tr');
			    currentPopoverClass = $(this).find('i').attr('class');
			    var s = currentPopoverClass.split(' ');
			    currentPopoverClass = s[3];
				e.preventDefault();
			});
		});
        
        $(document).on('click', '.ul-flags li a', function(){
	        var data = { id: $(this).closest('ul').attr('data-target-id'), state: $(this).attr('data-state') };
	        $.ajax({
			 		url: "<?=base_url($__controller.'/changeApplicationFlagState')?>",
			 		type:"POST",
	                dataType:"JSON",
	                data: data,
			 		success: function(r){
				 		console.log(r);
				 		if(r.result == 1){
							$(currentPopover).find('.toggle-flag').removeClass(''+currentPopoverClass).addClass('color-'+data.state);				 						$('[data-toggle="popover"]').popover('hide');
				 		}
				 	},
			 		error:function(err, status, xhr){
				 		console.log(err);
				 		console.log(status);
				 		console.log(xhr);
			 		}
			});
			
			return false;
        });
        
         // view application details
    $(document).on('click', '.view-details', function () {
        var data = {};
        var j_jid = $(this).attr("data-ap-id");
        var imgUrl = '<?=base_url($GLOBALS['applications_dir'])?>';
        data['apid'] = j_jid;
        $.ajax({
            url: "<?=base_url('acp/getFullApplicationData')?>",
            type: "POST",
            data: data,
            dataType: "JSON",
            success: function (result) {
                console.log(result);
                if (result.length > 0) {
                    $('#detail_modal table tbody').empty();
                    var head = [strings.name, strings.number, strings.email, strings.birthdate, 'Education Level', 'Marital Status', 'Job Type', 'Age', 'Current Work', strings.nationality, 'Country', strings.city, strings.gender, strings.date];
                    $('#pp').attr('src', '');
                    $('#pp').attr('src', imgUrl + result[0].PersonalPicture);
                    for (var i = 0; i < result.length; i++) {
                        $('#detail_modal table tbody').append('<tr><th>' + head[0] + '</th>' +
                            '<td>' + result[i].Fullname + '</td></tr>' +
                            '<tr><th>' + head[1] + '</th><td>' + result[i].Number + '</td></tr>' +
                            '<tr><th>' + head[2] + '</th><td>' + result[i].Email + '</td></tr>' +
                            '<tr><th>' + head[3] + '</th><td>' + result[i].Birthdate + '</td></tr>' +
                            '<tr><th>' + head[9] + '</th><td>' + result[i].Nationality + '</td></tr>' +
                            '<tr><th>' + head[11] + '</th><td>' + result[i].City + '</td></tr>' +
                            '<tr><th>' + head[12] + '</th><td>' + result[i].Gender + '</td>' +
                            '<tr><th>' + head[13] + '</th><td>' + result[i].DateApplied + '</td>' +
                            '</tr>');
                    }
                    $('#detail_modal').modal('show');
                }

            },
            error: function (err, status, xhr) {
                console.log(err);
                console.log(status);
                console.log(xhr);
            }
        });
        return false;
    });
		
		$(document).on('click', '.archive-app',function(){
			var currentRow = $(this).closest('tr');
			var data = { id : $(currentRow).find('td:eq(0)').text(), state: 1 };
			$.ajax({
			 		url: "<?=base_url($__controller.'/archiveApplication')?>",
			 		type:"POST",
	                dataType:"JSON",
	                data: data,
			 		success: function(r){
				 		console.log(r);
				 		if(r.result == 1){
					 		$(currentRow).remove();
				 		}
				 	},
			 		error:function(err, status, xhr){
				 		console.log(err);
				 		console.log(status);
				 		console.log(xhr);
			 		}
			});
			
			return false;
		});
		
	});
	
	function dataTableCallback() {

    var currentPopover = '';
    var currentPopoverClass = '';

    $(document).find('[data-toggle="popover"]').each(function (ele) {
        $(this).popover({
            html: true,
            content: function () {
                return $('#popover-content').html();
            }
        }).click(function (e) {
            $(document).find('.popover-content .ul-flags').attr('data-target-id', $(this).closest('tr').find('td:eq(0)').text());
            currentPopover = $(this).closest('tr');
            currentPopoverClass = $(this).find('i').attr('class');
            var s = currentPopoverClass.split(' ');
            currentPopoverClass = s[3];
            e.preventDefault();
        });
    });
}
</script>
</body>
</html>
<style>
	.panel.white{
		min-height: 100px;
	}
	body[dir="rtl"] .input-group{
		direction: rtl;
	}
	.input-group-addon {
	    padding: .4rem .75rem;
	    min-width: 47px;
    }
    .input-group .fa-twitter{
		color:#55acee;
	}
	.input-group .fa-instagram{
		color:#e4405f;
	}
	.input-group .fa-facebook{
		color:#3b5999;
	}
	.input-group .fa-google-plus{
		color:#dd4b39;
	}
	.input-group .fa-linkedin{
		color:#007bb5;
	}
	.input-group .fa-snapchat{
		color: #e9c350;
	}
	.input-group .fa-youtube{
		color: #bb0000;
	}
	.input-group .fa-telegram{
		color: #0088cc;
	}
	.input-group .fa-pinterest{
		color: #bd081c;
	}
	.input-group .fa-vimeo{
		color: #1ab7ea;
	}
	.input-group .fa-whatsapp{
		color: #1ebea5;
	}
	body[dir="rtl"] .sm-upd-cnt{
		text-align: right;
		padding-right: 45px;
	}
	.sm-upd-cnt small{
		font-size: 11px;
		color: #c2c2c2;
	}
	body[dir='rtl'] .radio-inline input[type="radio"]{
		margin-left: 0px;
		margin-right: -20px;
	}
	body[dir='rtl'] .radio-inline{
		padding-right: 20px;
	}
	body[dir="rtl"] .input-group-addon{
		border-right: 1px solid #ccc;
		border-left: 0px transparent;
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		border-top-left-radius: 0;
		border-bottom-left-radius: 0;
	}
	body[dir="rtl"] .input-group .form-control{
	    border-top-left-radius: 4px;
		border-bottom-left-radius: 4px;
		border-top-right-radius: 0;
		border-bottom-right-radius: 0;
	}
    
    <?php if($__lang == 'ar'): ?>
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
			<div class="row">
				<div class="col-md-10">
					<h3><?=getSystemString(19)?></h3>
				</div>
				<div class="col-md-2">
				    <div class="toolbar">
					    <div class="dropdown">
						    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>
						    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1"> 
							    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url('acp/logs/logs')?>"><?=getSystemString(297)?></a></li>
							    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url('acp/notifications/sms_log')?>"><?=getSystemString(395)?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">	         
				<!-- ~~~~~~~~~~~~~~~~ Website Logs ~~~~~~~~~~~~~~~~~~~ -->
					<?PHP
						if($this->session->userdata($this->acp_session->role()) == 'super_admin' || $this->session->userdata($this->acp_session->role()) == 'admin') {
					?>
					         
						<div class="col-md-12">
							<h1><?=getSystemString(297)?></h1>
							<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
							<table class="table table-hover display" id="applications" width="100%">
								<thead>
									<tr>
										<th width="20"><?=getSystemString(41)?></th>
										<th width="185"><?=getSystemString(177)?></th>
										<th width="280"><?=getSystemString(1)?></th>
										<th><?=getSystemString(298)?></th>
										<th><?=getSystemString(42)?></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					<?PHP
						}
					?>			
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
		if($('#applications').length > 0){
			var dTable = $('#applications').DataTable({
		        processing: true,
		        filter:false,
		        responsive: true,
		        autoWidth:false,
		        lengthMenu: [ [15, 100, 500, 1000, -1], [15, 100, 500, 1000, "All"] ],
				pageLength: 15,
		        serverSide: true,
		        ajax: {
		            url: "<?=base_url('acp/datatable/getWebsiteLogs')?>",
		            type: "POST"
		        },
				language: {
		           url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>'
				},
				drawCallback:function(){
					$("#applications_filter input").addClass('form-control').css({
						    "width": "180px",
							"display": "inline-block"
					});
				}
			});
		}
	});
</script>
</body>
</html>
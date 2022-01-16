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
  .dataTables_wrapper .row:first-child{
	  top: -55px;
  }
  body[dir="rtl"] .pl-0{
	  padding-right: 0px;
  }
  body[dir="ltr"] .pl-0{
	  padding-left: 0px;
  }
  table td:not(.dataTables_empty):first-child{
	  display: none;
  }
  table th:last-child{
	 width: 200px; 
  }
  .dataTables_length{
	  float: left !important;
  }
  .toolbar{
	float: left;
  }
</style>
<div id="content-main">
  <div class="row">
    <?PHP
		$this->load->view('acp_includes/response_messages');
	?>
    
    <div class="col-md-12">
		<h3><?=getSystemString("subscription_logs")?></h3>
	    <?PHP
			$this->load->view('customers/subscriptions/snippets/filter');
		?>
    </div>
    

<div class="col-md-12">
  <div class="panel white" style="padding-bottom: 100px;padding-top: 5em">
	<table class="table table-hover display" id="subscription_logs" width="100%">
		<thead>
			<tr>
				<th class="hide"><?=getSystemString(41)?></th>
				<th><?=getSystemString(177)?></th>
				<th><?=getSystemString(413)?></th>
				<th><?=getSystemString(81)?></th>
				<th><?=getSystemString(415)?></th>
				<th><?=getSystemString('plan_month')?></th>
				<th><?=getSystemString('Platform')?></th>
				<th>المختص</th>
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
	  
	  var dTable = $('#subscription_logs').DataTable({
		autoWidth:false,
		lengthChange: false,
		serverSide: true,
		ajax: {
			url: "<?=base_url('acp/datatable/getOnlySubscriptionsLogs')?>",
			type: "POST",
			data: function(d)
			{
				d.planname = $("#filter_name").val();
				d.promocode = $("#filter_promocode").val();
				//d.paymentverified = $("#filter_payverified").val();
			}
		},
		drawCallback: function(settings){
			$("#filter_customers").find(".disable-btn").remove(); 
		},
		processing: true,
        filter: true,
        responsive: true,
        dom: "<'row'<'col-sm-3 text-center'><'col-sm-9 text-left'<'toolbar'>l>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        lengthMenu: [
            [ 15, 25, 50, 100, 1000, -1 ],
            [ '15 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'Show all' ]
        ],
		initComplete: function(){
			$("div.toolbar").html('<div class="dropdown">'+
					'<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>'+
					'<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">'+
					'  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/subscriptions_excel/")?>">Export to excel</a></li>'+
					'</ul>'+
			  '</div>');
		},
		language: {
		url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>'
		}
	});
	  
     // filter subscriptions
     $("#filter_subscriptions").on("submit", function(){
	     $('#subscription_logs').DataTable().draw();
	     return false;
     });
                                               
});
</script>
</body>
</html>

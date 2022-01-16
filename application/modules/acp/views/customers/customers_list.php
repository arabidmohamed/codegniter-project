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
  table td:nth-child(3){
	  display: none;
  }
  .dataTables_length{
	  float: left !important;
  }
  .users-table th:nth-child(4), .users-table td:nth-child(4){
	  display: none;
  }
</style>
<div id="content-main">
  <div class="row">
    <?PHP
		$this->load->view('acp_includes/response_messages');
	?>
    <div class="col-md-12">
      <h3>

    <?PHP
          if($Customer_Type=='parent'){
              echo getSystemString('parents_list');
      }elseif($Customer_Type=='teacher'){
        echo getSystemString('teachers_list');
      }
      ?>

	  </h3>
    </div>
    
    <div class="col-md-12">
	    <?PHP
			$this->load->view('customers/snippets/filter_customers');
		?>
		<input type="hidden" id="show_members" value="<?PHP echo isset($show_members) ? 1 : 0 ?>">
    </div>
    

<div class="col-md-12">
	
  <div class="panel white" style="padding-bottom: 100px;">
	  
	<h4 class="page-title">
    <?PHP
          if($Customer_Type=='parent'){
              echo getSystemString('parents_list');
      }elseif($Customer_Type=='teacher'){
        echo getSystemString('teachers_list');
      }
      ?>

		</h4>
	
	<br /> 
    <table class="table table-hover " id="customers_table">
      <thead>
        <tr>
          <th class="hide">
            <?=getSystemString(149)?>
          </th>
          <th>
            <?=getSystemString(149)?>
          </th>
          <th>
            <?=getSystemString(177)?>
          </th>
          <th>
            <?=getSystemString(81)?>
          </th>
          <th>
            <?=getSystemString(1)?>
          </th>
          <th>
            <?=getSystemString(137)?>
          </th>

          <th>
            <?=getSystemString(33)?>
          </th>
          <th>
            <?=getSystemString(42)?>
          </th>
          
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
    
    // datatable initialization
    var dTable = $('#customers_table').DataTable({
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
        url: "<?=base_url('acp/datatable/getCustomersList')?>",
        type: "POST",
        cache: false,
        data: function(d){
          	d.email = $("#filter_email").val();
            d.phone = $("#filter_phone").val();
            d.name = $("#filter_name").val();
            d.customer_id = $("#filter_customer_id").val();
            d.company_name = $("#filter_company_name").val();
            d.show_members = $("#show_members").val();
            d.customer_type = '<?= $Customer_Type ?>';
			 //d.filter_payments = $("#filter_payments").val();
			 // d.plan_id = $("#filter_subscriptions").val();
			 // d.expiredSubscription = '<?= $show_members ?>';
        }
      },
      drawCallback: function(settings){
        $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
         $("#filter_customers").find(".disable-btn").remove();
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
    
     // filter customers
     $("#filter_customers").on("submit", function(){
	     $('#customers_table').DataTable().draw();
	     return false;
     });
     
     $(document).on('click',"#customers_table tr td .hurkanSwitch", function(){
      	ChangeStatusFor($(this), 'customers');
    });
                                               
});
</script>
</body>
</html>

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
  table td:first-child{
	  display: none;
  }
  table th:last-child{
	 width: 200px; 
  }
</style>
<div id="content-main">
  <div class="row">
    <?PHP
		$this->load->view('acp_includes/response_messages');
	?>
    <div class="col-md-12">
      <h3><?=getSystemString(368)?></h3>
    </div>
    
    <div class="col-md-12">
	    <?PHP
			$this->load->view('customers/snippets/filter_customers');
		?>
    </div>
    

<div class="col-md-12">
	
  <div class="panel white" style="padding-bottom: 50px;">
	  
	<h4 class="page-title"><?=getSystemString(369)?></h4>
	<br /> 
    <table class="table table-hover" id="customers_table">
      <thead>
        <tr>
          <th class="hide">
            <?=getSystemString(149)?>
          </th>
          <th>
            <?=getSystemString(177)?>
          </th>
          <th>
            <?=getSystemString(14)?>
          </th>
          <th>
            <?=getSystemString(81)?>
          </th>
          <th>
            <?=getSystemString(206)?>
          </th>
          <th>
            <?=getSystemString(361)?>
          </th>
           <th>
            <?=getSystemString(363)?>
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
	var __confirmMsg = '<?=getSystemString(466)?>';
	var _baseController = '<?=base_url($__controller)?>';
	var _customer_id = $('#__cust_id').val();
</script>
<script>
  $(function(){
    
    // datatable initialization
    var dTable = $('#customers_table').DataTable({
      columnDefs: [
        {
          orderable: false, targets: -1 }
      ],
      select: true,
      order: [[ 0, 'desc' ]],
	    aoColumnDefs: [{
	       bSortable: false,
	       aTargets: [ 8 ] 
	    }],
      pageLength: 15,
      serverSide: true,
      ajax: {
        url: "<?=base_url($__controller.'/getCustomersList')?>",
        type: "POST",
        cache: false,
        data: function(d){
//           d.title = location.pathname.split('/').pop()
			 d.phone = $("#filter_phone").val();
			 d.name = $("#filter_name").val();
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
    
    $(document).on('click', '.status-group .change-status', function(){
	     
	     var _confirm = confirm(__confirmMsg);
	     if(!_confirm){
		     return false;
	     }
	     
	     var _self = $(this);
	     var _selfContainer = $(this).closest('.btn-group.status-group');
	     var _status = $(_self).attr('data-status');
	     var _customer_id = $(_selfContainer).attr('data-customer-id');
	     
	     var _currentClass = $(_selfContainer).find('.btn-mini').attr('data-current-class');
	     
	     // change status
	     var _data = {
		     status : _status,
		     customer_id : _customer_id
	     };
	     
	     $.post(_baseController+'/httpChangeCustomerStatus', _data, function(result){
		     var result = JSON.parse(result);
		     console.log(result);
		     if(result.result){
			     		     
			     $(_selfContainer).find('.'+_currentClass).removeClass(_currentClass);
			     
			     $(_selfContainer).find('.btn-text').text(_status);
			     if(_status == 'Pending'){
				     $(_selfContainer).find('.btn-mini').addClass('btn-warning');
				     $(_selfContainer).find('.btn-mini').attr('data-current-class', 'btn-warning')
			     }
			     
			     if(_status == 'Verified'){
				     $(_selfContainer).find('.btn-mini').addClass('btn-success');
				     $(_selfContainer).find('.btn-mini').attr('data-current-class', 'btn-success')
			     }
			     
			     if(_status == 'NotVerified'){
				     $(_selfContainer).find('.btn-mini').addClass('btn-danger');
				     $(_selfContainer).find('.btn-mini').attr('data-current-class', 'btn-danger')
			     }
			   
		     }
	     });
     });
                                               
});
</script>
</body>
</html>

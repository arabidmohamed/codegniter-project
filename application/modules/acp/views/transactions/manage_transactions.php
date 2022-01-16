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
</style>
<div id="content-main">
  <div class="row">
    <?PHP
		$this->load->view('acp_includes/response_messages');
	?>
    <div class="col-md-12">
      <h3>
	      

	  </h3>
    </div>
    
    <div class="col-md-12">
	    <?PHP
			$this->load->view('transactions/snippets/filter_transaction');
		?>
		<input type="hidden">
    </div>
    

<div class="col-md-12">
	
  <div class="panel white" style="padding-bottom: 100px;">
	  
	<h4 class="page-title">قائمة التحويلات الجديدة</h4>
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
          <th class="hide">
            <?=getSystemString(14)?>
          </th>
          <th>
            <?=getSystemString(81)?>
          </th>
          <th>
            <?=getSystemString(1)?>
          </th>
          <th>
            <?=getSystemString(206)?>
          </th>
          <th>
            <?=getSystemString('transfer_money')?>
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

</script>
</body>
</html>

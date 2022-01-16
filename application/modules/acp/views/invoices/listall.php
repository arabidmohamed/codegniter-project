<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">

	
<?PHP
$section = "SectionName_".$__lang;
$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
?>
<style>
	.panel.white{
	    min-height: 150px ;
    }
</style>
	<div id="content-main">

        <div class="row">
            <?PHP $this->load->view('acp_includes/response_messages'); ?>
        </div>

			<div class="row">
                <div class="col-md-12">
                    <h3><?=getSystemString('invoices')?></h3></div>
                    <!-- Note: used for advanced filer -->
                    <div class="col-md-12">
                    <?PHP
                        $this->load->view('invoices/snippets/filter_invoices');
                    ?>
                    </div>
                    <!-- Ends -->

					<div class="col-md-12">
			          <div class="panel white" style="padding-bottom: 50px;padding-top: 4em;">
				            <h4><?=getSystemString('invoices')?></h4>
				            <table class="table table-hover" id="invoices_table">
						         <thead>
							         <tr>
                                        <th scope="col"><?= getSystemString('invoice_number') ?></th>
								        <th scope="col"><?= getSystemString('domain_name') ?></th>
								        <th scope="col"><?= getSystemString('order_date') ?></th>
								        <th scope="col"><?= getSystemString(33) ?></th>	
                                        <th scope="col"><?= getSystemString('payment_methods') ?></th>							        
								        <th scope="col"><?= getSystemString('domain_price') ?></th>
								        <th scope="col"><?= getSystemString(72) ?></th>
								        <th scope="col"><?= getSystemString('bill') ?></th>
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
	function print_invoice(e)
    {
        _orderno = $(e).attr("data-domain-id") // will return the string "123"
        type = $(e).attr("data-type") // will return the string "123"

        url = '<?php echo base_url('acp/invoices/pdf/') ?>'+_orderno+'/'+type;

        var w = 900;
        var h = 600;
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        window.open(url,"_blank","resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width="+w+",height="+h+",left="+left+",top="+top);
    }
	
	$(function()
  {
		
	var dTable = $('#invoices_table').DataTable({
      columnDefs: [
        {
          orderable: false, targets: -1 }
      ],
      select: true,
      order: [[ 0, 'desc' ]],
	    aoColumnDefs: [{
	       bSortable: false,
	       aTargets: [ -1 ] 
	    }],
      pageLength: 15,
      serverSide: true,
      ajax: {
        url: "<?=base_url('acp/invoices/getDataList')?>",
        type: "POST",
        cache: false,
        data: function(d){
                d.phone = $("#filter_phone").val();
                d.name = $("#filter_name").val();
                d.invoice_id = $('#filter_invoice_id').val();
                d.domain = $('#filter_domain').val();
                d.order_date = $('#filter_order_date').val();
        }
      },
      drawCallback: function(settings){
        $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
         $("#filter_invoices").find(".disable-btn").remove();
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
    
     // filter invoices
     $("#filter_invoices").on("submit", function(){
	     $('#invoices_table').DataTable().draw();
	     return false;
     });
     
    });
</script>

</body>
</html>
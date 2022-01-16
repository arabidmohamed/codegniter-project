<style>
	div.dataTables_wrapper{
		max-width:  100% !important;
	}
	.panel.white{
		min-height: 50px;
	}
	.profile-pic{
		width: 40px;
		height: 40px;
		border-radius: 50%;
	}
</style>
<div id="content-main">
	<h3><?=getSystemString(527)?></h3>	
	<div class="row">
		<?PHP
			$this->load->view('acp_includes/response_messages');
		?>
	</div>
		
	<div class="row">
						
		<div class="col-md-12">
			<div class="panel white">	
				<?PHP
					$this->load->view('customers/credits/snippets/filter_credits');
				?>
			</div>
		</div>
		
		<div class="col-xs-12" style="position: relative">
			<div class="panel white">
				<h5><?=getSystemString(529)?></h5>
				<br>
				<table class="table table-hover" id="credits_table">
					  <thead>
					    <tr>
						    <th>التاريخ</th>
						    <th><?=getSystemString(377)?></th>
						    <th><?=getSystemString(81)?></th>
						    <th><?=getSystemString(1)?></th>
						    <th><?=getSystemString(539)?></th>
						    <th>مجموع التحويلات</th>
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
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script>
  
  $(function(){
		
	var dTable = $('#credits_table').DataTable({
        processing: true,
        filter:false,
        responsive: true,
        autoWidth:false,
        lengthChange: false,
        order: [[ 1, 'desc' ]],
        aoColumnDefs: [{
	       bSortable: false,
	       aTargets: [ 0, 4 ] 
	    }],
        serverSide: true,
        ajax: {
            url: "<?=base_url('datatable/getCustomerCredits')?>",
            type: "POST",
            data: function(d)
            {
	            d.name = $('#filter_name').val();
	            d.email = $('#filter_email').val();
	            d.credits = $('#filterc_c_credits').val();
	            d.limit = $('#filter_limit').val();
            }
        },
        drawCallback: function(settings){
	      $("#filter_credits").find(".disable-btn").remove(); 
        },
		language: {
           url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>'
		}
	});
                                               
     // filter pictures
     $("#filter_credits").on("submit", function(){
	     $('#credits_table').DataTable().draw();
	     return false;
     });
    
});
</script>
</body>
</html>
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
.action_buttons
{
	padding: 0px 2px;
}

</style>
<div id="content-main">
  <div class="row">
    <div class="col-md-12">
      <h3>
        <?=getSystemString('keys')?>
        <a href="<?=base_url('acp/keys/add_Key')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
          <i class="fa fa-plus">
          </i> 
          <?=getSystemString('add_key')?>
        </a>
      </h3>
    </div>

<div class="col-md-12">
	
  <div class="panel white" style="padding-bottom: 50px;">
	<br/> 
    <table class="table table-hover" id="products_table">
	    <h4><?=getSystemString('keys')?></h4>
      <thead>
        <tr>
          <th><?=getSystemString('key_name')?></th>
          <th><?=getSystemString('keys')?></th>
          <!-- <th><?=getSystemString('key_type')?></th> -->
          <th><?=getSystemString(33)?></th>
          <th><?=getSystemString(42)?></th>
        </tr>
      </thead>
      <tbody>
      	<?php foreach ($keys as $k => $key) { ?>
	    <tr>
	        <td></td>
	        <td><?php echo $key['Name_'.$__lang] ; ?> </td>
          <td><?php echo $key['key'] ; ?> </td>
          <?php $color  = ($key['is_private_key']==1) ? 'red' : 'green' ;
                $string = ($key['is_private_key']==1) ? 'Private' : 'Public' ;
           ?>
          <!-- <td style="color: <?=$color?>"><?=$string?> </td> -->
	        <td onclick="change_status('<?php echo $key['id'] ; ?>')">
            <input type="hidden" id="status<?php echo $key['id'] ; ?>" value="<?php echo $key['is_private_key']; ?>">
            <div data-toggle="hurkanSwitch" data-status="1" class="hurkanSwitch-switch-plugin" style="display: none;">
              <input data-on="true" type="radio" <?php echo ($key['is_private_key']==0) ? 'checked' : '' ; ?> name="status<?php echo $key['id'] ; ?>" class="hurkanSwitch-switch-input" >
              <input data-off="true" type="radio" <?php echo ($key['is_private_key']==1) ? 'checked' : '' ; ?> name="status<?php echo $key['id'] ; ?>" class="hurkanSwitch-switch-input  checked<?php echo $key['id'] ; ?>">
            </div>
            <div class="hurkanSwitch hurkanSwitch-switch-plugin-box" >
              <div class="hurkanSwitch-switch-box switch-animated-on">
                <a class="hurkanSwitch-switch-item active hurkanSwitch-switch-item-status-on  hurkanSwitch-switch-item-color-success" style="width:60px !important">
                            <span class="lbl"><i class="fa fa-check"></i></span>
                            <span class="hurkanSwitch-switch-cursor-selector" ></span>
                          </a>
                <a class=" hurkanSwitch-switch-item hurkanSwitch-switch-item-color- hurkanSwitch-switch-item-status-off" style="width:60px !important">
                  <span class="lbl"><i class="fa fa-times"></i>
                  </span>
                  <span class="hurkanSwitch-switch-cursor-selector" ></span>
                </a>
              </div>
            </div>
          </td>
	        <td>
            <div class="btn-group">
            <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url('acp/keys/add_key')?>/<?php echo $key['id']; ?>">
            <i class="fa fa-edit"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=getSystemString('154')?></font></font></a>
            <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <span class="fa fa-angle-down"></span>
            </button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                <!-- <li>
                  <a href="<?=base_url('acp/keys/add_key')?>/<?php echo $key['id']; ?>" style="margin: 0px 5px;" class="dropdown-item">
                    <i class="fa fa-edit"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=getSystemString('add_key')?></font></font></a>
                </li> -->
                <li>
                  <a href="<?=base_url('acp/keys/delete_Key')?>/<?php echo $key['id']; ?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
                    <i class="fa fa-trash"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> <?=getSystemString('44')?></font></font></a>
                </li>
              </ul>
          </div>
	        </td>
	    </tr>
    	<?php } ?>
      </tbody>
    </table>			          
  </div>
</div>
</div>
</div>

<?PHP
	$this->load->view('acp_includes/footer');
?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>">
</script>
<script type="text/javascript" src="<?=base_url('style/acp/js/dropzone.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>">
</script>

<!-- <script>
	var _unlink_url = '<?=base_url($__controller.'/unlinkImage')?>';
	var _post_url = '<?=base_url($__controller.'/uploadProductImages')?>';
	var _baseController = '<?=base_url($__controller)?>';
	var _placeholder = '<?=getSystemString(309)?>';
  $(function(){

    $(".select2").select2({
		theme:'bootstrap'
	});
    
    // datatable initialization
    var dTable = $('#products_table').DataTable({
      columnDefs: [
        {
          orderable: false, targets: -1 }
      ],
      select: true,
      order: [[ 0, 'desc' ]],
	    aoColumnDefs: [{
	       bSortable: false,
	       aTargets: [ 2, 4, 7, 8 ] 
	    }],
      pageLength: 15,
      serverSide: true,
      ajax: {
        url: "<?=base_url('acp/datatable/getProductsList')?>",
        type: "POST",
        cache: false,
        data: function(d){
//           d.title = location.pathname.split('/').pop()
			 d.title = $("#filter_title").val();
			 d.category = $("#filter_category").val();
			 d.subcategory = $("#filter_subcategory").val();
			 d.quantity = $("#filter_quantity").val();
			 d.quantity_limit = $("#quantity_limit").val();
			 d.unit = $("#filter_unit").val();
        }
      }
      ,
      drawCallback: function(settings){
        $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
         $("#filter_products").find(".disable-btn").remove();
        $(document).find('[data-toggle="hurkanSwitch"]').each(function(){
          $(this).hurkanSwitch({
            'on':function(r){
              alert(r);
            }
            ,
            'off':function(r){
              alert(r);
            }
            ,
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
      ,
      initComplete: function(){
        $("div.toolbar").html('<div class="dropdown">'+
                              '<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>'+
                              '<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">'+
                              '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/products_csv/")?>">Export to csv</a></li>'+
                              '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/products_excel/")?>">Export to excel</a></li>'+
                              '</ul>'+
                              '</div>');
      }
    });
                                               
     // filter products
     $("#filter_products").on("submit", function(){
	     $('#products_table').DataTable().draw();
	     return false;
     });
     
     
     $("select[name='category']").change(function(){
		var _val = $(this).val();
		var _url = _baseController+"/getSubCategoriesByCategory/"+_val;
		
		var _selector = $("select[name='subcategory']");
		
		$.get(_url, function(r){
			
			var result = JSON.parse(r);
			
			_selector.empty();
			
			var options = '<option value="">'+_placeholder+'</option>';
			for(var i = 0; i < result.length; i++)
			{
				options += '<option value="'+result[i].SubCategory_ID+'">'+result[i].SubCategory+'</option>';
			}
			
			_selector.append(options);
			_selector.closest('.form-group').removeClass('hide');
			
			$("select[name='subcategory'].select2").select2({
				theme:'bootstrap'
			});
			
		});
	});
                                               
                                               
    $(document).on("change", "input[name='cover_pic']",function()
    {
      $('table input[name="cover_pic"]').attr('disabled', 'disabled');
      var id = $(this).val();
      var pid = $(this).attr('data-pid');
      var data = {id: id, pid: pid};
      
	      $.ajax({
	        url: "<?=base_url($__controller.'/SetProductCover')?>",
	        type:"POST",
	        dataType:"JSON",
	        data: data,
	        success: function(result){
	          console.log(result);
	          $('table input[name="cover_pic"]').removeAttr('disabled', 'disabled');
	        }
	        ,
	        error: function(err, status, xhr){
	          console.log(err);
	          console.log(status);
	          console.log(xhr);
	        }
	      });
    });
    $(document).on('click',"#products_table tr td .hurkanSwitch", function(){
      ChangeStatusFor($(this), 'products');
    });
    
    $(document).on('click',"#categories_table tr td .hurkanSwitch", function(){
      ChangeStatusFor($(this), 'product_categories');
    });
    
    $('#categories_table').on('click', function(){
      ChangeOrder('categories');
    });
    
    // initializing dropzone
	initializeDropzone(_post_url, _unlink_url, $('#Class_ID').val());
});
</script> -->


  <script type="text/javascript">

    function change_status(key_id)
    {
      var new_status = '0' ;

      var old_status = $("#status"+key_id).val();

      new_status = '1';

      if(old_status=='1')
      {
        new_status = '0'; 
      }

        $.ajax({
            url: "<?=base_url('acp/keys/Change_Status')?>",
            type: "POST",
            data: {'key_id':key_id,'new_status':new_status},
            error:function(request,response)
            {
              console.log(request);
            },
            success: function(result)
            {
              $("#status"+key_id).val(new_status);

              location.reload();
            }
        });
    }

  </script>

</body>
</html>

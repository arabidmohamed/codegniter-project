<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('site/includes/header_menu');
	 $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;   ?>



    <style type="text/css">
      .table{
        border-spacing: 0 1em !important;
             border-collapse: separate;
      }
    </style>

<style>
  header{
    z-index: -1;
  }
  .intro{
    margin: auto;
  }
</style>

<!-- Header -->
  <header class="header header-sub">
    <div class="intro">
      <div class="container pb-5 ">
        <h1 class="text-center pb-2">
        <?= $this->session->userdata($this->site_session->username())  ?></h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?> </p>
      </div>
    </div>
  </header>
  <!-- End Header -->


	<div class="container dashboard">
		<div class="form-container p-lg-5 p-3">
			<div class=" ">
  <?=   $this->load->view('domain_registration/profile_navigation'); ?>
 
			    <div class="mt-5 pb-5">
			        <div id="www">

							<?PHP    if(strlen($this->session->flashdata('requestMsgSucc'))){ ?>
                                     <div class="alert alert-success">
									<strong><?php echo getSystemString($this->session->flashdata('requestMsgSucc')); ?></strong>
									</div>

                               <?php  } ?>

                               <?PHP    if(strlen($this->session->flashdata('requestMsgErr'))){ ?>
                                     <div class="alert alert-danger">
									<strong><?php echo getSystemString($this->session->flashdata('requestMsgErr')); ?></strong>
									</div>

                               <?php  } ?>

						<div class=" d-lg-flex align-items-center justify-content-between"> 
							<h1 class="color-primary mb-lg-0 mb-5"><?= getSystemString(103) ?></h1> 
							<div class="mt-lg-0 mt-3 ">
								<div class="row align-items-center">
									<div class="col-2 pt-2 text-muted"><b><?= getSystemString(135) ?></b></div><!-- /.col-2 -->
										<div class="col-10">
										<div id="custom-search-input">
											<div class="input-group">
												<input type="text" id="search" name="search" class="form-control" placeholder="<?= getSystemString('domain') ?>">
												<span class="input-group-btn">
												<button class="btn btn-search" type="button">
													<i class="fa fa-search"></i>
												</button>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div> 
						</div> 
					</div>



					<div class="domains mt-5"> 
						<table id="orders_list" style="width: 100%"  class="table">
							<thead>
								<tr>
									<th scope="col"><?= getSystemString(348) ?></th>
									<th scope="col"><?= getSystemString('domain_name') ?></th>
									<th scope="col"><?= getSystemString('order_type') ?> </th>
									<th scope="col"><?= getSystemString(33) ?></th>
									<th scope="col"><?= getSystemString(42) ?></th>
								</tr>
							</thead> 
							<tbody></tbody> 
						</table>
					</div>  
				</div>
			</div>
		</div><!-- /.container -->
	</div> 

	<div class="mt-5"></div><!-- /.mt-5 -->

  <?=   $this->load->view('site/includes/support', $website_config); ?>

<?PHP
	$this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>
<script type="text/javascript">
	$(function(){
		$("#my_orders").addClass('active');
	});
</script>


<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script>
	$(function(){


    var dTable = $('#orders_list').DataTable({
        order: false,
        lengthChange: false,
        ordering: false,
        processing: false,
        info: false,
        filter: false,
        scrollX: false,
        autoWidth:false,
        lengthMenu: [ [16, 48, 96, 192, -1], [16, 48, 96, 192, "All"] ],
        pageLength: 6,
        serverSide: true,

        dom: "<'row'<'col-sm-3 text-center'><'col-sm-9'<'toolbar'>l>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<' text-center col-sm-12'p>>",


           language: {
                url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>',
                sLengthMenu: "_MENU_"
            },
        ajax: {
            url: '<?=base_url("hd/getOrdersList")?>',
            type: "POST",
            data: function(data){
              data.search = $('#search').val();
              data._csrfToken = '<?php echo $this->security->get_csrf_hash(); ?>';
              return data;
            }

        },
        drawCallback: function(settings){
            if(settings.json.data.length == 0){
                $(".dataTables_wrapper > .row:last-child").addClass('hide');
            } else {
                $(".dataTables_wrapper > .row:last-child").removeClass('hide');
            }
            // hide pagination if less than one page

            if(settings._iRecordsTotal <= 11){
                $(".dataTables_wrapper .dataTables_paginate").addClass('hide');
            } else {
                $(".dataTables_wrapper .dataTables_paginate").removeClass('hide');
            }
        }
    });


    $(".btn-search").on("click", function(){
        $('#orders_list').DataTable().draw();
        return false;
    });

});
</script>




<?PHP
    $__lang = $this->session->userdata($this->site_session->__lang_h());
    $this->load->view('site/includes/header_menu');
     $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;   ?>

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
        <?= $this->session->userdata($this->site_session->username())  ?> </h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?> </p>
      </div>
    </div>
  </header>
  <!-- End Header -->

<style type="text/css">
  .wpwl-control {
    direction: ltr;
}

.select2-selection__rendered {
  line-height: 48px !important;
}

.select2-selection {
  height: 48px !important;
}

  	.table{
    		border-spacing: 0 1em !important;
             border-collapse: separate;
    	}

</style>



	<div class="container dashboard">
		<div class="form-container p-lg-5 p-3">
			<div class=" ">
				<?=$this->load->view('domain_registration/profile_navigation'); ?>
			    <hr class="d-md-none">
			    <div class="mt-5 pb-5">
			        <div id="support">
						<div class="d-lg-flex align-items-center justify-content-between"> 
							<h1 class="color-primary mb-lg-0 mb-5"><?= getSystemString('my_consulting') ?></h1> 
							<div class="mt-lg-0 mt-3 row">
								<div class="col-md-8">
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
								<div class="col-md-4">
									<a href="<?=base_url($__controller.'/new_ticket')?>" class="btn btn-block mt-md-0 mt-3 btn-primary-inverse"><?= getSystemString('add_new_ticket') ?></a><!-- /.btn btn-primary-inverse -->
								</div>
							</div> 
						</div> 
						
		        		<div class="domains my-5">
						<div >
						<?php echo $this->load->view('includes/response_messages'); ?>
							<table id="tickets_list" class=" table">
								<thead>
								    <tr>
								        <th scope="col"><?= getSystemString('177') ?></th>
								        <th scope="col"><?= getSystemString('151') ?></th>
								        <th scope="col"><?= getSystemString('33') ?></th>
								        <th scope="col"><?= getSystemString('Action') ?></th>
								    </tr>
								</thead>
								<tbody>

								</tbody>
							</table>
		        			</div>
		        		</div><!-- /.domains -->
						<!-- <nav aria-label="Page navigation example">
						    <ul class="pagination justify-content-center">
						        <li class="page-item active"><a class="page-link" href="#">1</a></li>
						        <li class="page-item"><a class="page-link" href="#">2</a></li>
						        <li class="page-item"><a class="page-link" href="#">3</a></li>
						    </ul>
						</nav> -->


				<div class="row hide">
					<div class="col-lg-12">
						<nav >
							<ul class="pagination justify-content-center">
							  <?php if ( $current_page > 1 ) { ?>
							  <li class="page-item"><a class="page-link" href="<?=base_url('/cu/support/').$pre_page?>"> <i class="fas fa-angle-right"></i> </a></li>
							  <?php } ?>
							  <?php  for ( $x = 1 ; $x <= $pages_count ; $x++) { ?>
							  <li class="page-item <?php if ( $current_page == $x ) { echo 'active'; } ?> "><a class="page-link" href="<?=base_url('/cu/support/').$x?>"><?=$x?></a></li>
							  <?php } ?>
							  <?php if ( $current_page != $pages_count ) { ?>
							  <li class="page-item"><a class="page-link" href="<?=base_url('/cu/support/').$next_page?>"> <i class="fas fa-angle-left"></i> </a></li>
							  <?php } ?>
							</ul>
						  </nav>
					</div>
				</div>


			        </div>
			    </div>
			</div><!-- /.container -->
		</div>
	</div><!-- /.form-container -->

	<?PHP
	$this->load->view('site/includes/footer', $website_config);
	$this->load->view('site/includes/custom_scripts_footer');
	?>

<script type="text/javascript">

    $(document).ready(function (){
      $(".select2").select2({ });
});
    if ( document.documentElement.lang.toLowerCase() === "ar" ) {
  var wpwlOptions = {
    locale: "ar",
        style: "plain",
        paymentTarget: '_top',

    }   }


    if ( document.documentElement.lang.toLowerCase() === "en" ) {
  var wpwlOptions = {
    locale: "en",
        style: "plain",
        paymentTarget: '_top',

    }   }




</script>

<script type="text/javascript">
	$(function(){
		$("#support").addClass('active');
	});
</script>

<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script>
	$(function(){


    var dTable = $('#tickets_list').DataTable({
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
       // "paging": false,

         dom: "<'row'<'col-sm-3 text-center'><'col-sm-9'<'toolbar'>l>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<' text-center col-sm-12'p>>",


         language: {
                url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>',
                sLengthMenu: "_MENU_"
            },


        ajax: {
            url: '<?=base_url("hd/getTicketsList")?>',
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
        $('#tickets_list').DataTable().draw();
        return false;
    });

});
</script>

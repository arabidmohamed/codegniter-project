
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
    .cbp-panel{
        width: 100%;
        max-width: auto;
        margin: 0 auto;
        font-family: "Roboto Condensed", sans-serif !important;
    }
    .cbp-popup-lightbox-title{
        display: none;
    }
    .cbp-l-filters-buttonCenter .cbp-filter-item.cbp-filter-item-active {
        background-color: #3f444a;
        color: #fff !important;
        border: 1px solid #3f444a;
    }
    .cbp-l-filters-work .cbp-filter-item:hover, .cbp-l-filters-button .cbp-filter-item:hover, .cbp-l-filters-buttonCenter .cbp-filter-item:hover {
        background-color: #3f444a;
        color: #fff;
    }
    .cbp-popup-wrap.cbp-popup-lightbox.cbp-popup-transitionend.cbp-popup-ready{
        z-index: 9999;
    }
    #cover{
	    background-image: url('../../../style/site/img/cover.jpg');
	    background-position: center;
	    background-repeat: no-repeat;
	    background-size: cover;
	    height: 300px;
    }
    .breadcrumb{
	    margin-top: 10em;
    }
    #project_d{
	    margin-top: -14em;
	    background: white;
	    border-radius: 2px;
	    padding-top: 5em;
    }
    #project_d .rowD div{
	    padding: 1em 2em;
    }
    #project_d .rowV div{
	    margin-bottom: 10px;
    }
    .fa-file-pdf-o{
	    font-size: 10em;
    }
    .embed-responsive{
	    margin: 5px;
    }
    .rowV img{
	    width: 100%;
    }
</style>
<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');

    $title = 'Title_'.$__lang;
    $desc = 'Description_'.$__lang;
    //print_r($projectD);
?>

<!-- BEGIN: PAGE CONTAINER -->
<div class="c-layout-page">
	<div class="container-fluid breadcrumb-div" id="cover" style="background-image: url(../../../content/sections_bg/<?=$projectD->Section_BG_Image?>) !important;">
		<ol class="container breadcrumb">
			<li><a href="<?php echo site_url('');?>"><?PHP echo getSystemString(218);?></a></li>
			<li class="active"><?PHP echo getSystemString(661);?></li>
		</ol>
		<h3 class="text-center" style="color: <?=$projectD->Section_Text_Clr?>;font-size: x-large;padding: 1em"><?=getSystemString(661)?></h3>
	</div>
	<div class="c-content-box c-size-md">
		<div class="c-content-tile-grid c-bs-grid-reset-space" data-auto-height="true">
			
			<div class="container" id="project_d" style="background: <?=$projectD->Section_BG_Clr?> !important">
				<div class="row rowD">
					<div class="col-md-6">
						<h3><?=$projectD->$title?></h3>
						<p><?=$projectD->$desc?></p>
					</div>
					<div class="col-md-4">
						<div class="row">
							<h3><?=getSystemString('duration')?></h3>
							<li class="fa fa-date"><?=getSystemString('from_date'). ' ' .$projectD->From_Date?></li>
							<li class="fa fa-date"><?=getSystemString('to_date'). ' ' .$projectD->To_Date?></li>
						</div>	
						<div class="row">
							<h3><?=getSystemString(371)?></h3>
							<li class="fa fa-date"><?=$projectD->Address?></li>
						</div>			
					</div>
					<div class="col-md-2 text-right">
						<?php
							$hide = '';
							if($projectD->PDF_File == NULL)
							{
								$hide = 'hide';
							}
						?>
						<a href="<?=base_url('content/projects/pdf_files/'.$projectD->PDF_File)?>" target="_blank" class="<?=$hide?>">
							<li class="fa fa-file-pdf-o"></li>
						</a>
						<p class="<?=$hide?>"><?=getSystemString('downlaod_pdf')?></p>
					</div>
				</div>
				<hr>
				<div class="row rowV">
					<div class="col-md-12">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
					    <!-- Indicators -->
					    <ol class="carousel-indicators">
					      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					      <li data-target="#myCarousel" data-slide-to="1"></li>
					      <li data-target="#myCarousel" data-slide-to="2"></li>
					    </ol>
					
					    <!-- Wrapper for slides -->
					    <div class="carousel-inner" style="height: 500px;">
						    <?php
							    $i = 0;
							    foreach($projectD->Details as $row):
							    $active = $i == 0 ? 'active' : '';
						    ?>
					      <div class="item <?=$active?>">
					        <img src="<?=base_url('content/projects/'.$row->Pictures)?>" alt="Project-Details" style="width:100%;">
					      </div>
					      <?php $i++; endforeach; ?>
					    </div>
					
					    <!-- Left and right controls -->
					    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
					      <span class="glyphicon glyphicon-chevron-left"></span>
					      <span class="sr-only">Previous</span>
					    </a>
					    <a class="right carousel-control" href="#myCarousel" data-slide="next">
					      <span class="glyphicon glyphicon-chevron-right"></span>
					      <span class="sr-only">Next</span>
					    </a>
					  </div>						
<!-- 						<img src="<?=base_url('content/projects/').$projectD->Pictures?>" class="img-responsive"> -->
					</div>
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="embed-responsive embed-responsive-16by9">
							  <iframe class="embed-responsive-item" src="<?=$projectD->Video_Link1?>?rel=0" allowfullscreen></iframe>
							</div>
						</div>	
						<div class="col-md-6">
							<div class="embed-responsive embed-responsive-16by9">
							  <iframe class="embed-responsive-item" src="<?=$projectD->Video_Link2?>?rel=0" allowfullscreen></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?PHP
	$this->load->view('includes/footer', $website_config);
    $this->load->view('includes/custom_scripts_footer');
?>


<?PHP
	$this->load->view('includes/analytics');
?>
    <script>
        $("#nav_ul, #slidemenu").find("li:nth-child(5) a").addClass('active');
    </script>
  </body>
</html>
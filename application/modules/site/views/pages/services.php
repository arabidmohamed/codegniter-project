<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');
?>
	<!-- BEGIN: PAGE CONTAINER -->
	
<!-- BEGIN: PAGE CONTAINER -->
	<div class="c-layout-page">
			<div class="container-fluid breadcrumb-div">
				<ol class="container breadcrumb">
					<li><a href="<?php echo site_url('');?>"><?PHP echo getSystemString(218);?></a></li>
					<li class="active"><?PHP echo getSystemString(92);?></li>
				</ol>
			</div>
			<div class="c-content-box c-size-md">
                <div class="c-content-tile-grid c-bs-grid-reset-space" data-auto-height="true">
                    <div class="c-content-title-1">
                        <h3 class="c-font-uppercase c-font-bold text-center" style="font-size: 1.2em">
                            <?PHP echo getSystemString(92);?>
                        </h3>
                        <div class="c-line-center"></div>
                    </div>
                    <div class="container">
                        <div class="row wow animate fadeInUp">
                            <?php $count=0;  ?>
                            <?php foreach($website_data['services'] as $row): ?>
                            <?php $count++;?>
                            <?php if($count %2 == 1 ):?>
                            <div class="col-md-12">
                                <div class="c-content-tile-1 c-bg-blue-3">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="c-tile-content c-content-overlay">
                                                <div class="c-overlay-wrapper">
                                                    <div class="c-overlay-content">
                                                        <a href="<?=site_url("services/{$row->Service_ID}")?>" data-lightbox="fancybox" data-fancybox-group="gallery-4">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="c-image c-overlay-object" data-height="height" style="background-image: url(<?=base_url("content/services/{$row->Icon}")?>)"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="c-tile-content c-content-v-center " data-height="height" style="background: #f4f8f9;">
                                                <div class="c-wrapper">
                                                    <div class="c-body c-center news-title">
                                                        <h3 class="c-tile-title ">
                                                            <?php
                                                                $Title___ = "Title_".$__lang;
                                                                echo $row->{$Title___};
                                                            ?>
                                                        </h3>
                                                        <p>
                                                            <?php
                                                                $Content___ = "Content_".$__lang;
                                                                echo $row->{$Content___};
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else:?>
                            <div class="col-md-12">
                                <div class="c-content-tile-1 c-bg-green">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="c-tile-content c-content-v-center" data-height="height" style="background: #f4f8f9;">
                                                <div class="c-wrapper">
                                                    <div class="c-body c-center news-title">
                                                        <h3 class="c-tile-title ">
                                                            <?php
                                                                $Title___ = "Title_".$__lang;
                                                                echo $row->{$Title___};
                                                            ?>
                                                        </h3>
                                                        <p>
                                                            <?php
                                                                $Content___ = "Content_".$__lang;
                                                                echo $row->{$Content___};
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="c-tile-content  c-content-overlay" >
                                                <div class="c-overlay-wrapper">
                                                    <div class="c-overlay-content">
                                                        <a href="<?=site_url("services/{$row->Service_ID}")?>" data-lightbox="fancybox" data-fancybox-group="gallery-4">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="c-image c-overlay-object" data-height="height" style="background-image: url(<?=base_url("content/services/{$row->Icon}")?>)"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php endforeach;?>         
                        </div>
                    </div>
                </div>
            </div>



</div><!-- -layout-page -->			
	<!-- BEGIN: CONTENT/CONTACT/FEEDBACK-1 -->


<?PHP
	$this->load->view('includes/footer', $website_config);
	$this->load->view('includes/custom_scripts_footer');
	$this->load->view('includes/analytics');
?>
  </body>
</html>
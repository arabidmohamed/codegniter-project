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
        <?= $this->session->userdata($this->site_session->username())  ?>  </h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?>
 </p>
      </div>
    </div>
  </header>
  <!-- End Header -->

	<div class="container dashboard">
		<div class="form-container p-lg-5 p-3">
            	<div class=" ">
  <?=   $this->load->view('domain_registration/profile_navigation'); ?>

			    <hr class="d-md-none">
	    <div class="mt-5 pb-5">
              <div id="orders">
                        <div class="row no-gutters align-items-center">
                            <div class="col-md-7">
                                <h3 class="color-primary py-4 14em">
																		<?= getSystemString('domain_transfer_in_log') ?>
                                </h3>
                            </div><!-- /.col-6 -->
                            <div class="col-md-5 text-right">
                                <a href="<?= base_url('transfer_domain_in_request') ?>" class="btn btn-outline-primary bt-small"><?= getSystemString('domain_transfer_in') ?></a><!-- /.btn btn-outline-primary -->
                            </div><!-- /.col-6 -->
                        </div><!-- /.row no-gutters -->
                        <p class="text-muted py-3">
                        <?= getSystemString('domain_transfer_in_note') ?>
                        </p><!-- /.text-muted -->
                <div class="domains mt-5">
              <table class="table transfer-table">
                <thead>
                    <tr>
                        <th scope="col"><?= getSystemString('domain') ?></th>
                        <th scope="col"><?= getSystemString(33) ?></th>
                    </tr>
                </thead>
                <tbody>

            <?php foreach ($requests as $key => $request) { ?>
                    <tr>
                        <td scope="row"><?= $request->DTI_Domain_Name_Query ?></td>
                        <td>
                          <?= getSystemString($request->DTI_Status)   ?>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    <tr class="spacer"></tr>

                <?php } ?>


                </tbody>
              </table>
                </div><!-- /.domains -->

              </div>
          </div>
			</div><!-- /.container -->
		</div>
	</div><!-- /.form-container -->

	<div class="mt-5"></div><!-- /.mt-5 -->

  <?=   $this->load->view('site/includes/support', $website_config); ?>

<?PHP
	$this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>

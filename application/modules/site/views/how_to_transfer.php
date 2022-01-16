
<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');
    // $sectionName = 'SectionName_'.$__lang;
    // $sectionSub = 'Subtitle_'.$__lang;
    $lang_title = 'Title_'.$__lang;
    $lang_content = 'Content_'.$__lang;


?>
<style>
  svg{
    width: 100%;
    height: 100%;
  }
</style>
    <!-- Header -->
    <header class="header header-sub">
      <div class="container">
        <div class="header-box text-lg-left text-center">
          <h1 class="title mb-4"><?=getSystemString('transfer_a_domain')?></h1>
          <nav class="breadcrumb">
            <a class="breadcrumb-item" href="<?=base_url('')?>"><?=getSystemString('218')?></a>
            <a class="breadcrumb-item active" href="<?=base_url('transfer')?>"><?=getSystemString('transfer_a_domain')?></a>
          </nav>
        </div>
      </div>
    </header>

  <section class=" ">
			<div class="container">
				<div class="investment-box">
					<h2 class="title"><?=getSystemString('domain_transfer_steps')?></h2>
                    <p class="info"><?=getSystemString('domain_transfer_steps_note')?>:</p>

                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/DR_h1ySQhts" allowfullscreen></iframe>
                    </div>

					<ul class="nav steps-register">
						<li>
							<h5 class="title"><?=getSystemString('domain_transfer_steps_1')?></h5>
							<p class="info"><?=getSystemString('domain_transfer_steps_note_1')?></p>
						</li>
						<li>
							<h5 class="title"><?=getSystemString('domain_transfer_steps_2')?></h5>
							<p class="info"><?=getSystemString('domain_transfer_steps_note_2')?></p>
						</li>
						<li>
							<h5 class="title"><?=getSystemString('domain_transfer_steps_3')?></h5>
							<p class="info"><?=getSystemString('domain_transfer_steps_note_3')?></p>
						</li>
                        <li>
							<h5 class="title"><?=getSystemString('domain_transfer_steps_4')?></h5>
							<p class="info"><?=getSystemString('domain_transfer_steps_note_4')?></p>
						</li>
                        <li>
							<h5 class="title"><?=getSystemString('domain_transfer_steps_5')?></h5>
							<p class="info"><?=getSystemString('domain_transfer_steps_note_5')?></p>
						</li>
                        <li>
							<h5 class="title"><?=getSystemString('domain_transfer_steps_6')?></h5>
							<p class="info"><?=getSystemString('domain_transfer_steps_note_6')?></p>
						</li>
                        <li>
							<h5 class="title"><?=getSystemString('domain_transfer_steps_7')?></h5>
							<p class="info"><?=getSystemString('domain_transfer_steps_note_7')?></p>
						</li>
                        <li>
							<h5 class="title"><?=getSystemString('domain_transfer_steps_8')?></h5>
							<p class="info"><?=getSystemString('domain_transfer_steps_note_8')?></p>
						</li>
					</ul>

                    <div class="investment-box text-center">
					    <a href="<?=base_url('transfer_domain_in')?>" class="btn btn-outline-primary px-5"><?=getSystemString('start_transferring_domain_now')?></a>
				    </div>
				</div>
			</div>
	</section>

  <?=   $this->load->view('site/includes/support', $website_config); ?>




<?PHP
$this->load->view('includes/footer', $website_config);
$this->load->view('includes/analytics');
?>

<script>
	$(function()
	{
	    var current = location.pathname;
	    //console.log(current)
	    $('#nav li a').each(function(){
	        var $this = $(this);
	        // if the current path is like this link, make it active
	        if($this.attr('href').indexOf(current) !== -1){
		        $('#nav .actives').removeClass('actives');
	            $this.addClass('active');
	        }
	    })
	})
</script>


</body>
</html>

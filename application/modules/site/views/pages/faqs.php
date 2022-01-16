
<?PHP
/* load header contents #menu */
$__lang = $this->session->userdata($this->site_session->__lang_h());
$this->load->view('includes/header_menu');

$page_details_title = 'Page_title_'.$__lang;
$content = 'Content_'.$__lang;
$description = 'Page_Description_'.$__lang;

 $title = 'Title_'.$__lang;
    $desc = 'Answer_'.$__lang;


?>
<!-- Note: used for FAQ on Google search -->
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [{
        "@type": "Question",
        "name": "How to register a Saudi domain?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "<ol>
<li>From the top menu click on <a href=https://dnet.sa/domains>Domains</a>.</li>
<li>Make sure the domain you want is available, if so then sign up for an account on the website.</li>
<li>After signing up, fill up the form and attach the necessary documents.</li>
<li>You will have to wait for the administrator to approve your email and phone number.</li>
<li>The payment process will take less than 24 hours to be approved in case of these domains (com.sa, .sa, net.sa, .pub.sa ). On the other hand the following domains will require approval from the Saudi network information center (.sch.sa, .med.sa, .org.sa, .edu.sa).</li>
</ol>"
        }
      }, {
        "@type": "Question",
        "name": "How long it takes to reserve a new Saudi domain?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "After attaching the right documents, it takes less than 24 hours to confirm the reservation of a new domain."
        }
      }, {
        "@type": "Question",
        "name": "How much is the price of a Saudi domain?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "The price is 99 SAR per year. <a href=https://dnet.sa/domains>Click to check the price list</a>"
        }
      }, {
        "@type": "Question",
        "name": "How can I control or manage my Saudi domain?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "You can manage a saudi domain from your account in 'my domain' page after the domain's status is active."
        }
      }, {
        "@type": "Question",
        "name": "How can I transfer a Saudi domain?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text":"You only need these few steps to move your domain to DNet from <a href=https://nic.sa>NIC</a> or (any other registrar) by following the steps:<ul>
<li>First go to nic.sa and choose the domain you want to move using (send auth code) button.</li>
<li>Next, you should&nbsp;fill the application and agree to the terms, and a message will be sent to the administrative phone and email.</li>
<li>Open your email and click on the link attached, insert the code sent to your phone and agree to the terms to see the auth code.</li>
<li>After registering in (dnet.sa) click on (start transferring your domain now) button.</li>
<li>Insert the code in the auth code field and type the domain.</li>
<li>Confirm application and agree to the terms.</li>
<li>You will receive a message on your phone and&nbsp;to&nbsp;the administrative email to confirm.</li>
<li>Pay domain renew fees for one year to complete the process within a maximum of 5 days.</li>
</ul>"
          }
        }]
    }
</script>
<!-- Ends -->
<style>
  header{
    z-index: 0;
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
        <?=getSystemString('faq')?> </h1>
        <p class="text-center mb-4">
        <?=getSystemString(218)?> /
        <?=getSystemString('faq')?> </p>
      </div>
    </div>
  </header>
  <!-- End Header -->
  
	<div class="container position-relative"> 
		<div class="row"> 
			<div class="col-12">
				<div class="accordion faqs-accordion form-container p-lg-5 p-3 " id="faqs">
					<?php $x = 1; foreach ( $faqs as $faq ) { ?>
					<div class="card border-bottom" id="faq_<?= $x ?>">
						<div class="card-header bg-transparent px-0" id="heading<?= $x ?>"> 
							<button class="btn btn-link btn-block text-left text-dark collapsed" type="button" onclick="getHash('faq_<?= $x ?>')" data-toggle="collapse" data-target="#collapse<?= $x ?>" aria-expanded="true" aria-controls="collapse<?= $x ?>">
								<h3 class="mb-0"><?=$faq->$title?></h3>
							</button> 
						</div>
						<div id="collapse<?= $x ?>" class="collapse  <?php if ( $x == 1 ) { echo 'show'; } ?>" aria-labelledby="heading<?= $x ?>" data-parent="#faqs">
							<div class="card-body px-0"> <?=$faq->$desc?> </div>
						</div>
					</div>
					<?php $x++; } ?>
				</div>
			</div> 
		</div>
	</div> 


    <div class="mt-5"></div><!-- /.mt-5 -->
    <div id="main" class="main" data-aos="fade-up" data-aos-duration="700">

  <?=   $this->load->view('site/includes/support', $website_config); ?>


    </div>



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

<script>  
	var id = window.location.hash;
	if(id){
		$(id+" .collapse").collapse("show");  
		$("html, body").animate({ scrollTop: $(id).offset().top - 300 }, 1000);
	}
	 
	function getHash(faq_id){
		window.location.hash = faq_id; 
		$("html, body").animate({ scrollTop: $('#'+faq_id).offset().top - 300 }, 1000);
	}
</script>

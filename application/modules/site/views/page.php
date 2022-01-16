
<?PHP
/* load header contents #menu */
$__lang = $this->session->userdata($this->site_session->__lang_h());
$this->load->view('includes/header_menu');

$page_details_title = 'Page_title_'.$__lang;
$content = 'Content_'.$__lang;
$description = 'Page_Description_'.$__lang;




?>

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
        <?=$page_details->$page_details_title;?> </h1>
        <p class="text-center mb-4">
        <?=$page_details->$description;?> </p>
      </div>
    </div>
  </header>
  <!-- End Header -->

            <div id="main" class="main" data-aos="fade-up" data-aos-duration="700">



        <div class="search-results-container mt-5 mb-5">
            <div class="search-result container">
                
                <div class="other-results">

                       <div class="about-info-content">
                                <?=$page_details->$content?>
                      </div> 
                   
                </div><!-- /.other-results -->
            </div><!-- /.container -->
        </div><!-- /.search-results -->


  <?=   $this->load->view('site/includes/support', $website_config); ?>
       

    </div><!-- /#main.main -->



<?PHP
$this->load->view('includes/footer', $website_config);
$this->load->view('includes/analytics');
?>
<script>
     $("#nav_ul").find("li:nth-child(2) a").addClass('active');
</script>

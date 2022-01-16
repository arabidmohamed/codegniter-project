
<?PHP
    /* load header contents #menu */
    $__lang = $this->session->userdata($this->site_session->__lang_h());
    $this->load->view('includes/header_menu');

    $title = 'Title_'.$__lang;
    $unit = 'UnitName_'.$__lang;
    $category = 'Category_'.$__lang;
    $subcategory = 'SubCategory_'.$__lang;
    $desc = 'Description_'.$__lang;
    $tags = 'Tags_'.$__lang;
    $lang_content = 'Content_'.$__lang;
    $UnitName = 'UnitName_'.$__lang;
?>



    
  <header class="header-page">
      <div class="container"> 
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?=base_url('')?>"><?=getSystemString(218)?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=getSystemString(135)?></li>
          </ol>
        </nav> 

        <div class="category-title">
          <h2 class="title selected_category"><?=getSystemString('search_result').' - '.$domain_name?></h2>
        </div>

      </div>
    </header>
    
    <section class="category-product">
      <div class="container">
        <div class="row">

          
          <div class="col-lg-12"> 
            <div class="tab-content"> 


                <div class="row appended_products"> 

              <?php 
                
               foreach($products as $product){                          
                        


                               //get discount info
            $discount_info = getDiscountAmount($product->CategoriesDiscount,$product->ProdutsDiscount,$product->prices[0]->Price,$product->prices[0]->Minimum_Sale_Amount);
            $discount_amount = $discount_info['discount_amount'];
            $discount_value = $discount_info['discount_value'];
            $discount_unit = $discount_info['discount_unit'];
                
                        $Class_ID = $product->Class_ID;
                        $details_url = base_url("products/{$product->Category_ID}/{$product->Class_ID}");
                        $img_url = base_url($GLOBALS['img_product_dir'].$product->Pictures_Orginal);
               
                             ?>
             
                      <div class="col-md-3 col-sm-6"> 
                        <a href="<?=$details_url?>" class="product-box">
                            <div class="product-box-pic">
                                <?php   if($discount_value !=''){  ?>
                            <span class="discount">‏<?= $discount_value.$discount_unit.' '.getSystemString('discount') ?></span>
                                <?php } ?>
                                <img src="<?=$img_url?>" alt="product-box-pic">
                            </div>
                            <div class="product-box-content">
                                <h4 class="title"><?=$product->$title?></h4>
                                <p class="description"><?= shorten_string($product->$lang_content,10); ?></p>      
                            <h4 class="price"><?= $product->prices[0]->Price - $discount_amount.' '.getSystemString(480) ?> 
                            <?php if($discount_amount > 0){ ?> 
                                <span class="old-price"><?= $product->prices[0]->Price.' '.getSystemString(480) ?></span>
                            <?php } ?>
                            </h4>                                                  
                               <p class="mb-0 text-muted"><?= getSystemString('Pricing').' '.getSystemString('per').$product->prices[0]->$UnitName ?></p>
                            </div>
                        </a>
                    </div>
                <?php } ?>
 
				<?php if (empty($products)) { ?>
                      <p class="details"><?= getSystemString('no_result') ?></p> 
                 <?php } ?>              
                </div>

                <div class="text-center py-4">
                  <a href="#!" class="btn btn-success p-3 px-5 loadMoreBtn"> <?= getSystemString('display_more') ?> </a>
                </div>

              </div>                          
   
            </div>
          </div>
        </div>
      </div> 
    </section> 





<script>
     $("#nav_ul").find("li:nth-child(5)").addClass('active');

    var page = 2;
    $(document).ready(function () {




 $("body").on('click','.loadMoreBtn',function(e){

var domain_name = "<?= $domain_name; ?>";


           $.ajax({
                data:  {domain_name:domain_name,page:page},
                type: "POST",
                dataType: "JSON",
                url: "<?php echo base_url('loadMoreProductsGallery');?>",
                success: function (response) {
                  $('.appended_products').last().append(response.result); 
                  page = page + 1;                 
                }
            });

      });


  });



</script>

<?PHP
    $this->load->view('includes/footer', $website_config);
    //$this->load->view('includes/custom_scripts_footer');
?>

<?PHP
    // $this->load->view('includes/analytics');
?>
</body>
</html>

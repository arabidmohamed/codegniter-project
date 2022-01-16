
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
    
?>



  
    <!-- Start Header -->
    <header class="header" style="background-image: url(<?=base_url('style/site/assets/img/bg-store.png');?>)">
      <div class="container">
        <div class="header-box">
          <h1 class="title"> <?= getSystemString('store') ?> </h1> 
        </div>
      </div>
    </header> 
    <!-- End Header -->
    
    <!-- Start Products -->
    <section class="products" id="products-section">  
      <div class="container">   

        <div class="row">
          <div class="col-lg-3">
            <div class="card product-category"> 
              <h4 class="title">
                <span><?= getSystemString('products categories');  ?></span> 
                <a href="#category-collapse" data-toggle="collapse" class="btn btn-light d-lg-none d-inline-block px-3"> <i class="fas fa-bars"></i></a>
              </h4>
              <div class="collapse about-collapse no-sticky" id="category-collapse">
                <ul class="nav category-box-list flex-column">

              <?php  foreach ($all_categories as $key =>  $category_row) { ?> 
               <?php if($key==0 && empty($category_id)  || $category_row->Category_ID == $category_id){  ?> 
                  <li class="nav-item">
                    <a class="nav-link active" href="#category-tab-<?= $category_row->Category_ID ?>" data-toggle="tab">  <?= $category_row->$category ?></a>
                  </li>
                <?php }else{ ?>
         

                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('categories').'/'.$category_row->Category_ID ?>" >  <?= $category_row->$category ?></a>
                  </li>

                    <?php } ?>
               <?php } ?>
                </ul> 
              </div>
              
              <h4 class="title">
                <span><?= getSystemString('weight2') ?></span> 
                <a href="#wieght-collapse" data-toggle="collapse" class="btn btn-light d-lg-none d-inline-block px-3"> <i class="fas fa-bars"></i></a>
              </h4>
              <div class="collapse category-box-list about-collapse no-sticky" id="wieght-collapse">
                <ul class="nav flex-column">

                  <?php  foreach ($all_categories as $category_row) { ?> 
                    <?php   foreach ($category_row->SubCategories as $key => $subcategory_row) { 

                      ?>  
                       <?php if($category_row->Category_ID == $category_id){  ?>
                  <li class="nav-item">
                    <a class="nav-link active-page <?= ($key==0) ?'active':'' ?>" href="#category-tab-<?= $category_row->Category_ID ?>-<?= $subcategory_row[$key]->SubCategory_ID ?>" data-categoryid="<?= $category_row->Category_ID ?>" data-subcategoryid="<?= $subcategory_row[$key]->SubCategory_ID ?>" data-toggle="tab">‏<?= $subcategory_row[$key]->$subcategory ?></a>
                  </li>
                  <?php }
                        }
                   } ?>

                      
            
                </ul>
              </div> 
            </div>
          </div>
          <div class="col-lg-9">
            <div class="tab-content">
             

<?php  foreach ($all_categories as $category_row) {  
              if($category_row->ProductsCount > 0){
              
         foreach ($category_row->SubCategories as $key => $subcategory_row) {   
                      if($category_row->Category_ID == $category_id){ // make select only to category and subcategories 

                        $products_categories    = $this->products->Get_ProductGalleryByCategoriesAndSubCategoryies($category_row->Category_ID,$subcategory_row[$key]->SubCategory_ID,9,0,$price_type);
          ?>

              <div class="tab-pane fade <?= (($subcategory_row[$key]->SubCategory_ID == $subcategory_id)&&($category_row->Category_ID == $category_id))?'active show':($key==0)?'active show':'' ?>" id="category-tab-<?= $category_row->Category_ID ?>-<?= $subcategory_row[$key]->SubCategory_ID ?>"> 


                <div class="row appended_products<?= $category_row->Category_ID ?>-<?= $subcategory_row[$key]->SubCategory_ID ?>">

             <?php 
                
                       foreach($products_categories as $product){                          
                                

            //get discount info
            $discount_info = getDiscountAmount($product->CategoriesDiscount,$product->ProdutsDiscount,$product->prices[0]->Price,$product->prices[0]->Minimum_Sale_Amount);
            $discount_amount = $discount_info['discount_amount'];
            $discount_value = $discount_info['discount_value'];
            $discount_unit = $discount_info['discount_unit'];

                                $Class_ID = $product->Class_ID;
                                $details_url = base_url("products/{$product->Category_ID}/{$product->Class_ID}");
                                $img_url = base_url($GLOBALS['img_product_dir'].$product->Pictures_Orginal);
                       
                                     ?>

                  <div class="col-md-4 col-sm-6">
                    <a href="<?=$details_url?>" class="product-box">
                      <div class="product-box-pic">
                        <img src="<?=$img_url?>" alt="product-box-pic">
                      </div>  
                      <div class="product-box-content">
                        <h3 class="title"><?=$product->$title?></h3>
                        <h2 class="price">‏<?= $product->prices[0]->Price - $discount_amount.' '.getSystemString(480) ?> </h2>  
                        <p class="add-cart">
                          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                          </svg>
                          إضافة الى السلة
                        </p>
                      </div>
                    </a>  
                  </div>


                <?php } ?>

                </div>
                
                <div class="row justify-content-center">
                  <div class="col-md-4 col-sm-6">
                    <a href="#!" class="btn btn-primary btn-ripple btn-block loadMoreBtn" id="loadMoreBtn<?= $category_row->Category_ID ?>-<?= $subcategory_row[$key]->SubCategory_ID ?>"> <?= getSystemString('display_more') ?></a>
                  </div>
                </div>

     


              </div>
         <?php }
          }
        }
              } ?>
   
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Products -->



<script>
     $("#nav_ul").find("li:nth-child(5)").addClass('active');

    var page = 1;
    $(document).ready(function () {


      $('input[id^="category-"]').click(function (e) {

var arr = [];
$('input.category-products:checkbox:checked').each(function () {
    arr.push($(this).val());
});

           $.ajax({
                data:  {category_id:arr},
                type: "POST",
                dataType: "JSON",
                url: "<?php echo base_url('productsGalleryCustome');?>",
                success: function (response) {
                  //console.log(response.result);
                  $('.appended_products').html(response.result);  
                  page = 1;                
                }
            });



      });


// $("body").on('click','.category_btn',function(e){
//            let selected_cat = $(this).find('span:first').text();
//           $('.selected_category').html(selected_cat);
// });






  $("body").on('click','.loadMoreBtn',function(e){



  var  categoryid = ($('.active-page.active').data('categoryid'));
   var subcategoryid = ($('.active-page.active').data('subcategoryid'));


           $.ajax({
                data:  {category_id:categoryid,subcategory_id:subcategoryid,page:page},
                type: "POST",
                dataType: "JSON",
                url: "<?php echo base_url('loadMoreProductsByCategoryAndSubCategory');?>",
                success: function (response) {

              
                  $('.appended_products'+categoryid+'-'+subcategoryid).last().append(response.result); 
                  page = page + 1; 


                  if(response.disable ==1 || response.status === false)
                    $('#loadMoreBtn'+categoryid+'-'+subcategoryid).css('display','none');
                    else
                    $('#loadMoreBtn'+categoryid+'-'+subcategoryid).css('display','block');
                
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

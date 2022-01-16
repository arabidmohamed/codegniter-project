
<?PHP
    /* load header contents #menu */
    $__lang = $this->session->userdata($this->site_session->__lang_h());
    $this->load->view('includes/header_menu');

    $title = 'Title_'.$__lang;
    $category = 'Category_'.$__lang;
    $subcategory = 'SubCategory_'.$__lang;
    $desc = 'Description_'.$__lang;
    $tags = 'Tags_'.$__lang;
    $UnitName = 'UnitName_'.$__lang;
    $width = 'Width_'.$__lang;
    $content = 'Content_'.$__lang;

     $can_make_order = checkIfExceedMaximumDailyOrders();
?>





        <!-- Start Header -->
    <header class="header header-sm" style="background-image: url(<?=base_url('style/site/assets/img/bg-store.png');?>)">
      <div class="container">
        <div class="header-box"> 
          <nav class="breadcrumb mt-0">
            <a class="breadcrumb-item" href="<?=base_url('')?>"> <?=getSystemString(218)?></a> 
            <a class="breadcrumb-item" href="<?= base_url('categories') ?>"> <?= getSystemString('store') ?> </a> 
            <a class="breadcrumb-item" href="<?= base_url('categories/').$product->Category_ID.'/'.$product->SubCategory_ID ?>"> <?=  $product->$category ?></a> 
            <span class="breadcrumb-item active"> <?=  $product->$title ?></span>
          </nav>
        </div>
      </div>
    </header> 
    <!-- End Header -->





    <!-- Start Products -->
    <section class="products" id="products-section">  
      <div class="container">    
        <div class="row"> 
          <div class="col-lg-7"> 
            <div class="product-view-content">
              <h2 class="title"><?=  $product->$title ?></h2>


                 
              <h4 class="price"><?= $product->prices[0]->Price - $discount_amount .' '.getSystemString(480) ?></h4>
     

                

              <p class="details">     <?= $product->$content ?></p>
<?php   if($website_data['web_settings'][0]->Ecommerce_Status && $can_make_order){  ?> 
              <form class="form mt-4" action="#!" id="add-cart" method="post">
                <div class="form-row p-0 align-items-end">
                  <div class="quantity mr-3">
                    <label><?= getSystemString(327) ?> </label>
                    <input required min="1" id="qty" name="qty" type="number"  max="" class="qty qty-custom form-control" value="1" required>
                         <small style="color: red;" class="text-help" id="qtyErrorMsg"></small>
                  </div>
                  <a href=""  data-productid="<?=$product->Class_ID?>" class="add-to-cart btn btn-primary btn-ripple mr-3"><?= getSystemString(293) ?></a>
                </div>
              </form>
            <?php } ?>


            </div> 
          </div> 
          <div class="col-lg-5"> 
            <div class="product-box-pic">
              <div class="tab-content">

      <?PHP 

            if(!empty($product->ProductDetails)){
             foreach($product->ProductDetails as $row):  
                if($row->Is_Cover==1){
              ?>

                <div class="tab-pane fade show active" id="product-pic-<?= $row->PD_ID ?>">
                  <div class="product-details-large">
                    <img class="product-zoom" alt="" src="<?=base_url($GLOBALS['img_product_dir'].$row->Pictures)?>">    
                  </div>
                </div>

                     <?php }else{ ?>


                <div class="tab-pane fade" id="product-pic-<?= $row->PD_ID ?>">
                  <div class="product-details-large">
                    <img class="product-zoom" alt="" src="<?=base_url($GLOBALS['img_product_dir'].$row->Pictures)?>">    
                  </div>
                </div>


                     <?PHP } 
          endforeach; 

        }?>



              </div> 
              <div class="product-thumbnail nav nav-tabs">

          <?PHP  

if(!empty($product->ProductDetails)){
          foreach($product->ProductDetails as $row):  

                if($row->Is_Cover==1){
              ?>
                        <a class="product-single__thumbnail nav-link active" data-toggle="tab" href="#product-pic-<?= $row->PD_ID ?>">
                              <img class="img-fluid active" src="<?=base_url($GLOBALS['img_product_dir'].$row->Pictures)?>" data-toggle="tab" href="#product-pic-<?= $row->PD_ID ?>" role="tab" aria-selected="false">
                         </a>
                      
                <?php }else{ ?>
                           <a class="product-single__thumbnail nav-link" data-toggle="tab" href="#product-pic-<?= $row->PD_ID ?>">
                              <img class="product-single__thumbnail nav-link" src="<?=base_url($GLOBALS['img_product_dir'].$row->Pictures)?>" data-toggle="tab" href="#product-pic-<?= $row->PD_ID ?>" role="tab" aria-selected="true">
                        </a>
                        
            <?PHP } 
          endforeach;

          }else{ ?>
                        <a class="product-single__thumbnail nav-link" data-toggle="tab" href="#product-pic-<?= $row->PD_ID ?>">
                              <img class="product-single__thumbnail nav-link active" src="<?=base_url($GLOBALS['img_product_dir'].'default.png')?>" data-toggle="tab" href="#product-pic-<?= $row->PD_ID ?>" role="tab" aria-selected="false">
                         </a>
                    

          <?php } ?>






              </div>
            </div> 
          </div> 
        </div>
       
   <input type="hidden" id="priceperunitid" value="<?= $product->prices[0]->PricePerUnit_ID ?>" >
        <div class="row"> 
          <div class="col-lg-12"> 
            <div class="product-box-content"> 
              <h4 class="price mb-4"><?= getSystemString('details') ?></h4>
              <p class="details"><?= $product->$desc ?></p>
               
            </div> 
          </div> 
        </div> 
      </div>
    </section>
    <!-- End Products -->

    


    <!-- Modal -->
    <div class="modal fade modal-cart" id="modal-product-cart" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content"> 
          <div class="modal-header">
            <h6 class="modal-title"><?=  getSystemString('add_cart_msg'); ?></h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="add2cart()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="dropdown-menu-cart py-3"> 
            <?php $image =  !empty($product->ProductDetailsCover[0]->Pictures)?$product->ProductDetailsCover[0]->Pictures:'default.png'; ?>  
              <table class="table product-cart"> 
                <tr>
                  <td>
                    <div class="product-pic product-pic-sm">
                      <img src="<?=base_url($GLOBALS['img_product_dir'].$image)?>" alt="product-pic ">
                    </div>
                  </td>
                  <td class="p-2"> 
                    <p class="product-name"><b> <?=  $product->$title ?> </b></p>
                    <p class="product-price"><?= ($product->prices[0]->Price) .' '.getSystemString(480) ?></p>
                  </td>
          <!--         <td class="text-right"> <a href="#!" class="trash"> &times;</a></td> -->
                </tr>


                                  <!--         <tr>
                                            <td colspan="2"> <p> <?= getSystemString('sub total') ?></p> </td> 
                                            <th class="text-right"><?= $this->cart->total().' '.getSystemString(480) ?></h6></th>
                                        </tr> -->
 
              </table> 
              <div class="dropdown-product-footer">
                <a href="<?=base_url('cartDetails')?>" class="btn btn-primary"><?=getSystemString('view_cart')?></a> 
              </div> 
            </div>
          </div> 
        </div>
      </div>
    </div>










  <?PHP if(count($relatedProducts) > 0): ?>
    <!-- Start Products -->
    <section class="products" id="products-section">  
      <div class="container">  
        
        <div class="row">
          <div class="col-12">
            <div class="title-section title-section-flex">
              <h2 class="title"> <?= getSystemString('found_in_another'); ?> </h2>
              <a href="<?= base_url('categories/').$relatedProducts[0]->Category_ID  ?>" class="btn btn-outline-primary"><?= getSystemString('Browse all products') ?></a>
            </div>  
          </div>  
        </div> 



             

   <div class="row">
         <?PHP
                            //print_r($relatedProducts);
                      foreach($relatedProducts as $p):


                                $Class_ID = $p->Class_ID;
                                if($product->Class_ID != $Class_ID){                      
                                    $details_url = base_url("products/{$p->Category_ID}/{$p->Class_ID}");
                          $img_url = base_url($GLOBALS['img_product_dir'].$p->Pictures);
                          $subCatID   = $p->SubCategory_ID;
                          $default = '';
                                if($rp->Thumbnail == NULL)
                              {
                                $default = 'imgplaceholder';
                              }
                         ?>

     
          <div class="col-lg-3 col-md-4 col-sm-6">
            <a href="<?= $details_url ?>" class="product-box">
              <div class="product-box-pic">
                <img src="<?=$img_url?>" alt="product-box-pic">
              </div>  
              <div class="product-box-content">
                <h3 class="title"><?=$p->$title?></h3>
                <h2 class="price">‏<?= $p->prices[0]->Price.' '.getSystemString(480) ?> </h2>  
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
        
       <?PHP
                      }
                        endforeach;
                        ?>


</div> 
      </div>
    </section>
    <!-- End Products -->


   <?PHP
                   endif;
                   ?> 



















<?PHP
    $this->load->view('includes/footer', $website_config);
    $this->load->view('includes/custom_scripts_footer');
?>

<?PHP
    $this->load->view('includes/analytics');
?>


<script type="text/javascript" src="<?=base_url('style/site/js/utilities/utilities.js')?>"></script>
<script type="text/javascript" src="<?=base_url('style/site/js/pagescripts/site.js?v=2.1')?>"></script>

		<script type="text/javascript" src="<?=base_url('style/site/js/jquery.zoom.min.js')?>"></script>  
<script>

			$('.zoom').zoom();

$(function(){

 $(".alert-success").hide();
  let _priceperunitid = $('#priceperunitid').val();
  if(!_priceperunitid)
      _priceperunitid = $('.option-box  .active').find('input[name=width]').data('priceperunitid');
   
    var available_stock =JSON.parse('<?php echo json_encode($available_stock); ?>');
    $("#qty").prop('max',available_stock[_priceperunitid]);



          if(available_stock[_priceperunitid] <= 1){
                  $("#qtyErrorMsg").text("<?= getSystemString('No_Stock') ?>");
                  $('.add-to-cart').prop('disabled', true);
               
          }















// $("#modal-product-cart").on("hidden.bs.modal", function () {
//       location.reload();
// });







var globalTimeout = null;  





//per other unites
      $('.qty-custom').bind("keyup change",function(e){
          e.preventDefault(); 

           if (globalTimeout != null) {
              clearTimeout(globalTimeout);
            }


          let qty = $('.qty-custom').val() || 1;
          if(qty == 0 )qty = 1;
              
          let unit_price = $('#product_price').val();
          let total_price = 0;

            globalTimeout = setTimeout(function() {
    globalTimeout = null; 

                         $.ajax({
                                url: base_url('getAvailableStock'),// Utilities.functions.getBaseUrl() + "getAvailableStock",
                                type: "POST",
                                dataType: "JSON",
                                data: {Class_ID:'<?= $product->Class_ID   ?>'},
                                success: function(data) {                          
                                 available_stock = data.result;
                                 $("#qty").prop('max',available_stock[_priceperunitid]);        
                                }
                            });
      

          if(qty >= available_stock[_priceperunitid]){
                  $('#qty').val(available_stock[_priceperunitid]);
                  $("#qtyErrorMsg").text("<?= getSystemString('No_Stock') ?>");
                  $('.add-to-cart').prop('disabled', true);
                  return false;
          }else{
             $("#qtyErrorMsg").text("");
            $('.add-to-cart').prop('disabled', false);
          }

          total_price =   (qty * unit_price).toFixed(2);
          total_price = total_price + ' <?= getSystemString(480) ?>';
          $('.total_meters').val(qty).change();


          $('#total_price').html(total_price);

             }, 200); 
    });



    







});




    $(document).on('click', '.add-to-cart', function(e){
            e.preventDefault();
            var _self = $(this);
            DWebsite.App.addProductToCart(_self);
        });


    
    
</script>




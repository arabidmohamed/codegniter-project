        <!--   <div class="row"> -->

               <?PHP 



$__lang = $this->session->userdata($this->site_session->__lang_h());
               
$lang_title = 'Title_'.$__lang;
$lang_content = 'Content_'.$__lang;
$lang_desc = 'Description_'.$__lang;
$caption = 'Slide_Caption_'.$__lang;
$c_name = 'Category_'.$__lang;
$title__ = "Title_".$__lang;
$UnitName = 'UnitName_'.$__lang;
               $i=0;
                        foreach($products_categories as $product):                           
                     
                                //get discount info
            $discount_info = getDiscountAmount($product->CategoriesDiscount,$product->ProdutsDiscount,$product->prices[0]->Price,$product->prices[0]->Minimum_Sale_Amount);
            $discount_amount = $discount_info['discount_amount'];
            $discount_value = $discount_info['discount_value'];
            $discount_unit = $discount_info['discount_unit'];


                                $Class_ID = $product->Class_ID;
                                $details_url = base_url("products/{$product->scSlug}/{$product->Slug}");
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
                                <h4 class="title"><?=$product->$title__?></h4>
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

               <?php 
             endforeach; ?>


       <!--      </div> -->

         <!--    <div class="row justify-content-center">
              <div class="col-lg-4 col-sm-6 col-6"> 
                <a type="button" class="btn btn-primary btn-block btn-more loadMoreBtn">  <?=getSystemString('display_more')?> </a> 
              </div>
            </div> -->
            <a href="#!" class="nav-item nav-link px-4" data-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17.727" height="24" viewBox="0 0 17.727 24"><g transform="translate(-66.909 0)"><g transform="translate(66.909 7.091)"><g transform="translate(0)"><path d="M83.818,151.273H67.727a.818.818,0,0,0-.818.818v13.636a2.457,2.457,0,0,0,2.455,2.455H82.182a2.457,2.457,0,0,0,2.455-2.455V152.091A.818.818,0,0,0,83.818,151.273ZM83,165.728a.819.819,0,0,1-.818.818H69.364a.819.819,0,0,1-.818-.818V152.909H83Z" transform="translate(-66.909 -151.273)"/></g></g><g transform="translate(71 0)"><g transform="translate(0 0)"><path d="M159.091,0a4.915,4.915,0,0,0-4.909,4.909v6.818a.818.818,0,1,0,1.636,0V4.909a3.273,3.273,0,0,1,6.545,0v6.818a.818.818,0,1,0,1.636,0V4.909A4.915,4.915,0,0,0,159.091,0Z" transform="translate(-154.182 0)"/></g></g></g></svg>
                            <span class="badge <?= $show_cart ?>"><?= count($shoppingCartItems) ?></span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-cart dropdown-menu-right"> 
                            <div class="dropdown-item-header">
                                <h6 class="mb-0"> <?= getSystemString('items_number') ?> </h6> 
                                <p class="mb-0"><?=count($shoppingCartItems).' '.getSystemString('order') ?> </p> 
        
                            </div>

             

                            <div class="dropdown-item-footer">
                                <table class="table product-cart">

                   <?php if(count($shoppingCartItems) > 0){ $i=0; 
                        foreach($shoppingCartItems as $item):
                            $exOptions = $item['options'];                     
                    ?>

                                     <tr>
                                        <td>
                                            <div class="product-pic product-pic-sm">
                                                <img src="<?=base_url($GLOBALS['img_product_dir'].$exOptions['img'])?>" alt="product-pic ">
                                            </div>
                                        </td>
                                        <td> <p class="product-name">  <?=$item[ 'name']?></p></td>
                                        <td class="text-right"><h6 class="product-price"><?=$item['price'].' '.getSystemString(480)?></h6></td>
                                    </tr>


                                 <?PHP
                       $i++; endforeach;
                    ?>


                                          <tr>
                                            <td colspan="2"> <h6> <?= getSystemString('sub total') ?></h6> </td> 
                                            <td class="text-right"><h6 class="product-price"><?= $this->cart->total().' '.getSystemString(480) ?></h6></td>
                                        </tr>

                <?php } ?>

                         
                                 <tr class="cartEmpty <?= (count($shoppingCartItems) > 0)?'hide':''; ?>"> 
                                            <td>
                                                <h6><?=getSystemString('Cart Is Empty')?></h6>
                                            </td>
                                            <td><b></b></td>
                                        </tr>

             
                                </table>
                            </div>
                            <div class="dropdown-item-footer <?= (count($shoppingCartItems) > 0)?'':'hide'; ?>">
                                <a href="<?=base_url('cartDetails')?>" class="btn btn-light btn-ripple <?= $show_cart ?>"><?=getSystemString('view_cart')?></a>

                        <?PHP
                            $customer_id = $this->session->userdata($this->site_session->userid());
                            $targeturl = '';
                            if($customer_id=='')
                                     {
                                        // $current_url = current_url();
                                        // $this->session->set_userdata('intended_url', $current_url);
                                        $targeturl = base_url('login');
                                    }else{
                                        $targeturl = base_url('hyperpay/process_checkout');   
                                    }
                         ?>


                            <form method="post" action="<?=$targeturl?>" style="display: inline-block;">
                                    <input type="hidden" name="is_guest" value="1">
                                <button type="submit" class="btn btn-primary btn-ripple <?= $show_cart ?>"><?=getSystemString('checkout')?></button>
                            </form>

                              </div> 
                            </div>
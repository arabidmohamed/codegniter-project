
      <div class="col-lg-3"> 

                  <div class="card profile-sidebar mb-4 mb-lg-0">
              <div class="card-body"> 
                <div class="profile-user text-lg-center text-left">
                  <div class="profile-user-pic">

                                <?php if($customer[0]->Original_Img !=''){ ?>
                  <img src="<?= base_url($GLOBALS['img_customers_dir'].$customer[0]->Original_Img)?>" alt="">
                  <?php }else{ ?>
                  <img src="<?=base_url('style/site/assets/img/user-pic.svg');?>" alt="">
                        <?php } ?>


                    <img src="<?=base_url('style/site/assets/img/user-pic.svg');?>" alt="">
                  </div>
                  <h5 class="user-name"><?=$this->session->userdata($this->site_session->username())?></h5>
                  <a href="#accordionExample" data-toggle="collapse" class="btn btn-light d-lg-none d-inline-block px-3"> <i class="fas fa-bars"></i></a>
                </div>
                
                <div class="profile-list mt-4 collapse about-collapse" id="accordionExample">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a href="<?=base_url('profile')?>" class="nav-link" id="profile">
                        <span class="mr-3">
                          <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                          </svg>
                        </span>
                        <span>     <?=getSystemString('edit_profile')?></span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?=base_url('my_orders')?>" id='orders_history' class="nav-link ">
                        <span class="mr-3">
                          <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-cart3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                          </svg>
                        </span>
                        <span> <?= getSystemString('My orders') ?></span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?=base_url('cu/support')?>" id='support' class="nav-link">
                        <span class="mr-3"> 
                          <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-basket2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 1 1 2 0v2a1 1 0 0 1-2 0v-2z"/>
                            <path fill-rule="evenodd" d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-.623l-1.844 6.456a.75.75 0 0 1-.722.544H3.69a.75.75 0 0 1-.722-.544L1.123 8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.163 8l1.714 6h8.246l1.714-6H2.163z"/>
                          </svg>
                        </span>
                         <?=getSystemString('my_consulting')?><?php if($this->allOpenTicketsNum>0){ ?> <span class="profile-menu-count"><?= $this->allOpenTicketsNum  ?></span> <?php } ?>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?=base_url('logout')?>" class="nav-link">
                        <span class="mr-3">
                          <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-box-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                          </svg>
                        </span>
                        <span><?= getSystemString(89) ?></span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>



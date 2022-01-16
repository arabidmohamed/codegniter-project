						<div id="editNSForm" class="col-12 has-loader hideall">




                             <?php   $server_ips = json_decode($domain_details->Server_ips);?>

                                       <div  id="box_server_1">
                                            <div class="row no-gutters  details">
                                                <div class="col-md-2 mb-3">
                                                    <span class="text-status"><?= getSystemString('primary_server') ?></span>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                          <input  dir="ltr"  class="server_1" id="domain_name_server"  value="<?php if ($domain_details->Primary_Server){ echo $domain_details->Primary_Server; } else { echo 'ns1.dnetns.com';}?>" type="text" name="primary_server"  placeholder="ns1.hostingname.com" data-parsley-trigger="change" required data-parsley-required-message="<?=getSystemString('required')?>" data-parsley-pattern="(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]"
                                                      data-parsley-pattern-message="<?= getSystemString('nameserver_check_error') ?>">
                                                        <div class="col-md-12 server_host_check" style="color:#B94A48;"></div>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                            <div class="row no-gutters  ip_domain <?= (empty($server_ips[0]))?'d-none':'' ?>">
                                                <div class="col-md-2 mb-3">
                                                    <span class="text-status">Ip</span>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <input  dir="ltr" type="text" value="<?= $server_ips[0] ?>" name="server_ips[]" placeholder="10.0.0.138" >
                                                       <div class="col-md-12 ip_check_msg" style="color:#B94A48;"></div>
                                                    
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                        </div>





                                    <div id="box_server_2">
                                            <div class="row no-gutters  details">
                                                <div class="col-md-2 mb-3">
                                                    <span class="text-status"><?= getSystemString('secondary_server') ?></span>
                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-6 mb-3">
                                                            <input   dir="ltr" class="server_2" id="domain_name_server"  value="<?php if ($domain_details->Secondery_Server){ echo $domain_details->Secondery_Server; } else { echo 'ns2.dnetns.com';}?>" type="text"  name="secondary_server" placeholder="ns2.hostingname.com" required  data-parsley-trigger="change" data-parsley-pattern="(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]" data-parsley-notequalto="#primary_server" data-parsley-notequalto-message="<?= getSystemString('not_equal') ?>"
                                                          data-parsley-required-message="<?= getSystemString('required') ?>" data-parsley-pattern-message="<?= getSystemString('nameserver_check_error') ?>"
                                                          >
                                                <div class="col-md-12 server_host_check" style="color:#B94A48;"></div>

                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                            <div class="row no-gutters  ip_domain <?= (empty($server_ips[1]))?'d-none':'' ?>">
                                                <div class="col-md-2 mb-3">
                                                    <span class="text-status">Ip</span>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                   <input dir="ltr" type="text" value="<?= $server_ips[1] ?>" name="server_ips[]" placeholder="10.0.0.138"  >
                                                       <div class="col-md-12 ip_check_msg" style="color:#B94A48;"></div>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                        </div>

                                        <div class="othre-server">
                                            <?php
                                                $secondary_servers = json_decode($domain_details->Secondary_Servers);
                                                $i = 3;
                                                foreach ($secondary_servers as $key => $server) {
                                             ?>

                                            <div id="box_server_<?= $i ?>">
                                                <div class="row no-gutters  details">
                                                    <div class="col-md-2 mb-3">
                                                        <span class="text-status"><?=getSystemString('secondary_server')?></span>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <input  dir="ltr" type="text" value="<?= $server->name_server ?>"   name="secondary_servers[]"  id="domain_name_server" placeholder="ns<?= $i ?>.hostingname.com" required data-parsley-pattern="(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]" data-parsley-required-message="<?= getSystemString('required') ?>" data-parsley-pattern-message="<?= getSystemString('nameserver_check_error') ?>">
                                                         <div class="col-md-12 server_host_check" style="color:#B94A48;"></div>
                                                      </div>
                                                        <div class="col-md-1 text-center mb-3">
                                                            <button type="button" onclick="remove_server(<?= $i ?>)" class="btn btn-danger"> &times;</button>
                                                        </div>
                                                    </div>

                                                    <div class="row no-gutters ip_domain <?= (empty($server->ip))?'d-none':''?> ">
                                                        <div class="col-md-2 mb-3">
                                                            <span class="text-status">Ip</span>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                          <input dir="ltr" type="text" value="<?= $server->ip ?>" name="secondary_servers_ips[]" placeholder="10.0.0.138"   >
                                                               <div class="col-md-12 ip_check_msg" style="color:#B94A48;"></div>
                                                          </div>
                                                    </div>

                                            </div>

                                        <?php $i++;} ?>
                                        </div>

                                        <div class="row no-gutters  add_server_btn">
                                            <div class="col-md-2 "></div>

                                            <div class="col-md-4">
                                                <button type="button" onclick="add_server()" class="btn btn-primary-inverse"><?=getSystemString('add_new_server')?></button>
                                            </div>
                                            <div class="col-md-4 text-right">
                                            	<button type="button" class="btn btn-primary-inverse saveFormData saveNSData" data-parent="editNSForm">
												<?=getSystemString('save_update')?>
					    			             </button>
                                   <div class="col-md-12 add_server_res"></div>
                                            </div>


                                        </div>






					        <div class="form-loader-container">
					        	<div class="spinner-border text-success" role="status">
									<span class="sr-only">Loading...</span>
								</div>
							</div><!-- /.loader-container -->

					    </div><!-- /#editNSForm -->


				
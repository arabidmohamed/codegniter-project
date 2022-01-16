<hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('server_names') ?></h6>
                                        <?php   $server_ips = json_decode($domain->Server_ips); ?>

                                       <div  id="box_server_1">
                                            <div class="row no-gutters  details">
                                                <div class="col-lg-2 col-md-3 mb-3">
                                                    <label class="title-label mb-md-0 mb-4"><?= getSystemString('primary_server') ?></label>
                                                </div>
                                                <div class="col-md-9 mb-3">
                                                     <input dir="ltr" onblur="get_ip(this.value, this.id)"  id="domain_name_server"  value="<?php if ($domain->Primary_Server){ echo $domain->Primary_Server; } else { echo 'ns1.dnetns.com';}?>" type="text" name="primary_server"  placeholder="ns1.hostingname.com" data-parsley-trigger="change" required data-parsley-required-message="<?=getSystemString('required')?>" data-parsley-pattern="(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]"
                                                      data-parsley-pattern-message="<?= getSystemString('nameserver_check_error') ?>">
                                                   
                                                       <div class="col-md-12 server_host_check" style="color:#B94A48;"></div>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>

                                            <div class="row no-gutters ip_domain <?= (empty($server_ips[0]))?'d-none':'' ?>">
                                                <div class="col-lg-2 col-md-3 mb-3">
                                                    <span class="title-label mb-md-0 mb-4">Ip</span>
                                                </div>
                                                <div class="col-md-9 mb-3">
                                                    <input dir="ltr" type="text" value="<?= $server_ips[0] ?>" name="server_ips[]" placeholder="10.0.0.138"  data-parsley-trigger="change" data-parsely-pattern="(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]" <?= (!empty($server_ips[0]))?'required':'' ?> data-parsley-trigger="keyup"  data-parsley-required-message="<?= getSystemString('required') ?>" data-parsley-pattern-message="<?= getSystemString('nameserver_check_error') ?>">
                                                <div class="col-md-12 ip_check_msg" style="color:#B94A48;"></div>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                        </div>

										<div id="box_server_2">
                                            <div class="row no-gutters  details">
                                                <div class="col-lg-2 col-md-3 mb-3">
                                                    <label class="title-label mb-md-0 mb-4"><?= getSystemString('secondary_server') ?></label>
                                                </div>
                                                <div class="col-md-9 mb-3">
                                                        <input  dir="ltr" onblur="get_ip(this.value, this.id)"  id="domain_name_server"  value="<?php if ($domain->Secondery_Server){ echo $domain->Secondery_Server; } else { echo 'ns2.dnetns.com';}?>" type="text"  name="secondary_server" placeholder="ns2.hostingname.com" required  data-parsley-trigger="change" data-parsley-pattern="(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]" data-parsley-notequalto="#primary_server" data-parsley-notequalto-message="<?= getSystemString('not_equal') ?>"
                                                          data-parsley-required-message="<?= getSystemString('required') ?>" data-parsley-pattern-message="<?= getSystemString('nameserver_check_error') ?>"
                                                          >
                                             
                                                  <div class="col-md-12 server_host_check" style="color:#B94A48;"></div>

                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                            <div class="row no-gutters ip_domain <?= (empty($server_ips[1]))?'d-none':'' ?>">
                                                <div class="col-lg-2 col-md-3 mb-3">
                                                    <span class="title-label mb-md-0 mb-4">Ip</span>
                                                </div>
                                                <div class="col-md-9 mb-3">
                                                    <input dir="ltr" type="text" value="<?= $server_ips[1] ?>" name="server_ips[]" placeholder="10.0.0.138"   data-parsely-pattern="(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]"  <?= (!empty($server_ips[1]))?'required':'' ?> data-parsley-trigger="change"  data-parsley-required-message="<?= getSystemString('required') ?>" data-parsley-pattern-message="<?= getSystemString('nameserver_check_error') ?>">
                                                <div class="col-md-12 ip_check_msg" style="color:#B94A48;"></div>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                        </div>

                                        <div class="othre-server">
                                            <?php
                                                $secondary_servers = json_decode($domain->Secondary_Servers);
                                                $i = 3;
                                                foreach ($secondary_servers as $key => $server) {
                                             ?>

                                            <div id="box_server_<?= $i ?>">
                                                <div class="row no-gutters align-items-center justify-content-center details">
                                                    <div class="col-lg-2 col-md-3 mb-3">
                                                        <label class="title-label mb-md-0 mb-4"><?= getSystemString('secondary_server') ?></label>
                                                    </div>
                                                    <div class="col-md-9 mb-3">
                                                        <input dir="ltr"   type="text" value="<?= $server->name_server ?>"  onblur="get_ip(this.value, this.id)" name="secondary_servers[]" id="domain_name_server" placeholder="ns<?= $i ?>.hostingname.com" required data-parsley-pattern="(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]"  data-parsley-trigger="change" data-parsley-required-message="<?= getSystemString('required') ?>" data-parsley-pattern-message="<?= getSystemString('nameserver_check_error') ?>">
                                                     <div class="col-md-12 server_host_check" style="color:#B94A48;"></div>
                                                    </div>

                                                        <div class="col-md-1 text-center mb-3"   >
                                                            <button type="button" onclick="remove_server(<?= $i ?>)" class="btn btn-danger"> &times;</button>
                                                        </div>
                                                    </div>

                                                    <div class="row no-gutters ip_domain <?= (empty($server->ip))?'d-none':''?> ">
                                                        <div class="col-lg-2 col-md-3 mb-3">
                                                            <span class="title-label mb-md-0 mb-4">Ip</span>
                                                        </div>
                                                        <div class="col-md-9 mb-3">
                                                            <input dir="ltr" type="text" value="<?= $server->ip ?>" name="secondary_servers_ips[]" placeholder="10.0.0.138"   data-parsely-pattern="(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]"  <?= (!empty($server->ip))?'required':'' ?> data-parsley-trigger="keyup"   data-parsley-required-message="<?= getSystemString('required') ?>" data-parsley-pattern-message="<?= getSystemString('nameserver_check_error') ?>">
                                                            <div class="col-md-12 ip_check_msg" style="color:#B94A48;"></div>
                                                        </div>
                                                    </div>

                                            </div>

                                        <?php $i++;} ?>
                                        </div>

                                        <div class="row no-gutters add_server_btn">
                                            <div class="col-md-8 offset-md-2">
                                                <button type="button" onclick="add_server()" class="btn btn-primary-inverse"><?=getSystemString('add_new_server')?></button>
                                            </div>
                                        </div>


                             <?php
                             $__lang = 'ar';

                 $domain_org = json_decode($domain->Registrant_Data);
                 ?>
                                        <h6 class="form-title"><?= getSystemString('entity_information') ?></h6>
                                        <div class="row no-gutters details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('activity_type') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= GetConstantById($domain->Org_Activity_ID,$__lang) ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('entity_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_org->Full_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain_org->User_Address1 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('second_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain_org->User_Address2 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(234) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?=  GetCountryById($domain_org->User_Country_ID,$__lang) ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                    <div class="hide">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('region') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain_org->User_Region ?>
                                                 </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                    </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(202) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_org->User_City ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                    <div class="hide">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('post_code') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_org->User_Post_Code ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                    </div>
                                        </div>

    <?php if(!empty($domain->Admin_Data)){ $domain_admin = json_decode($domain->Admin_Data); ?>

                                        <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('admin_officer') ?></h6>
                                        <div class="row no-gutters details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(81) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_admin->Full_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                    <div class="hide">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('employer_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_admin->Employer_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('job_title') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_admin->User_Job_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                    </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_admin->User_Address1 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_admin->User_Address2 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(234) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= GetCountryById($domain_admin->User_Country_ID,$__lang) ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                        <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('region') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_admin->User_Region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(202) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_admin->User_City ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        <div class="hide">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('post_code') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_admin->User_Post_Code ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                             <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>

                                        <div class="hide">
                                           
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(137) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_admin->User_Phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>


                                            
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(206) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text"  dir="ltr">
                                                    <?= '+'.$domain_admin->Mobile_Key.$domain_admin->User_Mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('fax') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_admin->User_Fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(1) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" style="font-weight: bold;">
                                                    <?= $domain_admin->User_Email ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
    <?php } ?>

            <?php  $domain_tech = json_decode($domain->Tech_Data);  if(!empty($domain_tech)){  ?>

                                        <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('technical_responsible') ?></h6>
                                        <div class="row no-gutters details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(81) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_tech->Full_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                        <div class="hide">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('employer_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_tech->Employer_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('job_title') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_tech->User_Job_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_tech->User_Address1 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_tech->User_Address2 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(234) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">

                                                     <?= GetCountryById($domain_tech->User_Country_ID,$__lang) ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('region') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_tech->User_Region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(202) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_tech->User_City ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('post_code') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_tech->User_Post_Code ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(137) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_tech->User_Phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(206) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" dir="ltr">
                                                    <?= '+'.$domain_tech->Mobile_Key.$domain_tech->User_Mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('fax') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_tech->User_Fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(1) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" style="font-weight: bold;">
                                                    <?= $domain_tech->User_Email ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
    <?php } ?>

            <?php  $domain_billing = json_decode($domain->Billing_Data);  if(!empty($domain_billing)){  ?>


                                        <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('financial_officer') ?></h6>
                                        <div class="row no-gutters details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(81) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_billing->Full_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('employer_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_billing->Employer_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('job_title') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_billing->User_Job_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_billing->User_Address1 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_billing->User_Address2 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(234) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain_billing->$country ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('region') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_billing->User_Region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(202) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_billing->User_City ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('post_code') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_billing->User_Post_Code ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(137) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_billing->User_Phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(206) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" dir="ltr">
                                                    <?= '+'.$domain_billing->Mobile_Key.$domain_billing->User_Mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('fax') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_billing->User_Fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(1) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" style="font-weight: bold;">
                                                    <?= $domain_billing->User_Email ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
    <?php } ?>





 <?php
                 $domain_name_servers_Data = json_decode($domain->Name_Servers_Data);

                 ?>


                                       <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('server_names') ?></h6>





  <?php   $server_ips = json_decode($domain_name_servers_Data->Server_ips);?>

                                       <div  id="box_server_1">
                                            <div class="row no-gutters details">
                                                <div class="col-md-3 mb-3">
                                                    <label class="title-label mb-md-0 mb-4 "><?= getSystemString('primary_server') ?></label>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                  <?= $domain_name_servers_Data->Primary_Server ?>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                            <div class="row no-gutters ip_domain <?= (empty($server_ips[0]))?'d-none':'' ?>">
                                                <div class="col-md-3 mb-3">
                                                    <label class="title-label mb-md-0 mb-4 ">Ip</label>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                   <?= $server_ips[0] ?>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                        </div>





                                    <div id="box_server_2">
                                            <div class="row no-gutters details">
                                                <div class="col-md-3 mb-3">
                                                    <label class="title-label mb-md-0 mb-4 "><?= getSystemString('secondary_server') ?></label>
                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-7 mb-3">
                                                   <?= $domain_name_servers_Data->Secondery_Server ?>

                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                            <div class="row no-gutters ip_domain <?= (empty($server_ips[1]))?'d-none':'' ?>">
                                                <div class="col-md-3 mb-3">
                                                    <label class="title-label mb-md-0 mb-4 ">Ip</label>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                   <?= $server_ips[1] ?>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                        </div>

                          
                                            <?php
                                                $secondary_servers = json_decode($domain_name_servers_Data->Secondary_Servers);
                                                $i = 3;
                                                foreach ($secondary_servers as $key => $server) {
                                             ?>

                    

                                  
                                            <div class="row no-gutters details">
                                                <div class="col-md-3 mb-3">
                                                    <label class="title-label mb-md-0 mb-4 "><?= getSystemString('secondary_server') ?></label>
                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-7 mb-3">
                                                 <?= $server->name_server ?>

                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                            <div class="row no-gutters ip_domain <?= (empty( $server->ip))?'d-none':'' ?>">
                                                <div class="col-md-3 mb-3">
                                                    <label class="title-label mb-md-0 mb-4 ">Ip</label>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                  <?= $server->ip ?>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                     


                                        <?php $i++;} ?>
                                     





  <?php    $domain_support = json_decode($domain->Support_File);?>


                                        <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('speech_document') ?></h6>
                                        <div class="row no-gutters details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('relation_between_registrar') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Relation_Between ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                    <?php if(!empty($domain_support->Doc_Title)){ ?>
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_title') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_support->Doc_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                    <?php } ?>

                                             <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_type') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">

                                                    <?= GetConstantById($domain_support->Doc_Type_ID,$__lang) ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->


                  <?php if($domain_support->Doc_Type_ID == 77){ ?>
                        
                                           <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('issuer_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">

                                                    <?= GetIssuerById($domain_support->Doc_Issures_ID,$__lang) ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                    <?php } ?>

                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_date') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_support->Doc_Date ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_number') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain_support->Doc_Num ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>




                                        <h6 class="form-title"><?= getSystemString('documents') ?></h6>
                                        <div class="row no-gutters details mt-5">
                                            <div class="col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('attachments') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <div class="row">



 		<?php
         $domain_speech = json_decode($domain->Speech_File);
 		                         if(!empty($domain_speech)){ ?>
                                                    <div class="col text-center">


                                                   <p><?= getSystemString('speech_document') ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain_speech->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>

                                                    </div><!-- /.col -->
                                       <?php }

                                          $domain_additional = json_decode($domain->Additional_File);

                                       if (!empty($domain_additional)) { ?>
                                       	 <div class="col text-center">


                                                           <p><?= getSystemString('doc_support') ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain_additional->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>


                                                    </div><!-- /.col -->
                                       	<?php }

                                          $domain_support = json_decode($domain->Support_File);



                                        if (!empty($domain_support)) { ?>
                                       		     <div class="col text-center">

                                                           <p>
                                                    <?= GetConstantById($domain_support->Doc_Type_ID,$__lang) ?>

                                                           </p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain_support->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>


                                                    </div><!-- /.col -->
                                       <?php } ?>


                                                </div><!-- /.row -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>

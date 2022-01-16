


<?PHP
    $__lang = $this->session->userdata($this->site_session->__lang_h());
    $this->load->view('site/includes/header_menu');
     $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;   ?>

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
        <?= $this->session->userdata($this->site_session->username())  ?> </h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?>
 </p>
      </div>
    </div>
  </header>
  <!-- End Header -->

<style type="text/css">
  .wpwl-control {
    direction: ltr;
}

.select2-selection__rendered {
  line-height: 48px !important;
}

.select2-selection {
  height: 48px !important;
}

</style>


	<div class="container dashboard">
		<div class="form-container p-lg-5 p-3">
            	<div class=" ">
            <?=$this->load->view('domain_registration/profile_navigation'); ?>

                <hr class="d-md-none">
                <div class="tab-content mt-5">
                    <div id="newDomain" class="tab-pane fade in active show">
                        <div class="row no-gutters align-items-center">
                            <div class="col-md-6 col-9">
                                <h3 class="color-primary py-4 14em">
                                <?= getSystemString('control_dns') ?>
                                </h3>
                            </div>
                            <div class="col-md-6 col-3">
                                <span class="text-muted">
                                <?=$domain->Domain_Name.$domain->TLD?>
                                </span><!-- /.text-muted -->
                            </div><!-- /.col-6 -->
                        </div><!-- /.row -->
                        <div class="stepper">
                            <div class="bs-stepper-content mt-3">
                                <!-- your steps content here -->
                                <div id="documents" >
                                    <p class="text-muted">
                                    <?= getSystemString('control_dns_note') ?>
                                    </p>
                                    <?php if (!$dnet_nameserver){ ?>
                                    <div class="alert alert-danger my-4">
                                        <div class="row no-gutter justify-content-center align-items-center">
                                            <div class="col-md-9">
                                                <h5 class="alert-heading"><?= getSystemString('caution') ?>:</h5>
                                                <p>
                                                    <?= getSystemString('control_dns_outside_dnet') ?>
                                                </p>
                                            </div><!-- /.col-md-8 -->
                                            <div class="col-md-3">
                                                <a href="<?=base_url('domain_details/'.encryptIt($domain->Domain_ID))?>" class="alert-link">
                                                    <?= getSystemString('update_nameservers') ?>
                                                </a><!-- /.alert-link -->
                                            </div><!-- /.col-md-4 -->
                                        </div><!-- /.row no-gutter -->
                                    </div><!-- /.alert alert-danger -->
                                    <?php } ?>

                                    <div class="row no-gutters justify-content-center align-items-center">

                                        <div class="col-md-10"></div><!-- /.col-9 -->
                                        <div class="col-md-2">
                                            <a href="#" class="btn btn-block btn-primary-inverse" id="addNewDNSRecord">
                                            <?= getSystemString('add_new_record') ?>
                                            </a><!-- /.btn btn-primary-inverse -->
                                        </div><!-- /.col-md-3 -->

                                        <div class="col-12 my-3"></div><!-- /.col-12 -->
                                        <div class="col-12" id="addNewDNSRecordRow">
                                            <form action="#" method="post" id="addNewDNSRecordForm">
                                                <div class="row dns-records-row no-gutters justify-content-center align-items-end">
                                                    <div class="col-lg-1 mt-5 mt-md-none">
                                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                                        <input type="hidden" name="domain_id" value="<?=encryptIt($domain->Domain_ID)?>" >
                                                        <input type="hidden" name="type" value="A" class="dnsTypeValue">
                                                        <p class="text-muted"><?= getSystemString('209') ?></p><!-- /.text-muted -->
                                                        <div class="dropdown">
                                                            <button class="btn btn-block btn-secondary dropdown-toggle selectedDNSRecordType" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                A
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                                <button class="dropdown-item dns-type-value" type="button" data-val="A">A</button>
                                                                <button class="dropdown-item dns-type-value" type="button" data-val="AAAA">AAAA</button>
                                                                <button class="dropdown-item dns-type-value" type="button" data-val="CNAME">CNAME</button>
                                                                <button class="dropdown-item dns-type-value" type="button" data-val="TXT">TXT</button>
                                                                <button class="dropdown-item dns-type-value" type="button" data-val="MX">MX</button>
                                                                <button class="dropdown-item dns-type-value" type="button" data-val="NS">NS</button>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.col-lg-2 -->
                                                    <div class="col-lg-3 mt-5 mt-md-none">
                                                        <p class="text-muted"><?= getSystemString('136') ?></p><!-- /.text-muted -->
                                                        <input type="text" name="name" placeholder="Example: @, www, mail" data-parsley-required="true" required>
                                                    </div><!-- /.col-lg-3 -->
                                                    <div class="col-lg-3 mt-5 mt-md-none">
                                                        <p class="text-muted"><?= getSystemString('13') ?></p><!-- /.text-muted -->
                                                        <input type="text" name="value" placeholder="Example : 125.2113.3256.4" data-parsley-required="true" required>
                                                    </div><!-- /.col-lg-3 -->
                                                    <div class="col-lg-1 mt-5 mt-md-none priority-field d-none">
                                                        <p class="text-muted"><?= getSystemString('priority') ?></p><!-- /.text-muted -->
                                                        <input type="text" name="priority" placeholder="10" data-parsley-required="true" data-parsley-type="digits">
                                                    </div><!-- /.col-lg-2 -->
                                                    <div class="col-lg-2 mt-5 mt-md-none">
                                                        <input type="hidden" name="ttl" value="86400" class="dnsRecordDuration">
                                                        <p class="text-muted">TTL</p><!-- /.text-muted -->
                                                        <div class="dropdown d-block">
                                                            <button class="btn btn-block btn-secondary dropdown-toggle selectedDNSRecordDuration" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Auto
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                                <button class="dropdown-item dns-type-duration" type="button" data-val="120" data-ttl-show="120">120</button>
                                                                <button class="dropdown-item dns-type-duration" type="button" data-val="300" data-ttl-show="300">300</button>
                                                                <button class="dropdown-item dns-type-duration" type="button" data-val="1800" data-ttl-show="1800">1800</button>
                                                                <button class="dropdown-item dns-type-duration" type="button" data-val="3000" data-ttl-show="3000">3000</button>
                                                                <button class="dropdown-item dns-type-duration" type="button" data-val="6000" data-ttl-show="6000">6000</button>
                                                                <button class="dropdown-item dns-type-duration" type="button" data-val="14400" data-ttl-show="14400">14400</button>
                                                                <button class="dropdown-item dns-type-duration" type="button" data-val="86400" data-ttl-show="86400">86400</button>
                                                            </div>
						  	</div>
                                                    </div>
						    <div class="col-lg-3 mt-5 mt-md-none">
							<button type="submit" class="btn btn-primary-inverse ml-3"><?= getSystemString('add_now') ?></button><!-- /.btn btn-primary-inverse btn-block -->
                                                    </div> 
                                                </div><!-- /.row -->
                                            </form>
                                            <div class="row mt-3">
                                                <div class="col-md-9"></div><!-- /.col-md-10 -->
                                                <div class="col-md-2">
                                                    <a href="#" id="cancelAddNewRecordRow" class="btn btn-block ml-2"><?= getSystemString(688) ?></a><!-- /.btn btn-primary-inverse btn-block -->
                                                </div><!-- /.col-md-2 -->
                                                <div class="col-md-1"></div><!-- /.col-md-1 -->
                                            </div><!-- /.row -->
                                        </div><!-- /.col-12 -->

                                        <div class="col-12" >
                                            <div class="alert my-5" id="addNewRecordRowErr"></div><!-- /#addNewRecordRowErr.alert alert-danger d-none -->
                                        </div><!-- /.col-12 -->

                                        <div class="col-12 domains dns-records mt-5">
                                            <form action="#" method="post" id="editDNSRecordForm">
                                                <table class="table force-ltr">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"><?= getSystemString(209) ?></th>
                                                            <th scope="col"><?= getSystemString(136) ?></th>
                                                            <th scope="col"><?= getSystemString(13) ?></th>
                                                            <th scope="col"></th>
                                                            <th scope="col">TTL</th>
                                                            <th scope="col" style="min-width: 200px;"><?= getSystemString('Action') ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($dns_records as $record){
                                                        if (in_array($record->type, $allowed_records_types) && ($record->type != 'NS' && $record->name != 'ns1.dnetns.com') && ($record->type != 'NS' && $record->name != 'ns2.dnetns.com')) {
                                                        ?>
                                                        <tr>
                                                            <td scope="row"><?=$record->type?></td>
                                                            <td scope="row"><?=$record->name?></td>
                                                            <td scope="row"><?=substr($record->address.$record->exchange.$record->char_str_list[0].$record->nsdname.$record->cname, 0, 20)?><?php if(strlen($record->address.$record->exchange.$record->char_str_list[0].$record->nsdname.$record->cname) > 20){echo '...';}?><span  data-toggle="tooltip" data-placement="top" title="<?= getSystemString('priority') ?>" class="badge badge-primary mx-3"><?=$record->preference?></span></td>
                                                            <td scope="row"></td>
                                                            <td scope="row"><?=$record->ttl?></td>
                                                            <td scope="row" style="width: 250px;">
                                                                <a href="#" class="btn btn-primary-inverse editDNSRecord" data-csrf="<?=$this->security->get_csrf_hash()?>" data-domain="<?=$domain->Domain_Name.$domain->TLD?>" data-domainid="<?=encryptIt($domain->Domain_ID)?>" data-line="<?=$record->Line?>" data-type="<?=$record->type?>" data-name="<?=$record->name?>" data-value="<?=$record->address.$record->exchange.$record->char_str_list[0].$record->nsdname.$record->cname?>" data-priority="<?=$record->preference?>" data-ttl="<?=$record->ttl?>">
                                                                <?= getSystemString(154) ?>
                                                                </a><!-- /.btn btn-primary-inverse -->
                                                                <a href="#" class="btn btn-primary-inverse deleteDNSRecord" data-csrf="<?=$this->security->get_csrf_hash()?>" data-domainid="<?=encryptIt($domain->Domain_ID)?>" data-line="<?=$record->Line?>">
                                                                <?= getSystemString(155) ?>
                                                                </a><!-- /.btn btn-primary-inverse -->
                                                            </td>
                                                        </tr>
                                                        <?php } } ?>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div><!-- /.domains -->

                                    </div><!-- /.row -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container -->
    </div><!-- /.form-container -->

    <div class="mt-5"></div><!-- /.mt-5 -->
 <?=   $this->load->view('site/includes/support', $website_config); ?>

    <?PHP
    $this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>

<script type="text/javascript">

    $(document).ready(function (){
      $(".select2").select2({ });
});
    if ( document.documentElement.lang.toLowerCase() === "ar" ) {
  var wpwlOptions = {
    locale: "ar",
        style: "plain",
        paymentTarget: '_top',

    }   }


    if ( document.documentElement.lang.toLowerCase() === "en" ) {
  var wpwlOptions = {
    locale: "en",
        style: "plain",
        paymentTarget: '_top',

    }   }




</script>

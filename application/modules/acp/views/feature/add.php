<link href="<?=base_url('style/acp/css/select2.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('style/acp/css/select2-bootstrap.min.css')?>" rel="stylesheet" />
<style>
    .panel.white{
        min-height: 100px;
    }
    .crop-image{
        width: 200px;
        height: 200px;
    }
    #map{
        width: 100%;
        height: 350px;
    }

    #map .form-control{
        width: 50% !important;
        top: 8px !important;
    }
</style>
<div id="content-main">

    <div class="row">

        <?PHP
        $this->load->view('acp_includes/response_messages');

        // Added by Yasir on 13 Oct 2019

        /*
         * Only super admin can access features settings.
        */
        if($this->session->userdata($this->acp_session->role()) != 'super_admin')
        {
            $this->view('un_authorize');
        }
        //print_r($rbac_menus);
        ?>

        <div class="col-md-12">
            <h3><?=getSystemString(707)?></h3>
            <form action="<?=base_url($__controller.'/add_POST');?>" class="form-horizontal" method="post" data-parsley-validate>
                <div class="panel white" style="padding-bottom: 50px;">

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="pid"><?=getSystemString(708)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <select name="pid" class="form-control select2">
                                <option value="0">-- <?=getSystemString(708)?> --</option>
                                <?php foreach ($rbac_menus as $rm):?>
                                    <option value="<?=$rm->Id?>"><?=getSystemString($rm->Menu_String_Key)?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="nameAr"><?=getSystemString(709)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text"
                                   class="form-control"
                                   name="nameAr"
                                   placeholder="e.g: Dashboard"
                                   required
                                   data-parsley-required-message="<?=getSystemString(213)?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="nameEn"><?=getSystemString(710)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text"
                                   class="form-control"
                                   name="nameEn"
                                   placeholder="e.g: Dashboard"
                                   required
                                   data-parsley-required-message="<?=getSystemString(213)?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="websiteLink"><?=getSystemString(65)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="input"
                                   class="form-control"
                                   name="websiteLink"
                                   placeholder="e.g: aboutus"
                                   data-parsley-required-message="<?=getSystemString(213)?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="isHeader"></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6">
                            <label class="checkbox">
                                <input type="checkbox"
                                       name="isHeader"
                                       varlue="1" style="font-size: 16px"> <?=getSystemString(705)?>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="isFooter"></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6">
                            <label class="checkbox">
                                <input type="checkbox"
                                       name="isFooter"
                                       varlue="1" style="font-size: 16px"> <?=getSystemString(706)?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 text-right">
                        <input type="submit" class="btn btn-primary" value="<?=getSystemString("add_feature")?>" name="submit"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?PHP
$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url('style/acp/js/select2.min.js')?>"></script>
<script>
    $(function(){
        $('.select2').select2({
            theme: 'bootstrap',
            placeholder: '<?=getSystemString(426)?>'
        });
    });
</script>
</body>
</html>

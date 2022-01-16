<?php
/*
 * Added by Yasir on 31 Oct 2019
 *
 */
if ($is_disabled->Status == 0) {
    show_404();
}
?>
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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="<?=getSystemString(734)?><"><a href="<?=base_url('/acp/notifications/contacts')?>"><?=getSystemString(734)?></a></li>
            <li class="breadcrumb-item active" aria-current="<?=getSystemString(171)?><"><?=getSystemString(171)?></li>
        </ol>
    </nav>
    <div class="row">

        <?PHP
        $this->load->view('acp_includes/response_messages');
        ?>

        <div class="col-md-12">
            <h3><?=getSystemString(171)?></h3>
            <form action="<?=base_url($__controller.'/editContact_POST/'.$contact[0]->Customer_ID);?>" class="form-horizontal" method="post" data-parsley-validate>
                <div class="panel white" style="padding-bottom: 50px;">

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title"><?=getSystemString(136)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text"
                                   class="form-control"
                                   name="name"
                                   required
                                   value="<?=$contact[0]->Fullname?>"
                                   data-parsley-required-message="<?=getSystemString(213)?>">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title"><?=getSystemString(137)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text"
                                   class="form-control"
                                   name="phoneNumber"
                                   required
                                   value="<?=$contact[0]->Phone?>"
                                   data-parsley-required-message="<?=getSystemString(213)?>">

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 text-right">
                        <input type="submit" class="btn btn-primary" value="<?=getSystemString(171)?>" name="submit"/>
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
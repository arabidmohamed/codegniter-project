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

<div id="content-main">

    <div class="row">

        <?PHP
        $this->load->view('acp_includes/response_messages');
        ?>
        <form action="<?=base_url($__controller.'/sendPushNotification');?>" class="form-horizontal" method="post" data-parsley-validate enctype="multipart/form-data">
            <div class="col-md-10">
                <h3> <?=getSystemString('push')?></h3>


                <div class="panel white" style="padding-bottom: 50px;">

                    <div class="form-group hide">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor2"><?=getSystemString(398)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <select class="form-control select2" name="sel_subscribers[]" multiple="">
                                <?PHP
                                foreach($emails as $row){
                                    ?>
                                    <option value="<?=$row->Email?>"><?=$row->Email?></option>
                                    <?PHP
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group hide">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor2"></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <label><?=getSystemString(402)?></label>
                        </div>
                    </div>

                    <div class="form-group hide">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor2"></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="checkbox" id="c7" class="control rounded block" name="subscribers" value="*" />
                            <label for="c7"><span></span><?=getSystemString(399)?></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor2"><?=getSystemString(681)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text" name="subject" class="form-control" value="<?=@$subject?>" placeholder="<?=getSystemString(681)?>" required data-parsley-trigger="change" data-parsley-required-message="<?=getSystemString(213)?>">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor2"><?=getSystemString(682)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <textarea name="message" class="form-control" rows="6" class="margin-bottom" required="" data-parsley-required-message="<?=getSystemString(213)?>" placeholder="<?=getSystemString(682)?>"><?=@$message?></textarea>

                        </div>
                    </div>


                </div>
            </div>

            <div class="col-xs-12 col-md-10 no-padding">
                <div class="form-group text-right" style="width: 100%">
                    <input type="submit" class="btn btn-primary" value="<?=getSystemString('push')?>" name="submit" />
                </div>
            </div>


        </form>

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
            placeholder: '<?=getSystemString(483)?>'
        });
    });
</script>
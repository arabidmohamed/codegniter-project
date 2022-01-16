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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="<?=getSystemString(686)?><"><?=getSystemString(686)?></li>
        </ol>
    </nav>
    <div class="row">

        <?PHP
        $this->load->view('acp_includes/response_messages');
        ?>
        <form action="<?=base_url($__controller.'/sendMessageToMembers');?>" class="form-horizontal" method="post" data-parsley-validate enctype="multipart/form-data">
            <div class="col-md-10">
                <h3> <?=getSystemString(686)?></h3>
                <div class="panel white" style="padding-bottom: 50px;">

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor2"><?=getSystemString(1)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <select class="form-control select2" name="members[]" multiple="" data-placeholder="<?=getSystemString(59)?>">
                                <?PHP
                                foreach($customers as $row){
                                    ?>
                                    <option value="<?=$row->ID?>"
                                        <?PHP
                                        if(isset($postmembers))
                                        {
                                            foreach($postmembers as $m){
                                                if($m == $row->ID){
                                                    echo 'selected';
                                                }
                                            }
                                        }
                                        ?>
                                    ><?=$row->Email?></option>
                                    <?PHP
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor2"></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <label><?=getSystemString(676)?></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor2"><?=getSystemString(683)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="checkbox" id="c7" class="control rounded block" name="professionals" value="2" />
                            <label for="c7"><span></span><?=getSystemString(684)?></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor2"><?=getSystemString(675)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text" name="subject" class="form-control" value="<?=@$subject?>" placeholder="<?=getSystemString(675)?>" required data-parsley-trigger="change" data-parsley-required-message="<?=getSystemString(213)?>">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor2"><?=getSystemString(674)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                            <?php if ($__lang == 'en'): ?>
                                <textarea name="message" id="editor2" rows="12" class="margin-bottom basic-editor-en" cols="40" ><?=@$message?></textarea>
                            <?php else: ?>
                                <textarea name="message" id="editor2" rows="12" class="margin-bottom basic-editor-ar" cols="40" ><?=@$message?></textarea>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor2"><?=getSystemString(678)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                            <input type="file" name="attach_file">

                        </div>
                    </div>


                </div>
            </div>

            <div class="col-xs-12 col-md-10 no-padding">
                <div class="form-group text-right" style="width: 100%">
                    <input type="submit" class="btn btn-primary" value="<?=getSystemString(246)?>" name="submit" />
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
            placeholder: '<?=getSystemString(426)?>'
        });
    });
</script>
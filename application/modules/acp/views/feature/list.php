<style>
    .panel.white{
        min-height: 150px ;
    }
</style>
<div id="content-main">
    <div class="row">
        <?PHP
        $this->load->view('acp_includes/response_messages');
        $name = 'Name_'.$__lang;

        // Added by Yasir on 13 Oct 2019

        /*
         * Only super admin can access features settings.
        */
        if($this->session->userdata($this->acp_session->role()) != 'super_admin')
        {
            $this->view('un_authorize');
        }
        ?>

        <div class="col-md-12">
            <h3><?=getSystemString(711)?>
                <a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary pull-right" style="color:#fff">
                    <i class="fa fa-plus"></i> <?=getSystemString("add_feature")?>
                </a>
            </h3>
        </div>


        <div class="col-md-12">
            <div class="panel white" style="padding-bottom: 50px;">
                <table class="table table-hover sortable-1 sortable-tb" id="features_table">
                    <thead>
                    <tr>
                        <th class="hide">FID</th>
                        <th><?=getSystemString(136)?></th>
                        <th><?=getSystemString(712)?></th>
                        <th><?=getSystemString(42   )?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?PHP
                    $i = 0;
                    foreach($features as $m):
                        $i++;
                        ?>
                        <tr id="<?=$m->FID?>">
                            <td class="hide"><?=$m->FID?></td>
                            <td class="index hide"><?=$i;?></td>
                            <td><span class="drag-handle"></span><?=$m->$name?></td>
                            <td>
                                <div data-toggle="hurkanSwitch" data-status="<?=$m->Status?>">
                                    <input data-on="true" type="radio" <?PHP if($m->Status) { echo 'checked'; } ?> name="status<?=$i?>">
                                    <input data-off="true" type="radio" <?PHP if(!$m->Status) { echo 'checked'; } ?>  name="status<?=$i?>">
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/edit/'.$m->FID)?>">
                                        <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                    </a>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="fa fa-angle-down"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                        <li>
                                            <a href="<?=base_url($__controller.'/edit/'.$m->FID)?>" style="margin: 0px 5px;" class="dropdown-item">
                                                <i class="fa fa-edit"></i>  <?=getSystemString(43)?>
                                            </a>
                                        </li>
                                        <?php if ($m->Website_Link != ''):?>
                                            <li>
                                                <a href="<?=base_url($m->Website_Link)?>" style="margin: 0px 5px;" class="dropdown-item" target="_blank">
                                                    <i class="fa fa-link"></i> <?=getSystemString(714)?></a>
                                            </li>
                                        <?php endif; ?>
                                        <li>
                                            <a href="<?=base_url($__controller.'/delete/'.$m->FID)?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
                                                <i class="fa fa-trash"></i>  <?=getSystemString(314)?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?PHP
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
            <form action="<?=base_url($__controller.'/updateLanguage_POST');?>" class="form-horizontal" method="post">
            <!-- ~~~~~~~~~~~~~~~~ Start Default languages ..... ~~~~~~~~~~~~~~~~~~~ -->
                <div class="panel white" style="padding-bottom: 50px;">
                    <h3><?=getSystemString(334)?></h3>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="website_title"><?=getSystemString(334)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">

                            <label class="radio-inline" style="text-align: center">
                                <input type="radio" name="website_language" value="en" class="radio" <?PHP if($wbs[0]->Website_Language == "en"){ echo 'checked'; }?>> <?=getSystemString(336)?>
                            </label>

                            <label class="radio-inline" style="text-align: center">
                                <input type="radio" name="website_language" value="ar" class="radio" <?PHP if($wbs[0]->Website_Language == "ar"){ echo 'checked'; } ?>> <?=getSystemString(337)?>
                            </label>

                            <label class="radio-inline" style="text-align: center">
                                <input type="radio" name="website_language" value="en-ar" class="radio" <?PHP if($wbs[0]->Website_Language == "en-ar"){ echo 'checked'; } ?>> <?=getSystemString(335)?>
                            </label>

                        </div>
                    </div>
                </div>

                <div class="col-md-12 rtl-right">
                    <div class="form-group">
                        <div class="col-xs-12 text-right">
                            <input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit"/>
                        </div>
                    </div>
                </div>

            </form>
            <!-- ~~~~~~~~~~~~~~~~ End Default languages  ..... ~~~~~~~~~~~~~~~~~~~ -->
        </div>

    </div>
</div>
<?PHP
$this->load->view('acp_includes/footer');
?>
<script>
    $(function(){
        $(document).on('click',"#features_table tr td .hurkanSwitch", function(){
            ChangeStatusFor($(this), 'website_features');
        });

        ChangeOrder('website_features');
    });

</script>
</body>
</html>

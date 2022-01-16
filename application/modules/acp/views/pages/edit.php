
<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="<?=getSystemString(91)?>"><a href="<?=base_url('acp/pages/listall')?>"><?=getSystemString(91)?></a></li>
            <li class="breadcrumb-item active" aria-current="<?=getSystemString(736)?>"><?=getSystemString(736)?></li>
        </ol>
    </nav>
    <?PHP
    $section = "SectionName_".$__lang;
    $return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
    ?>

    <!--        <h3><?=getSystemString(15)?></h3> -->
    <div class="row">
        <div class="col-md-12">
            <h3>
                <?=getSystemString(736)?>

            </h3>
        </div>
        <?PHP
        $this->load->view('acp_includes/response_messages');
        ?>

        <div class="col-md-12">
            <?PHP
            $lang_setting['website_lang'] = $website_lang;
            //load tabs
            $this->load->view('acp_includes/lang-tabs', $lang_setting);
            ?>
            <form action="<?=base_url($__controller.'/edit_POST/'.$page_id);?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="panel white" style="padding-bottom: 50px;">
                    <div class="tab-content">
                        <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(737)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <input class="form-control" type="text" name="page-title-en" value="<?=$page->Page_title_en?>">
                                    <br>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(741)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <textarea class="form-control" name="page-description-en"><?=$page->Page_Description_en?></textarea>
                                    <br>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(740)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <input class="form-control" type="text" name="keyword" value="<?=$page->Keyword?>">
                                    <small><?=getSystemString(320)?></small>
                                    <br>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(13)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                        <textarea name="editor1" id="editor1" rows="12" class="margin-bottom editors1" cols="40" >
                                            <?=$page->Content_en?>
                                        </textarea>
                                    <br>

                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">

                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(737)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <input class="form-control" type="text" name="page-title-ar" value="<?=$page->Page_title_ar?>">
                                    <br>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(741)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <textarea class="form-control" name="page-description-ar"><?=$page->Page_Description_ar?></textarea>
                                    <br>
                                </div>
                            </div>

                             <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                                <label for="service_picture"><?=getSystemString(14)?></label>
                            </div>
                            <div class="col-xs-12 col-sm-8 no-padding-left">
                                <input type="hidden" class="crop_img_url" value="<?=$page->Original_Img?>">
                                <div class="crop-image">
                                    <input type="hidden" name="image-data" id="image-data">
                                    <input type="hidden" id="check_chng_img" name="check_chng_img" value="-1">
                                    <input type="file" name="fileToUpload" class="editor-file z-10">
                                    <div class="ci-preview-labels">
                                        <div class="text-xs-center">
                                            <i class="fa fa-cloud-upload"></i>
                                            <p><?=getSystemString(262)?></p>
                                            <p><?=getSystemString(263)?></p>
                                            <p><a href="javascript: void(0)"><?=getSystemString(264)?></a></p>
                                        </div>
                                    </div>
                                    <a href="#" class="change-pic editor z-10 hide"> <i class="fa fa-pencil"></i> <?=getSystemString(171)?></a>
                                </div>

                            </div>
                        </div>

                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(740)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <input class="form-control" type="text" name="keyword" value="<?=$page->Keyword?>">
                                    <small><?=getSystemString(320)?></small>
                                    <br>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(13)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                        <textarea name="editor2" id="editor2" rows="12" class="margin-bottom editors2" cols="40" >
                                        <?=$page->Content_ar?>
                                        </textarea>
                                    <br>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>


                <div class="form-group">
                    <div class="col-xs-12 text-right">
                        <input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" />
                    </div>
                </div>

            </form>
        </div>
    </div>
    <?PHP
    $this->load->view('acp_includes/footer');
    ?>

    <script>
    $(function(){



        var cropitEditor = Cropit.init.initializeCroppieEditor();

        if($('.crop-image').length > 0 && $('.crop_img_url').val().length > 0){

            cropitEditor.croppie('bind', {
                url: '<?=base_url($GLOBALS['img_news_dir'])?>'+$('.crop_img_url').val()
            });

            Cropit.init.callbacks.cropImageActive();
        }

    });

</script>
    </body>
    </html>

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
    $content = 'Company_Address_'.$__lang;
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
                            <div class="form-group hide">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(737)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <input class="form-control" type="text" name="page-title-en" value="<?=$page->Page_title_en?>">
                                    <br>
                                </div>
                            </div>

                            <div class="form-group hide">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(741)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <textarea class="form-control" name="page-description-en"><?=$page->Page_Description_en?></textarea>
                                    <br>
                                </div>
                            </div>

                            <div class="form-group hide">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(740)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <input class="form-control" type="text" name="keyword" value="<?=$page->Keyword?>">
                                    <br>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(782)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                        <textarea name="Company_Address_en" id="editor1" rows="12" class="margin-bottom basic-editor-en" cols="40" >
                                            <?=$contactus->Company_Address_en?>
                                        </textarea>
                                    <br>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
                            <div class="form-group hide">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(737)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <input class="form-control" type="text" name="page-title-ar" value="<?=$page->Page_title_ar?>">
                                    <br>
                                </div>
                            </div>

                            <div class="form-group hide">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(741)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <textarea class="form-control" name="page-description-ar"><?=$page->Page_Description_ar?></textarea>
                                    <br>
                                </div>
                            </div>

                            <div class="form-group hide">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(740)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <input class="form-control" type="text" name="keyword" value="<?=$page->Keyword?>">
                                    <br>
                                </div>
                            </div>

                   

                             <div class="form-group ">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(228)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <input class="form-control" type="email" name="email" value="<?=$contactus->Website_Email?>">
                                    <br>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(137)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                    <input class="form-control" type="text" name="phone" value="<?=$contactus->Website_MobileNo?>">
                                    <br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="editor1"><?=getSystemString(371)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                        <textarea name="Company_Address_ar" id="editor2" rows="12" class="margin-bottom basic-editor-ar" cols="40" >
                                        <?=$contactus->Company_Address_ar?>
                                        </textarea>
                                    <br>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                                <label for="title_en"><?=getSystemString(743)?></label>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
                                <textarea class="form-control" name="map" rows="5" autocomplete="off" data-parsley-required-message="Please fill out this field"><?=$contactus->Embed_Map?></textarea>
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
    </body>
    </html>
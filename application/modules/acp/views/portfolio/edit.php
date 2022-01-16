    <link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
    <style>
    .video-thumb{
        display: block;
        width: 42px;
        height: 30px;
        text-align: center;
        background: #b5b0b0;
        border-radius: 2px;
        margin: auto;
    }
    body[dir='rtl'] .video-thumb{
        margin-right: 0px;
    }
    .video-thumb i{
        margin-top: 20%;
        color: #e44747;
    }
        .panel.white{
        min-height: 150px ;
    }
    .dropzone .dz-message{
        margin: 0px;
        font-size: 13px;
    }
    .dropzone{
        min-height: 0px;
    }
    .select2{
        width: 100% !important;
    }
    .crop-image{
		width: 400px;
		height: 500px;
	}
    </style>
	<div id="content-main">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="<?=getSystemString(131)?>"><a href="<?=base_url('acp/portfolios/listall')?>"><?=getSystemString(131)?></a></li>
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(62)?>"><?=getSystemString(62)?></li>
            </ol>
        </nav>
        <div class="row">

            <?PHP
                $this->load->view('acp_includes/response_messages');

                $p_tag = $portfolio[0]->PortfolioType;
            ?>
            <div class="col-md-12" style="padding: 0px">
                <form action="<?=base_url($__controller.'/edit_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data">

                    <div class="col-md-12">
                        <h3><?=getSystemString(62)?></h3>

                        <?PHP
                            $lang_setting['website_lang'] = $website_lang;
                            $lang_setting['extra_targets_en'] = "#lang_en, #lang2_en";
                            $lang_setting['extra_targets_ar'] = "#lang_ar, #lang2_ar";
                            //load tabs
                            $this->load->view('acp_includes/lang-tabs', $lang_setting);
                        ?>

                        <div class="panel white" style="padding-bottom: 50px;">
                            <div class="tab-content">
                                <input type="hidden" name="portfolio_id" id="portfolioDet_id" value="<?=$portfolio_id?>">



                                <div class="tab-pane fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-4 col-md-2">
                                            <label for="title"><?=getSystemString(151)?></label>
                                        </div>
                                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                            <input type="text" class="form-control" name="title_en" placeholder="<?=getSystemString(151)?>" value="<?=$portfolio[0]->Title_en?>" required
												data-parsley-required-message="<?=getSystemString(213)?>">

                                        </div>
                                    </div>


                                </div>

                                <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-4 col-md-2">
                                            <label for="title"><?=getSystemString(151)?></label>
                                        </div>
                                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                            <input type="text" class="form-control" name="title_ar" placeholder="<?=getSystemString(151)?>" dir="rtl" value="<?=$portfolio[0]->Title_ar?>" required
												data-parsley-required-message="<?=getSystemString(213)?>">

                                        </div>
                                    </div>



                                </div>

                                <div class="form-group hide">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="title"><?=getSystemString('website_link')?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                        <input type="url" class="form-control" name="portfolio_link" placeholder="http://www.example.com/project" value="<?=$portfolio[0]->Link?>">
                                    </div>
                                </div>

                                <?PHP
                                    if($portfolio[0]->PortfolioType == 'pic')
                                    {
                                    ?>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="service_picture"><?=getSystemString(175)?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 no-padding-left">
                                        <input type="hidden" class="crop_img_url" value="<?=$portfolio[0]->Thumbnail?>">
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
                                <?PHP
                                    }
                                ?>



                            </div>


                        </div>
                    </div>



                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 text-right">
                            <input type="submit" name="submit" class="btn btn-primary" value="<?=getSystemString(157)?>" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?PHP
	$this->load->view('portfolio/snippets/add_modal');
    $this->load->view('acp_includes/footer');
    ?>
    <script type="text/javascript" src="<?=base_url('style/acp/js/dropzone.js')?>"></script>
    <script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/add_select2.js')?>"></script>
    <script>
	    var _unlink_url = '<?=base_url($__controller.'/unlinkImage')?>';
		var _post_url = '<?=base_url($__controller.'/uploadImages')?>';
		var _lang = '<?=$__lang?>';
		var _postCategoryURL = '<?=base_url($__controller.'/addCategory_HTTP')?>';

    $(function(){
        menu_track_manual(4, 0);

        $(".select2").select2({
			theme:'bootstrap'
		}).on('select2:open', function (e) {

		  createSelect2Button(e);
		});

        $(document).on('click',"#project_details_table tr td .hurkanSwitch", function(){
            ChangeStatusFor($(this), 'portfolio_details');
        });

        $('#projects_table').on('click', function(){
            ChangeOrder('portfolio');
        });

        $('#project_details_table').on('click', function(){
            ChangeOrder('portfolio_details');
        });

        var cropitEditor = Cropit.init.initializeCroppieEditor();

        if($('.crop-image').length > 0 && $('.crop_img_url').val().length > 0){

			cropitEditor.croppie('bind', {
				url: '<?=base_url($GLOBALS['img_work_dir'])?>'+$('.crop_img_url').val()
			});

			Cropit.init.callbacks.cropImageActive();
		}

        // initializing dropzone
		initializeDropzone(_post_url, _unlink_url, $('#portfolioDet_id').val());

		var options = {
			formId        : "form_new_category",
			ENNameId      : "category_en",
			ARNameId 	  : "category_ar",
			selectFieldId : "select_category",
			postURL 	  : _postCategoryURL
		};
		Select2Options.init(options);

    });
    </script>
    </body>
</html>

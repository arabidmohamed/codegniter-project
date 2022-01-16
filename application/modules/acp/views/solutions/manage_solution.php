<?PHP
$section = "SectionName_".$__lang;
$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
?>
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<style>
    .crop-image{
        width: 200px;
        height: 200px;
    }
</style>
<div id="content-main">


    <div class="row">

        <?PHP
        $this->load->view('acp_includes/response_messages');

        if(!isset($solution_id))
        {
            ?>
            <div class="col-md-12">

                <div>

                    <a href="<?=base_url($__controller.'/feature_list')?>" data-role="button" class="btn btn-warning float-left-right add-btn-toolbar" style="color:#FFF">
          		        <i class="fa fa-gear"></i> <?=getSystemString('feature_list')?>
          	        </a>
                    <a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#fff">
                        <i class="fa fa-plus"></i> <?=getSystemString('add_solution')?>
                    </a>

                </div>

                <div class="panel white" style="padding-bottom: 50px;">


                    <table class="table table-hover sortable-tb sortable-1" id="services_table">
                        <thead>
                        <tr>
                            <th class="hide"><?=getSystemString(41)?></th>
                            <th><?=getSystemString(177)?></th>
                            <th><?=getSystemString(14)?></th>
                            <th><?=getSystemString(38)?></th>
                            <th><?=getSystemString(33)?></th>
                            <th colspan="2"><?=getSystemString(42)?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP
                        if(count($solutions)){
                            $i = 0;
                            foreach($solutions as $row){
                                $i++;
                                $dt = new DateTime($row->Created_At);
                                ?>
                                <tr id="<?=$row->ID;?>">
                                    <td class="hide"><?=$row->ID;?></td>
                                    <td class="index hide"><?=$i;?></td>
                                    <td><span class="drag-handle"></span><?=$dt->format('d-m-Y');?></td>
                                    <td><img src="<?=base_url($GLOBALS['img_solutions_dir']).$row->Icon;?>" alt='service icon' style="width: 40px;"></td>
                                    <?PHP $title = 'Title_'.$__lang; ?>
                                    <td><?=$row->$title;?></td>
                                    <td>
                                        <div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
                                            <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="status<?=$i?>">
                                            <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="status<?=$i?>">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editSolution/'.$row->ID.'/')?>">
                                                <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                            </a>
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                <li>
                                                    <a href="<?=base_url($__controller.'/editSolution/'.$row->ID.'/')?>" style="margin: 0px 5px;" class="dropdown-item">
                                                        <i class="fa fa-edit"></i>  <?=getSystemString(43)?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?=base_url($__controller.'/deleteSolution/'.$row->ID.'/')?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
                                                        <i class="fa fa-trash"></i>  <?=getSystemString(314)?>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?PHP
                            }
                        } else {
                            ?>
                            <tr><td colspan='5' class='text-center'><?=getSystemString(46)?></td></tr>
                            <?PHP
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <?PHP
        }

        if(isset($solution_id))
        {
            ?>

            <div class="col-md-10">
                <h1><?=getSystemString('solutions')?></h1>

                <?PHP
                $lang_setting['website_lang'] = $website_lang;
                //load tabs
                $this->load->view('acp_includes/lang-tabs', $lang_setting);
                ?>

                <form action="<?=base_url($__controller.'/updateSolution');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="panel white" style="padding-bottom: 50px;">

                        <input type="hidden" name="solution_id" value="<?=$solution_id?>">
                        <div class="tab-content">

                            <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="title_en"><?=getSystemString(38)?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                        <input type="text" class="form-control" name="title_en" placeholder="<?=getSystemString(695)?>" value="<?=$solution[0]->Title_en?>" >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="editor1"><?=getSystemString(13)?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor1" id="editor1" rows="12" class="margin-bottom basic-editor-en" cols="40" >
										<?=$solution[0]->Content_en?>
										</textarea>
                                        <br>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="title_ar"><?=getSystemString(38)?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                        <input type="text" class="form-control" name="title_ar" placeholder="<?=getSystemString(695)?>" dir="rtl" value="<?=$solution[0]->Title_ar?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="editor2"><?=getSystemString(13)?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor2" id="editor2" rows="12" class="margin-bottom basic-editor-ar" cols="40" >
											<?=$solution[0]->Content_ar?>
										</textarea>
                                        <br>

                                    </div>
                                </div>
                            </div>

                        </div>






                            <div class="form-group" id="single">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="title"><?=getSystemString('icon')?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                    <input type="file" class="fileToUpload" name="fileToUpload"  id="inputFile" data-thumb-width="350" data-thumb-height="250">

                                    <img src="<?=base_url($GLOBALS['img_solutions_dir']).$solution[0]->Icon?>" style="margin-top: 10px; width: 250;"  id="Thumbnailimage">
                                </div>
                            </div>

                            <div class="form-group" id="single">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="title"><?=getSystemString(14)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                    <input type="file" class="fileToUpload" name="fileToUpload2"  id="inputFile" data-thumb-width="350" data-thumb-height="250" >
                                    <img src="<?=base_url($GLOBALS['img_solutions_dir']).$solution[0]->Picture?>" style="margin-top: 10px; width: 250;">
                                </div>
                            </div>
                            <br><br>
                            <!-- Note: used for feature list -->

         				            <div class="form-group" id="contentEN">
         								<div class="col-xs-12 col-sm-4 col-md-2">
         									<label for="title_ar"><?=getSystemString(755)?></label>
         								</div>

         								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left  display-select2">
         									<select class="form-control select2"
         		                                    name="feature[]"
         		                                    multiple=""
         		                                    id="select_category"
         		                                    data-placeholder="<?=getSystemString(308)?>"
         		                                    required
         		                                    data-parsley-required-message="<?=getSystemString(213)?>"
         		                                    >

         		                                <?PHP
         			                                //print_r($plans);
         		                                foreach($features as $row){
         		                                    $cat_nn = 'Title_'.$__lang;
         		                                    ?>
         		                                    <option value="<?=$row->Feature_ID?>" <?PHP $feature_id = explode(",", $solution[0]->Features);
         		                                    for($id = 0; $id < count($feature_id); $id++){
         		                                        if($row->Feature_ID == $feature_id[$id]){
         		                                            echo 'selected';
         		                                        }
         		                                    } ?>><?=$row->$cat_nn?></option>
         		                                    <?PHP
         		                                }
         		                                ?>
         		                            </select>

         								</div>

         							</div>

         				            <!-- ends -->
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-right">
                            <input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit"/>
                        </div>
                    </div>
            </div>

            </form>

            <?PHP
        }
        ?>
    </div>
</div>
<?PHP
$this->load->view('acp_includes/footer');
?>
<script>
    $(function(){

        menu_track_manual(3,0);

        $(document).on('click',"#services_table tr td .hurkanSwitch", function(){
            ChangeStatusFor($(this), 'solution');
        });

        ChangeOrder('solution');


                $("#inputFile").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#Thumbnailimage').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // var cropitEditor = Cropit.init.initializeCroppieEditor();

        // if($('.crop-image').length > 0 && $('.crop_img_url').val().length > 0){

        //     cropitEditor.croppie('bind', {
        //         url: '<?=base_url($GLOBALS['img_services_dir'])?>'+$('.crop_img_url').val()
        //     });

        //     Cropit.init.callbacks.cropImageActive();
        // }
    });

</script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/add_select2.js')?>"></script>
<script>

        var _postTitleURL = '<?=base_url($__controller.'/addFeatureData_HTTP')?>';

        $(function(){

           $(".select2").select2({
                theme:'bootstrap'
            }).on('select2:open', function (e) {

                createSelect2Button(e);
            });

            var options = {
                formId        : "form_new_category",
                ENNameId      : "Title_en",
                ARNameId 	  : "Title_ar",
                selectFieldId : "select_category",
                postURL 	  : _postTitleURL
            };
            Select2Options.init(options);

        });
</script>
</body>
</html>

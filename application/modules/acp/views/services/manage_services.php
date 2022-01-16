<?PHP
$section = "SectionName_".$__lang;
$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
?>
<style>
    .crop-image{
        width: 200px;
        height: 200px;
    }
</style>
<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="<?=getSystemString('aboutus_title')?><"><?=getSystemString('aboutus_title')?></li>
        </ol>
    </nav>
    <!-- Note: Total -->
    <!-- <h3><?=$services[0]->$section?></h3> -->
    <?php if(isset($total['TotalServices'])){ ?>
        <div class="container col-md-4" id="totals">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center"><?=@$total['TotalServices']?></h3>
                    <h4>_</h4>
                    <p><?=getSystemString('total_services')?></p>
                </div>
            </div>
        </div>
        <div class="container col-md-3" id="totals">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center"><?=@$activeSerMale?></h3>
                    <h4>_</h4>
                    <p><?=getSystemString('active')?></p>
                </div>
            </div>
        </div>
        <div class="container col-md-4" id="totals">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center"><?=@$inActiveSerFemale?></h3>
                    <h4>_</h4>
                    <p><?=getSystemString('inActive')?></p>
                </div>
            </div>
        </div>

    <?php } ?>
    <!-- Ends -->
    <div class="row">

        <?PHP
        $this->load->view('acp_includes/response_messages');

        if(!isset($service_id))
        {
            ?>
            <div class="col-md-12">

                <div>
                    <div class="dropdown d-inline-block float-left-right">
                        <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/editSection/".$services[0]->Section_ID."/".$return_url."/")?>"><i class="fa fa-cog"></i> <?=getSystemString(315)?></a></li>
                        </ul>
                    </div>

                    <a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#fff">
                        <i class="fa fa-plus"></i> <?=getSystemString(93)?>
                    </a>

                </div>

                <div class="panel white" style="padding-bottom: 50px;">
                <!--     <h4><?=getSystemString('aboutus_title')?></h4> -->
                    <div class="col-xs-12 text-right">
                        <!-- 				          <a href="<?=base_url('acp/services')?>" class="btn btn-primary" style="color:#fff"><?=getSystemString(93)?></a> -->
                    </div>

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
                        if(count($services)){
                            $i = 0;
                            foreach($services as $row){
                                $i++;
                                $dt = new DateTime($row->Date);
                                ?>
                                <tr id="<?=$row->Service_ID;?>">
                                    <td class="hide"><?=$row->Service_ID;?></td>
                                    <td class="index hide"><?=$i;?></td>
                                    <td><span class="drag-handle"></span><?=$dt->format('d-m-Y');?></td>
                                    <td><img src="<?=base_url($GLOBALS['img_services_dir']).$row->Icon;?>" alt='service icon' style="width: 40px;"></td>
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
                                            <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editService/'.$row->Service_ID.'/')?>">
                                                <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                            </a>
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                <li>
                                                    <a href="<?=base_url($__controller.'/editService/'.$row->Service_ID.'/')?>" style="margin: 0px 5px;" class="dropdown-item">
                                                        <i class="fa fa-edit"></i>  <?=getSystemString(43)?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?=base_url($__controller.'/deleteService/'.$row->Service_ID.'/')?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
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

        if(isset($service_id))
        {
            ?>

            <div class="col-md-10">
                <h1><?=getSystemString('aboutus_title')?></h1>

                <?PHP
                $lang_setting['website_lang'] = $website_lang;
                //load tabs
                $this->load->view('acp_includes/lang-tabs', $lang_setting);
                ?>

                <form action="<?=base_url($__controller.'/updateService');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="panel white" style="padding-bottom: 50px;">

                        <input type="hidden" name="service_id" value="<?=$service_id?>">
                        <div class="tab-content">

                            <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="title_en"><?=getSystemString(38)?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                        <input type="text" class="form-control" name="title_en" placeholder="<?=getSystemString(695)?>" value="<?=$service[0]->Title_en?>" >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="editor1"><?=getSystemString(13)?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor1" id="editor1" rows="12" class="margin-bottom basic-editor-en" cols="40" >
										<?=$service[0]->Content_en?>
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
                                        <input type="text" class="form-control" name="title_ar" placeholder="<?=getSystemString(695)?>" dir="rtl" value="<?=$service[0]->Title_ar?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="editor2"><?=getSystemString(13)?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor2" id="editor2" rows="12" class="margin-bottom basic-editor-ar" cols="40" >
											<?=$service[0]->Content_ar?>
										</textarea>
                                        <br>

                                    </div>
                                </div>
                            </div>

                        </div>






                                          <div class="form-group" id="single">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="title"><?=getSystemString(14)?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                    <input type="file" class="fileToUpload" name="fileToUpload"  id="inputFile" data-thumb-width="350" data-thumb-height="250" >
                                    <small><?=getSystemString('ImgDimensions')?></small>
                                    <img src="<?=base_url($GLOBALS['img_services_dir']).$service[0]->Icon?>" style="margin-top: 10px; width: 250;"  id="Thumbnailimage">
                                </div>
                            </div>      
                            <br><br>

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
            ChangeStatusFor($(this), 'services');
        });

        ChangeOrder('services');


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
</body>
</html>
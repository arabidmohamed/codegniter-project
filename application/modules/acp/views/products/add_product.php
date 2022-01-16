<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="<?= getSystemString(7902) ?><"><a href="<?= base_url('acp/products/listall') ?>"><?= getSystemString(7902) ?></a></li>
            <li class="breadcrumb-item active" aria-current="<?= getSystemString(7901) ?><"><?= getSystemString(7901) ?></li>
        </ol>
    </nav>
    <h3><?= getSystemString(7901) ?></h3>
    <div class="row">

        <?PHP
        $this->load->view('acp_includes/response_messages');
        ?>

        <div class="col-md-12">

            <?PHP
            $lang_setting['website_lang'] = $website_lang;
            //load tabs
            $this->load->view('acp_includes/lang-tabs', $lang_setting);
            ?>

            <form action="<?= base_url($__controller . '/addNewProduct'); ?>" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                <div class="panel white" style="padding-bottom: 50px;">


                    <div class="tab-content">

                        <div class="tab-pane fade w-editor <?PHP
                        if ($__lang == 'en') {
                            echo 'in active';
                        }
                        ?>" id="lang_en">
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="title"><?= getSystemString(38) ?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                    <input type="text" class="form-control" name="Product_Name_en"
                                           placeholder="<?= getSystemString(38) ?>">

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="description"><?= getSystemString('product_description') ?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                    <input type="text" class="form-control" name="Product_Description_en"
                                           placeholder="<?= getSystemString('description') ?>">

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade <?PHP
                        if ($__lang == 'ar') {
                            echo 'in active';
                        }
                        ?>" id="lang_ar">

                            
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="title"><?= getSystemString(38) ?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                    <input type="text" class="form-control" name="Product_Name_ar"
                                           placeholder="<?= getSystemString(38) ?>" dir="rtl">

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-4 col-md-2">
                                    <label for="description"><?= getSystemString('product_description') ?></label>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                    <input type="text" class="form-control" name="Product_Description_ar"
                                           placeholder="<?= getSystemString('description') ?>" dir="rtl">

                                </div>
                            </div>



                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title"><?= getSystemString('ordertype') ?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text" class="form-control" name="ordertype"
                                   placeholder="<?= getSystemString('ordertype') ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="Product_logo"><?= getSystemString(14) ?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 no-padding-left">
                            <input type="file" name="Product_logo" id="Product_logo" class="fileToUpload" required="">
                            <img id="previewHolder" class="previewImg-S" alt="" src=""
                                 style="width: 200px;border-radius: 2px;margin-top:10px">
                        </div>
                    </div>
                    <hr>
                    <h3>Prices<?php //  getSystemString(7901)  ?></h3>
                    <div class="form-group row" id="prices">
                        <div>
                            <div class="col-lg-1 col-sm-4 col-md-2">
                                <label for="Product_logo"><?= getSystemString('Type') ?> - EN</label>
                            </div>
                            <div class="col-lg-2 col-sm-8 no-padding-left">
                                <input type="text" class="form-control" name="Name_en[]"
                                       placeholder="<?= getSystemString(38) ?>" dir="ltr">
                            </div>

                            <div class="col-lg-1 col-sm-4 col-md-2">
                                <label for="Product_logo"><?= getSystemString('Type') ?> - AR</label>
                            </div>
                            <div class="col-lg-2 col-sm-8 no-padding-left">
                                <input type="text" class="form-control" name="Name_ar[]"
                                       placeholder="<?= getSystemString(38) ?>" dir="rtl">
                            </div>

                            <div class="col-lg-1 col-sm-4 col-md-2">
                                <label for="Product_logo"><?= getSystemString('Price') ?></label>
                            </div>
                            <div class="col-lg-1 col-sm-8 no-padding-left">
                                <input type="text" class="form-control" name="Price[]"
                                       placeholder="<?= getSystemString('price') ?>" dir="ltr">
                            </div>
                            <div class="col-lg-2 col-sm-4 col-md-2">
                                <label for="title"><?= getSystemString('Expiry Period') ?> (<?= getSystemString('in days') ?></label>
                            </div>
                            <div class="col-lg-2 col-sm-8 no-padding-left">
                                <input type="text" class="form-control" name="period[]"
                                       placeholder="<?= getSystemString('No. of days') ?>" dir="rtl">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-success" id="add_price"/><span class="fa fa-plus"></span></button></div>
                    </div>
                </div>
        </div>




        <div class="form-group">
            <div class="col-xs-12 text-right">
                <input type="submit" class="btn btn-primary" value="<?= getSystemString(7900) ?>" name="submit"/>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
<div id="price_tamp" style="display:none">

    <div class="row"><br><br><br>
        <div class="col-lg-1 col-sm-4 col-md-2">
            <label for="Product_logo"><?= getSystemString('Type') ?> - EN</label>
        </div>
        <div class="col-lg-2 col-sm-8 no-padding-left">
            <input type="text" class="form-control" name="Name_en[]"
                   placeholder="<?= getSystemString(38) ?>" dir="ltr">
        </div>

        <div class="col-lg-1 col-sm-4 col-md-2">
            <label for="Product_logo"><?= getSystemString('Type') ?> - AR</label>
        </div>
        <div class="col-lg-2 col-sm-8 no-padding-left">
            <input type="text" class="form-control" name="Name_ar[]"
                   placeholder="<?= getSystemString(38) ?>" dir="rtl">
        </div>

        <div class="col-lg-1 col-sm-4 col-md-2">
            <label for="Product_logo"><?= getSystemString('Price') ?></label>
        </div>
        <div class="col-lg-1 col-sm-8 no-padding-left">
            <input type="text" class="form-control" name="Price[]"
                   placeholder="<?= getSystemString('price') ?>" dir="ltr">
        </div>
        <div class="col-lg-2 col-sm-4 col-md-2">
            <label for="title"><?= getSystemString('Expiry Period') ?> (<?= getSystemString('in days') ?></label>
        </div>
        <div class="col-lg-1 col-sm-8 no-padding-left">
            <input type="text" class="form-control" name="period[]"
                   placeholder="<?= getSystemString('No. of days') ?>" dir="rtl">
        </div>
        <div class="col-lg-1 col-sm-8 no-padding-left">
            <button type="button" class="btn btn-success del_price"/><span class="fa fa-trash"></span></button>
        </div>
    </div>
</div>
<?PHP
$this->load->view('acp_includes/footer');
?>
<script>
    $(function () {
        menu_track_manual(8, 0);
    });

    $("#add_price").click(function () {
        $("#prices").append($("#price_tamp").html());
    });

    $(document).on('click', '.del_price', function () {
        $(this).parent().parent().remove();
    });
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.slide')
                        .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>

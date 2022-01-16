<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="<?= getSystemString(7902) ?>"><?= getSystemString(7902) ?></li>
        </ol>
    </nav>
    <div class="row">

        <?PHP
        $this->load->view('acp_includes/response_messages');
        if (!isset($product_id)) {
            ?>
            <div class="col-md-12">
                <h3><?= getSystemString(7902) ?>
                    <a href="<?= base_url('acp/products/new_product') ?>" class="btn btn-primary btn-small pull-right" style="color:#FFF" ><?= getSystemString(7901) ?></a>
                </h3>
                <div class="panel white" style="padding-bottom: 50px;">
                    <table class="table table-hover sortable-tb sortable-1" id="product_table">
                        <thead>
                            <tr>
                                <th class="hide"><?= getSystemString(41) ?></th>
                                <th><?= getSystemString(177) ?></th>
                                <th><?= getSystemString(14) ?></th>
                                <th><?= getSystemString(136) ?></th>
                                <th><?= getSystemString(33) ?></th>
                                <th colspan="2"><?= getSystemString(42) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP
                            if (count($products)) {
                                $i = 0;
                                foreach ($products as $row) {
                                    $i++;
                                    $dt = new DateTime($row->timestamp);
                                    ?>
                                    <tr id="<?= $row->Product_ID; ?>">
                                        <td class="hide"><?= $row->Product_ID; ?></td>
                                        <td class="index hide"><?= $i; ?></td>
                                        <td><span class="drag-handle"></span><?= $dt->format('d-m-Y'); ?></td>

                                        <td><img src="<?= base_url($GLOBALS['img_products_dir']) . $row->Product_logo; ?>" alt='product image' style="width: 40px;"></td>
                                        <?PHP $tit_nn = 'Product_Name_' . $__lang; ?>
                                        <td><?= $row->$tit_nn; ?></td>
                                        <td><?= $row->OrderType; ?></td>
                                        <td>
                                            <div data-toggle="hurkanSwitch" data-status="<?= $row->Status ?>">
                                                <input data-on="true" type="radio" <?PHP
                                                if ($row->Status) {
                                                    echo 'checked';
                                                }
                                                ?> name="status<?= $i ?>">
                                                <input data-off="true" type="radio" <?PHP
                                                if (!$row->Status) {
                                                    echo 'checked';
                                                }
                                                ?>  name="status<?= $i ?>">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-default dropdown-toggle" type="button" href="<?= base_url($__controller . '/editProduct/' . $row->Product_ID . '/') ?>">
                                                    <i class="fa fa-edit"></i> <?= getSystemString(43) ?>
                                                </a>
                                                <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span class="fa fa-angle-down"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                    <li>
                                                        <a href="<?= base_url($__controller . '/deleteProduct/' . $row->Product_ID . '/') ?>" onclick="return confirm('<?= getSystemString(45) ?>');" style="margin: 0px 5px;" class="delete-record dropdown-item">
                                                            <i class="fa fa-trash"></i>  <?= getSystemString(314) ?>
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
                                <tr><td colspan='5' class='text-center'><?= getSystemString(46) ?></td></tr>
                                <?PHP
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <?PHP
        }
        if (isset($product_id)) {
            ?>

            <div class="col-md-10">
                <h1><?= getSystemString(7905) ?></h1>

                <?PHP
                $lang_setting['website_lang'] = $website_lang;
                //load tabs
                $this->load->view('acp_includes/lang-tabs', $lang_setting);
                ?>

                <form action="<?= base_url($__controller . '/updateProduct'); ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="panel white" style="padding-bottom: 50px;">


                        <input type="hidden" name="product_id" value="<?= $product_id ?>">

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
                                        <input type="text" class="form-control" name="Product_Name_en" placeholder="<?= getSystemString(77) ?>" value="<?= $product[0]->Product_Name_en ?>">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="description"><?= getSystemString('product_description') ?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                        <input type="text" class="form-control" name="Product_Description_en"
                                               placeholder="<?= getSystemString('description') ?>" value="<?= $product[0]->Product_Description_en ?>" >

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
                                        <input type="text" class="form-control" name="Product_Name_ar" placeholder="<?= getSystemString(77) ?>" value="<?= $product[0]->Product_Name_ar ?>" dir="rtl">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="description"><?= getSystemString('product_description') ?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                        <input type="text" class="form-control" name="Product_Description_ar"
                                               placeholder="<?= getSystemString('description') ?>" value="<?= $product[0]->Product_Description_ar ?>" dir="rtl">

                                    </div>
                                </div>
                            </div>

                        </div>




                        <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                                <label for="product_logo"><?= getSystemString(14) ?></label>
                            </div>
                            <div class="col-xs-12 col-sm-8 no-padding-left">
                                <input type="file" name="Product_logo" id="product_logo" class="fileToUpload" >
                                <img id="previewHolder" class="previewImg-S" alt="" src="<?= base_url($GLOBALS['img_products_dir']) . $product[0]->Product_logo ?>" style="width: 200px;border-radius: 2px;margin-top:10px;display: block">
                            </div>
                        </div>


                        <hr>
                        <h3><?php getSystemString('Prices') ?></h3>
                        <div class="form-group row" id="prices">

                            <?php
                            $i = 1;
                            foreach ($prices as $row):
                                ?>
                                <div>
                                    <br><br><br>
                                    <div class="col-lg-1 col-sm-4 col-md-2">
                                        <label for="Product_logo"><?= getSystemString('Type') ?> - EN</label>
                                    </div>
                                    <div class="col-lg-2 col-sm-8 no-padding-left">
                                        <input type="text" value="<?= $row->Name_en ?>" class="form-control" name="Name_en[]"
                                               placeholder="<?= getSystemString(38) ?>" dir="ltr">
                                        <input type="hidden" value="<?= $row->Price_ID ?>" class="form-control" name="pId[]"
                                               placeholder="<?= getSystemString(38) ?>" dir="ltr">
                                    </div>

                                    <div class="col-lg-1 col-sm-4 col-md-2">
                                        <label for="Product_logo"><?= getSystemString('Type') ?> - AR</label>
                                    </div>
                                    <div class="col-lg-2 col-sm-8 no-padding-left">
                                        <input type="text" value="<?= $row->Name_ar ?>" class="form-control" name="Name_ar[]"
                                               placeholder="<?= getSystemString(38) ?>" dir="rtl">
                                    </div>

                                    <div class="col-lg-1 col-sm-4 col-md-2">
                                        <label for="Product_logo"><?= getSystemString('Price') ?></label>
                                    </div>
                                    <div class="col-lg-1 col-sm-8 no-padding-left">
                                        <input type="text" value="<?= $row->Price ?>" class="form-control" name="Price[]"
                                               placeholder="<?= getSystemString('price') ?>" dir="ltr">
                                    </div>
                                    <div class="col-lg-2 col-sm-4 col-md-2">
                                        <label for="Product_logo"><?= $row->period . ' days' ?></label>
                                    </div>
                                    <div class="col-lg-2 col-sm-8 no-padding-left">
                                        <button type="button" data-id="<?= $row->Price_ID ?>" class="btn btn-success del_price"/><span class="fa fa-trash"></span></button>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                            ?>

                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-success" id="add_price"/><span class="fa fa-plus"></span></button></div>
                    </div>

            </div>
            <div class="form-group">
                <div class="col-xs-12 text-center">
                    <input type="submit" class="btn btn-primary" value="<?= getSystemString(16) ?>" name="submit" />
                </div>
            </div>



            </form>
        </div>

        <?PHP
    }
    ?>
</div>
<div id="price_tamp" style="display:none">

    <div><br><br><br>
        <div class="col-lg-1 col-sm-4 col-md-2">
            <label for="Product_logo"><?= getSystemString('Type') ?> - EN</label>
        </div>
        <div class="col-lg-2 col-sm-8 no-padding-left">
            <input type="text" class="form-control" name="Name_en[]"
                   placeholder="<?= getSystemString(38) ?>" >
        </div>

        <div class="col-lg-1 col-sm-4 col-md-2">
            <label for="Product_logo"><?= getSystemString('Type') ?> - AR</label>
        </div>
        <div class="col-lg-2 col-sm-8 no-padding-left">
            <input type="text" class="form-control" name="Name_ar[]"
                   placeholder="<?= getSystemString(38) ?>" dir="rtl">
        </div>

        <div class="col-lg-1 col-sm-4 col-md-2">
            <label for="Product_logo">Price</label>
        </div>
        <div class="col-lg-1 col-sm-8 no-padding-left">
            <input type="text" class="form-control" name="Price[]"
                   placeholder="<?= getSystemString('price') ?>">
        </div>
        <div class="col-lg-2 col-sm-8 no-padding-left">
            <input type="text" class="form-control" name="period[]"
                   placeholder="<?= getSystemString('No_of_days') ?>" >
        </div>
        <div class="col-lg-2 col-sm-8 no-padding-left">
            <button type="button" data-id="0" class="btn btn-success del_price"/><span class="fa fa-trash"></span></button>
        </div>
    </div>
</div>
</div>
<?PHP
$this->load->view('acp_includes/footer');
?>
<script>
    jQuery("#add_price").click(function () {

        jQuery("#prices").append(jQuery("#price_tamp").html());

    });

    $(document).on('click', '.del_price', function () {
        var id = $(this).attr("data-id");
        var parent = $(this).parent().parent();
        
        if(id!=0){
            $.post("<?= base_url('acp/products/deletePrice') ?>" + '/' + id,
                    {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                    },
                    function (data) {
                        if (data == '1')
                            parent.remove();
                    });
        }else{
            parent.remove();    
        }


    });
    $(function () {

        $(document).on('click', "#product_table tr td .hurkanSwitch", function () {
            ChangeStatusFor($(this), 'products');
        });

        ChangeOrder('products');
    });

</script>
</body>
</html>
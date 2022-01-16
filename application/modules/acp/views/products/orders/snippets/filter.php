<h5 class="page-title">
    <?= getSystemString(347) ?>
</h5>
<div class="col-xs-12 no-padding">
    <form action="" method="post" id="filter_product_orders">
        <div class="col-xs-12 col-sm-4 col-md-1 float-right-left">
            <div class="form-group">
                <select class="form-control select2" id="filter_product">
                    <option value="">
                        <?= getSystemString('select product') ?>
                    </option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $product->Product_ID ?>">
                            <?= $product->{'Product_Name_' . $__lang} ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-2 float-right-left">
            <div class="form-group">
                <input type="text" id="filter_name" placeholder="<?= getSystemString(81) ?>" class="form-control" />
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-2 float-right-left">
            <div class="form-group">
                <input type="text" id="filter_email" placeholder="<?= getSystemString(1) ?>" class="form-control" />
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-2 float-right-left">
            <div class="form-group">
                <input type="text" id="filter_domain" placeholder="<?= getSystemString('domain') ?>" class="form-control" />
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-2 float-right-left">
            <div class="form-group">
                <select class="form-control select2" id="filter_status">
                    <option value="">
                        <?= getSystemString(349) ?>
                    </option>
                    <option value="created">
                        <?= getSystemString('created') ?>
                    </option>
                    <option value="pending">
                        <?= getSystemString('Pending') ?>
                    </option>   
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-2 float-right-left">
            <div class="form-group">
                <select class="form-control select2" id="filter_payment">
                    <option value="">
                        <?= getSystemString(349) ?>
                    </option>
                    <option selected="selected" value="1">
                        <?= getSystemString(102) ?>
                    </option>
                    <option value="-1">
                        <?= getSystemString('payment_not_verified') ?>
                    </option>

                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-1 float-right-left">
            <div class="form-group">
                <input type="submit" id="filter_product_orders" class="btn btn-primary" value="<?= getSystemString(135) ?>" name="submit" />
            </div>
        </div>

        <div class="col-xs-12 text-center float-right-left">

        </div>


    </form>
</div>

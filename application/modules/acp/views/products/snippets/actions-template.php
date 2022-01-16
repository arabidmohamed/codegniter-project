<?PHP ?>
<div class="btn-group">
    <a class="btn btn-default dropdown-toggle" type="button" href="<?= $order_details ?>">
        <i class="fa fa-eye"></i> <?= getSystemString(351) ?>
    </a>
    <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-angle-down"></span>
    </button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
        <li>
            <a href="<?= $order_details ?>" style="margin: 0px 5px;" class="dropdown-item">
                <i class="fa fa-eye"></i>  <?= getSystemString('order details') ?>
            </a>
        </li>

    </ul>
</div>
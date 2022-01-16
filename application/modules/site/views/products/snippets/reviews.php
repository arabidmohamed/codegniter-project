<div class="col-xs-12 col-sm-12 float-right-left mb-2 no-padding" style="margin-bottom: 2.5em">
    <input type="hidden" value="<?= $product->Class_ID ?>" id="p_id">
    <div class="col-xs-12 px-0 comments-container no-padding">
        <div class="col-xs-12 no-padding apnd-cnt">
            <?PHP
$reviews = $product->ProductReviews;
if (count($reviews) > 0) {
?>
           <div class="col-xs-12 cmt-hdr">
                <h2 class="clr-theme fs-2"><?= getSystemString(332) ?></h2>
            </div>


            <?PHP
}
$usr_id = '';
foreach ($reviews as $row) {
    $usr_id = $row->Customer_ID;
    $date   = new DateTime($row->TimeStamp);
?>

            <div class="col-xs-12 col-sm-2 col-md-1 float-right-left  hr-tr-pst">
                <img class="avatar p-avatar" src="<?=base_url('style/acp/img/avatar1.png')?>">
            </div>
            <div class="col-xs-12 col-sm-10 col-md-11 float-right-left  hr-tr-pst">
                <div class="col-xs-12 no-padding cmt-details">
                    <div class="col-xs-12">
                        <span class="clr-theme cmt-name">
                                <?= $row->Fullname ?>
                           </span>
                        <span class="cmt-date">
                                <?= $row->TimeStamp ?>
                           </span>
                    </div>
                    <div class="col-xs-12">
                        <p class="cmt-comment">
                            <?= $row->Review ?></p>
                    </div>

                    <div class="col-xs-12 hr-helper-btn-div">
                        <?PHP
    if (($this->session->userdata($this->site_session->userid()) != null || $this->session->userdata($this->site_session->userid())) && $row->Customer_ID == $this->session->userdata($this->site_session->userid()) && date('d-m-Y') == $date->format('d-m-Y')) {
?>
                       <span class="hr-helper-btns">
                                        <a href="#" role="button" class="edit-ans" data-ansid="<?= $row->Review_ID ?>" title="<?= getSystemString(43) ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="#" role="button" class="delete-ans" data-target="product" data-ansid="<?= $row->Review_ID ?>" title="<?= getSystemString(44) ?>">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </span>

                        <?PHP
    }
?>
                   </div>

                </div>
            </div>
            <?PHP
} // end foreach 
?>
       </div>
    </div>
</div>
<?PHP
if (($this->session->userdata($this->site_session->userid()) != null || $this->session->userdata($this->site_session->userid())) && $this->session->userdata($this->site_session->phone_verified()) > 0) {
?>

<div class="c-product-review-input write-comment-container" data-editmode="0" data-targetid="" style="padding: 15px">
    <h3 class="c-font-bold c-font-uppercase"><?=getSystemString('submit_your_review')?></h3>
    <textarea class="form-control" id="editor2"></textarea>
    <button class="btn c-btn c-btn-square c-theme-btn c-font-bold c-font-uppercase c-font-white" id="send_review"><?=getSystemString('submit_review')?></button>
</div>

    <?PHP
}
?>
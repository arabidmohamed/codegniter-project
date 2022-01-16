<?PHP
/* load header contents #menu */
$__lang = $this->session->userdata($this->site_session->__lang_h());

$title = 'Title_'.$__lang;
$category = 'Category_'.$__lang;
$subtitle = 'Subtitle_'.$__lang;
$content = 'Content_'.$__lang;                                    
?>
<div id="portfolio_details_<?=$portfolio->Portfolio_ID?>">

    <div class="cbp-l-project-title">
        <?=$portfolio->$title?>
    </div>
    <div class="cbp-l-project-subtitle">
        <?=$portfolio->$subtitle?>
    </div>
    <div class="cbp-l-project-desc-text">
        <?=$portfolio->$content?>
</div>
    
    <div class="cbp-img-wrapper text-center">
    <?PHP
        foreach($portfolio->Details as $detail):
            if($portfolio->PortfolioType == 'pic'):
                $url = base_url($GLOBALS['img_work_details_dir'].$detail->Details);
    ?>
                <img src="<?=$url?>" alt="<?=$portfolio->$title?>" style="width: 100%;margin-bottom: 10px">
        <?PHP
            else:
        ?>
            <iframe src="<?=$detail->Details.'?autoplay=1&rel=0'?>" frameborder="0" allowfullscreen="" style="width:100%;height: 70vh"></iframe>
    <?PHP
            endif;
        endforeach;
    ?>
    </div>
    <div class="col-xs-12 text-center">
        <?PHP
            if($portfolio->PortfolioType == 'pic' && strlen($portfolio->Link) > 0):
        ?>
                <a href="<?=$portfolio->Link?>" target="_blank" class="cbp-l-project-details-visit btn btn-sm c-btn-border-1x c-btn-square c-btn-dark c-btn-uppercase c-btn-bold" style="margin:1em auto 3em auto;float:unset">
                    <?=getSystemString('visit_the_site')?>
                </a>
        <?PHP
            endif;
        ?>
    </div>
</div>
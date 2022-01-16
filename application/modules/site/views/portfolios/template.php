<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());

    $title = 'Title_'.$__lang;
    $category = 'Category_'.$__lang;
?>
<style>
	.cbp-popup-navigation-wrap .cbp-popup-next{display: none !important}
	.cbp-popup-navigation-wrap .cbp-popup-prev{display: none !important}
	.cbp-popup-singlePage-counter{display: none !important}
	.cbp-popup-singlePage .cbp-popup-close{right: -90% !important;}
</style>
<div class="cbp-panel">
    <div id="portfolio-filters" class="cbp-l-filters-buttonCenter">
        <div data-filter="*" class="cbp-filter-item-active cbp-filter-item">
            <?=getSystemString(207)?> <div class="cbp-filter-counter"></div>
        </div>

        <?PHP
            foreach($portfolio_categories as $c):
        ?>
                <div data-filter=".portfolio-filter-<?=$c->Category_ID?>" class="cbp-filter-item">
                    <?=$c->$category?> <div class="cbp-filter-counter"></div>
                </div>
        <?PHP
            endforeach;
        ?>
    </div>

    <div id="portfolio-container" class="cbp cbp-l-grid-masonry-projects portfolio-container cbp-masonary-layout" data-filter="#portfolio-filters">

        <?PHP
            foreach($portfolios as $portfolio):
                $thumbnail = base_url($GLOBALS['img_work_dir'].$portfolio->Thumbnail);
                //$originalImg = base_url($GLOBALS['img_work_dir'].$portfolio->Original_Img);

                $cids = explode(",", $portfolio->Category_ID);
                $classes = '';
                foreach($cids as $category_id):
                    $classes .= "portfolio-filter-".$category_id.' ';
                endforeach;

                $is_video = $portfolio->PortfolioType == 'vid' ? 'is-video' : '';
        ?>
                <div class="cbp-item <?=$is_video?> <?=$classes?>">
                    <div class="cbp-caption">
                        <div class="cbp-caption-defaultWrap">
                            <?PHP
                            if($portfolio->PortfolioType == 'pic'):
                            ?>
                                <img src="<?=$thumbnail?>" alt="<?=$portfolio->$title?>">
                            <?PHP
                            else:
                            ?>
                                <iframe src="<?=$portfolio->Details[0]->Details?>" frameborder="0" style="width:100%;"></iframe>
                            <?PHP
                            endif;
                            
                            ?>
                        </div>
                        <div class="cbp-caption-activeWrap">
                            
                            <div class="c-masonry-border"></div>
                            <div class="cbp-l-caption-alignCenter">
                                <div class="cbp-l-caption-body">
                                    <?PHP
                                        if(count($portfolio->Details) > 0):
                                    ?>
                                            <a href="<?=base_url('portfolio/details/'.$portfolio->Portfolio_ID)?>" class="cbp-singlePage cbp-l-caption-buttonRight btn c-btn-square c-btn-border-1x c-btn-white c-btn-bold c-btn-uppercase">More Info</a>
                                    
                                    <?PHP
                                        endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:;" class="cbp-l-grid-masonry-projects-title">
                        <?=$portfolio->$title?>
                    </a>
                </div>
        <?PHP
            endforeach;
        ?>

    </div>

</div>
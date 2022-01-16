<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());

    $title = 'Title_'.$__lang;
    $category = 'Category_'.$__lang;
?>
<div class="cbp-panel">
    <div id="filters-container" class="cbp-l-filters-buttonCenter">
        <div data-filter="*" class="cbp-filter-item-active cbp-filter-item">
            <?=getSystemString(207)?> <div class="cbp-filter-counter"></div>
        </div>

        <?PHP
            foreach($album_categories as $c):
        ?>
                <div data-filter=".cust-filter-<?=$c->Category_ID?>" class="cbp-filter-item">
                    <?=$c->$category?> <div class="cbp-filter-counter"></div>
                </div>
        <?PHP
            endforeach;
        ?>
    </div>

    <div id="grid-container" class="cbp cbp-l-grid-masonry-projects cbp-masonary-layout" data-filter="#filters-container">

        <?PHP
            foreach($albums as $album):
                $thumbnail = base_url($GLOBALS['img_work_dir'].$album->Thumbnail);
                $originalImg = base_url($GLOBALS['img_work_dir'].$album->Original_Img);

                $cids = explode(",", $album->Category_ID);
                $classes = '';
                foreach($cids as $category_id):
                    $classes .= "cust-filter-".$category_id.' ';
                endforeach;
        ?>
                <div class="cbp-item <?=$classes?>">
                    <div class="cbp-caption">
                        <div class="cbp-caption-defaultWrap">
                            <img src="<?=$thumbnail?>" alt="<?=$album->$title?>">
                        </div>
                        <div class="cbp-caption-activeWrap">
                            <div class="c-masonry-border"></div>
                            <div class="cbp-l-caption-alignCenter">
                                <div class="cbp-l-caption-body">
                                    <a href="<?=$originalImg?>" class="cbp-lightbox cbp-l-caption-buttonRight btn c-btn-square c-btn-border-1x c-btn-white c-btn-bold c-btn-uppercase" data-title="<?=$album->$title?>">
                                        <?=getSystemString('zoom')?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:;" class="cbp-l-grid-masonry-projects-title">
                        <?=$album->$title?>
                    </a>
                </div>
        <?PHP
            endforeach;
        ?>

    </div>

    <!-- <div id="loadMore-container" class="cbp-l-loadMore-button c-margin-t-60">
        <a href="ajax/masonry-gallery/load-more.html" class="cbp-l-loadMore-link btn c-btn-square c-btn-border-2x c-btn-dark c-btn-bold c-btn-uppercase">
            <span class="cbp-l-loadMore-defaultText">LOAD MORE</span>
            <span class="cbp-l-loadMore-loadingText">LOADING...</span>
            <span class="cbp-l-loadMore-noMoreLoading">NO MORE WORKS</span>
        </a>
    </div> -->
</div>
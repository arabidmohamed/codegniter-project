<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">

<style>
#products_list tr td{
	display: flex;
	flex-wrap: wrap;
}
.c-content-product-2{
	position: relative;
	padding-bottom: 10px;
	width: 100%;
}
.c-content-product-2 .rating-container{
	width: 140px;
	margin: auto;
	margin-bottom: 10px;
}
.c-content-product-2 .btn-action-container{
	position: absolute;
	bottom: 0px;
}
body[dir="ltr"] .c-shop-result-filter-1 .c-filter{
	float: left;
}
body[dir="ltr"] .c-shop-result-filter-1 .c-filter + .c-filter{
	padding-right: 0px;
	padding-left: 20px;
}
.select2{
	width: 180px !important;
}
.add-to-cart{
    margin-top: 0px;
}
.body-website .container-fluid {
    min-height: 65vh;	
}
@media(max-width:400px)
{
	.image-cat .box-cat .overlay h3
	{
		margin-top: 4px !important;
	}
}
</style>
<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');
	
	$category = 'Category_'.$__lang;
	$subcategory = 'SubCategory_'.$__lang;
	
	$this->load->view('products/snippets/filter');
?>

		<!--  Start Body Website -->
        <div class="body-website">
          <div class="container-fluid">
              <div class="content">

                 <ul class="list-inline-block reset-ul breadcrumb">
                   <li> <a href="<?=base_url('')?>"><?=getSystemString(218)?>  </a> </li>
                   <li> <a href="<?=base_url('products')?>"><?=getSystemString(299)?></a> </li>
                 </ul>
				
                 <div class="row">
                   <div class="col-md-2 direction">
                     <h2 class="clr-7b6a44 heading-page"> <?=getSystemString(317)?>   </h2>
                     <ul class='reset-ul list-name-cat'>
	                    <?PHP
		                    //print_r($subcategories);
			            	if(isset($filter->subcategory_slug)):
			            ?>
                       <?php 
							$Ctitle = 'SubCategory_'.$__lang;
	                        foreach($subcategories as $row):
	                        		
                       ?>
                       <li class="<?php if($row->Slug == $filter->subcategory_slug){ echo 'active'; } ?>"> <a href="<?=route_url($row->Slug)?>"> <?=$row->$Ctitle?> </a> </li>
                       <?php endforeach; ?>
                       <?PHP
	                       
			            	endif;
			           ?>
                     </ul>
                   </div>
                   <div class="col-md-10">
                      <div class="row image-cat">
						
						<table id="products_list" style="width: 100%">
							<thead>
								<tr><th></th></tr>
							</thead>
							<tbody></tbody>
						</table>

                      </div>
                   </div>
                 </div>



              </div> <!--/.Content -->
          </div> <!--/.container-fluid -->
        </div>
        <!-- Start Body Website   -->


<?PHP
	$this->load->view('includes/footer', $website_config);
	$this->load->view('includes/custom_scripts_footer');
?>

<script>
	$(".c-mega-menu li[data-page=products]").addClass("c-active");
</script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['home_js_dir'].'/pagescripts/site.js?v=6')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['home_js_dir'].'/pagescripts/products.js?v=2.1')?>"></script>
<?PHP
	$this->load->view('includes/analytics');
?>
  </body>
</html>
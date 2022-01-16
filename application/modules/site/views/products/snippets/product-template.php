<?php
	// added by A (23 Oct 2019) in order hide the white imgplaceholder when there are product image available
	if(!empty($prod_cover))
	{
		$style = 'background-image:none;';
	}
?>
<div class="col-md-3 col-sm-6">
  <div class="box-cat imgplaceholder" style="<?=$style?>">
	<div class="img" style="background-image: url('<?=$prod_cover?>')"></div>
	<div class="overlay text-center">
		<a href="<?=$product_link?>">
			<h3 class="p_title"><?=$name?></h3>
		</a>
		<h3> <?=($price + number_format($tax, 2))?> SR </h3>
		<a href="javascript: void(0)" class="btn-outline add-to-cart" data-productslug="<?=$product_slug?>" data-productid="<?=$Class_ID?>">
		<?PHP
				$showhide = 'hide';
				if($is_in_cart){ 
					$showhide = 'hide';
				}
			?>
		<span class="product_in_cart <?=$showhide?>">
			<i class="fa fa-check-circle text-default"></i>
		</span> 
		<?=getSystemString(293)?> <img src="<?=base_url('style/site/assets/img/icons/icon-cat-outline.png')?>" alt=""></a>
	</div>
  </div>
</div>
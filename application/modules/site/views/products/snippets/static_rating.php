<div class="col-xs-12 px-0">
    <div class="user-rating">
        <span class="d-inline-block rating-cnt-clr float-right-left" style="margin-bottom:4px">(<?=$rating_count?>)</span>
        <span class="d-inline-block float-right-left">
		<?PHP
										 
			for($j = 0; $j < $avgRating; $j++){
				 $av = 'fa-star star-grey';
				 if($rating_count >= 5){
					 $av = 'fa-star star-colored';
				 }
				 echo '<i class="fa '.$av.'"></i>';
			}
			
			for($k = 0; $k < (5 - $avgRating); $k++){
			 	echo '<i class="fa fa-star star-grey"></i>';
			}
										 
										 
		?>
		</span>
    </div>
</div>
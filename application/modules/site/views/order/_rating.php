<div class="user-rating lg-in">
	<span class="d-inline-block float-right-left">
		<div class="rating">
			<input type="radio" id="star<?=$reviewFor?>5" name="rating<?=$reviewFor?>" value="5" required data-parsley-required-message="<?=getSystemString('please_give_a_rating')?>"/>
			<label class = "full" for="star<?=$reviewFor?>5" title="Awesome - 5 stars"></label>
			<input type="radio" id="star<?=$reviewFor?>4" name="rating<?=$reviewFor?>" value="4" required data-parsley-required-message="<?=getSystemString('please_give_a_rating')?>"/>
			<label class = "full" for="star<?=$reviewFor?>4" title="Pretty good - 4 stars"></label>	
		    <input type="radio" id="star<?=$reviewFor?>3" name="rating<?=$reviewFor?>" value="3" required data-parsley-required-message="<?=getSystemString('please_give_a_rating')?>"/>
		    <label class = "full" for="star<?=$reviewFor?>3" title="Meh - 3 stars"></label>	
			<input type="radio" id="star<?=$reviewFor?>2" name="rating<?=$reviewFor?>" value="2" required data-parsley-required-message="<?=getSystemString('please_give_a_rating')?>"/>
			<label class = "full" for="star<?=$reviewFor?>2" title="Kinda bad - 2 stars"></label>
			<input type="radio" id="star<?=$reviewFor?>1" name="rating<?=$reviewFor?>" value="1" required data-parsley-required-message="<?=getSystemString('please_give_a_rating')?>"/>
			<label class = "full" for="star<?=$reviewFor?>1" title="Very bad - 1 star"></label>
		</div>
	</span>
</div>
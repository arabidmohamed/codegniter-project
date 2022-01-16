
<div class="col-xs-12 px-0 mb-1">
    <?PHP 
	    //check if login 
	    if($this->session->userdata($this->site_session->userid())){ 
	    		// check if rating less than 5 prevent star from checking 
				if($rating_count < 5){ $avgRating=0 ; } ?>
        <div class="user-rating lg-in">

            <span class="d-inline-block rating-cnt-clr float-right-left" style="margin-bottom:4px">(<?=$rating_count?>)</span>

            <span class="d-inline-block float-right-left">
<div class="rating">
	<input type="radio" id="star5" name="rating" value="5" <?PHP if($avgRating == 5) {echo "checked";} ?> /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
	<input type="radio" id="star4" name="rating" value="4" <?PHP if($avgRating == 4) {echo "checked";} ?>  /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>	
    <input type="radio" id="star3" name="rating" value="3" <?PHP if($avgRating  == 3) {echo "checked";} ?>  /><label class = "full" for="star3" title="Meh - 3 stars"></label>	
	<input type="radio" id="star2" name="rating" value="2" <?PHP if($avgRating == 2) {echo "checked";} ?>  /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
	<input type="radio" id="star1" name="rating" value="1" <?PHP if($avgRating == 1) {echo "checked";} ?>  /><label class = "full" for="star1" title="Very bad - 1 star"></label>
</div>
</span>

        </div>
        <?PHP } else { 
	        
	        	$data['rating_count'] = $rating_count;
				$data['avgRating'] = $avgRating;
	        	$this->load->view('products/snippets/static_rating', $data);
	        
	         } ?>
</div>
<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$category = 'Category_'.$__lang;
	$subcategory = 'SubCategory_'.$__lang;
?>
<form class="form-horizontal hide" 
		method="post" 
		id="product_filter" 
		action="<?=base_url($__controller.'/filterProducts')?>">

	<input type="hidden" id="filter_search" value="<?=@$filter->search_query?>"/>
	<div class="c-filter hide">
		<label class="sr-only" for="inlineFormInputGroup">Categories</label>
		<select class="form-control" name="category" id="category">
			<option value=""><?=getSystemString(59)?></option>
			<?PHP
			foreach($categories as $row)
			{

				?>
				<option value="<?=$row->Slug?>" <?PHP
					if(isset($filter->category_slug))
					{
						if($cDetails[0]->Category_ID == $row->Category_ID):
							echo 'selected';
						endif;
					}?>><?=$row->$category?></option>
					<?PHP
				}
				?>
			</select>

			<input type="hidden" id="subcategory_lang" value="<?=$subcategory?>">
			<input type="hidden" value="<?=base_url($__controller.'/httpGetSubCategories')?>" id="getsubcategory_url">
		</div>

		<div class="c-filter">
			<label class="sr-only" for="inlineFormInputGroup">Sub Categories</label>
			<select class="form-control" name="subcategory" id="subcategory">
				<option value=""><?=getSystemString(59)?></option>
				<?PHP
				foreach($subcategories as $row)
				{

				?>
				<option value="<?=$row->Slug?>"
					<?PHP
					if(isset($filter->subcategory_slug))
					{
						if($scDetails[0]->SubCategory_ID == $row->SubCategory_ID):
							echo 'selected';
						endif;
					}?>><?=$row->$subcategory?></option>
					<?PHP
				}
					?>
				</select>
			</div>

			<div class="c-filter">
				<label class="sr-only" for="inlineFormInput">Product Name</label>
				<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="pname" placeholder="<?=getSystemString('type_anything_to_search')?>" value="">
			</div>

			<div class="c-filter">
				<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit"/>
			</div>
		</form>
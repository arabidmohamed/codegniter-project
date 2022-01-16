<form action="<?=base_url($__controller.'/updateProduct');?>" class="form-horizontal" method="post" enctype="multipart/form-data">	
  <div class="col-md-10">
    <h1>
      <?=getSystemString(306)?>
    </h1>
    <?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
    <div class="panel white" style="padding-bottom: 50px;">
      <div class="tab-content">				         	
        <input type="hidden" name="Class_ID" id="project_id" value="<?=$Class_ID?>">
        <div class="form-group">
          <div class="col-xs-12 col-sm-4 col-md-2">
            <label for="title">
              <?=getSystemString(58)?>
            </label>
          </div>
          <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
            <select class="form-control select_cat" name="subcategory">
              <?PHP
foreach($subcategories as $row){
$cat_nn = 'SubCategory_'.$__lang;
?>
              <option value="<?=$row->SubCategory_ID?>" 
                      <?PHP
              if($row->SubCategory_ID == $product[0]->SubCategory_ID){
              echo 'selected';
              }
               ?>>
              <?=$row->$cat_nn?>
              </option>
              <?PHP
	              }
              ?>
            </select>
        </div>
      </div>
      <div class="tab-pane fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
        <div class="form-group">
          <div class="col-xs-12 col-sm-4 col-md-2">
            <label for="title">
              <?=getSystemString(151)?>
            </label>
          </div>
          <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
            <input type="text" class="form-control" name="title_en" id="title_en" placeholder="<?=getSystemString(151)?>" value="<?=$product[0]->Title_en?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12 col-sm-4 col-md-2">
            <label for="title">
              <?=getSystemString(72)?>
            </label>
          </div>
          <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
            <textarea class="form-control" rows="4"  name="description_en"><?=$product[0]->Description_en?></textarea>
          </div>
        </div>
      </div>
      <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
        <div class="form-group">
          <div class="col-xs-12 col-sm-4 col-md-2">
            <label for="title">
              <?=getSystemString(151)?>
            </label>
          </div>
          <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
            <input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="<?=getSystemString(151)?>" dir="rtl" value="<?=$product[0]->Title_ar?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12 col-sm-4 col-md-2">
            <label for="title">
              <?=getSystemString(72)?>
            </label>
          </div>
          <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
            <textarea class="form-control" rows="4" name="description_ar"><?=$product[0]->Description_ar?></textarea>
          </div>
        </div>
      </div>
      
      
      <div class="form-group">
			<div class="col-xs-12 col-sm-4 col-md-2">
				<label for="title"><?=getSystemString(313)?></label>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left display-select2">
				<select class="form-control select_unit" name="unit" required data-parsley-required-message="<?=getSystemString(213)?>">
					<option value=""><?=getSystemString(310)?></option>
					<?PHP
						foreach($units as $row){
							$cat_nn = 'UnitName_'.$__lang;
							?>
							<option value="<?=$row->Unit_ID?>"
							 <?PHP
				              if($row->Unit_ID == $product_unit[0]->Unit_ID){
				              	echo 'selected';
				              }
				               ?>><?=$row->$cat_nn?></option>
							<?PHP
						}
					?>
				</select>
				
			</div>
		</div>
							
		<div class="form-group">
			<div class="col-xs-12 col-sm-4 col-md-2">
				<label for="title"><?=getSystemString(316)?></label>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
				<input type="text" class="form-control" name="weight" placeholder="<?=getSystemString(318)?>" required data-parsley-required-message="<?=getSystemString(213)?>" value="<?=$product_unit[0]->Weight?>">
				
			</div>
		</div>
      
      <div class="form-group">
        <div class="col-xs-12 col-sm-4 col-md-2">
          <label for="title">
            <?=getSystemString(303)?>
          </label>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
          <input type="number" class="form-control" name="price" placeholder="<?=getSystemString(303)?>" required data-parsley-required-message="<?=getSystemString(213)?>" value="<?=$product_unit[0]->Price?>">
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-xs-12 col-sm-4 col-md-2">
          <label for="title">
            <?=getSystemString(302)?>
          </label>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
          <input type="number" class="form-control" name="quantity" required data-parsley-required-message="<?=getSystemString(213)?>" placeholder="<?=getSystemString(302)?>" value="<?=$product[0]->Quantity?>">
        </div>
      </div>
      
    </div>    
  </div>
  </div>
<div class="col-md-10">
  <h1>
    <?=getSystemString(305)?>
  </h1>
  <div class="panel white" style="padding-bottom: 50px;">
    <table class="table table-hover sortable-2 sortable-tb" id="project_details_table">
      <thead>
        <tr>
          <th>
            <?=getSystemString(149)?>
          </th>
          <th>
            <?=getSystemString(177)?>
          </th>
          <th>
            <?=getSystemString(150)?>
          </th>
          <th>
            <?=getSystemString(152)?>
          </th>
          <th colspan="2">
            <?=getSystemString(153)?>
          </th>
        </tr>
      </thead>
      <tbody>
        <?PHP
if(count($product_det)){
$i = 0;
foreach($product_det as $row){
$i++;
$dt = new DateTime($row->TimeStamp);
?>
        <tr id="<?=$row->PD_ID;?>">
          <td class="hide">
            <?=$row->PD_ID;?>
          </td>
          <td class="index">
            <?=$i?>
          </td>
          <td>
            <?=$dt->format('d-m-Y');?>
          </td>
          <td>
            <img src="<?=base_url($GLOBALS['img_product_dir']).$row->Pictures;?>" alt='picture' style="width: 40px;">
          </td>
          <td>
            <input type="radio" class="radio" 
                   name="cover_pic" 
                   value="<?=$row->PD_ID?>"
                   <?PHP if($row->Is_Cover == 1) { echo 'checked'; } ?>
				   data-pid="<?=$row->Class_ID?>" style="margin:auto">
          </td>
          <!-- 									       <td><a href="<?=base_url($__controller.'/editProjectDet_v3/'.$row->Detail_Tag.'/'.$row->PD_ID.'/')?>"><?=getSystemString(154)?></a></td> -->
          <td>
            <a href="<?=base_url($__controller.'/deleteProduct/'.$row->PD_ID.'/'.$row->Class_ID)?>" onclick="return confirm('<?=getSystemString(45)?>');">
              <?=getSystemString(155)?>
            </a>
          </td>
        </tr>
        <?PHP
}
} else {
echo '<tr><td colspan="5" class="text-center">No Product Details </td></tr>';
}
?>
      </tbody>
    </table>	
    <div class="col-xs-12">
      <div class="dropzone dz-clickable" id="img-dropzone">
        <div class="dz-message needsclick">
          <p>
            <i class="fa fa-cloud-upload fa-2x">
            </i>
          </p>
          <?=getSystemString(169)?>
        </div>
      </div>
    </div>	          
  </div>
</div>
<div class="form-group">
  <div class="col-xs-10 text-center">
    <input type="submit" class="btn btn-primary" value="<?=getSystemString(157)?>" />
  </div>
</div>
</form>
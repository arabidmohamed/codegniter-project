	<style>
		.panel.white{
			min-height: 150px;
		}
		.nav-social{
			padding: 0px;
			list-style: none;
			width: auto;
			margin: auto;
			height: 30px;
		}
		table th{
			width: 200px;
		}
		.user-class->Rating{
			text-align: center;
			direction: ltr;
			width:135px;
			margin:auto;
		}
		body[dir="rtl"] .user-class->Rating{
			direction: rtl;
		}
		.user-class->Rating .fa{
			font-size: 22px;
			margin: 1px;
		}
		.star-grey{
			color: #e8e8e8;
		}
		.star-colored{
			color:#ffcc00;
		}
		body[dir="ltr"] th, body[dir="ltr"] td{
			text-align: left !important;
		}
		body[dir="rtl"] th, body[dir="rtl"] td{
			text-align: right !important;
		}
	</style>
	<?PHP
		$title = 'Title_'.$__lang;
		$subcategory = 'SubCategory_'.$__lang;
		$category = 'Category_'.$__lang;
		$tags = 'Tags_'.$__lang;
    $content = 'Content_'.$__lang;

    $branchName = 'Name_'.$__lang;


	?>
	<div id="content-main">
		
		<div class="row">
			<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
		</div>
		
		<div class="row">
						
			<div class="col-md-12">
				<h3 class="text-primary" onclick="javascript: window.location.reload()" style="cursor: pointer"><?=$class->$title?></h3>
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					
					<table class="table table-hover display col-md-6" id="members_table" width="100%">
						<tbody>

									<tr>
								<th><?=getSystemString('branch_name')?></th>
								<td>
									<?PHP
										echo $class->$branchName
									?>	
								</td>
							</tr>

								<tr>
								<th><?=getSystemString(311)?></th>
								<td>
									<?PHP
										echo $class->$title
									?>	
								</td>
							</tr>

								<tr>
								<th><?=getSystemString('teacher_name')?></th>
								<td>
									<?PHP
										echo $class->Fullname
									?>	
								</td>
							</tr>

													<tr>
								<th><?=getSystemString('academic_year')?></th>
								<td>
									<?PHP
										echo $class->Academic_Year
									?>	
								</td>
							</tr>

									</tbody>
					</table>


<table class="table table-hover display col-md-6" id="members_table" width="100%">
						<tbody>

							<tr >
								<th><?=getSystemString(367)?></th>
								<td>
									<div class="user-class->Rating pull-left">
									 <!-- 	<span class="d-inline-block class->Rating-cnt-clr float-right-left" style="margin: 4px 1px;">(<?=$class->Rating?>)</span> -->
								 		<span class="d-inline-block float-right-left">
								             <?PHP
                                        if(!empty($class->Rating)):
                                            for($i = 0; $i < $class->Rating; $i++):
                                        ?>
                                               <i class="fa fa-star" style="color: #F6BF65"></i>
                                        <?PHP
                                            endfor;
                                            for($i = 0; $i < 5 - $class->Rating; $i++):
                                        ?>
                                              <i class="fa fa-star" style="color: #dadada"></i> 
                                        <?PHP
                                            endfor;
                                        endif;
                                   ?>
									 	</span>
								 
									</div>
								</td>
							</tr>
						

							<tr>
								<th><?=getSystemString('experience_years')?></th>
								<td>
									<?PHP
										echo $class->Experience_Years.' '.getSystemString('years')
									?>	
								</td>
							</tr>

								<tr>
								<th><?=getSystemString('children_number')?></th>
								<td>
									<?PHP
										echo $class->Student_Number.' '.getSystemString('children')
									?>	
								</td>
							</tr>

											<tr>
								<th><?=getSystemString('Registered_Number')?></th>
								<td>
									<?PHP
										echo $class->Registered_Number
									?>	
								</td>
							</tr>
	</tbody>
					</table>




					<table class="table table-hover display" id="members_table" style="margin-top: 150px" width="100%">
						<tbody>

												<tr>
								<th><?=getSystemString('geographical_location')?></th>
								<td>
									<?PHP
										echo $class->branch_address
									?>	
								</td>
							</tr>

							<tr>
								<th><?=getSystemString('about_class')?></th>
								<td>
									<?PHP
										echo $class->$content
									?>	
								</td>
							</tr>


									<tr>
								<th><?=getSystemString('about_responsible')?></th>
								<td>
									<?PHP
										echo $class->Experience_Details
									?>	
								</td>
							</tr>


							
							<?PHP
								if(count($class->ClassGallery) > 0){
									?>
									
									<tr>
										<th><?=getSystemString(366)?></th>
										<td>
											<?PHP
												foreach($class->ClassGallery as $pic){
													$img = base_url($GLOBALS['img_class_dir'].$pic->Pictures);
													?>
													
													<img src="<?=$img?>" style="width: 200px">
													
													<?PHP
												}
											?>
										</td>
									</tr>
									
									<?PHP
								}
							?>
							
						</tbody>
					</table>
											
				</div>
			</div>
			
			<?PHP
				$outletName = "Name_".$__lang;
				
				if(count($class->ClassStudents) > 0):
			?>
			<div class="col-md-12">
				<h3><?= getSystemString('class_students') ?></h3>
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					<table class="table table-hover display" width="100%">
						<thead>
							<tr>
								<th><?=getSystemString('ID_number')?></th>
								<th><?=getSystemString('student_name')?></th>
								<th><?=getSystemString(210)?></th>
								<th><?=getSystemString(236)?></th>
								<th><?=getSystemString('parent_name')?></th>
								<th><?=getSystemString('relation_type')?></th>
								
								
							</tr>
						</thead>
						<tbody>
							<?PHP
								foreach($class->ClassStudents as $in):
									// $date = new DateTime($in->Timestamp);
								?>
									<tr>
									
										<td><?=$in->Student_ID_Num?></td>
										<td><?=$in->Student_FullName?></td>
										<td><?=$in->Student_Birthdate?></td>
										<td><?= GetConstantById($in->Student_Gender,$__lang)?></td>
										<td><?=$in->Fullname?></td>
										<td><?=GetConstantById($in->Relation_Type,$__lang)?></td>

							
										<td>
											<a href="<?=base_url($__controller."/edit/".$in->Class_ID)?>" class="btn btn-default btn-sm">
												<span class="fa fa-pencil"></span> <?=getSystemString("42")?>
											</a>
										</td>
									</tr>
								
								<?PHP
								endforeach;
							?>
						</tbody>
					</table>					
				</div>
			</div>
			
			<?PHP
				endif;
		
			?>

						
		</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>
</body>
</html>
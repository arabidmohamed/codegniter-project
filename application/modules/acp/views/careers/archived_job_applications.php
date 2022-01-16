	<style>
		.panel.white{
			min-height: 220px;
		}

        <?php if($__lang == 'ar'): ?>
        .toolbar {float: left}
        .dataTables_wrapper .dataTables_length {
            float: left !important;
        }
        table tr th, table td {
            text-align: right !important;
            padding-right: 20px !important;
        }
        <?php else: ?>
        table tr th, table td{
            text-align: left !important;
            padding-left: 20px !important;
        }
        <?php endif; ?>
	</style>
	<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
	<div id="content-main">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="<?=getSystemString(493)?> <"><a href="<?=base_url('acp/careers/listall')?>"><?=getSystemString(493)?></a></li>
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(192)?> <"><?=getSystemString(192)?> </li>
            </ol>
        </nav>
		<h1><?=getSystemString(192)?></h1
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
<div class="col-md-12">
						<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;margin-bottom: 10px">
								<h4><?=getSystemString(193)?></h4>
								<div class="col-xs-12 no-padding">
									<form action="<?=base_url($__controller.'/filterArchivedApplications')?>" method="post">
									<div class="col-xs-12 col-sm-3">
										<div class="form-group">
											<input type="text" name="name" placeholder="<?=getSystemString(136)?>" class="form-control" />
										</div>
									</div>
									
									<div class="col-xs-12 col-sm-3">
										<div class="form-group">
											<select class="form-control career-input" id="gender" name="gender">
											   <option value="0"><?=getSystemString(198)?></option>
										       <option value="male"><?=getSystemString(194)?></option>
										       <option value="female"><?=getSystemString(195)?></option>
				       						</select>
										</div>
									</div>
									
									<div class="col-xs-12 col-sm-3">
										<div class="form-group">
											<select class="form-control" id="nationality" name="nationality">
										   		  <option value="0"><?=getSystemString(196)?></option>
												  <?PHP
										foreach($nationalities as $row){
											$natTitle = 'Nationality_'.$__lang;
											?>
											<option value="<?=$row->$natTitle?>"><?=$row->$natTitle?></option>
											<?PHP
										}
									?>
				       						</select>

										</div>
									</div>
									
									<div class="col-xs-12 col-sm-3">
										<div class="form-group">
											<select class="form-control" id="" name="city">
												<option value="0"><?=getSystemString(197)?></option>
												 <?PHP
										foreach($cities as $row){
											$cityTitle = 'name_'.$__lang;
											?>
											<option value="<?=$row->$cityTitle?>"><?=$row->$cityTitle?></option>
											<?PHP
										}
									?>
											</select>
										</div>
									</div>
									
									<div class="col-xs-12 col-sm-3">
										<div class="form-group">
											<input type="email" name="email" placeholder="<?=getSystemString(1)?>" class="form-control" />
										</div>
									</div>
									
									<div class="col-xs-12 col-sm-3">
										<div class="form-group">
											<input type="text" name="no" placeholder="<?=getSystemString(206)?>" class="form-control" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-3">
										<div class="form-group">
											<select class="form-control" id="job" name="job">
												<option value="0"><?=getSystemString(199)?></option>
												<option value="all"><?=getSystemString(207)?></option>
												<?PHP
										foreach($jobs as $row){
											$jobTitle = 'Title_'.$__lang;
											?>
											<option value="<?=$row->Job_ID?>"><?=$row->$jobTitle?></option>
											<?PHP
										}
									?>
											</select>
										</div>
									</div>

									<div class="col-xs-12 text-center">
										<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
									</div>
								</form>
								</div>
							</div>
						<br />
						<h3><?=getSystemString(188)?></h3>
						<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
								<table class="table table-hover display" id="applications" width="100%">
									<thead>
										<tr>
											<th><?=getSystemString(41)?></th>
											<th><?=getSystemString(177)?></th>
											<th><?=getSystemString(136)?></th>
											<th><?=getSystemString(1)?></th>
											<th><?=getSystemString(137)?></th>
											<th><?=getSystemString(200)?></th>
											<th><?=getSystemString(201)?></th>
											<th><?=getSystemString(202)?></th>
											<th><?=getSystemString(210)?></th>
											<th><?=getSystemString(71)?></th>
											<th><?=getSystemString(42)?></th>
										</tr>
									</thead>
									<tbody>
										<?PHP
											if(isset($applications)) {
											$i = 0;
											foreach($applications as $row){
												$i++;
												$dt = new DateTime($row->DateApplied);
												?>
												<tr>
													<td><?=$row->Application_ID;?></td>
													<td><?=$dt->format('d-m-Y');?></td>
													<td><?=$row->Fullname?></td>
													<td><a href="mailto<?=$row->Email?>"><?=$row->Email?></a></td>
													<td><a href="tel:0<?=$row->Number?>">0<?=$row->Number?></a></td>
													<td><?=$row->Gender?></td>
													<td><?=$row->Nationality_en?></td>
													<td><?=$row->City_en?></td>
													<td><?=$row->Birthdate?></td>
													<?PHP $title_lng = 'Title_'.$__lang; ?>
													<td><?=$row->$title_lng?></td>
													<td style="text-align: center"><a href="<?=base_url($GLOBALS['applications_dir'].$row->CV_File)?>" download="" style="margin-right: 10px">
														<?PHP
															$pos = strrpos($row->CV_File, '.');
															$ext = $pos === false ? $row->CV_File : substr($row->CV_File, $pos + 1);
															if($ext == 'pdf')  { $ext = "<i class='fa fa-file-pdf-o'></i>"; }
															else if($ext == 'docx' || $ext == 'doc') { $ext = "<i class='fa fa-file-word-o'></i>"; }
															else if(strlen($ext) <= 1){ $ext = ''; }
															else { $ext = "<i class='fa fa-file'></i>"; }
															echo $ext;
														?>
													</a>
													<a href="#" class="archive-app"><i class="fa fa-file-archive-o"></i></a>
													<a href="<?=base_url($__controller.'/deleteArchiveApplication/'.$row->Application_ID.'/')?>" style="margin: 0px 5px;" onclick="return confirm('<?=getSystemString(45)?>');"><i class="fa fa-trash"></i></a>
													</td>
												</tr>
												<?PHP
											}
										} else {
											 echo '<tr><td colspan="9" class="text-center">No archived applications </td></tr>';
										}
										?>
									</tbody>
								</table>
	
								</div>
					</div>
				
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script>
	$(function(){
		menu_track_manual(6, 3);

		$("#applications").DataTable({
			"searching": false
		});
		
		$(".archive-app").on("click",function(){
			var currentRow = $(this).closest('tr');
			var data = { id : $(currentRow).find('td:eq(0)').text(), state: 0 };
			$.ajax({
			 		url: "<?=base_url($__controller.'/archiveApplication')?>",
			 		type:"POST",
	                dataType:"JSON",
	                data: data,
			 		success: function(r){
				 		console.log(r);
				 		if(r.result == 1){
					 		$(currentRow).remove();
				 		}
				 	},
			 		error:function(err, status, xhr){
				 		console.log(err);
				 		console.log(status);
				 		console.log(xhr);
			 		}
			});
			
			return false;
		});
		
	});
</script>
</body>
</html>
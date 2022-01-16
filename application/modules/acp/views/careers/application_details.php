	<style>
		.panel.white{
			min-height: 150px;
		}
		.table th{
			width: 200px !important;
		}
		.pd-image{
			max-width: 200px;
			margin: 5px;
		}
		body[dir="ltr"] table th, body[dir="ltr"] table td{
			text-align: left !important;
		}
		body[dir="rtl"] table th, body[dir="rtl"] table td{
			text-align: right !important;
		}
		.fa-file-pdf-o{
			font-size: 4em;
		}
	</style>
	<div id="content-main">
		
		<div class="row">
			<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
		</div>
		
		<div class="row">
						
			<div class="col-md-10">
			<h3><?=getSystemString(526)?></h3>
			<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
				<?PHP
					//if(strlen($application[0]->PersonalPicture) > 0){
				?>
				<div class="col-xs-12 hide">
					<img src="" class="pd-image">
				</div>
				<?PHP
				//	}
				?>
				<table class="table table-hover display" id="members_table" width="100%">
					<?PHP
						$city = 'name_'.$__lang;
						$nat = 'Nationality_'.$__lang;
						$title = 'Title_'.$__lang;
					?>
					<tbody>
						<tr>
							<th><?=getSystemString(527)?></th>
							<td><b><?=$application[0]->$title?></b></td>
						</tr>
						<tr>
							<th><?=getSystemString(81)?></th>
							<td><?=$application[0]->Fullname?></td>
						</tr>
						<tr>
							<th><?=getSystemString(137)?></th>
							<td>
							<a href="tel:0<?=$application[0]->Number?>">0<?=$application[0]->Number?></a>
							</td>
						</tr>
						<tr>
							<th><?=getSystemString(1)?></th>
							<td><a href="mailto:<?=$application[0]->Email?>"><?=$application[0]->Email?></a>
							</td>
						</tr>
				<!-- 		<tr>
							<th><?=getSystemString(210)?></th>
							<td><?=$application[0]->Birthdate?></td>
						</tr>
						<?PHP
							if(strlen($application[0]->Portfolio_Link) > 0){
						?>
						<tr>
							<th><?=getSystemString(518)?></th>
							<td><a href="<?=$application[0]->Portfolio_Link?>" target="_blank"><?=$application[0]->Portfolio_Link?></a></td>
						</tr>
						<?PHP
							}
						?> -->
						<tr>
							<th><?=getSystemString(201)?></th>
							<td><?PHP
								if($application[0]->$nat == 'Others'){
									echo $application[0]->Other_Nationality;
								} else {
									echo $application[0]->$nat;
								}
							?></td>
						</tr>
						<tr>
							<th><?=getSystemString(202)?></th>
							<td><?PHP
								if($application[0]->$city == 'Others'){
									echo $application[0]->Other_City;
								} else {
									echo $application[0]->$city;
								}
							?></td>
						</tr>
						<tr>
							<th><?=getSystemString(200)?></th>
							<td><?=$application[0]->Gender?></td>
						</tr>
						<tr>
							<th><?=getSystemString(528)?></th>
							<td><?=$application[0]->DateApplied?></td>
						</tr>

						<tr>
							<th>CV</th>
							<td style="text-align: center"><a href="<?=base_url($GLOBALS['applications_dir'].$application[0]->CV_File)?>" download="" style="margin-right: 10px">
														<?PHP
															$pos = strrpos($application[0]->CV_File, '.');
															$ext = $pos === false ? $application[0]->CV_File : substr($application[0]->CV_File, $pos + 1);
															if($ext == 'pdf')  { $ext = "<i class='fa fa-file-pdf-o'></i>"; }
															else if($ext == 'docx' || $ext == 'doc') { $ext = "<i class='fa fa-file-word-o'></i>"; }
															else if(strlen($ext) <= 1){ $ext = ''; }
															else { $ext = "<i class='fa fa-file'></i>"; }
															echo $ext;
														?>
													</a></td>
						</tr>
						
					</tbody>
				</table>
										
			</div>
		</div>
						
	</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>

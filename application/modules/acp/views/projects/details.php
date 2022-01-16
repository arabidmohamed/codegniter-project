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
		.user-rating{
			text-align: center;
			direction: ltr;
			width:135px;
			margin:auto;
		}
		body[dir="rtl"] .user-rating{
			direction: rtl;
		}
		.user-rating .fa{
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

		$category = 'Category_'.$__lang;
		
	?>
	<div id="content-main">
		
		<div class="row">
			<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
		</div>
		
		<div class="row">
						
			<div class="col-md-12">
				<h3 class="text-primary" onclick="javascript: window.location.reload()" style="cursor: pointer"><?=$project->Full_Name ?></h3>
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					<table class="table table-hover display" id="members_table" width="100%">
						<tbody>

							<tr>
								<th><?=getSystemString(177)?></th>
								<td>
									<?php 
										$dt = new DateTime($project->TimeStamp);
			                            echo $dt->format('d-m-Y');
									 ?>

								</td>
							</tr>
							<tr>
								<th><?=getSystemString(350)?></th>
								<td><?=$project->Full_Name?></td>
							</tr>
							<tr>
								<th><?=getSystemString(82)?></th>
								<td><?=$project->Email;?></td>
							</tr>
					
							<tr>
								<th><?=getSystemString(137)?></th>
								<td><?=$project->Phone;?></td>
							</tr>

							<tr>
								<th><?=getSystemString(58)?></th>
								<td><?=$project->$category;?></td>
							</tr>

							<tr>
								<th><?=getSystemString(164)?></th>
								<td><?=$project->Details;?></td>
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
</body>
</html>
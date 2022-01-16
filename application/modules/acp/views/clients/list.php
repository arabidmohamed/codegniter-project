	<style>
		.crop-image{
			width: 250px;
			height: 150px;
		}
	</style>
	<div id="content-main">
        <?PHP
        $section = "SectionName_".$__lang;
        $return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
        ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="<?=@$clients[0]->$section?> "><?=@$clients[0]->$section?> </li>
            </ol>
        </nav>
			<div class="row">

								<?PHP
					$this->load->view('acp_includes/response_messages');
					 ?>
				<div class="col-md-12">
					<h3>
						<?=@$clients[0]->$section?>

						<div class="dropdown d-inline-block float-left-right">
							<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>
						    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/editSection/".@$clients[0]->Section_ID."/".$return_url."/")?>"><i class="fa fa-cog"></i> <?=getSystemString(315)?></a></li>
						    </ul>
						</div>

						<a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF"><?=getSystemString(63)?></a>

					</h3>

		          <div class="panel white" style="padding-bottom: 50px;">
			          <h4><?=getSystemString(67)?></h4>
			         <table class="table table-hover sortable-tb sortable-1" id="clients_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(41)?></th>
						         <th><?=getSystemString(177)?></th>
						         <th><?=getSystemString(14)?></th>
						         <th><?=getSystemString(38)?></th>
						         <th><?=getSystemString(65)?></th>
						         <th><?=getSystemString(33)?></th>
						         <th><?=getSystemString(42)?></th>
					         </tr>
				         </thead>
				         <tbody>
					         <?PHP
						         if(count($clients)){
							         $i = 0;
							        foreach($clients as $row){
								       $i++;
								       $dt = new DateTime($row->Date);
								       ?>
								       <tr id="<?=$row->Client_ID;?>">
									       <td class="hide"><?=$row->Client_ID;?></td>
									       <td class="index hide"><?=$i;?></td>
									       <td><span class="drag-handle"></span><?=$dt->format('d-m-Y');?></td>
									       <td><a href="<?=$row->Client_Link;?>" target="_blank">

										   	<img src="<?=base_url($GLOBALS['img_clients_dir']).$row->Picture;?>" alt='client icon' style="width: 40px;"></a></td>
									       <?PHP $title = 'Title_'.$__lang; ?>
									       <td><?=$row->$title;?></td>
									       <td><a href="<?=$row->Client_Link;?>" target="_blank"><i class="fa fa-link"></i></a></td>

									       <td>
												<div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
												  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="status<?=$i?>">
												  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="status<?=$i?>">
												</div>
											</td>

									       <td><div class="btn-group">
													  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/edit/'.$row->Client_ID.'/')?>">
                                                         <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                                      </a>
													  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													  	<span class="fa fa-angle-down"></span>
													  </button>
													  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
														  <li>
														  		<a href="<?=base_url($__controller.'/edit/'.$row->Client_ID.'/')?>" style="margin: 0px 5px;" class="dropdown-item">
															  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
															  	</a>
														  </li>
														  <li>
														  		<a href="<?=base_url($__controller.'/delete/'.$row->Client_ID.'/')?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
															  		<i class="fa fa-trash"></i>  <?=getSystemString(314)?>
															  	</a>
														  </li>
														</ul>
			   									</div>

									       </td>
								       </tr>
								       <?PHP
							        }
						         } else {
							          echo '<tr><td colspan="5" class="text-center">No Partners </td></tr>';
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
<script>
	$(function(){
		$(document).on('click',"#clients_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'clients');
		});

		ChangeOrder('clients');
	});

</script>
</body>
</html>

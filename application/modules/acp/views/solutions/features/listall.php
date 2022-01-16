
	<div id="content-main">
		<?PHP
			$section = "SectionName_".$__lang;
			$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
		?>
			<div class="row">
				<div class="col-md-12">
					<h3>
						<?=getSystemString('feature_list')?> 
					</h3>
				</div>
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
				<div class="col-md-12">
					<a href="<?=base_url($__controller.'/addNewFeatures')?>" data-role="button" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
				        <?=getSystemString('add_feature')?>
			        </a>
				</div>
				<div class="col-md-12">

		            <div class="panel white" style="padding-bottom: 50px;">
		                <table class="table table-hover sortable-1 sortable-tb" id="pages_table">
		                    <thead>
		                    <tr>
		                        <th><?=getSystemString(738)?></th>
		                        <th ><?=getSystemString(177)?></th>
		                        <th><?=getSystemString(39)?></th>
		                        <th><?=getSystemString(33)?></th>
		                        <th><?=getSystemString(42)?></th>
		                    </tr>
		                    </thead>
		                    <tbody>
		                    <?PHP
		                    $i = 0;
		                    foreach($features as $p):
		                        $i++;
		                        $page_title = 'Title_'.$__lang;
		                        ?>
		                        <tr>
		                            <td><span class="drag-handle"></span><?=$p->Feature_ID?></td>
		                            <td><?=$p->Created_at?></td>
		                            <td><?=$p->$page_title?></td>
		                            <td>
		                                <div data-toggle="hurkanSwitch" data-status="<?=$p->Status?>">
		                                    <input data-on="true" type="radio" <?PHP if($p->Status) { echo 'checked'; } ?> name="status<?=$i?>">
		                                    <input data-off="true" type="radio" <?PHP if(!$p->Status) { echo 'checked'; } ?>  name="status<?=$i?>">
		                                </div>
		                            </td>
		                            <td><div class="btn-group">
		                                    <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editFeature/'.$p->Feature_ID.'/')?>">
		                                        <i class="fa fa-edit"></i> <?=getSystemString(43)?>
		                                    </a>
		                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		                                        <span class="fa fa-angle-down"></span>
		                                    </button>
		                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
		                                        <li>
		                                            <a href="<?=base_url($__controller.'/editFeature/'.$p->Feature_ID.'/')?>" style="margin: 0px 5px;" class="dropdown-item">
		                                                <i class="fa fa-edit"></i>  <?=getSystemString(43)?>
		                                            </a>
		                                        </li>
		                                        <li>
		                                            <a href="<?=base_url($__controller.'/deleteFeature/'.$p->Feature_ID.'/')?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
		                                                <i class="fa fa-trash"></i>  <?=getSystemString(314)?>
		                                            </a>
		                                        </li>
		                                    </ul>
		                                </div>

		                            </td>
		                        </tr>
		                    <?PHP
		                    endforeach;
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
        $(document).on('click',"#pages_table tr td .hurkanSwitch", function(){
            ChangeStatusFor($(this), 'features');
        });

        ChangeOrder('features');
    });
</script>
</body>
</html>


    <style>
    .video-thumb{
        display: block;
        width: 42px;
        height: 30px;
        text-align: center;
        background: #b5b0b0;
        border-radius: 2px;
        margin: auto;
    }
    body[dir='rtl'] .video-thumb{
        margin-right: 0px;
    }
    .video-thumb i{
        margin-top: 20%;
        color: #e44747;
    }
        .panel.white{
        min-height: 150px ;
    }
    .dropzone .dz-message{
        margin: 0px;
        font-size: 13px;
    }
    .dropzone{
        min-height: 0px;
    }
    .select2{
        width: 100% !important;
    }
    .crop-image{
		width: 300px;
		height: 200px;
	}
    </style>
    <div id="content-main">
        
            <div class="row">
                
                <?PHP
                $this->load->view('acp_includes/response_messages');
                ?>
            <!-- Note: total -->
			<div class="container col-md-3" id="totals">
				<div class="row">
					<div class="col-md-12">
						<h3 class="text-center"><?PHP
							echo $stats['Pending'] + $stats['Closed'] + $stats['InProgress'];
						?></h3>
						<h4>_</h4>
						<p><?=getSystemString('total_communications')?></p>
					</div>
				</div>
			</div>
			<div class="container col-md-8" id="totals">
				<div class="row">
					<div class="col-md-4">
						<h3 class="text-center"><?=$stats['Pending']?></h3>
						<h4>_</h4>
						<p>تذكرة جديدة</p>
					</div>
					<div class="col-md-4">
						<h3 class="text-center"><?=$stats['InProgress']?></h3>
						<h4>_</h4>
						<p>قيد العمل</p>
					</div>
					<div class="col-md-4">
						<h3 class="text-center"><?=$stats['Closed']?></h3>
						<h4>_</h4>
						<p>تذكرة مكتملة</p>
					</div>
				</div>
			</div>	
			<!-- Ends -->
                <div class="col-md-12">
                    
                    <?PHP
                        $section = "SectionName_".$__lang;
                        $return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
                    ?>
                    <h3>
                        <?=getSystemString('member_communications')?> 
                        
                       
						
                    </h3>
                    
                  
                </div>
    
                     <div class="col-md-12">
                  <div class="panel white" style="padding-bottom: 50px;">
                      <h4><?=getSystemString('member_communications')?></h4>
                     <table class="table table-hover sortable-1 sortable-tb datatable" id="projects_table">
                         <thead>
                             <tr>
                                 <th><?=getSystemString(149)?></th>
                                  <th><?=getSystemString(177)?></th>
                                 <th><?=getSystemString(81)?></th>
                                 <th><?=getSystemString(151)?></th>
                                 <th><?=getSystemString('Replied By')?></th>
                                 <th><?=getSystemString(33)?></th>
                                 <th colspan="2"><?=getSystemString(153)?></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?PHP
								if(count($communications)){
									$i = 0;
									$statuses = array(
										'Pending' => 'warning',
										'Closed' => 'success',
										'In Progress' => 'primary'
									);
									foreach($communications as $communication){
										$dt = new DateTime($communication->Timestamp);
                            ?>
                                       <tr id="">
                                           <td><?=$communication->CommunicationId?></td>
                                           <td><?=$dt->format('Y-m-d')?></td>
                                            
                                           <td><?=$communication->Fullname?></td>
                                           <td><?=$communication->Title?></td>
                                           <td><?=$communication->RepliedBy?></td>
                                           <td><span class="label label-<?=$statuses[$communication->Status]?>">
                                           <?php
	                                           if($communication->Status == 'Pending'){echo 'تذكرة جديدة';}
											   elseif($communication->Status == 'In Progress'){echo 'قيد العمل';}
											   elseif($communication->Status == 'Closed'){echo 'تذكرة مكتملة';}
                                           ?></span></td>
                                            <td>
                                                <div class="btn-group">
                                                      <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/communicationDetails/'.$communication->CommunicationId)?>">
                                                         <i class="fa fa-eye"></i> <?=getSystemString(324)?>
                                                      </a>
                                                      <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span class="fa fa-angle-down"></span>
                                                      </button>
                                                      <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                          <li>
                                                                <a href="<?=base_url($__controller.'/communicationDetails/'.$communication->CommunicationId)?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
                                                                    <i class="fa fa-trash"></i>  <?=getSystemString(314)?>
                                                                </a>
                                                          </li>
                                                        </ul>
                                                </div>
                                            </td>
                                       </tr>
                                   <?PHP
								   $i++;
								   }
								}
								   ?>  
                        </tbody>
                     </table>                     
                  </div>
                  
                </div>
        </div>
    </div>
    <?PHP
	//$this->load->view('collections/snippets/add_modal');
    $this->load->view('acp_includes/footer');
    ?>
    <script>
	
    $(function(){
        
        $(document).on('click',"#projects_table tr td .hurkanSwitch", function(){
            ChangeStatusFor($(this), 'portoflio');
        });
        
        $('#projects_table').on('click', function(){
            ChangeOrder('portfolio');
        });
        
    });
    </script>
    </body>
</html>
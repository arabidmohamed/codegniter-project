
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
    /*body[dir='rtl'] .video-thumb{*/
    /*    margin-right: 0px;*/
    /*}*/
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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(131)?>"><?=getSystemString(131)?> </li>
            </ol>
        </nav>
            <div class="row">

                <?PHP
                $this->load->view('acp_includes/response_messages');
                ?>
                <div class="col-md-12">
                    <?PHP
                        $section = "SectionName_".$__lang;
                        $return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
                    ?>
                    <h3>
                        <?=getSystemString(131)?>

                        <div class="dropdown d-inline-block float-left-right">
                            <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/editSection/".@$portfolios[0]->Section_ID."/".$return_url."/")?>"><i class="fa fa-cog"></i> <?=getSystemString(315)?></a></li>
                            </ul>
                        </div>

                        <a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
                            <i class="fa fa-plus"></i> <?=getSystemString(98)?>
                        </a>

						<!-- <a href="<?=base_url('acp/portfolios/categories_list')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
                            <i class="fa fa-plus"></i> <?=getSystemString(441)?>
                        </a> -->

                    </h3>


                </div>

                     <div class="col-md-12">
                  <div class="panel white" style="padding-bottom: 50px;">
                      <h4><?=getSystemString(159)?></h4>
                     <table class="table table-hover sortable-1 sortable-tb datatable" id="projects_table">
                         <thead>
                             <tr>
                                 <th class="hide"><?=getSystemString(149)?></th>
                                 <th><?=getSystemString(177)?></th>
                                 <th><?=getSystemString(150)?></th>
                                 <th><?=getSystemString(151)?></th>
                                 <th><?=getSystemString(58)?></th>
                                 <th><?=getSystemString(152)?></th>
                                 <th colspan="2"><?=getSystemString(153)?></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?PHP
                                 if(count($portfolios)){
                                     $i = 0;
                                    foreach($portfolios as $row){
                                       $i++;
                                       $dt = new DateTime($row->Date);
                                       ?>
                                       <tr id="<?=$row->Portfolio_ID;?>">
                                           <td class="hide"><?=$row->Portfolio_ID;?></td>
                                           <td class="index hide"><?=$i?></td>
                                           <td><?=$dt->format('d-m-Y');?></td>
                                            <?PHP
                                               if($row->PortfolioType == 'pic'){
                                           ?>
                                           <td><img src="<?=base_url($GLOBALS['img_work_dir']).$row->Thumbnail;?>" alt='picture' style="width: 40px;"></td>
                                           <?PHP
                                               } // End IF
                                               else if($row->PortfolioType == 'vid'){
                                            ?>
                                            <td><span class="video-thumb"><i class="fa fa-youtube-play"></i></span></td>
                                            <?PHP
                                                }

                                               $title_nn = 'Title_'.$__lang;
                                               $catg_nn = 'Category_'.$__lang;
                                            ?>
                                           <td><?=$row->$title_nn;?></td>
                                           <td>
                                            <?PHP
                                               $mult_categories = '';
                                               foreach($categories as $catg){
                                                   $categories_id = explode(",", $row->Category_ID);
                                                   for($id = 0; $id < count($categories_id); $id++){
                                                       if($catg->Category_ID == $categories_id[$id]){
                                                           $mult_categories .= $catg->$catg_nn. ', ';
                                                       }
                                                   }
                                               }
                                               echo rtrim($mult_categories, ", ");
                                          ?>
                                           </td>
                                           <td>
                                                <div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
                                                  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="ppstatus<?=$i?>">
                                                  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="ppstatus<?=$i?>">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                      <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/edit/'.$row->Portfolio_ID)?>">
                                                         <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                                      </a>
                                                      <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span class="fa fa-angle-down"></span>
                                                      </button>
                                                      <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
	                                                      <li>
														  		<a href="<?=base_url($__controller.'/edit/'.$row->Portfolio_ID)?>" style="margin: 0px 5px;" class="dropdown-item">
															  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
															  	</a>
														  </li>
                                                          <li>
                                                                <a href="<?=base_url($__controller.'/delete/'.$row->Portfolio_ID)?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
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
                                      echo '<tr><td colspan="5" class="text-center">No Portoflios </td></tr>';
                                 }
                             ?>
                        </tbody>
                     </table>
                  </div>

                </div>
        </div>
    </div>
    <?PHP
	$this->load->view('portfolio/snippets/add_modal');
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

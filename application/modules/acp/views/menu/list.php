<style>
    .panel.white{
        min-height: 150px ;
    }
</style>
<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="<?=getSystemString("menu_list")?><"><?=getSystemString("menu_list")?></li>
        </ol>
    </nav>
    <div class="row">
        <?PHP
        $this->load->view('acp_includes/response_messages');
        ?>
        <div class="col-md-12">
            <h3><?=getSystemString("menu_list")?>
                <a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary pull-right" style="color:#fff">
                    <i class="fa fa-plus"></i> <?=getSystemString(724)?>
                </a>
            </h3>
        </div>


        <div class="col-md-12">
            <div class="panel white" style="padding-bottom: 50px;">
                <table class="table table-hover sortable-1 sortable-tb" id="categories_table">
                    <thead>
                    <tr>
                        <th><?=getSystemString("menu")?></th>
                        <th><?=getSystemString("action_name")?></th>
                        <th><?=getSystemString(65)?></th>
                        <th><?=getSystemString(759)?></th>
                        <th><?=getSystemString(760)?></th>
                        <th><?=getSystemString(42)?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?PHP
                    $i = 0;
                    foreach($menus as $m):
                        $i++;
                        ?>
                        <tr>
                            <td class="hide"><?=$m->Id?></td>
                            <td><?=$m->Menu_Key?></td>
                            <td><?=$m->Action_Key?></td>
                            <td><?=$m->Link?></td>
                            <td><?PHP
                                if($m->DefaultSelected){
                                    echo '<label class="label label-success"> '.getSystemString(762).' </label>';
                                }
                                ?></td>
                            <td>
                                <?php if ($m->Is_SideBar_Menu)
                                {
                                    echo '<label class="label label-primary">' .getSystemString(761). '</label>';
//                                } else {
//                                    echo '<label class="label label-default"> Website </label>';
                                }?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/edit/'.$m->Id)?>">
                                        <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                    </a>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="fa fa-angle-down"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                        <li>
                                            <a href="<?=base_url($__controller.'/edit/'.$m->Id)?>" style="margin: 0px 5px;" class="dropdown-item">
                                                <i class="fa fa-edit"></i>  <?=getSystemString(43)?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url($__controller.'/delete/'.$m->Id)?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
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
</body>
</html>

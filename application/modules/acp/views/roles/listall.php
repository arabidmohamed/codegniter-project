<style>
    .crop-image{
        width: 250px;
        height: 150px;
    }
</style>
<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="<?=getSystemString(86)?>"><a href="<?=base_url('acp/manageUsers')?>"><?=getSystemString(86)?></a></li>
            <li class="breadcrumb-item active" aria-current="<?=getSystemString("permission")?>"><?=getSystemString("permission")?></li>
        </ol>
    </nav>
    <div class="row">

        <?PHP
        $this->load->view('acp_includes/response_messages');
        ?>

        <div class="col-md-12">
            <h3>
                <?=getSystemString('permission')?>
                <a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF"><?=getSystemString('add_new_group')?></a>
            </h3>
            <div class="panel white" style="padding-bottom: 50px;">

                <table class="table table-hover" id="clients_table">
                    <thead>
                    <tr>
                        <th><?=getSystemString(41)?></th>
                        <th><?=getSystemString(177)?></th>
                        <th><?=getSystemString('Role Name')?></th>
                        <th><?=getSystemString(44)?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?PHP
                    if(count($roles)){
                        $i = 0;
                        foreach($roles as $row){
                            $i++;
                            $dt = new DateTime($row->Timestamp);
                            ?>
                            <tr>
                                <td><?=$i?></td>
                                <td><?=$dt->format('d-m-Y');?></td>
                                <td><?=$row->Name?></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/edit/'.$row->Role_ID.'/')?>">
                                            <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                        </a>
                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <span class="fa fa-angle-down"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                            <li>
                                                <a href="<?=base_url($__controller.'/edit/'.$row->Role_ID.'/')?>" style="margin: 0px 5px;" class="dropdown-item">
                                                    <i class="fa fa-edit"></i>  <?=getSystemString(43)?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?=base_url($__controller.'/delete/'.$row->Role_ID.'/')?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
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
                        echo '<tr><td colspan="5" class="text-center">No Roles </td></tr>';
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
</body>
</html>
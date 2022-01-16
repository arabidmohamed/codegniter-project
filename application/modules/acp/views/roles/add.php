<style>
    table, td, th
    {
        height: 50px
    }

    table
    {
        border-collapse: collapse;
        width: 100%;
    }

    th
    {
        height: 50px;
    }

</style>
<?php
 $name = 'Name_'.$__lang;
?>
<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="<?=getSystemString("permission")?>">
                <a href="<?=base_url('acp/roles/listall')?>"><?=getSystemString("permission")?></a> </li>
            <li class="breadcrumb-item active" aria-current="<?=getSystemString("add_new_group")?>"><?=getSystemString("add_new_group")?></li>
        </ol>
    </nav>
    <h3><?=getSystemString("add_new_group")?></h3>
    <div class="row">
        <?PHP
        $this->load->view('acp_includes/response_messages');
        ?>
        <div class="col-md-12">
            <form action="<?=base_url($__controller.'/add_POST');?>" class="form-horizontal" method="post">
                <div class="panel white" style="padding-bottom: 50px;">
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title_en"><?=getSystemString(746)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text" class="form-control" name="role" placeholder="<?=getSystemString(749)?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title_en"><?=getSystemString(748)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <table id="permissions">
                                <thead>
                                <th><?=getSystemString(739)?></th>
                                <?PHP
                                foreach($actions as $action):
                                    ?>
                                    <th><?=$action->$name?></th>
                                <?PHP
                                endforeach;
                                ?>
                                </thead>
                                <tbody>
                                <tr style="border-bottom: 1px solid #d3d3d354;">
                                    <td><b>Select all</b></td>
                                    <td>
                                        <input type="checkbox" name="viewbox"
                                                data-type="view-data" onclick="selectUnselectALL(this)">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="addbox"
                                                data-type="add-data" onclick="selectUnselectALL(this)">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="editbox"
                                                data-type="edit-data" onclick="selectUnselectALL(this)">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="deletebox"
                                                data-type="delete-data" onclick="selectUnselectALL(this)">
                                    </td>
                                </tr>
                                <?php foreach ($pages as $page) {
                                    if ($page->Link != '#') :
                                    ?>
                                    <tr>
                                        <td><?=getSystemString($page->Menu_String_Key)?></td>
                                        <?PHP
                                        foreach($actions as $action):
                                            ?>
                                            <td>
                                                <input type="checkbox" name="action[<?=$page->Id.'_'.$action->Action_ID?>]" value="<?=$page->Id.'_'.$action->Action_ID?>" onclick="resetSelectAll(this)" data-type="<?=$action->Action_Key?>-data">
                                            </td>
                                        <?PHP
                                        endforeach;
                                        endif;
                                        ?>
                                    </tr>
                                    <?php
                                    foreach($page->SubMenu as $sp){
                                        ?>
                                        <tr>
                                            <td><?=getSystemString($sp->Menu_String_Key)?></td>
                                            <?PHP
                                            foreach($actions as $action):
                                                $permitted = '';
                                                foreach($permissions as $p):
                                                    if($p->Menu_ID == $sp->Id && $p->Action_ID == $action->Action_ID){
                                                        $permitted = 'checked';
                                                    }
                                                endforeach;
                                                ?>
                                                <td>
                                                    <input type="checkbox" name="action[<?=$sp->Id.'_'.$action->Action_ID?>]" value="<?=$sp->Id.'_'.$action->Action_ID.'_'.$page->Id?>" <?=$permitted?> onclick="resetSelectAll(this)" data-type="<?=$action->Action_Key?>-data"></td>
                                            <?PHP
                                            endforeach;
                                            ?>
                                        </tr>

                                        <?PHP

                                    }

                                } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>


                </div>
                <div class="form-group">
                    <div class="col-xs-12 text-right">
                        <input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?PHP
$this->load->view('acp_includes/footer');
?>

<script>
    menu_track_manual(6, 0);
</script>
<script>
    // function to adapt all checkbox children according to parent checkbox
    function selectUnselectALL(e) {
        var type = e.getAttribute("data-type");
        const container = document.querySelector("#permissions");
        const matches = container.querySelectorAll("input[data-type=" + type + "]");
        // changes all the children
        for (const [key, value] of Object.entries(matches)) {
            matches[key].checked = matches[0].checked;
        }  
    }
    $();
    // function to dynamically change the 'select all' box
    function resetSelectAll(e) {
        var type = e.getAttribute("data-type");
        const container = document.querySelector("#permissions");
        const matches = container.querySelectorAll("input[data-type=" + type + "]");
        checkFlag = true
        // changes the flag if any of the children boxes are unchecked
        for (i = 1; i < matches.length; i++) {
            if (matches[i].checked != true) {
                checkFlag = false;
            }
        }
        // changes the parent if all children are checked or unchecked accordingly
        matches[0].checked = checkFlag;

    }
</script>
</body>

</html>
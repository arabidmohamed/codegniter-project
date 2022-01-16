<div class="panel white">
    <h4>
        <?=getSystemString('members_list')?>
    </h4>
    <table class="table table-hover" id="members_table">
            <thead>
                <tr>
                    <th class="hide"><?=getSystemString(41)?></th>
                    <th><?=getSystemString(177)?></th>
                    <th><?=getSystemString(14)?></th>
                    <th><?=getSystemString(81)?></th>
                    <th><?=getSystemString(1)?></th>
                    <th><?=getSystemString(137)?></th>
                    <th><?=getSystemString(200)?></th>
                    <th><?=getSystemString(210)?></th>
                </tr>
            </thead>
            <tbody>
                <?PHP
                if(count($members)):
                    $i = 0;
                    foreach($members as $row):
                        $i++;
                        $dt = new DateTime($row->Created_At);
                        ?>
                        <tr id="<?=$row->CM_ID;?>">
                            <td class="hide"><?=$row->CM_ID;?></td>
                            <td class="index hide"><?=$i;?></td>
                            <td><?=$dt->format('d-m-Y');?></td>
                            <td><img src="<?=base_url($GLOBALS['img_customers_dir']).$row->Picture;?>" alt='customer icon' style="width: 40px;"></td>
                            <td><?=$row->Name;?></td>
                            <td><?=$row->Email;?></td>
                            <td><?=$row->Phone;?></td>
                            <td><?=getSystemString($row->Gender)?></td>
                            <td><?=$row->Birthdate;?></td>
                        </tr>
                        <?PHP
                    endforeach;
                else:
                        ?>
                        <tr><td colspan='7' class='text-center'><?=getSystemString(450)?></td></tr>
                        <?PHP
                endif;
                ?>
            </tbody>
        </table>
</div>
<style>
    .panel.white{
        min-height: 150px ;
    }
</style>
<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="<?=getSystemString(91)?>"><?=getSystemString(91)?></li>
        </ol>
    </nav>
    <div class="row">
        <?PHP
        $this->load->view('acp_includes/response_messages');
        $page_title = 'Page_title_'.$__lang;
        ?>
        <div class="col-xs-12">
            <h3>
                <?=getSystemString(91)?>
            </h3>
        </div>

        <div class="col-md-12">
            <div class="panel white" style="padding-bottom: 50px;">
                <table class="table table-hover sortable-1 sortable-tb" id="pages_table">
                    <thead>
                    <tr>
                      <!--   <th><?=getSystemString(738)?></th> -->
                      <!--   <th ><?=getSystemString(177)?></th> -->
                        <th><?=getSystemString(739)?></th>
                        <th><?=getSystemString(33)?></th>
                        <th><?=getSystemString(42)?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?PHP
                    $i = 0;
                    foreach($pages as $p):
                        $i++;
                        ?>
                        <tr class="<?PHP if(!$p->Status) { echo 'hide'; } ?>">
                            <!-- <td><span class="drag-handle"></span><?=$p->Id?></td> -->
                           <!--  <td><?=$p->Timestamp?></td> -->
                            <td><?=$p->$page_title?></td>
                            <td>
                                <div data-toggle="hurkanSwitch" data-status="<?=$p->Status?>">
                                    <input data-on="true" type="radio" <?PHP if($p->Status) { echo 'checked'; } ?> name="status<?=$i?>">
                                    <input data-off="true" type="radio" <?PHP if(!$p->Status) { echo 'checked'; } ?>  name="status<?=$i?>">
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/edit/'.$p->Id)?>">
                                        <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                    </a>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="fa fa-angle-down"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                        <li>
                                            <a href="<?=base_url($__controller.'/edit/'.$p->Id)?>" style="margin: 0px 5px;" class="dropdown-item">
                                                <i class="fa fa-edit"></i>  <?=getSystemString(43)?>
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
            ChangeStatusFor($(this), 'pages');
        });

        ChangeOrder('pages');
    });
</script>
</body>
</html>

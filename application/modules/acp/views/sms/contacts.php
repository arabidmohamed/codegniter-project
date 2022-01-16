<?php
/*
 * Added by Yasir on 31 Oct 2019
 *
 */
if ($is_disabled->Status == 0) {
    show_404();
}
?>
<style>
    .panel.white{
        min-height: 220px;
    }

    <?php if($__lang == 'ar'): ?>
    .dataTables_wrapper .dataTables_length {
        float: left !important;
    }
    table tr th, table td {
        text-align: right !important;
        padding-right: 20px !important;
    }
    <?php else: ?>
    table tr th, table td{
        text-align: left !important;
        padding-left: 20px !important;
    }
    <?php endif; ?>
</style>
<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="<?=getSystemString(734)?>"><?=getSystemString(734)?></li>
        </ol>
    </nav>
    <div class="row">
        <?PHP
        $this->load->view('acp_includes/response_messages'); ?>

        <div class="col-md-12">
            <h3><?=getSystemString(734)?>
                <a href="<?=base_url($__controller.'/addContact')?>" class="btn btn-primary pull-right" style="color:#fff">
                    <i class="fa fa-plus"></i> <?=getSystemString(735)?>
                </a>
            </h3>
        </div>


        <div class="col-md-12">
            <div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
                <table class="table table-hover display" id="contacts" width="100%">
                    <thead>
                    <tr>
                        <th><?=getSystemString(41)?></th>
                        <th><?=getSystemString(136)?></th>
                        <th><?=getSystemString(137)?></th>
                        <th><?=getSystemString("date")?></th>
                        <th><?=getSystemString(42)?></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<?PHP
$this->load->view('acp_includes/footer');
?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script>
    menu_track_manual(10, 0);
    $(function(){
        var dTable = $('#contacts').DataTable({
            processing: true,
            filter:false,
            responsive: true,
            autoWidth:false,
            lengthMenu: [ [25, 50, 100, 500, 1000, -1], [25, 50, 100, 500, 1000, "All"] ],
            pageLength: 25,
            serverSide: true,
            ajax: {
                url: "<?=base_url('acp/datatable/contacts')?>",
                type: "POST"
            },
            language: {
                url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>'
            },
            drawCallback:function(){
                $("#applications_filter input").addClass('form-control').css({
                    "width": "180px",
                    "display": "inline-block"
                });
            }
        });
    });
</script>
</body>
</html>

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
        min-height: 150px ;
    }
</style>
<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="<?=getSystemString(727)?><"><?=getSystemString(727)?></li>
        </ol>
    </nav>
    <div class="row">
        <?PHP
        $this->load->view('acp_includes/response_messages'); ?>

        <div class="col-md-12">
            <h3><?=getSystemString(727)?></h3>
            <div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
                <table class="table table-hover display" id="emails" width="100%">
                    <thead>
                    <tr>
                        <th><?=getSystemString(1)?></th>
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
        var dTable = $('#emails').DataTable({
            processing: true,
            filter:false,
            responsive: true,
            autoWidth:false,
            lengthMenu: [ [25, 50, 100, 500, 1000, -1], [25, 50, 100, 500, 1000, "All"] ],
            pageLength: 25,
            serverSide: true,
            ajax: {
                url: "<?=base_url('acp/datatable/emails')?>",
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

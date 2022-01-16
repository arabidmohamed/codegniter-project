<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<style>
    .panel.white {
        min-height: 150px;
    }
    .dropzone .dz-message {
        margin: 0px;
        font-size: 13px;
    }
    .dropzone {
        min-height: 0px;
    }
    .select2 {
        width: 100% !important;
    }
    .dataTables_wrapper .row:first-child {
        top: -55px;
    }
    body[dir="rtl"] .pl-0 {
        padding-right: 0px;
    }
    body[dir="ltr"] .pl-0 {
        padding-left: 0px;
    }
    table th:last-child {
        width: 200px;
    }
</style>
<div id="content-main">
    <div class="row">
        <?PHP $this->load->view('acp_includes/response_messages'); ?>
        <div class="col-md-12">
            <h3>
              <?=getSystemString(346).' '.getSystemString('domain_waiver')?> 
            </h3>
        </div>

        <div class="col-md-12">
            <?PHP 
                  $data[ '__domainStatuses'] = $__domainStatuses; 
                  $this->load->view('domains/snippets/filter_domains', $data); 
            ?>
        </div>


        <div class="col-md-12">

            <div class="panel white" style="padding-bottom: 50px;">

                <h4 class="page-title"><?=getSystemString(346).' '.getSystemString('domain_waiver')?></h4>
                <br />
                <table class="table table-hover" id="domains_table">
                    <thead>
                        <tr>
                      
                            <th>
                                <?=getSystemString(356)?>
                            </th>
                            <th>
                                <?=getSystemString('domain_name')?>
                            </th>
                              <th>
                                صاحب الحساب
                            </th>
                            <th>
                                <?=getSystemString('entity_name')?>
                            </th>
                            <th>
                                حالة الطلب
                            </th>

                              <th>
                            حالة التنازل
                            </th>

                             <th>
                                موافقة المتنازل
                            </th>
                             <th>
                                موافقة المتنازل عنه
                            </th>
  
                         
                            <th>
                                <?=getSystemString(42)?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<?PHP $this->load->view('acp_includes/footer'); ?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>">
</script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>">
</script>
<script>
    $(function() {

        $(".select2").select2({
            theme: 'bootstrap',
            placeholder: '<?=getSystemString(309)?>'
        });

        // datatable initialization
        var dTable = $('#domains_table').DataTable({
            columnDefs: [{
                domainable: false,
                targets: -1
            }],
            domain: [
                [0, 'desc']
            ],
            select: true,
            pageLength: 15,
            serverSide: true,
            ajax: {
                url: "<?=base_url($__controller.'/getDomainsWaiversList')?>",
                type: "POST",
                cache: false,
                data: function(d) {
                    d.domain_no = $('#domain_no').val();
                    d.mobile_no = $('#mobile_no').val();
                    d.status = $('#filter_status').val();
                    d.payment = $('#filter_payment').val();
                    d.customer_name = $('#customer_name').val();
                    d.status      = '<?= $status ?>';
                }
            },
            drawCallback: function(settings) {
                $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
                $("#filter_domains").find(".disable-btn").remove();
            },
            processing: true,
            filter: true,
            responsive: true,
            autoWidth: false,
            dom: "<'row'<'col-sm-3 text-center'><'col-sm-9'<'toolbar'>l>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            lengthMenu: [
                [15, 25, 50, 100, 1000, -1],
                ['15 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'Show all']
            ],
            language: {
                url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>',
                sLengthMenu: "_MENU_"
            },
            initComplete: function() {
                $("div.toolbar").html('<div class="dropdown">' +
                    '<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>' +
                    '<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">' +
                    '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/domains_csv/")?>">Export to csv</a></li>' +
                    '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/domains_excel/")?>">Export to excel</a></li>' +
                    '</ul>' +
                    '</div>');
            }
        });

        // filter products
        $("#filter_domains").on("submit", function() {
            $('#domains_table').DataTable().draw();
            return false;
        });

    });
</script>
</body>

</html>
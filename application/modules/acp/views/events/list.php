<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">
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
    .dataTables_wrapper .row:first-child {
        top: -55px;
    }
    body[dir="rtl"] .pl-0 {
        padding-right: 0px;
    }
    body[dir="ltr"] .pl-0 {
        padding-left: 0px;
    }
    #trips_table td:first-child {
        display: none;
    }
    #trips_table th:last-child {
        width: 200px;
    }
</style>
<div id="content-main">
    <div class="row">
        <?PHP $this->load->view('acp_includes/response_messages'); ?>
        <div class="col-md-12">
            <h3>
                <?=getSystemString('events')?> 
                <a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
                    <i class="fa fa-plus"></i> 
                    <?=getSystemString('add_new_event')?>
                </a>
                <a href="<?=base_url($__controller.'/categories_list')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
                    <i class="fa fa-plus"></i> <?=getSystemString(441)?>
                </a>
            </h3>
        </div>

        <div class="col-md-12">
            <?PHP $this->load->view('events/snippets/filter'); ?>
        </div>


        <div class="col-md-12">

            <div class="panel white" style="padding-bottom: 50px;">

                <h4 class="page-title">
                    <?=getSystemString('events_list')?>
                </h4>
                <br />
                <table class="table table-hover" id="trips_table">
                    <thead>
                        <tr>
                            <th class="hide">
                                <?=getSystemString(149)?>
                            </th>
                            <th>
                                <?=getSystemString(177)?>
                            </th>
                            <th>
                                <?=getSystemString(150)?>
                            </th>
                            <th>
                                <?=getSystemString(311)?>
                            </th>
                            <th>
                                <?=getSystemString(61)?>
                            </th>
                            <th>
                                <?=getSystemString(138)?>
                            </th>
                            <th>
                                <?=getSystemString(139)?>
                            </th>
                            <th>
                                <?=getSystemString(152)?>
                            </th>
                            <th>
                                <?=getSystemString(153)?>
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
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
<script type="text/javascript" src="<?=base_url('style/acp/js/dropzone.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script src="<?=base_url($GLOBALS['home_js_dir'].'/utilities/utilities.js')?>"></script>
<script>
    var _contoller = "<?=$__controller?>";
    $(function() {

        // datatable initialization
        var dTable = $('#trips_table').DataTable({
            columnDefs: [{
                orderable: false,
                targets: -1
            }],
            select: true,
            order: [
                [0, 'desc']
            ],
            aoColumnDefs: [{
                bSortable: false,
                aTargets: [2, 7, 8]
            }],
            pageLength: 15,
            serverSide: true,
            ajax: {
                url: Utilities.functions.getBaseUrl() + _contoller + "/getDataList",
                type: "POST",
                cache: false,
                data: function(d) {
                    d.title = $("#filter_title").val();
                    d.from_date = $("#filter_from").val();
                    d.to_date = $("#filter_to").val();
                }
            },
            drawCallback: function(settings) {
                $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
                $("#filter_trips").find(".disable-btn").remove();
                $(document).find('[data-toggle="hurkanSwitch"]').each(function() {
                    $(this).hurkanSwitch({
                        'on': function(r) {
                            alert(r);
                        },
                        'off': function(r) {
                            alert(r);
                        },
                        'onTitle': '<i class="fa fa-check"></i>',
                        'offTitle': '<i class="fa fa-times"></i>',
                        'width': 60
                    });
                });
            },
            searching: false,
            lengthChange: false,
            processing: true,
            filter: true,
            responsive: true,
            autoWidth: false,
            lengthMenu: [
                [15, 25, 50, 100, 1000, -1],
                ['15 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'Show all']
            ],
            language: {
                url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>',
                sLengthMenu: "_MENU_"
            }
        });

        var options = {
          format : "dd-mm-yy",
          fromInput : "#from",
          toInput : "#to"
        };
        Utilities.functions.dateRangeInit(options);        

        // filter products
        $("#filter_trips").on("submit", function() {
            $('#trips_table').DataTable().draw();
            return false;
        });

        $(document).on('click', "#trips_table tr td .hurkanSwitch", function() {
            ChangeStatusFor($(this), 'events');
        });

    });
</script>
</body>
</html>
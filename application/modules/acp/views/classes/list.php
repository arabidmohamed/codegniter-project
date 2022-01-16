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
    .dataTables_wrapper .row:first-child {
        top: -55px;
    }
    body[dir="rtl"] .pl-0 {
        padding-right: 0px;
    }
    body[dir="ltr"] .pl-0 {
        padding-left: 0px;
    }
    table td:not(.dataTables_empty):first-child {
        display: none;
    }
    table th:last-child {
        width: 200px;
    }
</style>
<div id="content-main">
    <div class="row">
        <?PHP $this->load->view('acp_includes/response_messages'); ?>
        <div class="col-md-12">
            <?PHP $section="SectionName_" .$__lang; 
            $return_url=$this->router->fetch_class()."-".$this->router->fetch_method(); ?>
            <h3>
        <?=getSystemString(130)?>

<!--         <a href="<?=base_url($__controller.'/manageSubCategories')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
          <i class="fa fa-list"> </i> 
          <?=getSystemString(317)?>
        </a>  -->       
		<a href="<?=base_url($__controller.'/manageCategories')?>" class="btn btn-primary float-left-right add-btn-toolbar hide" style="color:#FFF">
          <i class="fa fa-list"> </i> 
          <?=getSystemString('classes categories')?>
        </a>

            <a href="<?=base_url($__controller.'/newclass')?>" class="btn btn-primary float-left-right add-btn-toolbar " style="color:#FFF">
          <i class="fa fa-plus"> </i> 
          <?=getSystemString('add class')?>
        </a>

        
      </h3>
        </div>

        <div class="col-md-12">
            <?PHP 
                $data[ 'categories'] = $categories; 
                $this->load->view('classes/snippets/filter', $data); ?>
        </div>


        <div class="col-md-12">

            <div class="panel white" style="padding-bottom: 50px;">

                <h4 class="page-title">
					<?=getSystemString(300)?>
	  			</h4>
                <br />
                <table class="table table-hover" id="classes_table">
                    <thead>
                        <tr>
                            <th class="hide">
                                <?=getSystemString(149)?>
                            </th>
                            <th>
                                <?=getSystemString('academic_year')?>
                            </th>
                            <th>
                                <?=getSystemString(150)?>
                            </th>
                            <th>
                                <?=getSystemString(420)?>
                            </th>
                            <th>
                                <?=getSystemString('branch_name')?>
                            </th>
                            <th>
                                <?=getSystemString('teacher_name')?>
                            </th>
                            <th>
                                <?=getSystemString(33)?>
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
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>">
</script>
<script type="text/javascript" src="<?=base_url('style/acp/js/dropzone.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>">
</script>
<script>
    var _unlink_url = '<?=base_url($__controller.'/unlinkImage ')?>';
    var _post_url = '<?=base_url($__controller.'/uploadclassImages ')?>';
    var _baseController = '<?=base_url($__controller)?>';
    var _placeholder = '<?=getSystemString(309)?>';
    $(function() {

        $(".select2").select2({
            theme: 'bootstrap'
        });

        // datatable initialization
        var dTable = $('#classes_table').DataTable({
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
                aTargets: [2, 4, 7]
            }],
            pageLength: 15,
            serverSide: true,
            ajax: {
                url: "<?=base_url($__controller.'/getDataList')?>",
                type: "POST",
                cache: false,
                data: function(d) {
                    d.title = $("#filter_title").val();
					d.teacher = $("#filter_teacher").val();
                    d.branch = $("#filter_branch").val();
                    d.academic_year = $("#academic_year").val();
                }
            },
            drawCallback: function(settings) {
                $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
                $("#filter_classes").find(".disable-btn").remove();
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
                    '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/classes_csv/")?>">Export to csv</a></li>' +
                    '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/classes_excel/")?>">Export to excel</a></li>' +
                    '</ul>' +
                    '</div>');
            }
        });

        // filter classes
        $("#filter_classes").on("submit", function() {
            $('#classes_table').DataTable().draw();
            return false;
        });

        $(document).on('click',"#classes_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'classes');
		});
    });
</script>
</body>
</html>
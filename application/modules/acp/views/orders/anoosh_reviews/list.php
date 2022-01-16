<style>
	.panel.white{
		min-height: 150px;
	}
	.star-grey{
		color: #cccccc;
	}
	.star-colored{
		color: #f8d214;
	}
	.review{
		max-width: 200px;
	    overflow: hidden;
	    text-overflow: ellipsis;
	    height: 20px;
	    text-align: center;
	    margin: auto;
	}
	.stars{
		font-size: 15px;
	}
</style>
<div id="content-main">
    <div class="row">
        <?PHP $this->load->view('acp_includes/response_messages'); ?>
        <div class="col-md-12">
            <h3>
              <?=getSystemString('QR Reviews')?> 
            </h3>
        </div>

        <div class="col-md-12">
            <?PHP 
                  $data[ '__orderStatuses'] = $__orderStatuses; 
                  $this->load->view('orders/anoosh_reviews/snippets/filter', $data); 
            ?>
        </div>


        <div class="col-md-12">

            <div class="panel white" style="padding-bottom: 50px;">

                <h4 class="page-title"><?=getSystemString('Reviews List')?></h4>
                <br />
                <table class="table table-hover" id="reviews_table">
                    <thead>
                        <tr>
                            <th>
                                <?=getSystemString(177)?>
                            </th>
                            <th>
                                <?=getSystemString(1)?>
                            </th>
                            <th>
                                <?=getSystemString(81)?>
                            </th>
                            <th>
                                <?=getSystemString('overall_rating')?>
                            </th>
                            <th>
                                <?=getSystemString('review')?>
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
        var dTable = $('#reviews_table').DataTable({
            columnDefs: [{
                orderable: false,
                targets: -1
            }],
            order: [
                [1, 'desc']
            ],
            select: true,
            pageLength: 15,
            serverSide: true,
            ajax: {
                url: "<?=base_url($__controller.'/getAnooshReviewsList')?>",
                type: "POST",
                cache: false,
                data: function(d) {
                    d.email = $('#email').val();
                    d.name = $('#name').val();
                    d.username = $('#username').val();
                }
            },
            drawCallback: function(settings) {
                $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
                $("#filter_reviews").find(".disable-btn").remove();
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
                    '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/ordersReviews_csv/")?>">Export to csv</a></li>' +
                    '  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url("acp/export/ordersReviews_excel/")?>">Export to excel</a></li>' +
                    '</ul>' +
                    '</div>');
            }
        });

        // filter products
        $("#filter_reviews").on("submit", function() {
            $('#reviews_table').DataTable().draw();
            return false;
        });

    });
</script>
</body>

</html>
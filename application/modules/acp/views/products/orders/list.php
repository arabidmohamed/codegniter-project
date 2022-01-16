<style>
    div.dataTables_wrapper{
        max-width:  100% !important;
    }
    .panel.white{
        min-height: 50px;
    }
    .profile-pic{
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
</style>
<div id="content-main">
    <h3>
        <?= getSystemString(346) ?>

    </h3>	
    <div class="row">
        <?PHP
        $this->load->view('acp_includes/response_messages');
        ?>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="panel white">	
                <?PHP
                $this->load->view('products/orders/snippets/filter');
                ?>
            </div>
        </div>

        <div class="col-xs-12" style="position: relative">
            <div class="panel white">
                <table class="table table-hover" id="orders_table">
                    <thead>
                        <tr>
                            <th><?= getSystemString('Date') ?></th>
                            <th><?= getSystemString('Customer') ?></th>
                            <th><?= getSystemString('Email') ?></th>
                            <th><?= getSystemString('Product') ?></th>
                            <th><?= getSystemString('Licenses') ?></th>
                            <th><?= getSystemString('Domain') ?></th>
                            <th><?= getSystemString('Total') ?> (SAR)</th>
                            <th><?= getSystemString('Payment Verified') ?></th>
                            <th><?= getSystemString('Status') ?></th>
                            <th><?= getSystemString(42) ?></th>
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
<script src="<?= base_url($GLOBALS['acp_js_dir'] . '/datatables.js') ?>"></script>
<script>
    $(function () {

        var dTable = $('#orders_table').DataTable({
            processing: true,
            filter: true,
            responsive: true,
            autoWidth: false,
            order: [[0, 'desc']],
            serverSide: true,
            ajax: {
                url: "<?= base_url('acp/datatable/getCustomerPaymentHistory') ?>",
                type: "POST",
                data: function (d)
                {
                    d.name = $('#filter_name').val();
                    d.email = $('#filter_email').val();
                    d.domain = $('#filter_domain').val();
                    d.status = $('#filter_status').val();
                    d.product = $('#filter_product').val();
                    d.payment = $('#filter_payment').val();
                }
            },
            drawCallback: function (settings) {
                $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
                $("#filter_product_orders").find(".disable-btn").remove();
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
                url: '<?= base_url('localization/datatable-' . $__lang . '.json') ?>'
            }
        });

        // filter pictures
        $("#filter_product_orders").on("submit", function () {
            $('#orders_table').DataTable().draw();
            return false;
        });

    });
</script>
</body>
</html>
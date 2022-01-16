<style>
    .panel.white{
        min-height: 230px;
    }
    .bar-chart {
        width	: 100%;
        height	: 500px;
    }
    .amcharts-chart-div a:last-child, .amcharts-chart-div svg+a{
        display: none !important;
    }
    .line-chart{
        width	: 100%;
        height	: 500px;
    }

</style>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<div id="content-main">
    <div class="content">

        <div class="row" style="width: 100%">




            <div class="col-md-12">
                <div class="panel white" style="min-height: 120px">
                    <h3><?= getSystemString('Filter Reports') ?></h3>
                    <form method="GET" action="<?= base_url($__controller . '/reports') ?>">
                        <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
                            <input type="date" class="form-control" name="fromDate" id="from" placeholder="<?= getSystemString('from_date') ?>" value="<?= (!empty($fromDate))?$fromDate:date('Y-m-d',strtotime('yesterday')) ?>" autocomplete="off">

                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
                            <input  type="date" class="form-control" name="toDate" id="to" placeholder="<?= getSystemString('to_date') ?>" value="<?= (!empty($to_date))?$to_date:date('Y-m-d') ?>" autocomplete="off">

                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 float-right-left">
                            <input type="submit" class="btn btn-primary" value="<?= getSystemString(135) ?>" />
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-md-12 hide">


                <div class="col-md-3">
                    <div class="dash-stat light-shadow rounded">
                            <!-- <span class="dash-stat-icon"><i class="fa fa-leaf" aria-hidden="true"></i></span> -->
                        <div class="dash-stat-cont">
                            <span class="dash-stat-main" id="domains"></span>
                            <span class="dash-stat-sub"><?= getSystemString('Active Domains') ?></span>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="dash-stat light-shadow  rounded">
                            <!-- <span class="dash-stat-icon"><i class="fa fa-leaf" aria-hidden="true"></i></span> -->
                        <div class="dash-stat-cont">
                            <span class="dash-stat-main" id="approved_domains"></span>
                            <span class="dash-stat-sub"><?= getSystemString('approved domain create requests') ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dash-stat light-shadow  rounded">
                            <!-- <span class="dash-stat-icon"><i class="fa fa-leaf" aria-hidden="true"></i></span> -->
                        <div class="dash-stat-cont">
                            <span class="dash-stat-main" id="pending_domains"></span>
                            <span class="dash-stat-sub"><?= getSystemString('pending domain create requests') ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dash-stat light-shadow  rounded">
                            <!-- <span class="dash-stat-icon"><i class="fa fa-usd" aria-hidden="true"></i></span> -->
                        <div class="dash-stat-cont">
                            <span class="dash-stat-main" id="rejected_domains"></span>
                            <span class="dash-stat-sub"><?= getSystemString('rejected domain create requests') ?></span>
                        </div>
                    </div>
                </div>

            </div>



            <div class="col-md-12 hide">



                <div class="col-md-3">
                    <div class="dash-stat light-shadow  rounded">
                            <!-- <span class="dash-stat-icon"><i class="fa fa-usd"></i></span> -->
                        <div class="dash-stat-cont">
                            <span class="dash-stat-main" id="incomplete_domains"></span>
                            <span class="dash-stat-sub"><?= getSystemString('total_incomplete_request') ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dash-stat light-shadow  rounded">
                    <!-- 	<span class="dash-stat-icon"><i class="fa fa-shopping-bag"></i></span> -->
                        <div class="dash-stat-cont">
                            <span class="dash-stat-main" id="approved_transfer"></span>
                            <span class="dash-stat-sub"><?= getSystemString('approved_transfer') ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dash-stat light-shadow  rounded">
                            <!-- <span class="dash-stat-icon"><i class="fa fa-shopping-bag"></i></span> -->
                        <div class="dash-stat-cont">
                            <span class="dash-stat-main" id="pending_transfer"></span>
                            <span class="dash-stat-sub"><?= getSystemString('pending_transfer') ?></span>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="dash-stat light-shadow  rounded">
                    <!-- 	<span class="dash-stat-icon"><i class="fa fa-usd"></i></span> -->
                        <div class="dash-stat-cont">
                            <span class="dash-stat-main" id="rejected_transfer"></span>
                            <span class="dash-stat-sub"><?= getSystemString('rejected_transfer') ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dash-stat light-shadow  rounded">
                            <!-- <span class="dash-stat-icon"><i class="fa fa-shopping-bag"></i></span> -->
                        <div class="dash-stat-cont">
                            <span class="dash-stat-main" id="create_amount"></span>
                            <span class="dash-stat-sub"><?= getSystemString('Total domain create request amounts') ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dash-stat light-shadow  rounded">
                            <!-- <span class="dash-stat-icon"><i class="fa fa-usd"></i></span> -->
                        <div class="dash-stat-cont">
                            <span class="dash-stat-main" id="transfer_amount"></span>
                            <span class="dash-stat-sub"><?= getSystemString('transfer_amount') ?></span>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-12">


                <div class="col-md-6">


                    <div class="panel white" style="padding-bottom: 2em">
                        <h3><?= getsystemstring('domain_details_reports') ?></h3>
                        <br>
                        <table class="table table-hover" id="domainsReports">
                            <thead>

                                <tr>
                                    <td>
                                        <?= getsystemstring('active_domain_reports') ?>
                                    </td>
                                    <td id="active_domains">

                                    </td>
                                </tr>



                                <tr>
                                    <td>
                                        <?= getsystemstring('Domain registered') ?>
                                    </td>
                                    <td id="domain_registered">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        النطاقات المنقولة
                                    </td>
                                    <td id="transfered_domians">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        في انتظار موافقة المركز NIC
                                    </td>
                                    <td id="nic_pending">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        المحذوفة من dnet
                                    </td>
                                    <td  id="admin_delete">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        المحذوف من العميل
                                    </td>
                                    <td id="client_delete">

                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        مرفوض من NIC
                                    </td>
                                    <td id="rejected_nic">

                                    </td>
                                </tr>



                                <tr>
                                    <td>
                                        الموافق عليها (تسجيل من قبل DNet)
                                    </td>
                                    <td id="domain_registered_approved">

                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        الموافق عليها (نقل من قبل العميل)
                                    </td>
                                    <td id="transfered_domians_approved">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        نطاقات مجددة
                                    </td>
                                    <td id="renew_domains">

                                    </td>
                                </tr>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>


                    <div class="panel white" style="padding-bottom: 2em">
                        <h3> <?= getSystemString('Order_details_reports') ?></h3>
                        <br>
                        <table class="table table-hover" id="domainsReports">
                            <thead>

                                <tr>
                                    <td>
                                        تحت المراجعة
                                    </td>
                                    <td id="pending_orders">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        عدد الطلبات الغير مكتملة
                                    </td>
                                    <td id="incomplete_orders">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        عدد الطلبات المكتملة
                                    </td>
                                    <td id="completed_orders">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        عدد الطلبات الغير مدفوعة 
                                    </td>
                                    <td id="need_payment_orders"> 

                                    </td>
                                </tr>



                                <tr>
                                    <td>
                                        في انتظار الموافقة للنقل
                                    </td>
                                    <td id="waiting_approve_transfer">

                                    </td>
                                </tr>


                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>


                    <div class="panel white" style="padding-bottom: 2em">
                        <h3><?= getSystemString('list of TLDs') ?></h3>
                        <br>
                        <table class="table table-hover" id="userReports">
                            <thead>
                                <tr>
                                    <th><?= getSystemString('TLD') ?></th>									
                                    <th><?= getSystemString('Count') ?></th>
                                    <!--<th><?= getSystemString('total_orders') ?></th>-->
                                     <!--<th><?= getSystemString('discount_price') ?></th>--> 
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    
                    <?php foreach($products as $row): ?>
                    <div class="panel white" style="padding-bottom: 2em">
                        <h3><?=$row->{'Product_Name_'.$__lang}?></h3>
                        <br>
                        <table class="table table-hover" id="productsReports">
                            <thead>

                                <tr>
                                    <td>
                                        <?= getsystemstring('total_accounts') ?>
                                    </td>
                                    <td id="total_workspace_accounts_<?=$row->Product_ID?>" >

                                    </td>
                                </tr>



                                <tr>
                                    <td>
                                        <?= getsystemstring('total_users_emails') ?>
                                    </td>
                                    <td id="total_users_<?=$row->Product_ID?>">

                                    </td>
                                </tr>



                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                    
                    <?php endforeach; ?>

                </div>










                <div class="col-md-6">


                    <div class="panel white" style="padding-bottom: 2em">
                        <h3> <?= getsystemstring('financial_details_reports') ?></h3>
                        <br>
                        <table class="table table-hover" id="domainsReports">
                            <thead>

                                <tr>
                                    <td>
                                        النطاقات المسجلة
                                    </td>
                                    <td id="registrationAmount">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        النطاقات المنقولة
                                    </td>
                                    <td id="transferAmount">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        النطاقات المجددة
                                    </td>
                                    <td id="renewAmount">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        مبلغ ال NIC
                                    </td>
                                    <td id="nic_amount"> 

                                    </td>
                                </tr>


<!-- 		<tr style="height: 110px;">
     <td></td>
         <td></td>
</tr> -->

                                <tr>
                                    <td>
                                        اجمالي الايرادات
                                    </td>
                                    <td id="total_amount">

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        ارباح النطاقات 
                                    </td>
                                    <td id="profits_amount">

                                    </td>
                                </tr>



                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="panel white" style="padding-bottom: 2em">
                        <h3> <?= getsystemstring('technical_support_reports') ?></h3>
                        <br>
                        <table class="table table-hover" id="domainsReports">
                            <thead>

                                <tr>
                                    <td>
                                        <?= getsystemstring('new_tickets_reports') ?> 
                                    </td>
                                    <td id="new_tickets">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <?= getSystemString('closed_tickets_reports') ?> 
                                    </td>
                                    <td id="closed_tickes">

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <?= getsystemstring('waiting_reply_reports') ?>
                                    </td>
                                    <td id="waiting_response_tickets">

                                    </td>
                                </tr>


                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>



                    <div class="panel white" style="padding-bottom: 2em">
                        <h3><?= getSystemString('list of change requests types') ?></h3>
                        <br>
                        <table class="table table-hover" id="userReports2">
                            <thead>
                                <tr>
                                    <th><?= getSystemString('requests type') ?></th>									
                                    <th><?= getSystemString('count') ?></th>
                                    <!--<th><?= getSystemString('total_orders') ?></th>-->
                                     <!--<th><?= getSystemString('discount_price') ?></th>--> 
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>




                </div>




            </div>


        </div>

    </div>
</div>

<?PHP
$this->load->view('acp_includes/footer');
?>
<script src="<?= base_url($GLOBALS['home_js_dir'] . '/utilities/utilities.js') ?>"></script>
<!-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>	 -->
<!-- <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>	 -->																	
<script>
    var _urlRow1 = '<?= base_url($__controller . '/getDataRow1') ?>';
    var _urlTable = '<?= base_url($__controller . '/getDataForTable') ?>';
    var _urlTable2 = '<?= base_url($__controller . '/getDataForTable2') ?>';
    var _urlTableDomainDetails = '<?= base_url($__controller . '/getDomainsDetails') ?>';
    var _urlTableFinancialDetails = '<?= base_url($__controller . '/getFinancialDetails') ?>';
    var _urlTableOrdersDetails = '<?= base_url($__controller . '/getOrdersDetails') ?>';
    var _urlTableTicketsDetails = '<?= base_url($__controller . '/getTicketsDetails') ?>';
    var _urlProduct = '<?= base_url($__controller . '/getProductReportsData') ?>/';



    $(function () {
        // var options = {
        // 	fromInput : "#from",
        // 	toInput : "#to",
        // 	format: "yy-mm-dd"
        // };
        // Utilities.functions.dateRangeInit(options);

        // data filter
        var _filter = {
            fromDate: $("#from").val(),
            toDate: $("#to").val()
        };

        // ajax request 1: For 1st Row
        $.post(_urlRow1, _filter, function (r) {
            var result = JSON.parse(r);
            $("#domains").html(result.domains);
            $("#approved_domains").html(result.approved_domains);
            $("#incomplete_domains").html(result.incomplete_domains);
            $("#pending_domains").html(result.pending_domains);
            $("#rejected_domains").html(result.rejected_domains);
            $("#create_amount").html(result.create_amount + ' SAR');
            $("#rejected_transfer").html(result.rejected_transfer);
            $("#pending_transfer").html(result.pending_transfer);
            $("#approved_transfer").html(result.approved_transfer);
            $("#transfer_amount").html(result.transfer_amount + ' SAR');
        });

        // ajax requests for products
         <?php foreach($products as $row): ?>
                 
                $.post(_urlProduct+<?=$row->Product_ID?>, _filter, function (r) {
                    var result = JSON.parse(r);
                    $("#total_users_"+<?=$row->Product_ID?>).html(result.total_users);
                    $("#total_workspace_accounts_"+<?=$row->Product_ID?>).html(result.workspace_accounts);
                });
        <?php endforeach; ?>

        // ajax request 1: For 1st Row
        $.post(_urlTableDomainDetails, _filter, function (r) {
            var result = JSON.parse(r);

            //console.log(result);
            $("#active_domains").html(result.active_now);
            $("#domain_registered").html(result.domain_registered);
            $("#admin_delete").html(result.admin_delete);
            $("#client_delete").html(result.client_delete);
            $("#transfered_domians").html(result.transfered_domians);
            $("#nic_pending").html(result.nic_pending);
            $("#rejected_nic").html(result.rejected_nic);
            $("#renew_domains").html(result.renew_domains);
            $("#domain_registered_approved").html(result.domain_registered_approved);
            $("#transfered_domians_approved").html(result.transfered_domians_approved);

        });


        $.post(_urlTableFinancialDetails, _filter, function (r) {
            var result = JSON.parse(r);

            //console.log(result);
            $("#transferAmount").html(result.transferAmount);
            $("#registrationAmount").html(result.registrationAmount);
            $("#renewAmount").html(result.renewAmount);
            $("#nic_amount").html(result.nic_amount);
            $("#total_amount").html(result.total_amount);
            $("#profits_amount").html(result.profits_amount);

        });


        $.post(_urlTableOrdersDetails, _filter, function (r) {
            var result = JSON.parse(r);

            //console.log(result);
            $("#pending_orders").html(result.pending_orders);
            $("#incomplete_orders").html(result.incomplete_orders);
            $("#completed_orders").html(result.completed_orders);
            $("#need_payment_orders").html(result.need_payment_orders);
            $("#waiting_approve_transfer").html(result.waiting_approve_transfer);


        });


        $.post(_urlTableTicketsDetails, _filter, function (r) {
            var result = JSON.parse(r);

            $("#new_tickets").html(result.new_tickets);
            $("#closed_tickes").html(result.closed_tickes);
            $("#waiting_response_tickets").html(result.waiting_response_tickets);
        });




        // ajax request 5: For Table
        $.post(_urlTable, _filter, function (r) {
            var result = JSON.parse(r);
            var rows = '';
            for (var i = 0; i < result.length; i++)
            {
                var row = tableRows(result[i], $("#from").val(), $("#to").val());

                if (row)
                {
                    rows += row;
                }
            }

            $("#userReports tbody").append(rows);
        });

        function tableRows($data, $fromDate = '', $toDate = '')
        {

            if ($data.CTLD != 0)
            {
                var template = '<tr>';
                template += '<td>' + $data.TLD + ' </td>';
                template += '<td>' + $data.CTLD + '</td>';
                template += '</tr>';

                return template;
            }

            return false;
        }


        // ajax request 5: For Table2
        $.post(_urlTable2, _filter, function (r) {
            var result = JSON.parse(r);
            var rows = '';
            for (var i = 0; i < result.length; i++)
            {
                var row = tableRows2(result[i], $("#from").val(), $("#to").val());

                if (row)
                {
                    rows += row;
                }
            }

            $("#userReports2 tbody").append(rows);
        });

        function tableRows2($data, $fromDate = '', $toDate = '')
        {

            if ($data.CTLD != 0)
            {
                var template = '<tr>';
                template += '<td>' + $data.DCR_Request_Type + ' </td>';
                template += '<td>' + $data.CDCR_Request_Type + '</td>';
                template += '</tr>';

                return template;
            }

            return false;
        }


        function getTotalFollowUps($repliedFollowUps)
        {
            // ajax request 2: For 2nd Row
            return $.post(_urlRow2, _filter, function (r) {
                var result = JSON.parse(r);
                $("#totalFollowUps").html(result.TotalFollowUps - $repliedFollowUps);
            });
        }

    });
</script>
</body>
</html>
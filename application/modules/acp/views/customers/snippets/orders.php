<div class="panel white">
    <?PHP 
        $data[ '__orderStatuses'] = array('Pending', 'Delivered', 'In Process', 'Returned'); 
        //$this->load->view('orders/snippets/filter_orders', $data); 
    ?>
    <h4 class="page-title"><?=getSystemString(346)?></h4>

    <table class="table table-hover" id="orders_table">
        <thead>
            <tr>
                <th>
                    <?=getSystemString(348)?>
                </th>
                <th>
                    <?=getSystemString(356)?>
                </th>
                <th>
                    <?=getSystemString(81)?>
                </th>
                <th>
                    <?=getSystemString(390)?>
                </th>
                <th>
                    <?=getSystemString(353)?>
                </th>
                <th>
                    <?=getSystemString(355)?>
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
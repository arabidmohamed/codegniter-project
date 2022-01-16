<style>
    body[dir="ltr"] table th, body[dir="ltr"] table td{
        text-align: left !important;
    }
    body[dir="rtl"] table th, body[dir="rtl"] table td{
        text-align: right !important;
    }
    table th{
        padding: 9px !important;
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

<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="<?=getSystemString(211)?>"><?=getSystemString(211)?></li>
        </ol>
    </nav>
    <h3><?=getSystemString(211)?></h3>
    <!-- Note: to display total -->
    <div class="container col-md-3" id="totals">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center"><?= $Completed+$Pending ;?></h3>
                <h4>_</h4>
                <p><?=getSystemString('total_tickets')?></p>
            </div>
        </div>
    </div>
    <div class="container col-md-5" id="totals">
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center"><?php echo $Pending ; ?></h3>
                <h4>_</h4>
                <p><?=getSystemString('open')?></p>
            </div>
            <div class="col-md-4">
                <h3 class="text-center"><?php echo $Completed ; ?></h3>
                <h4>_</h4>
                <p><?=getSystemString('closed')?></p>
            </div>
        </div>
    </div>

    <?php $btn_level = ($support_status=='Active') ? 'text-success' : 'text-danger' ; ?>
    <div class="container col-md-3" id="totals">
        <div class="row">
            <div class="col-md-12">
                <?php if($expire_date){ ?>
                    <h3 class="text-center">
                        <span class="btn btn-sm <?=$btn_level?>"><?= $support_status ?></span>
                    </h3>
                    <h4 style="color: <?php echo ($support_status=='Active') ? 'green' : 'red' ; ?>">
                        Expiry Date : <?= date('M d Y', strtotime($expire_date)); ?>
                    </h4>
                <?php }else{ ?>
                    <h3 class="text-center">
                        <span class="<?=$btn_level?>"><?=getSystemString(717)?></span>
                    </h3>
                    <h4 class="<?php echo ($support_status=='Active') ? 'text-success' : 'text-danger' ; ?>">
                        -
                    </h4>
                <?php } ?>
                <p><?=getSystemString(716)?></p>
            </div>
        </div>
    </div>
    <!-- Ends -->
    <div class="row">
        <div class="col-md-12">
            <div>
                <a href="<?=base_url($__controller.'/addNewTicket')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
                    <i class="fa fa-plus"></i> <?=getSystemString(715)?>
                </a>
            </div>
            <div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
                <table class="table table-hover display" id="applications" width="100%">
                    <thead>
                    <tr>
                        <th><?=getSystemString(212)?></th>
                        <th width="300"><?=getSystemString(38)?></th>
                        <th width="150"><?=getSystemString(136)?></th>
                        <th width="280"><?=getSystemString(1)?></th>
                        <th width="150"><?=getSystemString(49)?></th>
                        <th width="130"><?=getSystemString(33)?></th>
                        <th width="185"><?=getSystemString(177)?></th>
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

<div class="btn-group">
    <a class="btn btn-default dropdown-toggle" type="button" href="">
        <button class="btn btn-primary"><i class="fa fa-eye"></i> <?=getSystemString(718)?></button>
    </a>
    <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-angle-down"></span>
    </button>
</div>


<?PHP
$this->load->view('acp_includes/footer');
?>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url('style/acp/js/dropzone.js')?>"></script>
<script>

    var _unlink_url = '<?=base_url($__controller.'/unlinkImage')?>';
    var _post_url = '<?=base_url($__controller.'/uploadTicketImages')?>';

    $(function(){
        $('.footer-ul li:eq(3)').addClass('selected');
        $('.footer-ul li:eq(3) a').addClass('active');
        sessionStorage.ActiveMenu = null;

        var table = $("#applications").DataTable({
            "searching": false,
            "ordering": false,

        });

        //get user tickets
        get_tickets(table);

        /*
setInterval( function () {
            table.ajax.reload();
        }, 30000 );
*/

        $("form").on("submit", function() {
            var valid = $(this).parsley().validate();
            if(!valid) {
                return false;
            }
        });

        // initializing dropzone
        var _uplOptions = {
            init_id: "div#img-dropzone",
            init_ret_id: "#dropzone_ret_ids",
            post_url: _post_url,
            unlink_url: _unlink_url,
            max_files: 10
        };
        initializeDropzoneAdv(_uplOptions);
    });
    var url = '<?=base_url($__controller.'/view_ticket/')?>';
    function get_tickets(table){
        $.ajax({
            url: "https://hcm.dnet.sa/help/get_tickets/<?='0/'.$_SERVER['HTTP_HOST']?>",
            type:"GET",
            dataType:"JSON",
            success: function(result){
                table.destroy();
                console.log(result);
                $("#applications tbody").empty();
                for(var i = 0; i < result.length; i++){
                    var status = 'label-warning';
                    if(result[i].Status == 'In Process') { status = 'label-info'; }
                    if(result[i].Status == 'Completed') { status = 'label-success'; }
                    $("#applications tbody").append('<tr>'+
                        '<td>'+result[i].Ticket_No+'</td>'+
                        '<td>'+result[i].Title+'</td>'+
                        '<td>'+result[i].By_User+'</td>'+
                        '<td>'+result[i].Email+'</td>'+
                        '<td>'+result[i].Category+'</td>'+
                        '<td><label class="label '+status+' ft-b">'+result[i].Status+'</label></td>'+
                        '<td>'+result[i].Date+'</td>'+
                        '<td><a href="'+url+result[i].Ticket_No+'"><button class="btn btn-default"><i class="fa fa-eye"></i> <?=getSystemString(718)?></button></a></td>'+
                        '</tr>');
                }

                $("#applications").DataTable({
                    "searching": false,
                    "ordering": false,
                    language: {
                        url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>'
                    },
                });
            },
            error: function(err, status, xhr){

                console.log(err);
                console.log(status);
                console.log(xhr);
            }
        });
    }

</script>
</body>
</html>
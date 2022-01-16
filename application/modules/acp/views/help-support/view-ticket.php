<style>
    .panel.white{
        min-height: 120px;
    }
    .ft-b{
        font-weight: normal;
        font-size: 14px;
        margin-bottom: 10px;
    }
    .sp-message {
        width: 100%;
        display: inline-flex;
        background-color:#f5f5f5;
        padding: 10px;
        border: 1px solid #eee;
        margin-bottom: 10px;
    }

    .sp-message-white {
        margin-top: 8px;
        background-color: white;
    }


    .background-color {
        background-color:#deeefc;
    }

    .sp-message div:nth-child(1) img{
        width: 40px;
        margin-right: 10px;
        margin-left: 10px;
        height: 40px;
        border-radius: 50% !important;
    }
    .sp-message div:nth-child(2) img{
        max-width: 100%;
    }
    .sp-message label{
        margin-bottom: 3px;
    }
    .sp-message span{
        display: block;
        text-align: left;
    }

    /* Loader */
    #loader {
        position: absolute;
        left: 90%;
        top: 85%;
        display: none;
        z-index: 1;
        width: 50px;
        height: 50px;
        margin: -75px 0 0 -75px;
        border: 5px solid #f3f3f3;
        border-radius: 50%;
        border-top: 5px solid green;
        width: 50px;
        height: 50px;
        -webkit-animation: spin 1s linear infinite;
        animation: spin 1s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Add animation to "page content" */
    .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
        from { bottom:-100px; opacity:0 }
        to { bottom:0px; opacity:1 }
    }

    @keyframes animatebottom {
        from{ bottom:-100px; opacity:0 }
        to{ bottom:0; opacity:1 }
    }

</style>
<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="<?=getSystemString(211)?>"><a href="<?=base_url('acp/helpAndSupport')?>"><?=getSystemString(211)?></a></li>
            <li class="breadcrumb-item active" aria-current="<?=getSystemString(214)?>"><?=getSystemString(214)?></li>
        </ol>
    </nav>
    <div class="col-md-12">
        <h3 class="text-left"><?=getSystemString(214)?></h3>
        <div class="panel white">
            <?PHP
            $userTimezone = new DateTimeZone('Asia/Riyadh');
            $gmtTimezone = new DateTimeZone('GMT');
            $dt = new DateTime($ticket[0]->Date, $gmtTimezone);
            ?>
            <div class="col-xs-12">
                <h3 class="text-left"><?=getSystemString(212)?> <?=$ticket[0]->Ticket_No?></h3>
            </div>
            <div class="col-md-12 col-xs-12 no-padding">
                <div class="col-xs-12 col-sm-4 fl-right col-md-2">
                    <label for="title_en"><?=getSystemString(38)?></label>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-6 fl-right no-padding-left">
                    <label for="title_en" class="text-muted ft-b"><?=$ticket[0]->Title?></label>
                </div>
            </div>

            <div class="col-xs-12 no-padding">
                <div class="col-xs-12 col-sm-4 fl-right col-md-2">
                    <label for="title_en"><?=getSystemString(58)?></label>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-6 fl-right no-padding-left">
                    <label for="title_en" class="text-muted ft-b"><?=$ticket[0]->Category?></label>
                </div>
            </div>


            <div class="col-xs-12 no-padding">
                <div class="col-xs-12 col-sm-4 fl-right col-md-2">
                    <label for="title_en"><?=getSystemString(136)?></label>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-6 fl-right no-padding-left">
                    <label for="title_en" class="text-muted ft-b"><?=$ticket[0]->By_User?></label>
                </div>
            </div>

            <div class="col-xs-12 no-padding">
                <div class="col-xs-12 col-sm-4 fl-right col-md-2">
                    <label for="title_en"><?=getSystemString(1)?></label>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-6 fl-right no-padding-left">
                    <label for="title_en" class="text-muted ft-b"><?=$ticket[0]->Email?></label>
                </div>
            </div>

            <div class="col-xs-12 no-padding">
                <div class="col-xs-12 col-sm-4 fl-right col-md-2">
                    <label for="title_en"><?=getSystemString("host")?></label>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-6 fl-right no-padding-left">
                    <label for="title_en" class="text-muted ft-b"><?=$ticket[0]->Host?></label>
                </div>
            </div>

            <div class="col-xs-12 no-padding">
                <div class="col-xs-12 col-sm-4 col-md-2 fl-right">
                    <label for="title_en"><?=getSystemString(177)?></label>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-6 fl-right no-padding-left">
                    <label for="title_en" class="text-muted ft-b"><?=$dt->format('d-m-Y h:i:sa')?></label>
                </div>
            </div>

            <div class="col-xs-12 no-padding">
                <div class="col-xs-12 col-sm-4 col-md-2 fl-right">
                    <label for="title_en"><?=getSystemString(33)?></label>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-6 fl-right no-padding-left">
                    <?PHP
                    $clr = 'label-warning';
                    if($ticket[0]->Status == 'In Process') { $clr = 'label-info'; }
                    if($ticket[0]->Status == 'Completed') { $clr = 'label-success'; }
                    ?>
                    <label id="ticket_stsLbl" class="label <?=$clr?> ft-b"><?=$ticket[0]->Status?></label>
                    <br>
                    <select class="form-control tckt-status" style="width: 200px; margin-top: 10px;" data-ticketid="<?=$ticket[0]->Ticket_No?>" data-usr="<?='client - '.$this->session->userdata($this->acp_session->username())?>">
                        <option value="Pending" <?PHP if($ticket[0]->Status == 'Pending') { echo 'selected'; } ?>><?=getSystemString('open')?></option>
                        <option value="Completed" <?PHP if($ticket[0]->Status == 'Completed') { echo 'selected'; } ?>><?=getSystemString('closed')?></option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 no-padding">
                <div class="col-xs-12 col-sm-4 col-md-2 fl-right">
                    <label for="title_en"><?=getSystemString(719)?></label>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-6 fl-right no-padding-left">
									<span class="sp-message sp-message-white text-center">
										<div>
											<img src="<?=base_url('style/acp/img/user-avatar.jpeg');?>" alt="user">
                                            <div><?= $ticket[0]->By_User ?></div>
										</div>
										<div>
											<?PHP
                                            $dt = new DateTime($ticket[0]->Date);
                                            ?>
											<label for="title_en" class="text-muted ft-b">
												<p><?=$ticket[0]->Email?></p>
												<p><?=$ticket[0]->Message?></p>

												<?PHP
                                                if(strlen($ticket[0]->File) > 1):
                                                    $images = explode(",", $ticket[0]->File);
                                                    foreach($images as $img):
                                                        ?>
                                                        <br>
                                                        <img src="<?=base_url($GLOBALS['img_ck_dir'].$img)?>" style="max-width: 50%;margin: 5px">
                                                    <?PHP
                                                    endforeach;
                                                endif;
                                                ?>
											</label>
											<span class="text-muted text-left"><small><?=$dt->format('d-m-Y h:i:sa')?></small></span>
										</div>
									</span>
                    <br>

                </div>
            </div>

        </div>

        <h3 class="text-left"><?=getSystemString(215)?></h3>
        <div class="panel white" id="ticket">
            <div class="row">
                <div class="col-xs-12 no-padding message" style="margin-top: 20px;">
                    <div class="col-xs-12 col-sm-4 col-md-2">

                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 no-padding-left">

                        <?PHP
                        foreach($ticket as $row){
                            if(strlen($row->hsMessage) > 0){
                                ?>
                                <?php $backgroundColor = 'background-color'; ?>

                                <div class="row">
                                    <div class="col-4">

                                    </div>
                                    <span class="sp-message <?=!empty($row->username) ?  $backgroundColor: '' ?>">
								    <?PHP
                                    $avatar = base_url('style/acp/img/admin-avatar.png');
                                    if($row->HS_Admin_Id == 0){
                                        $avatar = base_url('style/acp/img/user-avatar.jpeg');
                                    }
                                    ?>
										<div class="text-center">
											<img src="<?=$avatar?>" alt="user">
											<div><?=empty($row->username) ? $ticket[0]->By_User : 'Support' ?></div>
										</div>
										<div>
											<?PHP
                                            $userTimezone = new DateTimeZone('Asia/Riyadh');
                                            $gmtTimezone = new DateTimeZone('GMT');
                                            $dt1 = new DateTime($row->messageDate, $gmtTimezone);
                                            ?>
											<p><?=empty($row->username) ? $ticket[0]->Email : $row->username?></p>
											<label for="title_en" class="text-muted ft-b"><?=$row->hsMessage?></label>
											<?php  if($row->msg_files!=''){ $msg_images = explode(",", $row->msg_files);
                                                foreach ($msg_images as $key => $image) { $im = "https://hcm.dnet.sa/".$image; ?>
                                                    <?php if(is_array(getimagesize($im))){?>
                                                        <p><a href="https://hcm.dnet.sa/<?php echo $image; ?>" target="_blank"><img src="https://hcm.dnet.sa/<?php echo $image; ?>" height="100"></p></a>
                                                    <?php }else{ $ext = pathinfo("https://hcm.dnet.sa/<?php echo $image; ?>", PATHINFO_EXTENSION); ?>
                                                        <p>
											    <video width="320" height="240" controls>
												  <source src="https://hcm.dnet.sa/<?php echo $image; ?>" type="video/mp4">
												</video>
											  </p>
                                                    <?php } } } ?>
											<span class="text-muted"><small><?=$dt1->format('d-m-Y h:i:s a')?></small></span>
										</div>
									</span>
                                </div>
                                <?PHP
                            }
                        }
                        ?>

                    </div>
                </div>

                <div class="col-xs-12 no-padding" style="margin-top: 2em; margin-bottom: 2em">
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title_en"></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <form id="replyform">

										<textarea name="message" id="reply" class="form-control" rows="4" placeholder="<?=getSystemString(276)?>" style="width: 500px;display: inline-block"
                                                  data-ticketid="<?=$ticket[0]->Ticket_No?>"
                                                  data-count="<?=count($ticket)?>"
                                                  data-userid="<?=$this->session->userdata($this->acp_session->userid())?>"></textarea>
                                <input type="hidden" name="ticket" value="<?=$ticket[0]->Ticket_No?>">
                                <input type="hidden" name="userid" value="<?=$this->session->userdata($this->acp_session->userid())?>">
                                <div id="loader" style="<?php if($__lang=='ar'){ echo 'left:27% !important' ;  } ?>"></div>
                                <button class="btn btn-primary reply" style="margin-left: 10px;margin-bottom: 35px;color:#fff"><?=getSystemString(277)?></button>
                                <input type="file" name="attachement[]" id="attachement" multiple>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?PHP
$this->load->view('acp_includes/footer');
?>
<script>
    sessionStorage.ActiveMenu = null;
    $(function(){
        $('.footer-ul li:eq(3)').addClass('selected');
        $('.footer-ul li:eq(3) a').addClass('active');

        $(".tckt-status").on("change", function()
        {
            var _self = $(this);
            var _status = _self.val();
            $(this).attr('disabled', 'disabled');
            var data = { ticket : _self.attr('data-ticketid') , status : _status, changeBy : _self.attr('data-usr') };

            $.ajax({
                url: "https://hcm.dnet.sa/help/changeTicketStatus",
                type:"POST",
                dataType:"JSON",
                data: data,
                success: function(result)
                {
                    _self.removeAttr('disabled');
                    $("#ticket_stsLbl").text(_status);
                    if(_status == 'Completed')
                    {
                        $("#ticket_stsLbl").attr("class", "label label-success ft-b");
                    } else {
                        $("#ticket_stsLbl").attr("class", "label label-warning ft-b");
                    }
                },
                error:function(err, status, xhr){
                    console.log(err);
                    console.log(status);
                    console.log(xhr);
                }
            });
        });

        var userImg = '<?=base_url('style/acp/img/user-avatar.jpeg')?>';
        $("#ticket .reply").on("click", function(){
            var data = {
                ticket  : $('#ticket #reply').attr('data-ticketid'),
                userid  : $('#ticket #reply').attr('data-userid'),
                message : $('#ticket #reply').val(),
            };

            if(data.message.length == 0)
            {
                return false;
            }

            var data2 = new FormData($('#replyform')[0]);

            $("#loader").css("display","block");
            $(".reply").hide();

            $.ajax({
                url: "https://hcm.dnet.sa/help/userTicketReply",
                type: "POST",
                data: data2,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData:false,
                success: function(result){
                    if(result)
                    {
                        var files = document.getElementById("attachement");
                        files = files.files.length;

                        $('#reply').val('');
                        $('#attachement').val('');

                        $("#loader").css("display","none");
                        $(".reply").show();

                        $('<span class="sp-message">'+
                            '<div>'+
                            '	<img src="'+userImg+'" alt="user">'+
                            '</div>'+
                            '<div>'+
                            '	<label for="title_en" class="text-muted ft-b">'+data.message+'</label>'+
                            '	<span class="text-muted"><small>just now</small></span>'+
                            '</div>	'+
                            '</span>').insertAfter('#ticket .sp-message:last');
                        $('#ticket #reply').attr('data-count', (parseInt($('#ticket #reply').attr('data-count')) + 1));

                        if(files>0)
                        {
                            location.reload();
                        }
                    }
                },
                error:function(err, status, xhr)
                {
                    console.log(err);
                    console.log(status);
                    console.log(xhr);
                }
            });
            return false;
        });

        setTimeout(function() {
            getNewMessage();
        }, 5000);

    });

    function getNewMessage(){
        var data = { ticketid: $('#ticket #reply').attr('data-ticketid'), count: $('#ticket #reply').attr('data-count') };
        $.ajax ({
            type: "POST",
            url: "https://hcm.dnet.sa/help/get_new_message",
            data: data,
            dataType:"JSON",
            success: function(result) {
                if(result.length > 0){
                    for(var i = 0; i < result.length; i++){
                        var avatar = '<?=base_url('style/acp/img/user-avatar.jpeg')?>';
                        if(result[i].UserId == 0){
                            avatar = '<?=base_url('style/acp/img/admin-avatar.png')?>';
                        }
                        $('<span class="sp-message">'+
                            '<div>'+
                            '	<img src="'+avatar+'" alt="user">'+
                            '</div>'+
                            '<div>'+
                            '	<label for="title_en" class="text-muted ft-b">'+result[i].Message+'</label>'+
                            '	<span class="text-muted"><small>'+result[i].Date+'</small></span>'+
                            '</div>	'+
                            '</span>').insertAfter('#ticket .sp-message:last');
                    }
                    $('#ticket #reply').attr('data-count', (parseInt(data.count) + parseInt(result.length)));
                }
            },
            complete : function(){
                setTimeout(function(){
                    getNewMessage();
                },9000);
            }
        });
    }
</script>
</body>
</html>
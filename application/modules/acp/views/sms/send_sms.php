<?php
/*
 * Added by Yasir on 31 Oct 2019
 *
 */
if ($is_disabled->Status == 0) {
    show_404();
}
?>
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<style>
    .smsInfolabel{
        padding: 5px;
        font-size: 14px;
        color: #333;
        line-height: 4;
    }
    .smsInfolabel font{
        font-weight: bold;
    }

    .select2-drop-active{
        margin-top: -25px;
    }
</style>
<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="<?=getSystemString(726)?><"><?=getSystemString(726)?></li>
        </ol>
    </nav>

    <h3><?=getSystemString(726)?></h3>
    <!-- Note: total -->
    <div class="container col-md-11" id="totals">
        <div class="row">
            <p><?=getSystemString(732)?>  <?=$totalSMSSent?> / 10000</p>
            <?php if(!isset($Sms_Count)){ ?>
                <div class="col-md-3">
                    <h3 class="text-center"><?php echo $SMS_Bundle; ?></h3>
                    <h4>_</h4>
                    <p><?=getSystemString('bundle_pack')?></p>
                </div>
                <div class="col-md-3">
                    <h3 class="text-center"><?php echo $Total_Sent; ?></h3>
                    <h4>_</h4>
                    <p><?=getSystemString('TotalSMSSent')?></p>
                </div>
                <div class="col-md-3">
                    <h3 class="text-center"><?php echo $Total_Left; ?></h3>
                    <h4>_</h4>
                    <p><?=getSystemString('remain_sms')?></p>
                </div>
                <div class="col-md-3">
                    <h3 class="text-center"><?=$Expired_SMS?></h3>
                    <h4>_</h4>
                    <p><?=getSystemString('Expired_SMS')?></p>
                </div>
            <?php } ?>

        </div>
    </div>	<br>
    <!-- Ends -->

    <div class="row">

        <?PHP
        $this->load->view('acp_includes/response_messages');
        ?>

        <div class="col-md-12">
            <form  action="<?=base_url($__controller.'/sendSMS');?>" class="sendSMSFrm form-horizontal" method="post" data-parsley-validate>
                <div class="panel white" style="padding-bottom: 50px;">

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor1"><?=getSystemString(390)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <select class="select2 tags-tokenizer" name="numbers[]" multiple></select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <label><?=getSystemString(263)?></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2"></div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input class="form-control" name="number" type="number" placeholder="<?=getSystemString(390)?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <label><?=getSystemString(263)?></label>
                        </div>
                    </div>


                       <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor1">مجموعات</label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-4 no-padding-left">
                            <select class="select2 marketing-groups" name="group_name"></select>
                        </div>

                    <div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">

                           <button type="button" data-toggle="modal" data-target="#add_groups_modal"  class="btn btn-default"><?=getSystemString('add_new_group')?></button> 

                    </div>




                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="editor1"><?=getSystemString(245)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <textarea name="message" id="smsMessage" rows="7" placeholder="<?=getSystemString(260)?>" required data-parsley-required-message="<?=getSystemString(213)?>" dir="rtl" class="form-control"></textarea>
                            <label class="smsInfolabel">
                                <?=getSystemString('Message Count')?> : <font id="msg_cnt"> 0</font>
                            </label>


                            <label class="smsInfolabel">
                                <?=getSystemString('Characters Count')?> : <font id="char_cnt">0</font>
                            </label>

                            <label class="smsInfolabel">
                                <?=getSystemString('Rest Characters')?> : <font id="rest_char_cnt">0</font>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-xs-12 text-right">
                        <input type="submit" class="btn btn-primary" value="<?=getSystemString(742)?>" name="submit" />
                    </div>
                </div>

            </form>

        </div>




                            <div class="modal fade" id="add_groups_modal" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog modal-wide" style="width: 35%;">
                           <div class="modal-content">

                                  <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                 <h4 class="modal-title"><?=getSystemString('add_new_group')?> </h4>

                              </div>
<form action="<?=base_url($__controller.'/addGroup');?>" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>
  <div class="modal-body">


                <div class="row">
                  <div class="col-md-12">
                         <div class="form-group">
                              <label class="col-md-4 control-label"><b>عنوان المجموعة</b></label>
                              <div class="col-md-8" >   
                                <input class="form-control" name="group_name" type="text" id="group_name" required>
                              </div>
                           </div>
                  </div>        
                </div>
                <br>
                <div class="row">
                          <div class="col-md-12">
                          <div class="form-group">
                              <label class="col-md-4 control-label"><b>اختر الملف</b> </label>
                              <div class="col-md-8" >  
                                 <input   type="file" name="attachment_file" id="attachment_file" onchange="ValidateSingleInput(this)" required >
                              </div>
                           </div>
                  </div>
                </div>

                  <div class="row">
                     <div class="col-md-4"></div>
                          <div class="col-md-8">

                           <a download href="<?= base_url('style/site/assets/img/').'phones.xlsx' ?>">اضغط هنا لتحميل قالب الاكسل  <i style="font-size: 16px;" class="fa fa-file-excel-o" aria-hidden="true"></i>
                             </a> 
                         </div>
                    </div>




          <br>
           

 </div>

                               <div class="modal-footer">

                                  <button type="submit" name="submit" value="submit" class="btn btn-primary"><?=getSystemString('save_update')?></button> 
                                 <button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString('Close')?></button> 
                             
                              </div>

</form>
                           </div>
                           <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                     </div>


    </div>
    <?PHP
    $this->load->view('acp_includes/footer');
    ?>
    <script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/smsmessage.js')?>"></script>
    <script>
        $(function(){

            $('.sendSMSFrm').submit(function(){
                var _confirm = confirm('<?=getSystemString(514)?>');
                if(!_confirm)
                {
                    $('.disable-btn').remove();
                    return false;
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script>
        function matchCustom(params, data) {

            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.text === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            if (data.text.indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true);
                modifiedData.text += ' (matched)';

                // You can return modified objects from here
                // This includes matching the `children` how you want in nested data sets
                return modifiedData;
            }

            // Return `null` if the term should not be displayed
            return null;
        }

        $(function(){
            $(".tags-tokenizer").select2({
                matcher: matchCustom,
                tokenSeparators: [','],
                data: function(params)
                {
                    return {
                        term: params.term
                    }
                },
                placeholder: "<?=getSystemString(59)?>",
                ajax: {
                    url: '<?=base_url($__controller.'/getMobileNumbers')?>',
                    dataType: 'json',
                    delay: 50,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        });

                $(function(){
            $(".marketing-groups").select2({
                matcher: matchCustom,
                tokenSeparators: [','],
                data: function(params)
                {
                    return {
                        term: params.term
                    }
                },
                placeholder: "<?=getSystemString(59)?>",
                ajax: {
                    url: '<?=base_url($__controller.'/getMarketingGroups')?>',
                    dataType: 'json',
                    delay: 50,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        });
    </script>

    <script>
var _validFileExtensions = [".xls", ".xlsx", ".csv"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
</script>

    </div>
    </html>
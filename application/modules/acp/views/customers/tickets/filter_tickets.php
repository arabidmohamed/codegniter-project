<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;margin-bottom: 20px">
        <h4 class="page-title">
        <?=getSystemString(139)?>
        </h4>
        <div class="col-xs-12 no-padding">
        <form action="" method="post" id="filter_ticket">
        <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
            <div class="form-group">
                <input type="number" id="filter_ticket_id" placeholder="102" class="form-control" />
            </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
            <div class="form-group">
                <input type="text" id="filter_name" placeholder="<?=getSystemString(136)?>" class="form-control" />
            </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
            <div class="form-group">
                <select class="form-control select2" id="filter_status">
                    <option value="-1">
                    <?=getSystemString(59)?>
                    </option>       
                    <option value="New"><?=getSystemString('NEW')?></option>
                    <option value="Pending"><?=getSystemString('pending_ticket')?></option>
                    <option value="In Process"><?=getSystemString('under_review')?></option>
                    <option value="Answered"><?=getSystemString('Answered')?></option>
                    <option value="Customer reply"><?=getSystemString('customer_ticket_reply')?></option>
                    <option value="Closed"><?=getSystemString('Closed')?></option>
                </select>
            </div>
            </div>
           
        <div class="col-xs-12 col-sm-2 col-md-2 float-right-left <?PHP if($__lang == 'en'){ echo 'text-left'; } else { 'text-right'; } ?>">
            <input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
        </div>
    </form>
</div
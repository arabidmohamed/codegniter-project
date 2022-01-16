<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;padding-bottom: 0px !important">
	<h4 class="page-title">
		<?=getSystemString('filte_invoice')?>
	</h4>
	<div class="col-xs-12 no-padding">
		<form action="" method="post" id="filter_invoices">
			<div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
				<div class="form-group">
					<input type="text" id="filter_invoice_id" placeholder="INV123" class="form-control" />
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
				<div class="form-group">
					<input type="text" id="filter_domain" placeholder="dnet.sa" class="form-control" />
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
				<div class="form-group">
					<input type="date" id="filter_order_date" placeholder="" class="form-control" />
				</div>
			</div>
			<div class="col-xs-12 col-sm-2 col-md-2 float-right-left <?PHP if($__lang == 'en'){ echo 'text-left'; } else { 'text-right'; } ?>">
				<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
			</div>
		</form>
	</div>
</div>
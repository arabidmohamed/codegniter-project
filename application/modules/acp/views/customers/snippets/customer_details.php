
<div class="col-md-12">

		<div style="padding-top: 10px;color:#3498db">
				<h4><?=getSystemString('customer_info')?></h4>
			</div>

<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align: left">
	<tbody>
		

		<tr>
			<th><?=getSystemString(81)?></th>
			<td class="text-info"><?=$customer[0]->Fullname?></td>
		</tr>

		<tr>
			<th><?=getSystemString(1)?></th>
			<td>
				<a href="mailto:<?=$customer[0]->Email?>"><?=$customer[0]->Email?></a>
			</td>
		</tr>
		<tr>
			<th><?=getSystemString(137)?></th>
			<td>
				<a href="tel:00<?=$customer[0]->Phone?>"><?=$customer[0]->Phone_Key.$customer[0]->Phone?></a>
			</td>
		</tr>

		<tr>
			<th><?=getSystemString('phone_verified')?></th>
			<td>
				<?php
					if($customer[0]->Phone_Verified == 1){
						echo '<i class="fa fa-check text-success"></i>';
					} else {
						echo '<i class="fa fa-close text-danger"></i>';
					}
				?>
			</td>
		</tr>

		<tr>
			<th><?=getSystemString('email_verify')?></th>
			<td>
				<?php
				$url = base_url('acp/sendVerificationEmailAgain').'/'.$customer[0]->Customer_ID;
					if($customer[0]->Email_Verified == 1){
						echo '<i class="fa fa-check text-success"></i>';
					} else {
						echo '<a href='.$url.' class="btn">اعادة ارسال ايميل التفعيل</a>';
						echo '<i class="fa fa-close text-danger"></i>';
					}
				?>
			</td>
		</tr>


		<tr>
			<th><?= getSystemString('two_factor_authentication') ?></th>
			<td>
				<?php
				
					if($customer[0]->Two_Factor_Auth){
						echo '<i class="fa fa-check text-success"></i>';
					} else {						
						echo '<i class="fa fa-close text-danger"></i>';
					}
				?>
			</td>
		</tr>
		<tr>
			<th><?=getSystemString('created_by')?></th>
			<td><?=$customer[0]->TimeStamp?></td>
		</tr>
<?php if(!empty($customer[0]->Deleted_At)){ ?>
		<tr>
			<th><?=getSystemString('customer_delete_date')?></th>
			<td><?=$customer[0]->Deleted_At?></td>
		</tr>
<?php } ?>

	</tbody>
</table>
</div>
	
	


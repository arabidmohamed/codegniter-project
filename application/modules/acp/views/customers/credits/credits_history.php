
<table class="table table-hover display" id="credits_table" width="100%">
	<thead>
		<tr>
			<th class="hides"><?=getSystemString(41)?></th>
			<th>التاريخ </th>
			<th>المبلغ</th>
			<th>الرصيد</th>
			<th>نوع العملية</th>
			<th>السبب</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach ($transactions as $row) { ?>
			<tr>
				<td><?= $row->CH_ID ?></td>
				<td><?= $row->Created_at ?></td>
				<td><?= $row->Credits ?></td>
				<td><?= $row->Remaining_Balance ?></td>
				<td><?=  $row->Type ?></td>
				<td><?= $row->Reason ?></td>

			</tr>
		<?php } ?>
	
	</tbody>
</table>

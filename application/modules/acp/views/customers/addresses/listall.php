
<div class="panel white">		          
<table class="table table-hover">
 <thead>
     <tr>
	     <th><?=getSystemString(41)?></th>
         <th><?=getSystemString(177)?></th>
         <th><?=getSystemString(371)?></th>
     </tr>
 </thead>
 <tbody>
	 <?PHP
		if(count($addresses) > 0):
		 foreach($addresses as $ad):
	 ?>
	<tr>
		<td>
			<?=$ad->Address_ID?>
		</td>
		<td>
			<?PHP
				$dt = new DateTime($ad->Timestamp);
				echo $dt->format("Y-m-d");
			?>
		</td>
		<td>
			<?=$ad->Address?>
		</td>
	</tr>
	<?PHP
			endforeach;
		else:
		?>
			<tr><td colspan="3" class="text-center"> <?=getSystemString(450)?> </td></tr>
		<?PHP
		endif;
	?>
 </tbody>
</table>			          
	</div>			         
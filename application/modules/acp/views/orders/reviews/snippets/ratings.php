<span class="d-inline-block stars">
<?PHP
	for($k = 0; $k < $rating; $k++)
	{
	 	echo '<i class="fa fa-star star-colored"></i>';
	}
	for($j = 0; $j < (5 - $rating); $j++)
	{
		 echo '<i class="fa fa-star star-grey"></i>';
	}							 
?>
</span>
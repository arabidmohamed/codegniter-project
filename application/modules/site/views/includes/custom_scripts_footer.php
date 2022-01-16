

   <!--      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ar.min.js"></script>  -->
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script src="<?=base_url('style/site/assets/')?>js/bs-stepper.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
	<script src="<?=base_url('style/site/assets/')?>js/bootstrap-hijri-datetimepicker.js"></script>
<script>
	$(document).ready(function() {
		$(".pin-wrapper").validatePin({
			numericKeyboardOnMobile: true,
			blurOnSuccess: true,
			onSuccess: function() {
				$(".pin").html(pin);
			},
			onFailure: function() {
				$(".pin").html("");
			}
		});


		$(".pin-wrapper input").on("paste keyup change", function(){
			var result = $(this).val().split('');
			if(result.length == 4){
				$("#phone1").val(result[0]);
				$("#phone2").val(result[1]);
				$("#phone3").val(result[2]);
				$("#phone4").val(result[3]); 
			}
		});
	}); 
</script>

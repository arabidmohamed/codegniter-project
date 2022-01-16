<?PHP
	/* load header contents #menu */
	$this->load->view('site/includes/header_menu', $data);
 $this->load->view('site/includes/custom_styles_header'); 
?>

<style>
  header{
    z-index: -1;
  }
  .intro{
    margin: auto;
  }
</style>
	<!-- Header -->
	<header class="header header-sub">
    <div class="intro">
      <div class="container pb-5 ">
        <h1 class="text-center pb-2">

		                             <?php 
		       
			   								echo getSystemString('verifiy_phone');

			   									?>
			   									 </h1>
      </div>
    </div>
  </header>
  <!-- End Header -->

	<div class="form-container col-md-9 mx-auto pb-5">
		<div class="container">


          





	


					<form action="<?=base_url('auth/verifyAccount')?>" method="post" id="form" data-parsley-validate autocomplete="off">

				<input type="hidden" name="verify_page_token" value="<?=$verify_page_token?>">
		        <input type="hidden" name="profile_tr" value="<?=$profile_tr?>">
		        <input type="hidden" name="phone_key" value="<?=$phone_key?>">
				<input type="hidden" name="phone" value="<?=$phone?>">
		        <div class=" v-phone col-md-5 mx-auto">

		        		   				          <?PHP
			if(strlen($this->session->flashdata('success')) > 0){
		?>
          <div class="alert alert-success succFlash" role="alert">
            <p class="content contents">
              <?=$this->session->flashdata('success')?>
            </p>
          </div>
          <?PHP
	          }
          ?>
          

          <?PHP
			if(strlen($this->session->flashdata('error')) > 0):
		?>
          <div class="alert alert-danger errorFlash" role="alert">
            <p class="content contents">
              <?=$this->session->flashdata('error')?>
            </p>
          </div>
          <?PHP
	        endif;
          ?>
          
		<div class="alert alert-success hide" role="alert">
            <p class="content contents">
          <?=getSystemString('code_sms_sent')?>
            </p>
          </div>
       <div class="alert alert-danger hide" role="alert">
            <p class="content contents">
            <?=getSystemString('error_sms')?>
            </p>
          </div>
			   			</div>

			   	<div class="v-phone col-md-6 mx-auto">
			   		<h6 class="mb-4"><?php 
		
			   								echo getSystemString('verify_mobile_title_msg');

			   									?></h6>
			   		

			  
			   			<div class="theme-card">
			   			<div class="form-row align-items-center">
			   				<div class="col-md-7 phone-number">
			   					<span><?= $phone_key.$phone ?></span>
			   				</div><!-- /.col-8 -->
			   				<div class="col-md-5 text-right">
			   					<a href="<?= base_url('change_phone_number/'.$verify_page_token); ?>" class="badge badge-primary">
			   						<?= getSystemString('change_phone') ?>
			   					</a><!-- /.badge badge-primary -->
			   				</div><!-- /.col-4 -->
			   			</div><!-- /.row -->
			   			</div><!-- /.theme-card -->
			   	
			   			

					<div class="row">
						<div class="col-md-12 mx-auto">
							<div class="pin-wrapper v-code d-flex mt-5" dir="ltr">
								<input type="tel" id="phone1" name="code1" data-role="pin" class="pin-input" required autocomplete="off" autofocus style="text-align: center !important;">
								<input type="tel" id="phone2" name="code2" data-role="pin" class="pin-input" required autocomplete="off" style="text-align: center !important;">
								<input type="tel" id="phone3" name="code3" data-role="pin" class="pin-input" required autocomplete="off" style="text-align: center !important;">
								<input type="tel" id="phone4" name="code4" data-role="pin" class="pin-input" required autocomplete="off" style="text-align: center !important;">
							</div>
						</div>
	   				</div>
					
	   				<div class="row my-4 align-items-center">
	   					
	   					<div class="col-6">
	   						<?= getSystemString('have_code') ?>
	   					</div><!-- /.col-6 -->
	   					<div class="col-6 text-right">
	   						<a   href="#lost" class="resend-code btn btn-primary-inverse disabled sendcode">
									<?= getSystemString('resend_again') ?>
							</a><!-- /.btn-primary -->
	   					</div><!-- /.col-6 -->
	   					<div class="col-6"></div><!-- /.col-6 -->
	   					<div class="col-6 text-right">
	   						<span id="duration" class="countdown text-center" data-timer="01:00">01:00</span><!-- /#duration -->

	   					
	   					</div><!-- /.col-12 text-right text-black -->
	   				
	   					<div class="col-6"></div><!-- /.col-6 -->
	   					<div class="col-6">
	   						<button type="submit" class="v-btn mt-4 btn-block btn btn-primary-inverse" id="vBtn"><?= getSystemString('confirm') ?></button>
	   					</div><!-- /.col-6 -->
	   				</div><!-- /.row my-4 -->
	   			
			   	</div>
		   </form>
		</div>
	</div><!-- /.form-container -->

	<div class="mt-5"></div><!-- /.mt-5 -->

  <?=   $this->load->view('site/includes/support', $website_config); ?>









<?PHP
	$this->load->view('site/includes/footer', $website_config);
	$this->load->view('site/includes/custom_scripts_footer');
?>
<script>


	$(document).ready(function() {
    $('form:first *:input[type!=hidden]:first').focus();
});

$(function(){



    var elems = [].slice.call(document.querySelectorAll('.form-control.inputs'));

elems.forEach(function(el, i, array) {
  el.onkeypress = function(event) {
    // Validate key is a number
    var keycode = event.which;
    if (!(event.shiftKey === false && 
        (keycode === 46 || keycode === 8 || keycode === 37 || keycode === 39 || 
        (keycode >= 48 && keycode <= 57)))) {
      return;
    }

    var nextInput = i + 1;
    if (nextInput < array.length || this.value.length == 1) {
        array[nextInput].focus();
    }
  };
});

	
	var _successSMSMsg = '<?=getSystemString('code_sms_sent')?>';


			var timer2 = "01:00";
			var interval = setInterval(function() { 

				var timer = timer2.split(':');
				//by parsing integer, I avoid all extra string processing
				var minutes = parseInt(timer[0], 10);
				var seconds = parseInt(timer[1], 10);
				--seconds;
				minutes = (seconds < 0) ? --minutes : minutes;
				seconds = (seconds < 0) ? 59 : seconds;
				seconds = (seconds < 10) ? '0' + seconds : seconds;
				//minutes = (minutes < 10) ?  minutes : minutes;
				$('.countdown').html(minutes + ':' + seconds);
				if (minutes < 0) clearInterval(interval);
				//check if both minutes and seconds are 0
				if ((seconds <= 0) && (minutes <= 0)) {
					clearInterval(interval);
					//$("#countdown-end").modal("show");
					$('.resend-code').removeClass('disabled');

				}
				timer2 = minutes + ':' + seconds;
			}, 1000);
	
	//	$('.sendcode').click(function(e){


$('.sendcode').on('click',function(e){
		e.preventDefault();
		
		var _self = $(this);
		
		if($(_self).is('.disabled')){
			return false;
		}
		
		$(_self).addClass('disabled');
		$("#countdown-end").modal("hide");
		var _data = {
			phone : '<?=@$phone?>',
			phone_key : '<?=@$phone_key?>',
           '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
			
		};

		$.post('<?=base_url($__controller.'/sendVerificationCode')?>', _data, function(result){
			
			var result = JSON.parse(result);

			$('.succFlash').css('display','none');
			$('.errorFlash').css('display','none');



			if (result.info == 1) {

				$('.alert-success').removeClass('hide').text(result.msg);
			        $(_self).addClass('disabled');

			              var timer2 = "01:00";
			      var interval = setInterval(function() { 

			        var timer = timer2.split(':');
			        var minutes = parseInt(timer[0], 10);
			        var seconds = parseInt(timer[1], 10);
			        --seconds;
			        minutes = (seconds < 0) ? --minutes : minutes;
			        seconds = (seconds < 0) ? 59 : seconds;
			        seconds = (seconds < 10) ? '0' + seconds : seconds;
			        //minutes = (minutes < 10) ?  minutes : minutes;
			        $('.countdown').html(minutes + ':' + seconds);
			        if (minutes < 0) clearInterval(interval);
			        //check if both minutes and seconds are 0
			        if ((seconds <= 0) && (minutes <= 0)) {
			          clearInterval(interval);
			          $('.resend-code').removeClass('disabled');

			        }
			        timer2 = minutes + ':' + seconds;
			      }, 1000);


            } 
            
            if (result.info == 0) {
	          	$('.alert-danger').removeClass('hide').text(result.msg);				
            }


            
            $(".attempts").text(result.attempts);
		});
		
	});
	
});
</script>
</body>
</html>

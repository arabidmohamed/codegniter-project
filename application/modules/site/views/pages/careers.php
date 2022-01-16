<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .hide{
        display: none;
    }
    li{
        list-style: none;
    }
    .ui-widget-header{
        background: #0e7ea7 !important;
        color: white !important;
    }
    .ui-widget.ui-widget-content{
        border-radius: 8px !important;
    }
    .ui-state-highlight, .ui-widget-content .ui-state-highlight{
        border: 1px solid #ffffff !important;
        background: #0e7ea7 !important;
        color: white !important;
    }
</style>

<?PHP
    /* load header contents #menu */
    $__lang = $this->session->userdata($this->site_session->__lang_h());
    $this->load->view('includes/header_menu');
    $title = 'Title_'.$__lang;
?>


        <!-- Header -->
        <header class="header header-sub">
            <div class="container">
            <div class="header-box text-lg-left text-center">
                <h1 class="title mb-4"><?=getSystemString(493)?></h1>
                <nav class="breadcrumb">
                <a class="breadcrumb-item" href="<?=base_url('')?>"><?=getSystemString(218)?></a>
                <span class="breadcrumb-item active"><?=getSystemString(493)?></span>
                </nav>
            </div>
            </div>
        </header>
        <!-- End Header -->

        <!-- career-section" -->
		<section class="career-section tech-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-12">
						<div class="title-section text-center">
							<h2 class="title"><?=getSystemString(493)?></h2>
							<p class="info"><?=getSystemString('career_note')?></p>
						</div>
					</div>
				</div>
				<div class="row justify-content-center justify-content-center">
					<div class="col-lg-10">
                    <form action="<?=base_url('careers/SendApplication')?>" class="needs-validation form career-form cmb-5 mb-5" method="POST" enctype="multipart/form-data" novalidate>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<p> <?=getSystemString('199')?></p>
										<select class="form-control custom-select" id="ca_chooseposition" name="ca_chooseposition" required>
                                        <option value="">
                                            <?=getSystemString(199)?>
                                        </option>
                                        <?PHP
                                            $titlej__='Title_' .$__lang;
                                            foreach($careers as $row): ?>
                                            <option value="<?=$row->Career_ID?>">
                                                <?=ucwords(strtolower(stripcslashes($row->$titlej__)))?>
                                            </option>
                                            <?PHP endforeach; ?>
										</select>
										<div class="invalid-feedback"><?=getSystemString('required')?></div>
									</div>
								</div>
							</div><div class="row">
								<div class="col-12">
									<div class="form-group">
										<h6><?= getSystemString('job_description') ?></h6>
										<ul class="career-condition job-description" id="job-description">

										</ul>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<p> <?= getSystemString(81) ?></p>
										<input type="text" class="form-control" id="ca_fullname" name="ca_fullname" placeholder="<?= getSystemString(81) ?>" name="name" required>
										<div class="invalid-feedback"><?=getSystemString('required')?></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<p> <?= getSystemString(216) ?></p>
										<input type="text" id="phone" name="ca_mbno" dir="ltr" class="form-control" placeholder="00996598598584" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"required>
										<div class="invalid-feedback"><?=getSystemString('required')?></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<p> <?=getSystemString('210')?></p>
										<input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="1991-05-17" name="birdthday" required>
										<div class="invalid-feedback"><?=getSystemString('required')?></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<p > <?=getSystemString('236')?></p>
										<select class="form-control custom-select"  name="ca_gender"  id="ca_gender" title="<?=getSystemString('236')?>" required>
											<option></option>
											<option value="<?=getSystemString(194)?>"><?=getSystemString(194)?></option>
											<option value="<?=getSystemString(195)?>"><?=getSystemString(195)?></option>
										</select>
										<div class="invalid-feedback"><?=getSystemString('required')?></div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<p> <?=getSystemString('1')?></p>
										<input type="email" id="ca_email" name="ca_email" dir="ltr" class="form-control" placeholder="ex: example@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
										<div class="invalid-feedback"><?=getSystemString('required')?> </div>
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<p> <?=getSystemString('201')?></p>
										<select class="form-control custom-select" name="ca_nationality" id="ca_nationality" title="<?=getSystemString('201')?>" required>
                                        <option></option>
                                        <?PHP foreach($nationalities as $row){ $natTitle='Nationality_' .$__lang; ?>
                                        <option value="<?=$row->Nationality_ID?>">
                                            <?=$row->$natTitle?></option>
                                        <?PHP } ?>
										</select>
										<div class="invalid-feedback"><?=getSystemString('required')?></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<p> <?=getSystemString('202')?></p>
										<select class="form-control custom-select" name="ca_city" id="ca_city" title="<?=getSystemString('202')?>" required>
                                            <option></option>
                                            <?PHP foreach($cities as $row){ $cityTitle='name_' .$__lang; ?>
                                            <option value="<?=$row->id?>">
                                                <?=$row->$cityTitle?></option>
                                            <?PHP } ?>
										</select>
										<div class="invalid-feedback"><?=getSystemString('required')?></div>
									</div>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-md-5">
									<p><?=getSystemString(519)?> </p>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<input type="file" name="file" id="cv-file" class="inputfile form-control" accept="application/pdf,application/jpg,application/png" required>
										<label for="cv-file" class="btn btn-upload mb-3" id="select-file">
											<svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24.225" height="20.019" viewBox="0 0 24.225 20.019"><g transform="translate(0.161 -1.981)"><path class="a" d="M16,16l-4-4L8,16"></path><line class="a" y2="9" transform="translate(12 12)"></line><path class="a" d="M20.39,18.39A5,5,0,0,0,18,9H16.74A8,8,0,1,0,3,16.3"></path><path class="a" d="M16,16l-4-4L8,16"></path></g></svg>
											<span><?=getSystemString(520)?></span>
										</label>
										<div class="invalid-feedback"><?=getSystemString('required')?> </div>
										<div id="filename"></div>
									</div>
								</div>
							</div>
							<hr class="my-5">
							<div class="form-group row justify-content-center">
								<div class="col-lg-4 col-md-6 col-sm-9">
									<button type="submit" class="btn btn-secondary border-0 btn-block"> <?=getSystemString(242)?></button>
								</div>
							</div>
						</form>
						<?php
                            echo $this->load->view('includes/response_messages');
                        ?>
					</div>
				</div>
			</div>
		</section>










<?PHP
    $this->load->view('includes/footer', $website_config);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script>

$( function() {
    $( "#datepicker" ).datepicker();
  } );

$(document).ready(function() {
    $('input').attr('autocomplete', 'off');
$("input[type=tel]").on("keypress keyup blur", function (event) {
    $(this).val($(this).val().replace(/[^0-9]/g, '').replace(/^(0*)/,""));
      if ( (event.which < 48 || event.which > 57) || $(this).val().length >=9 ) {
          event.preventDefault();
      }
});
});

$(document).ready(function(){


    $(document).on("change", "#ca_chooseposition", function() {
        var job = $(this).val();
        var data = {
            id: job
        };
        $.ajax({
            url: "<?=base_url('careers/GetJobDescription')?>",
            type: "POST",
            dataType: "JSON",
            data: data,
            success: function(data) {
                $("#job-description").html(data.Description).show();
            },
            error: function(err, status, xhr) {
                console.log(err);
                console.log(status);
                console.log(xhr);

            }
        });
    });




  $('#careers-form').submit(function (event) {
   event.preventDefault();

    if ($('#careers-form')[0].checkValidity() === false) {
        return false;
     }
   else {

        // var btn = $(this).find("input[type='submit']");
        // $(btn).hide().next('.career-spinner').show();

           var input = document.querySelector('#phone');
            var iti = window.intlTelInputGlobals.getInstance(input);
            var countryData = iti.getSelectedCountryData();




        var formData = new FormData($('#careers-form')[0]);

         formData.set('ca_mbno', countryData.dialCode+$("#careers-form").find("#phone").val());


        $.ajax({
            url: "<?=base_url('careers/SendApplication')?>",
              type: "POST",
                    data: formData,
                     processData: false,
                    contentType: false,
                    async:false,
            success: function(result) {
        $("#careers-form input, #careers-form textarea, #careers-form button").removeAttr('disabled');
                $('#careers-form input').val('');
                $('#careers-form select').val('0');

                $('#ca_chooseposition').change();
                 $('#filename').text('');

             $(".alert-success").removeClass("hide");
            $(".alert-danger").addClass("hide");

                $('#careers-form').removeClass('was-validated');
            },
            error: function(err, xhr, status) {
                  $("#contact_form input, #contact_form textarea, #contact_form button").removeAttr('disabled');
                console.log(err);
                console.log(status);
                console.log(xhr);
            }
        });
        return false;

    }
    });




});


    $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('#filename').text(fileName);
            //alert('The file "' + fileName +  '" has been selected.');
        });
    });


</script>
<script>
	$(function()
	{
	    var current = location.pathname;
	    //console.log(current)
	    $('#nav li a').each(function(){
	        var $this = $(this);
	        // if the current path is like this link, make it active
	        if($this.attr('href').indexOf(current) !== -1){
		        $('#nav .actives').removeClass('actives');
	            $this.addClass('active');
	        }
	    })
	})
</script>

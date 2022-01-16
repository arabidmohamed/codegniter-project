<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script> -->


<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">

<!-- 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

<style type="text/css">
/* 	.bootstrap-select .dropdown-toggle .filter-option-inner-inner{
overflow: hidden;
    font-size: 13px;
}
:not(.input-group) > .bootstrap-select.form-control:not([class*="col-"]) {
    width: 100%;
border: 1px solid #ced4da;
    border-radius: .25rem;
}
.form-control {
    font-size: 12px;
    }

.bootstrap-select .dropdown-menu li {
    font-size: 12px;
}

select.form-control:not([size]):not([multiple]) {
    height: 35px;
}

.alert {
    padding: 15px;
    margin-bottom: -4px;
    border: 1px solid transparent;
    border-radius: 4px;
    width: 71%;
}

a:not([href]):not([tabindex]) {
    color: white; 
    text-decoration: none;
}

.navbar {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 30px !important;
    padding: 10px 10px 10px 20px !important;
    background: #1F2C36 !important;
    border-radius: 0 !important;
    margin-bottom: 0 !important;
    border: none !important;
    z-index: 106 !important;
}

h1:not(.page-header):not(.modal-title), h2:not(.page-header):not(.modal-title), h3:not(.page-header):not(.modal-title), h4:not(.page-header):not(.modal-title), h5:not(.page-header):not(.modal-title), h6:not(.page-header):not(.modal-title) {
    margin: 0px 0 15px 885px !important;
} */

body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #e8eaee;
}

</style>

<div id="content-main">
	<h3><?=getSystemString('add_key')?></h3>
	<div class="row">
		<?PHP
			
			$this->load->view('acp_includes/response_messages');
		?>

		<div class="col-md-12">
			<?PHP
				$lang_setting['website_lang'] = $website_lang;
				//load tabs
				$this->load->view('acp_includes/lang-tabs', $lang_setting);
			?>
							
			<form action="<?=base_url('acp/keys/save_Key');?>" class="form-horizontal" method="post">
			<div class="panel white" style="padding-bottom: 50px;">
					
		          	<div class="tab-content">
		          		<div class="tab-pane fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
							<div class="form-group">	
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString('key_name')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="text" class="form-control" name="name_en" value="<?php echo @$key['Name_en']; ?>" required maxlength="40"> 
								</div>
							</div>
						</div>
						<div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
							<div class="form-group">	
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString('key_name')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="text" class="form-control" name="name_ar" value="<?php echo @$key['Name_ar']; ?>" required maxlength="40" dir="rtl"> 
								</div>
							</div>
						</div>
						<div class="form-group">	
							<div class="col-xs-12 col-sm-4 col-md-2">
								<span class="form-control btn btn-warning" id="keygen">Generate API Key</span>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<input type="text" class="form-control" name="key" value="<?php echo @$key['key']; ?>" required maxlength="40" onchange="Check_ForKey(this.value)" id="checkkey" readonly> 
							</div>
						</div>
						<!-- <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title">Choose Type</label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<select class="form-control selectpicker" name="type" required>
									<option value="">--Select--</option>
									<option value="0" <?php echo (@$key['is_private_key']==0) ? 'selected' : '' ; ?>>Public</option>
									<option value="1" <?php echo (@$key['is_private_key']==1) ? 'selected' : '' ; ?>>Private</option>
								</select>
							</div>
						</div> -->
					</div>
		      	<input type="hidden" name="key_id" value="<?php echo @$key['id']; ?>">
			</div>
			<div class="form-group">
				<div class="col-xs-12 text-right">
					<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" id="submitbtn"/>
				</div>
			</div>
			</form>
		          
</div>
		
	</div>
</div>

<?PHP
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script>
	$(function(){
		menu_track_manual(5,0);
		
		$(".select2").select2({
			theme:'bootstrap',
			placeholder: '<?=getSystemString(59)?>'
		});
		
	}); 			
 

function filter_types(id)
{

	if(id!='')
	{
		if(id=='1' || id=='2')
		{
			$("#show_categories").addClass('hide');

			if(id=='1')
			{
			   $("#show_products").removeClass('hide');
			}
			
			if(id=='2')
			{
			   $("#show_products").addClass('hide');
			}

			$("#categories").val('');
		}
		else
		{
			$("#show_products").addClass('hide');
			$("#show_categories").removeClass('hide');

			//$("#categories").attr('multiple','multiple');

			$("#products").val('');
		}
	}
}


function set_end_date(start_date)
{
	$("#end_date").val('');

	var date_array = start_date.split('-',3);

	console.log(date_array);

	var start_day = parseInt(date_array[2])+1 ; 

	var end_date_obj = new Date(date_array[0],date_array[1],start_day);

	var year  = end_date_obj.getFullYear() ;
	var month = end_date_obj.getMonth()    ;
	var date  = end_date_obj.getDate()     ;

	if(month<10)
	{
		month = '0'+month ;
	}

	var end_date = year+'-'+month+'-'+date ;

	//Set end_date to feature 1 day based on start_date
	$("#end_date").attr('min',end_date);
}


$('select').selectpicker();
</script>

<script type="text/javascript">

function Check_ForKey(key)
{
	$("#submitbtn").removeClass('hide');

	$.ajax({
            url: "<?=base_url('acp/keys/Check_ForKey')?>",
            type: "POST",
            data: {'key':key,},
            error:function(request,response)
            {
              console.log(request);
            },
            success: function(result)
            {
            	if(result!='0')
            	{
            		$("#submitbtn").addClass('hide');

            		alert("API-KEY already Exist");
            	}
            }
        });
}



function generateUUID(length)
{
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }

   return result;
}

$( '#keygen' ).on('click',function()
{
	$("#submitbtn").removeClass('hide');

	var str = generateUUID(20) ;

	$( '#checkkey' ).val(str);

	Check_ForKey(str);
});

</script>

</body>
</html>
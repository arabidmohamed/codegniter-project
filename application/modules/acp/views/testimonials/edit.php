	<style>
		.fa-spin{
		    position: absolute;
		    right: 30px;
		    top: 10px;
		    font-size: 16px;
		    color: #aaa;
		}
		#video_frame{
			margin-top: 20px;
		}
	</style>
	<div id="content-main">
		<h3>
			<?=getSystemString('update_customer_review')?>
		</h3>
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
					<form action="<?=base_url('acp/testimonials/updateCustomerReview');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
		          <div class="panel white" style="padding-bottom: 50px;">
			          <input type="hidden" name="id" value="<?=$reviews[0]->ID?>">
			           <div class="tab-content">			          
				           
				           <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
					           <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">اسم العميل</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" name="title" class="form-control" data-parsley-required-message="<?=getSystemString(213)?>" placeholder="مثال: رآي عبدالله  " dir="rtl" require="" value="<?=$reviews[0]->Title?>">
										
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">عدد النجوم</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="hidden" id="star" value="<?=$reviews[0]->Stars?>">
										<select class="form-control" name="stars" id="starsField">
											<option value="">-- اختر --</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">نوع المحتوى</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<select class="form-control" 
												name="type"
												id="exampleFormControlSelect1"
												required 
												data-parsley-required-message="<?=getSystemString(213)?>">
												<option value=""><?=getSystemString(59)?></option>
												<option value="content" <?php if($reviews[0]->Type == 'content'){echo 'selected';}?>>نص</option>
												<option value="video" <?php if($reviews[0]->Type == 'video'){echo 'selected';}?>>فيديو</option>
										</select>
											
									</div>
								</div>
								<div class="form-group" id="video" style="display:  <?php if($reviews[0]->Type == 'content'){echo 'none';}else{echo 'block';}?>">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">فيديو</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input class="form-control" 
												  rows="1" 
												  name="video" 
												  id="showreel"
												  type="text"
												  value="<?=$reviews[0]->Video?>"
												  placeholder="مثال: https://www.youtube.com/embed/XDOav0LvHC0" 
												  dir="rtl"
												  data-parsley-required-message="<?=getSystemString(213)?>">
										<i class="fa fa-spinner fa-spin hide"></i>
										<input type="hidden" name="showreel" id="embed_showreel" class="form-control" value="<?=$reviews[0]->Video?>" placeholder="">
										<div class="<?PHP if(strlen($reviews[0]->Video) == 0){ echo 'hide'; }  ?>" id="video_frame">
											<iframe width="560" height="315" src="<?=$reviews[0]->Video?>" frameborder="0" allowfullscreen></iframe>
										</div>
										
									</div>
								</div>
								<div class="form-group" id="content" style="display:  <?php if($reviews[0]->Type == 'video'){echo 'none';} else {echo 'block';}?>">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(13)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 no-padding-left">
										<textarea class="basic-editor-ar" name="editor" id="editor4"><?=$reviews[0]->Quotes?></textarea>
										
									</div>
								</div>
				           </div>


				                      	<div class="form-group" id="single" >
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(14)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="file" class="fileToUpload" name="background_picture" id="inputFile" data-thumb-width="650" data-thumb-height="450">
									<small><?=getSystemString('ImgDimensions')?></small>
									<br>
									<img src="<?=base_url($GLOBALS['img_ck_dir'].$reviews[0]->Picture)?>" style="margin-top: 10px; width: 450px;"  id="Thumbnailimage">
									
								</div>
							</div>
				           
			           </div>
			           
						                 
									
			          
		          </div>
		          <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" />
							</div>
						</div>
		          </form>
				</div>
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>

<script type="text/javascript">
  $(document).ready(function(){


  			$("#inputFile").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#Thumbnailimage').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });


  			
    $('#exampleFormControlSelect1').on('change', function() {
	      if ( this.value == 'content')
	      {
	        $("#content").show();
	        $("#video").hide();
	      }
	      else
	      {
		    $("#video").hide();
		    $("#content").show();
	      }
    });
   });

   $(document).ready(function(){
    $('#exampleFormControlSelect1').on('change', function() {
	      if(this.value == 'video')
	      {
	        $("#video").show();
	        $("#content").hide(); 
	      }
	      else
	      {
		    $("#content").hide(); 
		    $("#content").show();
	      }
    });
   });
</script>
<script>
	$(function(){
		$("#showreel").on("paste change blur focusout", function(){
			var input = $(this);
			$(".fa-spin").removeClass('hide');
			$("input[type='submit']").attr("disabled", "disabled");
			setTimeout(function () { 
				var video_id = getYoutubeId($(input).val());
				if(video_id){
					var embed_url = "//www.youtube.com/embed/" + video_id;
					$("#embed_showreel").val(embed_url);
					$('#video_frame iframe').attr("src", embed_url);
					$("#video_frame").removeClass('hide');
				}
			}, 100);
			$(".fa-spin").addClass('hide');
			$("input[type='submit']").removeAttr("disabled");
		});
	});
</script>
<script>
$("#starsField").val($("#star").val());
</script>
</body></html>
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
		<?PHP
						$section = "SectionName_".$__lang;
						$return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
					?>
			<div class="row">
				
								<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
				<div class="col-md-10">
					<h1>
						<?=$showreel[0]->$section?> 
						
						<div class="dropdown d-inline-block float-left-right">
							<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>
						    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url($__controller."/editSection/".$showreel[0]->Section_ID."/".$return_url."/")?>"><i class="fa fa-cog"></i> <?=getSystemString(315)?></a></li>
						    </ul>
						</div>
			
					</h1>
				</div>
				<div class="col-md-10">
        			<form action="<?=base_url($__controller.'/updateShowreel');?>" class="form-horizontal" method="post"> 
		          <div class="panel white" style="padding-bottom: 50px;">
			        <div class="col-xs-12" style="padding:0px"><h4 class="text-info"><?=getSystemString(53)?> </h4>
							     <ol style="margin-bottom: 30px">
								     <li><?=getSystemString(54)?></li>
								     <li><?=getSystemString(55)?></li>
								     <li><?=getSystemString(56)?></li>
								     <li><?=getSystemString(57)?></li>
							     </ol>
						     </div>

							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="editor1"><?=getSystemString(65)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="url" id="showreel" class="form-control" value="<?=$showreel[0]->Video_Url?>" placeholder=""> <i class="fa fa-spinner fa-spin hide"></i>
									<input type="hidden" name="showreel" id="embed_showreel" class="form-control" value="<?=$showreel[0]->Video_Url?>" placeholder="">
									<div class="<?PHP if(strlen($showreel[0]->Video_Url) == 0){ echo 'hide'; }  ?>" id="video_frame">
										<iframe width="560" height="315" src="<?=$showreel[0]->Video_Url?>" frameborder="0" allowfullscreen></iframe>
									</div>
									
								</div>
							</div>
						          
							
							
		          
				</div>
				
				<div class="form-group">
								<div class="col-xs-12 text-center">
									<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" />
								</div>
							</div>
			         
					  	</form>
				
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
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
</body>
</html>
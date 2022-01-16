	<div id="content-main">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="<?=getSystemString(86)?>"><a href="<?=base_url('acp/manageUsers')?>"><?=getSystemString(86)?></a></li>
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(750)?>"><?=getSystemString(750)?></li>
            </ol>
        </nav>
		<h3><?=getSystemString(750)?></h3>
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-12">
					
				<form action="<?=base_url($__controller.'/addUser');?>" class="form-horizontal" method="post" autocomplete="off">	
					
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			          				         
				         <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="name"><?=getSystemString(81)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<input type="text" class="form-control" name="name" placeholder="<?=getSystemString(81)?>" required="" value="">
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="name"><?=getSystemString(82)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<input type="email" class="form-control" name="username" placeholder="<?=getSystemString(82)?>" required="" value="" autocomplete="off">
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="name"><?=getSystemString(83)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								
								<input type="password" class="form-control" name="password" placeholder="<?=getSystemString(83)?>" value="" required autocomplete="new-password">
								<p><small><?=getSystemString(84)?></small></p>
								
							</div>
						</div>
						<!--<?PHP
							if(is_array($roles)):
							foreach($roles as $role):
						?>
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2"></div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<div class="radio">
											<label><input type="radio" name="role" value="<?=$role->Role_ID?>" style="top:9px"><?=$role->Name?></label>
										</div>
									</div>
								</div>
						<?PHP
							endforeach;
							endif;
						?> -->
						<!-- <div class="form-group hide">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="name"><?=getSystemString(285)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<div class="checkbox">
									<label><input type="checkbox" name="role" value="3" checked="" style="top:9px"><?=getSystemString(286)?></label>
								</div>
							</div>
						</div> -->

                      <div class="form-group">
                          <div class="col-xs-12 col-sm-4 col-md-2">
                              <label for="name"><?=getSystemString(285)?></label>
                          </div>
                          <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                              <select class="form-control" name="role" required>
                                  <option value="3">--اختر دور المستحدم --</option>
                                  <?PHP
                                  if(is_array($roles)):
                                    foreach($roles as $role):
                                  ?>
                                        <option value="<?=$role->Role_ID?>"><?=$role->Name?></option>
                                  <?PHP
                                    endforeach;
                                  endif;
                                  ?>
                              </select>
                          </div>
                      </div>
			          
		          </div>

			        <div class="form-group">
						<div class="col-xs-12 text-right">
							<input type="submit" class="btn btn-primary" value="<?=getSystemString(85)?>" name="submit" />
						</div>
					</div>
			          
		          
		          
	          </form>
		          
				</div>
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
</body>
</html>

    <style>
    .video-thumb{
        display: block;
        width: 42px;
        height: 30px;
        text-align: center;
        background: #b5b0b0;
        border-radius: 2px;
        margin: auto;
    }
    body[dir='rtl'] .video-thumb{
        margin-right: 0px;
    }
    .video-thumb i{
        margin-top: 20%;
        color: #e44747;
    }
        .panel.white{
        min-height: 150px ;
    }
    .dropzone .dz-message{
        margin: 0px;
        font-size: 13px;
    }
    .dropzone{
        min-height: 0px;
    }
    .select2{
        width: 100% !important;
    }
    .crop-image{
		width: 300px;
		height: 200px;
	}
	table th, table td{
		text-align: left !important;
	}
	table th{
		float: right;
	}
	table td{
		width: 50% !important;
	    text-align: right !important;
	    float: right !important;
	}
	
    </style>
    <div id="content-main">
        
        <div class="row">
						
			<div class="col-md-12">
				<h3>
                    <?=$communication->Title?>
                </h3>
                <form action="<?=base_url($__controller.'/updatecommunicationStatus')?>" method="post" accept-charset="utf-8">
					<input type="hidden" name="CommunicationId" value="<?=$communication->CommunicationId?>">
					<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
						
						<table class="table display" id="customer_table" style="width: 100%; margin-bottom: 30px;text-align:left">
							<tbody>
	                            <tr>
									<th>اسم الطالب</th>
									<td><?=$communication->Fullname?></td>
								</tr>
								<tr>
									<th>البريد الإلكتروني</th>
									<td><?=$communication->Email?></td>
								</tr>
								<tr>
									<th>رقم الجوال</th>
									<td><?=$communication->Phone?></td>
								</tr>
								<tr>
									<th>تفاصيل التذكرة</th>
									<td><?=$communication->Description?></td>
								</tr>
								<tr>
									<th>الحالة</th>
									<td>
										<?PHP
											
										$status_arr = array(
											'Pending' => 'warning',
											'Closed' => 'success', 
											'In Progress' => 'primary',
										);
										$statusesL = array('Pending', 'In Progress', 'Closed');
										$communication_status = $communication->Status;
									  	$label = $status_arr["$communication_status"];	
									  	
									?>
									<div class="col-xs-12 no-padding">
										<span class="label label-<?=$label?>"><?php if($communication_status == 'Pending'){echo 'تذكرة جديدة';}
																	  elseif($communication_status == 'In Progress'){echo 'قيد العمل';}
																	  elseif($communication_status == 'Closed'){echo 'تذكرة مكتملة';}?></span>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-12 no-padding text-justify">
										<div class="form-group" style="position:relative; overflow:hidden;padding-right: 13px;">
											<?PHP
												foreach($statusesL as $status){
													?>
													<div classc="col-xs-12 no-padding" style="float:none">
														<div class="radio">
															<label>
																<input type="radio" name="communicationStatus" value="<?=$status?>"
																<?PHP
																	if($communication_status == $status){
																		echo 'checked';
																	}
																?>>
																<?php if($status == 'Pending'){echo 'تذكرة جديدة';}
																	  elseif($status == 'In Progress'){echo 'قيد العمل';}
																	  elseif($status == 'Closed'){echo 'تذكرة مكتملة';}
																?>
															</label>
														</div>
													</div>
													<?PHP
												}
											?>
										</div>
									</div>
									</td>
								</tr>
							</tbody>
						</table>						
					</div>
					
					<div class="form-group text-right">
						<input type="submit" class="btn btn-primary" name="submit" value="تحديث الحالة">
					</div>
				</form>
					<div class="panel white" id="comments">
						
						<h4>تعليق الإدارة</h4>
						
						<div class="col-xs-12 no-padding message" style="margin-top: 20px;">
							<div class="col-xs-12 col-sm-8 col-md-8 no-padding-left">
								
								<?PHP
									if(count($comments) == 0):
										echo '<p> لا يوجد تعليق </p>';
									endif;
									
									foreach($comments as $row):
								?>
										
								    <span class="sp-message <?=$row->Role?>">
										<div>
											<h4> <i class="fa fa-user"></i> <?=$row->AddedBy?></h4>
											<?PHP
												$dt1 = new DateTime($row->Timestamp);
											?>
											<blockquote for="title_en" class="text-muted ft-b">
												<?=$row->Comment?>
											</blockquote>
											<span class="text-muted"><small><?=$dt1->format('d-m-Y h:i:sa')?></small></span>
										</div>										
									</span>
										
								<?PHP
								endforeach;
								?>
								
							</div>
						</div>
					
						<div class="col-xs-12 no-padding" style="margin-top: 2em; margin-bottom: 2em">
							<div class="form-group">
								<div class="col-xs-12 col-sm-8 col-md-6 ">
									<textarea id="reply" class="form-control" rows="4" placeholder="ادخل نص هنا..." style="width: 500px;display: inline-block"
									data-evid="<?=$communication->CommunicationId?>"
									data-count="<?=count($comments)?>"></textarea>
									
									<a href="#" class="btn btn-primary reply" style="margin-left: 10px;margin-bottom: 30px;color:#FFF">اضافة تعليق</a>
								</div>
							</div>
						</div>
						
					</div>
			</div>

			<div class="col-xs-12">
				
			</div>
						
		</div>
        
    </div>
    <?PHP
	//$this->load->view('collections/snippets/add_modal');
    $this->load->view('acp_includes/footer');
    ?>
    <script>
	
    $(function(){
        
        $(document).on('click',"#projects_table tr td .hurkanSwitch", function(){
            ChangeStatusFor($(this), 'portoflio');
        });
        
        $('#projects_table').on('click', function(){
            ChangeOrder('portfolio');
        });
		
		var _url = '<?=base_url('acp/communications/addcommunicationComment')?>';
	
	$("#comments .reply").on("click", function(){
		var data = { 
			CommunicationId : $('#comments #reply').attr('data-evid'),
			comment : $('#comments #reply').val(),
			customer_id : $('#customer_id').val(),
		};
		if(data.comment.length == 0){
			return false;
		}
		$.ajax({
	 		url: _url,
	 		type:"POST",
            dataType:"JSON",
            data: data,
	 		success: function(result){
		 		$('#reply').val('');
		 		$('<span class="sp-message">'+
								'<div>'+
								' <h4> <i class="fa fa-user"></i> <?=$this->session->userdata($this->acp_session->username())?></h4> '+
								'	<blockquote for="title_en" class="text-muted ft-b">'+data.comment+'</blockquote>'+
								'	<span class="text-muted"><small>just now</small></span>'+
								'</div>	'+		
							'</span>').insertAfter('#comments .sp-message:last');

				$('#comments #reply').attr('data-count', (parseInt($('#comments #reply').attr('data-count')) + 1));
		 	},
	 		error:function(err, status, xhr){
		 		console.log(err);
		 		console.log(status);
		 		console.log(xhr);
	 		}
 		});
 		return false;
	});
        
    });
    </script>
    </body>
</html>
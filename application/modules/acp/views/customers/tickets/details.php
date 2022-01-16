
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
	.dataTables_wrapper .row:first-child{
  	  top: -55px;
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
	/* table th, table td{
		text-align: left !important;
	}
	table th{
		float: right;
	}
	table td{
		width: 50% !important;
	    text-align: right !important;
	    float: right !important;
	} */
  .fa-file{
    font-size: x-large;
    padding: 6px;
  }
  .mt-3{
	margin-top: 5px;
  }
  #comments{
	/* margin: 15px; */
  }
  #tickets_table_length{
	margin-top: 15px;
  }
  
  table th:last-child{
	 width: 200px; 
  }
  table td:nth-child(3){
	  display: none;
  }
  .dataTables_length{
	  float: left !important;
  }
  .feedback{
	display: flex;
  }
 .feedback li{
	 list-style: none;
 }
 .feedback ul{
	display: contents;
 }
 .feedback .fa{
	padding: 4px;
    font-size: 20px;
 }
 

    </style>
    <div id="content-main">

        <div class="row">

			<div class="col-md-12">
				<h3>
				<?=getSystemString('my_consulting')?>
                </h3>
					<input type="hidden" name="ticketId" id="ticket_id" value="<?=$ticket->TicketId?>">
					<input type="hidden" name="ticketSenderEmail" id="ticketSenderEmail" value="<?=$customer[0]->Email?>">
					<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					<div class="col-md-6">
						<div class="col-md-7">

							<div style="padding-top: 10px;color:#3498db">
								<h4><?=getSystemString('customer_info')?></h4>
							</div>
							<div>
								<h5><?=getSystemString(81)?> :
									<a href="<?=base_url('acp/customerDetails/').$customer[0]->Customer_ID?>"><?=$customer[0]->Fullname?></a>
								</h5>
							</div>
							<div>
								<h5><?=getSystemString(1)?> : <a href="mailto:<?=$customer[0]->Email?>"><?=$customer[0]->Email?></a></h5>
							</div>
							<div>
								<h5><?=getSystemString(137)?> : <a href="tel:0<?=$ticket->Phone?>">0<?=$ticket->Phone?></a></h5>
							</div>
							<hr>
							<div style="padding-top: 10px;color:#3498db">
								<h4><?=getSystemString(214)?></h4>
							</div>
							<div>
								<h4><?=getSystemString(212)?> : <?=$ticket->TicketId?><br></h4>
							</div>
							<div>
								<h4><?=getSystemString('ticket_type')?> : 
								<?php echo getSystemString($ticket->Cause);?>
								<br></h4>
							</div>
							<hr>
							<div>
								<h4><?=getSystemString(145)?> : <?=$ticket->Title?><br></h4>
							</div>
							<div>
								<h4><?=getSystemString(214)?> : <?=$ticket->Description?><br></h4>
							</div>

							<div>
								<h4><?=getSystemString('attachments')?> :
								<br><br>
								<?php if($ticket->File) {?>
									<a href="<?=base_url('content/tickets/'.$ticket->File)?>" target="_blank">
										<img src="<?=base_url('style/site/assets/images/pdf.svg')?>" width="70px">
									</a>
									<?php } ?>
									<?php if($ticket->File_two) {?>
									<a href="<?=base_url('content/tickets/'.$ticket->File_two)?>" target="_blank">
									<img src="<?=base_url('style/site/assets/images/pdf.svg')?>" width="70px">
									</a>
									<?php } ?>
								</h4>
							</div>
							<div>
								<p><?=getSystemString('created_by_en')?> : <?=$ticket->Timestamp?></p>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-5">
							<h4 style="padding-top: 10px;color:#3498db"><?=getSystemString(33)?></h4>
							<?PHP


							$status_arr = array(
								'New' => 'warning',
								'Pending' => 'primary',
								'Closed' => 'success',
								'In Progress' => 'default',
								'Answered' => 'info',
								'Customer reply' => 'danger'
							);
							$statusesL = array('New', 'Pending', 'In Progress', 'Closed', 'Answered', 'Customer reply');
							$ticket_status = $ticket->Status;
							$label = $status_arr["$ticket_status"];

								foreach($statusesL as $status) {
									?>
									<div classc="col-xs-12 no-padding" style="float:none">
										<div class="radio">
											<label>
												<input type="radio" name="ticketStatus" class="ticketStatus" value="<?=$status?>"
												<?PHP
													if($ticket_status == $status){
														echo 'checked';
													}
												?>>
												<?php if($status == 'New'){echo getSystemString('NEW');} // جديد
													elseif($status == 'Pending'){echo getSystemString('pending_ticket');} // معلق
													elseif($status == 'In Progress'){echo getSystemString('under_review');} // تحت المراجعة
													elseif($status == 'Answered'){echo getSystemString('answered');} // تم الرد
													elseif($status == 'Customer reply'){echo getSystemString('customer_ticket_reply');} // رد العميل
													elseif($status == 'Closed'){echo getSystemString('Closed');} // مغلقة
												?>
											</label>
										</div>
									</div>
									<?PHP
								}
							?>
							<div class="col-md-12">
								<p class="alert alert-success text-center hide text-success" id="success_mail"><?=getSystemString('ticket_status_validation')?></p>
								<p class="alert alert-danger text-center hide text-danger" id="error_mail"><?=getSystemString(119)?></p>
							</div>
						</div>
						<div class="col-md-12">
							<h4 style="padding-top: 10px;color:#3498db"><?=getSystemString('review_stars')?></h4>
							<div class="feedback">
								<ul>
									<?php 
									switch($ticket_review->Rate)
									{
										case 1:
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										break;
										case 2:
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										break;
										case 3:
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										break;
										case 4:
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										break;
										case 5:
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										echo '<li><i class="fa fa-star" style="color:#ffc107"></i></li>';
										break;
										default:
										echo getSystemString("no_ticket_review_yet");
									}
									?>
									
									
									
								</ul>
							</div>
						</div>
					</div>



					</div>
					<div class="col-xs-12">
					<!-- Tab -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#comment" aria-controls="comment" role="tab" data-toggle="tab"><?=getSystemString('comments')?></a></li>
						<li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab"><?=getSystemString('ticket_history')?> <label class="pull-right label label-warning" style="margin: 1px 5px;"> <?=$ticketHistories?> </label></a></li>
					</ul>			
					<!-- ends -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="comment">
							<!-- Note: comment list -->
							<div class="panel white" id="comments">

								<h4><?=getSystemString('admin_response')?></h4>

								<div class="col-xs-12 no-padding message" style="margin-top: 20px;">
									<div class="col-xs-12 col-sm-8 col-md-8 no-padding-left">

										<?PHP
											if(count($comments) == 0):
												echo '<p> '.getSystemString('no_ticket_response').' </p>';
											endif;

											foreach($comments as $row):
										?>

											<span class="sp-message <?=$row->Role?>">
												<div>
													<h4> <i class="fa fa-user"></i> <?=$row->AddedBy?></h4>
													<?PHP
														$dt1 = new DateTime($row->Timestamp);
													?>
													<blockquote for="title_en" class="text-muted ft-b checkComment">
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
											<textarea id="reply" class="form-control" rows="4" placeholder="" style="width: 500px;display: inline-block"
											data-evid="<?=$ticket->TicketId?>"
											data-count="<?=count($comments)?>"></textarea>

											<a href="#" class="btn btn-primary reply" style="margin-left: 10px;margin-bottom: 30px;color:#FFF"><?=getSystemString('add_comment')?></a>
										</div>
									</div>
								</div>

								</div>
							<!-- Ends -->
						</div>
						<div role="tabpanel" class="tab-pane" id="history">
							<!-- Note: history list -->
							<?PHP
								$this->load->view('customers/tickets/filter_tickets');
							?>
							<div class="panel white" style="padding-bottom: 50px;">
								<h4><?=getSystemString('member_tickets')?></h4>
								<table class="table table-hover" id="tickets_table">
								<thead>
									<tr>
									<th>ID</th>
									<th><?=getSystemString(177)?></th>
									<th><?=getSystemString(151)?></th>
									<th><?=getSystemString('Replied By')?></th>
									<th><?=getSystemString(33)?></th>
									<th colspan="2"><?=getSystemString(153)?></th>             
									</tr>
								</thead>
								<tbody>
								</tbody>
								</table>
							</div>
							<!-- Ends -->
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

    $(function()
	{



		var _url = '<?=base_url('acp/customers/addTicketComment')?>';

		$("#comments .reply").on("click", function(){
			var data = {
				ticketId : $('#comments #reply').attr('data-evid'),
				comment : $('#comments #reply').val(),
				customer_id : $('#customer_id').val(),
			};
			if(data.comment.length == 0){
				return false;
			}
			// to refresh page after sending.
			var check = $('.checkComment').is(':empty');
			$.ajax({
				url: _url,
				type:"POST",
				dataType:"JSON",
				data: data,
				success: function(result) {

					if(result.result == 1 && check == false)
					{
						location.reload();
					}

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
	<script>
		/****************************
	     * update ticket status *
	     *******************************/
		$(document).ready(function() {
			$('.ticketStatus').on('change', function(e){
				var ticketId = $('#ticket_id').val();
				var ticketSenderEmail = $('#ticketSenderEmail').val();
				var ticketStatus = $("input:radio[name='ticketStatus']:checked").val();
				//console.log(value);
				if(ticket_id != "")
				{
					$.ajax({
						url: "<?=base_url($__controller.'/updateTicketStatus')?>",
						type: "POST",
						data: {
							ticketId: ticketId,
							ticketStatus: ticketStatus,
							ticketSenderEmail: ticketSenderEmail
						},
						cache: false,
						success: function(result)
						{
							var result = JSON.parse(result);
							if(result.result == 1)
							{
								$("#success_mail").removeClass('hide');
								$("#error_mail").addClass('hide');
							}
							else {
								$("#success_mail").addClass('hide');
								$("#error_mail").removeClass('hide');
							}

						}
					});
				}
			});
		});
	</script>
	<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>
	<script>
      $(function(){

        // datatable initialization
        var dTable = $('#tickets_table').DataTable({
          columnDefs: [
            {
              orderable: false, targets: -1 }
          ],
          select: true,
          order: [[ 0, 'desc' ]],
    	    aoColumnDefs: [{
    	       bSortable: false,
    	       aTargets: [ 6 ]
    	    }],
          pageLength: 15,
          serverSide: true,
          ajax: {
            url: "<?=base_url('acp/datatable/getTicketsDataByID/'.$customer[0]->Customer_ID)?>",
            type: "POST",
            cache: false,
            data: function(d){
			d.id = '<?=$ticket->TicketId?>';
            d.ticket_id = $("#filter_ticket_id").val();
            d.name = $("#filter_name").val();
            d.status = $("#filter_status").val();
            }
          },
          drawCallback: function(settings){
            $('.dataTables_length select, .dataTables_filter input').addClass('form-control');
             $("#filter_ticket").find(".disable-btn").remove();
            $(document).find('[data-toggle="hurkanSwitch"]').each(function(){
              $(this).hurkanSwitch({
                'on':function(r){
                  alert(r);
                },
                'off':function(r){
                  alert(r);
                },
                'onTitle':'<i class="fa fa-check"></i>',
                'offTitle':'<i class="fa fa-times"></i>',
                'width':60
              });
            });
          },
          processing: true,
          filter: true,
          responsive: true,
          autoWidth:false,
          dom: "<'row'<'col-sm-3 text-center'><'col-sm-9'<'toolbar'>l>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          lengthMenu: [
            [ 15, 25, 50, 100, 1000, -1 ],
            [ '15 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'Show all' ]
          ],
          language: {
            url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>',
            sLengthMenu: "_MENU_"
          }
        });

        // filter tickets
        $("#filter_ticket").on("submit", function(){
          $('#tickets_table').DataTable().draw();
          return false;
        });

      });
    </script>
    </body>
</html>

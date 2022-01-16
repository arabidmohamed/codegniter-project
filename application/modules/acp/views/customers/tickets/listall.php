
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
  #tickets_table_length{
      margin-top: 20px;
    }
    #tickets_table{
      margin-top: 2em;
    }
    </style>
    <div id="content-main">

            <div class="row">

                <?PHP
                $this->load->view('acp_includes/response_messages');
                ?>
            <!-- Note: total -->
            <div class="col-md-12">
                      <div class="panel white">
            <div class="container col-md-3 total_num" id="totals">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="text-center"><?PHP
                    echo $stats['New'] + $stats['Pending'] + $stats['Closed'] + $stats['InProgress'] + $stats['Answered'];
                  ?></h3>
                  <h4>_</h4>
                  <p><?=getSystemString('total_consulting')?></p>
                </div>
              </div>
            </div>
            <div class="container col-md-8" id="totals">
              <div class="row">
                <div class="col-md-2">
                  <h3 class="text-center"><?=$stats['New']?></h3>
                  <h4>_</h4>
                  <p><?=getSystemString('NEW')?></p>
                </div>
                <div class="col-md-2">
                  <h3 class="text-center"><?=$stats['Pending']?></h3>
                  <h4>_</h4>
                  <p><?=getSystemString('pending_ticket')?></p>
                </div>
                <div class="col-md-2">
                  <h3 class="text-center"><?=$stats['InProgress']?></h3>
                  <h4>_</h4>
                  <p><?=getSystemString('under_review')?></p>
                </div>
                <div class="col-md-2">
                  <h3 class="text-center"><?=$stats['Answered']?></h3>
                  <h4>_</h4>
                  <p><?=getSystemString('answered')?></p>
                </div>
                <div class="col-md-2">
                  <h3 class="text-center"><?=$stats['CustomerReply']?></h3>
                  <h4>_</h4>
                  <p><?=getSystemString('customer_ticket_reply')?></p>
                </div>
                <div class="col-md-2">
                  <h3 class="text-center"><?=$stats['Closed']?></h3>
                  <h4>_</h4>
                  <p><?=getSystemString('Closed')?></p>
                </div>
              </div>
            </div>
            </div></div>
            <!-- Ends -->
                <div class="col-md-12">
                <?PHP
                  $this->load->view('customers/tickets/filter_tickets');
                ?>
                    <?PHP
                        $section = "SectionName_".$__lang;
                        $return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
                    ?>
                    <h3>



                    </h3>

                    </div>
                </div>
                <div class="col-md-12">
                    <a href="<?=base_url($__controller.'/addNewTicket')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
                        <i class="fa fa-plus"></i> <?=getSystemString(715)?>
                    </a>
                </div>
                     <div class="col-md-12">
                      <div class="panel white" style="padding-bottom: 50px;">
                          <h4><?=getSystemString('member_tickets')?></h4>
                        <table class="table table-hover" id="tickets_table">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th><?=getSystemString(177)?></th>
                              <th><?=getSystemString(81)?></th>
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

                </div>
        </div>
    </div>
    <?PHP
	//$this->load->view('collections/snippets/add_modal');
    $this->load->view('acp_includes/footer');
    ?>

    <script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>

    <script>

    $(function(){

        $(document).on('click',"#projects_table tr td .hurkanSwitch", function(){
            ChangeStatusFor($(this), 'portoflio');
        });

        $('#projects_table').on('click', function(){
            ChangeOrder('portfolio');
        });

    });
    </script>
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
            url: "<?=base_url('acp/datatable/getTicketsData')?>",
            type: "POST",
            cache: false,
            data: function(d){
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

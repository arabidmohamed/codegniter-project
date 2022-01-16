	


	<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">

	<style>

		ul {
		    list-style: circle;
		    padding-left: 20px;
		}

		.editable{
		/*	background-color: #FFF;
			border-style: ridge;*/
			margin-bottom: 15px;
		}

		.panel.white{
			min-height: 150px;
		}
		table th{
			width: 250px;
		}
		.user-rating{
			text-align: center;
			direction: ltr;
			width:135px;
			margin:auto;
		}
		.user-rating .fa{
			font-size: 22px;
			margin: 1px;
		}
		.star-grey{
			color: #e8e8e8;
		}
		.star-colored{
			color:#ffcc00;
		}
		body[dir="rtl"] .user-rating{
			direction: rtl;
		}
		body[dir="ltr"] #customer_table th, body[dir="ltr"] #customer_table td{
			text-align: left;
		}
		body[dir="rtl"] #customer_table th, body[dir="rtl"] #customer_table td{
			text-align: right;
		}
		#diets_table td:not(.dataTables_empty):first-child{
			display: none;
		}
		#diets_table th:last-child{
			width: 200px; 
		}
		.dataTables_wrapper{
		    max-width: 100% !important;
		}
		#diets_table td:nth-child(7){
			display: none;
		}
		div.loading{
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(16, 16, 16, 0.5);
		display: none;
		}

		@-webkit-keyframes uil-ring-anim {
		0% {
			-ms-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-webkit-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-ms-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
		}
		@-webkit-keyframes uil-ring-anim {
		0% {
			-ms-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-webkit-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-ms-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
		}
		@-moz-keyframes uil-ring-anim {
		0% {
			-ms-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-webkit-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-ms-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
		}
		@-ms-keyframes uil-ring-anim {
		0% {
			-ms-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-webkit-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-ms-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
		}
		@-moz-keyframes uil-ring-anim {
		0% {
			-ms-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-webkit-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-ms-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
		}
		@-webkit-keyframes uil-ring-anim {
		0% {
			-ms-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-webkit-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-ms-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
		}
		@-o-keyframes uil-ring-anim {
		0% {
			-ms-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-webkit-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-ms-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
		}
		@keyframes uil-ring-anim {
		0% {
			-ms-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-webkit-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-ms-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
		}
		.uil-ring-css {
			margin: auto;
			position: absolute;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			width: 200px;
			height: 200px;
		}
		.uil-ring-css > div {
			position: absolute;
			display: block;
			width: 160px;
			height: 160px;
			top: 20px;
			left: 20px;
			border-radius: 80px;
			box-shadow: 0 6px 0 0 #ffffff;
			-ms-animation: uil-ring-anim 1s linear infinite;
			-moz-animation: uil-ring-anim 1s linear infinite;
			-webkit-animation: uil-ring-anim 1s linear infinite;
			-o-animation: uil-ring-anim 1s linear infinite;
			animation: uil-ring-anim 1s linear infinite;
		}
		
	
		
		.register_request_details .box{ 
			background: #FFFFFF 0% 0% no-repeat padding-box;
			box-shadow: 0px 3px 6px #00000029; 
			padding: 1.5rem;
			margin-top: 38px;
		}
		.register_request_details .box .title{
			font-size: 25px;
			font-weight: bold;
			text-align: center;
			color: #5A5A5A;
			margin-bottom: 2rem;
		}
		.register_request_details .box .info{
			font-size: 14px;  
			color: #5A5A5A;
			margin-bottom: 1rem;
		}
		.register_request_details .box .form {
		    width: 100%;
		} 
		.register_request_details .box .btn{
			border-radius: 22px;
			min-width: 120px;
		} 
		.register_request_details .box .btn.disabled{
			border-color: #F0F0F0;
			background: #F0F0F0;
			color: #ccc;
		}
		.register_request_details .box .custom-control-label{
			font-size: 14px;
			color: #5A5A5A;
		}
		.register_request_details .chechobx-card{
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		.register_request_details .chechbox-note{
			cursor: pointer;
		}
		.register_request_details .popover-content { 
			color: #AA0707;
		}
		.register_request_details .btn.btn-refused{
			color: #fff;
		}
		.register_request_details .table td,
		.register_request_details .table th { 
			padding: .5rem;
    			vertical-align: middle;
			color: #707070;
			font-size: 13px;
			text-align: right !important;
		}
		[dir="ltr"] .register_request_details .table td,
		[dir="ltr"] .register_request_details .table th { 
			text-align: left !important;
		}
		.register_request_details .table tr:first-child td{ 
			border-top: 0;
		}
		.register_request_details .table td:first-child { 
			width: 150px;
		}
		.register_request_details .table-title{
			color: #5A5A5A;
			font-size: 15px;
			margin-bottom: 1rem;
		}
		.register_request_details .nav{
			padding-right: 2rem !important;
		}
		[dir="ltr"] .register_request_details .nav{
			padding-right: 0 !important;
			padding-left: 2rem !important;
		}
		.register_request_details .nav .nav-link{
			background: #F2F2F2;
			color: #ADADAD;
			font-size: 15px;
			font-weight: bold;
			margin-left: .25rem;
		}
		[dir="ltr"] .register_request_details .nav .nav-link{
			margin-left: 0;
			margin-right: .25rem;
		}
		.register_request_details .nav .active .nav-link{
			background: #fff;
			color: #5A5A5A;
		}
		.register_request_details .tab-content{
			padding: 5% !important;
			background: #FFFFFF;
			box-shadow: 0px 3px 6px #00000029;
		}
		.register_request_details .edit_docs{ 
			border: 1px solid #BFBFBF;
			border-radius: 5px;
			color: #7C7C7C;
			font-size: 12px;
			margin-right: 1rem;
		}
		[dir="ltr"] .register_request_details .edit_docs{  
			margin-right: 0;
			margin-left: 1rem;
		}
		.register_request_details .section-title{
			padding: 2rem 0;
			display: flex;
			align-items: center;
		}
		.register_request_details .section-title .app-number{
			font-size: 16px; 
			color: #707070; 
			margin-left: 3rem;
		} 
		
		[dir="ltr"] .register_request_details .section-title .app-number{
			margin-left: 0;
			margin-right: 3rem;
		}
		.register_request_details .section-title .badge{ 
			padding: .5rem 2rem;
			border-radius: 15px; 
			font-size: 14px; 
		}
		.register_request_details .section-title .badge.badge-info{ 
			background-color: #90D3FF;
			color: #247DC9;
		}

		.register_request_details .text-success{
			color: #3EA200 !important;
		}
		.register_request_details .text-danger{
			color: #A70000 !important;
		}
		.register_request_details .card-table span{
			margin-left: 1rem;
		}
		[dir="ltr"] .register_request_details .card-table span{
			margin-left: 0;
			margin-right: 1rem;
		}
		.register_request_details .card-table{
			margin-bottom: 30px;
			text-align: right;
		}
		[dir="ltr"] .register_request_details .card-table{ 
			text-align: left;
		}
		.register_request_details .mt-4{
			margin-top: 30px;
		}
    
	</style>
	<?PHP
		$title = 'Title_'.$__lang;
		$subcategory = 'SubCategory_'.$__lang;
		$category = 'Category_'.$__lang;
		$desc = 'Description_'.$__lang;
		$cat_nn = 'countryName_'.$__lang;
		$name = 'name_'.$__lang;
	?>



					<div id="reject_domain" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	    <form class="form-horizontal" method="post"  action="<?=  base_url('acp/domains/reject_domain') ?>" data-parsley-validate>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"> <i class="fa fa-plus"></i> <?= getsystemstring('domain_reject') ?></h4>
	      </div>
	      <div class="modal-body" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">
	         <input type="hidden" name="request_id" value="<?= $request_id ?>">
	      	<input type="hidden" name="domain_id" value="<?= $domain->Domain_ID ?>">
	      	<input type="hidden" name="do_id" value="<?= $domain->RegisterOrder->DO_ID ?>">



	      					<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?= getSystemString(33) ?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left display-select2">
								<select class="form-control select2 " 
										name="reject_status" 
										data-placeholder="<?=getSystemString(198)?>" id="rejectType" onchange="rejection_reason()">
										
									<option value="need_modification"> <?= getSystemString('need_modification') ?></option>					
									<option value="reject"><?= getsystemstring('refused') ?></option>
						
								</select>
								
							</div>
							</div>




	           
    <div class="form-group fixed_reasons_input">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('rejection_reseaon') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">


					<div class="editable">
							    <ul id="menu">
							     
							    </ul>
					</div>

			<textarea id="fixed_reasons" name="fixed_reasons" class="hide"></textarea>


		</div>
	</div>



	    <div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getsystemstring('other_reasons').' ar' ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">

			<textarea  data-parsley-required-message="<?=getSystemString(213)?>" id="reply" name="reasons_ar" class="form-control" rows="6" ></textarea>

		</div>
	</div>


	    <div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getsystemstring('other_reasons').' en' ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">

			<textarea  data-parsley-required-message="<?=getSystemString(213)?>" id="reply" name="reasons_en" class="form-control" rows="6" ></textarea>


		</div>
	</div>
				

	        
	      </div>
	      <div class="modal-footer">
		    <input type="submit" class="btn btn-primary" name="submit" value="<?=getSystemString(16)?>">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString(688)?></button>
	      </div>
      
      </form>
    </div>

  </div>
</div>



<div id="edit_domain_name" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	    <form class="form-horizontal" method="post"  action="<?=  base_url('acp/domains/save_domain_name') ?>" data-parsley-validate>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">  <?= getSystemString('edit_domain_name') ?></h4>
	      </div>
	      <div class="modal-body" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">


	      	
	             <input type="hidden" name="domain_id" class="domain_id" value="<?= $domain->Domain_ID  ?>">
				 <input type="hidden" name="request_id" class="request_id" value="<?= $request_id  ?>">

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('domain_name') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 <input  class="form-control" value="<?= $domain->Domain_Name ?>" id="domain_name" type="text" name="domain_name" placeholder="<?=getSystemString('domain_name')?>"  required="">
					</div>
				</div>
		

	      			<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?= getSystemString('TLD') ?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left display-select2">
							                <select class="form-control select"
                              		    id="tld_name"
                                        name="tld_name"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        required
                                        >

                               
                                                        <?PHP                                       
                                      foreach ($tlds as $key => $tld) { ?>

                    <option dir="ltr" <?= ($tld->TLD_Name == $domain->TLD)?'selected':'' ?> value="<?=$tld->TLD_Name?>"><?=$tld->TLD_Name?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>
								
							</div>
					</div>


	           
						<div class="domain_name_res"></div>


				

	        
	      </div>
	      <div class="modal-footer">	   
		    <input type="submit" class="btn btn-primary" name="submit" value="<?=getSystemString(16)?>">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString(688)?></button>
	      </div>
      
      </form>
    </div>

  </div>
</div>


<div id="edit_entity" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	    <form class="form-horizontal" method="post"  action="<?=  base_url('acp/domains/save_registrant') ?>" data-parsley-validate>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">  <?= getSystemString('entity') ?></h4>
	      </div>
	      <div class="modal-body" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">


	      	     <input type="hidden" name="contact_id" class="contact_id" value="<?= $domain->Org_Usr_ID ?>">
	             <input type="hidden" name="domain_id" class="domain_id" value="<?= $domain->Domain_ID  ?>">
				 <input type="hidden" name="request_id" class="request_id" value="<?= $request_id  ?>">
				 <input type="hidden" name="update_epp" class="update_epp" value="FALSE">

	      			<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?= getSystemString('activity_type') ?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left display-select2">
							                <select class="form-control select"
                              		    id="registrant_activity_type"
                                        name="registrant_activity_type"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        required
                                        >

                                        <option value=""></option>
                                                        <?PHP                                       
                                      foreach ($activity_types as $key => $activity_type) { ?>

                    <option <?= ($domain->Org_Activity_ID == $activity_type->id)?'selected':($activity_type->id == 194)?'selected':'' ?> value="<?=$activity_type->id?>"><?=$activity_type->$name?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>
								
							</div>
					</div>


	           
		        <div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('entity_name') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 <input  class="form-control" value="<?= $domain->Full_Name ?>" id="registrant_entity_name" type="text" name="entity_name" placeholder="<?=getSystemString('entity_name')?>"  required="">
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('first_address') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						<input class="form-control" value="<?= $domain->User_Address1 ?>"  type="text" name="registrant_first_address" placeholder="<?=getSystemString('eg_altaawun')?>"
                                      required="">
					</div>
				</div>

					<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?= getSystemString(234) ?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left display-select2">
							                <select class="form-control select"

                                        name="registrant_country"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        required
                                        >

                                        <option value=""></option>
                                                        <?PHP
                                        foreach($countries as $row){
                                            ?>
                    <option <?= ($row->Country_ID == $domain->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?> value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>
								
							</div>
					</div>


				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('region') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control" value="<?= $domain->User_Region ?>"  type="text" name="registrant_region" placeholder="<?=getSystemString('contact_region_placeholder')?>" >
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(202) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control" value="<?= $domain->User_City ?>" type="text" name="registrant_city" placeholder="<?=getSystemString('contact_city_placeholder')?>"
                               required="">
					</div>
				</div>


			 <div class="form-group hide">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('post_code') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control" value="<?= $domain->User_Post_Code ?>" type="text" name="registrant_post_code" placeholder="<?=getSystemString('post_code')?>"
                               >
					</div>
				</div>




			    <div class="form-group hide">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(206) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						     <input class="form-control" value="<?= $domain->User_Phone ?>"  type="text" name="registrant_phone" placeholder="<?=getSystemString(206)?>"
                             >
					</div>
				</div>

				<div class="form-group hide">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(137) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control " value="<?= $domain->User_Mobile ?>"  type="text" name="registrant_mobile" placeholder="<?=getSystemString(137)?>"
                               required="">
					</div>
				</div>

				<div class="form-group hide">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString(1) ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 
						       <input class="form-control" value="<?= $domain->User_Email ?>"  type="text" name="registrant_email" placeholder="<?=getSystemString(1)?>"
                               required="">
					</div>
				</div>



				

	        
	      </div>
	      <div class="modal-footer">
		    <input type="submit" class="btn btn-primary" name="submit" value="<?=getSystemString(16)?>">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString(688)?></button>
	      </div>
      
      </form>
    </div>

  </div>
</div>


<div id="edit_docs" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	    <form class="form-horizontal" method="post"  action="<?=  base_url('acp/domains/save_docs') ?>" data-parsley-validate>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">  <?= getSystemString('documents') ?></h4>
	      </div>
	      <div class="modal-body" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">


	      	     <input type="hidden" name="contact_id" class="contact_id" value="<?= $domain->Org_Usr_ID ?>">
	             <input type="hidden" name="domain_id" class="domain_id" value="<?= $domain->Domain_ID  ?>">
				 <input type="hidden" name="request_id" class="request_id" value="<?= $request_id  ?>">
				 <input type="hidden" name="doc_id" class="doc_id" value="<?= $domain->Docs->support->Domain_Doc_ID  ?>">
				 <input type="hidden" name="update_epp" class="update_epp" value="FALSE">

	      		<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?= getSystemString('doc_type') ?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left display-select2">
							                <select id="document-type"  class="form-control select"
                              		    id="Doc_Type_ID"
                                        name="Doc_Type_ID"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        required
                                        >

                                                        <?PHP     
										$doc_name = 'Doc_Type_'.$__lang;    
                                      foreach ($doc_types as $key => $doc_type) { ?>

                    <option <?= ($domain->Docs->support->Doc_Type_ID == $doc_type->id)?'selected':'' ?> value="<?=$doc_type->id?>"><?=$doc_type->$doc_name?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>
								
							</div>
				</div>

				<div class="form-group issuer_list <?= ($domain->Docs->support->Doc_Type_ID != 77)?'hide':'' ?>">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?= getSystemString('issuer_name') ?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left display-select2">
							                <select class="form-control select"
                              		    id="issures_id"
                                        name="issures_id"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        >

										<option value=""></option>
                                                        <?PHP    
										$issuer_name = 'Issuer_Name_'.$__lang;                                   
                                      foreach ($doc_issures as $key => $doc_issure) { ?>

                    <option <?= ($domain->Docs->support->Doc_Issures_ID == $doc_issure->Doc_Issures_ID)?'selected':'' ?> value="<?=$doc_issure->Doc_Issures_ID?>"><?=$doc_issure->$issuer_name?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>
								
							</div>
				</div>
	           
		        <div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('doc_date') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 <input  class="form-control" value="<?= $domain->Docs->support->Doc_Date ?>" id="registrant_entity_name" type="date" name="Doc_Date" placeholder="<?=getSystemString('entity_name')?>"  required="">
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-3">
						<label for="title"><?= getSystemString('doc_number') ?></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
						 <input  class="form-control" value="<?= $domain->Docs->support->Doc_Num ?>" id="registrant_entity_name" type="text" name="Doc_Num" placeholder="<?=getSystemString('entity_name')?>"  required="">
					</div>
				</div>






				

	        
	      </div>
	      <div class="modal-footer">
		    <input type="submit" class="btn btn-primary" name="submit" value="<?=getSystemString(16)?>">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString(688)?></button>
	      </div>
      
      </form>
    </div>

  </div>
</div>



	<div id="content-main">
		<!--  add by all 2021/05/31  -->
		<div class="row">
			<?PHP
				$this->load->view('acp_includes/response_messages');
			?>
		</div>
		<div class="row register_request_details ">
			<div class="col-lg-12"> 
				<div class="section-title">
					<div class="app-number"><?= getsystemstring(348).' '.str_pad($request_id, 5, '0', STR_PAD_LEFT); ?></div>
					<span class="badge badge-<?= $label ?>"> <?= getSystemString($request_status); ?> </span>

				</div>

			</div>

					


		</div>
        <div class="row register_request_details ">

       <?php 
       	$class = 'col-lg-8';
       if($domain->IS_Domain_Created || $request->DCR_Status == 'refused' || empty($payment_transaction)) $class = 'col-lg-12';?>
			<div class="<?= $class ?>">
				<ul class="nav nav-tabs">
					<li class="nav-item active">
						<a href="#tab-1" data-toggle="tab" class="nav-link">معلومات الطلب</a>
					</li>
					<li class="nav-item">
						<a href="#tab-2" data-toggle="tab" class="nav-link">معلومات جهات الاتصالات</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="tab-1">
						<div class="card-table">
							<h4 class="table-title"><?=getSystemString('domain_information')?></h4>
							<table class="table">


				            <tr>
								<td><?= getSystemString('domain_name') ?></td>
								<td>
									<?PHP
										echo $domain->Domain_Name.$domain->TLD
									?>	

					<?php if($request->DCR_Status == 'approved'){ ?>
						<a   href="<?=base_url('acp/domains/domainDetails/'.$domain->Domain_ID)?>" class="btn edit_docs">
									<i class="fa fa-eye"></i>	    <?= getsystemstring('view_domains') ?>
						</a>
					<?php }else{ ?>

						<a data-toggle="modal" href="#edit_domain_name"  class="btn edit_docs"><i class="fa fa-edit"></i> <?= getSystemString('edit_domain_name') ?> </a>


					<?php } ?>
								</td>
							</tr>

							<tr>
								<td><?=getSystemString(353)?></td>
								<td>
									<?PHP
										echo getSystemString($request_status);

	
									?>	
								</td>
							</tr>

							<?php if($domain->Domain_Status == 'ADMIN DELETE'){ ?>

						    <tr>
								<td>سبب الحذف </td>
								<td>
								 <?= $domain->Admin_Delete_Reason ?>
								</td>
							</tr>


						    <tr>
								<td>تاريخ الحذف </td>
								<td>
								 <?= $domain->Admin_Delete_Date ?>
								</td>
							</tr>

							<tr>
								<td>تم الحذف بواسطة </td>
								<td>
								 <?= $domain->Admin_Delete_User_Name ?>
								</td>
							</tr>


							<?php } ?>

				

						<?php $Server_ips = json_decode($domain->Server_ips); ?>

							<tr>
								<td><?=getSystemString('primary_server')?></td>
								<td>
								 <?= $domain->Primary_Server ?>
								</td>
							</tr>

							<?php if(!empty($Server_ips[0])){ ?>
							<tr>
								<td>Ip</td>
								<td>
								 <?= $Server_ips[0] ?>
								</td>
							</tr>
                             <?php } ?>

							<tr>
								<td><?=getSystemString('secondary_server')?></td>
								<td>

								 <?= $domain->Secondery_Server ?>
								</td>
							</tr>
								<?php if(!empty($Server_ips[1])){ ?>
							<tr>
								<td>Ip</td>
								<td>
								 <?= $Server_ips[1] ?>
								</td>
							</tr>
                             <?php } ?>



                                  <?php 
                                                $secondary_servers = json_decode($domain->Secondary_Servers);
                                               
                                                foreach ($secondary_servers as $key => $server) {                                                                                                   
                                      ?>

				                <tr>
								<td><?=getSystemString('secondary_server')?></td>
								<td>

								  <?= $server->name_server ?>
								</td>
							</tr>
								<?php if(!empty($server->ip)){ ?>
							<tr>
								<td>Ip</td>
								<td>
								 <?= $server->ip ?>
								</td>
							</tr>
                             <?php } 
                         }?>

                        <?php if(!empty($domain->Expire_Date)){ ?>
							<tr>
								<td><?= getSystemString('End Date') ?></td>
								<td>
								 <?= $domain->Expire_Date ?>
								</td>
							</tr>
						<?php  } ?>

						 <?php if(!empty($request->Approved_By_Admin)){ ?>
							<tr>
								<td><?= getSystemString('approved_by') ?></td>
								<td>
								 <?= $request->Approved_By_Admin ?>
								</td>
							</tr>
							<tr>
								<td><?= getSystemString('approve_admin_date') ?></td>
								<td>
								 <?= $request->Approved_At_Admin ?>
								</td>
							</tr>
						<?php  } ?>

						<tr>
								<td><?=getSystemString('relation_between_registrar')?></td>
								<td>
									<?PHP
										echo $domain->Relation_Between
									?>	
								</td>
							</tr>


							</table>
						</div>
						<div class="card-table">
							<h4 class="table-title"><?=getSystemString('entity_information')?>  
							<?php  if($domain->Domain_Status == 'NEW' || $domain->Domain_Status == 'PENDING'){ ?>
								<a data-toggle="modal" href="#edit_entity"  class="btn edit_docs"><i class="fa fa-edit"></i> <?= getSystemString(43) ?> </a>
						   <?php } ?>
							</h4>

							<table class="table">


													<tr>
								<td><?=getSystemString('activity_type')?></td>
								<td>
									 <?= GetConstantById($domain->Org_Activity_ID,$__lang) ?>	
								</td>
							</tr>

								<tr>
								<td><?=getSystemString('entity_name')?></td>
								<td>
									<?PHP
										echo $domain->Full_Name
									?>	
								</td>
							</tr>

							<tr>
								<td><?=getSystemString('first_address')?></td>
								<td>
									<?PHP
										echo $domain->User_Address1
									?>	
								</td>
							</tr>

						<?php if(!empty($domain->User_Address2)){ ?>
							<tr>
								<td><?=getSystemString('second_address')?></td>
								<td>
									<?PHP
										echo $domain->User_Address2
									?>	
								</td>
							</tr>
						<?php } ?>

							<tr>
								<td><?=getSystemString(234)?></td>
								<td>
                                   <?= GetCountryById($domain->User_Country_ID,$__lang) ?>                                                                                                        									
								</td>
							</tr>

	                       <?php if(!empty($domain->User_Region)){ ?>
									<tr>
								<td><?=getSystemString('region')?></td>
								<td>
									<?PHP
										echo $domain->User_Region
									?>	
								</td>
							</tr>
						<?php } ?>

									<tr>
								<td><?=getSystemString(202)?></td>
								<td>
									<?PHP
										echo $domain->User_City
									?>	
								</td>
							</tr>
							<?php if(!empty($domain->Org_PostCode)){ ?>
									<tr>
								<td><?=getSystemString('post_code')?></td>
								<td>
									<?PHP
										echo $domain->User_Post_Code
									?>	
								</td>
							</tr>
						<?php } ?>


							<!-- 	<tr>
									<td>اسم الجهة الكامل</td>
									<td>مؤسسة رقميات نت  <span class="text-success">مؤسسة رقميات نت للتجارة</span> <span class="text-success"><i class="fa fa-check-circle"></i>  فعّال</span> <span class="text-danger"> <i class="fa fa-times-circle" aria-hidden="true"></i> مشطوب </span> </td>
								</tr> -->
				
							</table>
						</div>






	
                        

				<div class="card-table">
					

			<h4><?=getSystemString('documents')?> 
				<?php if ($domain->Docs->support->Doc_Type_ID == 74){ ?>
				 	<button id="checkDocs" data-docNumber="<?=$domain->Docs->support->Doc_Num?>" type="button" class="btn btn-info">Check</button>
				<?php }?>

				<?php  if($domain->Domain_Status == 'NEW' || $domain->Domain_Status == 'PENDING'){ ?>						
							<a data-toggle="modal" href="#edit_docs"  class="btn edit_docs"><i class="fa fa-edit"></i> <?= getSystemString(43) ?> </a>
				<?php } ?>
				</h4>
<?php    if(!empty($domain->Docs->support)){ ?>
							<table class="table">

					<?php if(!empty($domain->Docs->support->Doc_Title)){ ?>

						    <tr>
								<td><?=getSystemString('doc_title')?></td>
								<td>
									<?PHP
										echo $domain->Docs->support->Doc_Title;
									?>	
								</td>
							</tr>
					<?php } ?>

							   <tr>
								<td><?=getSystemString('doc_type')?></td>
								<td>
									   <?=   GetDocTypeById($domain->Docs->support->Doc_Type_ID,$__lang);  ?>
								</td>
							</tr>
							   <tr>
								<td><?=getSystemString('doc_date')?></td>
								<td>
									<?PHP
										echo $domain->Docs->support->Doc_Date;
									?>	
								</td>
							</tr>
					<?php if(!empty($domain->Docs->support->Hijri_Date)){ ?>

							   <tr>
								<td><?=getSystemString('hijri_date')?></td>
								<td>
									<?PHP
										echo $domain->Docs->support->Hijri_Date;
									?>	
								</td>
							</tr>
					<?php } ?>
					<?php if(!empty($domain->Docs->support->Meladi_Date)){ ?>
								   <tr>
								<td><?=getSystemString('gregorian_date')?></td>
								<td>
									<?PHP
										echo $domain->Docs->support->Meladi_Date;
									?>	
								</td>
							</tr>
					<?php } ?>
							   <tr>
								<td><?=getSystemString('doc_number')?></td>
								<td>
									<?PHP
										echo $domain->Docs->support->Doc_Num;
									?>	
									<span id="docStatus" class="label hide"></span>
									<span id="docCheckStatus" class="label hide"></span>
									<span id="docCheckMessage" class="label hide"></span>
								</td>
							</tr>
								<tr>
									<td></td>
									<td>
										<?php 
							if(!empty($domain->Docs->speech)){
							 ?>                
					<p><?= getSystemString('speech_document') ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain->Docs->speech->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 70px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>
                   
                                       <?php }
                                       if (!empty($domain->Docs->additional)) { ?> 
                                                           <p><?= getSystemString('addtional_doc') ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain->Docs->additional->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 70px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>
 
                                       	<?php }
                                       	 if (!empty($domain->Docs->support)) { ?> 
                                                           <p><?= getSystemString('doc_support') ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain->Docs->support->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 70px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>
                                       <?php } ?>
									</td>
								</tr>
							<tr id="docName" class="hide">
								<td><?=getSystemString('entity_name')?></td>
								<td id="docNameVal"></td>
							</tr>
							<tr id="docExpireDate" class="hide">
								<td><?=getSystemString('doc_date')?></td>
								<td id="docExpireDateVal"></td>
							</tr>
							<tr id="docActivities" class="hide">
								<td><?=getSystemString('doc_activities')?></td>
								<td id="docActivitiesVal"></td>
							</tr>

				
							</table>
		<?php } ?>


								 		
						</div>


					</div>








					<div class="tab-pane fade" id="tab-2">
						<div class="card-table mb-4">
							<h4 class="table-title"><?=getSystemString('registrar_information')?></h4>
							<table class="table">
						
							<tr>
								<td><?= getSystemString(81) ?></td>
								<td>
									<span class="text-info"><a href="<?=base_url('acp/customerDetails/'.$domain->Registrar->Customer_ID)?>"><?=$domain->Registrar->Fullname?></a></span>
								</td>
							</tr>

							<tr>
								<td><?=getSystemString(1)?></td>
								<td>
									<?PHP
										echo $domain->Registrar->Email
									?>	
								</td>
							</tr>
							<tr>
								<td><?=getSystemString(206)?></td>
								<td dir="ltr">
									<span class="text-info"><a href="tel:+<?=$domain->Registrar->Phone_Key.$domain->Registrar->Phone?>">+<?=$domain->Registrar->Phone_Key.$domain->Registrar->Phone?></a></span>	
								</td>
							</tr>

							</table>
						</div>




						<div class="card-table mb-4">
							<h4 class="table-title"><?= getsystemstring('admin_officer') ?></h4>
							<table class="table">
						
					<tr>
								<td><?=getSystemString(81)?></td>
								<td>
									<?PHP
										echo $domain->Admin->Full_Name;
									?>	
								</td>
							</tr>

							<?php if(!empty($domain->Admin->User_Job_Title)){ ?>

								<tr>
								<td><?=getSystemString('job_title')?></td>
								<td>
									<?PHP
										echo $domain->Admin->User_Job_Title
									?>	
								</td>
							</tr>
						<?php } ?>

							<tr>
								<td><?=getSystemString('first_address')?></td>
								<td>
									<?PHP
										echo $domain->Admin->User_Address1
									?>	
								</td>
							</tr>

							<?php if(!empty($domain->Admin->User_Address2)){ ?>
							<tr>
								<td><?=getSystemString('second_address')?></td>
								<td>
									<?PHP
										echo $domain->Admin->User_Address2
									?>	
								</td>
							</tr>
						<?php } ?>

						<?php if(!empty($domain->Admin->User_Country_ID)){ ?>
							<tr>
								<td><?=getSystemString(234)?></td>
								<td>
						
									<?= GetCountryById($domain->Admin->User_Country_ID,$__lang) ?> 
								</td>
							</tr>
						<?php } ?>

						<?php if(!empty($domain->Admin->User_Region)){ ?>

									<tr>
								<td><?=getSystemString('region')?></td>
								<td>
									<?PHP
										echo $domain->Admin->User_Region
									?>	
								</td>
							</tr>
						<?php } ?>

						<?php if(!empty($domain->Admin->User_City)){ ?>

									<tr>
								<td><?=getSystemString(202)?></td>
								<td>
									<?PHP
										echo $domain->Admin->User_City
									?>	
								</td>
							</tr>
						<?php } ?>

						<?php if(!empty($domain->Admin->User_Post_Code)){ ?>

									<tr>
								<td><?=getSystemString('post_code')?></td>
								<td>
									<?PHP
										echo $domain->Admin->User_Post_Code
									?>	
								</td>
							</tr>
						<?php } ?>
						<?php if(!empty($domain->Admin->User_Phone)){ ?>

									<tr>
								<td><?=getSystemString(206)?></td>
								<td>
									<?PHP
										echo $domain->Admin->User_Phone
									?>	
								</td>
							</tr>
						<?php } ?>

								<tr>
								<td><?=getSystemString(137)?></td>
								<td dir="ltr">
									<?PHP
										echo '+'.$domain->Admin->Mobile_Key.$domain->Admin->User_Mobile
									?>	
								</td>
							</tr>
							<?php if(!empty($domain->Admin->User_Fax)){ ?>

								<tr>
								<td><?=getSystemString('fax')?></td>
								<td>
									<?PHP
										echo $domain->Admin->User_Fax
									?>	
								</td>
							</tr>
						<?php } ?>
								<tr>
								<td><?=getSystemString(1)?></td>
								<td>
									<?PHP
										echo $domain->Admin->User_Email
									?>	
								</td>
							</tr>
							</table>
						</div>


						<div class="card-table mb-4">
							<h4 class="table-title"><?= getsystemstring('technical_responsible') ?></h4>
				

		<?php if($domain->Admin_ID == $domain->Technical_ID){ ?>
			<p class="text-muted"><?=getSystemString('step1_option1')?></p>
	<?php }elseif(!empty($domain->Technical->Full_Name)){ ?>
			<table class="table">
						<tr>
								<td><?=getSystemString(81)?></td>
								<td>
									<?PHP
										echo $domain->Technical->Full_Name;
									?>	
								</td>
							</tr>

					<?php if(!empty($domain->Technical->User_Job_Title)){ ?>

								<tr>
								<td><?=getSystemString('job_title')?></td>
								<td>
									<?PHP
										echo $domain->Technical->User_Job_Title
									?>	
								</td>
							</tr>
						<?php } ?>

							<tr>
								<td><?=getSystemString('first_address')?></td>
								<td>
									<?PHP
										echo $domain->Technical->User_Address1
									?>	
								</td>
							</tr>
					<?php if(!empty($domain->Technical->User_Address2)){ ?>

							<tr>
								<td><?=getSystemString('second_address')?></td>
								<td>
									<?PHP
										echo $domain->Technical->User_Address2
									?>	
								</td>
							</tr>
					<?php } ?>
							<tr>
								<td><?=getSystemString(234)?></td>
								<td>

									<?= GetCountryById($domain->Technical->User_Country_ID,$__lang) ?> 

								</td>
							</tr>

					<?php if(!empty($domain->Technical->User_Region)){ ?>

									<tr>
								<td><?=getSystemString('region')?></td>
								<td>
									<?PHP
										echo $domain->Technical->User_Region
									?>	
								</td>
							</tr>
						<?php } ?>

									<tr>
								<td><?=getSystemString(202)?></td>
								<td>
									<?PHP
										echo $domain->Technical->User_City
									?>	
								</td>
							</tr>
					<?php if(!empty($domain->Technical->User_Post_Code)){ ?>

									<tr>
								<td><?=getSystemString('post_code')?></td>
								<td>
									<?PHP
										echo $domain->Technical->User_Post_Code
									?>	
								</td>
							</tr>
						<?php } ?>
					<?php if(!empty($domain->Technical->User_Phone)){ ?>

									<tr>
								<td><?=getSystemString(206)?></td>
								<td>
									<?PHP
										echo $domain->Technical->User_Phone
									?>	
								</td>
							</tr>
					<?php } ?>
								<tr>
								<td><?=getSystemString(137)?></td>
								<td dir="ltr">
									<?PHP
										echo '+'.$domain->Technical->Mobile_Key.$domain->Technical->User_Mobile
									?>	
								</td>
							</tr>
					<?php if(!empty($domain->Technical->User_Fax)){ ?>

								<tr>
								<td><?=getSystemString('fax')?></td>
								<td>
									<?PHP
										echo $domain->Technical->User_Fax
									?>	
								</td>
							</tr>
						<?php } ?>
								<tr>
								<td><?=getSystemString(1)?></td>
								<td>
									<?PHP
										echo $domain->Technical->User_Email
									?>	
								</td>
							</tr>
						</table>
	<?php } ?>

							 
						</div>



						<div class="card-table mb-4">
							<h4 class="table-title"><?= getsystemstring('financial_officer') ?></h4>

			<?php if($domain->Admin_ID == $domain->Financial_ID){ ?>

					<p class="text-muted"><?=getSystemString('step1_option1')?></p> 
	<?php }elseif(!empty($domain->Financial->Full_Name)){ ?>
			<table class="table">
						<tr>
								<td><?=getSystemString(81)?></td>
								<td>
									<?PHP
										echo $domain->Financial->Full_Name;
									?>	
								</td>
							</tr>

						  <tr  style="display: none;">
								<td><?=getSystemString('job_title')?></td>
								<td>
									<?PHP
										echo $domain->Financial->User_Job_Title
									?>	
								</td>
							</tr>

							<tr>
								<td><?=getSystemString('first_address')?></td>
								<td>
									<?PHP
										echo $domain->Financial->User_Address1
									?>	
								</td>
							</tr>
							<tr style="display: none;">
								<td><?=getSystemString('second_address')?></td>
								<td>
									<?PHP
										echo $domain->Financial->User_Address2
									?>	
								</td>
							</tr>
							<tr>
								<td><?=getSystemString(234)?></td>
								<td>

									<?= GetCountryById($domain->Financial->User_Country_ID,$__lang) ?> 

								</td>
							</tr>


									<tr  style="display: none;">
								<td><?=getSystemString('region')?></td>
								<td>
									<?PHP
										echo $domain->Financial->User_Region
									?>	
								</td>
							</tr>

									<tr>
								<td><?=getSystemString(202)?></td>
								<td>
									<?PHP
										echo $domain->Financial->User_City
									?>	
								</td>
							</tr>
						<tr  style="display: none;">
								<td><?=getSystemString('post_code')?></td>
								<td>
									<?PHP
										echo $domain->Financial->User_Post_Code
									?>	
								</td>
							</tr>

									<tr>
								<td><?=getSystemString(206)?></td>
								<td>
									<?PHP
										echo $domain->Financial->User_Phone
									?>	
								</td>
							</tr>
								<tr>
								<td><?=getSystemString(137)?></td>
								<td dir="ltr">
									<?PHP
										echo '+'.$domain->Financial->Mobile_Key.$domain->Financial->User_Mobile
									?>	
								</td>
							</tr >
								<tr  style="display: none;">
								<td><?=getSystemString('fax')?></td>
								<td>
									<?PHP
										echo $domain->Financial->User_Fax
									?>	
								</td>
							</tr>
								<tr>
								<td><?=getSystemString(1)?></td>
								<td>
									<?PHP
										echo $domain->Financial->User_Email
									?>	
								</td>
							</tr>
						</table>
	<?php } ?>



						</div>
					</div>
				</div>
			</div>

	<?php if(!$domain->IS_Domain_Created && $request->DCR_Status != 'refused' && !empty($payment_transaction)){  ?>
				<div class="col-lg-4">
				<div class="box">
					<h4 class="title"> <?= getSystemString('requirments') ?></h4>
					<p class="info"><?= getsystemstring('review_domain_requirments') ?> (<?= GetConstantById( $domain->Org_Activity_ID,$__lang) ?>)</p>
					<form action="#!" method="post" class="form needs-validations" novalidate="">

					<?php 
					$request_requirments = explode(',',$request->Request_Requirments);
					if(!empty($requirments)){ 
							foreach ($requirments as $requirment){
								$checked = '';
								if(in_array($requirment->Req_ID, $request_requirments))
									$checked = 'checked';
								
						?>

						<div class="chechobx-card">
							<div class="custom-control custom-checkbox">
							  <input <?= $checked ?> type="checkbox" class="custom-control-input requirments_input" id="customCheck<?= $requirment->Req_ID ?>" value="<?= $requirment->Req_ID ?>">
							  <label  style="display: none;"><?= $requirment->$desc ?></label>
							  <label  style="display: none;"><?= $requirment->Req_ID ?></label>
							  <label class="custom-control-label"  value="<?= $requirment->Req_ID ?>" for="customCheck<?= $requirment->Req_ID ?>"><?= $requirment->$title ?></label>
							 
							 
							</div>
							<?php $direction = 'left'; if($__lang == 'ar'){ $direction = 'right';} ?>
							<div class="chechbox-note" data-container="body" data-toggle="popover" data-placement="<?= $direction ?>" data-content="<?= $requirment->$desc ?>" data-original-title="" title="">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16">
									<path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"></path>
									<path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"></path>
								</svg>
							</div>
						</div>

					<?php }
				} ?>
    
						
						<div class="form-gorup mt-4 text-center">

<?php if(!$domain->IS_Domain_Created ){  ?>

	<?php if($domain->Domain_Status != 'REJECTED' && !empty($domain->RegisterOrder) && $request->DCR_Status != 'need_modification'){ ?>
 	<a style="color: #FFF;" href="<?=base_url('acp/epp/created_domain/'.$domain->Domain_ID.'/'.$request_id)?>" id="create-domain" onclick="return ConfirmDomainCreate()" class="btn btn-success btn-submit disabled" disabled="disabled"> <?= getsystemstring('agree') ?> </a>
		<?php } ?>

<?php if($domain->Domain_Status != 'REJECTED'){ ?>
	<a  style="color: #FFF;" data-toggle="modal" data-target="#reject_domain"  class="btn btn-danger btn-refused">
					     <?= getsystemstring('reject') ?></a>
<?php } ?>


<?php } ?>


						</div>
					</form>
				</div>
			</div>
			<?php } ?>
        </div>
		<br><br>
		<!-- End add -->
		

		
		<div class="row">
						


			<div class="col-xs-12">
				<ul class="nav nav-tabs">

<li ><a data-toggle="tab" href="#domain_logs"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('domain_logs')?></a></li>

<li class="active"><a data-toggle="tab" href="#payment_info"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('payment_info')?></a></li>

<li ><a data-toggle="tab" href="#application_logs"><i class="fa fa-paper-plane-o"></i> <?=getSystemString('application_logs')?></a></li>

		

				

				   

				
				</ul>
				
				<div class="tab-content" style="padding-top: 0px !important">




					<div class="tab-pane fade " id="domain_logs">
						<div class="panel white">
						<table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
								<tbody>

									<thead>
										<tr>
											
											<th>TYPE</th>
											<th>MESSAGE</th>							
											<th>Time</th>
									

								
										</tr>
									</thead>

							<?php if(!empty($domain->NIC)){ ?>
								<?php foreach ($domain->NIC as $row) { ?>
									<tr>
										
										<td ><?=$row->type?></td>																		
										<td ><?= $row->msg  ?></td>
										<td ><?= $row->Created  ?></td>

									</tr>
								<?php } 
						           	}else{ ?>

									<tr>
										<td ><?= getSystemString(46)?></td>
							
									</tr>

									<?php } ?>	




								</tbody>
							</table>
						</div>
					</div>



					<div class="tab-pane fade in active" id="payment_info">
						<div class="panel white">
						<table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
								<tbody>

									<thead>
										<tr>
											<th><?=getSystemString(41)?></th>
											<th><?=getSystemString(177)?></th>
								

											<th><?=getSystemString('order')?></th>	
											<th><?=getSystemString('Platform')?></th>
											<th>نوع البطاقه</th>											
								
											<th><?=getSystemString('payment_status')?></th>
											<th><?=getSystemString('Pricing')?></th>
											<th><?=getSystemString(180)?></th>
								
										</tr>
									</thead>

							<?php if(!empty($domain->Orders)){ ?>
								<?php foreach ($domain->Orders as $row) { ?>
									<tr>
										<td ><?='#'.$row->DO_ID?></td>
										<td ><?=$row->Created_AT?></td>										
										<td ><?=getSystemString($row->Order_Type) ?></td> 
										<td ><?=$row->Payment_Gateway?></td>
										<td ><?=$row->Cart_Type?></td>

										<?php 

	
			$payment_label = ($row->Payment_Verified)?'success':'warning';	

		   if($row->Payment_Verified && !$row->Payment_Refunded){
				$payment_status = 102;
			}elseif($row->Payment_Verified && $row->Payment_Refunded){
				$payment_status = 'refunded';				
			}else{
				$payment_status = 'payment_not_verified';								
			}

			$payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';

										 ?>
										<td ><?=$payment?></td>

										<td ><?=$row->Total_Price?></td>
										<td ><?=$row->User_Email?></td>
									


									</tr>
								<?php } 
						           	}elseif(!empty($domain->Transfer_Orders)){  ?>

							<?php foreach ($domain->Transfer_Orders as $row) { ?>
									<tr>
										<td ><?='#'.$row->DTI__ID?></td>
										<td ><?=$row->DTO_Created?></td>										
										<td ><?=  getSystemString('transfer_in') ?></td> 
										<td ><?=$row->Payment_Gateway?></td>
										<td ><?=$row->Cart_Type?></td>

										<?php 

	       // $payment_status = ($row->Payment_Verified)?102:'payment_not_verified';

	        if($row->Payment_Verified && !$row->Payment_Refunded){
				$payment_status = 102;			
			}elseif($row->Payment_Verified && $row->Payment_Refunded){
				$payment_status = 'refunded';				
			}else{
				$payment_status = 'payment_not_verified';								
			}


			$payment_label = ($row->Payment_Verified)?'success':'warning';	
			$payment = '<span class="label label-'.$payment_label.'">'.getSystemString($payment_status).'</span>';

										 ?>
										<td ><?=$payment?></td>

										<td ><?=$row->Total_Price?></td>
										<td ><?=$row->Email?></td>
									


									</tr>
								<?php } 

									 }else{ ?>	

									<tr>
										<td ><?= getSystemString(46)?></td>
							
									</tr>

									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="tab-pane fade " id="application_logs">
						<div class="panel white">
						<table class="table display"  style="width: 100%; margin-bottom: 30px;text-align: left">
								<tbody>

									<thead>
										<tr>
											
											<th><?=getSystemString(668)?></th>
											<th><?=getSystemString(33)?></th>
											<th><?=getSystemString(180)?></th>


																		
									

								
										</tr>
									</thead>

							<?php if(!empty($app_logs)){ ?>
								<?php foreach ($app_logs as $row) { ?>
									<tr>
										
										<td ><?=$row->DAL_Created?></td>																		
										<td ><?php echo getSystemString($row->DAL_Status);

					if($row->DAL_Status == 'domain_reject'){

									$desc = 'Description_'.$__lang;
									$reject_reasons = '';

									$reasons = explode(',',$row->DAL_Fixed_Reasons);
									if(!empty($reasons[0])){
										foreach ($reasons as $requirment_id){
											$requirment = $this->domains->getRequirmentByID($requirment_id);
											$reject_reasons .= '<li>'.$requirment->$desc.'</li>';
										}
									}

									if($__lang == 'ar'){$reso = $row->DAL_Reason_ar;}else{$reso = $row->DAL_Reason_en;}
									$reject_reasons .= '<li>'.$reso.'</li>';


									echo ' <b>('.$reject_reasons.')</b>';
					}
										  ?>
										  	
										  </td>

								



										  <td ><?= $row->user_full_name ?></td>

									</tr>
								<?php } 
						           	}else{ ?>

									<tr>
										<td ><?= getSystemString(46)?></td>
							
									</tr>

									<?php } ?>	

									
										
							
									


								</tbody>
							</table>
						</div>
					</div>


				</div>
				
			</div>
						
		</div>
		

		<div class="loading">
			<div class='uil-ring-css' style='transform:scale(0.79);'>
				<div></div>
			</div>
    	</div>

</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>

	function ConfirmDomainCreate() {
	var txt;
	var r = confirm("Do you want to create the domain?");
	if (r == true) {
		$(".loading").addClass("show");
	} else {
		return false;
	}
	}


	var _customer_id = '<?=$customer_id?>';


	function print_speech(url)
  {


    var w = 900;
    var h = 600;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    window.open(url,"_blank","resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width="+w+",height="+h+",left="+left+",top="+top);
  }


</script>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>

<script src="<?=base_url($GLOBALS['home_js_dir'].'/utilities/utilities.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/moment.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/bootstrap-datetimepicker.js')?>"></script>
<script>
	var _baseController = '<?=base_url($__controller)?>';
	$(function(){
		$(".input-date").datetimepicker({
			format: 'YYYY-MM-DD',
			minDate: '<?= date("Y-m-d") ?>'
		});
	});
</script>

<script type="text/javascript">
	
	$('.change_start_date').on('click',function(e){
		e.preventDefault();
			$('.cancelForm').removeClass('hide');
	});

		$('.cancel_change').on('click',function(e){
		e.preventDefault();

			$('.cancelForm').addClass('hide');
	});


	$("#document-type").change(function () {
            if (this.value == 77) { //others
                $('.issuer_list').removeClass('hide');
                $('select[name=issures_id]').attr('required', true);
            }
            else  {
                $('.issuer_list').addClass('hide');                
                $('select[name=issures_id]').attr('required', false);

            }
	});




</script>

<script>
	   var preloader = '<p class="domain-not-exists text-center mt-3"><?= getSystemString("preloader") ?></p>';

     $(function () {
	  $('[data-toggle="popover"]').popover();


	  function check_domain(domain_name,tld_name){

                    $('.domain_name_res').html(preloader);

	  				$('#edit_domain_name').find('.btn-primary').css('display','none');
	  				var data = { domain_name : domain_name ,tld_name : tld_name};
					$.ajax({
					 		url: "<?=base_url($__controller.'/domain_check')?>",
					 		type:"POST",
			                dataType:"JSON",
			                data: data,
					 		success: function(data){
	  				$('#edit_domain_name').find('.btn-primary').css('display','unset');

	  				$('.domain_name_res').html(data.msg);	 
	  				if(data.status === true){
	  				     				 	
	  				}else{
	  				    $('#edit_domain_name').find('.btn-primary').css('display','none');
	  				}

	  				
						 	
						 	},
					 		error:function(err, status, xhr){
						 		console.log(err);
						 		console.log(status);
						 		console.log(xhr);
					 		}
					});


	  }
	   $('#domain_name').on('blur', function (e) {
	   		e.preventDefault();

	   		let _domain_name = $('#domain_name').val();
	   		let _tld_name    = $('#tld_name').val();

	   		check_domain(_domain_name,_tld_name);

	  });


	   $('#tld_name').on('change', function (e) {
	   		e.preventDefault();

	   		let _domain_name = $('#domain_name').val();
	   		let _tld_name    = $('#tld_name').val();

	   		check_domain(_domain_name,_tld_name);

	   });


	   	 $('#edit_domain_name').on('shown.bs.modal', function (e) {
		  	e.preventDefault();

	   		let _domain_name = $('#domain_name').val();
	   		let _tld_name    = $('#tld_name').val();

	   		check_domain(_domain_name,_tld_name);
			
		});


	  $('#reject_domain').on('shown.bs.modal', function (e) {
		  		var unchecked_checkbox = [];
		  		var unchecked_checkbox_ids = [];
		      	$('.box').find(':checkbox:not(:checked)').each(function() {
					    unchecked_checkbox.push($(this).next('label').text());
					    unchecked_checkbox_ids.push($(this).next('label').next('label').text());
				});


		      	$(".editable").find("#menu").empty();
				$.each(unchecked_checkbox, function(i){
					$(".editable").find("#menu").append('<li>'+unchecked_checkbox[i]+'</li>');
			    });

               $('#fixed_reasons').val(unchecked_checkbox_ids);
			
		});
	});



     $(document).on('show.bs.popover', function() {
		  $('.popover').not(this).popover('hide');
	});


	$(".box .btn-submit").attr("disabled","disabled").addClass("disabled");
      $('.box .custom-control-input').change(function() {
        if ($('.box [type=checkbox]:checked').length == $('.box [type=checkbox]').length) {
          $(".box .btn-submit").removeAttr("disabled").removeClass("disabled");
          //$(".box .btn-refused").attr("disabled","disabled").addClass("disabled");
        }
        else{
          $(".box .btn-submit").attr("disabled","disabled").addClass("disabled");
          $(".box .btn-refused").removeAttr("disabled").removeClass("disabled");
        }
      });

      $(document).ready(function() {






      	 if ($('.box [type=checkbox]:checked').length == $('.box [type=checkbox]').length) {
          $(".box .btn-submit").removeAttr("disabled").removeClass("disabled");
        }

		  $('.requirments_input').change(function() {
		        if($(this).is(":checked")) {
		            $(this).attr("checked", true);
		        }
		        var idsArr = [];
		      	$('.box').find('input[type=checkbox]:checked').each(function() {
					    idsArr .push(this.value);
				});


					var data = { idsArr : idsArr ,request_id : '<?= $request_id ?>'};
					$.ajax({
					 		url: "<?=base_url($__controller.'/SaveRequestRequirments')?>",
					 		type:"POST",
			                dataType:"JSON",
			                data: data,
					 		success: function(r){
						 		console.log(r);
						 	
						 	},
					 		error:function(err, status, xhr){
						 		console.log(err);
						 		console.log(status);
						 		console.log(xhr);
					 		}
					});
			

		           
		    });
	});


    </script>


<script>
    var _getWathInfo = '<?=base_url($__controller.'/getCompanyInfoWathq')?>';
    $("#educationLevel").val($("#hiddenEduLevel").val());
    $("#jobStatus").val($("#hiddenJobStatus").val());
    $("#CitizenInfo").hide();
    $("#persSub").attr("disabled", true);
    $("#chkInfo").addClass('hide');


    $("#checkDocs").on("click", function(){
        var _val =  $('#checkDocs').attr('data-docNumber'); //getter
		var _type = <?= $domain->Docs->support->Doc_Type_ID ?>;
        $.get(_getWathInfo+"/"+_val+"/"+_type, {}, function(r){
            var res = JSON.parse(r);
            if(res.hasOwnProperty("crName"))
            {
							$("#checkDocs").addClass('hide');
							$("#chkDocInfo").removeClass('hide');
							$("#docCheckStatus").removeClass('hide')
							$("#docCheckStatus").addClass('label-success');
							$("#docCheckStatus").text('Verified');
							$("#docName").removeClass('hide');
							$("#docActivities").removeClass('hide');
							$("#docExpireDate").removeClass('hide');
							$("#docNameVal").text(res.crName);
							$("#docExpireDateVal").text(res.expiryDate);

							var html = '<ul>';
							for (const [key, value] of Object.entries(res.activities.isic)) {
								 html += '<li>'+value.name+'</li>';
							}
							html += '</ul>';
							document.getElementById('docActivitiesVal').innerHTML = html;

							if(res.status.id == 'active'){
								$("#docStatus").removeClass('hide')
								$("#docStatus").addClass('label-success');
								$("#docStatus").text(res.status.name);
							} else {
								$("#docStatus").removeClass('hide')
								$("#docStatus").addClass('label-danger');
								$("#docStatus").text(res.status.name);							
							}
							
            } else {
							$("#checkDocs").removeClass('hide');
							$("#docCheckStatus").removeClass('hide')
							$("#docCheckStatus").addClass('label-danger');
							$("#docCheckStatus").text('Not Verified');
							$("#docCheckMessage").addClass('label-danger');
							$("#docCheckMessage").removeClass('hide')
							$("#docCheckMessage").text(res.message);
							return false;
			}



        });
    });


</script>
<script>
function rejection_reason() {
  var type = document.getElementById("rejectType").value;
  if(type == 'need_modification'){
	$(".fixed_reasons_input").show();
  }
  if(type == 'reject'){
	$(".fixed_reasons_input").hide();
  }
}
</script>
</body>
</html>



















<!--
	Email Template
	By Alaa Krunb
	Copyright https://DNet.sa
-->
<html>
	<head>
		<meta charset="UTF-8"> 
		<style> 
			@font-face {
				font-family: 'DINNextRegular';
				font-style: normal;
				font-weight: normal;
				src: local('DINNextRegular'), url('fonts/DINNextRegular.ttf') format('woff');
			} 
			p{ padding: 0; margin: 0;}
			ul{
				list-style: none; padding: 0; margin: 0;
			}
		</style>
	</head>
	
	<body style="direction: <?php if($app_lang == 'ar') { echo 'rtl';} else { echo 'ltr';}?>; margin: 0; background: #f5f5f5; font-family: 'DINNextRegular'; border-top: 5px solid #2898cd;">
		<!-- main body template msg -->
		<table align="center" width="600" style="margin-top: 50px;">
		<?php if($app_lang == 'ar') { ?>
			<tr>
				<td style="background: #fff; padding: 2rem; border-bottom: 6px solid #eaeaea;">
					<!-- Logo Header -->
					<div style=" width: 150px;">
						<a href="#!">
							<img src="<?= site_url("style/site/assets/images/logo.png") ?>" alt="logo" style="max-width: 100%;">
						</a>
					</div>
					<!-- End Logo Header -->
					
					<h1> <?=$title?></h1> 
					<div style="padding: 1rem 0;">
						<img src="<?= site_url("style/site/assets/images/ticket-new.png") ?>" alt="new-ticket">
					</div>
					<table cellpadding="10" style="padding: 1rem 0;">
						<p>مرحبا <?=$fullname?>,</p><br>
						<p>لديك رد على التذكرة سابقة ولمشاهدة الرد فضلاً اضغط على الزر أدناه</p>
						<br>
						<p>تفاصيل التذكرة:</p>
						<ul>
							<li>رقم التذكرة: #<?=$ticket_id?></li>
							<li>تاريخ إنشاء التذكرة: <?=$ticket_created_at?></li>
						</ul>
					    <tr>
							<td> 
								<a href="<?=base_url('cu/support/ticket_details/'.encryptIt($ticket_id))?>" 
									target="_blank"
									style="background: #05d3d8; color: white; padding: 10px 2em; border-radius: 3px; text-decoration: none;">
									عرض التذكرة
								</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php } else { ?>
			<tr>
				<td style="background: #fff; padding: 2rem; border-bottom: 6px solid #eaeaea;">
					<!-- Logo Header -->
					<div style=" width: 150px;">
						<a href="#!">
							<img src="<?= site_url("style/site/assets/images/logo.png") ?>" alt="logo" style="max-width: 100%;">
						</a>
					</div>
					<!-- End Logo Header -->
					
					<h1><?=$title?></h1> 
					<div style="padding: 1rem 0;">
						<img src="<?= site_url("style/site/assets/images/ticket-new.png") ?>" alt="new-ticket">
					</div>

					<table cellpadding="10" style="padding: 1rem 0;">
						<p>Dear <?=$fullname?>,</p><br>
						<p>
							You have a new reply on your last opened ticket. Please click on the button below to view the details.
						</p>
						<br>
						<p>Ticket details:</p>
						<ul>
							<li>Ticket No.: #<?=$ticket_id?></li>
							<li>Created at: <?=$ticket_created_at?></li>
						</ul>
					    <tr>
							<td> 
								<a href="<?=base_url('cu/support/ticket_details/'.encryptIt($ticket_id))?>" 
									target="_blank"
									style="background: #05d3d8; color: white; padding: 10px 2em; border-radius: 3px; text-decoration: none;">
									View ticket
								</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php } ?>
			<tr>
				<td>
					<div style=" padding: 2.5rem 0;">
				</td>
			</tr>
			<tr>
				<td style="padding-bottom: 2rem;">

					<p style="text-align: center; font-size: 12px; color: #c5c5c5;">copyright <?=date('Y')?> &copy; <a href="https://www.dnet.sa" style="color: #c5c5c5;">DNet.sa</a> all rights reserved</p>
					
					
					<ul style="display: flex; justify-content: center; align-items: center;"> 
						<li style="padding: 0 0.5rem;">
							<a href="tel:<?=$phone?>" target="_blank" style="font-size: 12px; color: #c5c5c5; text-decoration: none;"> <?=$phone?></a>
						</li>
						<li style=" color: #c5c5c5;">
							|
						</li>
						<li style="padding: 0 0.5rem; text-align: center;">
							<a href="mailto:<?=$email?>" target="_blank" style="font-size: 12px; color: #c5c5c5; text-decoration: none;"> <?=$email?></a>
						</li> 
					</ul>


				</td>
			</tr>
		</table>
		<!-- End body template msg -->
	</body>
</html>
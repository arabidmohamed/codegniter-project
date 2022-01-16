



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
	<body style="direction: rtl; margin: 0; background: #f5f5f5; font-family: 'DINNextRegular'; border-top: 5px solid #2898cd;">
		<!-- main body template msg -->
		<table align="center" width="600" style="margin-top: 50px;">
			<tr>
				<td style="background: #fff; padding: 2rem; border-bottom: 6px solid #eaeaea;">
					<!-- Logo Header -->
					<div style=" width: 150px;">
						<a href="#!">
							<img src="<?= base_url("style/site/assets/images/logo.png") ?>" alt="logo" style="max-width: 100%;">
						</a>
					</div>
					<!-- End Logo Header -->
 
					<h1><?=$title?></h1> 

					<p style="text-align: justify;">
					مرحبا <?=$name?>,
					<br>
					لديك رد على التذكرة رقم <?=$ticket_id?>
					</p>
					<a href="<?=site_url('acp/customers/ticketDetails/'.encryptIt($ticket_id))?>" style=" margin: 2rem 0; display: block; background-color: #2898cd; color: #fff; font-weight: bold; font-size: 20px; text-align: center; padding: 1rem; text-decoration: none;"> مشاهدة تفاصيل التذكرة</a>
				</td>
			</tr>
			<tr>
				<td>
					<div style=" padding: 2.5rem 0;">
				</td>
			</tr>
		</table>
		<!-- End body template msg -->
	</body>
</html>




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
 
					<h1><?= getSystemString('visitor_msg') ?></h1> 
					<div style="padding: 1rem 0;">
						<img src="<?= base_url("style/site/assets/images/new-visitor.png") ?>" alt="new-ticket">
					</div>

					<table cellpadding="10" style="padding: 1rem 0;">
					    <tr>
							<td style="text-align: left;"><b></b></td>
							<td> <a href="<?=$_SERVER['HTTP_HOST']?>" target="_blank">(<?=$_SERVER['HTTP_HOST']?>)</a></td>
						</tr>
						
					    <tr>
							<td style="text-align: left;"><b><?= getSystemString(81) ?></b></td>
							<td>{name}</td>
						</tr>
						<tr>
							<td style="text-align: left;"><b><?= getSystemString(1) ?></b></td>
							<td>{email}</td>
						</tr>

						<tr>
							<td style="text-align: left;"><b><?= getSystemString(216) ?></b></td>
							<td>{phone}</td>
						</tr>

					</table>
					<h2><?= getSystemString(731) ?></h2>
					<p style="text-align: justify;">{message}</p>
					<!-- <a href="#!" style=" margin: 2rem 0; display: block; background-color: #2898cd; color: #fff; font-weight: bold; font-size: 20px; text-align: center; padding: 1rem; text-decoration: none;"> مشاهدة تفاصيل التذكرة</a> -->
				</td>
			</tr>
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
							<a href="tel:<?= $website_data['web_settings'][0]->Website_Email ?>" target="_blank" style="font-size: 12px; color: #c5c5c5; text-decoration: none;"> <?= $website_data['web_settings'][0]->Website_MobileNo ?>+</a>
						</li>
						<li style=" color: #c5c5c5;">
							|
						</li>
						<li style="padding: 0 0.5rem; text-align: center;">
							<a href="mailto:<?= $website_data['web_settings'][0]->Website_Email ?>" target="_blank" style="font-size: 12px; color: #c5c5c5; text-decoration: none;"> <?= $website_data['web_settings'][0]->Website_Email ?></a>
						</li> 
					</ul>


				</td>
			</tr>
		</table>
		<!-- End body template msg -->
	</body>
</html>

<?php  

		$__lang = $this->session->userdata($this->site_session->__lang_h());
		$prefix = 'Prefix_'.$__lang;
 ?>
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
							<img src="<?=base_url('style/site/assets/')?>images/dnet-icon.svg" alt="logo" style="max-width: 100%;">
						</a>
					</div>
					<!-- End Logo Header -->
 
					
					<div style="padding: 1rem 0;">
						<img src="<?= base_url("style/site/assets/images/invoice.png") ?>" alt="invoice">
					</div>
					<h5><?=getSystemString(348)?> : #<?=$dw_id?></h5>
					<h5><?=getSystemString('domain_name')?> : <?=  $domain->Domain_Name.$domain->TLD ?></h5>
			

					<p><?= $msg ?></p>

	
				</td>
			</tr>

			<tr>
				<td style="padding-bottom: 2rem;">
				<!-- Link -->
					<ul style="padding-bottom: 0.5rem; display: flex; justify-content: center; align-items: center; border-bottom: 1px solid #e9e9e9">
						<li style="padding: 0.5rem;">
							<a href="<?php echo site_url('');?>" target="_blank" style="color: #c5c5c5; text-decoration: none; font-size: 12px;"> <?=getSystemString(218)?></a>
						</li>

							<li style="padding: 0.5rem 0rem; color: #c5c5c5;">
							|
						</li>
						<li style="padding: 0.5rem;">
							<a href="<?=base_url('Page/'.$website_data['about_us']->Prefix_ar)?>" target="_blank" style="color: #c5c5c5; text-decoration: none; font-size: 12px;"> <?=getSystemString("about_us")?></a>
						</li>
				
						<li style="padding: 0.5rem; color: #c5c5c5;">
							|
						</li>
						<li style="padding: 0.5rem;">
							<a href="<?=base_url('contactus')?>" target="_blank" style="color: #c5c5c5; text-decoration: none; font-size: 12px;"> <?=getSystemString(108)?></a>
						</li>
					</ul>

					<!-- Social Media -->
					<ul style="display: flex; justify-content: center; align-items: center;">
						<li style="padding: 0.5rem;">
							<a href="<?= $web_contact_info[0]->Facebook ?>" target="_blank" style="color: #c5c5c5; text-decoration: none;"> <img src="<?= base_url("style/site/assets/images/facebook.png") ?>" width="16" alt="new-ticket"></a>
						</li> 
						<li style="padding: 0.5rem;">
							<a href="<?= $web_contact_info[0]->Twitter ?>" target="_blank" style="color: #c5c5c5; text-decoration: none;"> <img src="<?= base_url("style/site/assets/images/twitter.png") ?>" width="16" alt="new-ticket"></a>
						</li>
						<li style="padding: 0.5rem;">
							<a href="<?= $web_contact_info[0]->Instagram ?>" target="_blank" style="color: #c5c5c5; text-decoration: none;"> <img src="<?= base_url("style/site/assets/images/instagram.png") ?>" width="16" alt="new-ticket"></a>
						</li>
					</ul>

					<!-- Copyight-->
					<p style="text-align: center; font-size: 12px; color: #c5c5c5;">copyright <?=date('Y')?> &copy; <a href="https://DNet.sa" style="color: #c5c5c5;">DNet.sa</a> all rights reserved</p>
					
					
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

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
							<img src="<?= base_url("style/site/assets/img/logo.png") ?>" alt="logo" style="max-width: 100%;">
						</a>
					</div>
					<!-- End Logo Header -->
 
					<h1>تفاصيل الطلب</h1> 
					<div style="padding: 1rem 0;">
						<img src="<?= base_url("style/site/assets/img/invoice.png") ?>" alt="invoice">
					</div>
					<h5>رقم الطلب : #<?=  $order->Order_ID ?></h5>
					<h5>تاريخ الفاتورة : <?=  $order->Created_At ?></h5>
					<p>تم تنفيذ طلبك بنجاح</p>

					<table cellpadding="10" style="padding: 1rem 0;" width="100%">
						<tr>
							<th style="color: #2898cd; text-align: right;"> اسم المنتج</th>
							<th style="color: #2898cd; text-align: center;">الكمية</th>
							<th style="color: #2898cd; text-align: center;">السعر</th>
							<th style="color: #2898cd; text-align: center;">الاجمالي</th>
						</tr>

				<?php foreach($order->OrderDetails as $od){ ?>
						<tr> 
							<td> <?= $od->Title_ar ?></td>
							<td style="text-align: center;"> <?= $od->Quantity ?></td>
							<td style="text-align: center;"> <?= $od->Price.' '.getSystemString(480) ?></td>
							<td style="text-align: center;"> <?= ($od->Price * $od->Quantity).' '.getSystemString(480) ?></td>
						</tr>
				<?php } ?>

				<?php  $deliveryPrice = $order->DeliveryPrice; ?>

						<tr> 
							<td colspan="2" style="text-align: left; color: #2898cd"> <?= getSystemString(357) ?></td> 
							<td style="text-align: center;"> <?= ($order->OrderTotal_Price - $order->VAT_TAX - $deliveryPrice).' '.getSystemString(480) ?></td>
						</tr>
						<tr> 
							<td colspan="2" style="text-align: left; color: #2898cd"> <?= getSystemString('VAT TAX') ?></td> 
							<td style="text-align: center;"> <?= $order->VAT_TAX.' '.getSystemString(480) ?></td>
						</tr>
						<tr> 
							<td colspan="2" style="text-align: left; color: #2898cd"> <?= getSystemString('Delivery Price') ?></td> 
							<td style="text-align: center;"> <?= $deliveryPrice.' '.getSystemString(480) ?></td>
						</tr>
						<tr> 
							<td colspan="2" style="text-align: left; color: #2898cd; font-weight: bold;"> <?= getSystemString(355) ?></td> 
							<td style="text-align: center;"> <?= $order->OrderTotal_Price.' '.getSystemString(480) ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<!-- <tr>
				<td>
					<div style=" padding: 1.5rem 0; text-align: center;">
						<h1>قيّم المنتج والطلب</h1>
						<p style="color: #656565">يهمنا رأيك في الطلب ، فقط إضغط على رابط التقييم</p>
						<a href="#!" style=" margin: 2rem 0; display: inline-block; background-color: #fff; color: #b3b3b3; font-size: 16px; text-align: center; padding: 1rem 5rem; text-decoration: none;"> تقييم المنتج</a>
					</div>
				</td>
			</tr> -->
			<tr>
				<td style="padding-bottom: 2rem;">
					<!-- Link -->
			<!-- 		<ul style="padding-bottom: 0.5rem; display: flex; justify-content: center; align-items: center; border-bottom: 1px solid #e9e9e9">
						<li style="padding: 0.5rem;">
							<a href="#!" target="_blank" style="color: #c5c5c5; text-decoration: none; font-size: 12px;"> الرئيسية</a>
						</li>
						<li style="padding: 0.5rem 0rem; color: #c5c5c5;">
							|
						</li>
						<li style="padding: 0.5rem;">
							<a href="#!" target="_blank" style="color: #c5c5c5; text-decoration: none; font-size: 12px;"> من نحن</a>
						</li>
						<li style="padding: 0.5rem; color: #c5c5c5;">
							|
						</li>
						<li style="padding: 0.5rem;">
							<a href="#!" target="_blank" style="color: #c5c5c5; text-decoration: none; font-size: 12px;"> خدماتنا</a>
						</li>
						<li style="padding: 0.5rem; color: #c5c5c5;">
							|
						</li>
						<li style="padding: 0.5rem;">
							<a href="#!" target="_blank" style="color: #c5c5c5; text-decoration: none; font-size: 12px;"> إتصل بنـا</a>
						</li>
					</ul> -->

					<!-- Social Media
					<ul style="display: flex; justify-content: center; align-items: center;">
						<li style="padding: 0.5rem;">
							<a href="#!" target="_blank" style="color: #c5c5c5; text-decoration: none;"> <img src="img/facebook.png" width="16" alt="new-ticket"></a>
						</li> 
						<li style="padding: 0.5rem;">
							<a href="#!" target="_blank" style="color: #c5c5c5; text-decoration: none;"> <img src="img/twitter.png" width="16" alt="new-ticket"></a>
						</li>
						<li style="padding: 0.5rem;">
							<a href="#!" target="_blank" style="color: #c5c5c5; text-decoration: none;"> <img src="img/instagram.png" width="16" alt="new-ticket"></a>
						</li>
					</ul> -->

					<!-- Copyight-->
					<p style="text-align: center; font-size: 12px; color: #c5c5c5;">copyright 2020 &copy; <a href="https://DNet.sa" style="color: #c5c5c5;">DNet.sa</a> all rights reserved</p>
					
					
					<ul style="display: flex; justify-content: center; align-items: center;"> 
						<li style="padding: 0 0.5rem;">
							<a href="tel:00966503333644" target="_blank" style="font-size: 12px; color: #c5c5c5; text-decoration: none;"> 966503333644+</a>
						</li>
						<li style=" color: #c5c5c5;">
							|
						</li>
						<li style="padding: 0 0.5rem; text-align: center;">
							<a href="mailto:info@dnet.sa" target="_blank" style="font-size: 12px; color: #c5c5c5; text-decoration: none;"> info@DNet.sa</a>
						</li> 
					</ul>
				</td>
			</tr>
		</table>
		<!-- End body template msg -->
	</body>
</html>
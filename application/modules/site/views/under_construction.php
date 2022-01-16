
<html>
	<?PHP
		$__lang = $this->session->userdata($this->site_session->__lang_h());
		$title = 'Website_Title_'.$__lang;
	?>
	<title><?=$web_settings[0]->$title?></title>
	<head>
		<meta charset="utf-8" content="Template">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			body{
				margin-top: 5%;
			}
			.logo{
				width: 100%;
				text-align: center;
				margin: auto;
			}
			.social-media {
				text-align: center;
				padding: 15px;
				margin-top: 15%;
			}
			.social-media a{
			    display: inline-block;
				margin: 3px;
			}
			.fa{
				font-size: xx-large;
				color: #b2b9bb;
			}
			.fa:hover{
				color:#5e6162;
			}
			.email p{
				text-align: center;
				color: #b2b9bb;
			}
			.email p:hover,p{
				color: #5e6162;
			}
			@media only screen and (max-width: 700px)
			{
				.logo-size{
					width: 100%;
				}
			}
		</style>	
	</head>
	<body>
		<div class="logo">
			<img src="<?=base_url('style/site/img/logo-lg.png')?>" class="logo-size">
		</div>
		<div class="social-media">
			
			<?PHP 
if(strlen($web_contact_info[0]->Facebook) > 0){
echo '<a href="'.$web_contact_info[0]->Facebook.'" class="social-link" target="_blank"><i class="fa fa-facebook-square"></i></a>';
}
if(strlen($web_contact_info[0]->Twitter) > 0){
echo '<a href="'.$web_contact_info[0]->Twitter.'" class="social-link" target="_blank"><i class="fa fa-twitter-square"></i></a>';
}
if(strlen($web_contact_info[0]->Instagram) > 0){
echo '<a href="'.$web_contact_info[0]->Instagram.'" class="social-link" target="_blank"><i class="fa fa-instagram"></i></a>';
}
if(strlen($web_contact_info[0]->Youtube) > 0){
echo '<a href="'.$web_contact_info[0]->Youtube.'" class="social-link" target="_blank"><i class="fa fa-youtube-square"></i></a>';
}
if(strlen($web_contact_info[0]->Snapchat) > 0){
echo '<a href="'.$web_contact_info[0]->Snapchat.'" class="social-link" target="_blank"><i class="fa fa-snapchat-square"></i></a>';
}
if(strlen($web_contact_info[0]->LinkedIn) > 0){
echo '<a href="'.$web_contact_info[0]->LinkedIn.'" class="social-link" target="_blank"><i class="fa fa-linkedin-square"></i></a>';
}
if(strlen($web_contact_info[0]->GooglePlus) > 0){
		                   echo '<a href="'.$web_contact_info[0]->GooglePlus.'" class="social-link" target="_blank"><i class="fa fa-google-plus-square"></i></a>';
		                   }
?>
			
		</div>
		<div class="email">
			<p><?=$web_settings[0]->Website_Email?></p>
		</div>
	</body>
</html>



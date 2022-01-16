

<?PHP
$__lang = $this->session->userdata($this->site_session->__lang_h());
$c_name = 'Category_'.$__lang;
$sc_name = 'SubCategory_'.$__lang;
$sectionName = 'SectionName_'.$__lang;
$name = 'Name_'.$__lang;
$page_title = 'Page_title_'.$__lang;
$Prefix = 'Prefix_'.$__lang;

?>
<style type="text/css">
    .hide{
        display: none;
    }
</style>
<body class="inner-page domains-page" dir="<?PHP if($__lang == 'en') { echo 'ltr'; } else { echo 'rtl'; } ?>">

 <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PFV54Z5" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
 <!-- End Google Tag Manager (noscript) -->

  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <div class="navbar-box">
        <a href="<?=base_url()?>" class="d-block">
          <div class="logo">
            <img src="<?=base_url('style/site/dnet/assets/img/Logo.svg')?>" class="img-fluid" alt="logo">
          </div>
        </a>
        <div class="main-navbar">
          <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav">
              <div class="d-inline d-lg-none">
                <a data-toggle="collapse" href="#nav" class="close-nav">
                  <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x" fill="#1C1A1A" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                    <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                  </svg>
                </a>
              </div>
              <li class="nav-item">
                <a class="nav-link actives" href="<?=base_url('')?>"><?=getSystemString(218)?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url('domains')?>"><?=getSystemString('domains')?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link solution" href="<?=base_url('solutions')?>"><?=getSystemString('solutions')?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url('portfolios')?>"><?=getSystemString('client_portfolios')?></a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="<?=base_url('contactus')?>"><?=getSystemString(108)?></a>
              </li> 
                  <li class="nav-item dropdown">
              <?php  if (!$this->session->userdata($this->site_session->userid())) { ?>
                <a class="nav-link btn-login" href="<?=base_url('login')?>"><strong><?=getSystemString('login_register')?></strong></a>
              <?php } else { ?>
                        <a href="#!" class="nav-link user-box dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 
                            <div class="pic d-lg-inline-block d-none d- mr-3">
                                <img src="<?=base_url('style/site/assets/')?>images/user.svg" alt="user">
                            </div> 
                            <div class="name d-nonex d-lg-inline-block">
                                <p class="mb-0"><?=getSystemString('account')?></p>
                            </div>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-user">  
                            <li class="nav-item">
                                <a href="<?=base_url('profile')?>" >
                                <svg xmlns="http://www.w3.org/2000/svg"  class="mr-2" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" viewBox="0 0 112 191"><defs><style>.a,.c{fill:#82858e;}.b{clip-path:url(#a);}.c{fill-rule:evenodd;}</style><clipPath id="a"><rect class="a" width="112" height="191" transform="translate(3563.361 -9337.103)"/></clipPath></defs><g class="b" transform="translate(-3563.361 9337.103)"><path class="c" d="M214.5,218.647a49.652,49.652,0,1,0-66.4-.407c.519-.247,1.072-.475,1.658-.689,6.837-2.463,14.634-3.559,19.7-6.366a4.535,4.535,0,0,0,.674-7.448c-4.189-3.5-6.5-9.043-7.739-14.687-2.163-1.615-6.977-11.307-2.662-13.125-.96-3.37-3.22-14.74,6.885-22.964,11.356-9.247,28.588,2.837,33.064-5.833a.644.644,0,0,1,1.12-.063,14.084,14.084,0,0,1,.538,14.357c.7,3.021,1.716,8.956.558,14.4,5.654,1.542-.145,11.671-2.487,13.252-1.236,5.634-3.544,11.176-7.729,14.667a4.535,4.535,0,0,0,.669,7.448c5.067,2.807,12.863,3.9,19.7,6.366a18.033,18.033,0,0,1,2.458,1.1Zm-32.976,18.736a55.858,55.858,0,1,1,55.858-55.858A55.859,55.859,0,0,1,181.525,237.383Z" transform="translate(3437.613 -9422.983)"/></g></svg>
                                    <span> <?=getSystemString('account')?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=base_url('dashboard')?>" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" viewBox="0 0 27.569 21.482" class="mr-2">
                                        <path id="np_dashboard_2268141_0FC1E7" d="M32.785,25.844A13.77,13.77,0,0,0,21.362,47.326l1.39-1.1a11.989,11.989,0,0,1-1.945-5.711h3.53V38.739h-3.53a11.935,11.935,0,0,1,2.89-6.948l2.487,2.487,1.251-1.265-2.487-2.487A11.947,11.947,0,0,1,31.9,27.65V31.18h1.779V27.65a11.947,11.947,0,0,1,6.948,2.876l-2.487,2.487,1.251,1.265,2.487-2.487a11.934,11.934,0,0,1,2.89,6.948H41.233v1.779h3.529a11.989,11.989,0,0,1-1.945,5.711l1.39,1.1A13.77,13.77,0,0,0,32.785,25.844ZM40.65,36.21,31.214,42.5a2.221,2.221,0,0,0,3.14,3.14Z" transform="translate(-19 -25.844)"></path>
                                    </svg>
                                    <span> <?=getSystemString(90)?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=base_url('/logout')?>" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" class="mr-2" viewBox="0 0 112 94.044"><defs><style>.a{fill:#82858e;fill-rule:evenodd;}</style></defs><path class="a" d="M49.478,102.523a5.984,5.984,0,0,1,8.463-8.463,35.055,35.055,0,1,0,0-49.575,5.984,5.984,0,1,1-8.463-8.463,47.024,47.024,0,1,1,0,66.5ZM98.726,72.766l-17.5,17.146c-4.836,4.823-12.1-2.411-7.261-7.234l5.911-5.871c1.343-1.336.9-2.418-.989-2.418H22.874a5.117,5.117,0,1,1,0-10.233H78.889c1.89,0,2.331-1.082.989-2.418l-5.911-5.871c-4.836-4.823,2.425-12.057,7.261-7.234L98.7,65.6a4.972,4.972,0,0,1,.027,7.167Z" transform="translate(-17.751 -22.251)"/></svg>                                    <span><?=getSystemString(89)?></span>
                                </a>
                            </li>
                        </ul> 
                    </li> 
              <?php } ?>

              <li class="nav-item ">
                <?PHP
               if($website_lang){
                   $query_strings = $_SERVER['QUERY_STRING'];
                   $query_strings = strlen($query_strings) > 0 ? '?'.$query_strings : '';
                   $____lng = $__lang == 'en' ? 'ar' : 'en';

                   $redirectUri = explode("/", $_SERVER['REQUEST_URI']);
                   $redirectUri = implode("__", $redirectUri);
                   ?>
                <a class="nav-link lang" href="<?=base_url('changeLanguage/'.$____lng.'/'.$redirectUri.$query_strings)?>"><?=getSystemString(247)?></a>
                    <?PHP
                }
                ?>
              </li>
            </ul>
          </div>
        </div>
        <div class="d-lg-none d-block btn-collapse" data-toggle="collapse" data-target="#nav">
          <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-list" fill="#fff" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
          </svg>
        </div>
      </div>
    </div>
  </nav>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$name = 'Name_'.$__lang;
?>
<!DOCTYPE html>
<html lang="<?=$__lang?>" dir="<?PHP if($__lang == 'ar'){ echo 'rtl'; } else { echo 'ltr'; }?>">
<head>
    <title><?=getSystemString(690)?> | Admin</title>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, follow" />
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
    <meta http-equiv="content-language" content="en-us" />
    <meta http-equiv="content-language" content="ar-sa" />
    <link rel="alternate" href="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" hreflang="en-us" />
    <link rel="alternate" href="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" hreflang="ar-sa" />
    <link rel="shortcut icon" href="" />
    <link rel="icon" href="<?=base_url('style/site/assets/img/logo.svg');?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/framework-all.css')?>" />
    <link rel="stylesheet" href="<?= base_url('style/acp/css/device.css')?>">
    <?PHP
    if($__lang == 'ar') {
        ?>
        <link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/framework-rtl.css')?>" />
        <!-- Added by Yasir on 22 Oct 2019 -->
        <style>
            .sortable-tb tr td .drag-handle {
                margin-top: -1.4em !important;
            }

            .sidebar-content li ul li a {
                padding-right: 55px !important;
            }
        </style>
        <?PHP
    }
    ?>
    <link href="<?=base_url($GLOBALS['acp_css_dir'].'/dropzone.css')?>" rel="stylesheet" />
    <link href="<?=base_url($GLOBALS['acp_css_dir'].'/custom_css/style.css')?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?=base_url($GLOBALS['acp_css_dir'].'/croppie.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/custom_css/d-custom.css?v=1.2')?>" />
       <link rel="stylesheet" href="<?=base_url('style/site/intlTelInput/intlTelInput.min.css')?>" />
    <style>
        .no-padding{
            padding: 0px !important;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body class="" dir="<?PHP if($__lang == 'ar'){ echo 'rtl'; } else { echo 'ltr'; }?>">

<div class="navbar">
    <a class="sidebar-toggle"></a>
    <a href="<?=base_url('acp/')?>">
        <img style="height: 30px;" src="<?=base_url('style/site/assets/')?>images/dnet-icon.svg" alt="" class="fr-logo">
    </a>



    <div class="navbar-options">
        <ul>
            <!--
                        <li>
                            <a id="btn-fullscreen" href="#"><i class="fa fa-arrows-alt"></i></a>
                        </li>
            -->
            <li>
                <a>
                    <img class="avatar" src="<?=base_url($GLOBALS['img_users_dir'].$this->session->userdata($this->acp_session->picture()))?>" onerror="this.src='<?=base_url($GLOBALS['acp_img_dir'].'/avatar1.png')?>'">
                    <span><?=$this->session->userdata($this->acp_session->username())?></span>
                </a>
                <ul>
                    <?PHP

                    if($this->session->userdata($this->acp_session->role()) != 'super_admin') {
                        ?>
                        <li><a href="<?=base_url('acp/profile')?>" class="unset"><i class="fa fa-user"></i> <?=getSystemString(88)?></a></li>
                        <?PHP
                    }
                    ?>
                    <li><a href="<?=base_url('acp/logout')?>" class="unset"><i class="fa fa-sign-out"></i> <?=getSystemString(89)?></a></li>
                </ul>
            </li>
            <li>
                <a href="<?=base_url('')?>" target="_blank" class="unset" style="font-size: 15px;"><i class="fa fa-external-link"></i></a>

            </li>
            <li>
                <a data-toggle="tooltip1" title="<?=getSystemString("tickets")?>" href="<?=base_url('acp/helpAndSupport')?>">
                    <i class="fa fa-life-ring"></i>
                </a>
            </li>
            <li>
                <a class="unset" href="<?=base_url('acp/settings')?>"><i class="fa fa-cog"></i></a>
            </li>
            <?PHP
            if($this->session->userdata($this->acp_session->role()) == 'super_admin' || $this->session->userdata($this->acp_session->role()) == 'admin') {
                ?>
                <li>
                    <a class="unset" href="<?=base_url('acp/manageUsers')?>"><i class="fa fa-users"></i></a>
                </li>
                <?PHP
            }
            if($website_lang) {
                ?>
                <li>
                    <?PHP $____lng = $__lang == 'en' ? 'ar' : 'en'; ?>
                    <a class="unset" href="<?=base_url('acp/changeLanguage/'.$____lng)?>"><?=getSystemString(12)?></a></li>
                <?PHP
            }
            ?>
        </ul>
    </div>
</div>

<div class="content-container">
    <div class="sidebar">
        <div class="sidebar-top">
        </div>
        <div class="sidebar-content">
            <ul class="menu-track">
                <?PHP
                //dd($sidebarMenu);
                foreach($sidebarMenu as $menu):
                    $anchorHref = '';
                    if($menu->Link != '#')
                    {
                        $menu_link = base_url($menu->Link);

                        // $_link = explode('/', $menu->Link);
                        // unset($_link[0]);
                        // $_lnk = implode('/',$_link);
                        //$menu_link = base_url($__controller.'/'.$_lnk);
                        $anchorHref = 'href="'.$menu_link.'"';
                    }
                    ?>
                    <?php if ($menu->Is_SideBar_Menu == 1 && $menu->Parent_ID == 0):?>
                    
                    <li>

                        <a <?=$anchorHref?>>
                            <i class="fa fa-<?=$menu->Icon?>"></i>
                            <?PHP
                            if(strlen($menu->Menu_String_Key) > 0):
                                ?>
                                <span><?=$menu->$name?></span>
                                <?php 
                                    if($menu->Id == 285)
                                    {
                                        if($number > 0){
                                            echo '<label class="pull-right label label-warning">'.$number.'</label>';
                                        }                                  
                                    }
                                    if($menu->Id == 265)
                                    {
                                        if($tickets > 0){
                                            echo '<label class="pull-right label label-warning">'.$tickets.'</label>';
                                        } 
                                    }
                                ?>
                            <?PHP
                            endif;
                            ?>
                        </a>
                        <?php if ($menu->Link == '#'): ?>
                            <ul id="<?=$menu->Id?>">
                                <?PHP foreach($sidebarSubMenu as $m):
                                    if ($menu->Id == $m->Parent_ID): ?>
                                        <li>
                                            <a href="<?=base_url($m->Link)?>">
                                                <?PHP
                                                if(strlen($m->Menu_String_Key) > 0):
                                                    ?>
                                                    <?=@getSystemString($m->Menu_String_Key)?>
                                                    
                                                <?PHP

                                                endif;
                                                ?>
                                            </a>
                                        </li>
                                    <?PHP

                                    endif;
                                endforeach;
                                ?>
                            </ul>
                        <?PHP
                        endif;
                        ?>
                    </li>
                <?PHP
                endif;
                endforeach;
                ?>
            </ul>
        </div>
        <div class="footer">
            <ul class="footer-ul">
                <li><a href="https://dnet.sa" target="_blank"><img src="<?=base_url($GLOBALS['acp_img_dir'].'/dnet.png')?>"></a></li>
                <li><span><small>DS 4.4</small></span></li>
                <li>
                    <span><small> Copyrights &copy;  <?=date("Y")?>. Powered by  <a href="https://dnet.sa" target="_blank">DNet</a></small></span>
                </li>
                <!--                <li class="ft-hvr">-->
                <!---->
                <!--                    <a href="--><?//=base_url('acp/help_support/helpAndSupport')?><!--" class="ft-a unset">-->
                <!--                        <i class="fa fa-paper-plane"></i>--><?//=getSystemString(186)?><!--</a>-->
                <!--                </li>-->
            </ul>
        </div>
    </div>
    <script>
       document.getElementById('267').classList.add('opened');
    </script>
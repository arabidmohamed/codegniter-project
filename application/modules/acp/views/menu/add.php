<link href="<?=base_url('style/acp/css/select2.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('style/acp/css/select2-bootstrap.min.css')?>" rel="stylesheet" />
<style>
    .panel.white{
        min-height: 100px;
    }
    .crop-image{
        width: 200px;
        height: 200px;
    }
    #map{
        width: 100%;
        height: 350px;
    }

    #map .form-control{
        width: 50% !important;
        top: 8px !important;
    }
</style>
<div id="content-main">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="<?=getSystemString("menu_list")?><"><a href="<?=base_url('acp/menu/listall')?>"><?=getSystemString("menu_list")?></a></li>
            <li class="breadcrumb-item active" aria-current="<?=getSystemString("add_menu")?><"><?=getSystemString("add_menu")?></li>
        </ol>
    </nav>
    <div class="row">

        <?PHP
        $this->load->view('acp_includes/response_messages');

        // Added by Yasir on 13 Oct 2019

        /*
         * Only super admin can access advanced settings.
        */
        if($this->session->userdata($this->acp_session->role()) != 'super_admin')
        {
            $this->view('un_authorize');
        }
        ?>

        <div class="col-md-12">
            <h3><?=getSystemString("add_menu")?></h3>
            <form action="<?=base_url($__controller.'/add_POST');?>" class="form-horizontal" method="post" data-parsley-validate>
                <div class="panel white" style="padding-bottom: 50px;">

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title"><?=getSystemString(763)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <select name="parentMenu" class="form-control select2">
                                <option value="0">-- <?=getSystemString(765)?> --</option>
                                <?PHP
                                foreach($menus as $menu):
                                    ?>
                                    <option value="<?=$menu->Id?>"><?=getSystemString($menu->Menu_String_Key)?></option>
                                <?PHP
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title"><?=getSystemString("menu_name")?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text"
                                   class="form-control"
                                   name="menuName"
                                   placeholder="e.g: Dashboard"
                                   required
                                   data-parsley-required-message="<?=getSystemString(213)?>">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title"><?=getSystemString(768)?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text"
                                   class="form-control"
                                   name="localizationKey"
                                   placeholder="132 or e.g: dashboard"
                                   required
                                   data-parsley-required-message="<?=getSystemString(213)?>">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title"><?=getSystemString("menu_link")?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text"
                                   class="form-control"
                                   name="link"
                                   value="#"
                                   required
                                   placeholder="acp/dashboard">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title"><?=getSystemString("menu_icon")?></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text"
                                   class="form-control"
                                   name="icon"
                                   placeholder="techometer">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title">JS Function</label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                            <input type="text"
                                   class="form-control"
                                   name="jsFunction"
                                   placeholder="clickFunction()">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title"></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6">
                            <label class="checkbox">
                                <input type="checkbox"
                                       name="isSidebarMenu"
                                       varlue="1" style="font-size: 16px"> <?=getSystemString(766)?>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <label for="title"></label>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-6">
                            <label class="checkbox">
                                <input type="checkbox"
                                       name="defaultSelected"
                                       varlue="1" style="font-size: 16px"><?=getSystemString(767)?>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-xs-12 text-right">
                        <input type="submit" class="btn btn-primary" value="<?=getSystemString(147)?>" name="submit"/>
                    </div>
                </div>

            </form>

        </div>

    </div>
</div>
<?PHP
$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url('style/acp/js/select2.min.js')?>"></script>
<script>
    $(function(){
        $('.select2').select2({
            theme: 'bootstrap',
            placeholder: '<?=getSystemString(426)?>'
        });
    });
</script>
</body>
</html>
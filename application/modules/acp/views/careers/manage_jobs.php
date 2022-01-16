<?PHP
$section = "SectionName_" . $__lang;
$return_url = $this->router->fetch_class() . "-" . $this->router->fetch_method();
?>
<style>
    .total-a a {
        display: block;
        width: 100%;
    }

    .total-a a:hover {
        color: #3b5ae7 !important;
        text-decoration: underline;
    }
</style>
<div id="content-main">
    
    <!-- Note: total -->
    <h3><?= @$jobs[0]->$section ?> </h3>
    <div class="container col-md-11" id="totals">
        <div class="row">
            <div class="col-md-6">
                <a href="<?= base_url('acp/careers/manageJobApplications') ?>">
                    <h3 class="text-center"><?php echo count(@$totalApp); ?></h3>
                    <h4>_</h4>
                    <p><?= getSystemString(208) ?></p>
                </a>
            </div>
            <div class="col-md-6">
                <a href="<?= base_url('acp/careers/viewArchivedJobApplications') ?>">
                    <h3 class="text-center"><?php echo count(@$totalArchived); ?></h3>
                    <h4>_</h4>
                    <p><?= getSystemString(529) ?></p>
                </a>
            </div>
        </div>
    </div>
    <!-- Ends -->
    <div class="row">

        <?PHP
        $this->load->view('acp_includes/response_messages');

        if (!isset($Career_ID)) {
            ?>
            <div class="col-md-12">
                <div>


                    <a href="<?= base_url('acp/careers/add') ?>" class="btn btn-primary float-left-right add-btn-toolbar"
                       style="color:#fff;"><i class="fa fa-plus"></i> <?= getSystemString(104) ?></a>

                </div>

                <div class="panel white" style="padding-bottom: 50px;">

                    <table class="table table-hover" id="jobs_table">
                        <thead>
                        <tr>
                            <th class="hide"><?= getSystemString(41) ?></th>
                            <th><?= getSystemString(177) ?></th>
                            <th><?= getSystemString(38) ?></th>
                            <th><?= getSystemString(208) ?></th>
                            <th><?= getSystemString(33) ?></th>
                            <th colspan="2"><?= getSystemString(42) ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP
                        if (count($jobs)) {
                            $i = 0;
                            $j = 0;
                            foreach ($jobs as $row) {

                                $i++;
                                $dt = new DateTime($row->Date);
                                ?>
                                <tr>
                                    <td class="hide"><?= $row->Career_ID; ?></td>
                                    <td><?= $dt->format('d-m-Y'); ?></td>
                                    <?PHP $title = 'Title_' . $__lang; ?>
                                    <td><?= $row->$title; ?></td>
                                    <td>
                                        <a href="<?= base_url($__controller . '/manageJobApplicationsWithJob/' . $row->Career_ID) ?>"
                                           style="display: block;width:100%"><?= $row->totalApplicants ?></a>
                                    </td>
                                    <td>
                                        <div data-toggle="hurkanSwitch" data-status="<?= $row->Status ?>">
                                            <input data-on="true" type="radio" <?PHP if ($row->Status) {
                                                echo 'checked';
                                            } ?> name="status<?= $i ?>">
                                            <input data-off="true" type="radio" <?PHP if (!$row->Status) {
                                                echo 'checked';
                                            } ?> name="status<?= $i ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-default dropdown-toggle" type="button"
                                               href="<?= base_url($__controller . '/editJob/' . $row->Career_ID . '/') ?>">
                                                <i class="fa fa-edit"></i> <?= getSystemString(43) ?>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-default dropdown-toggle dropdown-toggle-split"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                <li>
                                                    <a href="<?= base_url($__controller . '/editJob/' . $row->Career_ID . '/') ?>"
                                                       style="margin: 0px 5px;" class="dropdown-item">
                                                        <i class="fa fa-edit"></i> <?= getSystemString(43) ?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url($__controller . '/deleteJob/' . $row->Career_ID . '/') ?>"
                                                       onclick="return confirm('<?= getSystemString(45) ?>');"
                                                       style="margin: 0px 5px;" class="delete-record dropdown-item">
                                                        <i class="fa fa-trash"></i> <?= getSystemString(314) ?>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?PHP
                                $j++;
                            }

                            ?>
                            <tr class="total-a hide">
                                <td colspan="7" style="text-align: center !important"><b><a
                                                href="<?= base_url('acp/careers/manageJobApplications') ?>"
                                                style="color:#454545;padding-top: 10px"><b><?= getSystemString(208) ?>
                                                &nbsp;&nbsp;&nbsp; <?PHP
                                                echo count($totalApp);
                                                ?></b></a></b>
                                </td>
                            </tr>

                            <tr class="total-a hide">
                                <td colspan="7" style="text-align: center !important">
                                    <a href="<?= base_url('acp/careers/viewArchivedJobApplications') ?>"
                                       style="color:#454545;padding-top: 10px"><b><?= getSystemString(529) ?> &nbsp;&nbsp;&nbsp; <?PHP
                                            echo count($totalArchived);
                                            ?></b></a>
                                </td>
                            </tr>
                            <?PHP

                        } else {
                            ?>
                            <tr>
                                <td class='text-center'><?= getSystemString(46) ?></td>
                            </tr>
                            <?PHP
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <?PHP
        }

        if (isset($Career_ID)) {
            ?>

            <div class="col-md-10">
                <h3><?= getSystemString(73) ?></h3>

                <?PHP
                $lang_setting['website_lang'] = $website_lang;
                //load tabs
                $this->load->view('acp_includes/lang-tabs', $lang_setting);
                ?>

                <div class="panel white" style="padding-bottom: 50px;">

                    <form action="<?= base_url($__controller . '/updateJob'); ?>" class="form-horizontal" method="post"
                          enctype="multipart/form-data">
                        <div class="tab-content">

                            <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') {
                                echo 'in active';
                            } ?>" id="lang_en">
                                <input type="hidden" name="job_id" value="<?= $Career_ID ?>">
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="title"><?= getSystemString(38) ?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                        <input type="text" class="form-control" name="title_en"
                                               placeholder="<?= getSystemString(71) ?>"
                                               value="<?= $job[0]->Title_en ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="editor1"><?= getSystemString(72) ?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor1" id="editor1" rows="12" class="margin-bottom editors1"
                                                  cols="40">
										<?= $job[0]->Description_en ?>
										</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade <?PHP if ($__lang == 'ar') {
                                echo 'in active';
                            } ?>" id="lang_ar">
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="title"><?= getSystemString(38) ?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
                                        <input type="text" class="form-control" name="title_ar"
                                               placeholder="<?= getSystemString(71) ?>" value="<?= $job[0]->Title_ar ?>"
                                               dir="rtl">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        <label for="editor1"><?= getSystemString(72) ?></label>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor2" id="editor2" rows="12" class="margin-bottom editors2"
                                                  cols="40">
										<?= $job[0]->Description_ar ?>
										</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 text-right">
                                <input type="submit" class="btn btn-primary" value="<?= getSystemString(16) ?>"
                                       name="submit"/>
                            </div>
                        </div>


                    </form>

                </div>

            </div>
            <?PHP
        }
        ?>
    </div>
</div>
<?PHP
$this->load->view('acp_includes/footer');
?>
<script>
    $(function () {
        menu_track_manual(7, 0);
        $(document).on('click', "#jobs_table tr td .hurkanSwitch", function () {
            ChangeStatusFor($(this), 'jobs');
        });
    });
</script>
</body>
</html>
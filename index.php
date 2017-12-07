<?php
require_once 'process.php';
require_once 'header.php'
?>

<body class="home page-template-default bg-fade-white page page-id-5 themerex_body body_style_fullscreen body_filled theme_skin_education article_style_stretch layout_single-standard template_single-standard top_panel_style_dark top_panel_opacity_transparent top_panel_show top_panel_over menu_right user_menu_show sidebar_hide tribe-no-js wpb-js-composer js-comp-ver-5.4.1 vc_responsive">


<div class="body_wrap">

    <div class="container_fluid bg-fade-white">

        <div class="top_panel_fixed_wrap"></div>
        <?php
        $page = "home";
        require_once 'navbar.php';
        ?>

        <div class="container bg-white">

            <div class="content" style="margin-top: 7.9em">
                <div>
                    <div class="wall">
                        <img src="assets/images/bg/image_2.jpg" class="img-responsive"/>
                    </div>
                    <div class="move anim">
                        <a href="#main" class="in-link"></a>
                    </div>
                    <div>
                        <ol class="breadcrumb not-rounded">
                            <span class="hidden-xs">You are here: &nbsp;</span>
                            <li class="active"><i class="fa fa-home">&nbsp;</i>Home</li>
                            <?php
                            if ($session) {
                                ?>
                                <li>Dashboard</li>
                                <?php
                            }
                            ?>
                        </ol>
                    </div>
                </div>

                <br>

                <?php
                if ($session) {
                ?>
                <div class="col-md-4 col-sm-4">
                    <!-- Profile side bar -->
                    <div class="bordered-dark  pad-xs bg-white">
                        <div class="hanger pad-xs custom-shadow">
                            <img src="assets/uploads/misc/2015/02/71Bs52AaA7L.jpg" class="hanging-img"
                                 alt="none">

                        </div>
                        <a href="javascript:void()" class=" btn btn-block btn-flat">Upload <i
                                    class="fa fa-refresh"></i>
                        </a>
                        <div class="clearfix"></div>
                        <hr>
                        <div class=" pad-xs bg_tint_light ">
                            <h3>Profile</h3>
                            <div class="list-group">
                                <?php
                                echo "<span class=\"list-group-item\"><i class=\"fa fa-envelope\">&ensp;</i><strong class='text-muted'>Email address:</strong> <hr/>" . $user->getEmail() . "</span>";
                                echo "<span class=\"list-group-item\"><i class=\"fa fa-user-circle\">&ensp;</i>" . $user->getUserType() . "<a data-toggle=\"modal\" href=\"#popup_switch\" title=\"Switch to $switch\" ><i class=\"fa fa-clone\"></i></a></span>";
                                echo "<span class=\"list-group-item \"><strong class='text-muted'><i class=\"fa fa-birthday-cake\">&ensp;</i>Date of birth: " . $details[0]['dob'] . "</strong></span>";
                                echo "<span class=\"list-group-item \"><strong class='text-muted'><i class=\"fa fa-home\">&ensp;</i>Department: </strong><span class='text-info'>" . ucfirst(shorten($user->getDept(), 10)) . "&nbsp;</span><a href='#popup_editdept' data-toggle='modal' title='Meet others'><i class='fa fa-pencil'></i></a><a href='dept/" . strtolower($details[0]['dept']) . "' title='Meet others'><i class='fa fa-binoculars'></i></a></span>";
                                echo "<span class=\"list-group-item list-group-item-warning\"><strong class='text-muted'><i class=\"fa fa-question-circle\">&ensp;</i>Total help " . (($user->getUserType() === 'student') ? "received" : "offered") . ":</strong> <span class=\"label label-success\">" . ($user->getTotalHelp() ?? "None") . "</span></span>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="margin-sm" id="main"></div>
                    <div class="bordered-dark pad-xs bg-white">
                        <div class=" pad-xs bg_tint_light ">
                            <h3>Features</h3>

                            <div class="list-group">
                                <?php
                                if ($switch === "tutor")
                                    echo "<a data-toggle=\"modal\" href=\"#popup_ask\"  type=\"button\" class=\"list-group-item\" ><i class='fa fa-question-circle-o'>&nbsp;</i>Ask a question</a>";
                                else
                                    echo " <a data-toggle=\"modal\" href=\"#popup_seek\" type=\"button\" class=\"list-group-item\" ><i class=\"fa fa-handshake-o\">&nbsp;</i>Get hired </a>";
                                echo "<a href=\" " . (($session) ? "notearchive.php" : "#popup_login") . "\"  class=\"list-group-item\" type=\"button\"><i class='fa fa-sticky-note'>&nbsp;</i>Get notes</a>";
                                echo "<a href=\"pqa.php\" class=\"list-group-item\" type=\"button\"><i class='fa fa-newspaper-o'>&nbsp;</i>Get Past Q/A </a>";
                                echo "<a href=\"cdc.php\"  class=\"list-group-item\" type=\"button\"><i class='fa fa-lightbulb-o'>&nbsp;</i>Advance your Career </a>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="col-md-8 col-sm-8 ">
                    <div class="stats no-pad  bordered-dark ">
                        <div class="panel not-rounded">
                            <div class="panel-heading stat-head ">
                                <i class="fa fa-cogs"></i>
                                <span class="lead"> Stats</span>
                                <div class="pull-right">
                                    <a href="#stats_container" data-toggle="collapse" class="toggler" onclick="if(this.childNodes.item(1).classList.contains('fa-minus-circle')){
                                                this.childNodes.item(1).classList.remove('fa-minus-circle');
                                                this.childNodes.item(1).classList.add('fa-plus-circle');
                                            }
                                            else if(this.childNodes.item(1).classList.contains('fa-plus-circle')){
                                             this.childNodes.item(1).classList.remove('fa-plus-circle');
                                             this.childNodes.item(1).classList.add('fa-minus-circle');
                                         }">
                                        <i class="fa fa-minus-circle text-brown"></i>
                                    </a>
                                </div>
                                <!-- End:\div pull-right -->
                                <div class="clearfix"></div>
                            </div>

                            <div class="panel-body collapse fadeIn in shadow inset" id="stats_container">
                                <div class="col-lg-12 no-pad">
                                    <?php
                                    if ($user->getUserType() === "student") {
                                        $rs = $user->getAllAssignments();
                                        ?>
                                        <div class="panel panel-default bordered not-rounded">
                                            <div class="panel-heading not-rounded">
                                                <i class="fa fa-question-circle-o"></i>
                                                Assignments & Questions
                                            </div>
                                            <div class="panel-body pad-xs table-responsive">
                                                <table class="table table-striped table-condensed table-bordered table-hover"
                                                       id="stats">
                                                    <caption>Stats of Question asked</caption>
                                                    <thead>
                                                    <tr class="text-info">
                                                        <th>S/N</th>
                                                        <th>
                                                            <span class="hidden-sm">Name</span>
                                                        </th>
                                                        <th><span class="fa fa-comments-o text-info"></span>
                                                            <span class="hidden-sm">Topic</span>
                                                        </th>
                                                        <th>
                                                            <span class="fa fa-calendar text-success">&nbsp;</span><span
                                                                    class="hidden-sm">Started</span>
                                                        </th>
                                                        <th>
                                                            <span class="fa fa-calendar text-danger">&nbsp;</span>
                                                            <span class="hidden-sm">Expires</span>
                                                        </th>
                                                        <th class="text-center text-info">
                                                            <span
                                                                    class="fa fa-exclamation-circle ">&nbsp;</span>
                                                            <span
                                                                    class="hidden-sm">Status</span>
                                                        </th>
                                                        <th class="text-left">Action</th>
                                                    </tr>
                                                    </thead>

                                                    <?php
                                                    if (count($rs)) {
                                                    echo "<tbody>";
                                                    for ($i = 0; $i < sizeof($rs); ++$i) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i + 1 ?></td>
                                                            <td title="<?php echo $rs{$i}{'topic'} ?>"
                                                                data-toggle="tooltip"
                                                                class="pad-xs"><?php echo ucfirst(substr($rs{$i}{'projtname'}, 9)) ?>
                                                            </td>
                                                            <td title="<?php echo ucfirst($rs{$i}{'topic'}) ?>"
                                                                data-toggle="tooltip"
                                                                class="pad-xs"><?php echo ucfirst(shortenTextWithLink($rs{$i}{'topic'}, 15, $rs{$i}{'type'}, 'qid', $rs{$i}{'qid'})) ?>

                                                            </td>
                                                            <td class="text-center"><?php echo($rs{$i}{'starts'} ? $rs{$i}{'starts'} : "<span class=\"font-sm \"><a  href=\"makepayment.php\" class='btn btn-sm btn-default'> Make payment</a></span>") ?>

                                                            </td>
                                                            <td class="text-center text-danger bg-warning">
                                                                <span id="cntdown_assignment_<?php echo $i ?>"><?php echo dateSlug($rs{$i}{'expires'}) ?>

                                                                </span>
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="font-sm label <?php switch ($rs{$i}{'status'}) {
                                                                    case "expired":
                                                                        {
                                                                            echo "label-danger";
                                                                            break;
                                                                        }
                                                                    case "completed":
                                                                        {
                                                                            echo "label-success";
                                                                            break;
                                                                        }
                                                                    default:
                                                                        {
                                                                            echo "label-warning";
                                                                            break;
                                                                        }
                                                                } ?>">
                                                                <?php echo $rs{$i}{'status'} . "  "; ?></span>
                                                            </td>
                                                            <td>
                                                                <?php echo readMore($rs{$i}{'type'}, 'qid', $rs{$i}{'qid'}, "Rv");
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    echo "</tbody>";
                                                    ?>
                                                </table>
                                                <?php
                                                }
                                                else {
                                                    ?>
                                                    </table>
                                                    <hr>
                                                    <p class="text-center pad-xs">
                                                <span>No assignment yet! <a data-toggle="modal"
                                                                            href="#popup_ask">Add <i
                                                                class="fa fa-plus-circle"></i></a>
                                                </span>
                                                    </p>
                                                    <?php
                                                }
                                                ?>
                                            </div><!-- End: panel-body -->
                                        </div><!-- End: panel-->
                                        <?php
                                        $rs = $user->getAllProjects();
                                        ?>
                                        <hr>
                                        <div class="panel panel-default not-rounded bordered">
                                            <div class="panel-heading not-rounded">
                                                <i class="fa fa-suitcase"></i>
                                                Projects
                                            </div>
                                            <div class="panel-body pad-xs table-responsive">
                                                <table class="table table-striped table-condensed table-bordered table-hover"
                                                       id="stats">
                                                    <caption>Statistics of pending projects</caption>
                                                    <thead>
                                                    <tr class="text-info">
                                                        <th>S/N</th>
                                                        <th>
                                                            <span class="hidden-sm">Name</span>
                                                        </th>
                                                        <th><span class="fa fa-suitcase text-info"></span>
                                                            <span class="hidden-sm">Project</span>
                                                        </th>
                                                        <th>
                                                            <span class="fa fa-calendar text-success">&nbsp;</span>
                                                            <span class="hidden-sm">Started</span>
                                                        </th>
                                                        <th>
                                                            <span class="fa fa-calendar text-danger">&nbsp;</span>
                                                            <span class="hidden-sm">Expires</span>
                                                        </th>
                                                        <th class="text-center text-info"><span
                                                                    class="fa fa-exclamation-circle ">&nbsp;</span>
                                                            <span class="hidden-sm">Status</span>
                                                        </th>
                                                        <th class="text-left">Action</th>
                                                    </tr>
                                                    </thead>

                                                    <?php
                                                    if (count($rs)) {
                                                        echo " <tbody>";
                                                        for ($i = 0; $i < sizeof($rs); ++$i) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i + 1 ?></td>
                                                                <td><?php echo substr($rs{$i}{'projtname'}, 9) ?></td>
                                                                <td><?php echo shortenTextWithLink(ucfirst($rs{$i}{'topic'}), 12, $rs{$i}{'type'}, 'qid', $rs{$i}{'qid'}) ?></td>
                                                                <td class="text-center"><?php echo($rs{$i}{'starts'} ? $rs{$i}{'starts'} : " <span class=\"font-sm \"><a  href=\"makepayment.php\" class='btn btn-sm btn-default'> Make payment</a></span>") ?></td>

                                                                <td class="text-center text-danger bg-warning">
                                                                    <span id="cntdown_<?php echo($i + 1) ?>"><?php echo dateSlug($rs{$i}{'expires'}) ?></span>
                                                                </td>
                                                                <td>
                                                                    <span class="font-sm label label-warning"><?php echo $rs{$i}{'status'} . "  "; ?></span>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    echo readMore($rs{$i}{'type'}, 'qid', $rs{$i}{'qid'}, "<i class='fa fa-mouse-pointer'></i>", 0);
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        echo " </tbody>
                                            </table>";
                                                    }
                                                    else {
                                                    ?>
                                                </table>
                                                <hr>
                                                <p class="text-center pad-xs">
                                            <span>No project yet!<a data-toggle="modal"
                                                                    href="#popup_ask">Add <i
                                                            class="fa fa-plus-circle"></i></a>
                                            </span>
                                                </p>
                                                <?php }
                                                ?>

                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        $rs = $user->getAllProjects();
                                        ?>
                                        <div class="panel panel-default not-rounded bordered">
                                            <div class="panel-heading not-rounded">
                                                <i class="fa fa-suitcase"></i>
                                                Projects
                                            </div>
                                            <div class="panel-body pad-xs table-responsive">
                                                <table class="table table-striped table-condensed table-bordered table-hover"
                                                       id="stats">
                                                    <caption>Statistics of pending projects</caption>
                                                    <thead>
                                                    <tr class="text-info">
                                                        <th>S/N</th>
                                                        <th>
                                                            Name
                                                        </th>
                                                        <th><span class="fa fa-suitcase hidden-xs"></span>
                                                            Project
                                                        </th>
                                                        <th>Started</th>
                                                        <th><span class="hidden-sm">Expires</span>
                                                            <span class="hidden-md hidden-xs hidden-lg"><i
                                                                        class="fa fa-hourglass-half"></i></span>
                                                        </th>
                                                        <th class="text-left">Status</th>
                                                        <th class="text-left">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <?php
                                                    if (count($rs)) {
                                                        echo "<tbody>";
                                                        for ($i = 0; $i < sizeof($rs); ++$i) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i + 1 ?></td>
                                                                <td><?php echo substr($rs{$i}{'projtname'}, 9) ?></td>
                                                                <td title="<?php echo $rs{$i}{'topic'} ?>"
                                                                    data-toggle="tooltip"
                                                                    class="pad-xs"><?php echo ucfirst(shortenTextWithLink($rs{$i}{'topic'}, 12, $rs{$i}{'type'}, 'qid', $rs{$i}{'qid'})) ?></td>
                                                                <td class="text-center"><?php echo($rs{$i}{'starts'} ? $rs{$i}{'starts'} : " <span class=\"font-sm \"><a  href=\"makepayment.php\" class='btn btn-sm btn-default'> Make payment</a></span>") ?></td>
                                                                <td class="text-center text-danger bg-warning">
                                                                    <span id="cntdown_assignment_<?php echo $i ?>"><?php echo dateSlug($rs{$i}{'expires'}) ?></span>
                                                                </td>
                                                                <td class="text-center">
                                                                <span class="font-sm label <?php switch ($rs{$i}{'status'}) {
                                                                    case "expired":
                                                                        {
                                                                            echo "label-danger";
                                                                            break;
                                                                        }
                                                                    case "completed":
                                                                        {
                                                                            echo "label-success";
                                                                            break;
                                                                        }
                                                                    default:
                                                                        {
                                                                            echo "label-warning";
                                                                            break;
                                                                        }
                                                                } ?>">
                                                                <?php echo $rs{$i}{'status'} . "  "; ?>
                                                            </span>
                                                                </td>
                                                                <td>
                                                                    <a type="button" class="in">Review</a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        echo "</tbody>
                                                </table>";
                                                    }
                                                    else {
                                                    ?>
                                                </table>
                                                <hr>
                                                <p class="text-center pad-xs">
                                                <span>No project accepted yet! <a data-toggle="modal"
                                                                                  href="#popup_seek">Get hired <i
                                                                class="fa fa-handshake-o"></i></a>
                                              </span>
                                                </p>
                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <hr>
                                </div>

                                <div class="col-md-12 no-pad">
                                    <div class="panel panel-default not-rounded table-responsive bordered">
                                        <div class="panel-heading not-rounded">
                                            <i class="fa fa-clock-o"></i>&ensp;Recent activities
                                        </div>
                                        <div class="panel-body">
                                            <p>Details about recent transactions</p>
                                        </div>
                                        <!-- Table -->
                                        <table class="table table-striped table-condensed table-hove ">
                                            <caption></caption>
                                            <thead>
                                            <tr class="text-info">
                                                <th>S/N</th>
                                                <th>Messages</th>
                                                <th></th>
                                                <th>Replies</th>
                                                <th>Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th>1</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </tbody>
                                            <tfoot></tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div><!--End panel-body -->
                            <div class="panel-footer">
                                <p>Details about stats</p>
                            </div>
                        </div><!--End panel stats-->
                    </div>
                    <hr>

                    <div class="stats no-pad bordered-dark">
                        <div class="panel not-rounded">
                            <div class="panel-heading stat-head ">
                                <i class="fa fa-paperclip"></i>
                                <span class="lead"> Purchase Past Questions/Answers</span>
                                <div class="pull-right">
                                    <a href="#pqa_container" data-toggle="collapse" class="toggler" onclick="if(this.childNodes.item(1).classList.contains('fa-minus-circle')){
                                this.childNodes.item(1).classList.remove('fa-minus-circle');
                                this.childNodes.item(1).classList.add('fa-plus-circle');
                            }
                            else if(this.childNodes.item(1).classList.contains('fa-plus-circle')){
                             this.childNodes.item(1).classList.remove('fa-plus-circle');
                             this.childNodes.item(1).classList.add('fa-minus-circle');
                         }">
                                        <i class="fa fa-plus-circle text-brown"></i>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body pad-sm collapse fadeIn shadow inset" id="pqa_container"
                                 style="max-height: 460px; overflow: auto;">
                                <div>
                                    <ul class="media-list">
                                        <li class="media case">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object "
                                                         src="assets/uploads/misc/2015/01/jessie_russel_full-350x290.jpg"
                                                         alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="item">
                                                    <h4 class="media-heading">Media heading</h4>
                                                    <p> Lorem ipsum dolor sit amet...</p>

                                                    <button class="btn btn-success"><i
                                                                class="fa fa-shopping-cart"></i> Add
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="media case">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object "
                                                         src="assets/uploads/misc/2015/01/douglas_adams_full-400x225.jpg"
                                                         alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="item">
                                                    <h4 class="media-heading">Media heading</h4>
                                                    <p> Lorem ipsum dolor sit amet...</p>

                                                    <button class="btn btn-success"><i
                                                                class="fa fa-shopping-cart"></i> Add
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="media case">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object "
                                                         src="assets/uploads/misc/2015/01/douglas_adams_full-400x225.jpg"
                                                         alt="...">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="item">
                                                    <h4 class="media-heading">Media heading</h4>
                                                    <p> Lorem ipsum dolor sit amet...</p>

                                                    <button class="btn btn-success"><i
                                                                class="fa fa-shopping-cart"></i> Add
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-footer">
                                <p>Details about stats</p>
                            </div>
                        </div><!--End panel stats-->
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>
            </div>
            <?php
            }
            ?>
        </div>

        <?php
        if (!$session) {
            ?>
            <div data-animation="animated zoomIn normal " id="main">
                <div class="pad-left-sm text-center lead">
                    <p>Get started today! </p>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">

                    <div class="thumbnail showcase bg_tint_dark text-center">
                        <img src="assets/images/bg/pattern_3.jpg" alt="">
                        <div class=" caption-top">
                            <h4>Assignments <br>&amp;<br> questions</h4>
                        </div>
                        <a data-toggle="modal"
                           href="<?php echo ($session) ? "#popup_ask" : "#popup_login" ?>"
                           class="sc_icon fa  fa-question-circle sc_icon_bg_menu menu_dark_color"
                           style="font-size:3em; line-height: 1em;"></a>
                        <div class="sc_section caption-bottom"
                             style="margin-top:1em !important;font-weight:400;">
                            <div class="wpb_text_column wpb_content_element ">
                                <div class="wpb_wrapper">
                                    <p><a data-toggle="modal"
                                          href="<?php echo ($session) ? "#popup_ask" : "#popup_login" ?>">
                                            <button class="menu_color btn btn-default">
                                                Ask
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                    <div class="thumbnail showcase bg_tint_dark text-center">
                        <img src="assets/images/bg/pattern_1.jpg" alt="">
                        <div class=" caption-top">
                            <h4>Notes archive</h4>
                        </div>
                        <a <?php echo "href=\"" . (($session) ? "notearchive.php" : "#popup_login") . "\""; ?>
                                class="sc_icon fa fa-archive sc_icon_bg_menu menu_dark_color"
                                style="font-size:3em; line-height: 1em;"></a>
                        <div class="sc_section caption-bottom"
                             style="margin-top:1em !important;font-weight:400;">
                            <div class="wpb_text_column wpb_content_element ">
                                <div class="wpb_wrapper">
                                    <p>
                                        <a href="<?php echo ($session) ? "notearchive.php" : "#popup_login" ?>" <?php echo ($session) ? "" : "data-toggle=\"modal\""; ?>>
                                            <button class="menu_color btn btn-default" data-toggle="modal">
                                                Pick
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                    <div class="thumbnail showcase bg_tint_dark text-center">
                        <img src="assets/images/bg/pattern_2.jpg" alt="">
                        <div class=" caption-top">
                            <h4>Past <span class="hidden-xs">questions <br>&amp;<br> answers</span><span
                                        class="visible-xs">Q/A</span></h4>
                            <span class="label label-success pad-xs">Free</span>

                        </div>
                        <a href="pqa.php"
                           class="sc_icon fa fa-newspaper-o sc_icon_bg_menu menu_dark_color"
                           style="font-size:3em; line-height: 1em;"></a>
                        <div class="sc_section caption-bottom"
                             style="margin-top:1em !important;font-weight:400;">
                            <div class="wpb_text_column wpb_content_element ">
                                <div class="wpb_wrapper">
                                    <p>
                                        <a href="pqa.php">
                                            <button class="menu_color btn btn-default" data-toggle="modal">
                                                Pick
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                    <div class="thumbnail showcase bg_tint_dark text-center">
                        <img src="assets/images/bg/image_3.jpg" alt="">
                        <div class=" caption-top">
                            <h4>Career Development center</h4>
                            <span class="label label-success pad-xs">Free</span>

                        </div>

                        <a href="cdc.php"
                           class="sc_icon fa fa-lightbulb-o sc_icon_bg_menu menu_dark_color"
                           style="font-size:3em; line-height: 1em;"></a>

                        <div class="sc_section caption-bottom"
                             style="margin-top:1em !important;font-weight:400;">
                            <div class="wpb_text_column wpb_content_element ">
                                <div class="wpb_wrapper">
                                    <p>
                                        <a href="cdc.php">
                                            <button type="button" class="menu_color btn btn-default">
                                                Visit
                                            </button>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-fade-white">
                <div class="" data-animation="animated fadeInUp normal">
                    <div style="margin-top:2.5em !important;">
                        <div class="sc_section aligncenter font-lg" style="width:70%;">
                            <hr>
                            <h2
                                    class="sc_title sc_title_regular"
                                    style="margin-top:0px;">
                                Learn From the Best
                            </h2>
                            <div class="wpb_text_column wpb_content_element ">
                                <div class="wpb_wrapper">
                                    <p>Our online courses are built in partnership with
                                        technology leaders and are relevant to industry
                                        needs.<br/>
                                        Upon completing a Online course, you&#8217;ll
                                        receive a
                                        verified completion certificate recognized by
                                        industry
                                        leaders.</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>



        <?php
        if (!$session) {
            ?>
            <section>
                <div class="partners">

                </div>
            </section>
            <?php
        }
        ?>

        <div> <!-- /div.container.bg-white -->
        </div>        <!-- /.container_fluid.no-margin -->

        <footer class=" bg-fade-white">
            <div aria-label="Page navigation " class="container">
                <ul class="pagination pull-right">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>

                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="footer_style_white  widget_area">

                <div class="content_wrap">

                    <div class="columns_wrap row pad-lg">
                        <div class="col-sm-6">
                            <h5 class="widget_title">Popular Q/A</h5>
                            <div class="media-list">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="wp-post-image" width="75" height="75"
                                                 alt="Video Training for Microsoft products and technologies"
                                                 src="assets/uploads/misc/2014/10/masonry_13-75x75.jpg">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="post_title"><a
                                                    href="courses/video-training-for-microsoft-products-and-technologies/index.html">Video
                                                Training for Microsoft products and technologies</a></h6>
                                        <div class="post_info">
                                    <span class="post_info_item post_info_posted">
                                        <a href="courses/video-training-for-microsoft-products-and-technologies/index.html"
                                           class="post_info_date">March 1, 2015</a>
                                    </span>
                                            <span class="post_info_item post_info_posted_by">by
                                        <a href="author/trx_admin/index.html"
                                           class="post_info_author">Mike Newton</a></span><span
                                                    class="post_info_item post_info_counters">
                                        <a href="courses/video-training-for-microsoft-products-and-technologies/index.html"
                                           class="post_counters_item post_counters_rating fa fa-star"><span
                                                    class="post_counters_number">56</span>
                                    </a>
                                </span>
                                            <br>
                                            <a href="../tag/audio/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="audio (1 item)">audio</a>
                                            <a href="../tag/chat/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="chat (1 item)">chat</a>
                                            <a href="../tag/computer/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="computer (1 item)">computer</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="wp-post-image" width="75" height="75"
                                                 alt="Video Training for Microsoft products and technologies"
                                                 src="assets/uploads/misc/2014/10/masonry_13-75x75.jpg">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="post_title"><a
                                                    href="courses/video-training-for-microsoft-products-and-technologies/index.html">Video
                                                Training for Microsoft products and technologies</a></h6>
                                        <div class="post_info">
                                <span class="post_info_item post_info_posted">
                                    <a href="courses/video-training-for-microsoft-products-and-technologies/index.html"
                                       class="post_info_date">March 1, 2015</a>
                                </span>
                                            <span class="post_info_item post_info_posted_by">by
                                    <a href="author/trx_admin/index.html"
                                       class="post_info_author">Mike Newton</a></span><span
                                                    class="post_info_item post_info_counters">
                                    <a href="courses/video-training-for-microsoft-products-and-technologies/index.html"
                                       class="post_counters_item post_counters_rating fa fa-star"><span
                                                class="post_counters_number">56</span>
                                </a>
                            </span>
                                            <br>
                                            <a href="../tag/audio/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="audio (1 item)">audio</a>
                                            <a href="../tag/chat/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="chat (1 item)">chat</a>
                                            <a href="../tag/computer/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="computer (1 item)">computer</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="wp-post-image" width="75" height="75"
                                                 alt="Video Training for Microsoft products and technologies"
                                                 src="assets/uploads/misc/2014/10/masonry_13-75x75.jpg">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="post_title"><a
                                                    href="courses/video-training-for-microsoft-products-and-technologies/index.html">Video
                                                Training for Microsoft products and technologies</a></h6>
                                        <div class="post_info">
                            <span class="post_info_item post_info_posted">
                                <a href="courses/video-training-for-microsoft-products-and-technologies/index.html"
                                   class="post_info_date">March 1, 2015</a>
                            </span>
                                            <span class="post_info_item post_info_posted_by">by
                                <a href="author/trx_admin/index.html"
                                   class="post_info_author">Mike Newton</a></span><span
                                                    class="post_info_item post_info_counters">
                                <a href="courses/video-training-for-microsoft-products-and-technologies/index.html"
                                   class="post_counters_item post_counters_rating fa fa-star"><span
                                            class="post_counters_number">56</span>
                            </a>
                        </span>
                                            <br>
                                            <a href="../tag/audio/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="audio (1 item)">audio</a>
                                            <a href="../tag/chat/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="chat (1 item)">chat</a>
                                            <a href="../tag/computer/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="computer (1 item)">computer</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="widget_title">Recent Q/A</h5>

                            <div class="media-list">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="wp-post-image" width="75" height="75"
                                                 alt="Video Training for Microsoft products and technologies"
                                                 src="assets/uploads/misc/2014/10/masonry_13-75x75.jpg">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="post_title"><a
                                                    href="courses/video-training-for-microsoft-products-and-technologies/index.html">Video
                                                Training for Microsoft products and technologies</a></h6>
                                        <div class="post_info">
                        <span class="post_info_item post_info_posted">
                            <a href="courses/video-training-for-microsoft-products-and-technologies/index.html"
                               class="post_info_date">March 1, 2015</a>
                        </span>
                                            <span class="post_info_item post_info_posted_by">by
                            <a href="author/trx_admin/index.html"
                               class="post_info_author">Mike Newton</a></span><span
                                                    class="post_info_item post_info_counters">
                            <a href="courses/video-training-for-microsoft-products-and-technologies/index.html"
                               class="post_counters_item post_counters_rating fa fa-star"><span
                                        class="post_counters_number">56</span>
                        </a>
                    </span>
                                            <br>
                                            <a href="../tag/audio/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="audio (1 item)">audio</a>
                                            <a href="../tag/chat/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="chat (1 item)">chat</a>
                                            <a href="../tag/computer/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="computer (1 item)">computer</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="wp-post-image" width="75" height="75"
                                                 alt="Video Training for Microsoft products and technologies"
                                                 src="assets/uploads/misc/2014/10/masonry_13-75x75.jpg">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="post_title"><a
                                                    href="courses/video-training-for-microsoft-products-and-technologies/index.html">Video
                                                Training for Microsoft products and technologies</a></h6>
                                        <div class="post_info">
                    <span class="post_info_item post_info_posted">
                        <a href="courses/video-training-for-microsoft-products-and-technologies/index.html"
                           class="post_info_date">March 1, 2015</a>
                    </span>
                                            <span class="post_info_item post_info_posted_by">by
                        <a href="author/trx_admin/index.html"
                           class="post_info_author">Mike Newton</a></span><span
                                                    class="post_info_item post_info_counters">
                        <a href="courses/video-training-for-microsoft-products-and-technologies/index.html"
                           class="post_counters_item post_counters_rating fa fa-star"><span
                                    class="post_counters_number">56</span>
                    </a>
                </span>
                                            <br>
                                            <a href="../tag/audio/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="audio (1 item)">audio</a>
                                            <a href="../tag/chat/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="chat (1 item)">chat</a>
                                            <a href="../tag/computer/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="computer (1 item)">computer</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="wp-post-image" width="75" height="75"
                                                 alt="Video Training for Microsoft products and technologies"
                                                 src="assets/uploads/misc/2014/10/masonry_13-75x75.jpg">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="post_title"><a
                                                    href="courses/video-training-for-microsoft-products-and-technologies/index.html">Video
                                                Training for Microsoft products and technologies</a></h6>
                                        <div class="post_info">
                <span class="post_info_item post_info_posted">
                    <a href="courses/video-training-for-microsoft-products-and-technologies/index.html"
                       class="post_info_date">March 1, 2015</a>
                </span>
                                            <span class="post_info_item post_info_posted_by">by
                    <a href="author/trx_admin/index.html"
                       class="post_info_author">Mike Newton</a></span><span
                                                    class="post_info_item post_info_counters">
                    <a href="courses/video-training-for-microsoft-products-and-technologies/index.html"
                       class="post_counters_item post_counters_rating fa fa-star"><span
                                class="post_counters_number">56</span>
                </a>
            </span>
                                            <br>
                                            <a href="../tag/audio/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="audio (1 item)">audio</a>
                                            <a href="../tag/chat/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="chat (1 item)">chat</a>
                                            <a href="../tag/computer/index.html" class="tag" style="font-size: 8pt;"
                                               aria-label="computer (1 item)">computer</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    <!-- /.columns_wrap -->
                </div>    <!-- /.content_wrap -->
            </div>
            <div aria-label="Page navigation " class="container">
                <ul class="pagination pull-right">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </footer>    <!-- /.footer_wrap -->

        <?php
        include_once 'footer.php';
        ?>

    </div>        <!-- /.body_wrap -->

    <a href="#" class="scroll_to_top " title="Scroll to top"><i class="fa fa-chevron-up"></i></a>

    <?php include_once 'inc-js.php' ?>

</body>

</html>
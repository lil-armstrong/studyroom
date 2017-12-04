<?php
//tutor_msgs.php

require_once 'process.php';


$msg_encrypt = isset($_GET{'msg_id'}) ? $_GET{'msg_id'} : null;
/* md5($msgs{'triggered_by'}) . md5("view") */
$get_msg_id = substr($msg_encrypt, 0, 1);
$get_crypt_data = substr($msg_encrypt, 1);
$is_dept = false;

if ($session && $user->getUserType() === "student") {
    require_once 'header.php';
    $all_dept_msgs = null;
    $all_personal_msgs = null;
    $get_msg = null;
    /*Get all messages for the department*/
    $all_dept_msgs = $user->getAllDeptMsg();

    $all_personal_msgs = $user->getAllPersonalMsg();


    if (null !== $msg_encrypt)
        if ($get_crypt_data === md5("dept_msg")) {
            $query = "SELECT *, DATE_FORMAT(`duration`, '%m/%d/%Y %H:%i:%s') as duration FROM " . $user->getUserType() . "_dept_msg WHERE mid='$get_msg_id' ";
            $get_msg = $db->querySQLi($query)->fetchAll(2);
            if (!$get_msg) {
                if ($all_dept_msgs) {
                    $get_msg = $all_dept_msgs;
                    $is_dept = true;
                } else {
                    $is_dept = false;
                    $get_msg = null;
                }
            } else
                $is_dept = true;

        } else {
            $query = "SELECT *, DATE_FORMAT(`duration`, '%m/%d/%Y %H:%i:%s') as duration FROM " . $user->getUserType() . "_msg WHERE mid='$get_msg_id' ";
            $get_msg = $db->querySQLi($query)->fetchAll(2);
            if (!$get_msg) {
                if ($all_personal_msgs) {
                    $get_msg = $all_personal_msgs;
                } else
                    $get_msg = null;
            }
        }

    ?>

    <body class="vc_responsive home bg-fade-white">
    <div class="container-fluid">
        <header class=" clearfix " style="position: relative">

            <div class="container">
                <div class="pull-right">
                    <ul id="fade-link" class="menu_user_wrap">
                        <?php

                        echo "<li class=\" \">
                   
                    <a href=\"" . ROOT . "\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\" >
                        <i class=\"fa fa-home\">&nbsp;</i><span class=\"hidden-xs\">Home</span>
                    </a>
                    </li>";
                        echo "<li class=\" \">
                   
                    <a href=\"about.php\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\" >
                        <i class=\"fa fa-info-circle\">&nbsp;</i><span class=\"hidden-xs\">About</span>
                    </a>
                    </li>";

                        echo "<li class=\"dropdown \">

                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\"
                    aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fa fa-user-circle pad-xs\">&ensp;</i><span class=\"hidden-xs\"> " . $user->getUserType() . "&ensp;|&ensp;" . $details{0}{'firstname'} . "</span><span class=\"caret\"></span>
                    </a>
                    <ul class=\"dropdown-menu dropdown-menu-right user\">
                    
                    <li>
                    <a data-toggle=\"modal\" href=\"#popup_pref\">
                    <i class='fa fa-wrench'></i> Preferences</a>
                    </li>
                    <li role=\"separator\" class=\"divider\"></li>
                    <li><a href=\"logout.php?logout=1\"><i class='fa fa-lock'></i> Logout</a></li>
                    </ul>
                    </li>";
                        ?>
                    </ul>

                </div>
            </div>
            <div class="clearfix"></div>
            <hr class="no-margin">
            <div class="col-sm-12 pad-sm" style="display: block; width: 100%;">
                <div class="container  not-rounded bg_tint_light ">

                    <h3 class="text-lighten-1"><i class="fa fa-envelope-open">&nbsp;</i>All messages </h3>
                    <h5 class="text-muted pad-left-sm">Access all messages from here</h5>
                </div>
            </div>
        </header>
        <hr/>
        <div class="container bg-white bordered-dark pad-bottom-lg">


            <hr class="no-margin">

            <div>
                <ol class="breadcrumb not-rounded">
                    <span class="hidden-sm hidden-xs">You are here: &nbsp;</span>
                    <li><a href="<?php echo ROOT ?>"><i class="fa fa-home">&nbsp;</i>Home</a></li>
                    <li title="messages" class="active">Messages</li>
                </ol>

                <div class="">
                    <section id="msg-display" class="col-md-8 col-sm-8 bordered-dark" style="min-height: 200px">

                        <?php
                        if (null !== $get_msg) {
                        $query = "SELECT *, DATE_FORMAT(`expires`, '%m/%d/%Y %H:%i:%s') AS expires FROM questions WHERE `qid`='" . $get_msg{0}{'qid'} . "'";
                        $msg_detail = $db->querySQLi($query)->fetch(2);
                        /*Confirm that a record hasn't been seen*/
                        $sqli = "SELECT * FROM " . $user->getUserType() . (($is_dept) ? "_dept_msg_seen" : "_msg_seen") . " WHERE `mid`='" . $get_msg{0}{'mid'} . "' AND `uid`='" . $user->getID() . "'";
                        $seen = $db->querySQLi($sqli)->fetch(2);
                        if (!$seen) {
                            $sqli = "INSERT INTO " . $user->getUserType() . (($is_dept) ? "_dept_msg_seen" : "_msg_seen") . " VALUES (NULL, '" . $get_msg{0}{'mid'} . "', '" . $user->getID() . "',NOW())";
                            $seen = $db->querySQLi($sqli);
                        }

                        //        Get all seen messages


                        ?>
                        <div class="pull-right font-sm bg-purple-light bg_tint_dark pad-xs">
                            <?php
                            echo "<i class=\"fa fa-calendar\" aria-hidden=\"true\">&nbsp;</i> " . substr($get_msg{0}{'msg_date'}, 0, 19);
                            ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="message-box ">

                            <div class="message-head">
                                <h4 title="<?php echo ucfirst($msg_detail{'topic'}) ?>"><?php
                                    echo shorten(ucfirst($msg_detail{'topic'}), 51);
                                    ?>
                                </h4>
                            </div>
                            <hr>
                            <div class="message-body" style="min-height: 200px;max-height: 900px; overflow: auto;">

                                <?php
                                /*Gets all the uploaded files*/
                                $uploads = $db->getUpload($msg_detail{'projtname'})->fetchAll(2);
                                /*Start: Display project/assignment information*/
                                ?>
                                <div class="col-md-2 pad-xs">
                                    <span><strong>Message:</strong></span>
                                </div>
                                <div class="col-md-10 bordered-dark pad-xs"
                                     style="max-height: 400px; overflow: auto;">
                                    <p><?php echo ucfirst($msg_detail{'message'}) ?></p>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="col-md-2 pad-xs"><span><strong>Urgent:</strong></span></div>
                                <div class="col-md-10 bordered-dark pad-xs">
                                    <span><?php echo $msg_detail{'urgent'} ?></span>
                                </div>
                                <div class="clearfix">
                                </div>
                                <hr>

                                <div class="col-md-2 pad-xs"><span>
                                            <strong>Uploads:</strong></span>
                                </div>
                                <div class="col-md-10 bordered-dark pad-sm"
                                     style="max-height: 490px; overflow: auto;">
                                    <?php
                                    //                                    echo "<pre class='font-sm'>";
                                    //                                    print_r($uploads);
                                    //                                    echo "</pre>";
                                    if (count($uploads)) {
                                        $i = 0;
                                        foreach ($uploads as $upload => $val) {
                                            $i++;
                                            /*check if first five characters is "image"*/
                                            if (substr($val{'filetype'}, 0, 5) === "image") {
                                                if (file_exists($val{'dir'})) {
                                                    echo "<div class='col-sm-6' >
                                                        <a href='" . ($val{'dir'}) . "' download='" . ($val{'filename'}) . "'>
                                                        <img src='" . ($val{'dir'}) . "' class='img-responsive bordered-dark shadow-hover'  />
                                                        </a>
                                                        Filename: " . $val{'filename'} . "</div>";
                                                    if ($i % 2 === 0) {
                                                        echo "<div class='clearfix'></div>";
                                                        echo "<hr/>";
                                                    }
                                                }
                                            } else {
                                                $fext = trim(substr($val{'filetype'}, (strlen($val{'filetype'}) - 4)), '/');
                                                echo "<span class='bordered pad-xs'><i class='fa fa-file";
                                                switch ($fext) {
                                                    case "pdf":
                                                        echo '-pdf-o';
                                                        break;
                                                    case "doc":
                                                    case "docx":
                                                        echo '-word-o';
                                                        break;
                                                    case "xls":
                                                    case "xlsx":
                                                        echo '-excel-o';
                                                        break;
                                                    default:
                                                        echo '-text';
                                                }
                                                echo "'>&nbsp;</i>" . $val{'filename'} . "<a class='bordered btn btn-xs' title='download file' href='" . ($val{'dir'}) . "' download='" . ($val{'filename'}) . "'>&nbsp;<i class='fa fa-download'>&nbsp;</i></a>".((!$is_dept) ? "&nbsp;&nbsp;<a class='btn btn-xs bordered'  title='delete file' onclick='ajaxDelUpload()' href=''><i class='fa fa-close'></i></a>" : '') . "</span>";
                                            }
                                        }

                                    } else {
                                        echo "<p>No file was uploaded</p>";
                                    }

                                    ?>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <hr>
                            <div class="message-footer pad-xs margin-bottom-sm">
                                <?php
                                $task_affirmed = null;
                                /*Check if task has already been accepted/affirmed*/
                                $sqli = "SELECT * FROM `task` WHERE `qid`='" . $get_msg{0}{'qid'} . "'";
                                $task_affirmed = $db->querySQLi($sqli)->fetch(2);
                                if (isset ($get_msg{0}{'level'}) && $get_msg{0}{'level'} === 'affirm' && null !== $task_affirmed && $is_dept) {
                                    echo "<div class=\"panel not-rounded bordered-dark\">
                                            <div class=\"panel-heading\">
                                                <i class=\"fa fa-modx\"></i>
                                                <span class=\"lead\"> Terms &amp; conditions</span>
                                                <div class=\"pull-right\">
                                                    <a href=\"#terms_container\" data-toggle=\"collapse\" class=\"toggler\"
                                                       onclick=\"if(this.childNodes.item(1).classList.contains('fa-minus-circle')){
                                                        this.childNodes.item(1).classList.remove('fa-minus-circle');
                                                        this.childNodes.item(1).classList.add('fa-plus-circle');
                                                    }
                                                    else if(this.childNodes.item(1).classList.contains('fa-plus-circle')){
                                                           this.childNodes.item(1).classList.remove('fa-plus-circle');
                                                           this.childNodes.item(1).classList.add('fa-minus-circle');
                                                    }\">
                                                        <i class=\"fa fa-minus-circle text-brown \"></i></a>
                                                </div>
                                                <div class=\"clearfix\"></div>
                                            </div>
                                            <div class=\"panel-body collapse fadeIn  shadow inset\"
                                                 id=\"terms_container\">
                                                The terms and conditions goes in here...
                                            </div>
                                            <div class=\"panel-footer\">
                                                <p>Please review our terms and conditions before accepting this
                                                    project</p>
                                            </div>
                                        </div>";
                                    echo "<form action=\"\">
										<div class=\"form-group pull-right\">
										<a href=\"affirm.php?msg_id=" . $get_msg{0}{'mid'} . md5("affirm") . "\" class=\"btn btn-success not-rounded\">
										<i class=\"fa fa-handshake-o\">&nbsp;</i>
										Accept
										</a>
										</div>
										<div class='clearfix'></div>
										</form>";
                                } elseif (isset($get_msg{0}{'level'}) && ($get_msg{0}{'level'}) === 'affirm') {
                                    echo "<div class=\"pull-right text-success bordered pad-xs clearfix'\">
										<i class='fa fa-check-circle'>&nbsp;</i>Project has been matched with tutor
										</div>
										<div class='clearfix pad-sm'></div>";
                                }

                                ?>
                                <ul class="menu_user_wrap link-list ">
                                    <li class="margin-bottom-sm">
                                        <div class="label bg_tint_dark bg-purple-light not-rounded pad-sm"><?php echo $user->getDept() ?></div>
                                    </li>
                                    <?php if (null !== $msg_detail) {

                                        echo "<li class=\"margin-bottom-sm\">
                                            <div class=\"label label-warning not-rounded pad-sm\">" . $msg_detail{'type'} . "</div>
                                        </li>";
                                        echo "<li class=\"margin-bottom-sm\">
                                            <div class=\"label bg_tint_dark bg-green-dark not-rounded pad-sm\">" . $get_msg{0}{'level'} . "</div>
                                        </li>";
                                        echo "<li class=\" margin-top-lg margin-bottom-lg\"><hr/></li>";
                                        echo (isset($msg_detail{'expires'})) ? "<li class=\"margin-bottom-sm\">&nbsp;<i class='fa fa-warning text-danger font-md '></i> Expires:&nbsp;<span id=\"cntdown_expires\"
                                                class='bg-red label bg_tint_dark not-rounded pad-sm custom-shadow'>
                                                " . substr(dateSlug($msg_detail{'expires'}), 0, 19) . "</span>
                                </li>" : ''; ?>
                                        <div class="clearfix">
                                            <hr/>
                                        </div>

                                        <div class='lead text-center'>
                                            <a href="makepayment.php?item=<?php echo $get_msg{0}{'qid'} . md5('makepayment') ?>"
                                               class="btn btn-flat btn-block btn-lg bg-purple-light bg_tint_dark not-rounded"><span
                                                        class="fa fa-shopping-cart">&nbsp;</span>Pay</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </ul>

                            </div>
                            <hr>
                            <?php
                            } else
                                echo "<h5>No message selected</h5>";
                            ?>
                    </section>
                    <hr class="visible-xs">

                    <section id="sidebar" class="col-md-4 col-sm-4 no-pad navbar-static-top pad-left-sm ">
                        <div class="bordered-dark pad-xs pad-bottom-lg">
                            <header class="pad-left-sm pad-right-sm text-center">
                                <h4>All messages</h4>
                            </header>
                            <hr>

                            <?php

                            $seen_dept_msgs = $user->getSeenDeptMsgs();
                            $seen_personal_msgs = $user->getSeenPersonalMsgs();
                            //                    echo "</ul>";
                            //                    echo "<ul class='menu_user_wrap link-list text-warning'>";
                            //                    echo "<li>
                            //							<span><i class='fa fa-bell-o'>&nbsp;</i>Notice</span>
                            //							</li>";
                            //                    echo "<li>
                            //							<span><i class='fa fa-exclamation-triangle'>&nbsp;</i>Alert</span>
                            //							</li>";
                            //                    echo "<li>
                            //							<span><i class='fa fa-thumbs-o-up'>&nbsp;</i>Confirm</span>
                            //							</li>";
                            //                    echo "<li>
                            //							<span><i class='fa fa-gavel'>&nbsp;</i>Affirm</span>
                            //							</li>";
                            //                    echo "</ul>";
                            //                    echo "<hr/>";

                            /*Department messages collapsible*/
                            echo "<a style='text-decoration: none; cursor:pointer' data-toggle='collapse' href='#dept_msgs' title='click to toggle'  class=' label bg-purple-light bg_tint_dark pad-sm not-rounded' onclick=\"if(this.childNodes.item(1).classList.contains('fa-minus-circle')){
                                                this.childNodes.item(1).classList.remove('fa-minus-circle');
                                                this.childNodes.item(1).classList.add('fa-plus-circle');
                                            }
                                            else if(this.childNodes.item(1).classList.contains('fa-plus-circle')){
                                             this.childNodes.item(1).classList.remove('fa-plus-circle');
                                             this.childNodes.item(1).classList.add('fa-minus-circle');
                                         }\">Departmental:&nbsp;&nbsp;<span class=\"label bg-green bordered bg-warning bg_tint_light  \">" . count($all_dept_msgs) . "</span> <i class='fa fa-" . (($is_dept) ? "minus" : 'plus') . "-circle'>&nbsp;</i></a>";
                            echo "<span class=\"label  bg-purple-light  \" style='margin-top:-10px; margin-left: -1em; position:absolute'>";
                            echo (count($all_dept_msgs) - count($seen_dept_msgs)) ? (count($all_dept_msgs) - count($seen_dept_msgs)) : '';
                            echo "</span>";


                            echo "<div class=\"list-group margin-top-xs fadeIn " . (($is_dept) ? "in" : '') . " collapse\" id='dept_msgs'>";
                            foreach ($all_dept_msgs as $msgs) {
                                echo "<div class=\"list-group-item no-pad pad-xs " . (($is_dept && $get_msg{0}{'mid'} === $msgs{'mid'}) ? " active-border " : '') . "\" >";
                                echo "<a title='Click to view' href='tutor_msgs.php?msg_id=" . $msgs{'mid'} . md5("dept_msg") . "'  class='" . $msgs{'level'} . " '><i class='" . ((!in_array($msgs{'mid'}, $seen_dept_msgs)) ? "fa fa-envelope-o" : "fa fa-envelope-open-o") . "' >&nbsp;</i>" . ucfirst(shorten($msgs{'topic'}, 15)) . "</a></div>";
                            }
                            echo "</div>";

                            echo "<hr>";

                            /*Personal messages collapsible*/
                            echo "<a style='text-decoration: none; cursor:pointer' data-toggle='collapse' href='#personal_msgs' class='label bg-purple-light bg_tint_dark pad-sm not-rounded' title='click to toggle' onclick=\"if(this.childNodes.item(1).classList.contains('fa-minus-circle')){
                                                this.childNodes.item(1).classList.remove('fa-minus-circle');
                                                this.childNodes.item(1).classList.add('fa-plus-circle');
                                            }
                                            else if(this.childNodes.item(1).classList.contains('fa-plus-circle')){
                                             this.childNodes.item(1).classList.remove('fa-plus-circle');
                                             this.childNodes.item(1).classList.add('fa-minus-circle');
                                         }\">Personal:&nbsp;<span class=\"label bg-green bordered bg-warning bg_tint_light  \">" . count($all_personal_msgs) . "</span>
                             <i class='fa fa-" . ((!$is_dept) ? "minus" : 'plus') . "-circle'>&nbsp;</i></a>";
                            echo "<span class=\"label  bg-purple-light \" style='margin-top:-10px; margin-left: -1em; position:absolute'>";
                            echo (count($all_personal_msgs) - count($seen_personal_msgs)) ? (count($all_personal_msgs) - count($seen_personal_msgs)) : '';
                            echo "</span>";

                            echo "<div class=\"list-group margin-top-xs " . ((!$is_dept) ? "in" : '') . " fadeIn collapse\" id='personal_msgs'>";

                            foreach ($all_personal_msgs as $msgs) {
                                echo "<div class=\"list-group-item no-pad pad-xs " . ((!$is_dept && $get_msg{0}{'mid'} === $msgs{'mid'}) ? " active-border " : '') . "\">";
                                echo "<a title='Click to view' href='" . $user->getUserType() . "_msgs.php?msg_id=" . $msgs{'mid'} . md5("msg") . "'  class='" . $msgs{'level'} . "'><i class='" . ((!in_array($msgs{'mid'}, $seen_personal_msgs)) ? "fa fa-envelope-o" : "fa fa-envelope-open-o") . "' >&nbsp;</i>" . ucfirst(shorten($msgs{'topic'}, 15)) . "</a></div>";
                            }
                            echo "</div>";
                            ?>
                        </div>
                    </section>


                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
    <br>
    <div class="copyright_wrap pad-sm">
        <hr/>
        <div class="content_wrap">
            <p>&copy; Copyright 2017<?php echo (date('Y') != 2017) ? '-' . date('Y') : '' ?> All Rights Reserved. <a
                        href="#">Terms of use</a> and <a href="#">Privacy Policy</a></p>
        </div>
    </div>

    <?php
    if (!$is_dept) {
        ?>
        <script>
            function ajaxDelUpload() {
                $response = confirm('Deleting?');
                if($response){
                    alert("Deleting!");
                }
            }
        </script>
        <?php
    }
    require_once 'inc-js.php';
    ?>
    </body>
    </html>
    <?php
} else {
    $error404 = "You do not have permission to access this page!";
    include_once('404page.php');
}



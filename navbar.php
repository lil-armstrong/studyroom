<header class="top_panel_wrap " style="margin-top: 0px;">
    <div class="container no-pad ">

        <div class="pull-right link-list">

            <?php
            if ($session) {
//                calc the unseen and seen messages
                $user->getUnseenMsgsCount();
            }
            ?>
            <ul id="fade-link" class="menu_user_wrap">
                <?php
                if ($session) {

                    echo "<li class=\" bg-purple \">
                    <a  role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\" href='".$user->getUserType()."_msgs.php'>
                        <i class='fa fa-envelope'></i> <span class='hidden-sm hidden-xs'>Locker</span> 
                    </a>
                    </li>";

                    echo "<li class=\"dropdown bg-purple\">

                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\"
                    aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fa fa-user-circle pad-xs\">&ensp;</i><span class=\"hidden-xs\"> " . $user->getUserType() . "&ensp;|&ensp;" . $details{0}{'firstname'} . "</span><span class=\"caret\"></span>
                    </a>
                    <ul class=\"dropdown-menu dropdown-menu-right user\">
                    <li>
                    <a data-toggle=\"modal\" href=\"#popup_switch\"><i class='fa fa-clone'></i> " . (!$session ? "Become a" : "Switch to ") . " $switch</a>
                    </li>
                    <li>
                    <a data-toggle=\"modal\" href=\"#popup_pref\">
                    <i class='fa fa-wrench'></i> Preferences</a>
                    </li>
                    <li role=\"separator\" class=\"divider\"></li>
                    <li><a href=\"logout.php?logout=1\"><i class='fa fa-lock'></i> Logout</a></li>
                    </ul>
                    </li>";


                } else {
                    ?>
                    <li class="">
                        <a data-toggle="modal" href="#popup_login" class="btn btn-primary not-rounded custom-shadow"><i
                                    class="fa fa-unlock">&nbsp;</i>Login</a>
                        <!-- Button trigger modal -->


                    </li>
                    <li class="">
                        <a data-toggle="modal" href="#popup_register"
                           class="btn vc_btn-chino btn-success btn-flat not-rounded custom-shadow"><i
                                    class="fa fa-user-plus">&nbsp;</i>Register as student</a>
                        <!-- Button trigger modal -->
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>

    <nav class="navbar navbar-default edge-point top-nav attach " data-spy="affix" data-offset-top="85">
        <div class="container ">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class=" .menu_main_wrap navbar-header bg-white pad-left-sm">
                <button type="button" class="navbar-toggle collapsed not-rounded " data-toggle="collapse"
                        data-target="#navbar-menu" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="logo">
                    <strong> <a href="index.php">Studyroom</a></strong>
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav">
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-179">
                        <a href="index.php">Studyroom <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (!$session)
                        echo " <li class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-179\">
                    <a data-toggle=\"modal\"
                    href=\"#popup_register_tutor\">Become a Tutor</a>
                    </li>";
                    ?>
                    <li class="<?php echo ($page == "home") ? "active" : "" ?> menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-179">
                        <a href="index.php">Home</a>
                    </li>
                    <?php
                    if ($session) {
                        ?>

                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">Explore<span class="caret"></span></a>
                            <ul class="dropdown-menu shadow ">
                                <?php
                                if ($session)
                                    if ($switch === "tutor") {
                                        ?>
                                        <li><a data-toggle="modal"
                                               href="<?php echo ($session) ? "#popup_ask" : "#popup_login" ?>">Ask
                                                Question</a>

                                        </li>
                                        <?php
                                    } ?>
                                <li><a <?php echo ($session) ? "" : "data-toggle=\"modal\"";
                                    echo "href=\"" . (($session) ? "notearchive.php" : "#popup_login") . "\""; ?> <?php echo ($page === "notearchive") ? "class=\"active\"" : "" ?>>Note
                                        Archive</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="pqa.php" <?php echo ($page === "pqa") ? "class=\"active\"" : "" ?>>
                                        Past Question &amp; Answers
                                        <span class="label label-success">Free</span></a></li>
                                <li <?php echo ($page === "cdc") ? "class=\"active\"" : "" ?> ><a href="cdc.php">Career
                                        Development
                                        centre (CDC)
                                    </a>
                                </li>
                                <!-- <li><a href="#">Separated link</a></li> -->
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="<?php echo ($page === "about") ? "active" : "" ?>"><a href="about.php">About</a></li>
                </ul>

            </div><!-- /.navbar-collapse -->
            <?php

            if ($user->ErrorExist()) {
                $user->popErrors();
            }
            if ($errors->ErrorExist()) {
//  if error exists
                $errors->popErrors();
            }
            if (isset($msg) && null!==$msg && !empty($msg)) {
                echo "<div class=\"alert alert-info text-center pad-top-sm margin-top-sm not-rounded\">
        <button data-dismiss=\"alert\" class=\"close\"> &times; </button>
        <i class=\"fa fa-info-circle\">&nbsp;</i>" . urldecode($msg) . "</div>";
                echo "<script>
        setInterval(function(){
            window.location.replace('index.php');
        }, 4000);
        </script>";
            }

            ?>

        </div><!-- /.container-fluid -->

    </nav>


    <?php
    if ($session) {

        ?>
        <!-- Modal: Ask Question-->
        <div class="modal fade margin-top-xl" id="popup_ask" tabindex="" role="dialog"
             aria-labelledby="QuestionModal">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header bg-purple-dark text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title bg_tint_dark" id="switch_modal"><i class="fa fa-comment"></i> Hire a
                            tutor
                        </h3>
                    </div>
                    <div class="alert alert-info text-center not-rounded">
                        <i class="fa fa-info-circle"> </i> Please read the instructions carefully.
                    </div>
                    <form action="askquestion.php" method="post" id="buddypress" enctype="multipart/form-data">
                        <div class="modal-body pad-lg">
                            <div class="form-group">
                                <p class="text-muted bordered pad-xs "><i
                                            class="fa fa-info-circle text-danger">&nbsp;</i>
                                    The Project/assignment name given here cannot be changed afterward.<br/>Changes can
                                    be
                                    made to a previously submitted project if a similar project name is given. Please
                                    view
                                    all your project to know which name to give.
                                </p>

                                <label for="topic" class="sr-only">Project/assignment name</label>
                                <label for="topic" class="help-block">Project/assignment name </label>
                                <p class="text-danger"> (UNIQUE | MAX CHAR: 12 | Must begin with alphabet then
                                    numbers(optiona) | No spaces )</p>

                                <input type="text" placeholder="Project/assignment name" class="form-control"
                                       id="poraname"
                                       name="poraname"
                                       required="required" pattern="[A-Za-z]\w+" maxlength="12"/>
                            </div>
                            <div class="form-group">
                                <label for="topic" class="sr-only">Subject</label>
                                <label for="topic" class="help-block">Subject</label>
                                <input type="text" placeholder="Topic" class="form-control" id="topic" name="topic"
                                       required="required" pattern="^[\w+(,| |:|;|&|! )]*$"/>
                            </div>
                            <div class="form-group">
                                <label for="dept" class="help-block">Department</label>
                                <select name="dept" id="dept" class="form-control input-sm" aria-required="true"
                                        required="required">
                                    <optgroup label="Select department">
                                        <option value="">---</option>
                                        <?php
                                        /*Get all the departments from the database*/
                                        $query = "SELECT * FROM `departments` WHERE 1 ORDER BY `name`";
                                        $result = $db->querySQLi($query)->fetchAll(2);
                                        foreach ($result as $depts => $dept) {
                                            echo "<option value='" . $dept{'name'} . "'>" . ucfirst($dept{'name'}) . "</option>\n";
                                        }
                                        ?>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="msg" class="sr-only">Message</label>
                                <textarea name="msg" id="msg" cols="30" placeholder="Message" rows="10"
                                          class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="upload">You can upload:&ensp;
                                    <i class="fa fa-file-pdf-o">&ensp;</i>pdf&nbsp;
                                    <i class="fa fa-image">&ensp;</i>images. <span class="text-danger">MAX FILE SIZE: 512KB</span></label>
                                <input type="hidden" name="MAX_FILE_SIZE"
                                       ➝ value="524288">
                                <input type="file" multiple="multiple" name="upload[]" id="upload">
                            </div>

                            <hr>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="timelimit" class="help-block">Set time Limit/expiry time from
                                        now: </label>
                                    <select name="timelimit" class="form-control" id="timelimit1"
                                            onchange="showOthers();disableLimit();"
                                            required="required"
                                            title="Time limit">
                                        <optgroup label="Set Time limit">
                                            <option value=""></option>
                                            <option value="week">1 week</option>
                                            <option value="month">1 month</option>
                                            <option value="year">1 year</option>
                                            <option value="others">Others</option>
                                        </optgroup>
                                    </select>
                                    <br>
                                    <div class="form-group">
                                        <div id="others_container" class="hidden">
                                            <input type="number" title="Manually set time limit" placeholder="Counts"
                                                   name="timenum" id="timenum"
                                                   disabled class="form-control"
                                                   required min="1"/>
                                            <br>
                                            <select name="timelimit" id="timelimit2" class="form-control"
                                                    required="required" disabled
                                                    title="Other time limit" aria-required="true">
                                                <optgroup label="Period">
                                                    <option value="">---</option>
                                                    <option value="day">day(s)</option>
                                                    <option value="week">week(s)</option>
                                                    <option value="month">month(s)</option>
                                                    <option value="year">year(s)</option>
                                                </optgroup>
                                            </select>

                                        </div>
                                        <p>Or specify an expiry date (mm/dd/yyyy).<br/> <i
                                                    class="fa fa-info-circle text-danger"></i> This will
                                            override any timelimit specified above</p>
                                        <div class="form-group">
                                            <input type="date" name="period"
                                                   pattern="([1]*[0-2]*|([0]*[1-9]))\/([1-2]*[0-9]*|[3][0,1]|([0][1-9])){1,2}\/\d{4}"
                                                   onchange="disableLimit();"
                                                   id="timelimit3" class="form-control" placeholder="mm/dd/yyyy"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="urgent" class="help-block">Is it urgent?</label>
                                        <label for="urgent">Yes </label>
                                        <input type="radio" name="urgent" title="Urgency" value="yes" required>
                                        <label for="urgent">No </label>
                                        <input type="radio" name="urgent" title="Urgency" value="no" required>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="help-block">Type of question</label>
                                        <label for="type">Assignment </label>
                                        <input type="radio" name="type" id="type" title="type of question"
                                               value="assignment" required/>
                                        <label for="type">Project </label>
                                        <input type="radio" name="type" id="type" title="type of question"
                                               value="project"
                                               required/>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <script type="text/javascript">
                                others_container = document.getElementById("others_container");
                                othernum = document.getElementById("timenum");
                                timelimit1 = document.getElementById('timelimit1');
                                timelimit2 = document.getElementById('timelimit2');
                                timelimit3 = document.getElementById('timelimit3');

                                // alert(timelimit1.value);
                                function disableLimit() {
                                    if (timelimit3.value)
                                        timelimit1.setAttribute("disabled", "disabled");
                                    else {
                                        timelimit1.removeAttribute("disabled");
                                        if (timelimit1.value)
                                            timelimit3.setAttribute("disabled", "disabled");
                                        else {
                                            others_container.classList.add("hidden");
                                            timelimit3.removeAttribute("disabled");
                                        }
                                    }
                                }

                                function showOthers() {
                                    if (timelimit1.value)
                                        if (timelimit1.value === 'others') {
                                            others_container.removeAttribute("class");
                                            othernum.removeAttribute("disabled");
                                            timelimit2.removeAttribute("disabled");
                                            timelimit3.setAttribute("disabled", "disabled");
                                        }
                                        else {
                                            others_container.classList.add("hidden");
                                            othernum.setAttribute("disabled", "disabled");
                                            timelimit2.setAttribute("disabled", "disabled");
                                            timelimit3.removeAttribute("disabled");
                                        }
                                }


                            </script>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <input type="submit" name="ask" value="Ask">
                                <input type="reset" value="Reset">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--End Modal: Ask Question-->

        <!-- Modal: Switcher -->
        <div class="modal fade" id="popup_switch" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <form action="" method="post">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-purple text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title bg_tint_dark" id="switch_modal"><i class="fa fa-clone"></i> Switch
                                to <?php echo $switch ?></h3>
                        </div>
                        <div class="modal-body">
                            Are you sure you wish to switch to becoming a <?php echo $switch ?>. Note you might lose
                            some
                            priviledges!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Switch</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal: Preferences -->
        <div class="modal fade" id="popup_pref" tabindex="-1" role="dialog"
             aria-labelledby="modalpref">
            <form action="" method="post">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-purple text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title bg_tint_dark" id="switch_modal"><i class="fa fa-wrench"></i>
                                Preferences
                            </h3>
                        </div>
                        <hr>
                        <div class="modal-body">
                            <fieldset>
                                <legend>Change password</legend>
                                <div class="form-group">
                                    <label for="oldpass">Old password</label>
                                    <input type="password" name="oldpass" id="oldpass" title="Change old password"
                                           placeholder="Old password"/>
                                </div>
                                <div class="form-group">
                                    <label for="newpass">New password</label>
                                    <input type="password" name="newpass" id="newpass" title="Change old password"
                                           placeholder="New password"/>
                                </div>
                                <div class="form-group">
                                    <label for="confirmpass">Confirm new password</label>
                                    <input type="password" name="confirmpass" id="confirmpass"
                                           title="Confirm new password"
                                           placeholder="Confirm password"/>
                                    <a href="javascript:void()">Apply <i class="fa fa-refresh"></i></a>
                                </div>
                            </fieldset>
                            <hr>
                            <fieldset>
                                <legend></legend>

                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="modal fade" id="popup_seek" tabindex="1" role="dialog"
             aria-labelledby="modalpref">
            <form action="" method="post">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-purple text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title bg_tint_dark" id="switch_modal"><i class="fa fa-search"></i> Search
                                for
                                job
                            </h3>
                        </div>
                        <hr>
                        <div class="modal-body">
                            <fieldset class="text-center">
                                <legend>Search here</legend>
                                <div class="form-group">
                                    <label for="oldpass"></label>
                                    <input type="text" title="search here" placeholder="Enter keyword"/>
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
    } else {
        ?>
        <!-- Modal: Become a tutor -->
        <div class="modal fade " id="popup_register_tutor" tabindex="" role="dialog"
             aria-labelledby="myModalLabel">
            <form action="register.php" method="post" onsubmit="return checkForm(this); " id="register_tutor">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-purple text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title bg_tint_dark" id="switch_modal"><i class="fa fa-user-plus"></i>
                                Registration</h3>
                        </div>
                        <div class="alert alert-info text-center not-rounded">
                            <i class="fa fa-info-circle"> </i> Register as a tutor.
                        </div>
                        <div class="modal-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="help-block">Username</label>
                                    <input type="text" id="username" name="username" placeholder="Username/Email"
                                           title="username input box" class="form-control"
                                           value="<?php echo $username ?>" required pattern="\w+"/>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="help-block">First name</label>
                                    <input type="text" id="firstname" name="firstname" placeholder="First name"
                                           title="First name input box" class="form-control"
                                           value="<?php echo $firstname ?>" required minlength="2" pattern="\w+"/>
                                </div>
                                <div class="form-group">
                                    <label for="middlename" class="help-block">Middle name</label>
                                    <input type="text" id="middlename" name="middlename" placeholder="Middle name"
                                           title="Middle name input box" class="form-control"
                                           value="<?php echo $middlename ?>" required pattern="\w+"/>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="help-block">Last name</label>
                                    <input type="text" id="lastname" name="lastname" placeholder="Last name"
                                           title="Last name input box" class="form-control"
                                           value="<?php echo $lastname ?>" required pattern="\w+"/>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="help-block">Email</label>
                                    <input type="email" id="email" name="email" placeholder="mail@domain.com"
                                           title="Email input box" class="form-control" value="<?php echo $email ?>"
                                           required
                                           pattern="[a-zA-Z0-9]*@\w+.\w+"
                                    />
                                </div>


                                <div class="form-group">
                                    <label for="pass1" class="help-block">Password <br/><span class="text-danger">(Must be at least 6 characters and contain UPPERCASElowercaseNumbers)</span></label>
                                    <input type="password" id="pass1" name="pass1" placeholder="Password"
                                           title="Password must contain at least 6 characters, including UPPER/lowercase and numbers."
                                           class="form-control" required
                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"/>
                                </div>
                                <div class="alert alert-danger text-center not-rounded" id="mismatch"
                                     hidden="hidden">
                                    <i class="fa fa-info-circle"> </i> Password mismatch.
                                </div>
                                <div class="form-group">
                                    <label for="pass2" class="help-block">Confirm password</label>
                                    <input type="password" id="pass2" name="pass2" placeholder="Password"
                                           title="Please enter the same Password as above." class="form-control"
                                           required="required"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="help-block">Phone</label>
                                    <input type="tel" id="phone" name="phone" placeholder="Phone number"
                                           title="Phone input box" class="form-control" value="<?php echo $phone ?>"
                                           pattern="[0-9]*"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="dob" class="help-block">Date of Birth (yyyy-mm-dd)</label>
                                    <input type="date" id="dob" name="dob" placeholder="yyyy-mm-dd"
                                           title="yyyy-mm-dd" class="form-control"
                                           value="<?php echo $dob ?>"
                                           required
                                           pattern="\d{4}-([1][0-2]|([0][1-9]))-([1-2][0-9]|([3][0,1])*|([0]?[1-9])){1,2}"
                                           onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sex" class="help-block">Sex</label>
                                    <label for="male">Male </label>
                                    <input type="radio" name="sex" title="Male" value="male"
                                           required <?php echo ($sex == 'male') ? 'checked="checked"' : '' ?>>
                                    <label for="female">Female </label>
                                    <input type="radio" name="sex" title="female"
                                           value="female" <?php echo ($sex == 'female') ? 'checked="checked"' : '' ?>
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="marital" class="help-block">Marital status</label>
                                    <label for="single">Single </label>
                                    <input type="radio" name="marital" id="single" title="Single" value="single"
                                           required <?php echo ($marital == 'single') ? 'checked="checked"' : '' ?> />
                                    <label for="married">Married </label>
                                    <input type="radio" name="marital" id="married" title="married" value="married"
                                           required <?php echo ($marital == 'married') ? 'checked="checked"' : '' ?> />
                                </div>
                                <div class="form-group">
                                    <label for="marital" class="help-block">Highest education</label>
                                    <select name="edulevel" class="form-control" id="edulevel" required
                                            title="Highest educational level">
                                        <optgroup label="Level">
                                            <option value="">---</option>
                                            <option value="1"<?php echo ($edulevel == 1) ? 'selected' : '' ?>>
                                                High school
                                            </option>
                                            <option value="2">Bachelors</option>
                                            <option value="3">Masters</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="school" class="help-block">School</label>
                                    <select name="school" class="form-control" id="school" required title="School">
                                        <optgroup label="School">
                                            <option value="">---</option>
                                            <option value="uniport" <?php echo ($school == "uniport") ? 'selected' : '' ?>>
                                                University of Port Harcourt, Rivers
                                            </option>
                                            <option value="uniuyo">University of Uyo, Akwa Ibom</option>
                                            <option value="unijos">University of Jos, Jos</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field" class="help-block">Field of study</label>
                                    <select name="field" class="form-control" id="field" required title="Field">
                                        <optgroup label="Field of study">
                                            <option value="">---</option>
                                            <option value="computer" <?php echo ($field == "computer") ? 'selected' : '' ?>>
                                                Computer science
                                            </option>
                                            <option value="uniuyo">Engineering</option>
                                            <option value="unijos">Education</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nation" class="help-block">Nationality</label>
                                    <select name="nation" class="form-control" id="nation" required
                                            title="Nationality">
                                        <optgroup label="School">
                                            <option value="">---</option>
                                            <option value="nigeria" <?php echo ($nation == "nigeria") ? 'selected' : '' ?>>
                                                Nigeria
                                            </option>
                                            <option value="usa">USA</option>
                                            <option value="uk">UK</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="state" class="help-block">State</label>
                                    <select name="state" class="form-control" id="state" required title="state">
                                        <optgroup label="state">
                                            <option value="">---</option>
                                            <option value="akwa ibom" <?php echo ($state == "aks") ? 'selected="selected"' : '' ?>>
                                                AKS
                                            </option>
                                            <option value="rivers">Rivers</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city" class="help-block">City</label>
                                    <select name="city" class="form-control" id="city" required title="city">
                                        <optgroup label="city">
                                            <option value="">---</option>
                                            <option value="uyo" <?php echo ($state == "aks") ? 'selected="selected"' : '' ?>>
                                                Uyo
                                            </option>
                                            <option value="port harcourt">PH</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="zipcode" class="help-block">Zipcode</label>
                                    <input type="text" name="zipcode" id="zipcode" maxlength="6"
                                           placeholder="Zipcode"
                                           value="<?php echo $zipcode ?>"/>
                                </div>
                                <input type="hidden" name="type" value="tutor"/>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success" name="register" value="Register">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal: login -->
        <div class="modal fade" id="popup_login" tabindex="" role="dialog" aria-labelledby="myModalLabel">
            <form method="post">
                <div class="modal-dialog pad-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-purple text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title bg_tint_dark" id="switch_modal"><i class="fa fa-unlock"></i>
                                Login</h3>

                        </div>
                        <div class="alert alert-info text-center not-rounded">
                            <i class="fa fa-info-circle"> </i> Login to access all features.
                        </div>
                        <hr>
                        <div class="modal-body pad-left-lg pad-right-lg">

                            <div class="form-group">
                                <label for="user">Username/Email</label>
                                <input type="text" id="user" name="user" placeholder="Enter Username/Email"
                                       title="Username/Email input box" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" id="pass" name="pass" placeholder="Password"
                                       title="password input box" class="form-control" required/>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success" name="login" value="Login"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal: Register student -->
        <div class="modal fade" id="popup_register" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <form action="register.php" method="post" onsubmit="return checkForm(this); " id="register_std">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-purple text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title bg_tint_dark" id="switch_modal"><i class="fa fa-user-plus"></i>
                                Registration</h3>
                        </div>
                        <div class="alert alert-info text-center not-rounded">
                            <i class="fa fa-info-circle"> </i> Register as a student.
                        </div>
                        <div class="modal-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="help-block">Username</label>
                                    <input type="text" id="username" name="username" placeholder="Username/Email"
                                           title="username input box" class="form-control"
                                           value="<?php echo $username ?>" required pattern="\w+"/>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="help-block">First name</label>
                                    <input type="text" id="firstname" name="firstname" placeholder="First name"
                                           title="First name input box" class="form-control"
                                           value="<?php echo $firstname ?>" required minlength="2" pattern="\w+"/>
                                </div>
                                <div class="form-group">
                                    <label for="middlename" class="help-block">Middle name</label>
                                    <input type="text" id="middlename" name="middlename" placeholder="Middle name"
                                           title="Middle name input box" class="form-control"
                                           value="<?php echo $middlename ?>" required pattern="\w+"/>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="help-block">Last name</label>
                                    <input type="text" id="lastname" name="lastname" placeholder="Last name"
                                           title="Last name input box" class="form-control"
                                           value="<?php echo $lastname ?>" required pattern="\w+"/>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="help-block">Email</label>
                                    <input type="email" id="email" name="email" placeholder="mail@domain.com"
                                           title="Email input box" class="form-control" value="<?php echo $email ?>"
                                           required
                                           pattern="[a-zA-Z0-9]*@\w+.\w+"
                                    />
                                </div>


                                <div class="form-group">
                                    <label for="pass1" class="help-block">Password <br/><span class="text-danger">(Must be at least 6 characters and contain UPPERCASElowercaseNumbers)</span></label>
                                    <input type="password" id="pass1" name="pass1" placeholder="Password"
                                           title="Password must contain at least 6 characters, including UPPER/lowercase and numbers."
                                           class="form-control" required
                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"/>
                                </div>
                                <div class="alert alert-danger text-center not-rounded" id="mismatch"
                                     hidden="hidden">
                                    <i class="fa fa-info-circle"> </i> Password mismatch.
                                </div>
                                <div class="form-group">
                                    <label for="pass2" class="help-block">Confirm password</label>
                                    <input type="password" id="pass2" name="pass2" placeholder="Password"
                                           title="Please enter the same Password as above." class="form-control"
                                           required="required"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="help-block">Phone</label>
                                    <input type="tel" id="phone" name="phone" placeholder="Phone number"
                                           title="Phone input box" class="form-control" value="<?php echo $phone ?>"
                                           pattern="[0-9]*"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="dob" class="help-block">Date of Birth (yyyy-mm-dd)</label>
                                    <input type="date" id="dob" name="dob" placeholder="yyyy-mm-dd"
                                           title="yyyy-mm-dd" class="form-control"
                                           value="<?php echo $dob ?>"
                                           required
                                           pattern="\d{4}-([1][0-2]|([0][1-9]))-([1-2][0-9]|([3][0,1])*|([0]?[1-9])){1,2}"
                                           onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sex" class="help-block">Sex</label>
                                    <label for="male">Male </label>
                                    <input type="radio" name="sex" title="Male" value="male"
                                           required <?php echo ($sex == 'male') ? 'checked="checked"' : '' ?>>
                                    <label for="female">Female </label>
                                    <input type="radio" name="sex" title="female"
                                           value="female" <?php echo ($sex == 'female') ? 'checked="checked"' : '' ?>
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="marital" class="help-block">Marital status</label>
                                    <label for="single">Single </label>
                                    <input type="radio" name="marital" id="single" title="Single" value="single"
                                           required <?php echo ($marital == 'single') ? 'checked="checked"' : '' ?> />
                                    <label for="married">Married </label>
                                    <input type="radio" name="marital" id="married" title="married" value="married"
                                           required <?php echo ($marital == 'married') ? 'checked="checked"' : '' ?> />
                                </div>
                                <div class="form-group">
                                    <label for="marital" class="help-block">Highest education</label>
                                    <select name="edulevel" class="form-control" id="edulevel" required
                                            title="Highest educational level">
                                        <optgroup label="Level">
                                            <option value="">---</option>
                                            <option value="1"<?php echo ($edulevel == 1) ? 'selected' : '' ?>>
                                                High school
                                            </option>
                                            <option value="2">Bachelors</option>
                                            <option value="3">Masters</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="school" class="help-block">School</label>
                                    <select name="school" class="form-control" id="school" required title="School">
                                        <optgroup label="School">
                                            <option value="">---</option>
                                            <option value="uniport" <?php echo ($school == "uniport") ? 'selected' : '' ?>>
                                                University of Port Harcourt, Rivers
                                            </option>
                                            <option value="uniuyo">University of Uyo, Akwa Ibom</option>
                                            <option value="unijos">University of Jos, Jos</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="field" class="help-block">Field of study</label>
                                    <select name="field" class="form-control" id="field" required title="Field">
                                        <optgroup label="Field of study">
                                            <option value="">---</option>
                                            <option value="computer" <?php echo ($field == "computer") ? 'selected' : '' ?>>
                                                Computer science
                                            </option>
                                            <option value="uniuyo">Engineering</option>
                                            <option value="unijos">Education</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nation" class="help-block">Nationality</label>
                                    <select name="nation" class="form-control" id="nation" required
                                            title="Nationality">
                                        <optgroup label="School">
                                            <option value="">---</option>
                                            <option value="nigeria" <?php echo ($nation == "nigeria") ? 'selected' : '' ?>>
                                                Nigeria
                                            </option>
                                            <option value="usa">USA</option>
                                            <option value="uk">UK</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="state" class="help-block">State</label>
                                    <select name="state" class="form-control" id="state" required title="state">
                                        <optgroup label="state">
                                            <option value="">---</option>
                                            <option value="akwa ibom" <?php echo ($state == "aks") ? 'selected="selected"' : '' ?>>
                                                AKS
                                            </option>
                                            <option value="rivers">Rivers</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city" class="help-block">City</label>
                                    <select name="city" class="form-control" id="city" required title="city">
                                        <optgroup label="city">
                                            <option value="">---</option>
                                            <option value="uyo" <?php echo ($state == "aks") ? 'selected="selected"' : '' ?>>
                                                Uyo
                                            </option>
                                            <option value="port harcourt">PH</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="zipcode" class="help-block">Zipcode</label>
                                    <input type="text" name="zipcode" id="zipcode" maxlength="6"
                                           placeholder="Zipcode"
                                           value="<?php echo $zipcode ?>"/>
                                </div>
                                <input type="hidden" name="type" value="student"/>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success" name="register" value="Register">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }
    ?>
</header>


<script type="text/javascript">

    document.addEventListener("DOMContentLoaded", function () {

        // JavaScript form validation

        var checkPassword = function (str) {
            var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
            return re.test(str);
        };

        var checkForm = function (e) {
            if (this.username.value === "") {
                alert("Error: Username cannot be blank!");
                this.username.focus();
                e.preventDefault(); // equivalent to return false
                return;
            }
            re = /^[a-zA-Z0-9]*@\w+.\w+$/;
            if (!re.test(this.email.value)) {
                alert("Error: Email format mail@domain!");
                this.email.focus();
                e.preventDefault();
                return;
            }
            re = /^\d{4}-([1][0-2]|([0][1-9]))-([1-2][0-9]|([3][0,1])*|([0]?[1-9])){1,2}/;
            if (!re.test(this.dob.value)) {
                alert("Error: Date of birth must be in the format mm/dd/yyyy!");
                this.dob.focus();
                e.preventDefault();
                return;
            }
            re = /^\w+$/;
            if (!re.test(this.username.value)) {
                alert("Error: Username must contain only letters, numbers and underscores!");
                this.username.focus();
                e.preventDefault();
                return;
            }
            if (form.pass1.value !== "" && form.pass1.value === form.pass2.value) {
                if (!checkPassword(this.pass1.value)) {
                    alert("The password you have entered is not valid!");
                    this.pass1.focus();
                    e.preventDefault();
                    return;
                }
            } else {
                alert("Error: Please check that you've entered and confirmed your password!");
                form.pass1.focus();
                return false;
            }
            this.register.disabled = true;
            return true;
        };

        var myForm = document.getElementById("register_std");
        myForm.addEventListener("submit", checkForm, true);

        // HTML5 form validation

        var supports_input_validity = function () {
            var i = document.createElement("input");
            return "setCustomValidity" in i;
        };

        if (supports_input_validity()) {
            var usernameInput = document.getElementById("username");
            usernameInput.setCustomValidity(usernameInput.title);

            var pass1Input = document.getElementById("pass1");
            pass1Input.setCustomValidity(pass1Input.title);

            var pass2Input = document.getElementById("pass2");
            var dobInput = document.getElementById("dob");

            // polyfill for RegExp.escape
            if (!RegExp.escape) {
                RegExp.escape = function (s) {
                    return String(s).replace(/[\\^$*+?.()|[\]{}]/g, '\\$&');
                };
            }
            // input key handlers

            usernameInput.addEventListener("keyup", function (e) {
                usernameInput.setCustomValidity(this.validity.patternMismatch ? usernameInput.title : "");
            }, false);

            pass1Input.addEventListener("keyup", function (e) {
                this.setCustomValidity(this.validity.patternMismatch ? pass1Input.title : "");
                if (this.checkValidity()) {
                    pass2Input.pattern = RegExp.escape(this.value);
                    pass2Input.setCustomValidity(pass2Input.title);
                } else {
                    pass2Input.pattern = this.pattern;
                    pass2Input.setCustomValidity("");
                }
            }, false);

            pass2Input.addEventListener("keyup", function (e) {
                this.setCustomValidity(this.validity.patternMismatch ? pass2Input.title : "");
            }, false);

        }

    }, false);

</script>
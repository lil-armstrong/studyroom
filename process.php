<?php
require_once 'required.php';

$login_error = '';
$register = isset($_POST{'register'}) ? $_POST{'register'} : '';
$insert = [];
$login = isset($_POST{'login'}) ? $_POST{'login'} : '';

$login_user = isset($_POST{'user'}) ? $_POST{'user'} : '';
$login_pass = isset($_POST{'pass'}) ? $_POST{'pass'} : '';
$msg = isset($_GET{'msg'}) ? $_GET{'msg'} : '';

$session = isset($_SESSION{'user'}) ? $_SESSION{'user'} : 0;
$type = isset($_SESSION{'type'}) ? $_SESSION{'type'} : 0;
$page = '';

$user = new User($db);


if ($login) {
    if ($user->loginUser($login_user, $login_pass)) {
        echo "<script>";
        echo "window.location.replace('index.php');";
        echo "</script>";
    }
}
//echo "<pre>";
//print_r($_SESSION);
//echo "<pre>";
//exit();

/*If the user session is set*/
if ($session) {
//    $user->createUser($session);
    //    Check user type
    if ($type === 'student') {
        $user = new Student($db);
        $type = "student";
    } elseif ($type === 'tutor') {
        $user = new Tutor($db);
        $type = "tutor";
    }
    $user->createUser($session, $type);
    /*Get all details about the current user*/
    $query = "SELECT * FROM $type WHERE username='" . $session . "' ";
    $details = $db->querySQLi($query, [])->fetchAll(2);
    /*Get all ... TODO*/
    $switch = ($type === "student") ? "tutor" : "student";
    /*End of getting user data*/
}


//for registration--Order matters
$insert["username"] = $username = isset($_POST{'username'}) ? $_POST{'username'} : '';
$insert["firstname"] = strtolower($firstname = isset($_POST{'firstname'}) ? $_POST{'firstname'} : '');
$insert["middlename"] = strtolower($middlename = isset($_POST{'middlename'}) ? $_POST{'middlename'} : '');
$insert["lastname"] = strtolower($lastname = isset($_POST{'lastname'}) ? $_POST{'lastname'} : '');
$insert["sex"] = strtolower($sex = isset($_POST{'sex'}) ? $_POST{'sex'} : '');
$insert["dob"] = strtolower($dob = isset($_POST{'dob'}) ? $_POST{'dob'} : '');
$insert["marital"] = strtolower($marital = isset($_POST{'marital'}) ? $_POST{'marital'} : '');
$insert["edulevel"] = strtolower($edulevel = isset($_POST{'edulevel'}) ? $_POST{'edulevel'} : '');
$insert["school"] = strtolower($school = isset($_POST{'school'}) ? $_POST{'school'} : '');
$insert["field"] = strtolower($field = isset($_POST{'field'}) ? $_POST{'field'} : '');
$insert["city"] = strtolower($city = isset($_POST{'city'}) ? $_POST{'city'} : '');
$insert["state"] = strtolower($state = isset($_POST{'state'}) ? $_POST{'state'} : '');
$insert["nation"] = strtolower($nation = isset($_POST{'nation'}) ? $_POST{'nation'} : '');
$insert["zipcode"] = strtolower($zipcode = isset($_POST{'zipcode'}) ? $_POST{'zipcode'} : '');
$insert["email"] = $email = isset($_POST{'email'}) ? $_POST{'email'} : '';
$insert["phone"] = $phone = isset($_POST{'phone'}) ? $_POST{'phone'} : '';
$insert["type"] = $type = strtolower($type = isset($_POST{'type'}) ? $_POST{'type'} : '');
$pass1 = isset($_POST{'pass1'}) ? $_POST{'pass1'} : '';
$pass2 = isset($_POST{'pass2'}) ? $_POST{'pass2'} : '';
/*End registration params*/


if ($register) {
    if (trim($username) === "") {
//        username error
        $errors->addErrors('username error');
    }
    if (trim($firstname) === "" || trim($middlename) === "" || trim($lastname) === "") {
//        firstname, middlename, lastname error
        $errors->addErrors('empty name field error');
    }
    if (trim($email) === "") {
//        email error
        $errors->addErrors("invalid email error");
    }
    if (!empty($phone) && is_string($phone)) {
//        phone error
        $errors->addErrors("invalid phone numeber");
    }
    if (trim($pass1) !== trim($pass2)) {
//       Password confirmation error
        $errors->addErrors("mismatch passwords error");
    } else
        $insert["pass"] = $pass1 = isset($_POST{'pass1'}) ? $_POST{'pass1'} : '';

    $dob2 = explode('-', $dob);

    if (!checkdate($dob2{1}, $dob2{2}, $dob2{0}) || !count($dob2)) {
//        dob error
        $errors->addErrors("invalid date error");
    }

    /*if there are no registration errors*/
    if (!$errors->ErrorExist()) {
//       FORMAT: `uid`,`username`,`firstname`,`middlename`,`lastname`,`sex`,`dob`,`marital_status` ,`edulevel` ,`school`,`field`,`city`,`state`,`nationality`,`zipcode`,`pass`,`email`,`phone`,`type`, `create_dt`,`last_login`
//        $fields = implode("','", $insert);
//        $query = "INSERT INTO " . $db->getDbName() . ".{$type} (`uid`, `username`, `firstname`, `middlename`, `lastname`, `sex`, `dob`, `marital_status`, `edulevel`, `school`, `field`, `city`,`state`, `nationality`, `zipcode`,  `email`,`phone`, `type`, `pass`, `create_dt`, `last_login`) VALUES(NULL, '{$fields}', NOW(), NULL)";
//        echo $query;
        $user->registerUser($insert, $type);
    }
}



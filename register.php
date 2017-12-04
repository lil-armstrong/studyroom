<?php
require_once 'process.php';
require_once 'header.php';
$confirm = '';
if(!$errors->ErrorExist()){
    $confirm = TRUE;
}
?>

<body>

<div class="container-fluid">
    <?php

    if(!$confirm) {
        include_once 'navbar.php';
        echo "<div class=\"margin-top-xl alert alert-danger text-center pad-lg not-rounded\">
                        <i class=\"fa fa-info-circle\"> </i> Please there were error while registering.
                    </div>";
    }
    ?>
    <div class="container pad-top-lg">
        <?php
//        print_r($_POST);
        if ($confirm === TRUE) {
            $msg = " A confirmation email has been sent to mail.";
            echo "<script>";
            echo "window.location.replace('index.php?msg=".urlencode($msg)."');";
            echo "</script>";
        }
        ?>

    </div>
    <hr>
    <?php
//    include_once 'footer.php';
    include_once 'inc-js.php';
    ?>
</body>

</html>
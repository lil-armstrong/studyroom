<?php
require_once 'header.php';
if (!isset($error404))
    $error404 = "Wrong navigation. Looking for help?<br><p>Contact the<a href='index.php'>webmasters</a>
";
else
    $error404 .= "<p>Contact the<a href='index.php'>webmasters</a>
";
echo "<body>";
echo "<div class='container-fluid'>
    <div class='container pad-lg text-center'>
        <p>Page:<i class='text-info'> " . ($_SERVER["PHP_SELF"]) . "</i> says:</p>
        <p>
        <i class='fa fa-info-circle text-danger'>&nbsp;</i>{$error404}
        </p>
        <hr>
        <p style='font-size: 5em; padding: .5em; margin: 0;  '><span class='text-danger'>404 </span></p>
        <p style='font-size: 2em; padding: .5em  '>Page not Found</p>
        <hr>
            <span class='pull-right'>
                <a href=\"index.php\"><i class='fa fa-chevron-circle-left font-xlg'>&nbsp;</i></a>
                Back to home
            </span>
        </p>
    </div>
</div>";

echo "</body>
</html>";
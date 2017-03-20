<?php


include("lib/db.class.php");
include_once "config.php";


// Open the base (construct the object):
$db = new DB($config['database'], $config['host'], $config['username'], $config['password']);

# Note that filters and validators are separate rule sets and method calls. There is a good reason for this.

require "lib/gump.class.php";

$gump = new GUMP();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>POSNIC - Store Logo</title>

    <!-- Stylesheets -->

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cmxform.css">
    <link rel="stylesheet" href="js/lib/validationEngine.jquery.css">

    <!-- Scripts -->
    <script src="js/lib/jquery.min.js" type="text/javascript"></script>
    <script src="js/lib/jquery.validate.min.js" type="text/javascript"></script>

    <script>
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/

        $(document).ready(function () {

            // validate signup form on keyup and submit
            $("#login-form").validate({
                rules: {
                    name: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please Enter The Answer"
                    }
                }
            });

        });

    </script>

    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

<!--    Only Index Page for Analytics   -->

<!-- TOP BAR -->
<div id="top-bar">

    <div class="page-full-width">

        <!--<a href="#" class="round button dark ic-left-arrow image-left ">See shortcuts</a>-->

    </div>
    <!-- end full-width -->

</div>
<!-- end top-bar -->


<!-- HEADER -->
<div id="header">

    <div class="page-full-width cf">

        <div id="login-intro" class="fl">

            <h1> Forgot your password </h1>


        </div>
        <!-- login-intro -->

        <!-- Change this image to your own company's logo -->
        <!-- The logo will automatically be resized to 39px height. -->
        <a href="#" id="company-branding" class="fr"><img src="<?php if (isset($_SESSION['logo'])) {
                echo "upload/" . $_SESSION['logo'];
            } else {
                echo "upload/posnic.png";
            } ?>" alt="Point of Sale"/></a>

    </div>
    <!-- end full-width -->

</div>
<!-- end header -->


<!-- MAIN CONTENT -->
<div id="content">

    <?php if (isset($_POST['submit']) and isset($_POST['name'])){ ?>
    <fieldset style="margin-left: 600px"><p><?php
            $name = $_POST['name'];
            $count = $db->queryUniqueValue("select sum(id) FROM stock_user where answer ='" . $name . "'");

            if ($count > 0){
            $line = $db->queryUniqueObject("SELECT * FROM stock_user where answer ='" . $name . "'");

            echo " User Name: <strong style=color:blue> $line->username </strong> <br><br>";
            echo " Password: <strong style=color:blue>  $line->password </strong> ";
            ?>
            <br> <br> <br> <a href="index.php" class="button blue round side-content">Dashboard</a>
        <?php
        } else {
            $data = "Answer Is Wrong";
            echo "<script>window.location = 'forget_pass.php?msg=$data';</script>";
        }
        echo "</p></fieldset>";
        } else {

            ?>
            <fieldset>
            <p style="margin-left: 600px;color: red;font-size: 20px"> <?php

                if (isset($_REQUEST['msg'])) {

                    $msg = $_REQUEST['msg'];
                    echo $msg;
                }
                ?>

            </p>

            <form action="forget_pass.php" method="POST" id="login-form" class="cmxform" enctype="multipart/form-data">
                What's your favorite movie?
                <input type="text" name="name" id="name" class="round full-width-input"><br><br>
                <input type="submit" name="submit" value="Submit" class="button round blue image-right ic-right-arrow">
                <a href="index.php" class="button blue round side-content">Dashboard</a>
            </form>
            </fieldset>
        <?php } ?>

</div>
<!-- end content -->


<!-- FOOTER -->
<div id="footer">
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=286371564842269";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <div id="fb-root"></div>
    <div class="fb-like" data-href="https://www.facebook.com/posnic.point.of.sale" data-width="450"
         data-show-faces="true" data-send="true"></div>
    <div class="g-plusone" data-href="https://plus.google.com/u/0/107268519615804538483"></div>
    <script type="text/javascript">
        (function () {
            var po = document.createElement('script');
            po.type = 'text/javascript';
            po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(po, s);
        })();
    </script>
    <p>Any Queries email to <a href="mailto:sridhar.posnic@gmail.com?subject=Stock%20Management%20System">sridhar.posnic@gmail.com</a>.
    </p>


</div>
<!-- end footer -->

</body>
</html>


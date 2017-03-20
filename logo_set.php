<?php session_start();

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>POS- Store Logo</title>

    <!-- Stylesheets -->

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cmxform.css">
    <!--<link rel="stylesheet" href="js/lib/validationEngine.jquery.css">-->

    <!-- Scripts -->
    <script src="js/lib/jquery.min.js" type="text/javascript"></script>
    <script src="js/lib/jquery.validate.min.js" type="text/javascript"></script>
    <script src="js/logo_set.js"></script>

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

            <h1>Upload Logo </h1>


        </div>
        <!-- login-intro -->

        <!-- Change this image to your own company's logo -->
        <!-- The logo will automatically be resized to 39px height. -->
        <a href="#" id="company-branding" class="fr"><img src="<?php if (isset($_SESSION['logo'])) {
                echo "upload/" . $_SESSION['logo'];
            } else {
                echo "upload/samplelogo.jpeg";
            } ?>" alt="Point of Sale"/></a>

    </div>
    <!-- end full-width -->

</div>
<!-- end header -->

<?php if (isset($_POST['submit'])) {

    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 20000)
        && in_array($extension, $allowedExts)
    ) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
        } else {
            $upload = $_FILES["file"]["name"];
            $type = $_FILES["file"]["type"];


            if (isset($_SESSION['logo'])) {
                echo "upload/" . $_SESSION['logo'];
            } else {
                echo "upload/posnic.png";
            }
            if (file_exists("upload/" . $_FILES["file"]["name"])) {

                //echo $_FILES["file"]["name"] . " already exists. ";
            } else {

                $name = 'posnic.png';
                move_uploaded_file($_FILES["file"]["tmp_name"],
                    "images/" . $name);
                //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
                $upload;
                include("lib/db.class.php");

                $host = $_SESSION['host'];
                $user = $_SESSION['user'];
                $pass = $_SESSION['pass'];
                $name = $_SESSION['db_name'];
                // Open the base (construct the object):
                $db = new DB($name, $host, $user, $pass);

                # Note that filters and validators are separate rule sets and method calls. There is a good reason for this.

                require "lib/gump.class.php";
                $db->query("UPDATE store_details  SET log ='" . $upload . "',type='" . $type . "'");
                echo "<script>window.location = 'index.php';</script>";
            }
        }
    } else {
        echo "<p  style='color:red;margin-left:550px;font-size:20px' >Invalid file</p>";
    }
}

?>


<!-- MAIN CONTENT -->
<div id="content">

    <form action="" method="POST" id="login-form" class="cmxform" enctype="multipart/form-data">
        <label for="file">Filename:</label>
        <input type="file" name="file" id="file"><br>
        <input type="submit" name="submit" value="Submit" class="button round blue image-right ic-right-arrow">
    </form>

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


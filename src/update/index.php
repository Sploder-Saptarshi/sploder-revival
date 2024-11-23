<?php
$version = file_get_contents('currentversion.txt');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../content/head.php'); ?>

    <link rel="stylesheet" type="text/css" href="update.css" />


    <?php include('../content/onlinecheck.php'); ?>


    <script type="text/javascript">
    var _sf_startpt = (new Date()).getTime()
    </script>

    <script src="update.js"></script>



</head>
<?php include('../content/addressbar.php'); ?>

<body id="home" class="">

    <div id="main">

        <div id="page">
            <div id="content">
                <div id="new_status" class="get_started">

                    <h4>Welcome to the Sploder Launcher Upgrade wizard</h4>
                    <p> Sploder Launcher has updated to version <code><?= $version ?></code>.<br>To continue using
                        Sploder Launcher, you must upgrade.<br><br>
                    </p>

                    <ul class="actions">


                        <a href="">
                            <li>
                                Close
                            </li>
                        </a>
                        <a onclick="start_download()" href="#">
                            <li>
                                Download
                            </li>
                        </a>
                    </ul><br><br><br><br>
                    <div style="display:none" id="progress-container" class="progress-container">
                        <div class="progress-bar" id="progress-bar"></div>
                    </div>
                </div>

                <div class="finished" id="finished" style="display:none">
                    <b>
                        <p>&nbsp;&nbsp;&nbsp;The update has been downloaded<br>To install it, click save and run the
                            file</p>
                    </b>
                </div>


            </div>
        </div>
    </div>
</body>

</html>
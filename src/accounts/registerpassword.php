<?php
session_start();
if (!isset($_SESSION['usermigrate'])) {
    header('Location: register.php?err=ses');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../content/head.php'); ?>

    <link rel="stylesheet" type="text/css" href="splodersimple.css" />
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <link rel="stylesheet" type="text/css" href="/slider/nivo-slider.css" />
    <link rel="stylesheet" type="text/css" href="/slider/sploder/style_v2p10.css" />
    <?php include('../content/onlinecheck.php'); ?>
    <script type="text/javascript" language="Javascript">
    <!-- // 
    function CheckData() {



        if (!document.form.tostest.checked) {

            alert("You must agree to the terms of service.");

            return false;

        }





        if (document.form.pass1.value.length < 8) {

            alert("Enter a password at least 8 characters long.");

            document.form.pass1.focus();

            return false;

        }




        if (document.form.pass1.value !== document.form.pass2.value) {

            alert("Your confirmed password does not match the entered password.");

            document.form.pass2.focus();

            return false;

        }



        return true;

    }



    var delayed_id;



    function checkUsername() {

        var img = document.getElementById("usernamecheck");

        img.src = "/images/working.gif";

        if (delayed_id > 0) clearTimeout(delayed_id);

        delayed_id = setTimeout(performCheck, 2000);

    }



    function performCheck() {

        var img = document.getElementById("usernamecheck");

        var input = document.getElementById("username");

        img.src = "/php/usernamecheck.php?u=" + input.value;

        if (delayed_id > 0) clearTimeout(delayed_id);

    }



    //
    -->

    </script>

</head>
<?php include('../content/addressbar.php'); ?>

<body id="home" class="">


    <div id="main">
        <div id="header">
            <a>
                <div id="title">
                    <h1><a title="Sploder"><img style="margin-top:-20px; height: 130px" src="/chrome/logo.png"><span
                                class="hide">Games at Sploder</span></a></h1>
                </div>
                <div id="tools"></div>
            </a>
        </div>
        <div id="page">
            <div id="content">
                <h3>Almost there!</h3>
                <p style="font-size: 120%; line-height: 160%;">
                </p>


                <script>
                window.onload = function() {
                    document.getElementById("username").focus();
                }
                </script>

                <div class="textform">
                    <form name="form" action="registerdatabase.php" method="post" onsubmit="return CheckData()">
                        <table cellpadding="4">
                            <tr>
                                <td>Password</td>
                                <td colspan="2"><input type="password" name="pass1"
                                        placeholder="At least 8 letters or numbers..." maxlength="25" /></td>
                            </tr>
                            <tr>
                                <td>Confirm Password</td>
                                <td colspan="2"><input type="password" name="pass2"
                                        placeholder="Enter your password again..." maxlength="25" /></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="display: none;">
                                    <div class="checkholder">
                                        <!-- TODO: ACTUALLY USE THIS CHECKBOX -->
                                        <input style="display:none" name="social" type="checkbox" class="checkbutton"
                                            value="1" checked="checked" />
                                    </div>
                                    <p>Allow comments and friending on my profile.</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="checkholder">
                                        <input name="tostest" type="checkbox" class="checkbutton" value="1" />
                                    </div>
                                    <p>I agree to abide by the terms of service</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="recaptcha">
                                    <div>
                                        <!-- TODO: CHANGE SITEKEY ASAP TO CORRECT ONE -->
                                        <?php
                                        require_once('../config/env.php');
                                        ?>
                                        <div class="cf-turnstile" data-theme="dark"
                                            data-sitekey="<?= getenv("CF_TURNSTILE_SITE_KEY") ?>"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td align="center" colspan="3">
                                    <input type="submit" name="Submit" class="postbutton" value="Register " /> &nbsp;
                                    &nbsp; &nbsp;
                                    <input type="reset" name="Reset" class="postbutton" value="Reset" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="spacer">&nbsp;</div>
            </div>
            <div class="spacer">&nbsp;</div>
        </div>
    </div>
    <div id="bottomnav">
    </div>





</body>

</html>
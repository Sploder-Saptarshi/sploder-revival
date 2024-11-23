<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../content/head.php'); ?>

    <link rel="stylesheet" type="text/css" href="splodersimple.css" />

    <link rel="stylesheet" type="text/css" href="/slider/nivo-slider.css" />
    <link rel="stylesheet" type="text/css" href="/slider/sploder/style_v2p10.css" />
    <?php include('../content/onlinecheck.php'); ?>
    <script type="text/javascript" language="Javascript">
    <!-- //
    function CheckData() {


        if (document.form.username.value.length <= 0) {

            alert("Enter a username.");

            document.form.username.focus();

            return false;

        }

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
            <a href="/">
                <div id="title">
                    <h1><a title="Sploder"><img style="margin-top:-20px; height: 130px" src="/chrome/logo.png"><span
                                class="hide">Games at Sploder</span></a></h1>
                </div>
                <div id="tools"></div>
            </a>
        </div>
        <div id="page">
            <div id="content">
                <h3>Join Sploder Revival!</h3>
                <p style="font-size: 120%; line-height: 160%;">
                    Membership is absolutely free! Just fill out the form below. Please be sure you understand our
                    privacy
                    policy
                    and <strong>do not enter or share any personal information</strong> with anyone on Sploder Revival.
                </p>

                <script>
                window.onload = function() {
                    document.getElementById("username").focus();
                }
                </script>

                <div class="textform">
                    <?php
                    $err = $_GET['err'];
                    $errorMsg = '';

                    if (isset($err)) {
                        switch ($err) {
                            case "reg":
                                $errorMsg = 'This username seems to have already been registered. Please use another one or log in!';
                                break;

                            case "dis":
                                $errorMsg = 'You could not prove ownership of this account via discord. Please use another username or try another discord account!';
                                break;

                            case "not":
                                $errorMsg = 'This username could not be registered. Please try again with a different one!';
                                break;

                            case "can":
                                $errorMsg = 'You clicked the cancel button which cancelled the migration. Please retry.';
                                break;

                            case "ses":
                                $errorMsg = 'There was an error while processing your info. Please retry.';
                                break;

                            case "cap":
                                $errorMsg = 'There was an error solving the captcha. Please retry.';
                                break;

                            case "unk":
                                $errorMsg = 'An unknown error occurred. Please retry.';
                                break;

                            case "acc":
                                $errorMsg = 'This account already exists! Please choose another username.';
                                break;
                            case "inv":
                                $errorMsg = 'This username is invalid. Please choose another username.';
                                break;
                        }
                    }

                    if (!empty($errorMsg)) {
                        echo '<p class="alert">' . $errorMsg . '</p>';
                    }
                    ?>
                    <form name="form" action="migrationcheck.php" method="post" onsubmit="return CheckData()">
                        <table cellpadding="4">
                            <tr>
                                <td>Username</td>
                                <td><input type="text" name="username" id="username" class="username_input"
                                        placeholder="Not your real name..." autocomplete="off" autocorrect="off"
                                        autocapitalize="off" spellcheck="false" maxlength="16" autocapitalize="off"
                                        autocorrect="off" value="" onkeyup="checkUsername();" /></td>
                                <td><img valign="middle" id="usernamecheck" src="/images/idle-user.png" width="20"
                                        height="20" /> 3-16 characters.
                                </td>


                            </tr>

                            <tr>
                                <td colspan="3"></td>

                            </tr>
                            <tr>
                                <td colspan="3">A yellow warning sign symbolises that the username needs to be migrated
                                    from
                                    discord. You can click the next button to automatically start the migration process.
                                </td>

                            </tr>
                            <tr>
                                <td colspan="3">A red cross sign symbolises that the username has been taken or is
                                    invalid.
                                </td>

                            </tr>
                            <tr>
                                <td colspan="3">A green check sign symbolises that the username can be registered
                                    without
                                    issues!
                                </td>

                            </tr>
                            <tr>
                                <td colspan="3">
                                    <hr />
                                </td>
                            </tr>
                            <tr>
                                <td align="center" colspan="3">
                                    <input type="submit" name="Submit" class="postbutton" value="Next &raquo;" /> &nbsp;
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
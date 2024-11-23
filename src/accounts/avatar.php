<?php include('../content/logincheck.php') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../content/head.php'); ?>
    <link rel="stylesheet" type="text/css" href="../css/sploder_v2p22.min.css" />
    <link rel="stylesheet" href="../css/friends2.css">
    <script type="text/javascript">
    var _sf_startpt = (new Date()).getTime()
    </script>
    <script type="text/javascript" src="../common/jquery-3.7.1.min.js"></script>


    <!--[if IE 6]>
<link rel="stylesheet" type="text/css"  href="/awards/css/ie6.css" />
<![endif]-->

    <!--[if IE 7]>
<link rel="stylesheet" type="text/css"  href="/awards/css/ie7.css" />
<![endif]-->
    <?php include('../content/onlinecheck.php'); ?>


</head>
<?php include('../content/addressbar.php'); ?>

<body id="awardsmanager" class="">
    <?php include('../content/headernavigation.php'); ?>


    <div id="page">
        <div id="subnav">
            <ul class="nav_dashboard">
                <li><a href="/">Home</a></li>
                <li><a href="../dashboard/my-games.php">My Games</a></li>
                <li><a href="../dashboard/profile-edit.php" class="active">Profile</a></li>
                <li><a href="/friends/index.php">Friends</a></li>
                <li><a href="groups/">Groups</a></li>
                <li><a href="/awards/index.php">Awards</a></li>
                <li><a href="/tournaments/index.php" style="display: none;">Tournaments</a></li>
                <li><a href="my-graphics.php">Graphics</a></li>
                <li style="float: right;"><a href="/accounts/account.php">My Account</a></li>
            </ul>
        </div>
        <div id="content">
            <h3>My Avatar</h3>
            <p>Make your own Sploder avatar. Change the settings below and click <em>SAVE AVATAR</em> to save your new
                creation. If you really want to spice up your avatar, create a <a
                    href="/accounts/avatar.php?set=2">Premium Avatar!</a></p>
            <div id="rpc_messages"></div>
            <div id="avatar_editor">
                <input type="hidden" name="avatar_style" id="avatar_settings" value="000001_000033">
                <input type="hidden" name="avatar_set" id="avatar_set" value="">
                <div id="avatar">
                    <div id="layers">
                        <div class="layer layer_01" style="background-position: 0px 0px;"></div>
                        <div class="layer layer_02" style="background-position: 0px 0px;"></div>
                        <div class="layer layer_03" style="background-position: 0px 0px;"></div>
                        <div class="layer layer_04" style="background-position: 0px 0px;"></div>
                        <div class="layer layer_05" style="background-position: 0px -288px;"></div>
                        <div class="layer layer_06" style="background-position: 0px -288px;"></div>
                        <div class="layer layer_07"></div>
                    </div>
                </div>
                <div id="controls">
                    <div id="control_01" class="control">
                        <label>Skin Style</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller"
                            name="layer_01" value="up">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller"
                            name="layer_01" value="down">
                        <label>Skin Color</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller"
                            name="layer_01" value="prev">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller"
                            name="layer_01" value="next">
                    </div>
                    <div id="control_02" class="control">
                        <label>Mouth Style</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller"
                            name="layer_02" value="prev">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller"
                            name="layer_02" value="next">
                    </div>
                    <div id="control_03" class="control">
                        <label>Nose Style</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller"
                            name="layer_03" value="prev">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller"
                            name="layer_03" value="next">
                    </div>
                    <div id="control_04" class="control">
                        <label>Eye Style</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller"
                            name="layer_04" value="prev">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller"
                            name="layer_04" value="next">
                        <label>Eye Color</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller"
                            name="layer_04" value="up">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller"
                            name="layer_04" value="down">
                    </div>
                    <div id="control_05" class="control">
                        <label>Hair Style</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller"
                            name="layer_05" value="prev">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller"
                            name="layer_05" value="next">
                        <label>Hair Color</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller"
                            name="layer_05" value="up">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller"
                            name="layer_05" value="down">
                    </div>
                    <div id="control_06" class="control">
                        <label>Extras Choice</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller"
                            name="layer_06" value="prev">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller"
                            name="layer_06" value="next">
                        <label>Extras Color</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller"
                            name="layer_06" value="up">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller"
                            name="layer_06" value="down">
                    </div>
                    <div class="clear"></div>
                </div>
                <input type="image" src="/avatar/avatar_controls_save.gif" id="control_save" name="save" value="save">
                <input type="image" src="/avatar/avatar_controls_reset.gif" id="control_reset" class="controller"
                    name="reset" value="reset">
                <div class="clear"></div>
            </div>

            <div class="promo gamerating"><span>This avatar maker was created by malware8148! Please report any bugs or
                    issues to him. This should function just like Sploder's original avatar maker.</span></div>
            <div class="buttons">
                <span class="button firstbutton"><a href="?set=2">Make a Premium Avatar »</a></span>
            </div>
            <div class="spacer">&nbsp;</div>

            <div style="width:100%;height:30px;">
            </div>
        </div>
        <?php include('../content/footernavigation.php') ?>

        <input type="hidden" id="newURL" size="40" value="https://sploder.xyz/classic-0">
    </div>
    </div>



    <script>
    type = "classic";


    var styles = JSON.parse(localStorage.getItem("styles"));
    if (styles == null) {
        styles = [0, 0, 0, 0, 0, 0];
        localStorage.setItem("styles", JSON.stringify(styles));
    }
    var styles_max = [9, 0, 0, 9, 9, 9];

    var colors = JSON.parse(localStorage.getItem("colors"));
    if (colors == null) {
        colors = [0, 0, 0, 0, 0, 0];
        localStorage.setItem("colors", JSON.stringify(colors));
    }
    var colors_max = [19, 19, 19, 19, 19, 19];

    if (getUrlParameter("set") == "2") {
        for (i = 0; i < styles.length; i++) {
            $(".layer_0" + (i + 1)).css({
                "background": "url(/avatar/avatar_0" + (i + 1) + "_96.png.1)"
            });
        }
        type = "premium";
        $(".firstbutton a").text("Make a Classic Avatar »");
        $(".firstbutton a").attr("href", "/accounts/avatar.php");
        $("#content p").html(
            'Make your own Sploder avatar. Change the settings below and click <em>SAVE AVATAR</em> to save your new creation. If you are bored of premium avatars, go back and create a <a href="/accounts/avatar.php">Classic Avatar!</a>'
        );
    }

    updateAvatar();

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };

    function updateAvatar() {
        var url = type;
        for (i = 0; i < styles.length; i++) {
            $(".layer_0" + (i + 1)).css({
                "background-position": "-" + colors[i] * 96 + "px -" + styles[i] * 96 + "px"
            });
            url += "-" + colors[i] + "-" + styles[i]
        }
        url += "-1";
        //finalURL = "https://www.avatar.nem-creator.com/" + url;
        //$("#newURL").val(finalURL);
        $("#newURL").val("...");
        localStorage.setItem("type", type);
        localStorage.setItem("styles", JSON.stringify(styles));
        localStorage.setItem("colors", JSON.stringify(colors));

        $("#newURL").val("https://sploder.xyz/avatar/av.php?c=" + url);
    };


    async function fetchAsync(url) {
        let response = await fetch(url);
        let data = await response.json();
        return data;
    }
    $("#control_save").click(function() {
        fetchAsync($("#newURL").val());
    });

    $("#copyButton").click(function() {
        var copyText = document.getElementById("newURL");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        $(this).focus();
    });

    $(".controller").click(function() {
        var controller = $(this).parent().attr("id").slice(-2) - 1;
        if ($(this).attr("value") == "down") {
            if (styles_max[controller] > styles[controller]) {
                styles[controller] += 1;
            } else {
                styles[controller] = 0;
            }
        } else if ($(this).attr("value") == "up") {
            if (styles[controller] > 0) {
                styles[controller] -= 1;
            } else {
                styles[controller] = styles_max[controller];
            }
        } else if ($(this).attr("value") == "next") {
            if (colors_max[controller] > colors[controller]) {
                colors[controller] += 1;
            } else {
                colors[controller] = 0;
            }
        } else if ($(this).attr("value") == "prev") {
            if (colors[controller] > 0) {
                colors[controller] -= 1;
            } else {
                colors[controller] = colors_max[controller];
            }
        }
        if ($(this).attr("value") == "reset") {
            for (i = 0; i < styles.length; i++) {
                colors[i] = 0;
                styles[i] = 0;
            }
        }
        updateAvatar();
    });
    </script>
</body>

</html>
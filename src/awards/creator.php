<?php include('../content/logincheck.php') ?>
<?php
$membername = $_GET['membername'];
session_start();
print_r($_SESSION);
include('php/functions.php');
$level = getLevel();
$isEditor = isEditor();
$maxCustomization = getMaxCustomization($level, $isEditor);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('../content/head.php'); ?>
    <link rel="stylesheet" type="text/css" href="/css/sploder_v2p22.min.css" />
    <link rel="stylesheet" type="text/css" href="/awards/css/awards.css" />
    <link rel="stylesheet" type="text/css" href="/awards/css/awards_editor.css" />
    <link rel="stylesheet" href="css/friends2.css">

    <script type="text/javascript" src="includes/awards.js"></script>
    <!-- Include jQuery UI -->
    <script type="text/javascript" src="includes/autocomplete/lib/jquery-1.2.6.min.js"></script>
    <script type="text/javascript">
        var _sf_startpt = (new Date()).getTime()
    </script>



    <!--[if IE 6]>
<link rel="stylesheet" type="text/css"  href="/awards/css/ie6.css" />
<![endif]-->

    <!--[if IE 7]>
<link rel="stylesheet" type="text/css"  href="/awards/css/ie7.css" />
<![endif]-->


</head>

<body id="awardsmanager" class="">
    <?php include('../content/headernavigation.php'); ?>




    <div id="page">
    <div id="subnav">
			<ul class="nav_dashboard">
            <li><a href="/">Home</a></li>
            <li><a href="my-games.php">My Games</a></li>
            <li><a href="profile-edit.php">Profile</a></li>
            <li><a href="/friends/index.php">Friends</a></li>
            <li><a href="groups/">Groups</a></li>
            <li><a href="/awards/index.php" class="active">Awards</a></li>
            <li><a href="/tournaments/index.php" style="display: none;">Tournaments</a></li>
            <li><a href="my-graphics.php">Graphics</a></li>
            <li style="float: right;"><a href="/accounts/account.php">My Account</a></li>
			</ul>	
</div>

        <div id="content">
            <h3>Create an Award</h3>
            <?php
                if ($level >= 10){
            ?>
            <h5>Award to <?= $membername ?> (preview)</h5>
            <div class="award">

                <div id="avatar" style="overflow: hidden; height: 48px">
                    <style>
                        #layers_mini {
                            position: relative;
                            /* Ensure the container is positioned relatively */
                            height: 192px;
                            /* Set a height for the container */
                        }

                        .layer_mini {
                            position: absolute;
                            /* Position the layers absolutely within the container */
                            top: 0;
                            left: 0;
                            width: 96px;
                            /* Ensure the layers take up the full width of the container */
                            height: 95px;
                            /* Ensure the layers take up the full height of the container */
                            transform: scale(0.375);
                            /* Scale the layers */
                        }

                        .shine {
                            overflow: hidden;
                            transform: scale(0.625);
                            width: 96px;
                            height: 96px;
                            background-image: url('chrome/award_shine_96.gif');
                        }
                    </style>

                    <div id="layers_mini" style="overflow: hidden; margin-top:-22px; margin-left: -22px">
                        <div class="layer shine" style="display:none"></div>
                        <div class="layer_mini layer_01" style="background-position: 0px 0px;"></div>
                        <div class="layer_mini layer_02" style="background-position: 0px 0px;"></div>
                        <div class="layer_mini layer_03" style="background-position: 0px 0px;"></div>
                        <div class="layer_mini layer_04" style="background-position: 0px 0px;"></div>
                    </div>
                </div>
                <style>
                    .award_text {
                        margin-top: -35px;
                        margin-left: 60px;
                    }

                    .award_text dl {
                        margin: 0;
                        padding: 0;

                    }
                </style>
                <div class="award_text">
                    <dl>
                        <dt id="messageTitle"></dt>
                        <dd id="messageDisplay" style="margin-inline-start: 0px;"><i>no message entered</i></dd>
                    </dl>
                </div>

                <script>
                    function updateMaterial() {
                        //console.log(colors);
                    }
                    for (i = 0; i < 3; i++) {
                        $(".layer_0" + (i + 1)).css({
                            "background": "url(/awards/chrome/art_0" + (i + 1) + "_96.gif)"
                        });
                    }
                </script>
            </div>

            <h5>Award Editor:</h5>
            <!-- START CUSTOM AWARD HTML -->






            <div id="avatar_editor">
                <input type="hidden" name="avatar_style" id="avatar_settings" value="000001_000033">
                <input type="hidden" name="avatar_set" id="avatar_set" value="">
                <div id="avatar">
                    <div id="layers">
                        <div class="layer layer_01" style="background-position: 0px 0px;"></div>
                        <div class="layer layer_02" style="background-position: 0px 0px;"></div>
                        <div class="layer layer_03" style="background-position: 0px 0px;"></div>
                        <div class="layer layer_04" style="background-position: 0px 0px;"></div>
                    </div>
                </div>
                <div id="controls">
                    <div id="control_01" class="control">
                        <label>Medal Style</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller" name="layer_01" value="up">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller" name="layer_01" value="down">
                        <label>Material</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller" name="layer_01" value="prev">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller" name="layer_01" value="next">
                    </div>
                    <div id="control_02" class="control">
                        <label>Field Color</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller" name="layer_02" value="prev">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller" name="layer_02" value="next">
                    </div>
                    <div id="control_03" class="control">
                        <label>Icon</label>
                        <input type="image" src="/avatar/avatar_controls_prev.gif" class="control_prev controller" name="layer_03" value="prev">
                        <input type="image" src="/avatar/avatar_controls_next.gif" class="control_next controller" name="layer_03" value="next">
                    </div>

                    <div id="control_04" class="control">

                        <label>Category:</label>
                        <div style="margin-top:7px">
                            <select id="categorySelect">
                                <option value="">None</option>
                                <option>Challenge</option>
                                <option>Fun</option>
                                <option>Puzzle</option>
                                <option>Action</option>
                                <option>Art</option>
                                <option>Design</option>
                                <option>Story</option>
                                <option>Craftsman</option>
                                <option>Guru</option>
                                <option>Player</option>
                                <option>Friend</option>
                                <option>Respect</option>
                            </select>
                        </div>
                        <br>
                        <script>
                            var valueText = "";
                            document.getElementById('categorySelect').addEventListener('change', function() {
                                const selectedOption = this.options[this.selectedIndex];
                                var selectedValue = selectedOption.value;
                                if (selectedValue != "") {
                                    selectedValue = " " + selectedValue + " ";
                                }
                                document.getElementById('messageTitle').textContent = "Level " + level + " " + material_names[colors[0]] + selectedValue + " Award";
                                valueText = selectedValue;
                            });
                        </script>
                        <div style="margin-top: 5px">
                            <label>Message:</label>
                        </div>

                        <textarea maxlength="40" id="messageInput"></textarea>
                        <script>
                            var user_message = "";
                            document.getElementById('messageInput').addEventListener('input', function() {
                                document.getElementById('messageDisplay').textContent = this.value;
                                user_message = this.value;
                                // If this value is empty, display no message entered in italics
                                if (this.value == "") {
                                    document.getElementById('messageDisplay').innerHTML = "<i>no message entered</i>";
                                }
                            });
                        </script>
                    </div>
                    <br><br><br>
                    <div class="clear"></div>
                </div>
                <input onclick="updateAvatar()" type="image" style="height:25px;width:81px" src="/awards/chrome/savebutton.png" id="control_save" name="save" value="save">
                <input type="image" src="/avatar/avatar_controls_reset.gif" id="control_reset" class="controller" name="reset" value="reset">
                <div class="clear"></div>
            </div>

            <div class="promo gamerating"><span>This award creator was created by malware8148! Please report any bugs or issues to him. This should function just like Sploder's original award creator.</span></div>


            <br>
            <input type="hidden" id="newURL" size="40" value="">

            <script>
                type = "classic";

                valueText = "";
                var styles = JSON.parse(localStorage.getItem("styles"));
                if (styles == null) {
                    styles = [0, 0, 0, 0, 0, 0];
                    localStorage.setItem("styles", JSON.stringify(styles));
                }
                var styles_max = <?= $maxCustomization ?>;

                var colors = JSON.parse(localStorage.getItem("colors"));
                if (colors == null) {
                    colors = [0, 0, 0, 0, 0, 0];
                    localStorage.setItem("colors", JSON.stringify(colors));
                }
                var colors_max = <?= $maxCustomization ?>;

                for (i = 0; i < 3; i++) {
                    $(".layer_0" + (i + 1)).css({
                        "background": "url(/awards/chrome/art_0" + (i + 1) + "_96.gif)"
                    });
                }
                for (i = 3; i < 7; i++) {
                    $(".layer_0" + (i + 1)).css({
                        "background": "none"
                    });
                }
                type = "premium";
                var material_names = [
                    "Pewter",
                    "Iron",
                    "Alloy",
                    "Copper",
                    "Bronze",
                    "Silver",
                    "Gold",
                    "Platinum",
                ]
                const level = <?= $level ?>;
                var oldmaterial = colors[0];
                document.getElementById('messageTitle').textContent = "Level " + level + " " + material_names[colors[0]] + valueText + " Award";
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
                        currentlayer = i + 1;
                        $(".layer_0" + (i + 1)).css({
                            "background-position": "-" + colors[i] * 96 + "px -" + styles[i] * 96 + "px"
                        });
                        if (currentlayer == "1") {
                            layer1style = styles[i];
                        }
                        if (currentlayer === 1) {

                            stylevalue = styles[i] * 96;
                        }

                        if (currentlayer == "2") {
                            $(".layer_02").css({
                                "background-position": "-" + colors[i] * 96 + "px -" + stylevalue + "px"
                            });
                        }

                        if (currentlayer == "3") {

                            $(".layer_03").css({
                                "background-position": "-" + colors[i] * 96 + "px -" + stylevalue + "px"
                            });
                        }

                        if (oldmaterial != colors[0]) {
                            oldmaterial = colors[0];
                            document.getElementById('messageTitle').textContent = "Level " + level + " " + material_names[colors[0]] + valueText + " Award";
                        }

                        if (styles[0] == 7 || colors[0] == 7 || colors[2] == 7) {
                            // set style attribute of shine to display all
                            $(".shine").css({
                                "display": "block"
                            });
                        } else {
                            // set style attribute of shine to display none
                            $(".shine").css({
                                "display": "none"
                            });
                        }
                        url += "-" + colors[i] + "-" + styles[i]
                    }
                    url += "-1";
                    // Get option number selected in category and append to url
                    const categorySelect = document.getElementById('categorySelect');
                    const selectedOption = categorySelect.options[categorySelect.selectedIndex];
                    const valueText1 = selectedOption.value ? selectedOption.value : "";

                    // Get the user message
                    const user_message = document.getElementById('messageInput').value ? document.getElementById('messageInput').value : "";

                    // Append valueText and user_message to the URL
                    url += "&category=" + valueText1;

                    url += "&message=" + user_message;
                    //finalURL = "https://www.avatar.nem-creator.com/" + url;
                    //$("#newURL").val(finalURL);
                    $("#newURL").val("...");
                    localStorage.setItem("type", type);
                    localStorage.setItem("styles", JSON.stringify(styles));
                    localStorage.setItem("colors", JSON.stringify(colors));

                    $("#newURL").val("/awards/send.php?c=" + url);
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





            <!-- END CUSTOM AWARD HTML -->
                
            <a name="guide">&nbsp;</a><br />
            <h2>Awards Guide:</h2>
            <img src="/awards/chrome/award_guide.gif" title="Awards you can make at each level" alt="Awards you can make at each level" />
            <p>As you obtain higher levels on Sploder, you can make more types of awards. Above is a simple guide to the types of awards
                you can make at each level. You must be at least level 10 to make an award.</p>
            <p>Award styles are important! Award styles on the right of the list above appear before award styles on the right in member profiles,
                which means the fancier styles have a better chance of appearing in the initial listing.</p>
            <p>You can give awards to any member of any level, but the awards must be accepted by the member for them to
                appear on their profile. Keep in mind some members may choose to respectfully decline the award if they wish to
                keep their awards list tidy. Don't be offended by this, and don't worry about declining awards yourself!</p>
            <div class="spacer">&nbsp;</div>
            <?php } else { ?>
                    <p class="alert">You must be at least Level 10 to send awards.</p>
                <?php } ?>
        </div>
        <div id="sidebar">

            <br /><br /><br />
            <div class="spacer">&nbsp;</div>
        </div>
        <div class="spacer">&nbsp;</div>
        <?php include('../content/footernavigation.php'); ?>


</body>

</html>
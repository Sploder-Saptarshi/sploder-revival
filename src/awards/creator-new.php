<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('../content/head.php'); ?>
	<link rel="stylesheet" type="text/css"  href="/css/sploder_v2p22.min.css" />
	<link rel="stylesheet" type="text/css"  href="/awards/css/awards.css" />
	<link rel="stylesheet" type="text/css"  href="/awards/css/awards_editor.css" />
	<link rel="stylesheet" href="css/friends2.css">

	<script type="text/javascript" src="includes/awards.js"></script>
    <!-- Include jQuery UI -->
	<script type="text/javascript" src="includes/autocomplete/lib/jquery-1.2.6.min.js"></script>
	<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
	
	
	
<!--[if IE 6]>
<link rel="stylesheet" type="text/css"  href="/awards/css/ie6.css" />
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" type="text/css"  href="/awards/css/ie7.css" />
<![endif]-->
        

</head>

<body id="awardsmanager" class="" >
<?php include('../content/headernavigation.php'); ?>

		        


		<div id="page">
		<?php include('../content/subnav.php'); ?>

			<div id="content"><h3>Create an Award</h3>
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
            <div class="layer layer_05" style="background-position: 0px -288px;"></div>
            <div class="layer layer_06" style="background-position: 0px -288px;"></div>
            <div class="layer layer_07"></div>
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
       <br><br>
	   <label>Category:</label>
	   <select>
			<option>None</option>
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
	   <br>
	   <br>
	   <label>Message:</label>
	   <textarea></textarea>
	   <br><br>
        <div class="clear"></div>
    </div>
    <input type="image" style="height:20px;width:80px" src="/awards/chrome/savebutton.png" id="control_save" name="save" value="save">
    <input type="image" src="/avatar/avatar_controls_reset.gif" id="control_reset" class="controller" name="reset" value="reset">
    <div class="clear"></div>
</div>
    
    <div class="promo gamerating"><span>This award creator was created by malware8148! Please report any bugs or issues to him. This should function just like Sploder's original award creator.</span></div>


<br>

<script>
type = "classic";


var styles = JSON.parse(localStorage.getItem("styles"));
if (styles == null) {
    styles = [0,0,0,0,0,0];
    localStorage.setItem("styles", JSON.stringify(styles));
}
var styles_max = [7,0,0,9,9,9];

var colors = JSON.parse(localStorage.getItem("colors"));
if (colors == null) {
    colors = [0,0,0,0,0,0];
    localStorage.setItem("colors", JSON.stringify(colors));
}
var colors_max = [19,19,19,19,19,19];

    for (i = 0; i < 3; i++) {
        $(".layer_0" + (i + 1)).css({"background": "url(/awards/chrome/art_0" + (i + 1) + "_96.gif)"});
    }
    for (i = 3; i < 7; i++) {
        $(".layer_0" + (i + 1)).css({"background" : "none"});
    }
    type = "premium";


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
        currentlayer = i+1;
        $(".layer_0" + (i + 1)).css({"background-position": "-" + colors[i] * 96 + "px -" + styles[i] * 96 + "px"});
        if(currentlayer=="1"){
            layer1style = styles[i];
        }
        if (currentlayer === 1) { stylevalue = styles[i] * 96; }

            if(currentlayer=="2"){
        $(".layer_02").css({"background-position": "-" + colors[i] * 96 + "px -" + stylevalue + "px"});}

        if(currentlayer=="3"){
            
        $(".layer_03").css({"background-position": "-" + colors[i] * 96 + "px -" + stylevalue + "px"});}

    
        
        url += "-" + colors[i] + "-" + styles[i]
    }
    url += "-1";
    //finalURL = "https://www.avatar.nem-creator.com/" + url;
    //$("#newURL").val(finalURL);
    $("#newURL").val("...");
    localStorage.setItem("type", type);
    localStorage.setItem("styles", JSON.stringify(styles));
    localStorage.setItem("colors", JSON.stringify(colors));

								$("#newURL").val("https://sploder.us.to/avatar/av.php?c=" + url);
							};   


async function fetchAsync (url) {
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

			<a name="guide">&nbsp;</a><br /><h2>Awards Guide:</h2>
	<img src="/awards/chrome/award_guide.gif" title="Awards you can make at each level" alt="Awards you can make at each level" />
	<p>As you obtain higher levels on Sploder, you can make more types of awards.  Above is a simple guide to the types of awards
	you can make at each level. You must be at least level 10 to make an award.</p>
	<p>Award styles are important! Award styles on the right of the list above appear before award styles on the right in member profiles,
	which means the fancier styles have a better chance of appearing in the initial listing.</p>
	<p>You can give awards to any member of any level, but the awards must be accepted by the member for them to
	appear on their profile. Keep in mind some members may choose to respectfully decline the award if they wish to
	keep their awards list tidy. Don't be offended by this, and don't worry about declining awards yourself!</p><div class="spacer">&nbsp;</div></div>
			<div id="sidebar">

			<br /><br /><br />
				<div class="spacer">&nbsp;</div>
			</div>			
			<div class="spacer">&nbsp;</div>
			<?php include('../content/footernavigation.php'); ?>


</body>
</html>
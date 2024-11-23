<?php
if (str_contains($_SERVER['HTTP_USER_AGENT'], 'Electron')) {
?>
<style>
.topnav .search-container {
    float: none !important;
    border-top: 0px !important;
    margin: 0px !important;


}

.topnav a,
.topnav input[type=text],
.topnav .search-container button,
.urlmessage {
    border-top: 0px !important;
    border: 5px solid !important;
    transform: translate(20%, 0) !important;
    padding: 10px !important;
    float: top !important;
    display: block !important;
    justify-content: center !important;
    text-align: left !important;
    width: 70% !important;
    border-top: none !important;
    outline-width: 0 !important;
    position: fixed !important;
    background: white !important;
    color: #000000 !important;
    z-index: 99999 !important;

}

.topnav input[type=text],
.urlmessage {

    border: 1px solid #ccc !important;
    font-size: 16px;
    height: 26px;
    line-height: 18px;
    margin: 0;
    font-family: "courier new", monospace;
    font-weight: bold;
}
</style>

<div class="topnav">

    <div class="search-container">
        <form action="/php/url.php" method="post">
            <?php
        $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https')
          === FALSE ? 'http' : 'https';
        $host     = $_SERVER['HTTP_HOST'];
        $script   = $_SERVER['SCRIPT_NAME'];
        $params   = $_SERVER['QUERY_STRING'];
        if ($params == "") {
          $currentUrl = 'https://' . 'sploder.xyz' . $script;
          $currentUrl1 = 'https://' . 'sploder.xyz' . $script . '?';
        } else {
          $currentUrl = 'https://' . 'sploder.xyz' . $script . '?' . $params;
          $currentUrl1 = 'https://' . 'sploder.xyz' . $script . '?' . $params;
        }

        ?>
            <input class="urlmessage" style="" type="text" value="<?php echo $currentUrl; ?>" name="url">
            <input style="" value="<?php echo $currentUrl1; ?>" type="hidden" name="back">
            <?php if ($_GET["urlerr"] == 1) {
          echo '<p style="margin-top:45px;" class="urlmessage">You must enter a valid sploder.us.to url!</p><br><br><br>';
        } ?>
            <?php if ($_GET["err404"] == 1) {
          echo '<p style="margin-top:45px;" class="urlmessage">This URL does not exist!</p><br><br><br>';
        } ?>

        </form>
        <br><br><br>
    </div>
</div>
<?php } ?>
<?php

include_once('../database/connect.php');
$db = connectToDatabase();
$time = time();
$last = $time - 30;
$pagechange = $time - 900;
$qs2 = "SELECT username,lastlogin,lastpagechange,status FROM members WHERE lastlogin>:last ORDER BY level DESC LIMIT 15";
$statement2 = $db->prepare($qs2);
$statement2->execute(
    [
        ':last' => $last
    ]
);
$result3 = $statement2->fetchAll();
$total = count($result3);
?>
var _____WB$wombat$assign$function_____ = function(name) {return (self._wb_wombat && self._wb_wombat.local_init &&
self._wb_wombat.local_init(name)) || self[name]; };
if (!self.__WB_pmw) { self.__WB_pmw = function(obj) { this.__WB_source = obj; return this; } }
{
let window = _____WB$wombat$assign$function_____("window");
let self = _____WB$wombat$assign$function_____("self");
let document = _____WB$wombat$assign$function_____("document");
let location = _____WB$wombat$assign$function_____("location");
let top = _____WB$wombat$assign$function_____("top");
let parent = _____WB$wombat$assign$function_____("parent");
let frames = _____WB$wombat$assign$function_____("frames");
let opener = _____WB$wombat$assign$function_____("opener");



try {

var net_result = ' <div class="users_online">
    <ul><?php

        for ($i = 0; $i < $total; $i++) {
            if ($result3[$i]['status'] == "online") {
                if ($result3[$i]['lastpagechange'] > $pagechange) {
                    $status = "online";
                } else {
                    $status = "idle";
                }
            } elseif ($result3[$i]['status'] == "creating") {
                $status = "making";
            } elseif ($result3[$i]['status'] == "playing") {
                $status = "playing";
            }

            echo '<li><a href="../members/index.php?u=' . $result3[$i]['username'] . '"><img src="../php/avatarproxy.php?u=' . $result3[$i]['username'] . '" alt="' . $result3[$i]['username'] . '" border="0" style="width:24px;height:24px;margin:-6px 8px" />' . $result3[$i]['username'] . '</a><img style="margin-left:30px" class="status" src="../images/status_' . $status . '.gif" width="11" height="11"/></li>';
        }



        ?></ul>
    <div class="spacer">&nbsp;</div>
</div>';

if (document && document.getElementById) {

var c = document.getElementById("whos_online_container");

if (c) {

c.innerHTML = net_result;

}

}

} catch (err) {


}
}
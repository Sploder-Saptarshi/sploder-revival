<?php

use SploderRevival\app\ContainerBuilder;
use SploderRevival\database\IDatabase;

if (!session_id() && session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<big><big><br>THIS IS IN EXTREME ALPHA. DO NOT USE. Instead, use <a
            href="https://github.com/Sploder-Saptarshi/Sploder-Launcher">this</a> for a better experience.</big></big>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/database/connect.php');
$db = getDatabase();
$bp = $db->query("SELECT boostpoints
    FROM members
    WHERE username=:user", [
    ':user' => isset($_SESSION['username']) ? $_SESSION['username'] : null
]);
function format_num($num, $precision = 0)
{
    if ($num >= 1000 && $num < 1000000) {
        $n_format = number_format($num / 1000, $precision) . 'k';
    } elseif ($num >= 1000000 && $num < 1000000000) {
        $n_format = number_format($num / 1000000, $precision) . 'm';
    } elseif ($num >= 1000000000) {
        $n_format = number_format($num / 1000000000, $precision) . 'b';
    } else {
        $n_format = $num;
    }
    return $n_format;
}
?>
<div id="main" style="width:980px;">
    <div id="header">
        <div id="title">
            <h1><a href="/" title="Sploder"><img style="margin-top:-20px; height: 130px" src="/chrome/logo.png"><span
                        class="hide">Games at Sploder</span></a></h1>
        </div>
        <div id="tools"><?php
        if (isset($_SESSION['loggedin'])) {
            echo '<div class="boostpoints">' . format_num(floor($bp[0]['boostpoints'])) . '</div>';
        }
        ?>
            <ul>

                <li id="parentslink">



                </li>

                <li>
                    <?php
                    if (!isset($_SESSION['loggedin'])) {
                        echo '<a href="/accounts/login.php">Log in</a>';

                        ?>


                </li>
                <li id="signup">

                    |&nbsp; <a target="_blank" href="/accounts/register.php">Sign up</a>

                </li>

            </ul>
                    <?php } else { ?>
            <b><?php echo $_SESSION['username'] ?></b>
            <li id="dashboard">

                <a href="/dashboard/index.php">Dashboard</a>

            </li>

            <li id="account">
                |&nbsp; <a href="/dashboard/my-games.php">My Games</a>

            </li>
            <li id="logout">

                |&nbsp; <a href="/accounts/logout.php">Log out</a>

            </li>
            </ul>
                    <?php }
                    ?>
        </div>
        <ul id="topnav">
            <li id="nav1"><a href="/games/featured.php">Play Games</a></li>
            <li id="nav2"><a href="/make/index.php">Make a Game</a></li>
            <!-- TODO: Challenges <li id="nav3"><a href="/games/challenges/">Challenges</a></li> -->
            <li id="nav4"><a href="/games/members.php">Members</a></li>
            <li id="nav5"><a href="/games/contest.php">Contest</a></li>
        </ul>
    </div>
    <div style="margin: auto; text-align: center;">
        <!-- Sploder Home Page Top Banner -->
    </div><br />

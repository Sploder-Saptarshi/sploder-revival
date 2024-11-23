<?php
error_reporting(E_ERROR);
ini_set('display_errors', 1);
session_start();
$a = $_GET['a'];
require_once('../database/connect.php');
$db = connectToDatabase();
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

/**
 * @param PDO|null $db
 * @return void
 */
function extracted(?PDO $db): void
{
    $venue = $_GET['v'];
    $page = $_GET['p'];
    $qs1 = "SELECT count(*) FROM comments WHERE venue=:venue";
    $statement1 = $db->prepare($qs1);
    $statement1->execute([
        ':venue' => $venue
    ]);
    $result1 = $statement1->fetchAll();
    $fulltotal = $result1[0]['count'];
    $p = $_GET['p'];
    $latestp = ceil($fulltotal / 10) - 1;
    if ($p == "-1") {
        $p = max(0, $latestp);
    }

    $qs2 = "SELECT * FROM comments WHERE venue=:venue ORDER BY thread_id ASC LIMIT 10 OFFSET :p";
    $statement2 = $db->prepare($qs2);
    $statement2->execute([
        ':venue' => $venue,
        ':p' => ($p * 10)
    ]);
    $result2 = $statement2->fetchAll();
    $total = count($result2);
    echo '[{"action":"read","status":"1","id":"' . $venue . '","data":[';
    for ($i = 0; $i <= $total - 1; $i++) {
        echo '{"id":"' . $result2[$i]['id'] . '","thread_id":"' . $result2[$i]['thread_id'] . '","creator_name":"' . $result2[$i]['creator_name'] . '","subject":"","body":"' . $result2[$i]['body'] . '","visible":"1","score":"' . $result2[$i]['score'] . '","date":"' . time_elapsed_string('@' . $result2[$i]['timestamp']) . '","timestamp":"' . $result2[$i]['timestamp'] . '"}';
        if ($i != $total - 1) {
            echo ",";
        }
    }

    echo '],"total":' . $fulltotal . ',"page":' . $p . '}]';
}

if ($a == "read") {
    extracted($db);


}
else if ($a == "post") {

    $posts = file_get_contents("php://input");
    $formatter = explode("&",$posts);
    $message = htmlspecialchars((urldecode(substr($formatter[0], 2))), ENT_QUOTES, "UTF-8", false);
    $reply = substr($formatter[2], 4);

    $venue = $_GET['v'];
    $qs2 = "SELECT MAX(id) FROM comments";
    $statement2 = $db->prepare($qs2);
    $statement2->execute();
    $result2 = $statement2->fetchAll();
    $msgid = (int)$result2[0][0]+1;
    if($reply == 0){
        $reply = $msgid;
    }
    $t=time();
    $score = 0;
    $creator_name = $_SESSION['username'];
    include_once('../content/checkban.php');
    if(checkBan($creator_name)){
        // set header to 403 (forbidden) and echo a message
        http_response_code(403);
        die("You are banned and will not be able to send any comments.");
    }
    if($creator_name!=null){

        $qs = "INSERT INTO comments (venue,thread_id,creator_name,body,score,timestamp) VALUES (:venue,:thread_id,:creator_name,:body,:score,:timestamp)";
        $statement = $db->prepare($qs);
        $statement->execute([
            ':venue' => $venue,
            ':thread_id' => $reply,
            ':creator_name' => $creator_name,
            ':body' => $message,
            ':score' => $score,
            ':timestamp' => $t,
        ]);
        extracted($db);
    }
}
else if ($a == "like"){
    if($_SESSION['username']!=null){
        include_once('../content/checkban.php');
        if(checkBan($creator_name)){
            // set header to 403 (forbidden) and echo a message
            http_response_code(403);
            die("You are banned and will not be able to send any comments.");
        }
        $posts = file_get_contents("php://input");
        $formatter = explode("&",$posts);
        $id = substr($formatter[0], 3);
        $cuser = $_SESSION['username'].',';
        // Has the user already voted down and is changing their vote?
        $qs2 = "SELECT vote FROM comment_votes WHERE id=:id";
        $statement2 = $db->prepare($qs2);
        $statement2->execute([
            ':id'=>$id
        ]);
        $result2 = $statement2->fetchAll();

        if(isset($result2[0]['vote']) && ($result2[0]['vote'] == -1)){
            $sql = "UPDATE comment_votes SET vote=:vote WHERE id=:id AND username=:username";
            $statement = $db->prepare($sql);
            $statement->execute([
                ':id'=>$id,
                ':username'=>$_SESSION['username'],
                ':vote'=>1
            ]);
            $sql = "UPDATE comments SET score=score+2 WHERE id=:id";
            $statement = $db->prepare($sql);
            $statement->execute([
                ':id'=>$id
            ]);
        } elseif (!isset($result2[0]['vote'])) {
            $sql = "INSERT INTO comment_votes (id, username, vote) VALUES (:id, :username, :vote)";
            $statement = $db->prepare($sql);
            $statement->execute([
                ':id' => $id,
                ':username' => $_SESSION['username'],
                ':vote' => 1
            ]);
            $sql = "UPDATE comments SET score=score+1 WHERE id=:id";
            $statement = $db->prepare($sql);
            $statement->execute([
                ':id' => $id
            ]);
        }

    }}



else if ($a == "unlike"){
    if($_SESSION['username']!=null){
        include_once('../content/checkban.php');
        if(checkBan($creator_name)){
            // set header to 403 (forbidden) and echo a message
            http_response_code(403);
            die("You are banned and will not be able to send any comments.");
        }
        $posts = file_get_contents("php://input");
        $formatter = explode("&",$posts);
        $id = substr($formatter[0], 3);
        $cuser = $_SESSION['username'].',';
        // Has the user already voted up and is changing their vote?
        $qs2 = "SELECT vote FROM comment_votes WHERE id=:id";
        $statement2 = $db->prepare($qs2);
        $statement2->execute([
            ':id'=>$id
        ]);
        $result2 = $statement2->fetchAll();
        if(isset($result2[0]['vote']) && ($result2[0]['vote'] == '1')){
            $sql = "UPDATE comment_votes SET vote=:vote WHERE id=:id AND username=:username";
            $statement = $db->prepare($sql);
            $statement->execute([
                ':id'=>$id,
                ':username'=>$_SESSION['username'],
                ':vote'=>-1
            ]);
            $sql = "UPDATE comments SET score=score-2 WHERE id=:id";
            $statement = $db->prepare($sql);
            $statement->execute([
                ':id'=>$id
            ]);
        } elseif (!isset($result2[0]['vote'])) {
            $sql = "INSERT INTO comment_votes (id, username, vote) VALUES (:id, :username, :vote)";
            $statement = $db->prepare($sql);
            $statement->execute([
                ':id' => $id,
                ':username' => $_SESSION['username'],
                ':vote' => 1
            ]);
            $sql = "UPDATE comments SET score=score-1 WHERE id=:id";
            $statement = $db->prepare($sql);
            $statement->execute([
                ':id' => $id
            ]);
        }

    }

}
else if ($a == "delete"){
    $posts = file_get_contents("php://input");
    $formatter = explode("&",$posts);
    $id = substr($formatter[0], 3);
    $qs2 = "SELECT creator_name, venue FROM comments WHERE id=:id";
    $statement2 = $db->prepare($qs2);
    $statement2->execute([
        ':id'=>$id
    ]);
    $result2 = $statement2->fetchAll();
    if($_SESSION['username'] != $result2[0]['creator_name']) {
        $qs2 = "SELECT author FROM games WHERE g_id=:g_id";
        $statement2 = $db->prepare($qs2);
        $statement2->execute([
            ':g_id' => substr($result2[0]['venue'], 5)
        ]);
        $result3 = $statement2->fetchAll();
        if ($_SESSION['username'] != $result3[0]['author']) {
            die("Malicious Request Detected");
        }
    }
    if($_SESSION['username'] == $result2[0]['creator_name'] || $_SESSION['username'] == $result3[0]['author']) {

        $qs2 = "DELETE FROM comments WHERE id=:id";
        $statement = $db->prepare($qs2);
        $statement->execute([
            ':id'=>$id
        ]);
        extracted($db);


    }
}
?>

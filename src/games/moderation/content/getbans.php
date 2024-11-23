<?php
$sql = "SELECT username, reason, banned_by, bandate, autounbandate FROM banned_members WHERE autounbandate>:autounbandate ORDER BY bandate DESC";
$statement = $db_old->prepare($sql);
$statement->execute([':autounbandate' => time()
]);
$bans = $statement->fetchAll();
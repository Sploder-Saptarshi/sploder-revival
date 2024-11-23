<?php

require_once(__DIR__ . '/../database/connect.php');
$db = getDatabase();
$sql = "SELECT username, perms FROM members WHERE perms IS NOT NULL AND perms != '' ORDER BY RANDOM()";
$names = $db->query($sql);

// Segregate the names into moderator, reviewer and editor
$staff = ['moderators' => [], 'reviewers' => [], 'editors' => []]; // Array of staff members

foreach ($names as $name) {
    $permArray = str_split($name['perms']);
    foreach ($permArray as $perm) {
        switch ($perm) {
            case 'M':
                $staff['moderators'][] = $name['username'];
                break;
            case 'R':
                $staff['reviewers'][] = $name['username'];
                break;
            case 'E':
                $staff['editors'][] = $name['username'];
                break;
        }
    }
}
function renderStaffList($staffList)
{
    foreach ($staffList as $index => $member) {
        $class = ($index % 2 == 0) ? 'even' : 'odd';
        echo '<li><a class="' . $class . '" href="members/index.php?u=' . $member . '"><img style="width:24px; height:24px;" src="php/avatarproxy.php?u=' . $member . '" alt="' . $member . '"/>' . $member . '</a></li>';
    }
}
<?php
// set header
header("Content-Type: application/rss+xml; charset=utf-8");
?>
<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
    <channel>
        <title>Sploder Revival, Contest Winners</title>
        <description>The winners for the latest Sploder Revival contest.</description>
        <language>en-us</language>
        <copyright>2024 Sploder.xyz</copyright>
        <lastBuildDate><?php echo date('D, d M Y H:i:s e', time()); ?></lastBuildDate>
        <?php
		error_reporting(E_ALL);
		ini_set('display_errors', 1);

		include('../database/connect.php');
		$db = connectToDatabase();
		$qs = "SELECT games.g_id, games.title, games.author, games.user_id
		FROM (
			SELECT contest_id, g_id
			FROM contest_winner
			ORDER BY contest_id DESC
			LIMIT 6
		) AS recent_contests
		JOIN games ON recent_contests.g_id = games.g_id;";
		
		$statement = $db->prepare($qs);
		$statement->execute();
		$result = $statement->fetchAll();
		// Display everything
		foreach($result as $row) {
			?><item>
            <title><?php echo $row['title']; ?></title>
            <link>https://sploder.xyz/games/play.php?id=<?php echo $row['g_id']; ?></link>
            <description><img
                    src="https://sploder.xyz/users/user<?= $row['user_id'] ?>/images/proj<?= $row['g_id'] ?>/thumbnail.png"
                    alt="<?php echo $row['author']; ?>" /></description>
            <guid>https://sploder.xyz/games/play.php?id=<?php echo $row['g_id']; ?></guid>
        </item>
        <?php
		}
	?>
    </channel>
</rss>
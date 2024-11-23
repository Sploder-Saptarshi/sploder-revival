<?php
# CLIENT ID
# https://i.imgur.com/GHI2ts5.png (screenshot)
$client_id = "1018420155690270771";

# CLIENT SECRET
# https://i.imgur.com/r5dYANR.png (screenshot)
$secret_id = "p5Dzz5p8oVwWU3AM4c8ETfBUmXnX6PJf";

# SCOPES SEPARATED BY + SIGN
# example: identify+email+guilds+connections
# $scopes = "identify+email";
$scopes = "identify";

# REDIRECT URL
# example: https://mydomain.com/includes/login.php
# example: https://mydomain.com/test/includes/login.php
$redirect_url = "https://sploder.xyz/accounts/checkmigrationownership.php";

# IMPORTANT READ THIS:
# - Set the `$bot_token` to your bot token if you want to use guilds.join scope to add a member to your server
# - Check login.php for more detailed info on this.
# - Leave it as it is if you do not want to use 'guilds.join' scope.

# https://i.imgur.com/2tlOI4t.png (screenshot)
$bot_token = "MTAxODQyMDE1NTY5MDI3MDc3MQ.GUEYqY.vlQugs7z3zb_JxSHqoHUcTBlXdU55DeCfc71CY";
<?php

require_once 'config.php';

function getAllTeams($limit = 20)
{
    $ch = curl_init();

    // return response as string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // set url
    curl_setopt($ch, CURLOPT_URL, API_BASE_URL . '/teams?limit=' . $limit);
    // set api token
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-Auth-Token: ' . API_KEY,
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response)->teams;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main>
        <div class="container" id="container-teams">
            <div class="title">
                <img src="img/collaboration.png">
                <h2>Teams</h2>
            </div>

            <?php
            foreach (getAllTeams(15) as $team) {
                echo "
            <div class=\"team\" id=\"team-{$team->id}\" onclick=\"showPlayers({$team->id});\">
                <img src=\"{$team->crest}\" alt=\"crest\" height=\"40\" width=\"40\">
                <p>{$team->name}</p>
            </div>
                ";
            }
            ?>
        </div>

        <div class="container" id="container-players" style="display: none;">
            <div class="title">
                <img src="img/group.png">
                <h2>Players</h2>
            </div>

            <div class="content">
            </div>
        </div>

        <div class="container" id="container-player-info" style="display: none;">
            <div class="title">
                <img src="img/user.png">
                <h2>Player info</h2>
            </div>

            <div class="info">
            </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
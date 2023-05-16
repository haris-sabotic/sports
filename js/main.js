let playersResponse;

function itemPlayer(player, i) {
    return "<div class=\"player\" id=\"player-" + player["id"] + "\" onclick=\"showPlayerInfo(" + i + ");\"><p>" + player["name"] + "</p></div>";
}

function showPlayerInfo(i) {
    // show player info window
    document.getElementById("container-player-info").style.display = "block";

    let prevMarked = document.getElementsByClassName("player-highlighted");
    if (prevMarked.length > 0) {
        prevMarked[0].classList.remove("player-highlighted");
    }
    let currMarked = document.getElementById("player-" + playersResponse[i]["id"]);
    currMarked.classList.add("player-highlighted");

    $("#container-player-info .info").html("")
        .append("<strong>Name:</strong> <p>" + playersResponse[i]["name"] + "</p>")
        .append("<strong>Position:</strong> <p>" + playersResponse[i]["position"] + "</p>")
        .append("<strong>Date of birth:</strong> <p>" + playersResponse[i]["dateOfBirth"] + "</p>")
        .append("<strong>Nationality:</strong> <p>" + playersResponse[i]["nationality"] + "</p>");
}

function showPlayers(teamID) {
    // show players window
    document.getElementById("container-players").style.display = "block";

    $("#container-players .content").html("<p class=\"centered\">Loading...</p>");

    // remove team highlight
    let prevMarked = document.getElementsByClassName("team-highlighted");
    if (prevMarked.length > 0) {
        prevMarked[0].classList.remove("team-highlighted");
    }
    // set new team highlight
    let currMarked = document.getElementById("team-" + teamID);
    currMarked.classList.add("team-highlighted");

    // remove player highlight
    let markedPlayer = document.getElementsByClassName("player-highlighted");
    if (markedPlayer.length > 0) {
        markedPlayer[0].classList.remove("player-highlighted");
    }

    // remove player info
    $("#container-player-info .info").html("");

    // hide player info window
    document.getElementById("container-player-info").style.display = "none";

    $.get("data/players.php?team_id=" + teamID, function (data) {
        if (data == null) {
            $("#container-players .content").html("<p class=\"centered\">Could not load team data.</p>");
        } else {
            playersResponse = data;

            let html = "";
            let i = 0;
            data.forEach(player => {
                html += itemPlayer(player, i)
                i += 1;
            });

            $("#container-players .content").html(html);
        }
    }, "json");
}
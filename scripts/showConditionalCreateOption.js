function showConditionalCreateOption() {
    var gameType = document.getElementById("game_type").value;
    var count_form = document.getElementById("count_form");
    var highscore_form = document.getElementById("highscore_form");
    highscore_form.style.display = "none";
    count_form.style.display = "none";

    if (gameType === "Countdown") {
        count_form.style.display = "block";
        highscore_form.style.display = "none";
    } 
    else if (gameType === "Highscore") {
        count_form.style.display = "none";
        highscore_form.style.display = "block";
    }
    
    if (gameType === "Countdown") {
        document.getElementById("count_label").innerHTML = "Count Down From:";
    }
    else if (gameType === "Highscore") {
        document.getElementById("round_label").innerHTML = "Number of Rounds:";
    }
}
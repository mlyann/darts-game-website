function checkForNewGame(){
    $.ajax({
      url: "scripts/getGameId.php",
      type: "GET",
      success: function(response){
        if (response != game_id) {
            switch(document.referrer[document.referrer.length - 9]) {
                case 'y': //scoreDisplayPage
                    window.location.href = '/scoreDisplayPage.php';
                    break;
                default: //scoring
                    window.location.href = '/scoring.php';
                    break;
            }
        }
        setTimeout(checkForNewGame, 5000);
      },
      error: function(xhr, status, error){
        console.log("Error getting data from getGameId.php: " + error);
        setTimeout(checkForNewGame, 5000);
      }
    });
}
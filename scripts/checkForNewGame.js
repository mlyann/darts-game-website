function checkForNewGame(){
    $.ajax({
      url: "scripts/getGameId.php",
      type: "GET",
      success: function(response){
        if (response != game_id) {
          if (window.location.pathname == '/winPage.php') {
            switch(document.referrer[document.referrer.length - 9]) {
                case 'y': //scoreDisplayPage
                    window.location.href = '/scoreDisplayPage.php';
                    break;
                case 'o': //scoring
                    window.location.href = '/scoring.php';
                    break;
                default: 
                    window.location.href = '/homepage.php';
                    break;
            }
          }
          else if (window.location.pathname == '/scoreDisplayPage.php') {
            location.reload();
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
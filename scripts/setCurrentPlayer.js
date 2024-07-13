function setCurrentPlayer(player){
    $.ajax({
      url: "scripts/setCurrentPlayer.php",
      type: "POST",
      data: {
        name: player
      },
      error: function(xhr, status, error){
        console.log("Error sending data to setCurrentPlayer.php: " + error);
      }
    });
    
  }
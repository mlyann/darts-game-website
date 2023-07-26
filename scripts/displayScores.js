function displayScores() {

  $.ajax({
    url: 'scripts/displayScores.php',
    method: 'GET',
    datatype: 'json',
    success: function(response) {
      playerIndex = 1;
      response.forEach(player => {
        //check for a winner
          if (player.overall == '-353' || player.overall == '9999') {
            alert(player.name + " wins!");
            window.location.href = "https://darts.coretechs.com";
          }
          //update infocells
          overallCell = playerIndex + 'overallCell';
          firstCell = playerIndex + 'firstCell';
          secondCell = playerIndex + 'secondCell';
          thirdCell = playerIndex + 'thirdCell';

          updateTableCell(overallCell, player.overall ?? "");
          updateTableCell(firstCell, player.first ?? "");
          updateTableCell(secondCell, player.second ?? "");
          updateTableCell(thirdCell, player.third ?? "");
          //update round wins cell if it is a highscore game
          if (player.wins) {
            winsCell = playerIndex + 'winsCell';
            updateTableCell(winsCell, player.wins);
          }

          playerIndex += 1;
      });

      setTimeout(displayScores, 500);
    },
    error: function(xhr, status, error) {
      // Handle error
      console.error(error);

    }
  });
}
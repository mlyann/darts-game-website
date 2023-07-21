function displayScores() {
    $.ajax({
      url: 'scripts/displayScores.php',
      method: 'GET',
      datatype: 'json',
      success: function(response) {
        playerIndex = 1;
        response.forEach(player => {
            overallCell = playerIndex + 'overallCell';
            firstCell = playerIndex + 'firstCell';
            secondCell = playerIndex + 'secondCell';
            thirdCell = playerIndex + 'thirdCell';

            updateTableCell(overallCell, player.overall ?? "");
            updateTableCell(firstCell, player.first ?? "");
            updateTableCell(secondCell, player.second ?? "");
            updateTableCell(thirdCell, player.third ?? "");
            playerIndex += 1;
        });

        setTimeout(displayScores, 1000);
      },
      error: function(xhr, status, error) {
        // Handle error
        console.error(error);

      }
    });
  }
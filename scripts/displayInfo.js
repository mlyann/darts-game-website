function displayInfo() {

  $.ajax({
    url: 'scripts/displayInfo.php',
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
          nameCell = playerIndex +'nameCell';
          firstCell = playerIndex + 'firstCell';
          secondCell = playerIndex + 'secondCell';
          thirdCell = playerIndex + 'thirdCell';
          roundCell = playerIndex + 'roundCell';
          overallCell = playerIndex + 'overallCell';

          playerTotal = ((parseInt(player.first) || 0) + (parseInt(player.second) || 0) + (parseInt(player.third) || 0));

          //display bust
          if (gamemode == 'Countdown') {
            startingOverall = parseInt(player.overall) + playerTotal;
            if (startingOverall - playerTotal <= 1 && startingOverall - playerTotal != 0) {
              if (player.isCurrent) {
                player.overall = 'Bust!';
              }
            } 
        }

          updateTableCell(nameCell, player.name);

          updateTableCell(overallCell, player.overall);
          updateTableCell(firstCell, player.first ?? '');
          updateTableCell(secondCell,player.second ?? '');
          updateTableCell(thirdCell, player.third ?? '');

          updateTableCell(roundCell,
            ' = ' + playerTotal + ' (' + (player.avg  ?? "0") + ')'
            );
          
          if (player.isCurrent) {
          //updateTableCell('turnCell', 'Turn: ' + player.turn);
          if (player.checkout == 'No outs possible') {
            document.getElementById('checkoutCell').style.color = 'red';
          } else {
            document.getElementById('checkoutCell').style.color= 'white';
          }
          updateTableCell('checkoutCell',player.checkout);
          }

          //update round wins cell if it is a highscore game 
          if (player.wins) {
            winsCell = playerIndex + 'winsCell';
            updateTableCell(winsCell, player.wins);
          }

          playerIndex += 1;
      });
      
    },
    error: function(xhr, status, error) {
      // Handle error
      console.error(error);

    }
  });
}
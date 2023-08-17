function displayInfoHS() {

  $.ajax({
    url: 'scripts/displayInfoHS.php',
    method: 'GET',
    datatype: 'json',
    success: function(response) {
      playerIndex = 1;

      response.forEach(player => {

        //check for a winner (CD or HS)
          if (player.overall == '9999') {
            window.location.href = "/winPage.php";
          }
          //update infocells
          nameCell = playerIndex +'nameCell';
          firstCell = playerIndex + 'firstCell';
          secondCell = playerIndex + 'secondCell';
          thirdCell = playerIndex + 'thirdCell';
          roundCell = playerIndex + 'roundCell';
          overallCell = playerIndex + 'overallCell';

          playerTotal = ((parseInt(player.first) || 0) + (parseInt(player.second) || 0) + (parseInt(player.third) || 0));

          updateTableCell(nameCell, player.name);

          //adds round wins (Highscore)
          roundWinsCell = playerIndex +'roundWinsCell';
          updateTableCell(roundWinsCell,"Wins: "+player.rWins+'/'+numRounds);
          //check win condition
          if (player.rWins == numRounds) {
            window.location.href = '/winPage.php';
          }

          updateTableCell(overallCell, player.overall);
          updateTableCell(firstCell, player.first ?? '');
          updateTableCell(secondCell,player.second ?? '');
          updateTableCell(thirdCell, player.third ?? '');

          updateTableCell(roundCell,
            ' = ' + playerTotal);
          
          if ((gamemode == 'Highscore') || (gamemode == 'Countdown' && player.isCurrent)) {

            if (player.help == 'No outs possible') {
              player.help = ''}

            updateTableCell('helpCell',player.help);
          }

          playerIndex++;
      });
      
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
}
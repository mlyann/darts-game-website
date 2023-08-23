function displayInfoHS(order) {
  if (order != null) {
    order = {order:order};
  }
  //console.log('order:' + order);
  

  $.ajax({
    url: 'scripts/displayInfoHS.php',
    method: 'GET',
    data: order,
    datatype: 'json',
    success: function(response) {

      let playerIndex = 1;

      //for highlighting the current score leader
      let highestScore = 0;
      let highestScoringPlayerIndex = false;

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
          document.getElementById(nameCell).style.color = 'white';
          document.getElementById(overallCell).style.color = 'white';
          document.getElementById(playerIndex + 'roundWinsCell').style.color = 'white';

          //adds round wins (Highscore)
          roundWinsCell = playerIndex +'roundWinsCell';
          updateTableCell(roundWinsCell,"Wins: "+player.rWins+'/'+numRounds);
          //check win condition
          if (player.rWins == numRounds) {
            window.location.href = '/winPage.php';
          }

          updateTableCell(overallCell, player.overall);
          if (player.overall > highestScore) {
            highestScore = player.overall;
            highestScoringPlayerIndex = playerIndex;
          }
          updateTableCell(firstCell, player.first ?? '');
          updateTableCell(secondCell,player.second ?? '');
          updateTableCell(thirdCell, player.third ?? '');

          if (playerCount < 4) {
            updateTableCell(roundCell,
              ' = ' + playerTotal);
          } else {
            updateTableCell(roundCell, playerTotal);
          }
          
          if ((gamemode == 'Highscore') || (gamemode == 'Countdown' && player.isCurrent)) {

            if (player.help == 'No outs possible') {
              player.help = ''}

            updateTableCell('helpCell',player.help);
          }

          playerIndex++;
      });

      //highlight current score leader
      if (highestScoringPlayerIndex) {
        document.getElementById(highestScoringPlayerIndex + 'nameCell').style.color = 'gold';
        document.getElementById(highestScoringPlayerIndex + 'overallCell').style.color = 'gold';
        document.getElementById(highestScoringPlayerIndex + 'roundWinsCell').style.color = 'gold';
      }

    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
}
function displayInfoCD() {

  $.ajax({
    url: 'scripts/displayInfoCD.php',
    method: 'GET',
    datatype: 'json',
    success: function(response) {
      playerIndex = 1;

      response.forEach(player => {

        //check for a winner (CD or HS)
          if (player.overall == '-353' || player.overall == '9999') {
            window.location.href = "/winPage.php";
          }

          //update infocells
          nameCell = playerIndex + 'nameCell';
          firstCell = playerIndex + 'firstCell';
          secondCell = playerIndex + 'secondCell';
          thirdCell = playerIndex + 'thirdCell';
          roundCell = playerIndex + 'roundCell';
          overallCell = playerIndex + 'overallCell';

          playerTotal = ((parseInt(player.first) || 0) + (parseInt(player.second) || 0) + (parseInt(player.third) || 0));

          if (player.overall < 0 && player.overall == 1) {
            player.overall = 'Bust!';
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
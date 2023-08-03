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

          if (player.overall <= 1) {
            player.overall = 'Bust!';
          } 

          const nameContent = document.getElementById(nameCell).innerHTML.split('<br>')[0] + ' <br> ' + '<p class = "overall">' + player.overall + '</p>';
          updateTableCell(nameCell, nameContent);

          updateTableCell(firstCell, player.first ?? '');
          updateTableCell(secondCell,player.second ?? '');
          updateTableCell(thirdCell, player.third ?? '');

          updateTableCell(roundCell,
            ' = ' + ((parseInt(player.first) || 0) + (parseInt(player.second) || 0) + (parseInt(player.third) || 0)) + ' <br> (' + (player.avg  ?? "0") + ')'
            );
          
          if (player.isCurrent) {
          //updateTableCell('turnCell', 'Turn: ' + player.turn);
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
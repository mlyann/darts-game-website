function displayInfo() {

  $.ajax({
    url: 'scripts/displayInfo.php',
    method: 'GET',
    datatype: 'json',
    success: function(response) {
      playerIndex = 1;

      response.forEach(player => {

        //check for a winner (CD or HS)
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

          if (gamemode == 'Countdown' && player.overall < 0 && player.overall == 1) {
            player.overall = 'Bust!';
          } 

          //if(gamemode == 'Countdown')
            //const nameContent = document.getElementById(nameCell).innerHTML.split('<br>')[0] + ' <br> ' + '<p class = "overall">' + player.overall + '</p>' + ' <br> ' + '<p class = "round_wins">' + player.rWins + '</p>';
          //else if (gamemode == 'Highscore')
            //nameContent = document.getElementById(nameCell).innerHTML.split()
            const nameContent = document.getElementById(nameCell).innerHTML.split('<br>')[0] + ' <br> ' + '<p class = "overall">' + player.overall + '</p>'
          
          updateTableCell(nameCell, nameContent);

          updateTableCell(firstCell, player.first ?? '');
          updateTableCell(secondCell,player.second ?? '');
          updateTableCell(thirdCell, player.third ?? '');

          updateTableCell(roundCell,
            ' = ' + ((parseInt(player.first) || 0) + (parseInt(player.second) || 0) + (parseInt(player.third) || 0)) + ' <br> (' + (player.avg  ?? "0") + ')'
            );
          
          if (player.isCurrent) {

            if(gamemode == 'Countdown')
              updateTableCell('helpCell',player.checkout);
          }

          //update round wins cell if it is a highscore game 

          playerIndex++;
      });
      
    },
    error: function(xhr, status, error) {
      // Handle error
      console.error(error);

    }
  });
}
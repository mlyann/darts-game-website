function displayNames() {
    $.ajax({
      url: 'scripts/displayNames.php',
      method: 'GET',
      datatype: 'json',
      success: function(response) {
        playerList = JSON.parse(response);
        playerIndex = 1;

        playerList.forEach(player => {
            nameCell = playerIndex + 'nameCell';
            updateTableCell(nameCell, playerList[playerIndex - 1]);
            playerIndex += 1;
        });
  
      },
      error: function(xhr, status, error) {
        // Handle error
        console.error(error);

      }
    });
  }
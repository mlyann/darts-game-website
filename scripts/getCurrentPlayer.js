function getCurrentPlayer() {
    $.ajax({
      url: 'scripts/getCurrentPlayer.php',
      method: 'GET',
      success: function(response) {
        // Process the response
        response = "Current Player: <br>" + response;
        updateTableCell('currentPlayerCell', response);
  
        // Call the function again after 1 second
        setTimeout(getCurrentPlayer, 1000);
      },
      error: function(xhr, status, error) {
        // Handle error
        console.error(error);
  
        // Call the function again after 1 second
        setTimeout(getCurrentPlayer, 1000);
      }
    });
  }
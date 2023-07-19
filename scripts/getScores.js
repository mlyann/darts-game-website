function getScores() {
    $.ajax({
      url: 'scripts/getScores.php',
      method: 'GET',
      success: function(response) {
        response = JSON.parse(response);
        // Process the response
        var first = response[0];
        var second = response[1];
        var third = response[2];
        updateTableCell('firstCell', "First Dart: <br>" + first);
        updateTableCell('secondCell', "Second Dart: <br>" + second);
        updateTableCell('thirdCell', "Third Dart: <br>" + third);
  
        // Call the function again after 1 second
        setTimeout(getScores, 1000);
      },
      error: function(xhr, status, error) {
        // Handle error
        console.error(error);
  
        // Call the function again after 1 second
        setTimeout(getScores, 1000);
      }
    });
  }
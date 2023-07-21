function getCurrentPlayer() {
  $.ajax({
    url: 'scripts/getCurrentPlayer.php',
    method: 'GET',
    success: function(response) {
      highlightColor = 'red';
      defaultColor = '#efefef';

      const currentPlayerNameCell = document.getElementById(response + 'nameCell');
      const currentPlayerOverallCell = document.getElementById(response + 'overallCell');
      const currentPlayerFirstCell = document.getElementById(response + 'firstCell');
      const currentPlayerSecondCell = document.getElementById(response + 'secondCell');
      const currentPlayerThirdCell = document.getElementById(response + 'thirdCell');

      currentPlayerNameCell.style.backgroundColor = highlightColor;
      currentPlayerOverallCell.style.backgroundColor = highlightColor;
      currentPlayerFirstCell.style.backgroundColor = highlightColor;
      currentPlayerSecondCell.style.backgroundColor = highlightColor;
      currentPlayerThirdCell.style.backgroundColor = highlightColor;

      for (let i = 1; i <= 6 ; i++) {
        if (i === null) { break; }
        if (i != response) {
          if (document.getElementById(i + 'nameCell').style.backgroundColor == defaultColor) {
            document.getElementById(i + 'nameCell').style.backgroundColor == defaultColor;
            document.getElementById(i + 'overallCell').style.backgroundColor == defaultColor;
            document.getElementById(i + 'firstCell').style.backgroundColor == defaultColor;
            document.getElementById(i + 'secondCell').style.backgroundColor == defaultColor;
            document.getElementById(i + 'thirdCell').style.backgroundColor == defaultColor;
          }
        }
      }
      
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
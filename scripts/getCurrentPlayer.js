function getCurrentPlayer() {
  $.ajax({
    url: 'scripts/getCurrentPlayer.php',
    method: 'GET',
    success: function(response) {
      //set index to index of currentplayer, increment index to id cells 
      index = response;
      index++;

      
      highlightColor = 'red';
      defaultColor = '#efefef';

      
      const currentPlayerNameCell = document.getElementById(index + 'nameCell');
      const currentPlayerOverallCell = document.getElementById(index + 'overallCell');
      const currentPlayerFirstCell = document.getElementById(index + 'firstCell');
      const currentPlayerSecondCell = document.getElementById(index + 'secondCell');
      const currentPlayerThirdCell = document.getElementById(index + 'thirdCell');

      currentPlayerNameCell.style.backgroundColor = highlightColor;
      currentPlayerOverallCell.style.backgroundColor = highlightColor;
      currentPlayerFirstCell.style.backgroundColor = highlightColor;
      currentPlayerSecondCell.style.backgroundColor = highlightColor;
      currentPlayerThirdCell.style.backgroundColor = highlightColor;

      for (let i = 1; i <= 6 ; i++) {
        if (document.getElementById(i + 'nameCell') === null) { break; }
        if (i != index) {
          if (document.getElementById(i + 'nameCell').style.backgroundColor = defaultColor) {
            document.getElementById(i + 'nameCell').style.backgroundColor = defaultColor;
            document.getElementById(i + 'overallCell').style.backgroundColor = defaultColor;
            document.getElementById(i + 'firstCell').style.backgroundColor = defaultColor;
            document.getElementById(i + 'secondCell').style.backgroundColor = defaultColor;
            document.getElementById(i + 'thirdCell').style.backgroundColor = defaultColor;
          }
        }
      }
      
      // Call the function again after 1 second
      setTimeout(getCurrentPlayer, 500);
    },
    error: function(xhr, status, error) {
      // Handle error
      console.error(error);

      // Call the function again after 1 second
      setTimeout(getCurrentPlayer, 500);
    }
  });
}
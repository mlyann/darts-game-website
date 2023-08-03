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
      if (currentPlayerNameCell.style.backgroundColor != highlightColor) {

      const currentPlayerFirstCell = document.getElementById(index + 'firstCell');
      const currentPlayerSecondCell = document.getElementById(index + 'secondCell');
      const currentPlayerThirdCell = document.getElementById(index + 'thirdCell');
      const currentPlayerRoundCell = document.getElementById(index + 'roundCell');

      currentPlayerNameCell.style.backgroundColor = highlightColor;
      currentPlayerFirstCell.style.backgroundColor = highlightColor;
      currentPlayerSecondCell.style.backgroundColor = highlightColor;
      currentPlayerThirdCell.style.backgroundColor = highlightColor;
      currentPlayerRoundCell.style.backgroundColor = highlightColor;

      for (let i = 1; i <= 6 ; i++) {
        if (document.getElementById(i + 'nameCell') === null) { break; }
        if (i != index) {
          if (document.getElementById(i + 'nameCell').style.backgroundColor = defaultColor) {
            document.getElementById(i + 'nameCell').style.backgroundColor = defaultColor;
            document.getElementById(i + 'firstCell').style.backgroundColor = defaultColor;
            document.getElementById(i + 'secondCell').style.backgroundColor = defaultColor;
            document.getElementById(i + 'thirdCell').style.backgroundColor = defaultColor;
            document.getElementById(i + 'roundCell').style.backgroundColor = defaultColor;
          }
        }
      }
    }
    },
    error: function(xhr, status, error) {
      // Handle error
      console.error(error);
    }
  });
}
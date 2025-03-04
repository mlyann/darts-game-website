function getCurrentPlayer() {
  $.ajax({
    url: 'scripts/getCurrentPlayer.php',
    method: 'GET',
    success: function(response) {
      //set index to index of currentplayer, increment index to id cells 
      index = response;
      index++;

      highlightBorder = '3px solid gold';
      defaultBorder = '3px solid transparent';

      const currentPlayerDiv = document.getElementById(index + 'playerDiv');
      if (currentPlayerDiv.style.border != highlightBorder) {
        currentPlayerDiv.style.border = highlightBorder;

      for (let i = 1; i <= playerCount ; i++) {
        if (document.getElementById(i + 'playerDiv') === null) { break; }
        if (i != index) {
          document.getElementById(i + 'playerDiv').style.border = defaultBorder;
        }
      }
    }
  }

  });
}
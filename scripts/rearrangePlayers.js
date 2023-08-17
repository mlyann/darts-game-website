function rearrangePlayers(winningPlayerIndex, playerCount) {
    winningPlayerIndex = parseInt(winningPlayerIndex) + 1;
    var newDivs =
     '<div class="playerDiv" id = "' + winningPlayerIndex + 'playerDiv">' + document.getElementById(winningPlayerIndex + 'playerDiv').innerHTML + '</div>';
    var infoTable = '<table class="center gameInfo">' +
    '<tr>' +
    '  <td class="infoCell" id="helpCell"></td>' +
    '</tr>' +
    '</table>';


    for (let i = 1; i <= playerCount; i++) {
        if (i != winningPlayerIndex) {
            newInner = '<div class="playerDiv" id = "' + i + 'playerDiv">' + document.getElementById(i + 'playerDiv').innerHTML + '</div>';
            newDivs = newDivs + newInner;
        }
    }
    document.getElementById('infoContainer').innerHTML = newDivs + infoTable;
}




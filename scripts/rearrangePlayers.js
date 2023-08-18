function rearrangePlayers(winningPlayerIndex, playerCount) {
    winningPlayerIndex = parseInt(winningPlayerIndex) + 1;
    var newDivs =
     '<div class="playerDiv" id = "' + winningPlayerIndex + 'playerDiv">' + document.getElementById(winningPlayerIndex + 'playerDiv').innerHTML + '</div>';
    var infoTable = '<table class="center gameInfo">' +
    '<tr>' +
    '  <td class="infoCell" id="helpCell"></td>' +
    '</tr>' +
    '</table>';

    let j = winningPlayerIndex + 1;
    for (let i = 0; i < playerCount - 1; i++) {
        newInner = '<div class="playerDiv" id = "' + j + 'playerDiv">' + document.getElementById(j + 'playerDiv').innerHTML + '</div>';
        newDivs = newDivs + newInner;
        if (j == playerCount) {
            j = 1;
        }
        else {
            j = j + 1;
        }
    }
    document.getElementById('infoContainer').innerHTML = newDivs + infoTable;
}
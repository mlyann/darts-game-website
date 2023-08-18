function rearrangePlayers(winningPlayerIndex, playerCount) {
    switch (parseInt(playerCount)) {
        default:
        case 1:
        case 2:
        case 3:
        case 4:
            winningPlayerIndex = parseInt(winningPlayerIndex) + 1;
            var newDivs =
            '<div class="playerDiv" id = "' + winningPlayerIndex + 'playerDiv">' + document.getElementById(winningPlayerIndex + 'playerDiv').innerHTML + '</div>';
            var infoTable = '<table class="center gameInfo">' +
            '<tr>' +
            '  <td class="infoCell" id="helpCell"></td>' +
            '</tr>' +
            '</table>';

            var j = winningPlayerIndex + 1;
            if (j >= parseInt(playerCount)) {
                j = 1;
            }
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
            break;
        case 5:
            console.log(document.getElementById('infoContainer').innerHTML);
            winningPlayerIndex = parseInt(winningPlayerIndex) + 1;

            //generate first row
            var newFirstRow = 
            '<div class="rowOfTwo">';
            var j = winningPlayerIndex + 1;
            if (j == playerCount) {
                j = 1;
            }
            for (let i = 0; i < 2; i++) {
                console.log('generating ' + j);
                if (document.getElementById(j + 'nameCell')) {
                    document.getElementById(j + 'playerDiv').querySelector('.topRow').removeChild(document.getElementById(j + 'nameCell'));
                }
                firstRowDiv = '<div class="playerDiv reduced" id = "' + j + 'playerDiv">' + document.getElementById(j + 'playerDiv').innerHTML + '</div>';
                newFirstRow = newFirstRow + firstRowDiv;
                if (j == playerCount) {
                    j = 1;
                }
                else {
                    j = j + 1;
                }
            }
            newFirstRow = newFirstRow + '</div>';

            //generate second row
            var newSecondRow = 
            '<div class="rowOfTwo">';
            for (let i = 0; i < 2; i++) {
                console.log('generating ' + j);
                if (document.getElementById(j + 'nameCell')) {
                    document.getElementById(j + 'playerDiv').querySelector('.topRow').removeChild(document.getElementById(j + 'nameCell'));
                }
                secondRowDiv = '<div class="playerDiv reduced" id = "' + j + 'playerDiv">' + document.getElementById(j + 'playerDiv').innerHTML + '</div>';
                newSecondRow = newSecondRow + secondRowDiv;
                if (j == playerCount) {
                    j = 1;
                }
                else {
                    j = j + 1;
                }
            }
            newSecondRow = newSecondRow + '</div>';

            //generate current row
            var newCurrentRow = '<div class ="currentOne">';
            if (!document.getElementById(winningPlayerIndex + 'nameCell')) {
                var newNameCell = document.createElement("p");
                newNameCell.className = 'name';
                newNameCell.id = winningPlayerIndex + 'nameCell';
                document.getElementById(winningPlayerIndex + 'playerDiv').querySelector('.topRow').querySelector('.profile').insertAdjacentElement("afterEnd", newNameCell,);
            }
            var currentPlayerDiv = '<div class = "playerDiv full"' + 'id = "' + 
            winningPlayerIndex + 'playerDiv">' + document.getElementById(winningPlayerIndex + 'playerDiv').innerHTML + '</div>';
            var newCurrentRow = newCurrentRow + currentPlayerDiv + '</div>';

            var infoTable = '<table class="center gameInfo">' +
            '<tr>' +
            '  <td class="infoCell" id="helpCell"></td>' +
            '</tr>' +
            '</table>';

            document.getElementById('infoContainer').innerHTML = newFirstRow + newSecondRow + newCurrentRow + infoTable;
            console.log(document.getElementById('infoContainer').innerHTML);
            break;
    }
}
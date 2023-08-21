function rearrangePlayers(winningPlayerIndex) {
    //create new order

    order = playersArray[winningPlayerIndex];
    console.log('appending:' + winningPlayerIndex);

    var i = parseInt(winningPlayerIndex);
    i = (i + 1) % playerCount;
    for (let j = 0; j < playerCount - 1; j++) {
        // Add the current player to the order
        order += ',' + playersArray[i];
        
        // Increment the index and wrap around if needed
        i = (i + 1) % playerCount;
    }
    
    console.log(order);

    //generate new table
    generateTable(order);
}
function rearrangePlayers(winningPlayerIndex) {
    //create new order

    order = playersArray[winningPlayerIndex];

    var i = parseInt(winningPlayerIndex);
    i = (i + 1) % playerCount;
    for (let j = 0; j < playerCount - 1; j++) {
        // Add the current player to the order
        order += ',' + playersArray[i];
        
        // Increment the index and wrap around if needed
        i = (i + 1) % playerCount;
    }

    if (playerCount == '5') {
        orderArray = order.split(',');
        temp = orderArray[0];
        orderArray[0] = orderArray[4];
        orderArray[4] = temp;
        order = orderArray.join(',');
    }

    //update order on server
    $.ajax({
        url: "scripts/setOrder.php", // Replace with your PHP script's path
        method: "POST", // Use POST if you're sending data to the server
        data: { order: order }, // Include your data here
    
        success: function (response) {
            // Handle the success response here
            console.log("Order set successfully:", response);
    
            // Generate the new table after the order has been set
            generateTable();
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.error("Error setting order:", error);
        },
    });
    
}
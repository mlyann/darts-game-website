function generateTable(order = "default") {
    var order = {order: order};

    $.ajax({
        url: 'scripts/generateTable.php',
        method: 'GET',
        data: order,
        dataType: 'html',
        success: function(data) {
            console.log(data);
            // Insert the PHP script's response into the 'phpResponse' div
            document.getElementById('generatedTable').innerHTML = data;
        },
        error: function(xhr, status, error) {
            console.error('Error with generateTable:', error);
        }
    });
}
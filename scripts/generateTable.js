function generateTable() {
    $.ajax({
        url: 'scripts/generateTable.php',
        method: 'GET',
        dataType: 'html',
        success: function(data) {
            // Insert the PHP script's response into the 'phpResponse' div
            document.getElementById('generatedTable').innerHTML = data;
        },
        error: function(xhr, status, error) {
            console.error('Error with generateTable:', error);
        }
    });
}
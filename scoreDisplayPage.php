<!DOCTYPE html>
<html>
<head>
    <title>Display</title>
    <link rel="stylesheet" type="text/css" href="styles/scoreDisplayPage.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <table id="scoreTable">
        <tr>
            <th>Name</th>
            <th>Overall</th>
            <th>Turn</th>
            <th>First</th>
            <th>Second</th>
            <th>Third</th>
        </tr>
    </table>

    <script>
        // Function to update the table content with AJAX
        function updateTableContent() {
            $.ajax({
                url: 'scripts/generateScoreDisplay.php', // Replace with the path to your PHP script
                method: 'GET',
                dataType: 'html',
                success: function (data) {
                    $('#scoreTable').html(data);
                },
                error: function (xhr, status, error) {
                    console.error('Error updating scores:', status, error);
                }
            });
        }

        // Call the updateTableContent function every 1 second (1000 milliseconds)
        setInterval(updateTableContent, 1000);
    </script>
</body>
</html>

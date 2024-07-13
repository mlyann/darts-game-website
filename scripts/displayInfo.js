async function displayInfo() {
    try {
      if (gamemode == 'Countdown') {
        displayInfoCD();
      } else if (gamemode == 'Highscore') {
        const order = await new Promise(function(resolve, reject) {
          $.ajax({
            url: 'scripts/getOrder.php',
            method: 'GET',
            success: function(data) {
              resolve(data); // Resolve the Promise with the data
            },
            error: function(xhr, status, error) {
              console.log(error);
              reject(error); // Reject the Promise with an error message
            }
          });
        });
        displayInfoHS(order);
      }
    } catch (error) {
      console.error('Error:', error);
    }
  }
  
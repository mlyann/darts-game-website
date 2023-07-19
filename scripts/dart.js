function dart(score, multiplierValue){
  $.ajax({
    url: "scripts/dart.php",
    type: "POST",
    data: {
      score: score * multiplierValue,
      multiplierValue: multiplierValue
    },
    error: function(xhr, status, error){
      console.log("Error sending data to dart.php: " + error);
    }
  });
}
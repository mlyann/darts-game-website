function dart(score){


    if(dartIndex < 3){//disable buttons after dart limit is reached
      
      turnScores[dartIndex] = score;
    
      dartIndex++;
      console.log(turnScores);
    }
  }
function dart(score, multiplierValue){

  if(dartIndex < 3){//disable buttons after dart limit is reached
    score = multiplierValue * score;

    turnScores[dartIndex] = score;
  
    dartIndex++;
    console.log(turnScores);
  }
}
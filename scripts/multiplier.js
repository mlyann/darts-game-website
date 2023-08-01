function multiplier(value) {
  //toggle on
  if (multiplierActive === false) {
    multiplierActive = true;

    //change color of multiplier button
    if (value === 'double') {
      multiplierValue = 2;
      doubleButton.classList.add('double');
    } else {
      multiplierValue = 3;
      tripleButton.classList.add('triple');
    }

    //change colors of input buttons
    if (multiplierValue === 2) {
      for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.add('double');
      }
    }
    else {
      for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.add('triple');
      }
    }

    //deal with bullseye
    if (multiplierValue === 2) {
      bullButton.classList.add('double');
    }

  }
  else { //toggle off
    resetMultipliers();
  }
}
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
    multiplierActive = false;
    if (multiplierValue == 2) {
      doubleButton.classList.remove ('double');

      bullButton.classList.remove('double');

      for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('double');
      }
    }
    else {
      tripleButton.classList.remove('triple');

      for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('triple');
      }
    }

    multiplierValue = 1;
  }
}
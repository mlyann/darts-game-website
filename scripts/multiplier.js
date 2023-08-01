function multiplier(value) {
  //toggle on
  if (multiplierActive === false) {
    multiplierActive = true;

    //change color of multiplier button
    if (value === 'double') {
      multiplierValue = 2;
      let doubleButton = document.getElementById('doubleButton');
      doubleButton.style.backgroundColor = 'red';
    } else {
      multiplierValue = 3;
      let tripleButton = document.getElementById('tripleButton');
      tripleButton.style.backgroundColor = 'green';
    }

    //change colors of input buttons
    const buttons = document.getElementsByClassName('numInput');
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
      let bullButton = document.getElementById('input_25');
      bullButton.style.backgroundColor = 'red';
    }

  }
  else { //toggle off
    multiplierActive = false;
    const buttons = document.getElementsByClassName('numInput');
    if (multiplierValue == 2) {
      let doubleButton = document.getElementById('doubleButton');
      doubleButton.style.backgroundColor = '';

      let bullButton = document.getElementById('input_25');
      bullButton.style.backgroundColor = '';

      for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('double');
      }
    }
    else {
      let tripleButton = document.getElementById('tripleButton');
      tripleButton.style.backgroundColor = '';

      for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('triple');
      }
    }

    multiplierValue = 1;
  }
}
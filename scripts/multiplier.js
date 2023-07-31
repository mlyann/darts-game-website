function multiplier(value) {
  //toggle on
  if (multiplierActive === false) {
    
    multiplierActive = true;
    if (value === 'double') {
      multiplierValue = 2;
      let doubleButton = document.getElementById('doubleButton');
      doubleButton.style.backgroundColor = 'red';
    } else {
      multiplierValue = 3;
      let tripleButton = document.getElementById('tripleButton');
      tripleButton.style.backgroundColor = 'green';
    }
    const buttons = document.getElementsByClassName('numInput');
    //change colors
    if (multiplierValue === 2) {
      for (let i = 0; i < buttons.length; i++) {
        buttons[i].style.backgroundColor = 'red';
      }
    }
    else {
      for (let i = 0; i < buttons.length; i++) {
        buttons[i].style.backgroundColor = 'green';
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

    let doubleButton = document.getElementById('doubleButton');
    doubleButton.style.backgroundColor = '';
    let tripleButton = document.getElementById('tripleButton');
    tripleButton.style.backgroundColor = '';
    
    const buttons = document.getElementsByClassName('numInput');
    //reset colors
    for (let i = 0; i < buttons.length; i++) {
      buttons[i].style.backgroundColor = '';
    }

    multiplierValue = 1;
    let bullButton = document.getElementById('input_25');
    bullButton.style.backgroundColor = '';
  }
}
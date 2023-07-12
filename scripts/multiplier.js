function multiplier(value) {
    //toggle on
    if (multiplierActive === false) {
      
      multiplierActive = true;
      if (value === 'double') {
        multiplierValue = 2;
        let doubleButton = document.getElementsByName('doubleButton')[0];
        doubleButton.style.backgroundColor = 'red';
      } else {
        multiplierValue = 3;
        let tripleButton = document.getElementsByName('tripleButton')[0];
        tripleButton.style.backgroundColor = 'green';
      }
      const buttons = document.getElementsByName('scoreButton');
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
      
  
      //change values
      for (let i = 0; i < buttons.length; i++) {
        let currentValue = parseInt(buttons[i].innerText);
        let newValue = currentValue * multiplierValue;
        buttons[i].innerText = newValue;
      }
  
      //deal with bullseye
      if (multiplierValue === 2) {
        let bullButton = document.getElementsByName('bullButton')[0];
        bullButton.style.backgroundColor = 'red';
      }
  
    }
    else { //toggle off
      multiplierActive = false;

      let doubleButton = document.getElementsByName('doubleButton')[0];
      doubleButton.style.backgroundColor = '';
      let tripleButton = document.getElementsByName('tripleButton')[0];
      tripleButton.style.backgroundColor = '';
      
      const buttons = document.getElementsByName('scoreButton');
      //reset colors
      for (let i = 0; i < buttons.length; i++) {
        buttons[i].style.backgroundColor = '';
      }
  
      //reset values
      for (let i = 0; i < buttons.length; i++) {
        let currentValue = parseInt(buttons[i].innerText);
        let newValue = currentValue / multiplierValue;
        buttons[i].innerText = newValue;
      }
      multiplierValue = 1;
      let bullButton = document.getElementsByName('bullButton')[0];
      bullButton.style.backgroundColor = '';
    }
  }
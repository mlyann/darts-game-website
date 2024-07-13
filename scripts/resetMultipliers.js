function resetMultipliers() {
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
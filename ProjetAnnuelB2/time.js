function startTime() {
    let today = new Date();
    let hours = today.getHours();
    let minutes = today.getMinutes();
    let seconds = today.getSeconds();

    minutes = checkTime(minutes);
    seconds = checkTime(seconds);
    document.getElementById('clock').innerHTML =
    hours + ":" + minutes + ":" + seconds;
    const time = setTimeout(startTime, 500);
  }
  function checkTime(i) {
    if (i < 10) {
      i = "0" + i;
    }
    return i;
  }
  startTime();
  
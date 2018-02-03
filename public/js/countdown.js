
class TimeDiff {
  constructor() {
    var mk18 = new Date("2018-03-15 00:00:00");
    var rem = new Date();
    var diff = new Object();

    var totalDiff = mk18.getTime() - rem.getTime();

    diff.days = Math.floor(totalDiff / 1000 / 60 / 60 / 24);
    totalDiff -= diff.days * 1000 * 60 * 60 * 24;

    diff.hours = Math.floor(totalDiff / 1000 / 60 / 60);
    totalDiff -= diff.hours * 1000 * 60 * 60;

    diff.minutes = Math.floor(totalDiff / 1000 / 60);
    totalDiff -= diff.minutes * 1000 * 60;

    diff.seconds = Math.floor(totalDiff / 1000);
    return diff;
  }
}

setInterval(function () {
  var time = new TimeDiff();
  $('.days h2').text(time.days);
  $('.hours h2').text(time.hours);
  $('.minutes h2').text(time.minutes);
  $('.seconds h2').text(time.seconds);
}, 1000);

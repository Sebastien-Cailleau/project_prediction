$('input[type=file]').change(function (e) {
  $(this).next('.custom-file-label').text(e.target.files[0].name)
})

var countDownDate = new Date('Nov 16, 2020 11:11:00').getTime()

var x = setInterval(function () {
  var now = new Date().getTime()
  var distance = countDownDate - now

  var days = Math.floor(distance / (1000 * 60 * 60 * 24))
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
  var seconds = Math.floor((distance % (1000 * 60)) / 1000)

  document.getElementById('countDown').innerHTML =
    days +
    ' jours ' +
    hours +
    ' heures ' +
    minutes +
    ' minutes ' +
    seconds +
    ' secondes'

  if (distance < 0) {
    clearInterval(x)
    document.getElementById('countDown').innerHTML =
      "C'est l'heure de courir ! <small>devant la télé !</small>"
  }
}, 1000)

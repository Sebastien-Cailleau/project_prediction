/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css'

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

// Display filesnames in bootstrap form field
// $('input[type=file]').change(function (e) {
//   $(this).next('.custom-file-label').text(e.target.files[0].name)
// })

// _____________________________________check for next Race_____________________________

let nextRaceDiv = document.getElementById('nextRace')
let nextRaceDate = new Date(nextRaceDiv.innerHTML)
let currentDate = new Date()
let countdownInterval = (nextRaceDate - currentDate) / 1000
let daysCount = Math.floor(countdownInterval / 86400)
let hoursCount = Math.floor((countdownInterval - daysCount * 86400) / 3600) % 86400
let minutesCount = Math.floor((countdownInterval - daysCount * 86400 - hoursCount * 3600) / 60) % 3600
let secondsCount = Math.floor(countdownInterval - daysCount * 86400 - hoursCount * 3600 - minutesCount * 60)

// _____________________________________CounDown________________________________________

// Create Countdown
let Countdown = {
  // Backbone-like structure
  $el: $('.countdown'),

  // Params
  countdown_interval: null,
  total_seconds: 0,

  // Initialize the countdown
  init: function () {
    // DOM
    this.$ = {
      days: this.$el.find('.bloc-time.days .figure'),
      hours: this.$el.find('.bloc-time.hours .figure'),
      minutes: this.$el.find('.bloc-time.min .figure'),
      seconds: this.$el.find('.bloc-time.sec .figure'),
    }

    // Init countdown values
    this.values = {
      days: daysCount,
      hours: hoursCount,
      minutes: minutesCount,
      seconds: secondsCount,
    }

    // Initialize total seconds
    this.total_seconds = countdownInterval

    // Animate countdown to the end
    this.count()
  },

  count: function () {
    let that = this,
      $day_1 = this.$.days.eq(0),
      $day_2 = this.$.days.eq(1),
      $hour_1 = this.$.hours.eq(0),
      $hour_2 = this.$.hours.eq(1),
      $min_1 = this.$.minutes.eq(0),
      $min_2 = this.$.minutes.eq(1),
      $sec_1 = this.$.seconds.eq(0),
      $sec_2 = this.$.seconds.eq(1)

    this.countdown_interval = setInterval(function () {
      if (that.total_seconds > 0) {
        --that.values.seconds

        if (that.values.minutes >= 0 && that.values.seconds < 0) {
          that.values.seconds = 59
          --that.values.minutes
        }

        if (that.values.hours >= 0 && that.values.minutes < 0) {
          that.values.minutes = 59
          --that.values.hours
        }

        if (that.values.days >= 0 && that.values.hours < 0) {
          that.values.hours = 23
          --that.values.days
        }

        // Update DOM values
        // Days
        that.checkHour(that.values.days, $day_1, $day_2)

        // Hours
        that.checkHour(that.values.hours, $hour_1, $hour_2)

        // Minutes
        that.checkHour(that.values.minutes, $min_1, $min_2)

        // Seconds
        that.checkHour(that.values.seconds, $sec_1, $sec_2)

        --that.total_seconds
      } else {
        clearInterval(that.countdown_interval)
      }
    }, 1000)
  },

  animateFigure: function ($el, value) {
    let that = this,
      $top = $el.find('.top'),
      $bottom = $el.find('.bottom'),
      $back_top = $el.find('.top-back'),
      $back_bottom = $el.find('.bottom-back')

    // Before we begin, change the back value
    $back_top.find('span').html(value)

    // Also change the back bottom value
    $back_bottom.find('span').html(value)

    // Then animate
    TweenMax.to($top, 0.8, {
      rotationX: '-180deg',
      transformPerspective: 300,
      ease: Quart.easeOut,
      onComplete: function () {
        $top.html(value)

        $bottom.html(value)

        TweenMax.set($top, { rotationX: 0 })
      },
    })

    TweenMax.to($back_top, 0.8, {
      rotationX: 0,
      transformPerspective: 300,
      ease: Quart.easeOut,
      clearProps: 'all',
    })
  },

  checkHour: function (value, $el_1, $el_2) {
    let val_1 = value.toString().charAt(0),
      val_2 = value.toString().charAt(1),
      fig_1_value = $el_1.find('.top').html(),
      fig_2_value = $el_2.find('.top').html()

    if (value >= 10) {
      // Animate only if the figure has changed
      if (fig_1_value !== val_1) this.animateFigure($el_1, val_1)
      if (fig_2_value !== val_2) this.animateFigure($el_2, val_2)
    } else {
      // If we are under 10, replace first figure with 0
      if (fig_1_value !== '0') this.animateFigure($el_1, 0)
      if (fig_2_value !== val_1) this.animateFigure($el_2, val_1)
    }
  },
}

// Let's go !
Countdown.init()

"use strict"

var bsNotify = function (notifyType, notifyText) {
  var content = {};

  content.message = notifyText;

  if (notifyType === 'error') {
    notifyType = 'danger'
  }

  $.notify(content, {
    type: notifyType,
    allow_dismiss: true,
    spacing: 10,
    timer: 2000,
    placement: {
      from: 'top',
      align: 'right'
    },
    offset: {
      x: 30,
      y: 30
    },
    delay: 1000,
    z_index: 10000,
    animate: {
      enter: 'animate__animated animate__bounce',
      exit: 'animate__animated animate__bounce'
    }
  });
}
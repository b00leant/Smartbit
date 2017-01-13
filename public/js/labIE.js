var position = $('div#slide-lab.side-nav').position();
console.log('posizione di slide-lab:');
console.log(position);
var percentLeft = position.left/$(window).width() * 100;
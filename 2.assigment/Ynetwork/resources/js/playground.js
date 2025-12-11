import { animate, splitText, stagger, utils, svg, spring, createTimeline } from "animejs";

const { chars } = splitText('.title-target', {
  chars: { wrap: 'visible' },
  debug: false,
 });

const  charswithoutY  = chars.slice();
charswithoutY.splice(0,1);
const $formular = utils.$('.formular-container');
const [ $path1, $path2 ] = utils.$('polygon');


 const turn = () => animate(chars, {
  // Property keyframes
  y: [
    { to: '-2.75rem', ease: 'outExpo', duration: 600 },
    { to: 0, ease: 'outBounce', duration: 800, delay: 100 }
  ],
  // Property specific parameters
  rotate: {
    from: '-1turn',
    delay: 0
  },
  delay: stagger(50),
  ease: 'inOutCirc',
  loop: false
});

 

const drawsvgY = () => animate($path1, {
  opacity: [{ to: 1 }],
  duration: 100,
  easing: 'linear',
  onComplete: () => { deleteY().play(); },
})


const deleteY = () => animate(chars[0], {
  opacity: 0,
  duration: 4,
  easing: 'linear',
  onComplete: () => { startWaitingAnimation(); },
})


  const swarm = () => animate(chars, {
    y: [
      { from: utils.random(-500, 500) },
    ],
    x: [
      { from: utils.random(-500, 500) },
    ],
   
    rotate: [
      { from: 180 },
    ],
    duration: () => utils.random(2000, 2800),
    delay: () => 1000,
    ease: 'outElastic(1, .5)',
    autoplay : false,
    onComplete: () => { turn().play(); }
  })

 function loopAnimation() {
   sleep(2000).then(() => {zoom().play()});
 }



 function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
 
// polygon animation

 
function animateRandomPoints() {
  // Update the points attribute on #path-2
  utils.set($path2, { points: generatePoints() });
  // Morph the points of #path-1 into #path-2
  animate($path1, {
    points: svg.morphTo($path2),
    ease: 'inOutCirc',
    duration: 1200,
    onComplete: animateRandomPoints
  });
}



function startWaitingAnimation() {

animateRandomPoints();
}


function generatePoints() {
  const total = utils.random(4, 20);
  const r1 = utils.random(20, 60);
  const r2 = 100;
  const isOdd = n => n % 2;
  let points = '';
  for (let i = 0, l = isOdd(total) ? total + 1 : total; i < l; i++) {
    const r = isOdd(i) ? r1 : r2;
    const a = (2 * Math.PI * i / l) - Math.PI / 2;
    const x = 100 + utils.round(r * Math.cos(a), 0);
    const y = 100 + utils.round(r * Math.sin(a), 0);
    points += `${x},${y} `;
  }
  return points;
}


const timeline = createTimeline({autoplay: false});
timeline.label('start')
.label('fade', 100)
.add(chars[0], {
  x: [{to: ((window.innerWidth/2)-chars[0].getBoundingClientRect().x) - (chars[0].getBoundingClientRect().width/2), ease: 'inexpo'}], 
  y: [{to: ((window.innerHeight/2)-chars[0].getBoundingClientRect().y) - (chars[0].getBoundingClientRect().height/2), ease: 'inexpo'}],
  scale: [
    { to: 4, ease: 'inexpo' },
  ],
  loop: false,
  composition: 'none',
  duration: 1000,
  onComplete: () => { drawsvgY().play(); },
}, 'start')
.add($formular, {
  opacity: 0,
  duration: 500,
  easing: 'linear',
  composition: 'replace',
}, 'fade')
.add(charswithoutY, {
  opacity: 0,
  duration: 500,
  easing: 'linear',
  composition: 'replace',
}, 'fade');

export function startAnimation() {
  console.log("Entered startAnimation()");
    timeline.play(); 
}
window.startAnimation = startAnimation;

function welcomingAnimation() {
swarm().play();
}
welcomingAnimation();

const shiftleft = () => animate('.password-input', {
  x: '-4rem',
  ease: 'inExpo',
  duration: 300,
  onComplete: () => { shaker().play(); },
});


const shaker = () => animate('.password-input', {
  x: '0rem',
  ease: spring({
    bounce: 0.9,
    duration: 200
  })


});
export function sayNoAnimation() {
  console.log("Entered sayNo()");
    shiftleft().play();
}
window.sayNoAnimation = sayNoAnimation;

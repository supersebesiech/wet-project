import { animate, splitText, stagger, utils, svg, spring, createTimeline } from "animejs";

const { chars } = splitText('.title-target', {
  chars: { wrap: 'visible' },
  debug: false,
 });

const $formular = utils.$('.formular-container');
const [ $path1, $path2 ] = utils.$('polygon');











  const shift = () => animate(chars, {
    y: [
      { to: ['100%', '0%'] },
      { to: '-100%', delay: 1000, ease: 'in(3)' },
      { to: ['100%', '0%'] },
    ],
    duration: 750,
    ease: 'out(3)',
    delay: stagger(50),
    
  });

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
  loopDelay: 1000,
  loop: false
});

 

const zoom = () => animate(chars[0], {
  x: [{to: ((window.innerWidth/2)-chars[0].getBoundingClientRect().x) - (chars[0].getBoundingClientRect().width/2), ease: 'inexpo'}], 
  y: [{to: ((window.innerHeight/2)-chars[0].getBoundingClientRect().y) - (chars[0].getBoundingClientRect().height/2), ease: 'inexpo'}],
  scale: [
    { to: 4, ease: 'inexpo' },
  ],
  loop: false,
  duration: 1000,
  onComplete: () => { drawsvgY().play(); },
  autoPlay: false,
});

const drawsvgY = () => animate($path1, {
  opacity: [{ to: 1 }],
  duration: 100,
  easing: 'linear',
  onComplete: () => { deleteStuff().play(); },
})


const deleteStuff = () => animate(chars[0], {
  opacity: 0,
  duration: 4,
  easing: 'linear',
  onComplete: () => { startWaitingAnimation(); },
})

const deleteBackground = () => animate($formular, {
  opacity: 0,
  duration: 1000,
  easing: 'linear',
  autoplay: false,
})

  const swarm = () => animate(chars, {
    y: [
      { from: utils.random(-500, 500) },
    ],
    x: [
      { from: utils.random(-500, 500) },
    ],
    duration: () => utils.random(2000, 2800),
    delay: () => utils.random(0, 400),
    ease: 'outElastic(1, .5)',
    autoplay : false,
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

// Start the animation


function startWaitingAnimation() {
//$path1.style.opacity = '1';
animateRandomPoints();
}

// A function to generate random points on #path-2 on each iteration
// For demo purpose only
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

function customComosition (){

  sleep(3000).then(() => {zoom().play(), deleteBackground().play()});
} 
deleteBackground().play();
//customComosition();
//swarm().play();
//loopAnimation();
//startWaitingAnimation();
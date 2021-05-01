let modalTvEffect = document.querySelector(".modall__tvEffect");
let modalTvEffectContent = document.querySelector(".modall__tvEffect--content");
let sections = document.querySelectorAll('section');

let overlay = document.querySelector(".modall__overlay");

//OVERLAY function animation
let overlayAnimation = function (opacity, display, blur, direction) {
  return new Promise((resolve) => {
    overlay.style.display = `${display}`;
    overlay.style.opacity = `${opacity}`;
    overlay.style.animationDirection = `${direction}`;
    sections.forEach((s) => (s.style.filter = `blur(${blur}px)`));
    resolve(1);
  });
};
//MODAl function animation
let modalTvEffectAnimation = function (direction, display, waitSeconds) {
  return new Promise((resolve) => {
    setTimeout(() => {
      modalTvEffect.style.display = `${display}`;
      modalTvEffect.style.animationDirection = `${direction}`;
      resolve(2);
    }, waitSeconds * 1000);
  });
};
//MODAL CONTENT function animation
let modalTvEffectContentAnimation = function (display, waitSeconds) {
  return new Promise((resolve) => {
    setTimeout(() => {
      modalTvEffectContent.style.opacity = "1";
      modalTvEffectContent.style.display = `${display}`;
      resolve(3);
    }, waitSeconds * 1000);
  });
};

// FORWARD ANIMATION
export  let modalActive = async function () {
  let first = await overlayAnimation(1, "block", 3, "normal");
  let second = await modalTvEffectAnimation("normal", "block", 0.6);
  let third = await modalTvEffectContentAnimation("flex", 0.7);
  setTimeout(() => {
    overlay.addEventListener("click", () => {
      modalReverse();
    });
  }, 500);
};

// RESET function
export let reset = async function (name1, name2) {
  // NOTE
  // css animation can not be used after the first lunch , unless reset
  name1.classList.remove(`${name2}`);
  name1.offsetWidth;
  name1.classList.add(`${name2}`);
};
// REVERSE ANIMATION
export let modalReverse = async function () {
  // CARD CONTENT
  let one = await modalTvEffectContentAnimation("none", 0);
  // CARD
  let two = await reset(modalTvEffect, "modall__tvEffect");
  let three = await modalTvEffectAnimation("reverse", "block", 0);

  // OVERLAY
  let four = await reset(overlay, "modall__overlay");
  let five = await overlayAnimation(0, "block ", 0, "reverse");
  setTimeout(() => {
    modalTvEffect.style.display = `none`;
    overlay.style.display = `none`;
  }, 600);
};

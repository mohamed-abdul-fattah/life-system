import anime from "animejs/lib/anime.es.js";

let modalTvEffect = document.querySelector(".modall__tvEffect");
let modalTvEffectContent = document.querySelector(".modall__tvEffect--content");
let overlay = document.querySelector(".modall__overlay");
//OVERLAY function animation
export let modalEffect = function (direction, display1, display2) {
  overlay.style.display = `${display1}`;
  anime({
    targets: ".modall__overlay",
    opacity: [0, 1],
    direction: `${direction}`,
    duration: 500,
    easing: "linear",
    begin: function (anim) {
      modalTvEffect.style.display = `${display1}`;
      modalTvEffectContent.style.display = `${display2}`;
      anime({
        targets: ".modall__tvEffect--content",
        opacity: [0, 1],
        delay: 700,
        direction: `${direction}`,
      });
      anime({
        targets: "section",
        filter: ["blur(0px)", "blur(1px)"],
        direction: `${direction}`,
        easing: "linear",
        duration: 100,
        delay: 100,
      });
    },
  });
  overlay.addEventListener("click", function () {
    modalEffect("reverse", "none", "none");
  });
};

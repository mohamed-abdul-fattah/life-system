
let labelLetter = document.querySelector(".expense__form--content-header");
let inputs = document.querySelectorAll('.expense__form--content-input');
inputs.forEach(input=>{
    input.addEventListener("mouseover", function(e){
      e.target.parentElement.parentElement.firstElementChild.style.letterSpacing = ".8rem";
    })
    input.addEventListener("mouseout", function(e){
      e.target.parentElement.parentElement.firstElementChild.style.letterSpacing = ".3rem";
    })
})

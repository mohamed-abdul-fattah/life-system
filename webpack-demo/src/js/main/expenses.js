// js
import * as modal from "../modal";
// import { reset } from "../globalFunctions";
console.log("modalActive" , modal.modalActive);
// scss
import "../../scss/main.scss";

let forms = document.querySelectorAll('form');
let cofirmBtn = document.querySelector('.cofirm') ;
let ignoreBtn = document.querySelector('.ignore') ;

Array.from(forms).forEach((form) => {
    form.addEventListener('submit', function (evt) {
        evt.preventDefault();
        modal.modalActive();

        cofirmBtn.addEventListener('click',()=> {
            form.submit();                          
            modal.modalReverse();
            } );
        ignoreBtn.addEventListener('click',()=> {
            modal.modalReverse();
            } )
    }, true);
});
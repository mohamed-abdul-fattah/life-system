
// Reset Css Animation
let reset =  function(name1 , name2){
    // NOTE 
    // css animation can not be used after the first lunch , unless reset 
    name1.classList.remove(`${name2}`);
    name1.offsetWidth;
    name1.classList.add(`${name2}`);
}

// Card Animation 
let cardAnimation = function(direction ,height ,width ,padding , background, boxShadow ,display , seconds){
    cardChart.style.animationDirection = `${direction}`;
    cardChart.style.height=`${height}`;
    cardChart.style.width= `${width}`;
    cardChart.style.padding = `${padding}`
    setTimeout(() => {
        cardChart.style.backgroundColor = `${background}`;
        cardChart.style.boxShadow = `${boxShadow}`;  
        chartContainer.style.display = `${display}`
    }, 1000 * `${seconds}`);
}
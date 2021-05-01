import {reset , cardAnimation } from "./globalFunctions"

let chart = document.getElementById('chart');
export let chartContainer = document.querySelector('.card__chart--container');

let chartPropertiesOrignal = {
    type : `pie`,
    data: {
        labels: [],
        datasets: [{
            data: [],
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2 ,
        }]
    },
    options: {  
        tooltips : {
            titleFontSize : 20 ,
            bodyFontSize : 20
        },
        legend : {
            display : false ,
            position : 'bottom' ,
            align : 'center',
            fullWidth : false ,
            labels : {
                boxWidth : 50 ,
                fontSize : 15 ,
                fontStyle : "bold" ,
                usePointStyle : true 
            }
        },
        animation : {
            duration : 2500,
            easing : 'easeOutCirc' ,
        },
        maintainAspectRatio : false , 
        events: ['mousemove'],
    }
};

let myChart ;
let chartEditProperties ;
let changeChart = function(newType ,categories ,numbers){
        if (myChart){
            myChart.destroy();
        }
        // Hard Copy Orignial Chart Properties 
        chartEditProperties = JSON.parse(JSON.stringify(chartPropertiesOrignal));
        // Edits 
        chartEditProperties.type = newType ;
        chartEditProperties.data.labels = categories ; 
        chartEditProperties.data.datasets[0].data = numbers ; 

        return  myChart =  new Chart(chart, chartEditProperties )
    }

// Buttons
let btnChartLine     = document.querySelector(".card__btns--line");
let btnChartBar      = document.querySelector(".card__btns--bar");
let btnChartDoughnut = document.querySelector(".card__btns--doughnut");
let btnChartPolar    = document.querySelector(".card__btns--polar");

btnChartLine.addEventListener('click' , function(e){
    e.preventDefault();
    changeChart('line',["one","two","three","four","five" ,"six"],[9,9,8,7,6,90]) ;            
})
btnChartBar.addEventListener('click' , function(e){
    e.preventDefault();
    changeChart('bar',["one","two","three","four","five"],[9,99,80,19,96]) ;
})
btnChartDoughnut.addEventListener('click' , function(e){
    e.preventDefault();
    changeChart('doughnut',["one","two","three","four","five"],[9,99,80,19,96]) ;
})
btnChartPolar.addEventListener('click' , function(e){
    e.preventDefault();
    changeChart('polarArea',["one","two","three","four","five"],[9,99,80,19,96]) ;
})


// Chart Legends 
let html = '' ; 
let legendBox ;
let legends = document.querySelector('.legend') ;
let btnLegend = document.querySelector(".card__btns--legends");

// Chart Legends Button (Display/hidden)
btnLegend.addEventListener('click' , function(e){
    e.preventDefault();
    // Display
    if(legends.style.display === "none" || legends.style.display === "" ){
        // Animation Reset
        reset(legends,"legend");
        // Legend Display
        legends.style.animationDirection = 'normal';
        legends.style.display = "flex";
        html = '' ;       
        legends.innerHTML = ''     
        chartEditProperties.data.labels.forEach((_,i)=>{
            html += `
                <div class="legend__container">
                    <div class="legend__container--box"></div>
                    <div class="legend__container--name"> ${chartEditProperties.data.labels[i]} </div>
                </div>
            `
        })
        legends.insertAdjacentHTML('beforeend',html)
        legendBox = document.querySelectorAll(".legend__container--box");
        for(let i = 0 ; i<chartEditProperties.data.labels.length; i++){
            legendBox[i].style.backgroundColor = chartEditProperties.data.datasets[0].backgroundColor[i]   
        }
    } else {
        // Animation Reset
        reset(legends,"legend");
        // legend Hidden
        legends.style.animationDirection = 'reverse'
        setTimeout(() => { legends.style.display="none" }, 450); 
        html = '';
        legends.innerHTML = '';
    }
})

let cases = true ; 
btnLegend.addEventListener('click',function(e){
    e.preventDefault();
    if(cases || btnLegend.style.transform === 'rotateZ(0deg)'){
        btnLegend.style.transform = 'rotateZ(180deg)';
        return cases = false ;
    }
    else {
        btnLegend.style.transform = 'rotateZ(0deg)';
        return cases = true ;
    }
})

////////////////////////////////////////////////////////////////////

export let cardChart = document.querySelector(".card__chart") ;
let btnCardDisplay   = document.querySelector('.card__btns--display');

// Chart Display/Hidden
cardChart.classList.remove("card__chart");
cardChart.style.height="0px";

btnCardDisplay.addEventListener('click' , function(e){
    e.preventDefault();
    if(cardChart.style.height===""||cardChart.style.height==="0px"){
        // Buttons Animation
        btnCardDisplay.style.transform = 'rotateZ(180deg)';
        document.querySelector(".card__btns--legends").style.display = "block"
        // Card Chart Box Animation
        reset(cardChart,"card__chart");
        cardAnimation("normal","330px","321px","13px",'#202b33',"inset 3px 4px 12px 0px black",'block',.7)

    } else {
        // Buttons Animation                
        btnCardDisplay.style.transform = 'rotateZ(0deg)';
        document.querySelector(".card__btns--legends").style.display = "none"
        // Card Chart Box Animation
        reset(cardChart,"card__chart");
        cardAnimation("reverse","0px","0px","0px",'#313131',"inset 0px 0px 0px 0px black",'none',0);

        // Animation reset
        reset(legends,"legend");
        // Legend Dissapear
        legends.style.animationDirection = 'reverse'
        setTimeout(() => { legends.style.display="none" }, 450); 
        html = '';
        legends.innerHTML = '';
        document.querySelector(".card__btns--legends").style.transform = 'rotateZ(0deg)';
    }
})

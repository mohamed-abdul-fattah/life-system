// import { reset, cardAnimation } from "./globalFunctions";
import anime from "animejs/lib/anime.es.js";

let chart = document.getElementById("chart");
let chartPropertiesOrignal = {
  type: `pie`,
  data: {
    labels: [],
    datasets: [
      {
        data: [],
        backgroundColor: [
          "rgba(255, 99, 132, 0.7)",
          "rgba(54, 162, 235, 0.7)",
          "rgba(255, 206, 86, 0.7)",
          "rgba(75, 192, 192, 0.7)",
          "rgba(153, 102, 255, 0.7)",
          "rgba(255, 159, 64, 0.7)",
        ],
        borderColor: [
          "rgba(255, 99, 132, 1)",
          "rgba(54, 162, 235, 1)",
          "rgba(255, 206, 86, 1)",
          "rgba(75, 192, 192, 1)",
          "rgba(153, 102, 255, 1)",
          "rgba(255, 159, 64, 1)",
        ],
        borderWidth: 2,
      },
    ],
  },
  options: {
    tooltips: {
      titleFontSize: 10,
      bodyFontSize: 15,
    },
    legend: {
      display: false,
      position: "bottom",
      align: "center",
      fullWidth: false,
      labels: {
        boxWidth: 50,
        fontSize: 10,
        fontStyle: "bold",
        usePointStyle: true,
      },
    },
    animation: {
      duration: 1000,
      easing: "easeOutQuad",
    },
    maintainAspectRatio: false,
    events: ["click"],
  },
};

let myChart;
let chartEditProperties;
let changeChart = function (newType, categories, numbers) {
  if (myChart) {
    myChart.destroy();
  }
  // Hard Copy Orignial Chart Properties
  chartEditProperties = JSON.parse(JSON.stringify(chartPropertiesOrignal));
  // Edits
  chartEditProperties.type = newType;
  chartEditProperties.data.labels = categories;
  chartEditProperties.data.datasets[0].data = numbers;

  return (myChart = new Chart(chart, chartEditProperties));
};

let html;
let legendBox;
let legends = document.querySelector(".legend");
let cardChart = document.querySelector(".card__chart");
let chartContainer = document.querySelector(".card__chart--container");
let btnCardDisplay = document.querySelector(".card__btns--display");

// Chart animation
let cardChartAnimation = function (direction, chartSeconds) {
  if (myChart) {
    myChart.destroy();
  }
  anime({
    targets: ".card__btns--display",
    rotateZ: [0, 180],
    easing: "linear",
    duration: 100,
    direction: `${direction}`,
    begin: function (anim) {
      anime({
        targets: ".card__chart",
        height: ["0rem", "23rem"],
        padding: ["0rem", "1rem"],
        backgroundColor: "#202b33",
        easing: "easeOutQuad",
        duration: 600,
        direction: `${direction}`,

        begin: function (anim) {
          if (direction === "normal") {
            setTimeout(() => {
              changeChart(
                "doughnut",
                ["one", "two", "three", "four", "five"],
                [9, 99, 80, 19, 96]
              );
            }, chartSeconds);
          }
        },
      });
    },
  });
};

// Legend animation
let legendAnimation = function (direction, display, legendSeconds) {
  // Legend html creation
  html = "";
  legends.innerHTML = "";
  chartEditProperties.data.labels.forEach((_, i) => {
    html += `
              <div class="legend__container">
                  <div class="legend__container--box"></div>
                  <div class="legend__container--name"> ${chartEditProperties.data.labels[i]} </div>
              </div>
          `;
  });
  legends.insertAdjacentHTML("beforeend", html);
  legendBox = document.querySelectorAll(".legend__container--box");
  for (let i = 0; i < chartEditProperties.data.labels.length; i++) {
    legendBox[i].style.backgroundColor =
      chartEditProperties.data.datasets[0].backgroundColor[i];
  }
  if (window.innerWidth <= 350) return;
  else {
    // Legend animation
    setTimeout(() => {
      legends.style.display = `${display}`;
    }, legendSeconds);
    anime({
      targets: ".legend",
      width: ["0rem", "7.5rem"],
      padding: [0, "8px 2px"],
      easing: "easeOutQuad",
      duration: 200,
      direction: `${direction}`,
      begin: function (anim) {
        document.querySelectorAll(".legend__container").forEach((l) => {
          l.style.display = `${display}`;
        });
        anime({
          targets: ".legend__container",
          opacity: [0, 1],
          delay: 600,
          direction: `${direction}`,
        });
      },
    });
  }
};

btnCardDisplay.addEventListener("click", function (e) {
  e.preventDefault();
  if (cardChart.style.height === "" || cardChart.style.height === "0rem") {
    console.log(window.innerWidth);
    cardChartAnimation("normal", 600);
    setTimeout(() => {
      legendAnimation("normal", "flex", 0);
    }, 800);
  } else {
    if (window.innerWidth <= 350) {
      cardChartAnimation("reverse", 0);
    } else {
      legendAnimation("reverse", "none", 0);
      setTimeout(() => {
        cardChartAnimation("reverse", 0);
      }, 200);
    }
  }
});

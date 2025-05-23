/**
 * Theme: Mifty - Bootstrap 5 Responsive Admin Dashboard
 * Author: Mannatthemes
 * Profile Js
 */

var options = {
    series: [67],
    chart: {
    height: 170,
    type: 'radialBar',
    offsetY: -10
  },
  colors: ["var(--bs-primary)"],
  plotOptions: {
    radialBar: {
      startAngle: -135,
      endAngle: 135,
      track: {
        background: ["rgba(42, 118, 244, .18)"],
      },
      dataLabels: {
        name: {
          fontSize: '13px',
          offsetY: 50
        },
        value: {
          offsetY: 5,
          fontSize: '15px',
          formatter: function (val) {
            return val + "%";
          }
        }
      }
    }
  },
  
  stroke: {
    dashArray: 2
  },
  labels: ['Compleation'],
  };

  var chart = new ApexCharts(document.querySelector("#complete"), options);
  chart.render();


  const tobii = new Tobii()
/**
 * Theme: Mifty - Bootstrap 5 Responsive Admin Dashboard
 * Author: Mannatthemes
 * Analytics Dashboard Js
 */


  
   //customers-widget
  
   
   var options = {
    chart: {
        height: 250,
        type: 'donut',
    }, 
    plotOptions: {
      pie: {
        donut: {
          size: '80%'
        }
      }
    },
    dataLabels: {
      enabled: false,
    },
  
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
   
    series: [50, 25, 25,],
    legend: {
      show: true,
      position: 'bottom',
      horizontalAlign: 'center',
      verticalAlign: 'middle',
      floating: false,
      fontSize: '13px',
      fontFamily: "Be Vietnam Pro, sans-serif",
      offsetX: 0,
      offsetY: 0,
    },
    labels: [ "Currenet","New", "Retargeted" ],
    colors: ["#6f6af8", "#08b0e7", "#ffc728"],
   
    responsive: [{
        breakpoint: 600,
        options: {
          plotOptions: {
              donut: {
                customScale: 0.2
              }
            },        
            chart: {
                height: 240
            },
            legend: {
                show: false
            },
        }
    }],
    tooltip: {
      y: {
          formatter: function (val) {
              return   val + " %"
          }
      }
    }
    
  }
  
  var chart = new ApexCharts(
    document.querySelector("#customers"),
    options
  );
  
  chart.render();

  var options = {
    chart: {
        height: 290,
        type: 'area',
        width: '100%',
        stacked: true,
        toolbar: {
          show: false,
          autoSelected: 'zoom'
        },
    },
    colors: ['#2a77f4', 'rgba(42, 118, 244, .4)'],
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'straight',
        width: [0, 0],
        dashArray: [0, 4],
        lineCap: 'round',
    },
    grid: {
      padding: {
        left: 0,
        right: 0
      },
      strokeDashArray: 3,
    },
    markers: {
      size: 0,
      hover: {
        size: 0
      }
    },
    series: [{
        name: 'New Visits',
        data: [0,40,90,40,50,30,35,20,10,0,0,0]
    }, {
        name: 'Unique Visits',
        data: [20,80,120,60,70,50,55,40,50,30,35,0]
    }],
  
    xaxis: {
        type: 'month',
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        axisBorder: {
          show: true,
        },  
        axisTicks: {
          show: true,
        },                  
    },
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [100]
      }
    },
    
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    },
    legend: {
      position: 'top',
      horizontalAlign: 'right'
    },
  }
  
  var chart = new ApexCharts(
    document.querySelector("#monthly_income"),
    options
  );
  
  chart.render();


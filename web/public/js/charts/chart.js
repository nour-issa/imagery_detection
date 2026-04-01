$(document).ready(function(){
  var ch5 = null;
  $.ajax({

    url: "../../../application/resources/chart_data.php", // Replace with the path to your PHP file

    type: 'POST',

     data: 'JSON',
    processData: false,
    contentType: false,
    success: function(response){
  // console.log('ssssddddddssssssss')
      
      const qByMonth = response.qByMonth;
      const classDistName = response.classDistName;
      const classDistValue = response.classDistValue;
      const sahiName = response.sahiName;
      const sahiValue = response.sahiValue;
      const sahiName2 = response.sahiName2;
      const sahiValue2 = response.sahiValue2;
      var timeConf = response.timeConf;
      var bubbleData = response.bubbleData;


// console.log(qByMonth);
// console.log(timeConf);
// console.log(sahiValue2);
// console.log("qByMonth");
// console.log("qByMonth");
// console.log("qByMonth");
// console.log("qByMonth");
// console.log("qByMonth");
// console.log("qByMonth");





// const qByMonth = <?php echo json_encode($qByMonth); ?>;
const xValues = ["July","Augast","September","October","November","December","January", "February","March","April","May","June"];
const yValues = [55, 49, 44, 24, 15,55, 49, 44, 24, 15,55, 49];
const barColors = [
    "rgba(255,0,255,0.2)",
    "rgba(255,0,255,0.4)",
    "rgba(255,0,255,0.6)",
    "rgba(255,0,255,0.8)",
    "rgba(255,255,255,1.0)",
  
];




//////////////////////////////
var ch1 = null;
const data= {
    labels: xValues,
    datasets: [{
        label: '# of Users\'s queries to database.',
        
      backgroundColor: barColors,
      data: qByMonth
    }]
  }

const config ={
    type: 'bar',
    data,
    options: {
        scales:{
            y:{
                beginAtZero: true
            }
        }
    }
}




  if(ch1){
    ch1.clear();
    ch1.destroy();
  }
  ch1 = 
  new Chart("queryByMonthChart", config);


//////////////////////////////

//////////////////////////////
// var ch5 = null;
// // console.log(timeConf)
// const data5= {
//     // labels: xValues,
//     datasets: [{
//         label: '# of Users\'s queries to database.',
        
//       // backgroundColor: barColors,
//       data: timeConf
//     }]
//   }

// const config5 ={
//     type: 'scatter',
//     data:data5,
//     options: {
//         scales:{
//             x:{
//               type: 'linear',
//               position: 'bottom'
//             }
//         }
//     }
// }




//   if(ch5){
//     ch5.clear();
//     ch5.destroy();
//   }
//   ch5 = 
//   new Chart("timeConfChart", config5);


//////////////////////////////
var ch2 = null;
  const data2= {
    labels: classDistName,
      datasets: [{
        label: 'My First Dataset',
        data: classDistValue,
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',    // Teal
          'rgb(153, 102, 255)',   // Purple
          'rgb(220, 20, 60)', 
        ],
        hoverOffset: 4
      }]
  }

const config2 ={
    type: 'doughnut',
    data:data2,
    options: {
        scales:{
            y:{
                beginAtZero: true
            }
        }
    }
}



if(ch2){
    ch2.clear();
    ch2.destroy();
}
ch2 = new Chart("classesDistributionChart", config2);

/////////////////////
//bySahi

var ch3 = null;

   data3= {
    labels: ["Without Sahi","With Sahi"],
      datasets: [{
        label: 'My First Dataset',
        data: sahiValue,
        // data: sahiValue,
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
    
        ]
      }]
  }

const config3 ={
    type: 'bar',
    data:data3,
    options: {
        scales:{
            y:{
                beginAtZero: true
            }
        }
    }
}


if(ch3){
    ch3.clear();
    ch3.destroy();
}
ch3 = new Chart("queryBySahiChart", config3);



document.getElementById('Model1_queryBySahiChart').addEventListener('click', () => {
  fetchDataAndRefreshChart('yolox');
});

document.getElementById('Model2_queryBySahiChart').addEventListener('click', () => {
  fetchDataAndRefreshChart('yolonas');
});


function fetchDataAndRefreshChart(model) {

  // Simulate data fetching from the database based on the model
   newData = fetchDataFromDatabase(model); // Replace this with your actual data fetching code
   newLabels =fetchLabelFromDatabase(model);

  // Update the chart data and labels
  ch3.data.datasets[0].data = newData;

  ch3.update();
}




function fetchDataFromDatabase(model) {

if(model=='yolox'){
  return sahiValue;
}
else if(model=='yolonas')
  return sahiValue2;
}


function fetchLabelFromDatabase(model) {

  if(model=='yolox')
    return sahiName;
  else if(model=='yolonas')
    return sahiName2;
  }


///////////////////////////////////////////

// var ch5 = null;
console.log(timeConf)
console.log('timeConf')
  
      

// console.log(timeConf)
const data5= {
    // labels: xValues,
    datasets: [{
        label: '# of Users\'s queries to database.',
        
      // backgroundColor: barColors,
      data: timeConf
    }]
  }

const config5 ={
    type: 'scatter',
    data:data5,
    options: {
        scales:{
            x:{
              type: 'linear',
              position: 'bottom'
            }
        }
    }
}




  if(ch5){
    ch5.clear();
    ch5.destroy();
  }
  ch5 = 
  new Chart("timeConfChart", config5);



















///////////////////////
    },
    error:function(xhr, status, error){
                      console.error("Error saving data to JSON file:", error);
                      console.log(xhr);
                  }
  });


  
});

  $("#form1Container").submit(function(event) {
 
                event.preventDefault();
             console.log("logggggggggggggg")
                $.ajax({
                  url: '../../../application/resources/time_conf_chart.php',

                  type: 'GET',

                  data: 'JSON',
                 processData: false,
                 contentType: false,
                    success: function(response) {
                      response = JSON.parse(response);
                      console.log(response);
      const timeConf = response.timeConf;

      

// console.log(timeConf)
// const data5= {
    // labels: xValues,
  //   datasets: [{
  //       label: '# of Users\'s queries to database.',
        
  //     // backgroundColor: barColors,
  //     data: timeConf
  //   }]
  // }

// const config5 ={
//     type: 'scatter',
//     data:data5,
//     options: {
//         scales:{
//             x:{
//               type: 'linear',
//               position: 'bottom'
//             }
//         }
//     }
// }

  // Update the chart data and labels
  ch5.data.datasets[0].data = timeConf;
// console.log(timeConf);
// console.log(timeConf);
// console.log(timeConf);
// console.log(timeConf);
// console.log(timeConf);
// console.log(timeConf);
  // ch5.update();


  // if(ch5){
  //   ch5.clear();
  //   ch5.destroy();
  // }
  // ch5 = 
  // new Chart("timeConfChart", config5);


      // ch5.data.datasets[0].data = timeConf;

      // ch5.update();
      // console.log(timeConf)
  
      

      // // console.log(timeConf)
      // const data5= {
      //     // labels: xValues,
      //     datasets: [{
      //         label: '# of Users\'s queries to database.',
              
      //       // backgroundColor: barColors,
      //       data: timeConf
      //     }]
      //   }
      
      // const config5 ={
      //     type: 'scatter',
      //     data:data5,
      //     options: {
      //         scales:{
      //             x:{
      //               type: 'linear',
      //               position: 'bottom'
      //             }
      //         }
      //     }
      // }
      
      
      
      
      //   if(ch5){
      //     ch5.clear();
      //     ch5.destroy();
      //   }
      //   ch5 = 
      //   new Chart("timeConfChart", config5);
      

                    },
                    error:function(xhr, status, error){
                      console.error("Error saving data to JSON file:", error);
                  }
                });
            });








            $("#form2Container").submit(function(event) {
              event.preventDefault();
console.log('ssssdddfffffffffffffffffffffffdddssssssss')
    var ch4 = null;
           
              $.ajax({
                url: '../../resources/chart_data.php',
  type: 'POST',
  dataType: 'JSON',
                  success: function(response) {
                   const bubbleData = response.bubbleData;
   

    const data4= {
           datasets:[
          {
              label: 'Bubble Chart Example',
              data: bubbleData,
              backgroundColor:  'rgb(255, 99, 132)',
              // backgroundColor: createGradientColors(bubbleData),
              borderWidth: 1,
          },
      ],
      }
   
    
    const config4 ={
        type: 'bubble',
        data:data4,
        options: {
            scales:{
              x: { type: 'linear', position: 'bottom' },
              y: { type: 'linear', position: 'left' },
    
            }
        }
    }
    
    
      if(ch4){
        ch4.clear();
        ch4.destroy();
      }
      ch4 = 
      new Chart("geomChart", config4);
 
    
    

                  },
                  error:function(xhr, status, error){
                    console.error("Error saving data to JSON file:", error);
                }
              });
          });







/////////////
////////////////



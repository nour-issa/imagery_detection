$(document).ready(function () {

  $("#preloader").hide();
  var lyrAttractions;


  $("#upload-form").submit(function (event) {

    event.preventDefault();
    $("#preloader").show();
    var form = $("#upload-form")[0];

    var formData = new FormData(form);

    var selectedOption = $("input[name='options']:checked").val();
    var command = '';

    if (selectedOption === "option1") { 
      ////////////// yolox
      if ($("#sahi-option").prop("checked")) {
        command = "cd C:\\xampp\\htdocs\\webmap\\python\\imagery-detect && C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\venv\\Scripts\\kedro run --pipeline yolox-image-objects-detection-sahi"
      } else {
        command = "cd C:\\xampp\\htdocs\\webmap\\python\\imagery-detect && C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\venv\\Scripts\\kedro run --pipeline imagery-objects-prediction"
      }
    } else if (selectedOption === "option2") {
       //////////// yolonas
      if ($("#sr-option").prop("checked")) {



      } else {
        command = "cd C:\\xampp\\htdocs\\webmap\\python\\imagery-detect && C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\venv\\Scripts\\kedro run --pipeline imagery-objects-prediction"
      }
    }


    formData.append("command", command);

    $.ajax({
      url: '../../resources/php_detected_objects.php',
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        $("#preloader").hide();
        Swal.fire(
          'Objects Were Detected Successfully!',
          'image is saved to your desktop',
          'success'
        );
        $("#objects-table").html(JSON.parse(response)[1]);
        if (selectedOption === "option1") { ////////////// yolox
          if ($("#sahi-option").prop("checked")) {
            var imageUrl = '../../../python\\imagery-detect\\data\\14_sahi\\yolox_detected_imagery_sahi.jpg';
            $('.uploaded-img-show').attr('src', imageUrl + '?timestamp=' + new Date().getTime());
            $('.uploaded-img-show').on('click', function () {
              openModal(imageUrl + '?timestamp=' + new Date().getTime());
            });
          } else {
            var imageUrl = '../../../python\\imagery-detect\\data\\09_yolox_predicted_output\\yolox_raw_detected_imagery.jpg';
            $('.uploaded-img-show').attr('src', imageUrl + '?timestamp=' + new Date().getTime());
            $('.uploaded-img-show').on('click', function () {
              openModal(imageUrl + '?timestamp=' + new Date().getTime());
            });
          }
        } else if (selectedOption === "option2") { //////////// yolonas
          if ($("#sr-option").prop("checked")) {
          } else {


          }
        }



        lyrAttractions = L.geoJSON(JSON.parse(JSON.parse(response)[0]), {
          pointToLayer: function (feature, latlng) {
            var strPopup = "<h4>" + feature.properties.Name + "</h4>";
            strPopup += "<a href='" + feature.properties.web + "' target='blank'>";
            return L.marker(latlng).bindPopup(strPopup);
          }
        });
        lyrAttractions.addTo(mymap);
        mymap.fitBounds(lyrAttractions.getBounds());
      },
      error: function (xhr, status, error) {
        $("#preloader").hide();
        $("#objects-table").html("ERROR: " + error);
      }
    });
  });

});

var mymap = L.map('lmap-canvas');
mymap.setView([33.513, 36.278336], 11);
var backgroundLayer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png');
mymap.addLayer(backgroundLayer);
url1 = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('.uploaded-img-show')
        .attr('src', e.target.result)

        .width(400)
        .height(280)
        .css('margin-top', '2%');
      $('.uploaded-img-show').on('click', function () {
        openModal(e.target.result);
      });
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function openModal(imageSrc) {
  $('#expanded-img').attr('src', imageSrc);
  $('.modal-container').fadeIn();
}

function closeModal() {
  $('.modal-container').fadeOut();
}





const rangeInput = document.getElementById('confidence-threshold-input');
const rangeValue = document.getElementById('confidence-threshold-value');

rangeInput.addEventListener('input', () => {
  rangeValue.textContent = rangeInput.value + "%";
});


$('table').on('click', '.object-button', function () {

  var secondTd = $(this).parent().siblings().eq(0);
  var value = secondTd.text();
  let [a, b] = value.slice(1, -1).split(',').map(parseFloat);
  mymap.setView([a, b], 21);
});


function sendThreshold() {
  $("#preloader").show();
  var thresholdValue = $("#confidence-threshold-input").val();
  thresholdValue = thresholdValue / 100;
  console.log(thresholdValue);

  // Create a data object to be saved in the JSON file
  var selectedOption = $("input[name='options']:checked").val();
  var command = '';
  console.log("thresholdValue");
  console.log(thresholdValue);

  if (selectedOption === "option1") { 
    ////////////// yolox
    if ($("#sahi-option").prop("checked")) {
      command = "cd C:\\xampp\\htdocs\\webmap\\python\\imagery-detect && C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\venv\\Scripts\\kedro run --pipeline visualize-object-sahi-yolox";

    } else {

      command = "cd C:\\xampp\\htdocs\\webmap\\python\\imagery-detect && C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\venv\\Scripts\\kedro run --pipeline visualize-objects";

    }
  } else if (selectedOption === "option2") {
     //////////// yolonas
    if ($("#sr-option").prop("checked")) {
    } else {
    }
  }
  var data = {
    threshold: thresholdValue,
    command: command,
  };
  // Convert the data to a JSON string
  var jsonData = JSON.stringify(data);
  var Data = new FormData();
  Data.append("jsonData", jsonData);
  Data.append("threshold", thresholdValue);
  Data.append("command", command);
  console.log("Data");
  console.log(Data);

  $.ajax({
    url: "../../resources/php_load_detected_objects_to_map.php", 
    type: "POST",
    data: Data,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log(response);
      $("#preloader").hide();
      Swal.fire(
        'Objects Were Saved Successfully!',
        'success'
      );

      var selectedOption = $("input[name='options']:checked").val();
      var imageUrl = '';
      if (selectedOption === "option1") { 
        ////////////// yolox
        if ($("#sahi-option").prop("checked")) {
          var imageUrl = '../../../python\\imagery-detect\\data\\14_sahi\\yolox_confidence_detected_imagery_sahi.jpg';
          $('.uploaded-img-show').attr('src', imageUrl + '?timestamp=' + new Date().getTime());
        } else {
          var imageUrl = '../../../python\\imagery-detect\\data\\09_yolox_predicted_output\\yolox_confidence_raw_detected_imagery.jpg';
          $('.uploaded-img-show').attr('src', imageUrl + '?timestamp=' + new Date().getTime());
        }
      } else if (selectedOption === "option2") {
         //////////// yolonas
        if ($("#sr-option").prop("checked")) {
        } else {
        }
      }


      $("#objects-table").html(JSON.parse(response)[1]);

      lyrAttractions = L.geoJSON(JSON.parse(JSON.parse(response)[0]), {
        pointToLayer: function (feature, latlng) {
          var strPopup = "<h4>" + feature.properties.Name + "</h4>";
          strPopup += "<a href='" + feature.properties.web + "' target='blank'>";
          return L.marker(latlng).bindPopup(strPopup);
        }
      });

      lyrAttractions.addTo(mymap);
      mymap.fitBounds(lyrAttractions.getBounds());
    },
    error: function (xhr, status, error) {
      $("#preloader").hide();
      console.error("Error saving data to JSON file:", error);
    }
  });
}

function saveData() {
  var Data = new FormData();
  var saveToGeoJson = "saveToGeoJson"
  Data.append("action", saveToGeoJson);
  $.ajax({
    url: "../../resources/php_load_detected_objects_to_map.php", 
    type: "POST",
    data: Data,
    processData: false,
    contentType: false,
    success: function (response) {
      Swal.fire(
        'Objects Were Saved Successfully!',
        'success'
      );
    },
    error: function (xhr, status, error) {
      console.error("Error saving data to JSON file:", error);
    }
  });
}
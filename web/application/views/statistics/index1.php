<?php
require_once '../_templates/header.php';

include '../_templates/__header.php';
//  pageHeadTag("My Page Title"); 
 include '../_templates/init.php';

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="../../../public/js/charts/chart.js"></script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div id="whole">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="cd-slider-nav">
          <nav class="navbar navbar-expand-lg" id="tm-nav">
            <a class="navbar-brand" href="#">Imagery Detective<br>seeing the unseen</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbar-supported-content" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-supported-content">
              <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item selected">
                  <a class="nav-link" aria-current="page" href="../home/index.php"> Back to Home Page</a>
                  <div class="circle"></div>
                </li>

              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>

    <!-- ////////////////////////////////////////// -->







    <div class="charts-container">


      <!-- <div class="chart"style="display: flex;"> -->
      <div class="chart">
        <div id="classesDistributionChartOuterDiv" class="chart-wrapper">
          <canvas id="classesDistributionChart"></canvas>
        </div>
      </div>


      <div class="chart">
        <div id="queryBySahiChartOuterDiv" class="chart-wrapper" style="width:97%">
          <canvas id="queryBySahiChart"></canvas>
          <div class="options-container">
            <button id="Model1_queryBySahiChart">Model1</button>
            <button id="Model2_queryBySahiChart">Model2</button>
          </div>
        </div>
      </div>
      <div class="chart">
        <div id="queryByMonthChartOuterDiv" class="chart-wrapper">
          <canvas id="queryByMonthChart"></canvas>
        </div>
      </div>




      <div class="">
        <div id="timeConfChartOuterDiv" class="">
          <canvas id="timeConfChart"></canvas>
        </div>
      </div>




      <div class="container-form-time-conf">
        <form method="post" id="form1Container" class="centered-form-time-conf">
          <p style="color:black;margin-bottom:-2%;font-size:24px; font-weight:500;">Choose time to show data:</p>
          <label for="Month" style="color:black; font-size:24px; font-weight:500;">Select Month:</label>
          <input type="text" name="Month" required><br>

          <label for="Day" style="color:black; font-size:24px; margin-top:-7%; font-weight:500;">Select Day:</label>
          <input type="text" name="Day" required><br>


          <button type="submit" name="submitFormTimeConf" class="buttons">Submit</button>
        </form>
      </div>



      <div class="container-form">
        <form method="post" id="form2Container" class="centered-form">
          <div class="form-row">
            <label for="value1">East:</label>
            <input type="text" name="value1" required><br>
          </div>
          <div class="form-row">
            <label for="value2">West:</label>
            <input type="text" name="value2" required><br>
          </div>
          <div class="form-row">
            <label for="value3">North:</label>
            <input type="text" name="value3" required><br>
          </div>
          <div class="form-row">
            <label for="value4">South:</label>
            <input type="text" name="value4" required><br>
          </div>
          <button type="submit" name="submitFormCoord" class="buttons" style="margin-bottom:10px">Submit</button>
        </form>
      </div>

      <div class="chart bubbly">
        <div id="geomChartOuterDiv" class="chart-wrapper">
          <canvas id="geomChart"></canvas>
        </div>
      </div>




    </div>

  </div>

</div>






<!-- ///////////////////////////////////////// -->
<!-- </div>       -->


<!-- //////////////////////////////////////////////////////////////////////////// -->
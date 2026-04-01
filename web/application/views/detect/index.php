<?php
require_once '../_templates/header.php';
include '../_templates/__header.php';
include '../_templates/init.php';
?>

<video autoplay muted loop id="bg-video">
  <source src="../../../public/video/Planet-Earth-Rotation-purple.mp4" type="video/mp4">
</video>
<div class="page-container">
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
  </div>
  <section id="detect-body" class="">

    <div class=" tm-contact-main" style=" backdrop-filter:blur(6px); border-style: hidden;">

      <div class="contact-form-outer" class="col-lg-4" style="width: 100%;">

        <form id="upload-form" action="" method="POST" class="form-container" enctype="multipart/form-data">
          <div class="input-img flex-item1 "> <input type="file" id="uploaded-img" name="filename" style="border:none"
              onchange="readURL(this);">
            <input type="file" id="uploaded-geojson" name="geojsonfile" accept=".dat">
          </div>
          <div id="uploaded-img-show-div" class="flex-item2">
            <img class="uploaded-img-show popup-image" src="../../../public/img/upload_p1.png" alt="uploaded image"
              style="margin-top:20%" />
          </div>
          <div id="detect-options" class="flex-item3">
            <label>
              <input type="radio" name="options" value="option1">
              Model 1
            </label>
            <label>
              <input type="radio" name="options" value="option2">
              Model 2
            </label>
            <label>
              <input type="checkbox" id="sahi-option">
              Sahi
            </label>
            <label>
              <input type="checkbox" id="sr-option">
              Super Resolution
            </label>
          </div>
          <div id="preloader">
            <img src="../../../public/img/loader_cool.gif" alt="Loading..." />
          </div>
          <div style="margin-bottom: -5%;">
            <button class="img-button flex-item4" id="start-detecting-button" type="submit">Start Detecting</button>
            <button type="button" class="img-button" id="save-user-results-button" onclick="saveData()">Save
              Results</button>
          </div>
        </form>
        <div class="modal-container" style="display: none;">
          <span class="modal-close-btn" onclick="closeModal()">&times;</span>
          <img class="modal-content" id="expanded-img">
        </div>
      </div>
      <div class="map-outer" class="col-lg-4">
        <div class="lmap-canvas" id="lmap-canvas">
        </div>
      </div>
      <div class="objects-info-outer" class="col-lg-4">
        <div class="objects-info" style="margin-top: -10%">
          <div class="mt-2 mb-4" style="display: flex; margin-left: 10%; justify-content: space-between; align-items: center;
               flex-direction: column;">
            <label for="rangeInput" style="margin-left: -12%;font-size: 1.1rem;">Confidence Threshold: <span
                id="confidence-threshold-value">0%</span></label>
            <div style="display: flex; margin-left: -1%; justify-content: space-between; align-items: center;
                flex-direction: row;">
              <p style="font-weight:900; color:#ff43a1; font-size: 24px;">0%</p>
              <input id="confidence-threshold-input" class="slider" name="rangeInput" type="range" min="1" max="99"
                value="0" onchange="sendThreshold()">
              <p style="font-weight:900; color:#ff43a1;font-size: 24px;">100%</p>
            </div>
          </div>
        </div>
        <div class=" table table-striped table-hover  table-responsive"
          style="padding: 0px; padding-top: 0px; margin-top: 20%; height: 80%; overflow-y: scroll; font-size: 0.1rem;">
          <table id="objects-table" width="10%">
          </table>
        </div>
      </div>
    </div>
  </section>
  <div class="container-fluid">
    <footer class="row mx-auto tm-footer">
      <div class="col-md-6 px-0">
        Copyright HIAST Limited. All rights reserved.
      </div>
      <div class="col-md-6 px-0 tm-footer-right">
        Designed by <a rel="sponsored" href="https://templatemo.com" target="_blank" class="tm-link-white">Nour Issa</a>
      </div>
    </footer>
  </div>
</div>
<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>
<script src="../../../public/js/jquery-3.5.1.min.js"></script>
<script src="../../../public/js/bootstrap.min.js"></script>
<script src="../../../public/js/slick.js"></script>
<script src="../../../public/js/templatemo-script.js"></script>
<script src="../../../public/js/leaflet/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js" crossorigin="anonymous"></script>
<script src="../../../public/js/detect.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>
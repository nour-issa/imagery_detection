<?php
require_once '../_templates//header.php';
 pageHeadTag("My Page Title"); 
?>


<video autoplay muted loop id="bg-video">
<source src="../../../public/video/Planet-Earth-Rotation-purple.mp4" type="video/mp4">
</video>

    <div class="page-container" style="color:white">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <div class="cd-slider-nav">
              <nav class="navbar navbar-expand-lg" id="tm-nav">
                <a class="navbar-brand" href="#">Imagery Detective<br>seeing the unseen</a>
             
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-supported-content" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbar-supported-content">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                      <li class="nav-item selected">
                        <a class="nav-link" aria-current="page" href="#" data-no="1">Home</a>
                        <div class="circle"></div>
                      </li>
                    
                      <li class="nav-item">
                        <a class="nav-link" href="#" data-no="2">Quick Guide</a>
                        <div class="circle"></div>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#" data-no="3">Contact</a>
                        <div class="circle"></div>
                      </li>
                    </ul>
                  </div>
              </nav>
            </div>
          </div>          
        </div>        
      </div>      
      <div class="container-fluid tm-content-container" style="margin-top:-1% ; color:white;">
        <ul class="cd-hero-slider mb-0 py-5">
          <li class="px-3" data-page-no="1">
            <div class="page-width-1 page-left">
              <div class="d-flex position-relative tm-border-top tm-border-bottom intro-container">
                <div class="intro-left tm-bg-dark">
                  <h2 class="mb-4" style="color:white">Welcome to Imagery Detective</h2>
                  <p class="mb-0" style="color:white">
                  Where the power of AI combines with cutting-edge technology to bring you a unique experience. With just a few clicks, you can upload your imagery and its corresponding data, allowing our algorithms to work their magic. 
  
                  Whether you're a scientist, researcher, or simply curious about the world, our website offers an unparalleled opportunity to explore and understand the intricacies of imagery.  
              </p>
                </div>
                <div class="intro-right">
                  <img src="../../../public/img/home-img-06.jpg" alt="Image" style="height: 100%;width: 170%; border-bottom-right-radius: 85%;" class="img-fluid intro-img-1">
                </div>
                <div class="circle intro-circle-1"></div>
                <div class="circle intro-circle-2"></div>
                <div class="circle intro-circle-3"></div>
                <div class="circle intro-circle-4"></div>
              </div>
              <div class="text-center">
                <a href="../detect/index.php" class="btn btn-primary tm-intro-btn tm-page-link">
                  Start Detecting
                </a>
              </div> 
              
              



    <!-- Resource Spotlight -->
    <div class="container-fluid resource-spotlight pb-5 cards" >
      <div class="container p-0">
        <div class="row py-3 justify-content-between gx-0 gx-sm-0 gx-md-5">
          <div class=" text-center rs-title pt-3" style="font-size: 4rem;">
             Spotlight
          </div>
          <div class="col-12 text-center rs-subtitle mb-4" style="font-size: 1.5rem;">
            Our maps and satellite imagery provide a wealth of information and insights for businesses, researchers, and curious minds alike.
          </div>
          <div class="col-12 row col-sm-12 col-lg-12 justify-content-between g-0">
            <div class="col-12 col-sm-12 col-lg-3 white-text">
              <div class="card" style="backdrop-filter: blur(10px);">
                <div class="card-body text-center ">
                  <div class="title-box">
                  
                      <img class="img-fluid"
                        src="../../../public/img/earth-blue1.png"
                        alt="Wildfires Spotlight icon">
                   
                  </div>
                  <div class="card-title"style="font-size: 38px; ">
                    Discover
                  </div>
                  <div class="">
                    <p class="card-text" style="color:white">Discover the world from a new perspective with our advanced satellite imagery technology.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-3 white-text">
              <div class="card" style="backdrop-filter: blur(10px);">
                <div class="card-body text-center ">
                  <div class="title-box">
              
                      <img class="img-fluid" src="../../../public/img/tech1.png"
                        alt="Open Science image icon">
                    
                  </div>
                  <div class="card-title"style="font-size: 38px;">
                    Explore
                  </div>
                  <div class="">
                    <p class="card-text" style="color:white">Take your map exploration to the next level
                       with our cutting-edge object detection capabilities.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-3 white-text">
              <div class="card" style="backdrop-filter: blur(10px);">
                <div class="card-body text-center ">
                  <div class="title-box" style="margin-bottom: 26%;">
                   
                      <img class="img-fluid" src="../../../public/img/satellite.png"
                        alt="Environmental Justice image icon" >
                    
                  </div>
                  <div class="card-title" style="font-size: 38px;">
                    Experience
                  </div>
                  <div class="">
                    <p class="card-text" style="color:white">Experience the power of satellite imagery in
                       detecting objects that are invisible to the naked eye </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>








    


    <div id="main-bottom" class="container-fluid bottom-blue-globe">
      <div class="container">

        <div class="row row-offcanvas row-offcanvas-left clearfix">

          <!-- Engage With Us -->
          <div class="row justify-content-between homepage-engage py-5" style="position: relative;" >
            <div class="col-12 col-sm-12 col-md-6 col-lg-12 engage-title my-auto">
              <div class="col-12 homepage-title-light" style="font-size: 2.5rem;">Engage
              </div>
              <div class="homepage-subtext-light py-4 py-sm-4 py-md-2 col-12" style="font-size: 2rem;">
                Explore the ways this site is built by and the techniques use to make detection.
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-4 my-auto"  style="position: absolute; top: 66%; left:15% ">
              
              <div class="engage-link col-12" style="font-size: 1.8rem;"><a
                  href="#">Standard Report</a></div>
            
            </div>
            <div class="col-12 col-sm-12 col-lg-3" >
              <img class="homepage-satellite-2"  src="../../../public/img/satellite-home-engage.png">
            </div>
          </div>

        </div>

      </div>
    </div>




              
            </div>            
          </li>
         
          <li data-page-no="2" class="px-3">
            <div class="position-relative page-width-1 page-right tm-border-top tm-border-bottom">
              <div class="circle intro-circle-1"></div>
              <div class="circle intro-circle-2"></div>
              <div class="circle intro-circle-3"></div>
              <div class="circle intro-circle-4"></div>
              <div class="tm-bg-dark content-pad">
                <h2 class="mb-4" style="color:white">Quick Guide to the Website</h2>
                <p class="mb-4" style="color:white">
                you can use our website to get anywhere you want on earth! upload any <span class="highlight">imagery</span> you want along with its <span class="highlight">.dat geographical mark points</span> file
                and just wait to get satisfied with the perfect results!
                click on start detecting to navigate to the page where the work is done. upload image from any type [.jpg, .png,..] and 
                a mark points' coordinations then choose whther to use sahi or not.
                and see the difference. you can also save the results if you needed to our database and ask for it later if you want.
                you can also find in the main page by clicking on <span class="highlight">Standard Report</span> the full information of the method behind the detecting process.
                </p>
             
              </div>              
            </div>
          </li>
          <li data-page-no="3">
            <div class="mx-auto page-width-2" style="background-color: rgba(42 ,-29,43,0.3);">
              <div class="row">
                <div class="col-md-6 me-0 ms-auto">
                  <h2 class="mb-4" style="color:white">Contact Us</h2>
                </div>
              </div>
              <div class="row" style="height: 480px;">
                <div class="col-md-6 tm-contact-left">
                  <form action="#" method="POST" class="contact-form">
                    <div class="input-group tm-mb-30">
                        <input name="name" type="text" class="form-control rounded-0 border-top-0 border-end-0 border-start-0" placeholder="Name">
                    </div>
                    <div class="input-group tm-mb-30">
                        <input name="email" type="text" class="form-control rounded-0 border-top-0 border-end-0 border-start-0" placeholder="Email">
                    </div>
                    <div class="input-group tm-mb-30">
                        <textarea rows="5" name="message" class="textarea form-control rounded-0 border-top-0 border-end-0 border-start-0" placeholder="Message"></textarea>
                    </div>
                    <div class="input-group justify-content-end">
                        <input type="submit" class="btn btn-primary tm-btn-pad-2" value="Send">
                    </div>
                  </form>
                </div>
                <div class="col-md-6 tm-contact-right">                  
                  <p class="mb-4" style="color:white; font-weight:600">
                   Your feedback is appreciated! feel free to contact us and afford us some information or ask any thing and we will answer
                  as soon as possible. We will be happy to hear from you! 
                  </p>
                  <div style="color:white; font-weight:600">
                    Email: <a href="mailto:info@company.com" class="tm-link-white">contact@hiast.edu.sy</a>
                  </div>
                  <div class="tm-mb-45" style="color:white; font-weight:600">
                    Tel: <a href="tel:0100200340" class="tm-link-white">+963-(0)11-5140520</a>
                  </div>
                  <!-- Map -->
                  <div class="map-outer">
                    <div class="gmap-canvas">
                        <iframe width="100%" height="400" id="gmap-canvas"
                            src="https://maps.google.com/maps?q=Av.+L%C3%Damascuse,+syria&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    </div>
                </div>
                </div>
              </div>
            </div>            
          </li>
        </ul>
    </div>
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
  <script src="../../../public/js/detect.js"></script>
</body>
</html>
<!DOCTYPE html>
<html>

<head>
  <x-head></x-head>
</head>

<body>
  
    <div class="hero_area">

        <x-menu></x-menu>

        <!-- slider section -->
        <section class="slider_section long_section">
          <div id="customCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="container ">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="detail-box">
                        <h1>
                          Manage Your <br>
                          Garden 
                        </h1>
                        <p>
                          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus quidem maiores perspiciatis, illo maxime voluptatem a itaque suscipit.
                        </p>
                        <div class="btn-box">
                          <a href="" class="btn1">
                            Contact Us
                          </a>
                          <a href="/locations" class="btn2">
                            About Us
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="img-box">
                        <img src="images/slider-img.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="container ">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="detail-box">
                        <h1>
                          Plants <br>
                          Location Needs
                        </h1>
                        <p>
                          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus quidem maiores perspiciatis, illo maxime voluptatem a itaque suscipit.
                        </p>
                        <div class="btn-box">
                          <a href="" class="btn1">
                            Contact Us
                          </a>
                          <a href="/locations" class="btn2">
                            About Us
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="img-box">
                        <img src="images/slider-img.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="container ">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="detail-box">
                        <h1>
                          You can manage <br>
                          Your garden
                        </h1>
                        <p>
                          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus quidem maiores perspiciatis, illo maxime voluptatem a itaque suscipit.
                        </p>
                        <div class="btn-box">
                          <a href="" class="btn1">
                            Contact Us
                          </a>
                          <a href="/locations" class="btn2">
                            About Us
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="img-box">
                        <img src="images/slider-img.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <ol class="carousel-indicators">
              <li data-target="#customCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#customCarousel" data-slide-to="1"></li>
              <li data-target="#customCarousel" data-slide-to="2"></li>
            </ol>
          </div>
        </section>
        <!-- end slider section -->
      </div>



    <div class="container">
      <main>
        {{$slot}}
      </main>
    </div>

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="https://dflat.com.au/">Dflat</a>
      </p>
    </div>
  </footer>
  <!-- footer section -->


  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

</body>

</html>
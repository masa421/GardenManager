<!DOCTYPE html>
<html>

<head>

  <x-head/>

</head>

<body>

  <x-menu/>
  <x-flash-message />

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
  <script src="/js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="/js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="/js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

</body>
</html>
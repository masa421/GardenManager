    <!-- header section strats -->
    <header class="header_section long_section px-0">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="/">
            <img src="{{asset("/images/logo.jpg")}}" class="headlogo"/>
            <span>
              Garden Manager
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>
  
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                @auth
                <li class="nav-item active">
                  <a class="nav-link" href="/locations">Your Garden </a>
                </li>                    
                <li class="nav-item active">
                  <a class="nav-link" href="/test">Test</a>
                </li>                    
                @endauth
                <li class="nav-item">
                  <a class="nav-link" href="/about"> About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/contact">Contact Us</a>
                </li>
              </ul>
            </div>
            <div class="quote_btn-container">
              @auth
                <span style="font:bold;padding:5px;">Welcome {{auth()->user()->name}}</span>
                  <form class="inline" action="/logout" method="post">
                      @csrf
                      <button type="sbumit" class=btn1>
                          <i class="fa-solid fa-door-closed"></i>Logout
                      </button>
                  </form>
              @else

              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a href="/register" class="hover:text-laravel"
                      ><i class="fa-solid fa-user-plus"></i> Register</a
                  >
                </li>
                <li class="nav-item">
                  <a href="/login">
                        <span>
                          Login
                        </span>
                        <i class="fa fa-user" aria-hidden="true"></i>
                      </a>
                    </li>
                  </ul>
                @endauth
            </div>
          </div>
        </nav>
      </header>
      <!-- end header section -->
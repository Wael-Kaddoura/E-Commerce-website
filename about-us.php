<?php

include "php/connection.php";

session_start();


if (!isset($_SESSION["logedin"])) {
	$_SESSION["logedin"] = false ;
  }

if ($_SESSION["logedin"]) {
	$query2 = "SELECT * FROM `cart_items` WHERE user_id = ?";
	$stmt2 = $connection->prepare($query2);
	$stmt2 -> bind_param("s", $_SESSION["user_id"]);
	$stmt2->execute();
	$result2 = $stmt2->get_result();
	$num_cart_items = mysqli_num_rows($result2);
  if ($num_cart_items == 0) {
    $num_cart_items = "";
    }
}else{
	$num_cart_items= "";
}

if (!isset($_SESSION["user_type"])) {
	$_SESSION["user_type"] = "user" ;
  }

  $query3 = "SELECT * FROM `items` ORDER BY id desc LIMIT 5";
  $stmt3 = $connection->prepare($query3);
  $stmt3->execute();
  $result3 = $stmt3->get_result();
  
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Classimax</title>

  <!-- FAVICON -->
  <link href="img/favicon.png" rel="shortcut icon">
  <!-- PLUGINS CSS STYLE -->
  <!-- <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap-slider.css">
  <!-- Font Awesome -->
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Owl Carousel -->
  <link href="plugins/slick-carousel/slick/slick.css" rel="stylesheet">
  <link href="plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
  <!-- Fancy Box -->
  <link href="plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
  <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
  <!-- CUSTOM CSS -->
  <link href="css/style.css" rel="stylesheet">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="body-wrapper">


  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="navbar navbar-expand-lg navbar-light navigation">
            <a class="navbar-brand" href="index.php">
              <img src="images/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto main-nav ">
              <li class="nav-item active">
								<a class="nav-link" href="index.php">Home</a>
							</li>

							<?php if ($_SESSION["user_type"] == "store") { ?>
								<li class="nav-item">
								<a class="nav-link" href="mydashboard.php">My Dashboard</a>
								</li>
							<?php } ?>

                            <li class="nav-item">
								<a class="nav-link" href="all-items.php">See All Items</a>
							</li>

                            <li class="nav-item">
								<a class="nav-link" href="about-us.php">About Us</a>
							</li>
              </ul>

              <ul class="navbar-nav ml-auto mt-10">
              <li class="nav-item nav-link">
							<?php if ($_SESSION["logedin"]) {
								echo $_SESSION["gender"]." ".$_SESSION["name"];
							} ?>
								</li>
							<li id="login-button" class="nav-item">
							<?php if ($_SESSION["logedin"]) {
								echo '<a class="nav-link login-button" href="php/logout.php" id="login-status">Log out</a>';
								
							}else {
								echo '<a class="nav-link login-button" href="login.php" id="login-status">Login</a>';
							} ?>
								
							</li>

							<li class="nav-item">
							<?php if ($_SESSION["user_type"] == "store") {
								echo '<a class="nav-link text-white add-button" href="ad-listing.php"><i class="fa fa-plus-circle"></i> Add Listing</a>';
							} ?>
							</li>

							<li class="nav-item">
							<?php if ($_SESSION["logedin"] && $_SESSION["user_type"] == "user") {
								echo '<a class="nav-link text-white add-button" href="show-cart-items.php"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
								<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
							  </svg> <span class="badge rounded-pill bg-danger" id = "cart-counter">'.$num_cart_items.'</span>
							  </a>';
							} ?>
							</li>
							

              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <!--================================
=            Page Title            =
=================================-->
  <section class="page-title">
    <!-- Container Start -->
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <!-- Title text -->
          <h3>About Us</h3>
        </div>
      </div>
    </div>
    <!-- Container End -->
  </section>

  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="about-img">
            <img src="images/about/about.jpg" class="img-fluid w-100 rounded" alt="">
          </div>
        </div>
        <div class="col-lg-6 pt-5 pt-lg-0">
          <div class="about-content">
            <h3 class="font-weight-bold">Introduction</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc est justo, aliquam nec tempor
              fermentum, commodo et libero. Quisque et rutrum arcu. Vivamus dictum tincidunt magna id
              euismod. Nam sollicitudin mi quis orci lobortis feugiat.</p>
            <h3 class="font-weight-bold">How we can help</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc est justo, aliquam nec tempor
              fermentum, commodo et libero. Quisque et rutrum arcu. Vivamus dictum tincidunt magna id
              euismod. Nam sollicitudin mi quis orci lobortis feugiat. Lorem ipsum dolor sit amet,
              consectetur adipiscing elit. Nunc est justo, aliquam nec tempor fermentum, commodo et libero.
              Quisque et rutrum arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc est
              justo, aliquam nec tempor fermentum, commodo et libero. Quisque et rutrum arcu. Vivamus dictum
              tincidunt magna id euismod. Nam sollicitudin mi quis orci lobortis feugiat.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="mb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="heading text-center text-capitalize font-weight-bold py-5">
            <h2>our team</h2>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card my-3 my-lg-0">
            <img class="card-img-top" src="images/team/wael.jpg" class="img-fluid w-100" alt="Card image cap">
            <div class="card-body bg-gray text-center">
              <h5 class="card-title">Wael Kaddoura</h5>
              <p class="card-text">Founder / CEO</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card my-3 my-lg-0">
            <img class="card-img-top" src="images/team/team2.jpg" class="img-fluid w-100" alt="Card image cap">
            <div class="card-body bg-gray text-center">
              <h5 class="card-title">John Doe</h5>
              <p class="card-text">Founder / CEO</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card my-3 my-lg-0">
            <img class="card-img-top" src="images/team/team3.jpg" class="img-fluid w-100" alt="Card image cap">
            <div class="card-body bg-gray text-center">
              <h5 class="card-title">John Doe</h5>
              <p class="card-text">Founder / CEO</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card my-3 my-lg-0">
            <img class="card-img-top" src="images/team/team4.jpg" class="img-fluid w-100" alt="Card image cap">
            <div class="card-body bg-gray text-center">
              <h5 class="card-title">John Doe</h5>
              <p class="card-text">Founder / CEO</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section bg-gray">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-sm-6 my-lg-0 my-3">
          <div class="counter-content text-center bg-light py-4 rounded">
            <i class="fa fa-smile-o d-block"></i>
            <span class="counter my-2 d-block" data-count="2314">0</span>
            <h5>Happy Customers</h5>
            </script>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 my-lg-0 my-3">
          <div class="counter-content text-center bg-light py-4 rounded">
            <i class="fa fa-user-o d-block"></i>
            <span class="counter my-2 d-block" data-count="1013">0</span>
            <h5>Active Members</h5>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 my-lg-0 my-3">
          <div class="counter-content text-center bg-light py-4 rounded">
            <i class="fa fa-bookmark-o d-block"></i>
            <span class="counter my-2 d-block" data-count="2413">0</span>
            <h5>Verified Ads</h5>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 my-lg-0 my-3">
          <div class="counter-content text-center bg-light py-4 rounded">
            <i class="fa fa-smile-o d-block"></i>
            <span class="counter my-2 d-block" data-count="200">0</span>
            <h5>Happy Customers</h5>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--============================
=            Footer            =
=============================-->

  <footer class="footer section section-sm">
    <!-- Container Start -->
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-7 offset-md-1 offset-lg-0">
          <!-- About -->
          <div class="block about">
            <!-- footer logo -->
            <img src="images/logo-footer.png" alt="">
            <!-- description -->
            <p class="alt-color">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
              incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
              laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
        </div>
        <!-- Link list -->
        <div class="col-lg-2 offset-lg-1 col-md-3">
          <div class="block">
            <h4>Site Pages</h4>
            <ul>
              <li><a href="#">Boston</a></li>
              <li><a href="#">How It works</a></li>
              <li><a href="#">Deals & Coupons</a></li>
              <li><a href="#">Articls & Tips</a></li>
              <li><a href="terms-condition.html">Terms & Conditions</a></li>
            </ul>
          </div>
        </div>
        <!-- Link list -->
        <div class="col-lg-2 col-md-3 offset-md-1 offset-lg-0">
          <div class="block">
            <h4>Admin Pages</h4>
            <ul>
              <li><a href="category.html">Category</a></li>
              <li><a href="single.html">Single Page</a></li>
              <li><a href="store.html">Store Single</a></li>
              <li><a href="single-blog.html">Single Post</a>
              </li>
              <li><a href="blog.html">Blog</a></li>



            </ul>
          </div>
        </div>
        <!-- Promotion -->
        <div class="col-lg-4 col-md-7">
          <!-- App promotion -->
          <div class="block-2 app-promotion">
            <div class="mobile d-flex">
              <a href="">
                <!-- Icon -->
                <img src="images/footer/phone-icon.png" alt="mobile-icon">
              </a>
              <p>Get the Dealsy Mobile App and Save more</p>
            </div>
            <div class="download-btn d-flex my-3">
              <a href="#"><img src="images/apps/google-play-store.png" class="img-fluid" alt=""></a>
              <a href="#" class=" ml-3"><img src="images/apps/apple-app-store.png" class="img-fluid" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container End -->
  </footer>
  <!-- Footer Bottom -->
  <footer class="footer-bottom">
    <!-- Container Start -->
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-12">
          <!-- Copyright -->
          <div class="copyright">
            <p>Copyright ??
              <script>
                var CurrentYear = new Date().getFullYear()
                document.write(CurrentYear)
              </script>. All Rights Reserved, theme by <a class="text-primary" href="https://themefisher.com"
                target="_blank">themefisher.com</a>
            </p>
          </div>
        </div>
        <div class="col-sm-6 col-12">
          <!-- Social Icons -->
          <ul class="social-media-icons text-right">
            <li><a class="fa fa-facebook" href="https://www.facebook.com/themefisher" target="_blank"></a></li>
            <li><a class="fa fa-twitter" href="https://www.twitter.com/themefisher" target="_blank"></a></li>
            <li><a class="fa fa-pinterest-p" href="https://www.pinterest.com/themefisher" target="_blank"></a></li>
            <li><a class="fa fa-vimeo" href=""></a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Container End -->
    <!-- To Top -->
    <div class="top-to">
      <a id="top" class="" href="#"><i class="fa fa-angle-up"></i></a>
    </div>
  </footer>

  <!-- JAVASCRIPTS -->
  <script src="plugins/jQuery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/popper.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap-slider.js"></script>
  <!-- tether js -->
  <script src="plugins/tether/js/tether.min.js"></script>
  <script src="plugins/raty/jquery.raty-fa.js"></script>
  <script src="plugins/slick-carousel/slick/slick.min.js"></script>
  <script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
  <script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="plugins/smoothscroll/SmoothScroll.min.js"></script>
  <!-- google map -->
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
  <script src="plugins/google-map/gmap.js"></script>
  <script src="js/script.js"></script>

</body>

</html>
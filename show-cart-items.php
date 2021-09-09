<?php

include "php/connection.php";

session_start();

if (!isset($_SESSION["logedin"])) {
	$_SESSION["logedin"] = false ;
  }

$total_price = 0;

if ($_SESSION["logedin"]) {
  $query1 = "SELECT * FROM `cart_items` WHERE user_id = ?";
	$stmt1 = $connection->prepare($query1);
	$stmt1 -> bind_param("s", $_SESSION["user_id"]);
	$stmt1->execute();
	$result1 = $stmt1->get_result();

  $num_cart_items = mysqli_num_rows($result1);
  if ($num_cart_items == 0) {
    $num_cart_items = "";
    }


	$query2 = "SELECT *, COUNT(items.id) AS count FROM `items`, cart_items WHERE cart_items.user_id = ? AND items.id = cart_items.item_id group BY items.id";
	$stmt2 = $connection->prepare($query2);
	$stmt2 -> bind_param("s", $_SESSION["user_id"]);
	$stmt2->execute();
	$result2 = $stmt2->get_result();

  $query3 = "SELECT *, COUNT(items.id) AS count FROM `items`, cart_items WHERE cart_items.user_id = ? AND items.id = cart_items.item_id group BY items.id";
	$stmt3 = $connection->prepare($query3);
	$stmt3 -> bind_param("s", $_SESSION["user_id"]);
	$stmt3->execute();
	$result3 = $stmt3->get_result();

  while ($row = $result3->fetch_assoc()) {
    $total_price += floatval($row["count"]) * floatval($row["price"]);
}
}else{
	$num_cart_items= "";
}

if (!isset($_SESSION["user_type"])) {
	$_SESSION["user_type"] = "user" ;
  }

if (!isset($_SESSION["new_purchase"])) {
  $_SESSION["new_purchase"] = false ;
  }               

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

  <link rel="stylesheet" href="bootstrap-5.1.0-dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <script src="jquery-3.6.0.min.js"></script>


</head>

<body class="body-wrapper">

<section>

<?php if($_SESSION["new_purchase"]){?>
              
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              Your Purchase has been succefully made!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

            <?php $_SESSION["new_purchase"] = false; } ?>

  
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
<section class="section-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="search-result bg-gray">
					<h2 >Items Added to your Cart</h2>
				</div>
			</div>
		</div>
		<div class="row">
      
			<div class="col-lg-9 col-md-8">


				<!-- ad listing list  -->
				<div class="ad-listing-list mt-20">
                    
                <?php
                    while ($row = $result2->fetch_assoc()) {
                        ?>

                <div id = "row<?php echo $row["item_id"]; ?>" class="row p-lg-3 p-sm-5 p-4">
                    <div class="col-lg-4 align-self-center">
                        <a href="display-item.php?id=<?php echo $row["item_id"]; ?>">
                            <img src="<?php echo $row["item_image"]; ?>" class="img-fluid" alt="">
                        </a>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6 col-md-10">
                                <div class="ad-listing-content">
                                    <div>
                                        <a href="display-item.php?id=<?php echo $row["item_id"]; ?>" class="font-weight-bold"><?php echo $row["name"]; ?></a>
                                    </div>
                                    <div>
                                        <span class="font-weight-bold">$<?php echo $row["price"]; ?></span>
                                    </div>
                                    <ul class="list-inline mt-2 mb-3">
                                        <li class="list-inline-item"><a href="category.html"> <i class="fa fa-folder-open-o"></i> <?php echo $row["category"]; ?></a></li>
                                    </ul>
                                    <p class="pr-5"><?php echo $row["description"]; ?></p>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 align-self-center">

                                <div class="product-ratings float-lg-right pb-3 ">
                                    <ul class="d-flex list-inline justify-content-center align-items-center">

                                        <li class="list-inline-item add" value="<?php echo $row["item_id"]; ?>">
                                        <button class="btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                          <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                        </button>
                                        </li>

                                        <li class="list-inline-item">
                                        <h4>Quantity: <span id="qty<?php echo $row["item_id"]; ?>"><?php echo $row["count"]; ?></span></h4>
                                        </li>
                                        
                                        <li class="list-inline-item remove"  value="<?php echo $row["item_id"]; ?>">
                                            <button class="btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-square-fill" viewBox="0 0 16 16">
                                              <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm2.5 7.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1z"/>
                                            </svg>
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div class="">


                  </div>

                        </div>
                    </div>
                </div>

                <?php
                    } ?>

                </div>



				<!-- ad listing list  -->

			</div>

      <div class="col-lg-3 col-md-4">
				<div class="category-sidebar">
                    <div class="widget category-list">
                        <h4 class="widget-header">Total:</h4>
                        <ul class="category-list">
                            <li><h4>$<span id = "total_price"><?php echo $total_price ?></span></h4></li>                            
                        </ul>
                    </div>

				</div>

        <form method="POST" id="buy-form" action="php/buy.php">
        <div class="d-grid gap-2">
          <button <?php if (!$num_cart_items > 0) {
            echo "disabled";
          } ?> class="btn btn-danger btn-lg" id = "buy-btn" type="submit">Buy</button>
        </div>
        </form>
        		
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
          <p>Copyright © <script>
              var CurrentYear = new Date().getFullYear()
              document.write(CurrentYear)
            </script>. All Rights Reserved, theme by <a class="text-primary" href="https://themefisher.com" target="_blank">themefisher.com</a></p>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
<script src="plugins/google-map/gmap.js"></script>
<script src="js/script.js"></script>
<script src="bootstrap-5.1.0-dist/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

<script src="js/add-to-cart.js"></script>
<script src="jquery-3.6.0.min.js"></script>


</body>

</html>
<?php

    include "php/connection.php";

    session_start();

    if (!isset($_SESSION["logedin"])) {
        $_SESSION["logedin"] = false ;
    }

    $item_id = $_GET["id"];

    $_SESSION["item_id"] = $item_id;

    $query1 = "SELECT * FROM `items` WHERE id = ?";
    $stmt1 = $connection->prepare($query1);
    $stmt1 -> bind_param("i", $item_id);
    $stmt1->execute();
    $result1= $stmt1->get_result();
    $row1 = $result1 -> fetch_assoc();

    $item_category = $row1["category"];

  
  
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
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="ad-post bg-gray py-5">
    <div class="container">
        <form method="POST" id="item-form" action="php/edit-item.php">
            <!-- Post Your ad start -->
            <fieldset class="border border-gary p-4 mb-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Edit Your Item</h3>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="font-weight-bold pt-4 pb-1">Name Of Item:</h6>
                            <input required type="text" class="border w-100 p-2 bg-white text-capitalize" name="item_name" value = "<?php echo $row1["name"]; ?>">
                       
                            <h6 class="font-weight-bold pt-4 pb-1">Description:</h6>
                            <textarea required id="" class="border p-3 w-100" rows="7" name="item_desc" ><?php echo $row1["description"]; ?>
                            </textarea>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="font-weight-bold pt-4 pb-1">Select Item Category:</h6>
                            <select name="item_category" id="item-category" class="w-100">
                                <option disabled value="1">Select category</option>
                                <option <?php if ($item_category == "Phones") {echo "selected"; } ?> value="Phones">Phones</option>
                                <option <?php if ($item_category == "Cases") {echo "selected"; } ?> value="Cases">Cases</option>
                                <option <?php if ($item_category == "Chargers") {echo "selected"; } ?> value="Chargers">Chargers</option>
                                <option <?php if ($item_category == "Earphones") {echo "selected"; } ?> value="Earphones">Earphones</option>
                                <option <?php if ($item_category == "Laptops") {echo "selected"; } ?> value="Laptops">Laptops</option>
                                <option <?php if ($item_category == "Other") {echo "selected"; } ?> value="Other">Other</option>
                            </select>
                            
                        
                            <div class="price">
                                <h6 class="font-weight-bold pt-4 pb-1">Item Price ($ USD):</h6>
                                <div class="row px-3">
                                    <div class="col-lg-4 mr-lg-4 rounded bg-white my-2 ">
                                        <input required type="text" name="price" class="border-0 py-2 w-100 price" value = "<?php echo $row1["price"]; ?>"
                                            id="price">
                                    </div>
                                </div>
                            </div>

                            <div class="quantity">
                              <h6 class="font-weight-bold pt-4 pb-1">Available Quantity:</h6>
                              <div class="row px-3">
                                  <div class="col-lg-4 mr-lg-4 rounded bg-white my-2 ">
                                      <input required type="text" name="qty" class="border-0 py-2 w-100 price" value = "<?php echo $row1["qty"]; ?>"
                                          id="qty">
                                  </div>
                              </div>
                          </div>

                            <div class="item-image">
                              <h6 class="font-weight-bold pt-4 pb-1">Item Image Link:</h6>
                              <div class="row px-3">
                                  <div class="col-lg-4 mr-lg-4 rounded bg-white my-2 ">
                                      <input required type="text" name="item_image" class="border-0 py-2 w-100 price" value = "<?php echo $row1["item_image"]; ?>"
                                          id="item-image">
                                  </div>
                              </div>
                          </div>


                        </div>
                    </div>
            </fieldset>
            <!-- Post Your ad end -->


            <!-- submit button -->
           
            <button type="submit" id = "post-button" class="btn btn-primary d-block mt-2">Edit Your Item</button>
        </form>
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
          <p>Copyright ?? <script>
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

</body>

</html>
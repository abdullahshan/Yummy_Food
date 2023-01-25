<?php
session_start();


if(!isset($_SESSION['auth'])){

        header("location: http://localhost/Yummy/backend/register.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Yummy Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Yummy - v1.2.1
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->


  <style>
    td{

      font-weight: bold;
      text-align: center;
    }
  </style>


</head>

<body>



  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="http://localhost/Yummy/" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Yummy<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="http://localhost/Yummy/#hero">Home</a></li>
          <li><a href="http://localhost/Yummy/#about">About</a></li>
          <li><a href="http://localhost/Yummy/#menu">Menu</a></li>
          <li><a href="http://localhost/Yummy/#events">Events</a></li>
          <li><a href="http://localhost/Yummy/#chefs">Chefs</a></li>
          <li><a href="http://localhost/Yummy/#gallery">Gallery</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a href="http://localhost/Yummy/#contact">Contact</a></li>
          <li><a href="./cart_view.php">card</a></li>

            <?php
  include("../database/env.php");
        $query = "SELECT * FROM card";
        $exicute = mysqli_query($conn,$query);
        $row = mysqli_num_rows($exicute);

        $query = "SELECT * FROM orders";
        $exicute = mysqli_query($conn,$query);
        $orders = mysqli_num_rows($exicute);

        // print_r($row);

     $user_id = $_SESSION['auth']['id'];

        $query = "select * from card WHERE user_id= '$user_id'";
        $exicute = mysqli_query($conn,$query);

            $data = mysqli_fetch_all($exicute,1);

              // print_r($data);

              // exit;

?>


          <span style="background-color: #CCCCFF; border-radius: 5px;color:black"><?= $row ?></span>
          <li><a href="./orders.php">orders</a></li>
          <span style="background-color: #CCCCFF; border-radius: 5px;color:black"><?= $orders ?></span>

          <?php

                if(isset( $_SESSION['auth'])){
          ?>

                  <li> <a href="../Controller/logout.php">Logout</a></li>
          <?php
          }else{
          ?>
            <li><a href="../backend/register.php" style="color:red;">Registration/Login</a></li>
            <?php
          }
          ?>

        
        </ul>
      </nav><!-- .navbar -->

      <a class="btn-book-a-table" href="#book-a-table">Book a Table</a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->



  <!-- ======= Hero Section ======= -->
  <section class="container mt-5 text-xl-center" id="hero" class="hero d-flex align-items-center section-bg">

                <h2>  FOOD CARD</h2>
                <div class="card mt-5">
              <div class="card-body">

                    <table class="table">
                      <thead class="thead">
                        <tr>
                          <th>IMage</th>
                          <th>Name</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Total price</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                           $Grand_total = 0;
                        foreach($data as $key=> $s_data){
                          ?>

                            <tr>

                              <td><img style="height: 100px;" src="../upload/food/<?= $s_data['image'] ?>" alt=""></td>
                              <td><?= $s_data['title'] ?></td>
                              <td>$_<?= $s_data['price'] ?>/-</td>
                              <td>
                                <form action="update_quantity.php?id= <?= $s_data['id'] ?>" method="POST">
                                  <input class="col-md-2" type="number" min="1" name="update_quantity" value="<?= $s_data['quantity'] ?>">
                                  <button class="btn btn-primary" name="submit">Update</button>
                              </td>
                              </form>   
                              <td> $_<?Php  echo $sub_total = $s_data['price'] * $s_data['quantity']  ?>/-</td>
                              <td><a class="btn btn-danger" href="remove.php?id= <?= $s_data['id'] ?>">Remove</a></td>            
                            </tr>


                            <?PHP $Grand_total = $Grand_total + $sub_total?>
                            

                          <?php
                        }

                      ?>
                      </tbody>
                    </table>
                     
                    <div class="row">
                          <div class="col-md-2">
                                <a class="btn btn-info" href="http://localhost/Yummy/#menu">CONTINUE</a>
                          </div>
                          <div class="col-md-8">
                              
                          <span style="color: blue; font-weight:bold;">  GRAND_TOTAL = $_<?PHP echo $Grand_total ?>/-</span>
                              
                          </div>
                          <div class="col-md-2" style="position: absolute; right:-8px;">
                                <a class="btn btn-danger" href="deldete_all.php?id= <?= $s_data['id'] ?>">all_delete</a>
                          </div>
                          
                    </div>
                    <div>

                    <a href="checkout_system.php" class="btn <?= $Grand_total > 0 ? 'btn-primary' : 'disabled' ?>">cash on delivary</a>

                    </div>
                    <div class="mt-5">
                        <form action="../frontend_inc/checkout.php" method="post">
                            <input type="hidden" name="price" value="<?= $Grand_total ?>">
                            <input type="hidden" name="user_id" value="<?= $_SESSION['auth']['id'] ?>">
                            <button type="submit" name="submit" class="btn btn-primary">pay on card</button>
                        </form>
                    </div>
                   
              </div>
            </div>
          
  </section><!-- End Hero Section -->



  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Address</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022 - US<br>
            </p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Reservations</h4>
            <p>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <strong>Mon-Sat: 11AM</strong> - 23PM<br>
              Sunday: Closed
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Yummy</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>

  
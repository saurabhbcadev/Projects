<?php

include('includes/header.php');
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="3" aria-label="Slide 4"></button>
          <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="3000">
            <img src="image/banner1.webp" class="d-block w-100 slide">
          </div>
          <div class="carousel-item" data-bs-interval="3000">
            <img src="image/banner2.webp" class="d-block w-100 slide">
          </div>
          <div class="carousel-item" data-bs-interval="3000">
            <img src="image/banner3.webp" class="d-block w-100 slide">
          </div>
          <div class="carousel-item" data-bs-interval="3000">
            <img src="image/banner4.webp" class="d-block w-100 slide">
          </div>
          <div class="carousel-item" data-bs-interval="3000">
            <img src="image/banner5.webp" class="d-block w-100 slide">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div><br>
  <div class="row about_us">
    <div class="col-md-8 lastbox">
      <h2 class="us text-center">Our Parlour</h2>
      <img class="imgbox rounded " src="image/shop1.jpg" title="shop" alt="shop" width="98%">
      <img class="imgbox rounded" src="image/shop2.jpg" title="shop" alt="shop" width="98%">
    </div>
    <div class="col-md-4 lastbox">
      <h2 class="us text-center">About Us</h2>
      <h5 class="about">New Look Beauty Parlour the Best Salon in Dumra, Sitamarhi in every criterion you look at it. New Look Beauty Parlour having professionals having more than 15 years of experience in their field of expertise. We do each service whether
        Skin, Hair or Makeup with due care, precision, patience and perfection. Our Guests are our God who keeps the salon going and let it reach new heights every now and then, and believe me, we treat them accordingly. If you opt us for
        your wedding makeup, your wedding album will never allow you to forget us. If you opt us for the hair services, whenever the wind will blow, your silky and shiny hair will ever remind you of us, if you opt the skin services over here,
        you will be fed up answering only one question to your friends What you actually do to your skin? and at last, if you opt for nail services over here, I am not sure whether you will get irritated or not by the No of admirations you
        will get from friends and family for the same. New Look Beauty Parlour undoubtedly the Best beauty parlour in Your City as it is tested and trusted by almost 4 ladies in 5. You can be one of those happy and beautiful ladies, just make
        a call to us or Book Your Appointment Just Now. New Look Beauty Parlour available at your fingertips. We will make you happy every time. We Provide the Services of Haircuts & Styling, Perm & Straightening, Conditioning, Colour & Highlights,
        Basic Facials, Deluxe Facials, Eyebrow, Eyebrow Tint, Acne Treatments, Bridal Makeup, Makeup, Specials, Wedding Specials, Straightening, Manicure, Basic Facials, Acrylic Nail, Nail Cutting,
        Eyebrow Shape, Eyebrow, Eyebrow Tint and Many More.</h5>
    </div>
  </div>
  <div class="row box">
    <h2 class="us text-center">Our Team</h2>
    <?php
    require_once('includes/connect.php');
    $sql = "SELECT `name`, `designation`, `picture` FROM `admin` WHERE `status` = '1'";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($res)) { ?>
      <div class="col-md-2">
        <div class="imgbox rounded text-center">
          <img class='img-thumbnail rounded-circle imgteam' src='image/team/<?= $row['picture'] ?>' alt='team' title='Team'>
          <h4 class='text-center text-bold' style='color:orangered;'><?= $row['name'] ?></h4>
          <h6 class='text-center' style='color:blueviolet;'><?= $row['designation'] ?></h6>
        </div>
      </div>
    <?php } ?>
  </div>
  <div class="row box">
    <h2 class="us text-center">Popular Services</h2>
    <?php
    $sql = "SELECT `image`, `title`, `description`, `price` FROM `services` WHERE `status` = '1' AND `id` IN (1, 3, 22)";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($res)) {
    ?>
      <div class="col-md-4">
        <div class="service">
          <img class="imgbox rounded" src='image/services/<?= $row['image'] ?>' width="96%">
          <h3><u> <?= $row['title'] ?> </u></h3>
          <p class="sr_para"> <?= $row['description'] ?> </p>
          <div class="d-flex justify-content-around">
            <button type="button" class="btn-rounded btn btn-warning btnsr">Price:- &#8377; <?= $row['price'] ?>/-</button>
            <a href="ba.php">
              <button type="button" class="btn-rounded btn btn-success btnsr">Book Appointment</button>
            </a>
          </div>
        </div>
      </div>
    <?php }
    ?>
    <a href="services.php" class="text-center">
      <button type="button" class="btn-rounded  btn btn-danger btnmore">Click Here To Checkout Our More Services </button>
    </a>
  </div>
  <div class="row box">
    <div class="col-md-12">
      <?php
      $sql = "SELECT `image` FROM `gallery` WHERE `status`='1' LIMIT 8";
      $res = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($res)) {
        echo "<img class='imgbox rounded srimg' src='image/gallery/$row[0]' alt='$row[0]'>";
      }
      ?>
      <a href="gallery.php">
        <center>
          <button type="button" class="btn-rounded  btn btn-primary btnmore">Click Here To Checkout More Photos </button>
        </center>
      </a>
    </div>
  </div>
  <div class="row box">
    <div class="col-md-12">
      <h2 class="us text-center">Videos</h2>
      <iframe class="imgbox rounded shorts" src="https://www.youtube.com/embed/KWCglC3Il_g" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      <iframe class="imgbox rounded shorts" src="https://www.youtube.com/embed/83buqyEFKIg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      <iframe class="imgbox rounded shorts" src="https://youtube.com/embed/exM6UJxKQCQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      <iframe class="imgbox rounded shorts" src="https://www.youtube.com/embed/BUCg53fbrW4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
    <a href="https://www.youtube.com/@NEWLOOKBEAUTYPARLOUR/shorts" target="_blank" class='text-center'>
      <button type="button" class="btn-rounded  btn btn-info btnmore">Click Here To Checkout More Videos </button>
    </a>
  </div>
  <div class="box">
    <h2 class="us text-center">Enquiry</h2>
    <form name='enquiry' id='enquiry'>
      <div class="row">
        <div class="col-md-6">
          <label for="name" class="form-label enq">Name<span class="text-danger">*</span> </label>
          <input name="name" type="text" class="form-control form-control-sm enq" id="enq_name" placeholder="Full Name*"><br>
          <label for="mobile" class="form-label enq">Mobile Number<span class="text-danger">*</span> </label>
          <input name="mobile" type="text" class="form-control form-control-sm enq " id="enq_mobile" placeholder="10 Digit Mobile Number*">
        </div>
        <div class="col-md-6">
          <label for="message" class="form-label enq enqmsg">Enter Message (20 To 200 Character)<span class="text-danger">*</span></label><br>
          <textarea class="form-control enq" name="message" id="enq_message" cols="40" rows="5"></textarea>
        </div>
        <center><input style='width:fit-content' class="btn btn-rounded btn-success btnmore" type="submit" value="Send Enquiry"></center>
      </div>
    </form>
  </div>
</div>
<?php include('includes/footer.php') ?>
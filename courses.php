<?php
  session_start();

  // Include settings and database connection
  require_once("./settings.php");

  // Check if the filter form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check and apply filter conditions based on user input
    $course_category = sanitize_input($_POST["course_category"]);

    if ($course_category === 'All') {
      $whereClause = '1';
    } else {
      $whereClause = 'CourseCategory = $course_category';
    }

    // Query to fetch courses based on filter conditions
    $filter_course = $conn->query("SELECT * FROM s104181721_db.Course WHERE '$whereClause';");
    } else {
    $filter_course = $conn->query("SELECT * FROM s104181721_db.Course;");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="COS20031 Computing Technology Design Project">
  <meta name="author" content="Lo Tuan Hung, Luong Chi Duc, Nguyen Vu Duy Minh, Hau Linh Chi, Dao Khanh Nga Thi">
  <link href="styles/style.css" rel="stylesheet">
  <link rel="icon" href="images/Favicon-02.png" type="image/x-icon">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  <script src="https://kit.fontawesome.com/f73039f1ad.js" crossorigin="anonymous"></script>

  <link href="styles/lightslider.css" rel="stylesheet" type="text/css">
  <script src="js/jquery.js"></script>
  <script src="js/lightslider.js"></script>
  <script src="js/script.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <title>Courses Page</title>
</head>

<body>
  <header>

    <!-- Navigation Bar -->

    <a href="#"><img alt="Logo" src="images/Logo.png" class="logo"></a>

    <nav class="navbar">
      <a href="pagenotfound.html">Home</a>
      <a href="pagenotfound.html">About</a>
      <a href="courses.html" class="btn_active">Courses</a>
      <a href="jobopportunities.html">Job Opportunities</a>
    </nav>

    <div class="icons">
      <ul>
        <!-- <li><i class="uil uil-bars" id="bars"></i></li> -->
        <li><i class="uil uil-search" id="search_box"></i></li>
        <li><a href="#" class="uil uil-user"></a></li>
      </ul>
    </div>

  </header>
  <main>

    <section class="cp-contents">
      <h1>Courses</h1>

      <!-- First Course Group -->

      <div class="cp-box-container">
        <div class="header">
          <h5>Suggested for you</h5>
        </div>
        <hr>

        <!-- Suggest Button-->
        <form method="post" action="courses.php" id="cp-search-buttons">
          <div id="form_check">
            <!-- Suggest Input-->
            <div>
              <label><input name="course_category" class="cp-suggested-btn" type="radio" value="All" id="All">
                <span>All</span></label>
              <label><input name="course_category" class="cp-suggested-btn" type="radio" value="FnB" id="FnB">
                <span>F&B</span></label>
              <label><input name="course_category" class="cp-suggested-btn" type="radio" value="BeautynSpa" id="BeautynSpa">
                <span>Beauty & Spa</span></label>
              <label><input name="course_category" class="cp-suggested-btn" type="radio" value="TourismHospitality" id="TourismHospitality">
                <span>Tourism & Hospitality</span></label>
            </div>

            <!--Submit button-->
            <div>
              <input class="cp-submit-btn" type="submit" value="Apply filter">
            </div>
          </div>
        </form>

        <?php while ($row = mysqli_fetch_assoc($filter_course)) { ?>
          <ul class="autoWidth" class="cs-hidden">
            <!-- Card 1 -->
            <li class="slide">
              <div class="sp-card">
                <div class="sp-image-box">
                  <img src="images/nail.png" alt="product.png">
                </div>
                <div class="sp-product-details">
                  <div class="type">
                    <h6><?php echo $row['Title']; ?></h6>
                  </div>
                  <div class="sp-product-require">
                    <ul>
                      <li><img src="icons/Time.svg"> <?php echo $row['Length']; ?></li>
                      <li><img src="icons/Fee.svg"> <?php echo $row['Price']; ?></li>
                    </ul>
                  </div>
                </div>
                <button class="sp-product-btn">Register for this course</button>
              </div>
            </li>
          </ul>
        <?php } ?>
      </div>


      <!-- Second Course Group -->

      <div class="cp-box-container">
        <div class="header">
          <h5>All courses</h5>
        </div>
        <hr>

        <!-- Suggest Button-->
        <form method="post" action="courses.php" id="cp-search-buttons">
          <div id="form_check">
            <!-- Suggest Input-->
            <div>
              <label><input class="cp-suggested-btn" type="checkbox" name="All" value="All" id="All">
                <span>All</span></label>
              <label><input class="cp-suggested-btn" type="checkbox" name="FnB" value="FnB" id="FnB">
                <span>F&B</span></label>
              <label><input class="cp-suggested-btn" type="checkbox" name="BeautynSpa" value="BeautynSpa" id="BeautynSpa">
                <span>Beauty & Spa</span></label>
              <label><input class="cp-suggested-btn" type="checkbox" name="TourismHospitality" id="TourismHospitality" value="TourismHospitality">
                <span>Tourism & Hospitality</span></label>
            </div>

            <!--Submit button-->
            <div>
              <input class="cp-submit-btn" type="submit" value="Apply filter">
            </div>
          </div>
        </form>

        <?php while ($row = mysqli_fetch_assoc($filter_course)) { ?>
          <ul class="autoWidth" class="cs-hidden">
            <!-- Card 1 -->
            <li class="slide">
              <div class="sp-card">
                <div class="sp-image-box">
                  <img src="images/nail.png" alt="product.png">
                </div>
                <div class="sp-product-details">
                  <div class="type">
                    <h6><?php echo $row['Title']; ?></h6>
                  </div>
                  <div class="sp-product-require">
                    <ul>
                      <li><img src="icons/Time.svg"> <?php echo $row['Length']; ?></li>
                      <li><img src="icons/Fee.svg"> <?php echo $row['Price']; ?></li>
                    </ul>
                  </div>
                </div>
                <button class="sp-product-btn">Register for this course</button>
              </div>
            </li>
          </ul>
        <?php } ?>
      </div>

    </section>

  </main>

  <!--Back to top button-->
  <div>
    <a href="#" title="Back to top">
      <i class="uil uil-arrow-up" id="gotopbtn"></i>
    </a>
  </div>

  <footer>
    <div class="container">
      <div class="row">

        <!-- First column -->

        <div class="footer_col">
          <a href="#"><img alt="Logo" src="images/Logo_footer.png" class="logo"></a>
          <br><br>
          <h4>Contact information</h4>
          <ul>
            <li>Main branch</li>
            <li><i class="fa-solid fa-location-dot"></i> P2 – 12A Eastern Park 2 Thạch Bàn,<br>Long Biên District, Hà
              Nội</li>
            <li><i class="fa-solid fa-phone"></i> (+84)98.499.65.98</li>
          </ul>
        </div>

        <!-- Second column -->

        <div class="footer_col">
          <h4>Navigation</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="courses.html">Courses</a></li>
            <li><a href="jobopportunities.html">Job Opportunities</a></li>
          </ul>
        </div>

        <!-- Third column -->

        <div class="footer_col">
          <h4>Contact us</h4>
          <form action="">
            <input type="text" placeholder="Your name" class="inputName">
            <input type="text" placeholder="Your phone number" class="inputNumber">
            <input type="email" placeholder="Your email" class="inputEmail">
            <textarea placeholder="Message" class="textareaMessage"></textarea>
            <input type="submit" value="Submit" class="inputSubmit">
          </form>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <script>
    const swiper = new Swiper('.swiper', {
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      loop: true,

      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    AOS.init();
  </script>


</body>

</html>
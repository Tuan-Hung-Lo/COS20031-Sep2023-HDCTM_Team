<?php
  session_start();

  // Include settings and database connection
  require_once("./settings.php");

  // Initialize the WHERE clause for filtering
  $whereClause = "1"; // Default condition to select all jobs

  // Check if filter form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check and apply filter conditions based on user input

    // EXPECTED SALARY
    $esalaryfrom = isset($_POST['esalaryfrom']) ? intval($_POST['esalaryfrom']) : 0;
    $esalaryto = isset($_POST['esalaryto']) ? intval($_POST['esalaryto']) : PHP_INT_MAX;

    $whereClause .= " AND Salary BETWEEN $esalaryfrom AND $esalaryto";

    // EXPERIENCE LEVEL
    $experienceLevels = isset($_POST['experienceLevels']) ? $_POST['experienceLevels'] : [];
    if (!empty($experienceLevels)) {
      $experienceLevels = array_map('mysqli_real_escape_string', $experienceLevels);
      $experienceLevelsStr = "'" . implode("', '", $experienceLevels) . "'";
      $whereClause .= " AND ExperienceLevel IN ($experienceLevelsStr)";
    }

    // WORKING FORMAT
    $workingFormats = isset($_POST['workingFormats']) ? $_POST['workingFormats'] : [];
    if (!empty($workingFormats)) {
      $workingFormats = array_map('mysqli_real_escape_string', $workingFormats);
      $workingFormatsStr = "'" . implode("', '", $workingFormats) . "'";
      $whereClause .= " AND WorkingFormat IN ($workingFormatsStr)";
    }

    // SPECIALISATION
    $specialisations = isset($_POST['specialisations']) ? $_POST['specialisations'] : [];
    if (!empty($specialisations)) {
      $specialisations = array_map('mysqli_real_escape_string', $specialisations);
      $specialisationsStr = "'" . implode("', '", $specialisations) . "'";
      $whereClause .= " AND Specialisation IN ($specialisationsStr)";
    }
  }

  // Query to fetch jobs based on filter conditions
  $result = mysqli_query($conn, "SELECT * FROM s104181721_db.Job WHERE $whereClause");

  // Fetch all rows into an associative array
  $jobs = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $jobs[] = $row;
  }

  // Close the database connection
  mysqli_close($conn);
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
  <title>Job Opportunities Page</title>
</head>

<body>

  <header>

    <!-- Navigation Bar -->

    <a href="pagenotfound.html"><img alt="Logo" src="images/Logo.png" class="logo"></a>

    <nav class="navbar">
      <a href="pagenotfound.html">Home</a>
      <a href="pagenotfound.html">About</a>
      <a href="courses.php">Courses</a>
      <a href="jobopportunities.php" class="btn_active">Job Opportunities</a>
    </nav>

    <div class="icons">
      <ul>
        <?php while ($row = mysqli_fetch_assoc($job_seeker)) { ?>
        <li><a href="jobseeker.php"><img src="http://dummyimage.com/180x180.png/dddddd/000000"></a></li>
        <?php } ?>
        <li><a href="login.html"><img src="icons/Logout.svg"></a></li>
      </ul>
    </div>

  </header>

  <main>

    <section class="jop-contents">
      <h1>Job opportunities</h1>

      <!-- FILTER -->

      <button type="button" class="collapsible">Filter</button>

      <div class="content">
        <hr>
        <br>

        <div class="jop-filter">

          <form method="post" action="jobopportunities.php">

            <!-- EXPERIENCE LEVEL -->
            <div class="elevel">

              <p>Experience level</p>

              <label><input class="jopfilter" type="radio" name="jopfilter_el" value="Internship">
                <span>Internship</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_el" value="Entry">
                <span>Entry</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_el" value="Junior">
                <span>Junior</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_el" value="Senior">
                <span>Senior</span></label>

            </div>
            <br>

            <!-- WORKING FORMAT -->
            <div class="wformat">

              <p>Working format</p>

              <label><input class="jopfilter" type="radio" name="jopfilter_wf" value="remote">
                <span>Remote</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_wf" value="hybrid">
                <span>Hybrid</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_wf" value="online">
                <span>Online</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_wf" value="offline">
                <span>Offline</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_wf" value="flexible">
                <span>Flexible</span></label>
            </div>
            <br>


            <!-- SPECIALISATION -->
            <div class="specialisation">

              <p>Specialisation</p>

              <label><input class="jopfilter" type="radio" name="jopfilter_s" value="beauty&spa">
                <span>Beauty & Spa</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_s" value="f&b">
                <span>F&B</span></label>

              <label><input class="jopfilter" type="radio" name="jopfilter_s" value="tourism&hospitality">
                <span>Tourism & Hospitality</span></label>

            </div>

            <br>
            <!-- SUBMIT, CLEAR BUTTON -->
            <input class="jopsubmit" type="submit" value="Apply filter">
            <input class="jopclear" type="reset" value="Clear">

          </form>
          <br>
          <br>
        </div>
      </div>

      <!-- First Course Group -->

      <div class="cp-box-container">
        <div class="header">
          <h5>Suggested for you</h5>
        </div>
        <hr>
        <?php while ($row = mysqli_fetch_assoc($job)) { ?>
        <ul class="autoWidth" class="cs-hidden">
          <!-- Card 1 -->
          <li class="slide">
            <div class="sp-card">
              <div class="sp-image-box">
                <img src="images/nail.png" alt="product.png">
              </div>
              <div class="sp-product-details">
                <div class="type">
                  <h6>
                    <?php echo $row['JobTitle']; ?>
                  </h6>
                </div>
                <div class="sp-product-require">
                  <ul>
                    <li><img src="icons/Location.svg">
                      <?php echo $row['WorkLocation']; ?>
                    </li>
                    <li><img src="icons/Fee.svg">
                      <?php echo $row['Salary']; ?>
                    </li>
                    <li><img src="icons/ExperienceLevel.svg">
                      <?php echo $row['ExperienceLevel']; ?>
                    </li>
                    <li><img src="icons/WorkingMode.svg">
                      <?php echo $row['WorkingFormat']; ?>
                    </li>
                  </ul>
                </div>
              </div>
              <button class="sp-product-btn">Apply for this job</button>
            </div>
          </li>
        </ul>
        <?php } ?>
      </div>

      <!-- Second Course Group -->
      <div class="jop-slider">
        <div class="cp-box-container">
          <div class="header">
            <h5>All job opportunities</h5>
          </div>
          <hr>

          <?php while ($row = mysqli_fetch_assoc($job)) { ?>
          <ul class="autoWidth" class="cs-hidden">
            <!-- Card 1 -->
            <li class="slide">
              <div class="sp-card">
                <div class="sp-image-box">
                  <img src="images/nail.png" alt="product.png">
                </div>
                <div class="sp-product-details">
                  <div class="type">
                    <h6>
                      <?php echo $row['JobTitle']; ?>
                    </h6>
                  </div>
                  <div class="sp-product-require">
                    <ul>
                      <li><img src="icons/Location.svg">
                        <?php echo $row['WorkLocation']; ?>
                      </li>
                      <li><img src="icons/Fee.svg">
                        <?php echo $row['Salary']; ?>
                      </li>
                      <li><img src="icons/ExperienceLevel.svg">
                        <?php echo $row['ExperienceLevel']; ?>
                      </li>
                      <li><img src="icons/WorkingMode.svg">
                        <?php echo $row['WorkingFormat']; ?>
                      </li>
                    </ul>
                  </div>
                </div>
                <button class="sp-product-btn">Apply for this job</button>
              </div>
            </li>
          </ul>
          <?php } ?>
        </div>
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
          <a href="pagenotfound.html"><img alt="Logo" src="images/Logo_footer.png" class="logo"></a>
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
            <li><a href="pagenotfound.html">Home</a></li>
            <li><a href="pagenotfound.html">About</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="jobopportunities.php">Job Opportunities</a></li>
          </ul>
        </div>

        <!-- Third column -->

        <div class="footer_col">
          <h4>Contact us</h4>
          <form action="#">
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


  <script>
    var coll = document.getElementsByClassName("collapsible");
    var i;
    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
          content.style.display = "none";
        } else {
          content.style.display = "block";
        }
      });
    }
  </script>

</body>

</html>
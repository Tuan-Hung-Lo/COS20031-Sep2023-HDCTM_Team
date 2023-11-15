<?php
  session_start();

  // Include settings and database connection
  require_once("./settings.php");
  
  if (isset($_SESSION['UserAuthenticationID'])) {
    $UserAuthenticationID = $_SESSION['UserAuthenticationID'];
    $user_email = $_SESSION['user_email'];

    $job_seeker = $conn->query("SELECT * FROM s104181721_db.JobSeeker WHERE UserAuthenticationID = '$UserAuthenticationID';");
    $JobSeekerID = $conn->query("SELECT JobSeekerID FROM s104181721_db.JobSeeker WHERE UserAuthenticationID = '$UserAuthenticationID';");
    $education = $conn->query("SELECT * FROM s104181721_db.Education
      JOIN s104181721_db.JobSeeker ON Education.JobSeekerID = JobSeeker.JobSeekerID WHERE JobSeeker.UserAuthenticationID = '$UserAuthenticationID';");
    $skill = $conn->query("SELECT * FROM s104181721_db.Skill
      JOIN s104181721_db.JobSeeker ON Skill.JobSeekerID = JobSeeker.JobSeekerID WHERE JobSeeker.UserAuthenticationID = '$UserAuthenticationID';");
    $working_experience = $conn->query("SELECT * FROM s104181721_db.WorkingExperience
      JOIN s104181721_db.JobSeeker ON WorkingExperience.JobSeekerID = JobSeeker.JobSeekerID WHERE JobSeeker.UserAuthenticationID = '$UserAuthenticationID';");
    $course = $conn->query("SELECT * FROM s104181721_db.CourseRegistration
      JOIN s104181721_db.Course ON CourseRegistration.CourseID = Course.CourseID
      JOIN s104181721_db.JobSeeker ON CourseRegistration.JobSeekerID = JobSeeker.JobSeekerID WHERE JobSeeker.UserAuthenticationID = '$UserAuthenticationID';");
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
      <a href="#">Home</a>
      <a href="#">About</a>
      <a href="courses.html">Courses</a>
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

  <!-- MAIN CONTENT -->
  <main>

    <h1 class="cpp-heading">
      Profile
    </h1>

    <div class="cpp-bie-container">
      <!-- BASIC INFORMATION -->
      <div class="cpp-bi-container">

        <?php if ($row = mysqli_fetch_assoc($job_seeker)) { ?>
          <!-- HEADLINE -->
          <div class="cpp-bi-headline-container">

            <!-- PROFILE PICTURE -->
            <div class="cpp-bi-headline-profileimg">
              <img src="images/profilepic.webp" alt="Candidate Profile's Picture">
            </div>

            <!-- HEADLINE INFORMATION -->
            <div class="cpp-bi-headline-headline">
              <h2>
                <?php echo $row['FirstName'], $row['LastName'] ?>
              </h2>
              <br>
              <p>
                <img src="icons/Job Title.svg" />
                Job title:
                <span class="cpp-span"><?php echo $row['JSJobTitle'] ?></span>
              </p>
              <p>
                <img src="icons/Experience Level.svg" />
                Experience level:
                <span class="cpp-span"><?php echo $row['ExperienceLevel'] ?></span>
              </p>
            </div>

          </div>
          <br>

          <!-- PERSONAL INFORMATION -->
          <div class="cpp-bi-personalinfo-container">

            <!-- TITLE -->
            <div class="cpp-title">

              <h3>Personal information</h3>

              <a class="profilelink" href="#">
                <img src="icons/Edit.svg" />Edit
              </a>

            </div>

            <br>
            <hr>
            <br>

            <!-- CONTENT -->
            <div class="cpp-bi-personalinfo-content">

              <p>
                <img src="icons/Calendar.svg" />
                DOB:
                <span class="cpp-span"><?php echo $row['DOB'] ?></span>
              </p>
              <p>
                <img src="icons/Phone.svg" />
                Phone number:
                <span class="cpp-span"><?php echo $row['Phone'] ?></span>
              </p>
              <p>
                <img src="icons/Message.svg" />
                Email:
                <span class="cpp-span"><?php echo $user_email ?></span>
              </p>
              <p>
                <img src="icons/Location.svg" />
                Address:
                <span class="cpp-span"><?php echo $row['Address'] ?></span>
              </p>

            </div>
          </div>
          <br>
        <?php } ?>

        <!-- EDUCATION BACKGROUND -->
        <div class="cpp-bi-edubg-container">

          <!-- TITLE -->
          <div class="cpp-title">

            <h3>Education background</h3>

            <a class="profilelink" href="#">
              <img src="icons/Edit.svg" />Edit
            </a>

          </div>
          <br>
          <hr>
          <br>

          <!-- CONTENT -->
          <div class="cpp-bi-careerintro-content">

            <p>
              <span class="cpp-span">
                <div class="cpp-bi-personalinfo-content-edubg">
                  <ul>
                    <?php while ($row = mysqli_fetch_assoc($education)) { ?>
                      <li><?php echo $row['GraduationYear'], $row['Institution'] ?>
                        <br>
                        <i><?php echo $row['Degree'] ?></i>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
              </span>
            </p>
          </div>
        </div>
      </div>

      <!-- EXPERIENCE -->
      <div class="cpp-e-container">

        <!-- SKILLS -->
        <div class="cpp-e-skills-container">

          <!-- TITLE -->
          <div class="cpp-title">

            <h3>Skills</h3>

            <a class="profilelink" href="#">
              <img src="icons/Edit.svg" />Edit
            </a>

          </div>
          <br>
          <hr>
          <br>

          <!-- CONTENT -->
          <div class="cpp-e-skills-content">
            <?php while ($row = mysqli_fetch_assoc($skill)) { ?>
              <p><?php echo $row['SkillName'] ?></p>
            <?php } ?>
          </div>

        </div>
        <br>
        <br>

        <!-- WOKRING EXPERIENCE -->
        <div class="cpp-e-wokringexp-container">

          <!-- TITLE -->
          <div class="cpp-title">

            <h3>Working experience</h3>

            <a class="profilelink" href="#">
              <img src="icons/Edit.svg" />Edit
            </a>

          </div>

          <br>
          <hr>
          <br>

          <!-- CONTENT -->
          <div class="cpp-e-workingexp-content">
            <?php while ($row = mysqli_fetch_assoc($working_experience)) { ?>

              <!-- WORKING EXPERIENCE 1 -->
              <div class="cpp-e-workingexp-work">

                <!-- Company -->
                <h4>
                  <?php echo $row['WCompanyName'], $row['WTimeRange'] ?>
                </h4>

                <br>

                <!-- Position -->
                <h5>
                  <?php echo $row['WJobRole'] ?>
                </h5>

                <br>

                <!-- Description & Achievement -->
                <div class="cpp-e-workingexp-work-desc">
                  <ul>
                    <li>
                      <?php echo $row['WDescription']; ?>
                    </li>
                  </ul>
                </div>
              </div>

              <br>
              <br>

            <?php } ?>
          </div>
          
          <br>
          <br>

          <!-- EXTRACURRICULAR ACTIVITIES -->
          <div class="cpp-e-extraact-container">

            <!-- TITLE -->
            <div class="cpp-title">

              <h3>Extracurricular activities</h3>

              <a class="profilelink" href="#">
                <img src="icons/Edit.svg" />Edit
              </a>

            </div>

            <br>
            <hr>
            <br>

            <!-- CONTENT -->
            <div class="cpp-e-extraact-content">
              <?php while ($row = mysqli_fetch_assoc($education)) { ?>
                <p>
                  <span class="cpp-span">
                    <?php echo $row['WDescription']; ?>
                  </span>
                </p>
              <?php } ?>
            </div>

          </div>
        </div>
      </div>

      <!-- COURSES -->
      <div class="cpp-course-container">

        <!-- REGISTERED COURSES -->
        <div class="cp-box-container">
          <div class="header">
            <h5>Registered courses</h5>
          </div>
          <hr>

          <?php while ($row = mysqli_fetch_assoc($course)) { ?>
            <ul class="autoWidth" class="cs-hidden">
              <!-- Card 1 -->
              <li class="slide">
                <div class="sp-card">
                  <div class="sp-image-box">
                    <!-- Image data type ? Link url -->
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
                        <li><img src="icons/Scholar.svg"> Up to 100%</li>
                      </ul>
                    </div>
                  </div>
                  <button class="sp-product-btn">See course details</button>
                </div>
              </li>
            </ul>
          <?php } ?>
        </div>

        <!-- JOB APPLICATIONS -->
        <div class="cp-box-container">
          <div class="header">
            <h5>Job applications</h5>
          </div>
          <hr>
          <!-- Design y hệt mấy thẻ course -->
          <?php while ($row = mysqli_fetch_assoc($course)) { ?>
            <ul class="autoWidth" class="cs-hidden">
              <!-- Card 1 -->
              <li class="slide">
                <div class="sp-card">
                  <div class="sp-image-box">
                    <img src="images/nail.png" alt="product.png"> <!-- link url -->
                  </div>
                  <div class="sp-product-details">
                    <div class="type">
                      <h6>UI-UX Designer/Researcher - Melbourne</h6>
                    </div>
                    <div class="sp-product-require">
                      <ul>
                        <li><img src="icons/Location.svg"> Melbourne, Victoria, Australia</li>
                        <li><img src="icons/Fee.svg"> AUD$ 2,500 - 5,200 </li>
                        <li><img src="icons/PeopleGroup.svg"> Remote</li>
                        <li><img src="icons/Check.svg"> Your profile matches this job</li>
                      </ul>
                    </div>
                  </div>
                  <button class="sp-product-btn">See job details</button>
                </div>
              </li>
            </ul>
          <?php } ?>
        </div>

        <!-- INTERVIEW SCHEDULE -->
        <div class="cp-box-container">
          <div class="header">
            <h5>Interview schedule</h5>
          </div>
          <hr>

          <?php while ($row = mysqli_fetch_assoc($course)) { ?>
            <ul class="autoWidth" class="cs-hidden">
              <!-- Card 1 -->
              <li class="slide">
                <div class="sp-card">
                  <div class="sp-image-box">
                    <img src="images/nail.png" alt="product.png">
                  </div>
                  <div class="sp-product-details">
                    <div class="type">
                      <h6>UI-UX Designer/Researcher - Melbourne</h6>
                    </div>
                    <div class="sp-product-require">
                      <ul>
                        <li><img src="icons/Location.svg"> Melbourne, Victoria, Australia</li>
                        <li><img src="icons/Fee.svg"> AUD$ 2,500 - 5,200 </li>
                        <li><img src="icons/PeopleGroup.svg"> Remote</li>
                        <li><img src="icons/Check.svg"> Your profile matches this job</li>
                      </ul>
                    </div>
                  </div>
                  <button class="sp-product-btn">See interview details</button>

                </div>
              </li>
            </ul>
          <?php } ?>
        </div>
      </div>
    </div>
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
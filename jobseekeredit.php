<?php
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserAuthenticationID = $_SESSION['UserAuthenticationID'];

    require_once("./settings.php");

    $fetchDataQuery = $conn->query("SELECT * FROM JobSeeker WHERE JobSeekerID = '$UserAuthenticationID';");

    if ($fetchDataQuery) {
        $existingData = $fetchDataQuery->fetch_assoc();
  
        // Assign existing data to variables
        $existingFirstName = $existingData['FirstName'];
        $existingLastName = $existingData['LastName'];
        $existingExperienceLevel = $existingData['ExperienceLevel'];
        // Assign other variables similarly for other fields
    }

    // Function to update or insert data into a table
    function edit($conn, $table, $data, $conditionColumn, $conditionValue)
    {
      $columns = implode(", ", array_keys($data));
      $values = "'" . implode("', '", array_map('sanitize_input', $data)) . "'";

      $sql = "INSERT INTO $table ($columns) VALUES ($values) ON DUPLICATE KEY UPDATE ";

      foreach ($data as $column => $value) {
        $sql .= "$column = VALUES($column), ";
      }

      // Remove the trailing comma
      $sql = rtrim($sql, ", ");

      // Add the condition for the WHERE clause
      $sql .= " WHERE $conditionColumn = '$conditionValue'";

      return $conn->query($sql);
    }

    // Retrieve data from the form
    $JSImage = $_POST["jsep-profileimg-link"];
    $FirstName = $_POST["jsep-first-name"];
    $LastName = $_POST["jsep-last-name"];
    $ExperienceLevel = $_POST["jsep-experience-level"];
    $JSJobTitle = $_POST["jsep-job-title"];
    $Gender = $_POST["jsep-gender"];
    $DOB = $_POST["jsep-dob"];
    $Phone = $_POST["jsep-phone"];
    $Address = $_POST["jsep-address"];

    $Degree = $_POST["jsep-degree"];
    $Institution = $_POST["jsep-institute"];
    $GraduationYear = $_POST["jsep-period"];
    $GPA = $_POST["jsep-gpa"];

    $SkillName = $_POST["jsep-skill"];

    $WCompanyName = $_POST["jsep-companyname"];
    $WTimeRange = $_POST["jsep-wperiod"];
    $WJobRole = $_POST["jsep-wposition"];
    $WDescription = $_POST["jsep-wdesc"];

    $OrganizationName = $_POST["jsep-organisationname"];
    $EATimeRange = $_POST["jsep-eaperiod"];
    $EAJobRole = $_POST["jsep-earole"];
    $EADescription = $_POST["jsep-eadesc"];

    // Update or insert data into JobSeeker table
    $jobSeekerData = [
      'JSImage' => $JSImage,
      'FirstName' => $FirstName,
      'LastName' => $LastName,
      'ExperienceLevel' => $ExperienceLevel,
      'JSJobTitle' => $JSJobTitle,
      'Gender' => $Gender,
      'DOB' => $DOB,
      'Phone' => $Phone,
      'Address' => $Address,
    ];

    edit($conn, 'JobSeeker', $jobSeekerData, 'JobSeekerID', $UserAuthenticationID);

    // Update or insert data into Education table
    $educationData = [
      'Degree' => $Degree,
      'Institution' => $Institution,
      'GraduationYear' => $GraduationYear,
      'GPA' => $GPA,
    ];

    edit($conn, 'Education', $educationData, 'JobSeekerID', $UserAuthenticationID);

    // Update or insert data into Skill table
    $skillData = [
      'SkillName' => $SkillName,
    ];

    edit($conn, 'Skill', $skillData, 'JobSeekerID', $UserAuthenticationID);

    // Update or insert data into WorkingExperience table
    $workExperienceData = [
      'WCompanyName' => $WCompanyName,
      'WTimeRange' => $WTimeRange,
      'WJobRole' => $WJobRole,
      'WDescription' => $WDescription,
    ];

    edit($conn, 'WorkingExperience', $workExperienceData, 'JobSeekerID', $UserAuthenticationID);

    // Update or insert data into ExtracurriculumActivity table
    $extracurricularData = [
      'OrganizationName' => $OrganizationName,
      'EATimeRange' => $EATimeRange,
      'EAJobRole' => $EAJobRole,
      'EADescription' => $EADescription,
    ];

    edit($conn, 'ExtracurriculumActivity', $extracurricularData, 'JobSeekerID', $UserAuthenticationID);

    $conn->close();
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
  <title>Job Seeker Profile Edit Page</title>
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

  <!-- MAIN CONTENT -->
  <main>

    <h1 class="jsep-heading">
      Profile
    </h1>


    <form method="post" action="jobseekeredit.php" class="jsep-form">

      <div class="jsep-container">

        <!-- LEFT COLUMN -->
        <div class="left-col">

          <img src="images/profilepic.png" alt="Upload profile picture link">

          <!-- INSERT PROFILE IMAGE LINK -->
          <label class="jsep-label">
            <img src="icons/Link_B.svg">
            <input name="jsep-profileimg-link" type="text" class="jsep-input" placeholder="Insert profile image link">
          </label>

          <!-- FIRST NAME -->
          <label class="jsep-label">
            <img src="icons/Name_B.svg">
            <input name="jsep-first-name" type="text" class="jsep-input" placeholder="First Name" value="<?php echo $existingFirstName; ?>">
          </label>

          <!-- LAST NAME -->
          <label class="jsep-label">
            <img src="icons/Name_B.svg">
            <input name="jsep-last-name" type="text" class="jsep-input" placeholder="Last Name">
          </label>

          <!-- EXPERIENCE LEVEL -->
          <label class="jsep-label">
            <img src="icons/ExperienceLevel_B.svg">
            <input name="jsep-experience-level" type="text" class="jsep-input" placeholder="Experience level">
          </label>

          <!-- JOB TITLE -->
          <label class="jsep-label">
            <img src="icons/JobTitle_B.svg">
            <input name="jsep-job-title" type="text" class="jsep-input" placeholder="Job title">
          </label>
          <br>

          <!-- PERSONAL INFORMATION -->
          <h3>Personal information</h3>

          <!-- GENDER -->
          <div class="gender">
            <br>
            <p>Gender:</p>

            <label><input type="radio" name="jsep-gender" value="Female">
              Female</label>
            <br>
            <label><input type="radio" name="jsep-gender" value="Male">
              Male</label>
            <br>
            <label><input type="radio" name="jsep-gender" value="Others">
              Others</label>
            <br>
            <label><input type="radio" name="jsep-gender" value="Prefernottosay">
              Prefer not to say</label>
          </div>

          <!-- DOB -->
          <label class="jsep-label">
            <img src="icons/Calendar_B.svg">
            <input name="jsep-dob" type="text" class="jsep-input" placeholder="DOB (dd/mm/yyyy)">
          </label>

          <!-- PHONE NUMBER -->
          <label class="jsep-label">
            <img src="icons/Phone_B.svg">
            <input name="jsep-phone" type="text" class="jsep-input" placeholder="Phone number">
          </label>

          <!-- EMAIL -->
          <label class="jsep-label">
            <img src="icons/Message_B.svg">
            <input name="jsep-email" type="text" class="jsep-input" placeholder="Email">
          </label>

          <!-- ADDRESS -->
          <label class="jsep-label">
            <img src="icons/Location_B.svg">
            <input name="jsep-address" type="text" class="jsep-input" placeholder="Address">
          </label>
          <br>

          <!-- EDUCATION BACKGROUND -->
          <h3>Education background</h3>

          <div class="jsep-addmore-edu-p">
            <label class="jsep-label">
              <img src="icons/Degree_B.svg">
              <input name="jsep-degree" type="text" class="jsep-input" placeholder="Degree">
            </label>

            <label class="jsep-label">
              <img src="icons/Institute_B.svg">
              <input name="jsep-institute" type="text" class="jsep-input" placeholder="Institute">
            </label>

            <label class="jsep-label">
              <img src="icons/Calendar_B.svg">
              <input name="jsep-period" type="text" class="jsep-input" placeholder="Period (xxxx - xxxx)">
            </label>

            <label class="jsep-label">
              <img src="icons/GPA_B.svg">
              <input name="jsep-gpa" type="text" class="jsep-input" placeholder="GPA (x.xx)">
            </label>
            <br>

            <label class="jsep-addmore-edu">
              + Add more&nbsp;
            </label>
            <br>
            <br>

          </div>

          <br>
          <br>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-col">

          <!-- SKILLS -->
          <h3>Skills</h3>
          <br>

          <div class="jsep-addmore-skills-p">

            <div class="jsep-skill">
              <input name="jsep-skill" type="text" class="jsep-input" placeholder="Skills">
            </div>

            <label class="jsep-addmore-skills">
              + Add more&nbsp;
            </label>
            <br>

          </div>
          <br>
          <br>

          <!-- WORKING EXPERIENCE -->
          <h3>Working experience</h3>

          <div class="jsep-addmore-wexp-p">

            <div class="jsep-addmore-wexp-np">

              <div class="jsep-addmore-wexp-npcol">
                <input name="jsep-companyname" type="text" class="jsep-input-np" placeholder="Company name">
              </div>

              <div class="jsep-addmore-wexp-npcol">
                <input name="jsep-wperiod" type="text" class="jsep-input-np" placeholder="Working period">
              </div>

            </div>

            <div>
              <input name="jsep-wposition" type="text" class="jsep-input-wea" placeholder="Position">
            </div>

            <div>
              <textarea name="jsep-wdesc" type="text" class="jsep-desc" placeholder="Description"></textarea>
            </div>

            <br>
            <br>

            <label class="jsep-addmore-wexp">
              + Add more&nbsp;
            </label>
            <br>

            <br>

          </div>
          <br>
          <br>

          <!-- EXTRACURRICULAR ACTIVITIES -->
          <h3>Extracurricular activities</h3>

          <div class="jsep-addmore-extraa-p">

            <div class="jsep-addmore-extraa-np">

              <div class="jsep-addmore-extraa-npcol">
                <input name="jsep-organisationname" type="text" class="jsep-input-np" placeholder="Organisation name">
              </div>

              <div class="jsep-addmore-extraa-npcol">
                <input name="jsep-eaperiod" type="text" class="jsep-input-np" placeholder="Participation period">
              </div>

            </div>

            <div>
              <input name="jsep-earole" type="text" class="jsep-input-wea" placeholder="Role">
            </div>

            <div>
              <textarea name="jsep-eadesc" type="text" class="jsep-desc" placeholder="Description"></textarea>
            </div>

            <br>
            <br>

            <label class="jsep-addmore-extraa">
              + Add more&nbsp;
            </label>
            <br>
            <br>

          </div>


        </div>

      </div>

      <div class="jsep-submit-btn">
        <input type="submit" value="Save changes">
      </div>

    </form>


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
    // EDUCATION BACKGROUND
    $(document).ready(function() {
      var max_fields = 10;
      var wrapper = $('.jsep-addmore-edu-p');
      var add_button = $('.jsep-addmore-edu');
      var x = 1;
      $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
          x++;

          $(wrapper).append('<div class="jsep-addmore-edu-p"><label class="jsep-label"><img src="icons/Degree_B.svg"><input name="jsep-degree" type="text" class="jsep-input" placeholder="Degree"></label><label class="jsep-label"><img src="icons/Institute_B.svg"><input name="jsep-institute" type="text" class="jsep-input" placeholder="Institute"></label><label class="jsep-label"><img src="icons/Calendar_B.svg"><input name="jsep-period" type="text" class="jsep-input" placeholder="Period (xxxx - xxxx)"></label><label class="jsep-label"><img src="icons/GPA_B.svg"><input name="jsep-gpa" type="text" class="jsep-input" placeholder="GPA (x.xx)"></label><br><label class="jsep-remove-edu">- Remove&nbsp;</label><br><br><br></div>')

        }
      });

      $(wrapper).on('click', '.jsep-remove-edu', function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
      });

    });

    // SKILLS
    $(document).ready(function() {
      var wrapper = $('.jsep-addmore-skills-p');
      var add_button = $('.jsep-addmore-skills');
      var x = 1;
      $(add_button).click(function(e) {
        e.preventDefault();

        $(wrapper).append('<div class="jsep-addmore-skills-p"><div class="jsep-skill"><input name="jsep-skill" type="text" class="jsep-input" placeholder="Skills"></div><label class="jsep-remove-skills">- Remove&nbsp;</label><br></div>')

      });

      $(wrapper).on('click', '.jsep-remove-skills', function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
      });

    });

    // WORKING EXPERIENCE
    $(document).ready(function() {
      var max_fields = 10;
      var wrapper = $('.jsep-addmore-wexp-p');
      var add_button = $('.jsep-addmore-wexp');
      var x = 1;
      $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
          x++;

          $(wrapper).append('<div class="jsep-addmore-wexp-p"><div class="jsep-addmore-wexp-np"><div class="jsep-addmore-wexp-npcol"><input name="jsep-companyname" type="text" class="jsep-input-np" placeholder="Company name"></div><div class="jsep-addmore-wexp-npcol"><input name="jsep-wperiod" type="text" class="jsep-input-np" placeholder="Working period"></div></div><div><input name="jsep-wposition" type="text" class="jsep-input-wea" placeholder="Position"></div><div><textarea name="jsep-wdesc" type="text" class="jsep-desc" placeholder="Description"></textarea></div><br><br><label class="jsep-remove-extraa">- Remove&nbsp;</label><br><br><br></div>')

        }
      });

      $(wrapper).on('click', '.jsep-remove-extraa', function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
      });

    });

    // EXTRACURRICULAR ACTIVITIES
    $(document).ready(function() {
      var max_fields = 10;
      var wrapper = $('.jsep-addmore-extraa-p');
      var add_button = $('.jsep-addmore-extraa');
      var x = 1;
      $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
          x++;

          $(wrapper).append('<div class="jsep-addmore-extraa-p"><div class="jsep-addmore-extraa-np"><div class="jsep-addmore-extraa-npcol"><input name="jsep-organisationname" type="text" class="jsep-input-np" placeholder="Organisation name"></div><div class="jsep-addmore-extraa-npcol"><input name="jsep-eaperiod" type="text" class="jsep-input-np" placeholder="Participation period"></div></div><div><input name="jsep-earole" type="text" class="jsep-input-wea" placeholder="Role"></div><div><textarea name="jsep-eadesc" type="text" class="jsep-desc" placeholder="Description"></textarea></div><br><br><label class="jsep-remove-extraa">- Remove&nbsp;</label><br><br><br></div>')

        }
      });

      $(wrapper).on('click', '.jsep-remove-extraa', function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
      });

    });
  </script>

</body>

</html>
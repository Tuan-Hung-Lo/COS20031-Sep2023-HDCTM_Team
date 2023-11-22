<?php
  session_start();

  // Include settings and database connection
  require_once("./settings.php");

  $UserAuthenticationID = $_SESSION['job_seeker_ID'];

  $job_seeker = $conn->query("SELECT * FROM s104181721_db.JobSeeker WHERE UserAuthenticationID = '$UserAuthenticationID';");
  $existingJobSeeker = $job_seeker->fetch_assoc();
  $JobSeekerID = $existingJobSeeker['JobSeekerID'];

  $education = $conn->query("SELECT * FROM s104181721_db.Education WHERE JobSeekerID = '$JobSeekerID';");
  $existingEducation = $education->fetch_assoc();

  $skill = $conn->query("SELECT * FROM s104181721_db.Skill WHERE JobSeekerID = '$JobSeekerID';");
  $existingSkill = $skill->fetch_assoc();

  $working_experience = $conn->query("SELECT * FROM s104181721_db.WorkingExperience WHERE JobSeekerID = '$JobSeekerID';");
  $existingWorkingExperience = $working_experience->fetch_assoc();

  $extracurriculum_activity = $conn->query("SELECT * FROM s104181721_db.ExtracurriculumActivity WHERE JobSeekerID = '$JobSeekerID';");
  $existingExtracurriculumActivity = $extracurriculum_activity->fetch_assoc();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    $sql1 = "UPDATE s104181721_db.JobSeeker 
      SET JSImage = '$JSImage', 
        FirstName = '$FirstName', 
        LastName = '$LastName', 
        ExperienceLevel = '$ExperienceLevel', 
        JSJobTitle = '$JSJobTitle', 
        Gender = '$Gender', 
        DOB = '$DOB', 
        Phone = '$Phone', 
        Address = '$Address' 
      WHERE UserAuthenticationID = '$UserAuthenticationID';";

    // Update or insert data into Education table
    $educationData = [
      'Degree' => $Degree,
      'Institution' => $Institution,
      'GraduationYear' => $GraduationYear,
      'GPA' => $GPA,
    ];

    // Update or insert data into Skill table
    $skillData = [
      'SkillName' => $SkillName,
    ];

    // Update or insert data into WorkingExperience table
    $workExperienceData = [
      'WCompanyName' => $WCompanyName,
      'WTimeRange' => $WTimeRange,
      'WJobRole' => $WJobRole,
      'WDescription' => $WDescription,
    ];

    // Update or insert data into ExtracurriculumActivity table
    $extracurricularData = [
      'OrganizationName' => $OrganizationName,
      'EATimeRange' => $EATimeRange,
      'EAJobRole' => $EAJobRole,
      'EADescription' => $EADescription,
    ];

    // Execute the query
    if ($conn->query($sql) === TRUE) {
      // Redirect to another page after form submission
      header("Location: jobseeker.php");
      exit();
    }
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

    <a href="pagenotfound.html"><img alt="Logo" src="images/Logo.png" class="logo"></a>

    <nav class="navbar">
      <a href="pagenotfound.html">Home</a>
      <a href="pagenotfound.html">About</a>
      <a href="courses.php">Courses</a>
      <a href="jobopportunities.php">Job Opportunities</a>
    </nav>

    <div class="icons">
      <ul>
        <?php if ($existingJobSeeker) { ?>
          <li><a href="jobseeker.php"><img src="<?php echo $existingJobSeeker['JSImage'] ?>"></a></li>
        <?php } ?>
        <li><a href="login.php"><img src="icons/Logout.svg"></a></li>
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

          <?php if ($existingJobSeeker) { ?>
            <img src="<?php echo $existingJobSeeker['JSImage']; ?>" alt="Upload profile picture link">

            <!-- INSERT PROFILE IMAGE LINK -->
            <label class="jsep-label">
              <img src="icons/Link_B.svg">
              <input name="jsep-profileimg-link" type="text" class="jsep-input" placeholder="Insert profile image link" value="<?php echo $existingJobSeeker['JSImage']; ?>">
            </label>

            <!-- FIRST NAME -->
            <label class="jsep-label">
              <img src="icons/Name_B.svg">
              <input name="jsep-first-name" type="text" class="jsep-input" placeholder="First Name" value="<?php echo $existingJobSeeker['FirstName']; ?>">
            </label>

            <!-- LAST NAME -->
            <label class="jsep-label">
              <img src="icons/Name_B.svg">
              <input name="jsep-last-name" type="text" class="jsep-input" placeholder="Last Name" value="<?php echo $existingJobSeeker['LastName']; ?>">
            </label>

            <!-- EXPERIENCE LEVEL -->
            <label class="jsep-label">
              <img src="icons/ExperienceLevel_B.svg">
              <input name="jsep-experience-level" type="text" class="jsep-input" placeholder="Experience level" value="<?php echo $existingJobSeeker['ExperienceLevel']; ?>">
            </label>

            <!-- JOB TITLE -->
            <label class="jsep-label">
              <img src="icons/JobTitle_B.svg">
              <input name="jsep-job-title" type="text" class="jsep-input" placeholder="Job title" value="<?php echo $existingJobSeeker['JSJobTitle']; ?>">
            </label>
            <br>

            <!-- PERSONAL INFORMATION -->
            <h3>Personal information</h3>

            <!-- GENDER -->
            <div class="gender">
              <br>
              <p>Gender:</p>

              <label><input type="radio" name="jsep-gender" value="Female" <?php echo ($existingJobSeeker['Gender'] == 'Female') ? 'checked' : ''; ?>>
                Female</label>
              <br>
              <label><input type="radio" name="jsep-gender" value="Male" <?php echo ($existingJobSeeker['Gender'] == 'Male') ? 'checked' : ''; ?>>
                Male</label>
              <br>
              <label><input type="radio" name="jsep-gender" value="Others" <?php echo ($existingJobSeeker['Gender'] == 'Others') ? 'checked' : ''; ?>>
                Others</label>
              <br>
              <label><input type="radio" name="jsep-gender" value="Prefernottosay" <?php echo ($existingJobSeeker['Gender'] == 'Prefernottosay') ? 'checked' : ''; ?>>
                Prefer not to say</label>
            </div>

            <!-- DOB -->
            <label class="jsep-label">
              <img src="icons/Calendar_B.svg">
              <input name="jsep-dob" type="text" class="jsep-input" placeholder="DOB (dd/mm/yyyy)" value="<?php echo $existingJobSeeker['DOB']; ?>">
            </label>

            <!-- PHONE NUMBER -->
            <label class="jsep-label">
              <img src="icons/Phone_B.svg">
              <input name="jsep-phone" type="text" class="jsep-input" placeholder="Phone number" value="<?php echo $existingJobSeeker['Phone']; ?>">
            </label>

            <!-- ADDRESS -->
            <label class="jsep-label">
              <img src="icons/Location_B.svg">
              <input name="jsep-address" type="text" class="jsep-input" placeholder="Address" value="<?php echo $existingJobSeeker['Address']; ?>">
            </label>
            <br>
          <?php } ?>

          <!-- EDUCATION BACKGROUND -->
          <h3>Education background</h3>

          <div class="jsep-addmore-edu-p">

            <?php if ($existingEducation) { ?>

              <label class="jsep-label">
                <img src="icons/Degree_B.svg">
                <input name="jsep-degree" type="text" class="jsep-input" placeholder="Degree" value="<?php echo $existingEducation['Degree']; ?>">
              </label>

              <label class="jsep-label">
                <img src="icons/Institute_B.svg">
                <input name="jsep-institute" type="text" class="jsep-input" placeholder="Institute" value="<?php echo $existingEducation['Institution']; ?>">
              </label>

              <label class="jsep-label">
                <img src="icons/Calendar_B.svg">
                <input name="jsep-period" type="text" class="jsep-input" placeholder="Period (xxxx - xxxx)" value="<?php echo $existingEducation['GraduationYear']; ?>">
              </label>

              <label class="jsep-label">
                <img src="icons/GPA_B.svg">
                <input name="jsep-gpa" type="text" class="jsep-input" placeholder="GPA (x.xx)" value="<?php echo $existingEducation['GPA']; ?>">
              </label>

            <?php } ?>

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
            <?php if ($existingSkill) { ?>

              <div class="jsep-skill">
                <input name="jsep-skill" type="text" class="jsep-input" placeholder="Skills" value="<?php echo $existingSkill['SkillName']; ?>">
              </div>

            <?php } ?>

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
            <?php if ($existingWorkingExperience) { ?>

              <div class="jsep-addmore-wexp-np">

                <div class="jsep-addmore-wexp-npcol">
                  <input name="jsep-companyname" type="text" class="jsep-input-np" placeholder="Company name" value="<?php echo $existingWorkingExperience['WCompanyName']; ?>">
                </div>

                <div class="jsep-addmore-wexp-npcol">
                  <input name="jsep-wperiod" type="text" class="jsep-input-np" placeholder="Working period" value="<?php echo $existingWorkingExperience['WTimeRange']; ?>">
                </div>

              </div>

              <div>
                <input name="jsep-wposition" type="text" class="jsep-input-wea" placeholder="Position" value="<?php echo $existingWorkingExperience['WJobRole']; ?>">
              </div>

              <div>
                <textarea name="jsep-wdesc" type="text" class="jsep-desc" placeholder="Description"><?php echo $existingWorkingExperience['WDescription']; ?></textarea>
              </div>

            <?php } ?>

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
            <?php if ($existingExtracurriculumActivity) { ?>

              <div class="jsep-addmore-extraa-np">

                <div class="jsep-addmore-extraa-npcol">
                  <input name="jsep-organisationname" type="text" class="jsep-input-np" placeholder="Organisation name" value="<?php echo $existingExtracurriculumActivity['OrganizationName']; ?>">
                </div>

                <div class="jsep-addmore-extraa-npcol">
                  <input name="jsep-eaperiod" type="text" class="jsep-input-np" placeholder="Participation period" value="<?php echo $existingExtracurriculumActivity['EATimeRange']; ?>">
                </div>

              </div>

              <div>
                <input name="jsep-earole" type="text" class="jsep-input-wea" placeholder="Role" value="<?php echo $existingExtracurriculumActivity['EAJobRole']; ?>">
              </div>

              <div>
                <textarea name="jsep-eadesc" type="text" class="jsep-desc" placeholder="Description"><?php echo $existingExtracurriculumActivity['EADescription']; ?></textarea>
              </div>

            <?php } ?>

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
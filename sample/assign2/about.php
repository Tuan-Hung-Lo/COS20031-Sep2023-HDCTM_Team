<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="Assignment 2 - COS10026 Computing Technology Inquiry Project">
  <meta name="author" content="Lo Tuan Hung, Luong Chi Duc, Ho Thanh An, Lai Gia Khanh">
  <link href="styles/style.css" rel="stylesheet">
  <link rel="icon" href="images/LOGO_ICON.png" type="image/x-icon">
  <title>About</title>
</head>

<body>
  <?php include 'includes/header.inc'; ?>



  <!--  Displaying the information of team members-->
  <h1 class="meet">Meet the team</h1>
  <div class="test">
    <div class="inner">
      <div class="inner1">
        <img src="images/an.jpg" alt="an">
      </div>
      <div class="innerText">
        <dl>
          <dt>Thanh An Ho</dt>
          <dd>Swinburne University of Technology - Vietnam campus</dd>
          <dd>Bachelor of Science - Computer Science </dd>
          <dd>Studentclass: 104177364</dd>
          <dd>104177364@student.swin.edu.au</dd>
        </dl>
      </div>
    </div>
  </div>
  <div class="test">
    <div class="inner">
      <div class="inner1">
        <img src="images/hung.png" alt="an">
      </div>
      <div class="innerText">
        <dl>
          <dt>Tuan Hung Lo</dt>
          <dd>Swinburne University of Technology - Vietnam campus</dd>
          <dd>Bachelor of Science - Computer Science </dd>
          <dd>Studentclass: 103842425</dd>
          <dd>103842425@student.swin.edu.au</dd>
        </dl>
      </div>
    </div>
  </div>
  <div class="test">
    <div class="inner">
      <div class="inner1">
        <img src="images/duc.jpg" alt="an">
      </div>
      <div class="innerText">
        <dl>
          <dt>Chi Duc Luong</dt>
          <dd>Swinburne University of Technology - Vietnam campus</dd>
          <dd>Bachelor of Science - Computer Science </dd>
          <dd>Studentclass: 104181721</dd>
          <dd>104181721@student.swin.edu.au</dd>
        </dl>
      </div>
    </div>
  </div>
  <div class="test">
    <div class="inner">
      <div class="inner1">
        <img src="images/khanh.jpg" alt="an">
      </div>
      <div class="innerText">
        <dl>
          <dt>Khanh Lai Gia </dt>
          <dd>Swinburne University of Technology - Vietnam campus</dd>
          <dd>Bachelor of Science - Computer Science </dd>
          <dd>StudentId: 104222015</dd>
          <dd>104222015@student.swin.edu.au</dd>
        </dl>
      </div>
    </div>
  </div>
  <h1 class="meet">Our timetable</h1>

  <!-- Student timetable -->
  <div class="about_tab">
    <table>
      <thead>
        <tr>
          <th>Time</th>
          <th>Monday</th>
          <th>Tuesday</th>
          <th>Wednesday</th>
          <th>Thursday</th>
          <th>Friday</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class="about_tab_moaf">Morning</th>
          <td colspan="2">none</td>
          <td>TNE10006 - Networks and Switching</td>
          <td>COS10026 - Computing technology inquiry project</td>
          <td>none</td>
        </tr>
        <tr>
          <th class="about_tab_moaf">Afternoon</th>
          <td colspan="3">none</td>
          <td>COS10022 - Introduction to Data Science</td>
          <td>COS10005 - Web development</td>
        </tr>
      </tbody>
    </table>
  </div>

  <?php include 'includes/footer.inc'; ?>
</body>

</html>
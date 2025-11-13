<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Portfolio</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- ===== NAVIGATION ===== -->
  <nav id="main-nav">
    <h2 id="nav-name">My Portfolio</h2>
  </nav>

  <!-- ===== PROFILE SECTION ===== -->
  <section id="profile-section" class="section">
    <div class="container">
      <img id="profile-image" src="assets/img/default.jpg" alt="Profile Picture" class="profile-pic">
      <h1 id="profile-name">Loading...</h1>
      <h3 id="profile-title"></h3>
      <p id="profile-bio"></p>
      <div class="contact-info">
        <p><strong>Email:</strong> <span id="profile-email"></span></p>
        <p><strong>Phone:</strong> <span id="profile-phone"></span></p>
      </div>
    </div>
  </section>

  <!-- ===== SKILLS, PROJECTS, ETC. WILL GO HERE LATER ===== -->
  <section id="skills-section" class="section">
    <h2>My Skills</h2>
    <ul id="skills-list"></ul>
  </section>

  <section id="projects-section" class="section">
    <h2>Projects</h2>
    <div id="projects-container"></div>
  </section>


  <!-- ===== FOOTER ===== -->
  <footer>
    <p>© 2025 My Portfolio. All rights reserved.</p>
  </footer>

  <!-- JS -->
  <script type="module" src="js/main.js"></script>
</body>
</html>

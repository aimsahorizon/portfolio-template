<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Portfolio</title>
  <!-- Tailwind CDN for quick styling (black & white modern design) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="min-h-screen bg-white text-black antialiased font-sans">
    <!-- NAV -->
    <header class="bg-black text-white">
      <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
        <h1 class="text-xl font-semibold tracking-tight">My Portfolio</h1>
        <nav class="space-x-4 text-sm opacity-80">
          <a href="#profile-section" class="hover:underline">Profile</a>
          <a href="#skills-section" class="hover:underline">Skills</a>
          <a href="#projects-section" class="hover:underline">Projects</a>
        </nav>
      </div>
    </header>

    <main class="max-w-5xl mx-auto px-6 py-12">
      <!-- PROFILE -->
      <section id="profile-section" class="mb-12">
        <div class="flex flex-col md:flex-row items-center gap-8">
          <img id="profile-image" src="assets/img/default.jpg" alt="Profile Picture" class="w-36 h-36 md:w-48 md:h-48 rounded-full object-cover border-2 border-black">
          <div>
            <h2 id="profile-name" class="text-3xl md:text-4xl font-extrabold uppercase tracking-tight">Loading...</h2>
            <p id="profile-title" class="text-lg text-gray-700 mt-1"></p>
            <p id="profile-bio" class="mt-4 text-gray-800 max-w-2xl"></p>

            <div class="mt-6 flex flex-col sm:flex-row sm:space-x-6 text-sm text-gray-600">
              <div><span class="font-medium text-gray-900">Email:</span> <span id="profile-email"></span></div>
              <div><span class="font-medium text-gray-900">Phone:</span> <span id="profile-phone"></span></div>
            </div>
          </div>
        </div>
      </section>

      <!-- SKILLS -->
      <section id="skills-section" class="mb-12">
        <h3 class="text-2xl font-bold mb-4">Skills</h3>
        <ul id="skills-list" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3"></ul>
      </section>

      <!-- PROJECTS -->
      <section id="projects-section">
        <h3 class="text-2xl font-bold mb-4">Projects</h3>
        <div id="projects-container" class="grid grid-cols-1 md:grid-cols-2 gap-6"></div>
      </section>
    </main>

    <footer class="border-t border-gray-200 mt-12">
      <div class="max-w-5xl mx-auto px-6 py-6 text-sm text-gray-600">© 2025 My Portfolio. All rights reserved.</div>
    </footer>
  </div>


  <!-- ===== FOOTER ===== -->
  <footer>
    <p>© 2025 My Portfolio. All rights reserved.</p>
  </footer>

  <!-- JS -->
  <script type="module" src="js/main.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    .tab-btn {
      @apply px-4 py-2 rounded font-medium text-gray-700 bg-gray-100 border border-gray-300 hover:bg-gray-200 transition cursor-pointer;
    }
    .tab-btn.active {
      @apply bg-black text-white border-black hover:bg-gray-900;
    }
  </style>
</head>
<body>
  <div class="min-h-screen bg-white text-black">
    <header class="bg-black text-white">
      <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
        <h1 class="text-lg font-semibold">Admin Dashboard</h1>
        <a href="../" class="text-sm text-gray-300 hover:text-white">← Back to Portfolio</a>
      </div>
    </header>

    <main class="max-w-6xl mx-auto px-6 py-10">
      <!-- Tab Navigation -->
      <div class="flex gap-3 mb-8 border-b border-gray-200 pb-4">
        <button class="tab-btn active" data-tab="profile">Edit Profile</button>
        <button class="tab-btn" data-tab="skills">Manage Skills</button>
        <button class="tab-btn" data-tab="projects">Manage Projects</button>
      </div>

      <!-- ====== PROFILE TAB ====== -->
      <section id="profile" class="tab-content active">
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 max-w-3xl">
          <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

          <form id="profileForm" class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Full Name</label>
              <input class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" type="text" id="full_name" required>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Title / Position</label>
              <input class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" type="text" id="title" required>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" type="email" id="email" required>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" type="text" id="phone">
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Bio</label>
              <textarea class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" id="bio" rows="4"></textarea>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Profile Image URL</label>
              <input class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" type="text" id="profile_image" placeholder="e.g. assets/img/me.jpg">
            </div>

            <div class="flex gap-3 mt-4">
              <button type="submit" class="px-4 py-2 bg-black text-white rounded">💾 Save Changes</button>
              <button type="button" id="btnProfileReset" class="px-4 py-2 border border-gray-200 rounded">↺ Reset</button>
            </div>
          </form>

          <div id="profileMsgBox" class="mt-4 text-sm text-gray-600"></div>
        </div>
      </section>

      <!-- ====== SKILLS TAB ====== -->
      <section id="skills" class="tab-content">
        <div class="grid lg:grid-cols-3 gap-6">
          <div class="lg:col-span-1 bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Add / Edit Skill</h2>

            <form id="skillForm" class="space-y-4">
              <input type="hidden" id="skill_id">

              <div>
                <label class="block text-sm font-medium text-gray-700">Skill Name</label>
                <input class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" type="text" id="skill_name" required>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Proficiency Level</label>
                <input class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" type="text" id="proficiency_level" placeholder="e.g. Expert, Intermediate" required>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <input class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" type="text" id="category" value="Technical">
              </div>

              <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-black text-white rounded flex-1">💾 Save Skill</button>
                <button type="button" id="btnSkillReset" class="px-4 py-2 border border-gray-200 rounded">✕ Clear</button>
              </div>
            </form>
            <div id="skillMsgBox" class="mt-4 text-sm text-gray-600"></div>
          </div>

          <div class="lg:col-span-2">
            <h3 class="text-2xl font-bold mb-4">Existing Skills</h3>
            <div class="overflow-x-auto bg-white border border-gray-200 rounded">
              <table id="skillsTable" class="min-w-full text-left text-sm text-gray-700">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Level</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Actions</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

      <!-- ====== PROJECTS TAB ====== -->
      <section id="projects" class="tab-content">
        <div class="grid lg:grid-cols-3 gap-6">
          <div class="lg:col-span-1 bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Add / Edit Project</h2>

            <form id="projectForm" class="space-y-4">
              <input type="hidden" id="project_id">
              <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" type="text" id="title" required>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" id="description" rows="3" required></textarea>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Link</label>
                <input class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" type="url" id="link">
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Tech Stack</label>
                <input class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" type="text" id="tech_stack">
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Project Date</label>
                <input class="mt-1 block w-full border border-gray-200 rounded px-3 py-2" type="date" id="project_date">
              </div>

              <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-black text-white rounded flex-1">💾 Save Project</button>
                <button type="button" id="btnProjectReset" class="px-4 py-2 border border-gray-200 rounded">✕ Clear</button>
              </div>
            </form>
            <div id="projectMsgBox" class="mt-4 text-sm text-gray-600"></div>
          </div>

          <div class="lg:col-span-2">
            <h3 class="text-2xl font-bold mb-4">Existing Projects</h3>
            <div class="overflow-x-auto bg-white border border-gray-200 rounded">
              <table id="projectsTable" class="min-w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-700">
                  <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Tech Stack</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Actions</th>
                  </tr>
                </thead>
                <tbody class="text-gray-700"></tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>

  <script type="module" src="js/admin.js"></script>
</body>
</html>

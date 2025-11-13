import { getProfile, updateProfile } from "../../js/api/profile.js";
import { getSkills, addSkill, updateSkill, deleteSkill } from "../../js/api/skills.js";
import { getProjects, addProject, updateProject, deleteProject } from "../../js/api/projects.js";

let currentProfile = null;

document.addEventListener("DOMContentLoaded", async () => {
  // ====== TAB SWITCHING ======
  document.querySelectorAll(".tab-btn").forEach(btn => {
    btn.addEventListener("click", (e) => {
      const tabName = e.target.dataset.tab;
      switchTab(tabName);
    });
  });

  // ====== LOAD INITIAL DATA ======
  await loadProfile();
  await loadSkills();
  await loadProjects();

  // ====== PROFILE FORM ======
  document.getElementById("profileForm").addEventListener("submit", async (e) => {
    e.preventDefault();
    const updatedData = {
      id: currentProfile?.id,
      full_name: document.getElementById("full_name").value,
      title: document.getElementById("title").value,
      email: document.getElementById("email").value,
      phone: document.getElementById("phone").value,
      bio: document.getElementById("bio").value,
      profile_image: document.getElementById("profile_image").value
    };

    const res = await updateProfile(updatedData);
    const msgBox = document.getElementById("profileMsgBox");
    msgBox.textContent = res.message || "Profile updated successfully!";
    msgBox.style.color = res.status === "success" ? "green" : "red";
    if (res.status === "success") await loadProfile();
  });

  document.getElementById("btnProfileReset").addEventListener("click", () => fillProfileForm(currentProfile));

  // ====== SKILL FORM ======
  document.getElementById("skillForm").addEventListener("submit", async (e) => {
    e.preventDefault();
    const skillId = document.getElementById("skill_id").value;
    const skillData = {
      skill_name: document.getElementById("skill_name").value,
      proficiency_level: document.getElementById("proficiency_level").value,
      category: document.getElementById("category").value
    };

    let res;
    if (skillId) {
      res = await updateSkill({ ...skillData, id: skillId });
    } else {
      res = await addSkill(skillData);
    }

    const msgBox = document.getElementById("skillMsgBox");
    msgBox.textContent = res.message || "Skill saved successfully!";
    msgBox.style.color = res.status === "success" ? "green" : "red";

    if (res.status === "success") {
      resetSkillForm();
      await loadSkills();
    }
  });

  document.getElementById("btnSkillReset").addEventListener("click", resetSkillForm);

  // ====== PROJECT FORM ======
  document.getElementById("projectForm").addEventListener("submit", async (e) => {
    e.preventDefault();
    const projectId = document.getElementById("project_id").value;
    const projectData = {
      title: document.getElementById("title").value,
      description: document.getElementById("description").value,
      link: document.getElementById("link").value,
      tech_stack: document.getElementById("tech_stack").value,
      project_date: document.getElementById("project_date").value
    };

    let res;
    if (projectId) {
      res = await updateProject({ ...projectData, id: projectId });
    } else {
      res = await addProject(projectData);
    }

    const msgBox = document.getElementById("projectMsgBox");
    msgBox.textContent = res.message || "Project saved successfully!";
    msgBox.style.color = res.status === "success" ? "green" : "red";

    if (res.status === "success") {
      resetProjectForm();
      await loadProjects();
    }
  });

  document.getElementById("btnProjectReset").addEventListener("click", resetProjectForm);
});

// ====== TAB SWITCHING FUNCTION ======
function switchTab(tabName) {
  document.querySelectorAll(".tab-content").forEach(el => el.classList.remove("active"));
  document.querySelectorAll(".tab-btn").forEach(el => el.classList.remove("active"));
  document.getElementById(tabName).classList.add("active");
  document.querySelector(`[data-tab="${tabName}"]`).classList.add("active");
}

// ====== PROFILE FUNCTIONS ======
async function loadProfile() {
  const profile = await getProfile(1);
  if (profile) {
    currentProfile = profile;
    fillProfileForm(profile);
  }
}

function fillProfileForm(p) {
  if (!p) return;
  document.getElementById("full_name").value = p.full_name || "";
  document.getElementById("title").value = p.title || "";
  document.getElementById("email").value = p.email || "";
  document.getElementById("phone").value = p.phone || "";
  document.getElementById("bio").value = p.bio || "";
  document.getElementById("profile_image").value = p.profile_image || "";
}

// ====== SKILL FUNCTIONS ======
async function loadSkills() {
  const skills = await getSkills();
  const tbody = document.querySelector("#skillsTable tbody");
  tbody.innerHTML = "";

  if (skills && skills.length > 0) {
    skills.forEach(skill => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td class="px-4 py-3">${skill.id}</td>
        <td class="px-4 py-3">${skill.skill_name}</td>
        <td class="px-4 py-3">${skill.proficiency_level}</td>
        <td class="px-4 py-3">${skill.category}</td>
        <td class="px-4 py-3 space-x-2">
          <button class="text-blue-600 hover:underline edit-skill" data-id="${skill.id}">Edit</button>
          <button class="text-red-600 hover:underline delete-skill" data-id="${skill.id}">Delete</button>
        </td>
      `;
      tbody.appendChild(row);
    });

    // Edit and Delete listeners
    document.querySelectorAll(".edit-skill").forEach(btn => {
      btn.addEventListener("click", async (e) => {
        const skillId = e.target.dataset.id;
        const skill = skills.find(s => s.id == skillId);
        if (skill) {
          document.getElementById("skill_id").value = skill.id;
          document.getElementById("skill_name").value = skill.skill_name;
          document.getElementById("proficiency_level").value = skill.proficiency_level;
          document.getElementById("category").value = skill.category;
        }
      });
    });

    document.querySelectorAll(".delete-skill").forEach(btn => {
      btn.addEventListener("click", async (e) => {
        const skillId = e.target.dataset.id;
        if (confirm("Delete this skill?")) {
          await deleteSkill(skillId);
          await loadSkills();
        }
      });
    });
  }
}

function resetSkillForm() {
  document.getElementById("skill_id").value = "";
  document.getElementById("skill_name").value = "";
  document.getElementById("proficiency_level").value = "";
  document.getElementById("category").value = "Technical";
  document.getElementById("skillMsgBox").textContent = "";
}

// ====== PROJECT FUNCTIONS ======
async function loadProjects() {
  const projects = await getProjects();
  const tbody = document.querySelector("#projectsTable tbody");
  tbody.innerHTML = "";

  if (projects && projects.length > 0) {
    projects.forEach(project => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td class="px-4 py-3">${project.id}</td>
        <td class="px-4 py-3">${project.title}</td>
        <td class="px-4 py-3">${project.tech_stack}</td>
        <td class="px-4 py-3">${project.project_date}</td>
        <td class="px-4 py-3 space-x-2">
          <button class="text-blue-600 hover:underline edit-project" data-id="${project.id}">Edit</button>
          <button class="text-red-600 hover:underline delete-project" data-id="${project.id}">Delete</button>
        </td>
      `;
      tbody.appendChild(row);
    });

    // Edit and Delete listeners
    document.querySelectorAll(".edit-project").forEach(btn => {
      btn.addEventListener("click", async (e) => {
        const projectId = e.target.dataset.id;
        const project = projects.find(p => p.id == projectId);
        if (project) {
          document.getElementById("project_id").value = project.id;
          document.getElementById("title").value = project.title;
          document.getElementById("description").value = project.description;
          document.getElementById("link").value = project.link;
          document.getElementById("tech_stack").value = project.tech_stack;
          document.getElementById("project_date").value = project.project_date;
        }
      });
    });

    document.querySelectorAll(".delete-project").forEach(btn => {
      btn.addEventListener("click", async (e) => {
        const projectId = e.target.dataset.id;
        if (confirm("Delete this project?")) {
          await deleteProject(projectId);
          await loadProjects();
        }
      });
    });
  }
}

function resetProjectForm() {
  document.getElementById("project_id").value = "";
  document.getElementById("title").value = "";
  document.getElementById("description").value = "";
  document.getElementById("link").value = "";
  document.getElementById("tech_stack").value = "";
  document.getElementById("project_date").value = "";
  document.getElementById("projectMsgBox").textContent = "";
}

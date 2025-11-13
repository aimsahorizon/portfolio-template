import { getProfile } from "./api/profile.js";
import { getSkills } from "./api/skills.js";
import { getProjects } from "./api/projects.js";

document.addEventListener("DOMContentLoaded", async () => {
  // --- PROFILE ---
  const profile = await getProfile(1);
  if (profile) {
    document.getElementById("profile-image").src = profile.profile_image;
    document.getElementById("profile-name").textContent = profile.full_name;
    document.getElementById("profile-title").textContent = profile.title;
    document.getElementById("profile-bio").textContent = profile.bio;
    document.getElementById("profile-email").textContent = profile.email;
    document.getElementById("profile-phone").textContent = profile.phone;
    document.getElementById("nav-name").textContent = profile.full_name;
  }

  // --- SKILLS ---
  const skills = await getSkills();
  const skillsList = document.getElementById("skills-list");
  if (skillsList && skills.length > 0) {
    skillsList.innerHTML = skills
      .map(s => `<li>${s.skill_name} - <em>${s.proficiency_level}</em></li>`)
      .join("");
  }

  // --- Projects ---
  const projects = await getProjects();
  const container = document.getElementById("projects-container");
  if (container && projects.length > 0) {
    container.innerHTML = projects.map(p => `
      <div class="project-card">
        <h3>${p.title}</h3>
        <p>${p.description}</p>
        <small>${p.tech_stack}</small><br>
        <a href="${p.link}" target="_blank">View Project</a>
      </div>
    `).join("");
  }
});

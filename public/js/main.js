import { getProfile } from "./api/profile.js";
import { getSkills } from "./api/skills.js";
import { getProjects } from "./api/projects.js";

document.addEventListener("DOMContentLoaded", async () => {
  // --- PROFILE ---
  try {
    const profile = await getProfile(1);
    console.debug("profile loaded:", profile);
    if (profile) {
      const imgEl = document.getElementById("profile-image");
      const nameEl = document.getElementById("profile-name");
      const titleEl = document.getElementById("profile-title");
      const bioEl = document.getElementById("profile-bio");
      const emailEl = document.getElementById("profile-email");
      const phoneEl = document.getElementById("profile-phone");
      const navNameEl = document.getElementById("nav-name");

      if (imgEl && profile.profile_image) imgEl.src = profile.profile_image;
      if (nameEl && profile.full_name) nameEl.textContent = profile.full_name;
      if (titleEl && profile.title) titleEl.textContent = profile.title;
      if (bioEl && profile.bio) bioEl.textContent = profile.bio;
      if (emailEl && profile.email) emailEl.textContent = profile.email;
      if (phoneEl && profile.phone) phoneEl.textContent = profile.phone;
      if (navNameEl && profile.full_name) navNameEl.textContent = profile.full_name;
    }
  } catch (err) {
    console.error("Error populating profile UI:", err);
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

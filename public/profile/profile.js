import { getProfile } from "../js/api/profile.js";

document.addEventListener("DOMContentLoaded", async () => {
  const profile = await getProfile(1);
  if (profile) renderProfile(profile);
});

function renderProfile(profile) {
  document.getElementById("profile-name").textContent = profile.full_name;
  document.getElementById("profile-title").textContent = profile.title;
  document.getElementById("profile-bio").textContent = profile.bio;
  document.getElementById("profile-email").textContent = profile.email;
  document.getElementById("profile-phone").textContent = profile.phone;
  document.getElementById("profile-image").src = profile.profile_image || "assets/img/default.jpg";
}

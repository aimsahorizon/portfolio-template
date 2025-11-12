import { getProfile } from "./api/profile.js";

document.addEventListener("DOMContentLoaded", async () => {
  const profile = await getProfile(1); // fetch from API
  if (profile) {
    document.getElementById("profile-image").src = profile.profile_image;
    document.getElementById("profile-name").textContent = profile.full_name;
    document.getElementById("profile-title").textContent = profile.title;
    document.getElementById("profile-bio").textContent = profile.bio;
    document.getElementById("profile-email").textContent = profile.email;
    document.getElementById("profile-phone").textContent = profile.phone;

    // Update nav name dynamically
    document.getElementById("nav-name").textContent = profile.full_name;
  }
});

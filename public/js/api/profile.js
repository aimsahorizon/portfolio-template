const API_URL = "/api/profile_api.php";

// 🔹 Get all profiles
export async function getProfiles() {
  const res = await fetch(API_URL);
  const data = await res.json();
  return data.data;
}

// 🔹 Get single profile
export async function getProfile(id = 1) {
  const res = await fetch(`${API_URL}?id=${id}`);
  const data = await res.json();
  return data.data;
}

// 🔹 Add new profile
export async function addProfile(profileData) {
  const res = await fetch(API_URL, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(profileData)
  });
  return await res.json();
}

// 🔹 Update profile
export async function updateProfile(id, profileData) {
  const res = await fetch(`${API_URL}?id=${id}`, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(profileData)
  });
  return await res.json();
}

// 🔹 Delete profile
export async function deleteProfile(id) {
  const res = await fetch(`${API_URL}?id=${id}`, {
    method: "DELETE"
  });
  return await res.json();
}

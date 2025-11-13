const API_PROFILE = "http://localhost/myportfolio/api/profile_api.php";

/* ============================
   🔹 GET ALL PROFILES
   ============================ */
export async function getProfiles() {
  try {
    const res = await fetch(API_PROFILE);
    const data = await res.json();
    // backend returns { status: ..., data: [...] }
    return data.data || [];
  } catch (err) {
    console.error("Error fetching profiles:", err);
    return [];
  }
}

/* ============================
   🔹 GET SINGLE PROFILE
   ============================ */
export async function getProfile(id = 1) {
  try {
    const res = await fetch(`${API_PROFILE}?id=${id}`);
    const data = await res.json();
    // backend returns { status: ..., data: { ... } }
    console.debug("getProfile response:", data);
    return data.data || null;
  } catch (err) {
    console.error("Error fetching profile:", err);
    return null;
  }
}

/* ============================
   🔹 ADD PROFILE (DISABLED)
   ============================ */
export async function addProfile(profileData) {
  console.warn('addProfile is disabled in single-profile mode');
  return { status: 'error', message: 'Add profile not allowed' };
}

/* ============================
   🔹 UPDATE PROFILE
   ============================ */
export async function updateProfile(profileData) {
  try {
    const res = await fetch(API_PROFILE, {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(profileData)
    });
    return await res.json();
  } catch (err) {
    console.error("Error updating profile:", err);
    return { status: "error", message: "Failed to update profile" };
  }
}

/* ============================
   🔹 DELETE PROFILE (DISABLED)
   ============================ */
export async function deleteProfile(id) {
  console.warn('deleteProfile is disabled in single-profile mode');
  return { status: 'error', message: 'Delete profile not allowed' };
}

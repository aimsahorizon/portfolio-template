const API_SKILLS = "/api/skills_api.php";

export async function getSkills() {
  const res = await fetch(API_SKILLS);
  const data = await res.json();
  return data.skills || [];
}

export async function addSkill(skillData) {
  const res = await fetch(API_SKILLS, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(skillData)
  });
  return res.json();
}

export async function updateSkill(skillData) {
  const res = await fetch(API_SKILLS, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(skillData)
  });
  return res.json();
}

export async function deleteSkill(id) {
  const res = await fetch(`${API_SKILLS}?id=${id}`, { method: "DELETE" });
  return res.json();
}

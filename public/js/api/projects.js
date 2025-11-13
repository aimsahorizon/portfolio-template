// const API_PROJECTS = "/api/projects_api.php";
const API_PROJECTS = "http://localhost/myportfolio/api/projects_api.php";

export async function getProjects() {
  const res = await fetch(API_PROJECTS);
  const data = await res.json();
  return data.projects || [];
}

export async function addProject(projectData) {
  const res = await fetch(API_PROJECTS, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(projectData)
  });
  return res.json();
}

export async function updateProject(projectData) {
  const res = await fetch(API_PROJECTS, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(projectData)
  });
  return res.json();
}

export async function deleteProject(id) {
  const res = await fetch(`${API_PROJECTS}?id=${id}`, { method: "DELETE" });
  return res.json();
}

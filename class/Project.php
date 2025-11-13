<?php
class Project {
  private $conn;
  private $table = "projects";

  public function __construct($db) {
    $this->conn = $db;
  }

  // Get all projects with their age in days using subquery
  public function getAllProjects() {
    $query = "SELECT p.*,
                     DATEDIFF(CURDATE(), p.project_date) as days_since_project
              FROM {$this->table} p
              WHERE p.project_date = (SELECT MAX(project_date) FROM {$this->table} WHERE project_date <= CURDATE())
              OR p.project_date > CURDATE()
              ORDER BY p.project_date DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get project by ID with position ranking
  public function getProjectById($id) {
    $query = "SELECT p.*,
                     (SELECT COUNT(*) + 1 FROM {$this->table} WHERE project_date > p.project_date) as project_rank
              FROM {$this->table} p
              WHERE p.id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Get recent projects (last 6 months) using subquery with date range
  public function getRecentProjects($months = 6) {
    $query = "SELECT * FROM {$this->table} 
              WHERE project_date IN (
                SELECT project_date FROM {$this->table} 
                WHERE project_date >= DATE_SUB(CURDATE(), INTERVAL :months MONTH)
                ORDER BY project_date DESC
              )
              ORDER BY project_date DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':months', $months, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get projects by technology (tech_stack contains specific tech)
  public function getProjectsByTech($tech) {
    $query = "SELECT * FROM {$this->table} 
              WHERE id IN (
                SELECT id FROM {$this->table} WHERE tech_stack LIKE CONCAT('%', :tech, '%')
              )
              ORDER BY project_date DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':tech', $tech);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addProject($title, $description, $link, $tech_stack, $project_date) {
    $query = "INSERT INTO {$this->table} (title, description, link, tech_stack, project_date)
              VALUES (:title, :description, :link, :tech_stack, :project_date)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':link', $link);
    $stmt->bindParam(':tech_stack', $tech_stack);
    $stmt->bindParam(':project_date', $project_date);
    return $stmt->execute();
  }

  public function updateProject($id, $title, $description, $link, $tech_stack, $project_date) {
    $query = "UPDATE {$this->table}
              SET title = :title, description = :description, link = :link,
                  tech_stack = :tech_stack, project_date = :project_date
              WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':link', $link);
    $stmt->bindParam(':tech_stack', $tech_stack);
    $stmt->bindParam(':project_date', $project_date);
    return $stmt->execute();
  }

  public function deleteProject($id) {
    $query = "DELETE FROM {$this->table} WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }
}
?>

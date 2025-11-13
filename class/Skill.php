<?php
class Skill {
  private $conn;
  private $table = "skills";

  public function __construct($db) {
    $this->conn = $db;
  }

  // Get all skills with rank based on proficiency using subquery
  public function getAllSkills() {
    $query = "SELECT s.*, 
                     (SELECT COUNT(*) FROM " . $this->table . " WHERE category = s.category) as skills_in_category
              FROM {$this->table} s 
              ORDER BY s.category, s.skill_name";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get skill by ID with category rank
  public function getSkillById($id) {
    $query = "SELECT s.*, 
                     (SELECT COUNT(*) FROM " . $this->table . " WHERE category = s.category) as skills_in_category
              FROM {$this->table} s 
              WHERE s.id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Get skills by category using subquery
  public function getSkillsByCategory($category) {
    $query = "SELECT * FROM {$this->table} 
              WHERE category = (SELECT DISTINCT category FROM {$this->table} WHERE category = :category)
              ORDER BY skill_name";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get top skills (can be extended with complex filtering)
  public function getTopSkills($limit = 5) {
    $query = "SELECT * FROM {$this->table} 
              WHERE id IN (SELECT id FROM {$this->table} ORDER BY skill_name LIMIT :limit)
              ORDER BY skill_name";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addSkill($name, $level, $category) {
    $query = "INSERT INTO {$this->table} (skill_name, proficiency_level, category)
              VALUES (:name, :level, :category)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':level', $level);
    $stmt->bindParam(':category', $category);
    return $stmt->execute();
  }

  public function updateSkill($id, $name, $level, $category) {
    $query = "UPDATE {$this->table}
              SET skill_name = :name, proficiency_level = :level, category = :category
              WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':level', $level);
    $stmt->bindParam(':category', $category);
    return $stmt->execute();
  }

  public function deleteSkill($id) {
    $query = "DELETE FROM {$this->table} WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }
}
?>

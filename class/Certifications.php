<?php
include_once 'BaseModel.php';

class Certification extends BaseModel {
    public function __construct($db) {
        parent::__construct($db, 'certifications');
    }

    // Optional: Get certifications by year
    public function getByYear($year) {
        $query = "SELECT * FROM {$this->table} WHERE YEAR(date_obtained) = :year ORDER BY date_obtained DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":year", $year, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

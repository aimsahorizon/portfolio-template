<?php
class Profile {
    private $conn;
    private $table = "profile";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get the single profile row (treat the table as a single-profile store)
    public function getProfile() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update the single profile. If $data contains an 'id' it will be used,
    // otherwise the most recent row's id will be used.
    public function updateProfile($data) {
        // Determine target id
        $id = isset($data['id']) ? $data['id'] : null;
        if (!$id) {
            $current = $this->getProfile();
            if (!$current || !isset($current['id'])) return false;
            $id = $current['id'];
        }

        $query = "UPDATE " . $this->table . "
                  SET full_name=:full_name, title=:title, bio=:bio, email=:email, phone=:phone, profile_image=:profile_image
                  WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $full_name = isset($data['full_name']) ? $data['full_name'] : null;
        $title = isset($data['title']) ? $data['title'] : null;
        $bio = isset($data['bio']) ? $data['bio'] : null;
        $email = isset($data['email']) ? $data['email'] : null;
        $phone = isset($data['phone']) ? $data['phone'] : null;
        $profile_image = isset($data['profile_image']) ? $data['profile_image'] : null;

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":bio", $bio);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":profile_image", $profile_image);

        return $stmt->execute();
    }
}
?>

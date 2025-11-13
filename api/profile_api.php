<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, PUT");
header("Access-Control-Allow-Headers: Content-Type");

include 'database.php';
include '../class/Profile.php';

$database = new Database();
$db = $database->getConnection();
$profile = new Profile($db);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Always return the single profile row
        $data = $profile->getProfile();
        echo json_encode(["status" => "success", "data" => $data]);
        break;

    case 'PUT':
        // Accept update payload in request body. If it includes 'id' it will be used,
        // otherwise the stored single row will be updated.
        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input || !is_array($input)) {
            echo json_encode(["status" => "error", "message" => "Invalid input"]);
            break;
        }

        if ($profile->updateProfile($input)) {
            echo json_encode(["status" => "success", "message" => "Profile updated"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Update failed"]);
        }
        break;

    // Disallow POST/DELETE for profiles in single-profile setup
    case 'POST':
    case 'DELETE':
        echo json_encode(["status" => "error", "message" => "Operation not allowed"]);
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>

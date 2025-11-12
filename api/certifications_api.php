<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include 'Database.php';
include '../class/Certification.php';

$database = new Database();
$db = $database->getConnection();
$cert = new Certification($db);

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        if(isset($_GET['id'])) {
            $data = $cert->getById($_GET['id']);
            echo json_encode($data ? ["status"=>"success","data"=>$data] : ["status"=>"error","message"=>"Not found"]);
        } elseif(isset($_GET['search'])) {
            $data = $cert->search($_GET['search'], ['title','institution']);
            echo json_encode(["status"=>"success","results"=>$data]);
        } else {
            $data = $cert->getAll("date_obtained DESC");
            echo json_encode(["status"=>"success","results"=>$data]);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if(!empty($data['title']) && !empty($data['institution']) && !empty($data['date_obtained'])) {
            $res = $cert->create($data);
            echo json_encode($res ? ["status"=>"success","data"=>$res] : ["status"=>"error","message"=>"Insert failed"]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        if(!empty($data['id'])) {
            $id = $data['id']; unset($data['id']);
            $res = $cert->update($id, $data);
            echo json_encode($res ? ["status"=>"success","data"=>$res] : ["status"=>"error","message"=>"Update failed"]);
        }
        break;

    case 'DELETE':
        if(isset($_GET['id'])) {
            $res = $cert->delete($_GET['id']);
            echo json_encode($res ? ["status"=>"success","data"=>$res] : ["status"=>"error","message"=>"Delete failed"]);
        }
        break;

    default:
        echo json_encode(["status"=>"error","message"=>"Invalid request method"]);
}
?>

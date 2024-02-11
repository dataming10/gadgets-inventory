<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once "../Model/ComputerPart.php";
include_once "../Model/DatabaseConnection.php";

// Define the generateRedirectUrl function
function generateRedirectUrl($page)
{
    return "../View/$page";
}

$dbConnection = new DatabaseConnection("localhost", "root", "", "inventory");
$dbConnection->connect();
$computerPart = new ComputerPart($dbConnection->getConnection());

$action = isset($_POST['action']) ? $_POST['action'] : "";
$action = isset($_GET['action']) ? $_GET['action'] : "";

switch ($action) {
    case 'deactivate':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['id'])) {
                $partId = $_GET['id'];
                $deactivationResult = $computerPart->deactivatePart($partId);

                if ($deactivationResult) {
                    $redirectUrl = generateRedirectUrl('deactivated_items.php');
                    header("Location: $redirectUrl");
                    exit;
                } else {
                    echo "Error: Failed to deactivate the part with ID $partId.";
                }
            } else {
                echo "Error: Missing part ID.";
            }
        } else {
            echo "Error: Invalid request method.";
        }
        break;

    case 'reactivate':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['id'])) {
                $partId = $_GET['id'];
                $reactivationResult = $computerPart->reactivatePart($partId);

                if ($reactivationResult) {
                    $redirectUrl = generateRedirectUrl('list.php');
                    header("Location: $redirectUrl");
                    exit;
                } else {
                    echo "Error: Failed to reactivate the part with ID $partId.";
                }
            } else {
                echo "Error: Missing part ID.";
            }
        } else {
            echo "Error: Invalid request method.";
        }
        break;

    case 'delete':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['id'])) {
                $partId = $_GET['id'];
                $deleteResult = $computerPart->deletePart($partId);

                if ($deleteResult) {
                    $redirectUrl = generateRedirectUrl('list.php');
                    header("Location: $redirectUrl");
                    exit;
                } else {
                    echo "Error: Failed to delete the part with ID $partId.";
                }
            } else {
                echo "Error: Missing part ID.";
            }
        } else {
            echo "Error: Invalid request method.";
        }
        break;

    case 'add':
        $name = $_POST['name'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        
        // Add the part
        $success = $computerPart->addPart($name, $description, $quantity, $price);
        if ($success) {
            echo "Part added successfully.";
        } else {
            echo "Error adding part.";
        }
        break;

    default:
        // Retrieve all parts from the database
        $parts = $computerPart->getAllParts();
        break;    
}

$dbConnection->closeConnection();
?>

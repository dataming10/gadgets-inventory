<?php
include_once "../public/assets/bootstrap-css.php";
include_once "../public/assets/bootstrap-js.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deactivated Items</title>
</head>
<body>
    <div class="container">
        <h2 class="my-4">Deactivated Items</h2>
        <table id="deactivatedItemsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the ComputerPart and DatabaseConnection classes
                include_once "../Model/ComputerPart.php";
                include_once "../Model/DatabaseConnection.php";

                // Create an instance of DatabaseConnection and ComputerPart
                $dbConnection = new DatabaseConnection("localhost", "root", "", "inventory");
                $dbConnection->connect();
                $computerPart = new ComputerPart($dbConnection->getConnection());

                // Retrieve all deactivated parts from the database
                $deactivatedParts = $computerPart->getDeactivatedParts();

                // Display the list of deactivated parts
                foreach ($deactivatedParts as $part) {
                    echo "<tr>";
                    echo "<td>{$part['name']}</td>";
                    echo "<td>{$part['description']}</td>";
                    echo "<td>{$part['quantity']}</td>";
                    echo "<td>{$part['price']}</td>";
                    echo "<td>";
                    echo "<a href='../Controller/ComputerPartController.php?action=reactivate&id={$part['id']}' class='btn btn-success'>Reactivate</a>";
                    echo "</td>";
                    echo "</tr>";
                }

                // Close the database connection
                $dbConnection->closeConnection();
                ?>
            </tbody>
        </table>
    </div>
    <script src="../public/assets/js/script.js"></script>
</body>
</html>

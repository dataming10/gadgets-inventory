<?php 
include_once "../Controller/ComputerPartController.php"; 
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
        <h2 class="my-4">Computer Parts - Inventory</h2>
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
                // Include the ComputerPart class and create an instance
                include_once "../Model/ComputerPart.php";
                $dbConnection = new DatabaseConnection("localhost", "root", "", "inventory");
                $dbConnection->connect();
                $computerPart = new ComputerPart($dbConnection->getConnection());
                
                // Retrieve all parts from the database
                $parts = $computerPart->getAllParts();
                
                // Display the parts in the table
                foreach ($parts ?? [] as $part): ?>
                    <tr>
                        <td><?php echo $part['name']; ?></td>
                        <td><?php echo $part['description']; ?></td>
                        <td><?php echo $part['quantity']; ?></td>
                        <td>$<?php echo $part['price']; ?></td>
                        <td>
                            <?php if ($part['status'] == 1): ?>
                                <a href="../Controller/ComputerPartController.php?action=deactivate&id=<?php echo $part['id']; ?>" class="btn btn-danger">Deactivate</a>
                                <a href="../Controller/ComputerPartController.php?action=delete&id=<?php echo $part['id']; ?>" class="btn btn-danger">Delete</a>
                            <?php else: ?>
                                <a href="reactivate.php?id=<?php echo $part['id']; ?>" class="btn btn-success">Reactivate</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; 
                
                // Close the database connection
                $dbConnection->closeConnection();
                ?>
            </tbody>
        </table>
    </div>
    <script src="../public/assets/js/script.js"></script>
</body>
</html>


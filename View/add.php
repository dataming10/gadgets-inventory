<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Computer Part</title>
</head>
<body>
    <h2>Add Computer Part</h2>
    <form action="../Controller/ComputerPartController.php" method="post">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Description:</label>
        <textarea name="description" required></textarea><br>
        <label>Quantity:</label>
        <input type="number" name="quantity" required><br>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" required><br>
        <button type="submit" name="action" value="add">Add Part</button>
    </form>
</body>
</html>

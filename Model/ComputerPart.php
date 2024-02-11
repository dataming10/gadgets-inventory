<?php
class ComputerPart {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllParts() {
        $sql = "SELECT * FROM computer_parts WHERE status = 1";
        $result = $this->conn->query($sql);

        if ($result === false) {
            // Handle database query error
            echo "Error executing SQL query: " . $this->conn->error; // Debug statement
            return []; // Return an empty array if query fails
        }

        // Fetch all rows as an associative array
        $parts = [];
        while ($row = $result->fetch_assoc()) {
            $parts[] = $row;
        }

        return $parts;
    }

    public function getDeactivatedParts() {
        $sql = "SELECT * FROM computer_parts WHERE status = 0";
        $result = $this->conn->query($sql);

        if ($result === false) {
            // Handle database query error
            echo "Error executing SQL query: " . $this->conn->error; // Debug statement
            return []; // Return an empty array if query fails
        }

        // Fetch all rows as an associative array
        $deactivatedParts = [];
        while ($row = $result->fetch_assoc()) {
            $deactivatedParts[] = $row;
        }

        return $deactivatedParts;
    }

    public function addPart($name, $description, $quantity, $price) {
        $sql = "INSERT INTO computer_parts (name, description, quantity, price, status) VALUES (?, ?, ?, ?, 1)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdi", $name, $description, $quantity, $price);
        return $stmt->execute();
    }

    public function deactivatePart($id) {
        $sql = "UPDATE computer_parts SET status = 0 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }    

    public function reactivatePart($id) {
        $sql = "UPDATE computer_parts SET status = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }    

    public function deletePart($id) {
        $sql = "DELETE FROM computer_parts WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

?>

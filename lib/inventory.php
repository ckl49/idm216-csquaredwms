<?php 

    function fetch_inventory($conn) {
        $sql = "SELECT * FROM inventory";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $inventory_array = [];
            while($row = $result->fetch_assoc()) {
                $inventory_array[] = $row;
            }
            return ['success' => true, 'data' => $inventory_array];
        } else {
            return ['success' => false, 'error' => 'No inventory items found'];
        }
    }

?>
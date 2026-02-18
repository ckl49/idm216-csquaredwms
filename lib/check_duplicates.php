Check for duplicates: Look up by reference number, return 409 if it already exists

<?php 
    function check_for_duplicates($data, $conn) {
        foreach ($data['items'] as $item) {
            $sku = $item['sku'];
            $sql = "SELECT id FROM inventory WHERE sku = '$sku'";
            // NOT SURE IF THIS IS SUPPOSED TO BE INVENTORY


            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                http_response_code(409);
                echo json_encode(['error' => 'Conflict', 'details' => "Duplicate SKU: $sku"]);
                exit;
            }
        }
    }
?>
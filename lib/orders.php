<?php 
    function fetch_orders($conn) {
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $orders_array = [];
            while($row = $result->fetch_assoc()) {
                $orders_array[] = $row;
            }
            return ['success' => true, 'data' => $orders_array];
        } else {
            return ['success' => false, 'error' => 'No orders found'];
        }
    }


    // function edit_order($data) {

    // }
?>
<!--  reference number, trailer number, arrival date, status) and one or more items (inventory units).  -->
<!-- 
Read the JSON body: json_decode(file_get_contents('php://input'), true)
Validate required fields: reference number, trailer number, expected arrival, items
Check for duplicates: Look up by reference number, return 409 if it already exists
Auto-create missing SKUs: For each item, check if the SKU exists in the WMS database. If not, create it using the sku_details included in the request.
Create the MPL record: Insert header and items into the database
Return success response: {"success": true, "message": "MPL received successfully", "mpl_id": 1} -->


<?php 
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');

    include '../db.php';
    include '../check_duplicates.php'

    json_decode(file_get_contents('php://input'), true);

     if (!isset($data['reference_number']) || !isset($data['trailer_number']) || !isset($data['expected_arrival']) || !isset($data['items'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Bad Request', 'details' => 'Missing required field(s)']);
        exit;
    }  
    else if (check_for_duplicates($data, $conn)) {
        http_response_code(409);
        echo json_encode(['error' => 'Conflict', 'details' => 'Duplicate reference number']);
        exit;
    } 
    else {
        // SOMETHING THAT SAYS THAT IT WILL CREATE SOMETHING FOR YOU
    }



?>
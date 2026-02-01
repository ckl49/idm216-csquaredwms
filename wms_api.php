<?php 
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');

    include 'db.php';
    // include 'auth.php';
    // check_api_key($env);

    // turn line 6 and 7 above on and off if you want to try the API KEY

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {
        // echo json_encode(['success' => true, 'data' => $message]);

        $sql = "SELECT * FROM inventory";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $inventory_array = [];
            while($row = $result->fetch_assoc()) {
                $inventory_array[] = $row;
            }
        }
        echo json_encode(['success' => true, 'data' => $inventory_array]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        exit;
    }


// to add a new item to the database = POST

    if ($method === 'POST') {
        // echo json_encode(value: ['success' => true, 'data' => 'PUT request received']);
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['id']) || !isset($data['ficha'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Bad Request', 'details' => 'Missing required field(s)']);
            exit;

        } else {
            $id = $conn -> $data['id'];
            $ficha = $data['ficha'];
            
            $sql = "UPDATE inventory SET ficha = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $ficha, $id);
    
            if ($stmt->execute()) {
                http_response_code(201);
                echo json_encode(['success' => true, 'data' => 'New item created successfully']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Database error: ' . $conn->error]);
            }
        }

    
        
    }
?>
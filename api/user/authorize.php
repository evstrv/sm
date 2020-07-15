<?php
    $link = mysqli_connect(
        'localhost',
        'root',
        '',
        'medium'
    );
    
    if($link !== false) {
        $data = json_decode(file_get_contents('php://input'), true);

        foreach($data as &$item) {
            $item = htmlspecialchars($item);
        }

        $query = "SELECT id, username FROM users WHERE username=\"{$data['username']}\" and password=\"{$data['password']}\" limit 1";
        $resDb = mysqli_query($link, $query);

        if($user = mysqli_fetch_assoc($resDb)) {
            mysqli_close($link);
            die(json_encode(['res' => true, 'userId' => $user['id']]));
        }

        mysqli_close($link);
        die(json_encode(['res' => false]));
    } 



    die();
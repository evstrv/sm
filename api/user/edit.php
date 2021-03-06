<?php
    $link = mysqli_connect(
        'localhost',
        'root',
        '',
        'medium'
    );

    if($link !== false) {
        $data = json_decode(file_get_contents('php://input'), true);

        foreach($data as $key=>&$item) {
            $item = $key . '="' . htmlspecialchars($item) . '"';
        }

        $query = "UPDATE users SET " . implode(',', $data) . "WHERE id=" . htmlspecialchars($_GET['id']);
        $res = mysqli_query($link, $query);
        
        mysqli_close($link);
        die(json_encode(['res' => $res]));
    } 

    die();
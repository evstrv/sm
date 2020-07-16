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

        $query = "select username from users where username=\"{$data['username']}\"";
        $resDb = mysqli_query($link, $query);

        if($username = mysqli_fetch_assoc($resDb)) {
            die(json_encode(['res' => false]));
        } else {
            $query = "INSERT INTO users(" . implode(',', array_keys($data)) . ") VALUES('" . implode("','", array_values($data)) . "')";
            $res = mysqli_query($link, $query);
        }

        mysqli_close($link);
        die(json_encode(['res' => $res]));
    } 

    die();
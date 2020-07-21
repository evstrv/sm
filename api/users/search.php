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

        if($data['search'] === '') {
            $query = "select id, firstName, lastName, avatar from users limit 15";
            $resDb = mysqli_query($link, $query);
            $res = [];
        } else {
            $query = "select * from users where firstName like \"%{$data['search']}%\" or lastName like \"%{$data['search']}%\"";
            $resDb = mysqli_query($link, $query);
            $res = [];
        }

        while($item = mysqli_fetch_assoc($resDb)) {
            $res[] = $item;
        }

        mysqli_close($link);
        die(json_encode(['res' => true, 'users' => $res]));
    } 

    die();
<?php
    $link = mysqli_connect(
        'localhost',
        'root',
        '',
        'medium'
    );

    if($link !== false) {
        $query = "select id, firstName, lastName, avatar from users limit 15";
        $resDb = mysqli_query($link, $query);
        $res = [];

        while($item = mysqli_fetch_assoc($resDb)) {
            $res[] = $item;
        }

        mysqli_close($link);
        die(json_encode(['res' => true, 'users' => $res]));
    } 

    die();
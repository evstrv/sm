<?php
    $link = mysqli_connect(
        'localhost',
        'root',
        '',
        'medium'
    );

    if($link !== false) {
        $data = [];

        foreach($_GET as $key=>&$item) {
            $data[$key] = htmlspecialchars($item);
        }

        $query = "select u.* from `users` u join `followers` f ON u.id = f.friend WHERE f.user={$data['id']}";
        $resDb = mysqli_query($link, $query);
        $res = [];

        while($item = mysqli_fetch_assoc($resDb)) {
            $res[] = $item;
        }

        mysqli_close($link);
        die(json_encode(['res' => true, 'users' => $res]));
    } 

    die();
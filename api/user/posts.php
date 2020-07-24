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

        $query = "select * from `posts` p join `users` u ON p.userId = u.id where u.id = {$data['id']} order by time desc";
        $resDb = mysqli_query($link, $query);
        $res = [];

        while($item = mysqli_fetch_assoc($resDb)){
            $res[] = $item;
        }
            
        mysqli_close($link);
        die(json_encode(['res' => true, 'userPosts' => $res]));  
    } 

    die();
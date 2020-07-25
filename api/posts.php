<?php
    $link = mysqli_connect(
        'localhost',
        'root',
        '',
        'medium'
    );

    mysqli_set_charset($link, 'utf8');

    if($link !== false) {
        if($_SERVER['REQUEST_METHOD'] === 'PUT'){
            $data = json_decode(file_get_contents('php://input'), true);

            foreach($data as &$item){
                $item = htmlspecialchars($item);
            }

            $query = "insert into posts(text, userId) 
                                values('{$data['textarea']}', {$data['userId']})";
            $res = mysqli_query($link, $query);
            
            mysqli_close($link);
            die(json_encode(['res' => $res]));
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $query = "select * from `posts` p join `users` u ON p.userId = u.id order by time desc";
            $resDb = mysqli_query($link, $query);
            $res = [];

            while($item = mysqli_fetch_assoc($resDb)){
                $res[] = $item;
            }
            
            mysqli_close($link);
            die(json_encode(['res' => true, 'posts' => $res], JSON_INVALID_UTF8_IGNORE));
        }
    } 

    die();
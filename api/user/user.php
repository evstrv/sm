<?php
    $link = mysqli_connect(
        'localhost',
        'root',
        '',
        'medium'
    );
    
    if($link !== false) {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = [];
            foreach($_GET as $key=>&$item) {
                $data[$key] = htmlspecialchars($item);
            }
    
            $query = "SELECT * FROM users WHERE id={$data['id']} limit 1";
            $res = mysqli_fetch_assoc(mysqli_query($link, $query));
            mysqli_close($link);
    
            if($res !== false && !empty($res)) {
                die(json_encode([
                    'res' => true,
                    'user' => $res
                ]));
            } else {
                die(json_encode([
                    'res' => false
                ]));
            }
        } else if($_SERVER['REQUEST_METHOD'] === 'PUT'){
            $data = json_decode(file_get_contents('php://input'), true);

            foreach($data as $key=>&$item){
                $item = $key . '="' . htmlspecialchars($item) . '"';
            }

            $query = "update users set " . implode(',', $data) . " where id=" . htmlspecialchars($_GET['id']);
            $res = mysqli_query($link, $query);
            
            mysqli_close($link);
            die(json_encode(['res' => $res])); 
        } else if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $query = "select username from users where id=".htmlspecialchars($_POST['userId'])." limit 1";
            $resDb = mysqli_query($link, $query);

            if($resDb && $user = mysqli_fetch_assoc($resDb)) {
                $name = $user['username'].'avatar.png';
                move_uploaded_file($_FILES['file']['tmp_name'], "/xampp/htdocs/medium/uploads/avatar/$name");
                $query = "update users set avatar='//localhost/medium/uploads/avatar/$name' where id=".htmlspecialchars($_POST['userId']);

                if(mysqli_query($link, $query)) {
                    mysqli_close($link);
                    die(json_encode(['res' => true, 'src' => "//localhost/medium/uploads/avatar/$name"]));
                }
            }

            die(json_encode(['res' => false]));
        }
    } 

    die(json_encode(['res' => false]));
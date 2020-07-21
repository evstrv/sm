<?php
    $link = mysqli_connect(
        'localhost',
        'root',
        '',
        'medium'
    );

    if($link !== false) {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }
        else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
            
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            
        }
    } 

    die();
<?php
header("Content-Type: application/json");

if($_SESSION['REQUEST_METHOD'] == 'POST'){
    $data = json_decode(file_get_contents('php://input'), true);

    if(isset($data['news'])){
        $news = $data['news'];

        $is_true = verify_news($news);
        echo json_encode(['es verdadera' => $is_true]);
    }else{
        echo json_encode(['error' => 'No news provided']);
    }
}else{
    echo json_encode(['error' => 'metodo invalido']);
}

function verify_news($news){
    if(strpos(strtolower($news), 'fake') !== false){
        return false;
    }
    return true;
}
?>
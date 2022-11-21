<?php
if (!empty($_GET['id'])) {
    $params = array(
        "id" => $_GET['id']
    );    
    curl_setopt_array($ch = curl_init(), array(
        CURLOPT_URL => "http://localhost/eltiempoapi/public/eliminar",
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => http_build_query($params),
        CURLOPT_RETURNTRANSFER => 1
    ));
    $response = curl_exec($ch);
    curl_close($ch);    
    $respuesta = json_decode($response);
    $alert = '<div class="alert alert-primary" role="alert">'.$respuesta.'</div>';
    header("location: index.php");
}
?>
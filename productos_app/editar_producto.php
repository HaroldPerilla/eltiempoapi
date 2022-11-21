<?php
include_once "includes/header.php";

if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['cantidad'])) {
    $alert = '<div class="alert alert-primary" role="alert">
              Todo los campos son requeridos
            </div>';
  } else {

    $params = array(
      "id" => $_POST['id'],
      "nombre" => $_POST['producto'],
      "precio" => $_POST['precio'],
      "cantidad" => $_POST['cantidad']
    );
    
    curl_setopt_array($ch = curl_init(), array(
      CURLOPT_URL => "http://localhost/eltiempoapi/public/actualizar",
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_POST => 1,
      CURLOPT_POSTFIELDS => http_build_query($params),
      CURLOPT_RETURNTRANSFER => 1
    ));
    $response = curl_exec($ch);
    curl_close($ch);    
    $respuesta = json_decode($response);
    unset($_POST);    

    $alert = '<div class="alert alert-primary" role="alert">'.$respuesta.'</div>';
  }
}

// Validar producto

if (empty($_REQUEST['id'])) {
  header("Location: index.php");
} else {
  $id_producto = $_REQUEST['id'];
  if (!is_numeric($id_producto)) {
    header("Location: index.php");
  }
  $params = array(
    "id" => $id_producto
  );
  
  curl_setopt_array($ch = curl_init(), array(
    CURLOPT_URL => "http://localhost/eltiempoapi/public/mostrar",
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => http_build_query($params),
    CURLOPT_RETURNTRANSFER => 1
  ));
  $respuesta = curl_exec($ch);
  curl_close($ch);
  $datos = json_decode($respuesta, TRUE);
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="row">
    <div class="col-lg-6 m-auto">

      <div class="card">
        <div class="card-header bg-primary text-white">
          Modificar producto
        </div>
        <div class="card-body">
          <form action="" method="post">
            <?php echo isset($alert) ? $alert : ''; ?>            
            <div class="form-group">
              <label for="producto">Producto</label>
              <input type="text" class="form-control" placeholder="Ingrese nombre del producto" name="producto" id="producto" value="<?php echo $datos['nombre']; ?>">
              <input type="hidden" name="id" id="id" value="<?php echo $datos['id']; ?>">
            </div>
            <div class="form-group">
              <label for="precio">Precio ($)</label>
              <input type="text" placeholder="Ingrese precio" class="form-control" name="precio" id="precio" value="<?php echo $datos['precio']; ?>">
            </div>
            <div class="form-group">
              <label for="peso">Cantidad</label>
              <input type="text" placeholder="Ingrese cantidad" class="form-control" name="cantidad" id="cantidad" value="<?php echo $datos['cantidad']; ?>">
            </div>            
            <input type="submit" value="Actualizar Producto" class="btn btn-primary">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>
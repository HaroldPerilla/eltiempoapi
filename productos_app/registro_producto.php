<?php 
 include_once "includes/header.php";
 $alert = '';
 if (!empty($_POST)) {
  $params = array(
    "nombre" => $_POST['nombre'],
    "precio" => $_POST['precio'],
    "cantidad" => $_POST['cantidad']
  );
  
  curl_setopt_array($ch = curl_init(), array(
    CURLOPT_URL => "http://localhost/eltiempoapi/public/agregarProductos",
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
  ?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
     <a href="index.php" class="btn btn-primary">Regresar</a>
   </div>

   <!-- Content Row -->
   <div class="row">
     <div class="col-lg-6 m-auto">
       <form action="" method="post" autocomplete="off">
         <?php echo isset($alert) ? $alert : ''; ?>        
         <div class="form-group">
           <label for="producto">Producto</label>
           <input type="text" placeholder="Ingrese nombre del producto" name="nombre" id="nombre" class="form-control">
         </div>                
         <div class="form-group">
           <label for="cantidad">Cantidad</label>
           <input type="number" placeholder="Ingrese cantidad" class="form-control" name="cantidad" id="cantidad">
         </div>
         <div class="form-group">
           <label for="precio">Precio</label>
           <input type="number" min="0" placeholder="Ingrese precio" class="form-control" name="precio" id="precio">
         </div>          
         <input type="submit" value="Guardar Producto" class="btn btn-primary">
       </form>
     </div>
   </div>


 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->
 <?php include_once "includes/footer.php"; ?>
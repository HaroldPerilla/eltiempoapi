<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Productos</h1>
		<a href="registro_producto.php" class="btn btn-primary">Nuevo</a>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>NOMBRE</th>
							<th>CANTIDAD</th>
							<th>PRECIO $</th>
							<th>FECHA CREACIÓN</th>							
							<th>ACCIONES</th>						
						</tr>
					</thead>
					<tbody>
						<?php
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"http://localhost/eltiempoapi/public/productos");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
            $respuesta = curl_exec($ch);
            curl_close($ch);
            $datos = json_decode($respuesta, TRUE);           
						
            foreach ($datos as $data => $valor) { ?>
              <tr>
                <td><?php echo $valor['nombre']; ?></td>
                <td><?php echo $valor['cantidad']; ?></td>
                <td><?php echo $valor['precio']; ?></td>
                <td><?php echo $valor['created_at']; ?></td>								
                <td>
                  <a href="editar_producto.php?id=<?php echo $valor['id']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>

                  <form action="eliminar_producto.php?id=<?php echo $valor['id']; ?>" method="post" class="confirmar d-inline">
                    <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                  </form>
                </td>
                  
              </tr>
          <?php }
            ?>
					</tbody>

				</table>
			</div>

		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php include_once "includes/footer.php"; ?>
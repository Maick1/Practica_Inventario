<?php
require "../conexion.php";
$usuarios = mysqli_query($conexion, "SELECT * FROM usuario");
$total['usuarios'] = mysqli_num_rows($usuarios);
$clientes = mysqli_query($conexion, "SELECT * FROM cliente");
$total['clientes'] = mysqli_num_rows($clientes);
$productos = mysqli_query($conexion, "SELECT * FROM producto");
$total['productos'] = mysqli_num_rows($productos);
$ventas = mysqli_query($conexion, "SELECT * FROM ventas WHERE fecha > CURDATE()");
$total['ventas'] = mysqli_num_rows($ventas);
session_start();
include_once "includes/header.php";
?>
<!-- Content Row -->
<div class="row">
    <div class="col-lg-2 col-md-4 col-sm-4">
        <div class="card card-stats">


        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <a href="clientes.php" class="card-category text-success font-weight-bold">
                    Clientes
                </a>
                <h3 class="card-title"><?php echo $total['clientes']; ?></h3>
            </div>
            <div class="card-footer bg-secondary text-white">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="fab fa-product-hunt fa-2x"></i>
                </div>
                <a href="productos.php" class="card-category text-danger font-weight-bold">
                    Productos
                </a>
                <h3 class="card-title"><?php echo $total['productos']; ?></h3>
            </div>
            <div class="card-footer bg-primary">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-cash-register fa-2x"></i>
                </div>
                <a href="ventas.php" class="card-category text-info font-weight-bold">
                    Ventas
                </a>
                <h3 class="card-title"><?php echo $total['ventas']; ?></h3>
            </div>
            <div class="card-footer bg-danger text-white">
            </div>
        </div>
    </div>



    <div class="col-lg-4 col-md-4">
        <div class="card text-center"> <!-- Agregamos la clase "text-center" al div "card" -->
            <div class="card-header card-header-primary">
                <h3 class="title-2 m-b-40">Productos con stock mínimo</h3>
            </div>
            <div class="card-body d-flex justify-content-center align-items-center"> <!-- Agregamos clases para centrar contenido horizontal y verticalmente -->
                <canvas id="stockMinimo"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4">
        <div class="card text-center"> <!-- Fondo azul y texto blanco -->
            <div class="card-header card-header-primary">
                <h3 class="title-2 m-b-40" style="color: #fff;">¡Bienvenido al Dashboard, Administrador!</h3> <!-- Texto blanco -->
            </div>
            <div class="card-body d-flex flex-column justify-content-center align-items-center"> <!-- Agregamos clases para centrar contenido verticalmente y permitir un diseño en columna -->
                <p style="font-size: 1.2em;">¡Bienvenido a nuestra plataforma!</p> <!-- Texto más grande -->

                <p style="font-size: 1.2em;">En este sistema puede:</p> <!-- Texto más grande -->
                <ul style="list-style: none; padding-left: 0; font-size: 1.2em;">
                    <li><i class="fas fa-plus-circle" style="color: #27ae60;"></i> Agregar Productos</li> <!-- Icono y texto verde -->
                    <li><i class="fas fa-shopping-cart" style="color: #e74c3c;"></i> Realizar una venta</li> <!-- Icono y texto rojo -->
                    <li><i class="fas fa-file-pdf" style="color: #f1c40f;"></i> Generar un PDF</li> <!-- Icono y texto amarillo -->
                </ul>

                <canvas id="stockMinimo"></canvas>
            </div>
        </div>
    </div>



</div>

<?php include_once "includes/footer.php"; ?>
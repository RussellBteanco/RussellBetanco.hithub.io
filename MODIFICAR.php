<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agregar";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejo del formulario para modificar productos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $descuento = $_POST['descuento'];
    $impuesto = $_POST['impuesto'];
    $total = $_POST['total'];

    // Preparar la consulta para evitar inyecciones SQL
    $sql = $conn->prepare("UPDATE tabla1 SET cantidad=?, descuento=?, impuesto=?, total=? WHERE nombre=?");
    $sql->bind_param("iddis", $cantidad, $descuento, $impuesto, $total, $nombre);

    if ($sql->execute()) {
        echo "<p style='color: green;'>Producto modificado exitosamente.</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $sql->error . "</p>";
    }

    // Cerrar la consulta
    $sql->close();
}

// Cerrar la conexión con la base de datos
$conn->close();
?>


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

// Obtener el nombre del producto
$nombre = $_GET['nombre'];

// Consulta para obtener el precio del producto desde otra tabla
$sql = "SELECT precio FROM precioproductos WHERE nombre = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre);
$stmt->execute();
$result = $stmt->get_result();

$precio = 0;

// Verificar si se encontró el producto
if ($row = $result->fetch_assoc()) {
    $precio = $row['precio'];
}

// Devolver el precio en formato JSON
header('Content-Type: application/json');
echo json_encode(['precio' => $precio]);

// Cerrar la consulta y la conexión
$stmt->close();
$conn->close();
?>

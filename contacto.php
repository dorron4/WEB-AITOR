<?php
/**
 * Script para procesar el formulario de contacto y guardar en MySQL (Hostinger)
 */

// 1. Configuración de la base de datos
$host     = 'localhost';
$dbname   = 'u976617270_BD_LEADS';
$username = 'u976617270_oficialbee2022';
$password = 'MAgoloMIdomeAIdogo13011998@';

try {
    // 2. Conexión a la base de datos usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 3. Recoger y limpiar los datos del formulario
    $nombre   = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $telefono = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    $email    = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $mensaje  = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

    if (empty($nombre) || empty($email) || empty($mensaje)) {
        die("Por favor, rellena los campos obligatorios.");
    }

    // 4. Preparar la consulta SQL
    $sql = "INSERT INTO contactos (nombre, telefono, email, mensaje) VALUES (:nombre, :telefono, :email, :mensaje)";
    $stmt = $pdo->prepare($sql);

    // 5. Ejecutar la consulta
    $stmt->execute([
        ':nombre'   => $nombre,
        ':telefono' => $telefono,
        ':email'    => $email,
        ':mensaje'  => $mensaje
    ]);

    // 6. Redirigir o mostrar mensaje de éxito
    echo "<script>
            alert('¡Mensaje enviado con éxito! Me pondré en contacto contigo pronto.');
            window.location.href = 'index.html';
          </script>";

} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>

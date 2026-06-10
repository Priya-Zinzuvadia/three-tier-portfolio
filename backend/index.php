<?php
// Set headers to allow cross-origin requests (CORS) from our frontend container
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");

// Database credentials mapped to match our Docker setup
$host = 'db'; // Using the Docker Compose service name as the hostname
$db   = 'portfolio_db';
$user = 'portfolio_user';
$pass = 'portfolio_secure_pass';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Attempt connection to the MySQL container
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Fetch the target record file name string
    $stmt = $pdo->query('SELECT image_url FROM resume_data WHERE id = 1');
    $row = $stmt->fetch();
    
    if ($row) {
        echo json_encode(["status" => "success", "image_url" => $row['image_url']]);
    } else {
        // Fallback fallback pointer string if the row is empty
        echo json_encode(["status" => "fallback", "image_url" => "resume.pdf"]);
    }

} catch (\PDOException $e) {
    // If the database isn't fully booted up yet, return graceful fallback object
    echo json_encode([
        "status" => "fallback_active", 
        "image_url" => "resume.pdf",
        "error" => "Database handshake exception, utilizing static mapping."
    ]);
}
?>

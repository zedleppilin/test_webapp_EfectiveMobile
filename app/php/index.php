<?php
$host = 'mysql';
$db   = 'mydatabase';
$user = 'myuser';
$pass = 'mypassword';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Create the table if it doesn't exist
    $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS chaotic_numbers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        number INT
    )");
    $stmt->execute();

    // Insert the chaotic number into the table
    $stmt = $pdo->prepare("INSERT INTO chaotic_numbers (number) VALUES (?)");
    $chaoticNumber = rand(); // Generate a random number for demonstration
    $stmt->execute([$chaoticNumber]);

    echo "Chaotic number $chaoticNumber has been written to the database.";

} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

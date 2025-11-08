<?php

require __DIR__ . '/../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Auth;

$kernel = $app->make(Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

$dbPath = __DIR__ . '/../../database/database.sqlite';

try {
    $pdo = new PDO("sqlite:" . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $currentUserId = Auth::id();

    $stmt = $pdo->prepare("SELECT id, first_name || ' ' || last_name AS full_name FROM users WHERE id != :currentUserId");
    $stmt->bindParam(':currentUserId', $currentUserId, PDO::PARAM_INT);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);

    $kernel->terminate($request, $response);

} catch (PDOException $e) {
    echo json_encode(["error" => "Failed to connect to the database: " . $e->getMessage()]);
}

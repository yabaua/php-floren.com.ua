<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
if (empty($_SESSION['gaClientId']) && !empty($_POST['gaClientId'])) {
    $gaClientId = trim($_POST['gaClientId']);

    if ($gaClientId !== '') {
        $_SESSION['gaClientId'] = $gaClientId;
    }
}
echo json_encode([
    'success' => !empty($_SESSION['gaClientId']),
    'gaClientId' => $_SESSION['gaClientId'] ?? null
]);
?>
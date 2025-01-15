<?php
session_start();
include('../BDD/connexion.php');

$userId = $_SESSION['coach_id']; // ou $_SESSION['sportif_id']
$unreadMessagesQuery = $conn->prepare('
    SELECT COUNT(*) AS unread_count 
    FROM messages 
    WHERE to_user_id = ? AND is_read = FALSE
');
$unreadMessagesQuery->bind_param('i', $userId);
$unreadMessagesQuery->execute();
$result = $unreadMessagesQuery->get_result()->fetch_assoc();

echo json_encode(['unreadCount' => $result['unread_count']]);
?>

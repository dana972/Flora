<?php
session_start();
require_once '../config/config.php';

// Fetch messages from the contacts table
$stmt = $pdo->query("SELECT id, full_name, email, subject, message, created_at FROM contacts ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customer Messages</title>
<style>body {
    font-family: 'Arial', sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 80%;
    max-width: 1200px;
    margin: auto;
    padding: 20px;
}

.card {
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 20px;
    border: 2px solid #CB9DF0; /* Border color */
}

h2 {
    text-align: center;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
    color: #333;
}

table th {
    background-color: #CB9DF0; /* Header background color */
    color: #ffffff; /* Text color for header */
}

table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tbody tr:hover {
    background-color: #f1f1f1;
}

@media (max-width: 768px) {
    .container {
        width: 95%;
        padding: 10px;
    }

    table, th, td {
        display: block;
        width: 100%;
    }

    table thead {
        display: none;
    }

    table tbody tr {
        border-bottom: 1px solid #ddd;
    }

    table tbody tr td {
        border: none;
        padding-left: 50%;
        text-align: right;
        position: relative;
    }

    table tbody tr td:before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: bold;
        width: 50%;
        padding-right: 10px;
        text-align: left;
    }
}
</style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Customer Messages</h2>
            <?php if (empty($messages)) : ?>
                <p>No messages found.</p>
            <?php else : ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Received At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $message) : ?>
                            <tr>
                                <td><?= htmlspecialchars($message['id']) ?></td>
                                <td><?= htmlspecialchars($message['full_name']) ?></td>
                                <td><?= htmlspecialchars($message['email']) ?></td>
                                <td><?= htmlspecialchars($message['subject']) ?></td>
                                <td><?= htmlspecialchars($message['message']) ?></td>
                                <td><?= htmlspecialchars($message['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

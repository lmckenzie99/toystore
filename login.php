<?php 
require_once 'includes/database-connection.php';
require_once 'includes/session.php';

$logged_in = $_SESSION['logged_in'] ?? false;
if ($logged_in) {
    header('Location: profile.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = authenticate($pdo, $_POST['username'], $_POST['password']);

    if ($user) {
        login($user);
        header('Location: profile.php');
        exit;
    }
}

include 'includes/header.php';
?> 

<div id="content" class="login-container animate-bottom">
    <h1>Log In</h1>
    <hr />

    <form method="POST" action="login.php" class="login-form">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Log In" class="submit-btn">
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
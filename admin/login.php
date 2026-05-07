<?php
session_start();
require_once '../config/db.php';

if (isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $user['username'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - PrimeOrbit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 rounded-3xl shadow-xl w-full max-w-md border border-gray-100">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Admin <span class="text-google-blue">Login</span></h1>
            <p class="text-gray-500">Secure access to PrimeOrbit corporate dashboard</p>
        </div>

        <?php if ($error): ?>
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-center text-sm font-medium border border-red-100">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Username</label>
                <input 
                    type="text" 
                    name="username" 
                    required 
                    placeholder="Enter username"
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all"
                >
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    required 
                    placeholder="Enter password"
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all"
                >
            </div>

            <button 
                type="submit" 
                class="w-full py-4 bg-gray-900 text-white rounded-2xl font-bold text-lg hover:bg-google-blue transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-google-blue/20"
            >
                Sign In
            </button>
        </form>

        <div class="mt-10 text-center">
            <a href="../index.php" class="text-gray-400 hover:text-gray-600 text-sm transition-colors flex items-center justify-center gap-2">
&larr; Back to Website
            </a>
        </div>
    </div>
</body>
</html>



<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PrimeOrbit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        google: {
                            blue: '#4285F4',
                            red: '#EA4335',
                            yellow: '#FBBC05',
                            green: '#34A853'
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .sidebar-link.active {
            background-color: #4285F4;
            color: white;
            box-shadow: 0 10px 15px -3px rgba(66, 133, 244, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50 flex">
    <!-- Sidebar -->
    <aside class="w-72 bg-white h-screen sticky top-0 shadow-xl z-20 border-r border-gray-100 flex flex-col">
        <div class="p-8 border-b border-gray-100 mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Admin <span class="text-google-blue">Control</span></h1>
        </div>
        
        <nav class="flex-grow px-6 space-y-2">
            <a href="index.php" class="sidebar-link active flex items-center gap-3 p-4 rounded-2xl hover:bg-google-blue/10 hover:text-google-blue transition-all">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="projects.php" class="sidebar-link flex items-center gap-3 p-4 rounded-2xl hover:bg-google-blue/10 hover:text-google-blue transition-all">
                <i data-lucide="briefcase" class="w-5 h-5"></i>
                <span class="font-medium">Projects</span>
            </a>
            <a href="services.php" class="sidebar-link flex items-center gap-3 p-4 rounded-2xl hover:bg-google-blue/10 hover:text-google-blue transition-all">
                <i data-lucide="cpu" class="w-5 h-5"></i>
                <span class="font-medium">Services</span>
            </a>
            <a href="blog.php" class="sidebar-link flex items-center gap-3 p-4 rounded-2xl hover:bg-google-blue/10 hover:text-google-blue transition-all">
                <i data-lucide="newspaper" class="w-5 h-5"></i>
                <span class="font-medium">Articles</span>
            </a>
            <a href="reviews.php" class="sidebar-link flex items-center gap-3 p-4 rounded-2xl hover:bg-google-blue/10 hover:text-google-blue transition-all">
                <i data-lucide="star" class="w-5 h-5"></i>
                <span class="font-medium">Reviews</span>
            </a>
            <a href="bookings.php" class="sidebar-link flex items-center gap-3 p-4 rounded-2xl hover:bg-google-blue/10 hover:text-google-blue transition-all">
                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                <span class="font-medium">Bookings</span>
                <?php
                    // Safely show new bookings count badge
                    try {
                        require_once dirname(__DIR__, 2) . '/config/db.php';
                        $newCount = $pdo->query("SELECT COUNT(*) FROM bookings WHERE status='new'")->fetchColumn();
                        if ($newCount > 0) echo '<span class="ml-auto bg-google-blue text-white text-xs font-black px-2 py-0.5 rounded-full">' . $newCount . '</span>';
                    } catch(Exception $e) {}
                ?>
            </a>
            <a href="settings.php" class="sidebar-link flex items-center gap-3 p-4 rounded-2xl hover:bg-google-blue/10 hover:text-google-blue transition-all">
                <i data-lucide="settings" class="w-5 h-5"></i>
                <span class="font-medium">Settings</span>
            </a>
        </nav>

        <div class="p-8 border-t border-gray-100 mb-6">
            <a href="logout.php" class="flex items-center gap-3 p-4 rounded-2xl bg-red-50 text-red-600 hover:bg-red-100 transition-all font-bold">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                Logout
            </a>
        </div>
    </aside>

    <main class="flex-grow p-10 overflow-y-auto">
        <header class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Welcome, <?php echo $_SESSION['admin_user']; ?>!</h2>
                <p class="text-gray-500">Here's an overview of your company metrics.</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="../index.php" target="_blank" class="px-6 py-3 bg-white border border-gray-200 rounded-full text-sm font-medium hover:shadow-md transition-all flex items-center gap-2">
                    View Live Site <i data-lucide="external-link" class="w-4 h-4"></i>
                </a>
            </div>
        </header>

        <!-- Dynamic Content Starts -->


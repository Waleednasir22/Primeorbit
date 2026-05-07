<?php
require_once 'includes/header.php';
require_once '../config/db.php';

// Fetch quick stats
$projectCount = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
$serviceCount = $pdo->query("SELECT COUNT(*) FROM services")->fetchColumn();
$articleCount = $pdo->query("SELECT COUNT(*) FROM articles")->fetchColumn();
$reviewCount  = $pdo->query("SELECT COUNT(*) FROM reviews")->fetchColumn();
try {
    $newBookingsCount = $pdo->query("SELECT COUNT(*) FROM bookings WHERE status='new'")->fetchColumn();
    $totalBookingsCount = $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
} catch (Exception $e) {
    $newBookingsCount = 0;
    $totalBookingsCount = 0;
}
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-12">
    <!-- Stat Card: Projects -->
    <a href="projects.php" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:border-google-blue/30 transition-all group">
        <div class="w-12 h-12 bg-blue-50 text-google-blue rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <i data-lucide="briefcase" class="w-6 h-6"></i>
        </div>
        <h4 class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Projects</h4>
        <p class="text-3xl font-bold text-gray-900"><?php echo $projectCount; ?></p>
    </a>

    <!-- Stat Card: Services -->
    <a href="services.php" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:border-google-red/30 transition-all group">
        <div class="w-12 h-12 bg-red-50 text-google-red rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <i data-lucide="cpu" class="w-6 h-6"></i>
        </div>
        <h4 class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Services</h4>
        <p class="text-3xl font-bold text-gray-900"><?php echo $serviceCount; ?></p>
    </a>

    <!-- Stat Card: Articles -->
    <a href="blog.php" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:border-google-yellow/30 transition-all group">
        <div class="w-12 h-12 bg-yellow-50 text-google-yellow rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <i data-lucide="newspaper" class="w-6 h-6"></i>
        </div>
        <h4 class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Articles</h4>
        <p class="text-3xl font-bold text-gray-900"><?php echo $articleCount; ?></p>
    </a>

    <!-- Stat Card: Reviews -->
    <a href="reviews.php" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:border-google-green/30 transition-all group">
        <div class="w-12 h-12 bg-green-50 text-google-green rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <i data-lucide="star" class="w-6 h-6"></i>
        </div>
        <h4 class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Reviews</h4>
        <p class="text-3xl font-bold text-gray-900"><?php echo $reviewCount; ?></p>
    </a>

    <!-- Stat Card: Bookings -->
    <a href="bookings.php" class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:border-google-blue/30 transition-all group relative overflow-hidden">
        <?php if ($newBookingsCount > 0): ?>
        <span class="absolute top-4 right-4 bg-google-blue text-white text-[10px] font-black px-2 py-0.5 rounded-full animate-pulse">
            <?php echo $newBookingsCount; ?> NEW
        </span>
        <?php endif; ?>
        <div class="w-12 h-12 bg-blue-50 text-google-blue rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <i data-lucide="calendar-check" class="w-6 h-6"></i>
        </div>
        <h4 class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Bookings</h4>
        <p class="text-3xl font-bold text-gray-900"><?php echo $totalBookingsCount; ?></p>
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Quick Actions -->
    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
        <h3 class="text-xl font-bold mb-6 text-gray-900">Quick Actions</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="projects.php?action=add" class="p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:border-google-blue hover:text-google-blue transition-all group flex flex-col items-center text-center">
                <i data-lucide="plus-circle" class="w-8 h-8 mb-3 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold">Add Project</span>
            </a>
            <a href="blog.php?action=add" class="p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:border-google-red hover:text-google-red transition-all group flex flex-col items-center text-center">
                <i data-lucide="file-plus-2" class="w-8 h-8 mb-3 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold">New Article</span>
            </a>
            <a href="bookings.php" class="p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:border-google-blue hover:text-google-blue transition-all group flex flex-col items-center text-center">
                <i data-lucide="calendar-check" class="w-8 h-8 mb-3 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold font-display">View Bookings</span>
            </a>
            <a href="reviews.php" class="p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:border-google-green hover:text-google-green transition-all group flex flex-col items-center text-center">
                <i data-lucide="message-square" class="w-8 h-8 mb-3 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold">Manage Reviews</span>
            </a>
            <a href="settings.php" class="p-6 bg-gray-50 rounded-2xl border border-gray-100 hover:border-google-yellow hover:text-google-yellow transition-all group flex flex-col items-center text-center col-span-2">
                <i data-lucide="settings" class="w-8 h-8 mb-3 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold font-display">Global Site Settings</span>
            </a>
        </div>
    </div>

    <!-- Recent Activity Placeholder -->
    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm flex flex-col">
        <h3 class="text-xl font-bold mb-6 text-gray-900">System Information</h3>
        <div class="space-y-4 flex-grow">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                <div class="flex items-center gap-3">
                    <i data-lucide="database" class="w-5 h-5 text-gray-400"></i>
                    <span class="text-gray-600">Database Status</span>
                </div>
                <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-bold uppercase">Online</span>
            </div>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                <div class="flex items-center gap-3">
                    <i data-lucide="server" class="w-5 h-5 text-gray-400"></i>
                    <span class="text-gray-600">PHP Version</span>
                </div>
                <span class="text-gray-900 font-bold"><?php echo phpversion(); ?></span>
            </div>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                <div class="flex items-center gap-3">
                    <i data-lucide="calendar" class="w-5 h-5 text-gray-400"></i>
                    <span class="text-gray-600">Current Date</span>
                </div>
                <span class="text-gray-900 font-bold"><?php echo date('M d, Y'); ?></span>
            </div>
        </div>
        <div class="mt-6 pt-6 border-t border-gray-100 italic text-gray-400 text-xs text-center">
            Built by Antigravity for PrimeOrbit
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>



<?php
require_once 'includes/header.php';
require_once '../config/db.php';

$message = '';

// Fetch current settings
$settings = $pdo->query("SELECT * FROM settings LIMIT 2")->fetch();

// Handle Save
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_name         = $_POST['site_name'];
    $site_tagline      = $_POST['site_tagline'];
    $about_title       = $_POST['about_title'];
    $about_description = $_POST['about_description'];
    $contact_email     = $_POST['contact_email'];
    $address           = $_POST['address'];
    $stats_clients     = $_POST['stats_clients'];
    $stats_projects    = $_POST['stats_projects'];
    $stats_awards      = $_POST['stats_awards'];

    if ($settings) {
        // Update existing row
        $pdo->prepare("UPDATE settings SET 
            site_name=?, site_tagline=?, about_title=?, about_description=?,
            contact_email=?, address=?, stats_clients=?, stats_projects=?, stats_awards=?
            WHERE id=?")
            ->execute([
                $site_name, $site_tagline, $about_title, $about_description,
                $contact_email, $address, $stats_clients, $stats_projects, $stats_awards,
                $settings['id']
            ]);
    } else {
        // Insert first row
        $pdo->prepare("INSERT INTO settings 
            (site_name, site_tagline, about_title, about_description, contact_email, address, stats_clients, stats_projects, stats_awards)
            VALUES (?,?,?,?,?,?,?,?,?)")
            ->execute([
                $site_name, $site_tagline, $about_title, $about_description,
                $contact_email, $address, $stats_clients, $stats_projects, $stats_awards
            ]);
    }

    // Refresh
    $settings = $pdo->query("SELECT * FROM settings LIMIT 2")->fetch();
    $message  = "Settings saved successfully!";
}
?>

<div class="mb-8">
    <h3 class="text-2xl font-bold text-gray-900">Site <span class="text-google-yellow">Settings</span></h3>
    <p class="text-gray-500 mt-2">Manage your company's global content and contact information.</p>
</div>

<?php if ($message): ?>
    <div class="bg-green-50 text-green-600 p-5 rounded-2xl mb-8 border border-green-200 font-bold flex items-center gap-3">
        <i data-lucide="check-circle" class="w-5 h-5"></i> <?php echo $message; ?>
    </div>
<?php endif; ?>

<form action="settings.php" method="POST" class="space-y-8 max-w-3xl">

    <!-- Brand -->
    <div class="bg-white p-8 rounded-3xl border border-gray-200 shadow-sm">
        <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
            <i data-lucide="layout" class="w-5 h-5 text-google-blue"></i> Brand Identity
        </h4>
        <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-2">Site Name</label>
                <input type="text" name="site_name" value="<?php echo htmlspecialchars($settings['site_name'] ?? ''); ?>" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/20 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-2">Tagline</label>
                <input type="text" name="site_tagline" value="<?php echo htmlspecialchars($settings['site_tagline'] ?? ''); ?>" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/20 outline-none transition-all">
            </div>
        </div>
    </div>

    <!-- About -->
    <div class="bg-white p-8 rounded-3xl border border-gray-200 shadow-sm">
        <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
            <i data-lucide="info" class="w-5 h-5 text-google-red"></i> About Section
        </h4>
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-2">About Title</label>
                <input type="text" name="about_title" value="<?php echo htmlspecialchars($settings['about_title'] ?? ''); ?>" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/20 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-2">About Description</label>
                <textarea name="about_description" rows="4" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/20 outline-none transition-all"><?php echo htmlspecialchars($settings['about_description'] ?? ''); ?></textarea>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div class="bg-white p-8 rounded-3xl border border-gray-200 shadow-sm">
        <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
            <i data-lucide="mail" class="w-5 h-5 text-google-green"></i> Contact Information
        </h4>
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-2">Contact Email</label>
                <input type="email" name="contact_email" value="<?php echo htmlspecialchars($settings['contact_email'] ?? ''); ?>" placeholder="hello@PrimeOrbitandco.com" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/20 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-2">Address</label>
                <textarea name="address" rows="2" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/20 outline-none transition-all"><?php echo htmlspecialchars($settings['address'] ?? ''); ?></textarea>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="bg-white p-8 rounded-3xl border border-gray-200 shadow-sm">
        <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
            <i data-lucide="bar-chart-2" class="w-5 h-5 text-google-yellow"></i> Hero Statistics
        </h4>
        <div class="grid grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-2">Clients</label>
                <input type="text" name="stats_clients" value="<?php echo htmlspecialchars($settings['stats_clients'] ?? '50+'); ?>" placeholder="50+" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/20 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-2">Projects</label>
                <input type="text" name="stats_projects" value="<?php echo htmlspecialchars($settings['stats_projects'] ?? '222+'); ?>" placeholder="222+" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/20 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-2">Awards</label>
                <input type="text" name="stats_awards" value="<?php echo htmlspecialchars($settings['stats_awards'] ?? '25+'); ?>" placeholder="25+" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/20 outline-none transition-all">
            </div>
        </div>
    </div>

    <button type="submit" class="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-lg hover:bg-google-yellow hover:text-gray-900 transition-all shadow-lg flex items-center justify-center gap-3">
        <i data-lucide="save" class="w-5 h-5"></i> Save Settings
    </button>
</form>

<?php require_once 'includes/footer.php'; ?>



<?php
// Main Entry Point for PrimeOrbit PHP Company

// Keep the homepage extremely cheap after the first render.
$requestUri = $_SERVER['REQUEST_URI'] ?? '/PrimeOrbit/index.php';
$cacheDir = __DIR__ . DIRECTORY_SEPARATOR . 'cache';
if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0775, true);
}

// Performance Optimization: Gzip Compression
if (!headers_sent()) {
    header('X-Content-Type-Options: nosniff');
    header('Cache-Control: public, max-age=60, stale-while-revalidate=3600');
}
if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
    if (!ob_start("ob_gzhandler")) ob_start();
} else {
    ob_start();
}

// Performance Optimization: simple HTML Caching
$cache_file = $cacheDir . DIRECTORY_SEPARATOR . md5($requestUri) . '.html';
$cache_time = 86400; // 24 hours
$nocache = isset($_GET['nocache']);

if (!$nocache && file_exists($cache_file) && (time() - $cache_time < filemtime($cache_file))) {
    header('X-PrimeOrbit-Cache: HIT');
    echo "<!-- Cached version " . date('Y-m-d H:i:s', filemtime($cache_file)) . " -->\n";
    readfile($cache_file);
    exit;
}

header('X-PrimeOrbit-Cache: MISS');
if (!$nocache) ob_start(); // Start buffering for cache generation

function primeorbit_minify_html($html) {
    $html = preg_replace('/<!--(?!\\[if).*?-->/s', '', $html);
    $html = preg_replace('/>\\s+</', '><', $html);
    return trim($html);
}

// Include database connection
require_once 'config/db.php';

// Simple Router
$view = isset($_GET['view']) ? $_GET['view'] : 'home';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Page Title Configuration
$pageTitle = "PrimeOrbit - Corporate Technology Company";
if($view === 'blog') $pageTitle = "Insights - PrimeOrbit";
if($view === 'blog') $pageTitle = "Insights - PrimeOrbit";

// Layout Starts
include 'includes/header.php';
include 'includes/navbar.php';

// Component/Page Logic
switch ($view) {
    case 'home':
        include 'components/hero.php';
        include 'components/tech_stack.php';
        include 'components/about.php';
        include 'components/skills.php';
        include 'components/experience.php';
        include 'components/education.php';
        include 'components/services.php';
        include 'components/projects.php';
        include 'components/process.php';
        include 'components/labs.php';
        include 'components/team.php';
        include 'components/reviews.php';
        include 'components/faq.php';
        include 'components/contact.php';
        break;
    
    case 'blog':
        include 'components/blog_page.php';
        break;
    
    case 'article':
        include 'components/article_page.php';
        break;
    
    
    case 'case-study':
        include 'components/case_study_page.php';
        break;

    case 'explore-all':
        include 'components/explore_all_page.php';
        break;

    default:
        include 'components/hero.php';
        break;
}

// Global Components 
include 'components/audio_controller.php';
    include 'components/chat_bot.php';
    include 'components/booking_modal.php';
?>

<?php
// Layout Ends
include 'includes/footer.php';

// Save output to cache if generation was needed
if (!$nocache) {
    $content = ob_get_contents();
    $content = primeorbit_minify_html($content);
    $tmpFile = $cache_file . '.tmp';
    file_put_contents($tmpFile, $content, LOCK_EX);
    rename($tmpFile, $cache_file);
    ob_end_clean();
    echo $content;
}
?>


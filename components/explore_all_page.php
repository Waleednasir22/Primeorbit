<?php
require_once 'config/db.php';
$stmt = $pdo->query("SELECT * FROM lab_experiments");
$labs = $stmt->fetchAll();
?>

<!-- Explore All Page -->
<section class="pt-32 pb-24 bg-gray-50 min-h-screen">
  <div class="container mx-auto px-6">
    <div class="max-w-5xl mx-auto">
      <a href="index.php?view=home#labs" class="text-google-blue font-bold flex items-center gap-2 mb-12 hover:gap-3 transition-all">
        ← Back to Home
      </a>

      <div class="mb-16">
        <h1 class="text-4xl md:text-6xl font-display font-bold text-gray-900 mb-6 leading-tight">
          Explore All <span class="text-google-blue">Experiments</span>
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl">
          A comprehensive look at all the cutting-edge prototypes and experiments emerging from our Innovation Center.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($labs as $lab): ?>
          <div class="lab-card bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 group">
            <div class="relative h-64 overflow-hidden">
              <img src="<?php echo htmlspecialchars($lab['image_url'] ?? 'assets/images/default.jpg'); ?>" alt="<?php echo htmlspecialchars($lab['title']); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
              <div class="absolute inset-0 bg-gradient-to-t from-gray-900/40 to-transparent"></div>
              <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-google-blue border border-blue-100">
                 <?php echo htmlspecialchars($lab['type']); ?>
              </div>
            </div>
            <div class="p-8">
              <h4 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-google-blue transition-colors"><?php echo htmlspecialchars($lab['title']); ?></h4>
              <p class="text-gray-500 text-sm leading-relaxed mb-6 italic">
                  <?php echo htmlspecialchars($lab['description']); ?>
              </p>
              <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-widest">
                 <i data-lucide="cpu" class="w-4 h-4 text-google-blue"></i>
                 <?php echo htmlspecialchars($lab['technology']); ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>

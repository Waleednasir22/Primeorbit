<?php
require_once 'config/db.php';
$stmt = $pdo->query("SELECT * FROM services");
$services = $stmt->fetchAll();
?>

<!-- All Services Page -->
<section class="pt-32 pb-24 bg-gray-50 min-h-screen">
  <div class="container mx-auto px-6">
    <div class="max-w-7xl mx-auto">
      <a href="index.php?view=home#services" class="text-google-blue font-bold flex items-center gap-2 mb-12 hover:gap-3 transition-all">
        <i data-lucide="arrow-left" class="w-5 h-5"></i> Back to Home
      </a>

      <div class="mb-20 text-center md:text-left">
        <h1 class="text-5xl md:text-7xl font-display font-bold text-gray-900 mb-8 leading-tight">
          Our Full <span class="text-google-blue">Capabilities</span>
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl">
          Comprehensive technology solutions designed to help modern enterprises modernize, scale, and innovate with precision and security.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($services as $service): ?>
          <div class="group bg-white rounded-[2rem] p-10 shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 flex flex-col h-full">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center bg-gray-50 mb-8 group-hover:scale-110 transition-transform duration-300">
              <i data-lucide="<?php echo htmlspecialchars($service['icon_name']); ?>" class="w-10 h-10 <?php echo $service['color']; ?>"></i>
            </div>
            
            <h3 class="text-3xl font-bold mb-6 text-gray-900"><?php echo htmlspecialchars($service['title']); ?></h3>
            <p class="text-gray-600 leading-relaxed text-lg mb-10 flex-grow">
              <?php echo htmlspecialchars($service['description']); ?>
            </p>

            <button 
              onclick='window.openBookingModal(<?php echo json_encode($service["title"]); ?>, <?php echo json_encode($service["description"]); ?>)'
              class="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-base hover:bg-google-blue transition-all flex items-center justify-center gap-3 shadow-lg shadow-gray-200"
            >
              Book Consultation <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </button>
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

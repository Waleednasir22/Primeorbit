<?php
require_once 'config/db.php';
$stmt = $pdo->query("SELECT * FROM lab_experiments");
$labs = $stmt->fetchAll();
?>

<!-- Labs Section -->
<section id="labs" class="py-24 bg-gray-50 overflow-hidden relative">
  <div class="container mx-auto px-6">
    <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
      <div class="text-left">
        <span class="text-google-blue font-bold tracking-widest uppercase text-sm mb-2 block labs-header opacity-0 translate-y-10">Innovation Center</span>
        <h2 class="text-4xl md:text-6xl font-display font-bold mb-4 text-gray-900 labs-header opacity-0 translate-y-10">
          The <span class="text-google-blue">Labs</span>
        </h2>
        <p class="text-xl text-gray-600 max-w-xl labs-header opacity-0 translate-y-10">
          Where our engineers push the boundaries of what's possible on the web and beyond.
        </p>
      </div>
      <a href="index.php?view=explore-all" class="px-8 py-4 bg-gray-900 text-white rounded-full font-bold hover:bg-google-blue transition-all flex items-center gap-2 group labs-header opacity-0 translate-y-10">
        Explore All <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php foreach ($labs as $lab): ?>
        <div class="lab-card bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 opacity-0 translate-y-10 group">
          <div class="relative h-64 overflow-hidden">
            <img src="<?php echo $lab['image_url']; ?>" alt="<?php echo $lab['title']; ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy" decoding="async">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/40 to-transparent"></div>
            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-google-blue border border-blue-100">
               <?php echo $lab['type']; ?>
            </div>
          </div>
          <div class="p-8">
            <h4 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-google-blue transition-colors"><?php echo $lab['title']; ?></h4>
            <p class="text-gray-500 text-sm leading-relaxed mb-6 italic">
                <?php echo $lab['description']; ?>
            </p>
            <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-widest">
               <i data-lucide="cpu" class="w-4 h-4 text-google-blue"></i>
               <?php echo $lab['technology']; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        gsap.to(".labs-header", {
            scrollTrigger: { trigger: "#labs", start: "top 80%" },
            y: 0, opacity: 1, duration: 1, stagger: 0.1, ease: "power3.out"
        });
        gsap.to(".lab-card", {
            scrollTrigger: { trigger: "#labs", start: "top 70%" },
            y: 0, opacity: 1, duration: 0.8, stagger: 0.2, ease: "power2.out"
        });
        
        lucide.createIcons();
    });
</script>

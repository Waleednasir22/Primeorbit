<?php
require_once 'config/db.php';
$stmt = $pdo->query("SELECT * FROM projects");
$projects = $stmt->fetchAll();
?>

<!-- All Projects Page -->
<section class="pt-32 pb-24 bg-zinc-950 min-h-screen text-white">
  <div class="container mx-auto px-6">
    <div class="max-w-7xl mx-auto">
      <a href="index.php?view=home#projects" class="text-google-blue font-bold flex items-center gap-2 mb-12 hover:gap-3 transition-all">
        <i data-lucide="arrow-left" class="w-5 h-5"></i> Back to Home
      </a>

      <div class="mb-20">
        <h1 class="text-5xl md:text-8xl font-display font-bold mb-8 leading-tight tracking-tighter">
          Work <span class="text-google-blue">Portfolio</span>
        </h1>
        <p class="text-xl text-gray-400 max-w-3xl leading-relaxed">
          A deep dive into the engineering challenges we've solved and the digital platforms we've scaled for enterprises across the globe.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <?php foreach ($projects as $project): ?>
          <div class="group relative flex flex-col">
            <div class="relative aspect-video rounded-[2rem] overflow-hidden mb-8 border border-white/10">
              <img src="<?php echo htmlspecialchars($project['image_url']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700">
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
              <div class="absolute bottom-6 left-6">
                 <span class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest <?php echo $project['color']; ?>">
                   <?php echo htmlspecialchars($project['category']); ?>
                 </span>
              </div>
            </div>
            
            <div class="px-2">
                <h3 class="text-3xl font-bold mb-4 group-hover:text-google-blue transition-colors"><?php echo htmlspecialchars($project['title']); ?></h3>
                <p class="text-gray-400 text-lg leading-relaxed mb-8 max-w-xl">
                  <?php echo htmlspecialchars($project['description']); ?>
                </p>
                <div class="flex flex-wrap gap-4 items-center">
                    <a href="index.php?view=case-study&id=<?php echo $project['id']; ?>" class="flex items-center gap-2 font-bold text-sm uppercase tracking-widest hover:text-google-blue transition-colors">
                      View Case Study <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                    <?php if(!empty($project['website_url'])): ?>
                    <span class="w-1 h-1 bg-gray-700 rounded-full"></span>
                    <a href="<?php echo $project['website_url']; ?>" target="_blank" class="flex items-center gap-2 font-bold text-sm uppercase tracking-widest text-google-yellow hover:text-google-yellow/80 transition-colors">
                      Visit Site <i data-lucide="external-link" class="w-4 h-4"></i>
                    </a>
                    <?php endif; ?>
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

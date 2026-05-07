<?php
require_once 'config/db.php';

// Fetch articles from database
$stmt = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC");
$articles = $stmt->fetchAll();
?>

<!-- Blog Page -->
<section class="pt-32 pb-24 bg-white min-h-screen">
  <div class="container mx-auto px-6">
    <div class="text-center mb-16">
      <h1 class="text-5xl md:text-7xl font-display font-bold mb-6">Latest <span class="text-google-red">Insights</span></h1>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto italic">
        A deep dive into the intersection of technology, design, and humanity.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
      <?php foreach ($articles as $article): ?>
        <div class="group cursor-pointer">
          <a href="index.php?view=article&id=<?php echo $article['id']; ?>" class="block">
            <div class="relative rounded-3xl overflow-hidden aspect-[16/10] mb-6 shadow-lg">
              <img 
                src="<?php echo $article['image_url']; ?>" 
                alt="<?php echo $article['title']; ?>"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy" decoding="async" />
              <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest text-google-red">
                <?php echo $article['category']; ?>
              </div>
            </div>
            
            <div class="flex items-center gap-3 text-sm text-gray-500 mb-4">
              <span><?php echo $article['publish_date']; ?></span>
              <span>&bull;</span>
              <span><?php echo $article['read_time']; ?></span>
            </div>
            
            <h3 class="text-2xl font-bold text-gray-900 group-hover:text-google-red transition-colors mb-4 line-clamp-2">
              <?php echo $article['title']; ?>
            </h3>
            
            <p class="text-gray-600 mb-6 line-clamp-3">
              <?php echo $article['excerpt']; ?>
            </p>
            
            <div class="flex items-center gap-3">
              <img src="<?php echo $article['author_image']; ?>" class="w-10 h-10 rounded-full object-cover" loading="lazy" decoding="async">
              <div>
                <p class="text-sm font-bold text-gray-900"><?php echo $article['author_name']; ?></p>
                <p class="text-xs text-gray-500"><?php echo $article['author_role']; ?></p>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

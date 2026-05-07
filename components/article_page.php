<?php
require_once 'config/db.php';

// Fetch article by ID
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

if (!$article) {
    echo "Article not found.";
    return;
}
?>

<!-- Article Detail Page -->
<article class="pt-32 pb-24 bg-white min-h-screen">
  <div class="container mx-auto px-6 max-w-4xl">
    
    <div class="mb-12">
      <a href="index.php?view=blog" class="text-google-red font-bold flex items-center gap-2 mb-8 hover:gap-3 transition-all">
        ← Back to Insights
      </a>
      
      <div class="flex items-center gap-4 mb-4">
        <span class="bg-red-50 text-google-red px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest border border-red-100">
           <?php echo $article['category']; ?>
        </span>
        <span class="text-sm text-gray-500 font-medium"><?php echo $article['publish_date']; ?> • <?php echo $article['read_time']; ?></span>
      </div>
      
      <h1 class="text-4xl md:text-6xl font-display font-bold text-gray-900 mb-8 leading-tight">
        <?php echo $article['title']; ?>
      </h1>
      
      <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 w-fit">
        <img src="<?php echo $article['author_image']; ?>" class="w-12 h-12 rounded-full object-cover shadow-sm">
        <div>
          <p class="font-bold text-gray-900"><?php echo $article['author_name']; ?></p>
          <p class="text-sm text-gray-500"><?php echo $article['author_role']; ?></p>
        </div>
      </div>
    </div>

    <div class="rounded-[2rem] overflow-hidden mb-16 shadow-2xl shadow-gray-200">
      <img src="<?php echo $article['image_url']; ?>" class="w-full h-auto object-cover max-h-[600px]" alt="<?php echo $article['title']; ?>">
    </div>

    <div class="prose prose-xl prose-red mx-auto max-w-none">
      <div class="text-lg md:text-xl text-gray-600 leading-relaxed space-y-8">
        <?php echo $article['content']; ?>
      </div>
    </div>

    <div class="mt-20 pt-12 border-t border-gray-100">
      <h4 class="text-2xl font-bold mb-8">Share this article</h4>
      <div class="flex gap-4">
          <a href="#" class="p-3 bg-gray-50 rounded-2xl hover:bg-google-blue hover:text-white transition-all text-gray-600">
              <i data-lucide="linkedin" class="w-6 h-6"></i>
          </a>
          <a href="#" class="p-3 bg-gray-50 rounded-2xl hover:bg-sky-400 hover:text-white transition-all text-gray-600">
              <i data-lucide="twitter" class="w-6 h-6"></i>
          </a>
          <a href="#" class="p-3 bg-gray-50 rounded-2xl hover:bg-google-red hover:text-white transition-all text-gray-600">
              <i data-lucide="mail" class="w-6 h-6"></i>
          </a>
      </div>
    </div>
  </div>
</article>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>

<?php
require_once 'config/db.php';

// Fetch case study by ID
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM case_studies WHERE id = ?");
$stmt->execute([$id]);
$caseStudy = $stmt->fetch();

if (!$caseStudy) {
    echo "Case Study not found.";
    return;
}
?>

<!-- Case Study Detail Page -->
<section class="pt-32 pb-24 bg-white min-h-screen">
  <div class="container mx-auto px-6">
    <div class="max-w-5xl mx-auto">
      <a href="index.php?view=home#work" class="text-google-blue font-bold flex items-center gap-2 mb-12 hover:gap-3 transition-all">
        ← Back to Projects
      </a>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-24">
        <div>
          <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest text-white mb-6 inline-block <?php echo $caseStudy['color']; ?>">
            <?php echo $caseStudy['category']; ?>
          </span>
          <h1 class="text-4xl md:text-7xl font-display font-bold text-gray-900 mb-8 leading-tight">
            <?php echo $caseStudy['title']; ?>
          </h1>
          <p class="text-xl text-gray-600 mb-12 italic border-l-4 border-google-blue pl-6 leading-relaxed">
            "<?php echo $caseStudy['problem']; ?>"
          </p>
          
          <div class="grid grid-cols-3 gap-8">
            <?php 
            $metrics = json_decode($caseStudy['metrics'], true);
            if ($metrics) {
                foreach($metrics as $metric) {
                    echo '<div>
                        <p class="text-3xl font-bold text-gray-900 mb-1">'.$metric['value'].'</p>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">'.$metric['label'].'</p>
                    </div>';
                }
            }
            ?>
          </div>
        </div>
        
        <div class="relative rounded-[3rem] overflow-hidden shadow-2xl shadow-gray-200 aspect-[4/5]">
          <img src="<?php echo $caseStudy['image_url']; ?>" class="w-full h-full object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
        <div class="p-10 bg-gray-50 rounded-[3rem] border border-gray-100">
           <h3 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-3">
              <i data-lucide="zap" class="text-google-yellow w-6 h-6"></i> The Challenge
           </h3>
           <p class="text-lg text-gray-600 leading-relaxed">
             <?php echo $caseStudy['problem']; ?>
           </p>
        </div>

        <div class="p-10 bg-white rounded-[3rem] border border-google-blue/10 shadow-xl shadow-google-blue/5">
           <h3 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-3">
              <i data-lucide="shield-check" class="text-google-blue w-6 h-6"></i> The Solution
           </h3>
           <p class="text-lg text-gray-600 leading-relaxed">
             <?php echo $caseStudy['solution']; ?>
           </p>
        </div>
      </div>

      <div class="mt-16 p-10 bg-gray-900 text-white rounded-[3rem] text-center overflow-hidden relative">
         <div class="relative z-10">
           <h3 class="text-3xl font-display font-bold mb-6">The Result</h3>
           <p class="text-xl text-gray-300 max-w-2xl mx-auto italic">
             <?php echo $caseStudy['result']; ?>
           </p>
         </div>
         <i data-lucide="award" class="absolute -right-10 -bottom-10 w-64 h-64 text-white/5 transform -rotate-12"></i>
      </div>

    </div>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>

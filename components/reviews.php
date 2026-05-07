<?php
require_once 'config/db.php';

// Fetch approved reviews from database
$stmt = $pdo->query("SELECT * FROM reviews WHERE status = 'approved' ORDER BY created_at DESC");
$reviews = $stmt->fetchAll();

// Limit to a reasonable number of floating elements for clean "cloud" effect
$displayReviews = array_slice($reviews, 0, 10);
if(count($displayReviews) < 6 && count($reviews) > 0) {
    // Fill up with more reviews if available
    $displayReviews = array_merge($displayReviews, array_slice($reviews, 0, 6 - count($displayReviews)));
}

// Define some variety in colors for the pills
$styles = [
    ['bg' => 'bg-white', 'text' => 'text-gray-900'],
    ['bg' => 'bg-purple-600', 'text' => 'text-white'], 
    ['bg' => 'bg-pink-500', 'text' => 'text-white'],   
    ['bg' => 'bg-white', 'text' => 'text-gray-900'],   
];
?>

<!-- Reviews Section (Unified Floating Pill Design) -->
<section id="reviews" class="py-32 md:py-48 bg-[#fdfdfd] text-gray-900 relative overflow-hidden min-h-[750px] flex items-center justify-center">
  
  <!-- Central Content -->
  <div class="container mx-auto px-6 relative z-10 text-center max-w-4xl">
    <h2 class="text-4xl md:text-7xl font-display font-bold mb-8 leading-tight tracking-tight px-4">
      Discover <span class="text-google-blue">Community</span> - crafted <br />
      <span class="text-gray-400">Voices,</span> insights, <span class="text-black italic">and more</span>
    </h2>
    
    <div class="mt-12 flex justify-center">
        <button 
          id="open-review-modal"
          class="animated-border-btn group relative p-[2px] rounded-full overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-google-blue/20"
        >
          <!-- Animated Border Gradient -->
          <div class="absolute inset-[-1000%] animate-[spin_4s_linear_infinite] bg-[conic-gradient(from_90deg_at_50%_50%,#4285F4_0%,#EA4335_25%,#FBBC05_50%,#34A853_75%,#4285F4_100%)]"></div>
          
          <!-- Button Content -->
          <div class="relative flex items-center gap-3 px-8 py-4 bg-white text-gray-900 rounded-full font-bold transition-all group-hover:bg-gray-50">
            <i data-lucide="message-square-plus" class="w-5 h-5 text-google-blue"></i>
            Be part of the community
          </div>
        </button>
    </div>
  </div>

  <!-- Floating Cloud Container -->
  <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden">
    <?php 
    $positions = [
        ['t' => '12%', 'l' => '5%',   'mt' => '10%', 'ml' => '5%'],  
        ['t' => '22%', 'l' => '75%',  'mt' => '18%', 'ml' => '65%'],
        ['t' => '62%', 'l' => '2%',   'mt' => '72%', 'ml' => '2%'],  
        ['t' => '72%', 'l' => '82%',  'mt' => '82%', 'ml' => '60%'],
        ['t' => '8%',  'l' => '45%',  'mt' => '5%',  'ml' => '40%'], 
        ['t' => '82%', 'l' => '42%',  'mt' => '90%', 'ml' => '35%'],
        ['t' => '42%', 'l' => '12%',  'mt' => '35%', 'ml' => '5%'],  
        ['t' => '38%', 'l' => '82%',  'mt' => '55%', 'ml' => '65%'],
        ['t' => '18%', 'l' => '62%',  'mt' => '12%', 'ml' => '55%'], 
        ['t' => '46%', 'l' => '62%',  'mt' => '65%', 'ml' => '55%'],
    ];
    
    foreach ($displayReviews as $index => $review): 
        $pos = $positions[$index % count($positions)];
        $currStyle = $styles[$index % count($styles)];
        ?>
        <!-- Unified Pill Style with Avatar -->
        <div 
          class="review-floating-card absolute pointer-events-auto cursor-pointer px-4 py-2 md:px-5 md:py-2.5 rounded-full shadow-lg border border-gray-50 flex items-center gap-3 transition-transform hover:scale-105 z-20 <?php echo $currStyle['bg']; ?> <?php echo $currStyle['text']; ?>"
          style="--top: <?php echo $pos['t']; ?>; --left: <?php echo $pos['l']; ?>; --m-top: <?php echo $pos['mt']; ?>; --m-left: <?php echo $pos['ml']; ?>;"
        >
           <!-- Circular Avatar Image -->
           <div class="w-8 h-8 rounded-full overflow-hidden shrink-0 border-2 border-white/20 shadow-sm bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
             <?php if (!empty($review['author_image'])): ?>
                <img src="<?php echo htmlspecialchars($review['author_image']); ?>" alt="<?php echo htmlspecialchars($review['author']); ?>" class="w-full h-full object-cover" loading="lazy" decoding="async">
             <?php else: ?>
                <span class="text-[10px] font-bold text-gray-400"><?php echo strtoupper(substr($review['author'], 0, 1)); ?></span>
             <?php endif; ?>
           </div>
           
           <p class="text-xs font-medium truncate italic leading-none py-1">"<?php echo htmlspecialchars($review['feedback_text']); ?>"</p>
        </div>
    <?php endforeach; ?>
  </div>

  <style>
    /* Custom spacing and typography for this section */
    #reviews h2 {
      letter-spacing: -0.03em;
    }
    
    .review-floating-card {
        top: var(--top);
        left: var(--left);
        max-width: 280px;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
    }

    /* Ensure floating cards stay visible on small screens but rearranged */
    @media (max-width: 768px) {
      .review-floating-card {
        top: var(--m-top);
        left: var(--m-left);
        transform: scale(0.65);
        max-width: 180px;
      }
      #reviews h2 {
        font-size: 2.25rem;
        line-height: 1.1;
      }
    }
  </style>

  <!-- Review Submission Modal (Existing functionality preserved) -->
  <div id="review-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/40 backdrop-blur-md p-4">
    <div class="bg-white text-gray-900 w-full max-w-xl rounded-[2.5rem] p-10 relative shadow-2xl transition-all scale-95 opacity-0 duration-300 border border-gray-100" id="review-modal-content">
      <button id="close-review-modal" class="absolute top-8 right-8 text-gray-400 hover:text-google-red transition-colors">
          <i data-lucide="x" class="w-8 h-8"></i>
      </button>

      <h3 class="text-3xl font-display font-bold mb-2 tracking-tight">Post to <span class="text-google-blue">Community</span></h3>
      <p class="text-gray-500 mb-8">Your voice matters to us.</p>

      <form id="review-submission-form" class="space-y-5">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-2">
            <label class="text-sm font-bold text-gray-700 ml-1">Your Name</label>
            <input type="text" name="author" required placeholder="John Doe" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:border-google-blue outline-none transition-all">
          </div>
          <div class="space-y-2">
            <label class="text-sm font-bold text-gray-700 ml-1">Company / Team</label>
            <input type="text" name="company" required placeholder="Tech Corp" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:border-google-blue outline-none transition-all">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-2">
            <label class="text-sm font-bold text-gray-700 ml-1">Role / Position</label>
            <input type="text" name="role" required placeholder="CEO" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:border-google-blue outline-none transition-all">
          </div>
          <div class="space-y-2">
            <label class="text-sm font-bold text-gray-700 ml-1">Rating</label>
            <select name="rating" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:border-google-blue outline-none transition-all cursor-pointer">
              <option value="5">5 Stars ★★★★★</option>
              <option value="4">4 Stars ★★★★☆</option>
              <option value="3">3 Stars ★★★☆☆</option>
              <option value="2">2 Stars ★★☆☆☆</option>
              <option value="1">1 Star ★☆☆☆☆</option>
            </select>
          </div>
        </div>

        <div class="space-y-2">
          <label class="text-sm font-bold text-gray-700 ml-1">Your Feedback</label>
          <textarea name="feedback_text" required rows="4" placeholder="Briefly describe your experience" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:border-google-blue outline-none transition-all resize-none"></textarea>
        </div>

        <button type="submit" id="submit-btn" class="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-lg hover:bg-google-blue transition-all shadow-xl hover:shadow-google-blue/20 flex items-center justify-center gap-3">
          <span id="btn-text">Share Story</span>
          <i data-lucide="send" class="w-5 h-5"></i>
        </button>
      </form>
    </div>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Floating Drifting Animation using GSAP
        const floatingCards = document.querySelectorAll('.review-floating-card');
        floatingCards.forEach((card, index) => {
            // Random drifting values
            // Reduce drift distance on mobile
            const isMobile = window.innerWidth < 768;
            const multiplier = isMobile ? 0.4 : 1;
            
            const xDir = (index % 2 === 0 ? 1 : -1) * (15 + Math.random() * 25) * multiplier;
            const yDir = (index % 3 === 0 ? 1 : -1) * (15 + Math.random() * 25) * multiplier;
            const duration = 4 + Math.random() * 4;

            gsap.to(card, {
                x: xDir,
                y: yDir,
                duration: duration,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                delay: index * 0.2
            });
            
            // Interaction: Show full text on tooltip or similar if needed
            card.addEventListener('mouseenter', () => {
                gsap.pauseAll(); // Optional: pause everything on hover for reading
            });
            card.addEventListener('mouseleave', () => {
                gsap.resumeAll();
            });
        });

        // Modal Logic Preservation
        const modal = document.getElementById('review-modal');
        const modalContent = document.getElementById('review-modal-content');
        const openBtn = document.getElementById('open-review-modal');
        const closeBtn = document.getElementById('close-review-modal');

        const openModal = () => {
            modal.classList.replace('hidden', 'flex');
            setTimeout(() => {
                modalContent.classList.replace('scale-95', 'scale-100');
                modalContent.classList.replace('opacity-0', 'opacity-100');
            }, 10);
        };

        const closeModal = () => {
            modalContent.classList.replace('scale-100', 'scale-95');
            modalContent.classList.replace('opacity-100', 'opacity-0');
            setTimeout(() => modal.classList.replace('flex', 'hidden'), 300);
        };

        if(openBtn) openBtn.addEventListener('click', openModal);
        if(closeBtn) closeBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => e.target === modal && closeModal());

        // Form Submission Logic Preservation
        const form = document.getElementById('review-submission-form');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');

        if(form) {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                submitBtn.disabled = true;
                btnText.innerText = 'Sharing...';
                const formData = new FormData(form);
                try {
                    const response = await fetch('api/submit_review.php', { method: 'POST', body: formData });
                    const result = await response.json();
                    if (result.status === 'success') {
                        alert('Your story has been shared! Awaiting approval.');
                        form.reset();
                        closeModal();
                    } else { alert('Error: ' + result.message); }
                } catch (error) { alert('Connection error.'); } 
                finally { submitBtn.disabled = false; btnText.innerText = 'Share Story'; }
            });
        }

        if(typeof lucide !== 'undefined') lucide.createIcons();
    });
</script>

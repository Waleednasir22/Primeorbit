<?php
require_once 'config/db.php';
$stmt = $pdo->query("SELECT * FROM faqs");
$faqs = $stmt->fetchAll();
?>

<!-- FAQ Section -->
<section id="faq" class="py-24 bg-white relative overflow-hidden">
  <div class="container mx-auto px-6">
    <div class="text-center mb-20">
      <span class="text-google-yellow font-bold tracking-widest uppercase text-sm mb-2 block faq-header opacity-0 translate-y-10">Common Questions</span>
      <h2 class="text-4xl md:text-6xl font-display font-bold mb-4 text-gray-900 faq-header opacity-0 translate-y-10">
        Everything you <span class="text-google-yellow">Need to Know</span>
      </h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto faq-header opacity-0 translate-y-10">
        Transparent answers to the most common questions about our process, technology, and partnership model.
      </p>
    </div>

    <div class="max-w-3xl mx-auto space-y-4">
      <?php foreach ($faqs as $i => $faq): ?>
        <div class="faq-item group bg-gray-50 rounded-3xl border border-gray-100 overflow-hidden transition-all duration-300 hover:border-google-yellow opacity-0 translate-y-10">
          <button class="w-full p-8 flex items-center justify-between text-left focus:outline-none" onclick="toggleFaq(<?php echo $i; ?>)">
            <span class="text-lg md:text-xl font-bold text-gray-900 group-hover:text-google-yellow transition-colors"><?php echo $faq['question']; ?></span>
            <div class="faq-icon-<?php echo $i; ?> w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm border border-gray-100 group-hover:border-google-yellow group-hover:bg-google-yellow group-hover:text-white transition-all duration-300">
               <i data-lucide="plus" class="w-5 h-5 transition-transform duration-300"></i>
            </div>
          </button>
          <div id="faq-answer-<?php echo $i; ?>" class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
            <div class="px-8 pb-8 text-gray-600 leading-relaxed">
              <?php echo nl2br($faq['answer']); ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
    function toggleFaq(index) {
        const answer = document.getElementById(`faq-answer-${index}`);
        const iconContainer = document.querySelector(`.faq-icon-${index}`);
        const icon = iconContainer.querySelector('i');
        const allItems = document.querySelectorAll('[id^="faq-answer-"]');
        
        // Toggle current item
        if (answer.style.maxHeight) {
            answer.style.maxHeight = null;
            icon.style.transform = 'rotate(0deg)';
            iconContainer.classList.remove('bg-google-yellow', 'text-white');
            iconContainer.classList.add('bg-white', 'text-gray-900');
        } else {
            // Close others (Optional: comment out to allow multiple open)
            allItems.forEach((item, i) => {
                if (i !== index) {
                    item.style.maxHeight = null;
                    const otherIcon = document.querySelector(`.faq-icon-${i} i`);
                    if(otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                }
            });
            
            answer.style.maxHeight = answer.scrollHeight + "px";
            icon.style.transform = 'rotate(45deg)';
            iconContainer.classList.remove('bg-white', 'text-gray-900');
            iconContainer.classList.add('bg-google-yellow', 'text-white');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        gsap.to(".faq-header", {
            scrollTrigger: { trigger: "#faq", start: "top 80%" },
            y: 0, opacity: 1, duration: 1, stagger: 0.1, ease: "power3.out"
        });
        gsap.to(".faq-item", {
            scrollTrigger: { trigger: ".max-w-3xl", start: "top 80%" },
            y: 0, opacity: 1, duration: 0.8, stagger: 0.1, ease: "power2.out"
        });
        
        lucide.createIcons();
    });
</script>

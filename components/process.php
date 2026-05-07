<?php
require_once 'config/db.php';

// Fetch process steps from database
$stmt = $pdo->query("SELECT * FROM process_steps ORDER BY step_order ASC");
$processSteps = $stmt->fetchAll();
?>

<!-- Process Section -->
<section id="process" class="py-24 bg-zinc-950 text-white relative overflow-hidden">
  <div class="container mx-auto px-6 relative z-10">
    <div class="text-center mb-20">
      <span class="text-google-blue font-bold tracking-widest uppercase text-sm process-header opacity-0">How We Work</span>
      <h2 class="text-4xl md:text-5xl font-display font-bold mt-2 process-header opacity-0">
        The Process of <span class="text-transparent bg-clip-text bg-gradient-to-r from-google-blue via-google-red to-google-yellow">Perfection</span>
      </h2>
    </div>

    <div class="relative max-w-4xl mx-auto">
      <!-- Vertical Line Background -->
      <div class="absolute left-[20px] md:left-1/2 top-0 bottom-0 w-0.5 bg-zinc-800 -translate-x-1/2"></div>
      
      <!-- Animated Fill Line -->
      <div id="process-line" class="absolute left-[20px] md:left-1/2 top-0 w-0.5 bg-gradient-to-b from-google-blue via-google-red to-google-yellow -translate-x-1/2 origin-top"></div>

      <div class="space-y-12 md:space-y-24">
        <?php foreach ($processSteps as $index => $step): 
            $isEven = $index % 2 === 0;
        ?>
          <div class="process-step relative flex flex-col md:flex-row gap-8 items-start md:items-center <?php echo $isEven ? 'md:flex-row-reverse' : ''; ?>">
            
            <!-- Content Side -->
            <div class="w-full md:w-1/2 pl-12 md:pl-0 <?php echo $isEven ? 'md:pl-12 text-left' : 'md:pr-12 md:text-right'; ?>">
              <h3 class="text-2xl font-bold mb-2 <?php echo $step['text_class']; ?>"><?php echo $step['title']; ?></h3>
              <p class="text-gray-400 leading-relaxed"><?php echo $step['description']; ?></p>
            </div>

            <!-- Icon Center -->
            <div class="absolute left-0 md:left-1/2 -translate-x-1/2 w-10 h-10 rounded-full bg-zinc-900 border-4 border-zinc-950 shadow-xl flex items-center justify-center z-10">
              <div class="w-4 h-4 rounded-full <?php echo $step['color_class']; ?> animate-pulse"></div>
            </div>

            <!-- Empty Side for balance -->
            <div class="hidden md:block w-1/2"></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        gsap.registerPlugin(ScrollTrigger);

        // Animate the vertical line drawing down
        gsap.fromTo("#process-line", 
            { height: '0%' },
            {
                height: '100%',
                ease: "none",
                scrollTrigger: {
                    trigger: "#process",
                    start: "top center",
                    end: "bottom center",
                    scrub: 0.5
                }
            }
        );

        // Animate header
        gsap.to(".process-header", {
            scrollTrigger: { trigger: "#process", start: "top 80%" },
            opacity: 1, duration: 1, stagger: 0.2, ease: "power2.out"
        });

        // Animate steps appearing
        const steps = gsap.utils.toArray('.process-step');
        steps.forEach((step) => {
            gsap.from(step, {
                y: 50,
                opacity: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: step,
                    start: "top bottom-=100",
                    toggleActions: "play none none reverse"
                }
            });
        });
    });
</script>

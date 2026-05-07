<?php
require_once 'config/db.php';

// Fetch projects from database
$stmt = $pdo->query("SELECT * FROM projects");
$projects = $stmt->fetchAll();
$projectCount = count($projects);
$totalPanels = $projectCount + 1; // +1 for the intro panel
?>

<!-- Projects Section (Horizontal Scroll) -->
<section id="work" class="relative bg-black text-white overflow-hidden">
  <div id="project-slider" class="flex flex-col md:flex-row w-full md:w-[<?php echo $totalPanels * 100; ?>vw] h-auto md:h-screen">
    
    <!-- Intro Panel -->
    <div class="project-panel w-full md:w-screen h-screen md:h-screen flex items-center justify-center p-8 border-b md:border-b-0 md:border-r border-white/10 shrink-0">
      <div class="max-w-4xl">
         <h2 class="text-5xl md:text-8xl font-display font-bold mb-8">
           Enterprise <br/>
           <span class="text-google-yellow">Case Work</span>
         </h2>
         <p class="text-xl md:text-2xl text-gray-400 max-w-xl">
           A curated view of PrimeOrbit solutions across automation, platforms, commerce, healthcare, and operational transformation.
         </p>
         <div class="mt-8 md:hidden animate-bounce text-sm text-gray-500 uppercase tracking-widest">
           Navigate Down
         </div>
      </div>
    </div>

    <!-- Project Panels -->
    <?php foreach ($projects as $project): ?>
      <div class="project-panel w-full md:w-screen h-screen md:h-screen flex flex-col md:flex-row items-center justify-center p-8 md:p-24 relative border-b md:border-b-0 md:border-r border-white/10 bg-zinc-900 shrink-0">
        
        <div class="w-full md:w-1/2 flex flex-col justify-center z-10 mb-8 md:mb-0 order-2 md:order-1">
           <span class="inline-block px-4 py-2 rounded-full text-xs md:text-sm font-bold text-white mb-4 md:mb-6 w-fit <?php echo $project['color']; ?>">
             <?php echo $project['category']; ?>
           </span>
           <h3 class="text-4xl md:text-7xl font-display font-bold mb-4 md:mb-6">
             <?php echo $project['title']; ?>
           </h3>
           <p class="text-lg md:text-xl text-gray-300 mb-6 md:mb-8 max-w-md">
             <?php echo $project['description']; ?>
           </p>
           <div class="flex flex-col gap-3">
             <a href="index.php?view=case-study&id=<?php echo $project['id']; ?>" class="flex items-center gap-2 text-lg font-medium hover:text-google-blue transition-colors group w-fit">
               View Case Study 
               <i data-lucide="arrow-up-right" class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
             </a>
             
             <?php if (!empty($project['website_url'])): ?>
               <a href="<?php echo $project['website_url']; ?>" target="_blank" class="flex items-center gap-2 text-lg font-medium text-google-yellow hover:text-google-yellow/80 transition-colors group w-fit">
                 View Site 
                 <i data-lucide="external-link" class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
               </a>
             <?php endif; ?>
           </div>
        </div>

        <div class="w-full md:w-1/2 h-[40vh] md:h-full flex items-center justify-center relative order-1 md:order-2 mb-8 md:mb-0">
           <div class="relative w-full h-full max-h-[600px] overflow-hidden rounded-2xl group cursor-pointer">
             <img 
               src="<?php echo $project['image_url']; ?>" 
               alt="<?php echo $project['title']; ?>"
               class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
               loading="lazy"
               decoding="async"
             />
             <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
           </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Register ScrollTrigger if not already
        gsap.registerPlugin(ScrollTrigger);

        const slider = document.getElementById('project-slider');
        const panels = gsap.utils.toArray('.project-panel');
        
        const mm = gsap.matchMedia();

        mm.add("(min-width: 768px)", () => {
            // Desktop Horizontal Scroll
            gsap.to(panels, {
                xPercent: -100 * (panels.length - 1),
                ease: "none",
                scrollTrigger: {
                    trigger: "#work",
                    pin: true,
                    scrub: 1,
                    snap: 1 / (panels.length - 1),
                    end: () => "+=" + slider.offsetWidth
                }
            });
        });

        mm.add("(max-width: 767px)", () => {
            // Mobile: Reset panels for vertical stacking
            gsap.set(panels, { xPercent: 0 });
        });

        // Initialize Lucide Icons
        lucide.createIcons();
    });
</script>




<?php
require_once 'config/db.php';

// Fetch stats from database
$stmt = $pdo->query("SELECT * FROM company_stats");
$stats = $stmt->fetchAll();
?>

<!-- Company Scale Section -->
<section id="company-scale" class="relative py-32 bg-zinc-950 text-white overflow-hidden min-h-[80vh] flex items-center">
  
  <!-- Background Map Visual -->
  <div id="scale-map" class="absolute inset-0 opacity-20 pointer-events-none">
    <img 
      src="https://upload.wikimedia.org/wikipedia/commons/e/ec/World_map_blank_without_borders.svg" 
      alt="World Map" 
      class="w-full h-full object-cover filter invert"
    />
    <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent to-zinc-950"></div>
  </div>

  <div class="container mx-auto px-6 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      
      <div>
        <span class="text-google-blue font-bold tracking-widest uppercase text-sm mb-4 block scale-text opacity-0 translate-y-10">Global Impact</span>
        <h2 class="text-5xl md:text-7xl font-display font-bold mb-8 leading-tight scale-text opacity-0 translate-y-10">
          Scaling <br/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-google-blue via-google-red to-google-yellow">Horizons</span>
        </h2>
        <p class="text-xl text-gray-400 mb-8 max-w-lg leading-relaxed scale-text opacity-0 translate-y-10">
          From a small garage in Silicon Valley to a global powerhouse. We don't just build software; we build the infrastructure for the digital economy of tomorrow.
        </p>
        <div class="h-1 w-24 bg-google-blue rounded-full scale-text opacity-0 translate-y-10"></div>
      </div>

      <div class="grid grid-cols-2 gap-8">
        <?php foreach ($stats as $stat): ?>
          <div class="bg-white/5 backdrop-blur-sm border border-white/10 p-8 rounded-2xl hover:bg-white/10 transition-colors scale-text opacity-0 translate-y-10 group">
            <i data-lucide="<?php echo $stat['icon_name']; ?>" class="w-8 h-8 text-google-yellow mb-4 group-hover:scale-110 transition-transform"></i>
            <h3 class="text-4xl md:text-5xl font-bold font-display mb-2 counter" data-value="<?php echo $stat['value']; ?>" data-suffix="<?php echo $stat['suffix']; ?>">0</h3>
            <p class="text-gray-400 text-sm font-medium uppercase tracking-wider"><?php echo $stat['label']; ?></p>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        gsap.registerPlugin(ScrollTrigger);

        // Background Parallax
        gsap.to("#scale-map", {
            yPercent: 20,
            ease: "none",
            scrollTrigger: {
                trigger: "#company-scale",
                start: "top bottom",
                end: "bottom top",
                scrub: true
            }
        });

        // Stagger Text
        gsap.to(".scale-text", {
            y: 0,
            opacity: 1,
            stagger: 0.1,
            duration: 0.8,
            ease: "power3.out",
            scrollTrigger: {
                trigger: "#company-scale",
                start: "top center+=150"
            }
        });

        // Animate Counters
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-value'));
            const suffix = counter.getAttribute('data-suffix') || '';
            
            gsap.to(counter, {
                innerText: target,
                duration: 2,
                ease: "power2.out",
                snap: { innerText: 1 },
                scrollTrigger: {
                    trigger: "#company-scale",
                    start: "top center+=100",
                },
                onUpdate: function() {
                    counter.innerText = Math.ceil(this.targets()[0].innerText) + suffix;
                }
            });
        });

        lucide.createIcons();
    });
</script>

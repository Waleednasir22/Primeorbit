<!-- Showreel Section -->
<section id="showreel" class="relative h-[80vh] w-full overflow-hidden bg-black flex items-center justify-center group cursor-pointer">
  
  <!-- Background Media -->
  <div class="absolute inset-0 opacity-60">
    <img 
      src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?auto=format&fit=crop&q=80&w=2000" 
      alt="Showreel Background"
      class="w-full h-full object-cover scale-105 group-hover:scale-100 transition-transform duration-1000 ease-out"
    />
    <div class="absolute inset-0 bg-black/40"></div>
  </div>

  <!-- Content -->
  <div class="relative z-10 text-center text-white pointer-events-none">
    <h2 class="text-6xl md:text-9xl font-display font-bold tracking-tighter mix-blend-difference showreel-text opacity-0">
      SHOWREEL
    </h2>
    <p class="mt-4 text-xl md:text-2xl font-light tracking-widest uppercase opacity-80 showreel-text opacity-0">
      Experience the Impossible
    </p>
  </div>

  <!-- Video Modal -->
  <div id="video-modal" class="fixed inset-0 z-[100] bg-black hidden items-center justify-center cursor-default opacity-0">
     <button 
       id="close-video"
       class="absolute top-8 right-8 text-white hover:text-google-red transition-colors z-20 p-2 bg-white/10 rounded-full"
     >
       <i data-lucide="x" class="w-8 h-8"></i>
     </button>
     
     <div class="w-full h-full max-w-7xl max-h-[90vh] p-4 flex items-center justify-center">
       <div class="aspect-video bg-zinc-900 w-full rounded-lg flex items-center justify-center border border-zinc-800">
          <p class="text-zinc-500 font-display">Premium Showreel Content Integration</p>
       </div>
     </div>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const section = document.getElementById('showreel');
        const modal = document.getElementById('video-modal');
        const closeBtn = document.getElementById('close-video');

        // Click to Open Video
        section.addEventListener('click', () => {
            modal.style.display = 'flex';
            gsap.to(modal, {
                opacity: 1,
                duration: 0.5,
                ease: "power2.out"
            });
        });

        // Close Video
        closeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            gsap.to(modal, {
                opacity: 0,
                duration: 0.5,
                onComplete: () => {
                    modal.style.display = 'none';
                }
            });
        });

        // Animation
        gsap.to(".showreel-text", {
            scrollTrigger: {
                trigger: "#showreel",
                start: "top 80%"
            },
            opacity: 1,
            y: 0,
            duration: 1,
            stagger: 0.2,
            ease: "power3.out"
        });

        lucide.createIcons();
    });
</script>

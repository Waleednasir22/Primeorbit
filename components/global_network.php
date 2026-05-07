<!-- Global Network Section -->
<section id="global-network" class="py-32 bg-zinc-950 text-white relative overflow-hidden h-[90vh] flex items-center">
  
  <!-- 3D Background -->
  <div id="network-canvas-container" class="absolute inset-0 z-0 bg-black/40"></div>
  
  <!-- Overlay Gradient -->
  <div class="absolute inset-0 bg-gradient-to-r from-zinc-950 via-zinc-950/80 to-transparent pointer-events-none z-10"></div>

  <div class="container mx-auto px-6 relative z-20">
    <div class="max-w-2xl">
      <div class="flex items-center gap-2 mb-6 network-text opacity-0 translate-y-10">
        <div class="w-2 h-2 rounded-full bg-google-blue animate-pulse"></div>
        <span class="text-google-blue font-bold tracking-[0.2em] uppercase text-xs">System Online</span>
      </div>
      
      <h2 class="text-5xl md:text-8xl font-display font-bold mb-8 leading-tight network-text opacity-0 translate-y-10">
        Global <br/>
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-600">Intelligence</span>
      </h2>
      
      <p class="text-xl text-gray-400 leading-relaxed mb-10 border-l-2 border-google-blue pl-6 network-text opacity-0 translate-y-10">
        Operating a decentralized network of nodes across 42 countries. 
        We leverage distributed computing to deliver low-latency experiences anywhere on Earth.
      </p>

      <div class="grid grid-cols-2 gap-8 network-text opacity-0 translate-y-10">
        <div>
          <p class="text-4xl font-bold font-display text-white mb-1">24/7</p>
          <p class="text-xs text-gray-500 uppercase tracking-wider">Uptime Monitor</p>
        </div>
        <div>
          <p class="text-4xl font-bold font-display text-white mb-1">50ms</p>
          <p class="text-xs text-gray-500 uppercase tracking-wider">Avg Latency</p>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="assets/js/network-scene.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        gsap.to(".network-text", {
            scrollTrigger: {
                trigger: "#global-network",
                start: "top center+=100",
            },
            y: 0,
            opacity: 1,
            duration: 1,
            stagger: 0.2,
            ease: "power3.out"
        });
    });
</script>

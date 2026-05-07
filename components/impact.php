<!-- Impact & Scale Section -->
<section id="impact" class="relative py-32 bg-[#04010c] overflow-hidden text-white cursor-default">
  
  <!-- Dynamic Mesh Gradients Background -->
  <div class="absolute inset-0 pointer-events-none overflow-hidden">
    <!-- Orbital Rings -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] rounded-full border border-white/5 animate-[spin_60s_linear_infinite]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full border border-white/5 animate-[spin_40s_linear_infinite_reverse]"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[1000px] h-[1000px] rounded-full border border-white/5 animate-[spin_80s_linear_infinite]"></div>
    
    <!-- Glow Blobs -->
    <div class="absolute w-[600px] h-[600px] bg-google-blue/15 rounded-full blur-[120px] -top-[10%] -right-[10%] mix-blend-screen"></div>
    <div class="absolute w-[500px] h-[500px] bg-purple-600/15 rounded-full blur-[120px] bottom-[-10%] left-[-10%] mix-blend-screen"></div>
    <div class="absolute w-[400px] h-[400px] bg-google-red/10 rounded-full blur-[100px] top-[40%] left-[40%] mix-blend-screen"></div>
  </div>
  
  <div class="container mx-auto px-6 relative z-10">
    <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
      <div class="text-left">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-md mb-6 impact-anim translate-y-10 opacity-0">
          <div class="w-2 h-2 rounded-full bg-google-blue animate-pulse"></div>
          <span class="text-white/80 text-xs font-semibold tracking-widest uppercase">Global Footprint</span>
        </div>
        <h2 class="text-[clamp(2.5rem,5vw,4.5rem)] font-display font-bold mb-4 impact-anim translate-y-10 opacity-0 leading-tight">
          Quantifying <span class="text-transparent bg-clip-text bg-gradient-to-r from-google-blue via-purple-400 to-google-red">Success</span> & Scale
        </h2>
        <p class="text-xl text-gray-400 max-w-2xl impact-anim translate-y-10 opacity-0 font-light">
          Metrics that define the performance, scope, and engineering excellence embedded into every digital ecosystem I architect.
        </p>
      </div>
    </div>

    <!-- Interactive Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      
      <!-- Stat 1 -->
      <div class="stat-card group relative bg-[#0a0710]/80 backdrop-blur-xl border border-white/10 p-8 rounded-3xl hover:border-google-blue/50 transition-all duration-500 overflow-hidden transform-gpu hover:-translate-y-2 opacity-0 translate-y-10">
        <div class="absolute inset-0 bg-gradient-to-br from-google-blue/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative z-10">
          <div class="w-14 h-14 rounded-2xl bg-google-blue/10 flex items-center justify-center mb-12 border border-google-blue/20 group-hover:scale-110 transition-transform duration-500">
            <i data-lucide="code-2" class="text-google-blue w-6 h-6"></i>
          </div>
          <div class="flex items-baseline gap-1 mb-2">
            <h3 class="text-6xl font-display font-bold text-white stat-number tracking-tighter" data-target="1.5">0</h3>
            <span class="text-3xl font-display font-bold text-google-blue">M+</span>
          </div>
          <p class="text-gray-400 text-sm tracking-wider uppercase font-medium group-hover:text-gray-300 transition-colors">Lines of Code Deployed</p>
        </div>
      </div>

      <!-- Stat 2 -->
      <div class="stat-card group relative bg-[#0a0710]/80 backdrop-blur-xl border border-white/10 p-8 rounded-3xl hover:border-purple-500/50 transition-all duration-500 overflow-hidden transform-gpu hover:-translate-y-2 opacity-0 translate-y-10">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative z-10">
          <div class="w-14 h-14 rounded-2xl bg-purple-500/10 flex items-center justify-center mb-12 border border-purple-500/20 group-hover:scale-110 transition-transform duration-500">
            <i data-lucide="users" class="text-purple-400 w-6 h-6"></i>
          </div>
          <div class="flex items-baseline gap-1 mb-2">
            <h3 class="text-6xl font-display font-bold text-white stat-number tracking-tighter" data-target="250">0</h3>
            <span class="text-3xl font-display font-bold text-purple-400">K+</span>
          </div>
          <p class="text-gray-400 text-sm tracking-wider uppercase font-medium group-hover:text-gray-300 transition-colors">Global Active Users</p>
        </div>
      </div>

      <!-- Stat 3 -->
      <div class="stat-card group relative bg-[#0a0710]/80 backdrop-blur-xl border border-white/10 p-8 rounded-3xl hover:border-google-green/50 transition-all duration-500 overflow-hidden transform-gpu hover:-translate-y-2 opacity-0 translate-y-10">
        <div class="absolute inset-0 bg-gradient-to-br from-google-green/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative z-10">
          <div class="w-14 h-14 rounded-2xl bg-google-green/10 flex items-center justify-center mb-12 border border-google-green/20 group-hover:scale-110 transition-transform duration-500">
            <i data-lucide="activity" class="text-google-green w-6 h-6"></i>
          </div>
          <div class="flex items-baseline gap-1 mb-2">
            <h3 class="text-6xl font-display font-bold text-white stat-number tracking-tighter" data-target="99.9">0</h3>
            <span class="text-3xl font-display font-bold text-google-green">%</span>
          </div>
          <p class="text-gray-400 text-sm tracking-wider uppercase font-medium group-hover:text-gray-300 transition-colors">System Uptime Guarantee</p>
        </div>
      </div>

      <!-- Stat 4 -->
      <div class="stat-card group relative bg-[#0a0710]/80 backdrop-blur-xl border border-white/10 p-8 rounded-3xl hover:border-google-red/50 transition-all duration-500 overflow-hidden transform-gpu hover:-translate-y-2 opacity-0 translate-y-10">
        <div class="absolute inset-0 bg-gradient-to-br from-google-red/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative z-10">
          <div class="w-14 h-14 rounded-2xl bg-google-red/10 flex items-center justify-center mb-12 border border-google-red/20 group-hover:scale-110 transition-transform duration-500">
            <i data-lucide="award" class="text-google-red w-6 h-6"></i>
          </div>
          <div class="flex items-baseline gap-1 mb-2">
            <h3 class="text-6xl font-display font-bold text-white stat-number tracking-tighter" data-target="45">0</h3>
            <span class="text-3xl font-display font-bold text-google-red">+</span>
          </div>
          <p class="text-gray-400 text-sm tracking-wider uppercase font-medium group-hover:text-gray-300 transition-colors">Enterprise Systems Shipped</p>
        </div>
      </div>

    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Header sequence
    gsap.to(".impact-anim", {
        scrollTrigger: {
            trigger: "#impact",
            start: "top 80%"
        },
        y: 0,
        opacity: 1,
        duration: 1,
        stagger: 0.15,
        ease: "power4.out"
    });

    // Staggered Card Entrance
    gsap.to(".stat-card", {
        scrollTrigger: {
            trigger: "#impact",
            start: "top 70%"
        },
        y: 0,
        opacity: 1,
        duration: 0.8,
        stagger: 0.15,
        ease: "back.out(1.4)"
    });

    // Animated Counting Logic
    const statCards = document.querySelectorAll('.stat-card');
    
    statCards.forEach((card) => {
        let obj = { val: 0 };
        let numElement = card.querySelector('.stat-number');
        let targetValue = parseFloat(numElement.getAttribute('data-target'));
        let isFloat = targetValue % 1 !== 0;

        gsap.to(obj, {
            scrollTrigger: {
                trigger: card,
                start: "top 85%"
            },
            val: targetValue,
            duration: 2.5,
            ease: "power2.out",
            onUpdate: function() {
                numElement.innerText = isFloat ? obj.val.toFixed(1) : Math.floor(obj.val);
            }
        });
    });

    lucide.createIcons();
});
</script>

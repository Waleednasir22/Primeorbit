<?php
// Custom App Generation Component
// This component uses dynamic nodes that can be stored in the database later if needed.
$nodes = [
  ['id' => 1, 'text' => "Create an app that recommends which products I need to reorder.", 'x' => 20, 'y' => 55, 'icon' => 'bot', 'color' => 'bg-purple-50', 'text_color' => 'text-purple-600', 'connectsTo' => [3]],
  ['id' => 2, 'text' => "Create an app that checks returns and cancellation eligibility for orders.", 'x' => 45, 'y' => 40, 'icon' => 'file-text', 'color' => 'bg-orange-50', 'text_color' => 'text-orange-600', 'connectsTo' => [3]],
  ['id' => 3, 'text' => "Create an event prep app that generates discounted checkout links for selected products.", 'x' => 75, 'y' => 30, 'icon' => 'sparkles', 'color' => 'bg-blue-50', 'text_color' => 'text-blue-600', 'connectsTo' => []],
  ['id' => 4, 'text' => "Create a bulk B2B company importer that uploads companies from a CSV file.", 'x' => 70, 'y' => 65, 'icon' => 'user', 'color' => 'bg-green-50', 'text_color' => 'text-green-600', 'connectsTo' => [3]],
  ['id' => 5, 'text' => "Create a task tracker for my whole team.", 'x' => 40, 'y' => 75, 'icon' => 'bot', 'color' => 'bg-gray-50', 'text_color' => 'text-gray-600', 'connectsTo' => [2, 4]]
];
?>

<!-- Custom App Gen Section -->
<section id="custom-app-gen" class="relative py-32 bg-[#E6E5E0] overflow-hidden min-h-[90vh] flex flex-col justify-center">
  
  <!-- Background Grid Pattern -->
  <div class="absolute inset-0 pointer-events-none opacity-50" style="background-image: radial-gradient(#CFCFC9 1px, transparent 1px); background-size: 40px 40px;"></div>

  <div class="container mx-auto px-6 relative z-20 pointer-events-none">
    
    <!-- Text Content -->
    <div id="app-gen-header" class="max-w-xl mb-12 pointer-events-auto transition-all duration-500">
      <h3 class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-4">Custom App Generation</h3>
      <h2 class="text-4xl md:text-6xl font-display font-bold text-gray-900 mb-6 leading-[1.1]">
        Get <span class="text-google-blue">Sidekick</span> to build custom apps designed specifically for your needs.
      </h2>
      <button class="group flex items-center gap-2 px-6 py-3 bg-white border border-gray-300 rounded-xl text-gray-900 font-medium hover:bg-gray-50 transition-colors shadow-sm">
        Explore Capabilities
        <i data-lucide="arrow-up-right" class="w-4 h-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
      </button>
    </div>

  </div>

  <!-- Floating Cards Container (Desktop Only) -->
  <div class="absolute inset-0 w-full h-full z-10 hidden md:block" id="nodes-container">
    <!-- Connection Lines (SVG) -->
    <svg id="connection-lines" class="absolute inset-0 w-full h-full opacity-30 pointer-events-none transition-opacity duration-500">
      <?php foreach ($nodes as $node): ?>
        <?php foreach ($node['connectsTo'] as $targetId): 
            $target = null;
            foreach ($nodes as $n) { if ($n['id'] == $targetId) { $target = $n; break; } }
            if (!$target) continue;
        ?>
          <line 
            x1="<?php echo $node['x']; ?>%" 
            y1="<?php echo $node['y']; ?>%" 
            x2="<?php echo $target['x']; ?>%" 
            y2="<?php echo $target['y']; ?>%" 
            stroke="#9CA3AF" 
            stroke-width="2" 
            stroke-dasharray="5,5"
          />
        <?php endforeach; ?>
      <?php endforeach; ?>
    </svg>

    <!-- Nodes -->
    <?php foreach ($nodes as $node): ?>
      <div
        class="floating-node absolute p-6 bg-white/90 backdrop-blur-md rounded-2xl shadow-xl border border-white/50 w-72 pointer-events-auto cursor-pointer transition-all duration-300"
        data-id="<?php echo $node['id']; ?>"
        style="left: <?php echo $node['x']; ?>%; top: <?php echo $node['y']; ?>%; transform: translate(-50%, -50%);"
      >
        <div class="flex justify-between items-start mb-4">
          <div class="p-2 rounded-lg <?php echo $node['color']; ?> <?php echo $node['text_color']; ?> node-icon transition-transform duration-300">
            <i data-lucide="<?php echo $node['icon']; ?>" class="w-5 h-5"></i>
          </div>
          <div class="p-1 rounded-full bg-gray-100 text-gray-400 node-arrow transition-colors">
            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
          </div>
        </div>
        <p class="text-gray-700 font-medium leading-relaxed text-sm node-text transition-all duration-300">
          <?php echo $node['text']; ?>
        </p>
        
        <!-- Interactive Content -->
        <div class="node-expanded max-h-0 opacity-0 overflow-hidden transition-all duration-500">
          <div class="mt-4 pt-4 border-t border-gray-100">
            <div class="flex items-center gap-2 mb-3">
                <div class="h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ready to Build</span>
            </div>
            <button class="generate-btn w-full py-2.5 bg-google-blue text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-200 hover:bg-blue-600 transition-all active:scale-95 flex items-center justify-center gap-2">
               Generate App <i data-lucide="sparkles" class="w-4 h-4"></i>
            </button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Mobile Grid View -->
  <div class="md:hidden px-6 grid gap-4 pointer-events-auto mt-8">
     <?php foreach (array_slice($nodes, 0, 3) as $node): ?>
       <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
          <div class="flex items-center gap-3 mb-3">
             <div class="p-2 rounded-lg <?php echo $node['color']; ?> <?php echo $node['text_color']; ?>">
                <i data-lucide="<?php echo $node['icon']; ?>" class="w-5 h-5"></i>
             </div>
             <i data-lucide="arrow-up-right" class="w-4 h-4 text-gray-400 ml-auto"></i>
          </div>
          <p class="text-gray-700 text-sm font-medium"><?php echo $node['text']; ?></p>
       </div>
     <?php endforeach; ?>
  </div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nodes = document.querySelectorAll('.floating-node');
        const header = document.getElementById('app-gen-header');
        const lines = document.getElementById('connection-lines');
        let focusedId = null;

        // Floating Animation
        nodes.forEach((node, i) => {
            gsap.to(node, {
                y: "random(-10, 10)",
                rotation: "random(-2, 2)",
                duration: "random(2, 4)",
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                delay: i * 0.2
            });
        });

        // Mouse Parallax
        window.addEventListener('mousemove', (e) => {
            if (focusedId) return;
            const relX = (e.clientX / window.innerWidth) - 0.5;
            const relY = (e.clientY / window.innerHeight) - 0.5;

            nodes.forEach((node, i) => {
                gsap.to(node, {
                    x: relX * 40 * ((i % 3) + 1),
                    y: relY * 40 * ((i % 2) + 1),
                    duration: 1,
                    ease: "power2.out",
                    overwrite: "auto"
                });
            });
        });

        // Node Interaction
        nodes.forEach(node => {
            node.addEventListener('click', (e) => {
                e.stopPropagation();
                const id = node.getAttribute('data-id');

                if (focusedId === id) {
                    resetNodes();
                } else {
                    focusNode(node, id);
                }
            });
        });

        document.getElementById('custom-app-gen').addEventListener('click', resetNodes);

        function focusNode(node, id) {
            focusedId = id;
            nodes.forEach(n => {
                if (n === node) {
                    gsap.to(n, {
                        scale: 1.15,
                        y: -40,
                        zIndex: 50,
                        opacity: 1,
                        filter: "blur(0px)",
                        rotation: 0,
                        boxShadow: "0 25px 60px -12px rgba(66, 133, 244, 0.4)",
                        duration: 0.6,
                        ease: "back.out(1.2)",
                        overwrite: true
                    });
                    n.querySelector('.node-expanded').style.maxHeight = '200px';
                    n.querySelector('.node-expanded').style.opacity = '1';
                    n.querySelector('.node-text').classList.add('text-base', 'font-bold');
                } else {
                    gsap.to(n, {
                        scale: 0.9,
                        opacity: 0.3,
                        filter: "blur(3px)",
                        duration: 0.5,
                        overwrite: true
                    });
                }
            });
            gsap.to(header, { opacity: 0.2, filter: "blur(2px)", duration: 0.5 });
            gsap.to(lines, { opacity: 0, duration: 0.3 });
        }

        function resetNodes() {
            focusedId = null;
            nodes.forEach(n => {
                gsap.to(n, {
                    scale: 1,
                    opacity: 1,
                    filter: "blur(0px)",
                    zIndex: 10,
                    y: 0,
                    x: 0,
                    rotation: 0,
                    boxShadow: "0 20px 25px -5px rgba(0, 0, 0, 0.1)",
                    duration: 0.5,
                    ease: "power2.out",
                    overwrite: true
                });
                n.querySelector('.node-expanded').style.maxHeight = '0';
                n.querySelector('.node-expanded').style.opacity = '0';
                n.querySelector('.node-text').classList.remove('text-base', 'font-bold');
            });
            gsap.to(header, { opacity: 1, filter: "blur(0px)", duration: 0.5 });
            gsap.to(lines, { opacity: 0.3, duration: 0.5 });
        }

        // Generate Button Logic
        document.querySelectorAll('.generate-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const originalContent = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = 'Building <i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i>';
                lucide.createIcons();
                
                setTimeout(() => {
                    btn.innerHTML = 'Completed <i data-lucide="check" class="w-4 h-4"></i>';
                    btn.classList.replace('bg-google-blue', 'bg-google-green');
                    lucide.createIcons();
                    setTimeout(() => {
                        resetNodes();
                        setTimeout(() => {
                            btn.innerHTML = originalContent;
                            btn.classList.replace('bg-google-green', 'bg-google-blue');
                            btn.disabled = false;
                            lucide.createIcons();
                        }, 500);
                    }, 1000);
                }, 2000);
            });
        });

        lucide.createIcons();
    });
</script>

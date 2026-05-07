<!-- Experience Component -->
<section id="experience" class="py-24 bg-gray-50 relative overflow-hidden">
  <!-- Architectural Background Effects -->
  <div class="absolute inset-0 z-0 pointer-events-none opacity-30">
    <div class="absolute inset-0" style="background-image: linear-gradient(#e5e7eb 1px, transparent 1px), linear-gradient(90deg, #e5e7eb 1px, transparent 1px); background-size: 100px 100px;"></div>
    <div class="exp-beam beam-1 absolute top-[20%] -left-full w-full h-[2px] bg-gradient-to-r from-transparent via-google-green to-transparent opacity-20"></div>
    <div class="exp-beam beam-2 absolute top-[60%] -right-full w-full h-[2px] bg-gradient-to-r from-transparent via-google-blue to-transparent opacity-20"></div>
  </div>

  <div class="container mx-auto px-6 relative z-10">
    <div class="text-center mb-20">
      <span class="text-google-green font-bold tracking-widest uppercase text-sm mb-2 block exp-header opacity-0 translate-y-10">Delivery Track Record</span>
      <h2 class="text-4xl md:text-6xl font-display font-bold mb-4 text-gray-900 exp-header opacity-0 translate-y-10">
        Corporate <span class="text-google-green">Milestones</span>
      </h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto exp-header opacity-0 translate-y-10">
        A snapshot of how PrimeOrbit delivers enterprise platforms, automation, and digital transformation programs.
      </p>
    </div>

    <div class="max-w-4xl mx-auto relative px-4">
      <!-- Vertical Line -->
      <div class="timeline-line absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-px bg-gray-200 hidden md:block"></div>

      <div class="space-y-12 relative">
        <?php
        $experience = [
          [
            'title' => 'Enterprise Platform Delivery',
            'company' => 'PrimeOrbit Core Team',
            'period' => '2022 - Present',
            'desc' => 'Leading secure platform modernization, cloud migration, and automation programs for growth-focused organizations.',
            'color' => 'google-blue',
            'side' => 'left'
          ],
          [
            'title' => 'Automation & Integration',
            'company' => 'Operations Engineering',
            'period' => '2020 - 2022',
            'desc' => 'Built scalable integrations, internal tools, and data workflows that reduced manual work and improved operational visibility.',
            'color' => 'google-red',
            'side' => 'right'
          ],
          [
            'title' => 'Experience Systems',
            'company' => 'Product Design Unit',
            'period' => '2018 - 2020',
            'desc' => 'Translated complex business processes into clear dashboards, portals, and customer-facing digital experiences.',
            'color' => 'google-yellow',
            'side' => 'left'
          ],
          [
            'title' => 'Launch & Growth Enablement',
            'company' => 'Client Success Studio',
            'period' => '2016 - 2018',
            'desc' => 'Supported launches with performance tuning, analytics, iteration cycles, and long-term technical support.',
            'color' => 'google-green',
            'side' => 'right'
          ]
        ];

        foreach ($experience as $index => $exp):
          $isLeft = $exp['side'] === 'left';
        ?>
          <div class="exp-item flex flex-col md:flex-row items-center gap-8 relative opacity-0 translate-y-20">
            <!-- Content Left -->
            <div class="w-full md:w-1/2 <?php echo $isLeft ? 'md:text-right' : 'md:order-last'; ?>">
              <div class="bg-white p-10 rounded-[32px] shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500">
                <span class="text-xs font-bold text-<?php echo $exp['color']; ?> uppercase tracking-widest mb-2 block"><?php echo $exp['period']; ?></span>
                <h3 class="text-2xl font-display font-bold text-gray-900 mb-2"><?php echo $exp['title']; ?></h3>
                <p class="font-bold text-gray-400 mb-4"><?php echo $exp['company']; ?></p>
                <p class="text-gray-500 leading-relaxed"><?php echo $exp['desc']; ?></p>
              </div>
            </div>

            <!-- Central Dot -->
            <div class="w-6 h-6 rounded-full bg-white border-4 border-<?php echo $exp['color']; ?> z-10 hidden md:block absolute left-1/2 -translate-x-1/2"></div>

            <!-- Spacer for the other side -->
            <div class="w-full md:w-1/2 hidden md:block"></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        gsap.to(".exp-header", {
            scrollTrigger: { 
                trigger: "#experience", 
                start: "top 80%",
                toggleActions: "play reverse play reverse"
            },
            y: 0, opacity: 1, duration: 1, stagger: 0.1, ease: "power3.out"
        });
        
        gsap.to(".exp-item", {
            scrollTrigger: { 
                trigger: "#experience", 
                start: "top 60%",
                toggleActions: "play reverse play reverse"
            },
            y: 0, opacity: 1, duration: 1, stagger: 0.2, ease: "power2.out"
        });

        gsap.from(".timeline-line", {
            scrollTrigger: {
                trigger: "#experience",
                start: "top center",
                end: "bottom center",
                scrub: true
            },
            scaleY: 0,
            transformOrigin: "top"
        });

        // Beam Animations
        gsap.to(".beam-1", {
            left: "100%", duration: 8, repeat: -1, ease: "none"
        });
        gsap.to(".beam-2", {
            right: "100%", duration: 10, repeat: -1, ease: "none", delay: 2
        });
        
        lucide.createIcons();
    });
</script>


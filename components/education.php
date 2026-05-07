<!-- Education (Qualification) Component -->
<section id="education" class="py-24 bg-white relative overflow-hidden">
  <!-- Architectural Background Effects -->
  <div class="absolute inset-0 z-0 pointer-events-none opacity-20">
    <div class="absolute inset-0" style="background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 30px 30px;"></div>
  </div>

  <div class="container mx-auto px-6 relative z-10">
    <div class="text-center mb-20">
      <span class="text-google-yellow font-bold tracking-widest uppercase text-sm mb-2 block edu-header opacity-0 translate-y-10">Capability Foundation</span>
      <h2 class="text-4xl md:text-6xl font-display font-bold mb-4 text-gray-900 edu-header opacity-0 translate-y-10">
        Enterprise <span class="text-google-yellow">Capabilities</span>
      </h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto edu-header opacity-0 translate-y-10">
        The operating disciplines behind PrimeOrbit delivery: architecture, governance, security, and product execution.
      </p>
    </div>

    <div class="max-w-4xl mx-auto relative px-4">
      <!-- Vertical Line -->
      <div class="edu-timeline-line absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-px bg-gray-100 hidden md:block"></div>

      <div class="space-y-16 relative">
        <?php
        $education = [
          [
            'qualification' => 'Cloud-Native Engineering',
            'institution' => 'PrimeOrbit Delivery Practice',
            'period' => '2023 - Present',
            'desc' => 'Designing resilient platforms, modern APIs, automation pipelines, and secure application ecosystems for business-critical operations.',
            'color' => 'google-blue',
            'side' => 'left'
          ],
          [
            'qualification' => 'Product Strategy & Governance',
            'institution' => 'PrimeOrbit Advisory Practice',
            'period' => '2020 - 2022',
            'desc' => 'Aligning business requirements, delivery roadmaps, risk controls, and measurable outcomes before engineering execution begins.',
            'color' => 'google-red',
            'side' => 'right'
          ]
        ];

        foreach ($education as $index => $edu):
          $isLeft = $edu['side'] === 'left';
        ?>
          <div class="edu-item flex flex-col md:flex-row items-center gap-12 relative opacity-0 translate-y-20">
            <!-- Content Left -->
            <div class="w-full md:w-1/2 <?php echo $isLeft ? 'md:text-right' : 'md:order-last'; ?>">
              <div class="group bg-gray-50/50 p-10 rounded-[32px] border border-gray-100 hover:border-google-yellow/30 hover:bg-white hover:shadow-2xl transition-all duration-500 relative">
                <!-- Decorative Accent -->
                <div class="absolute top-0 <?php echo $isLeft ? 'right-0' : 'left-0'; ?> w-24 h-24 bg-gradient-to-br from-<?php echo $edu['color']; ?>/5 to-transparent rounded-full -translate-y-12 translate-x-12 blur-2xl group-hover:opacity-100 opacity-0 transition-opacity"></div>
                
                <span class="text-xs font-bold text-<?php echo $edu['color']; ?> uppercase tracking-widest mb-3 block"><?php echo $edu['period']; ?></span>
                <h3 class="text-3xl font-display font-bold text-gray-900 mb-2 group-hover:text-google-yellow transition-colors"><?php echo $edu['qualification']; ?></h3>
                <p class="font-bold text-gray-400 mb-6 flex items-center gap-2 <?php echo $isLeft ? 'justify-end' : ''; ?>">
                   <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                   <?php echo $edu['institution']; ?>
                </p>
                <p class="text-gray-500 leading-relaxed text-lg"><?php echo $edu['desc']; ?></p>
              </div>
            </div>

            <!-- Central Dot -->
            <div class="w-10 h-10 rounded-full bg-white shadow-xl flex items-center justify-center z-10 hidden md:flex absolute left-1/2 -translate-x-1/2 border-2 border-gray-100">
               <div class="w-4 h-4 rounded-full bg-<?php echo $edu['color']; ?>"></div>
            </div>

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
        gsap.to(".edu-header", {
            scrollTrigger: { 
                trigger: "#education", 
                start: "top 85%",
                toggleActions: "play reverse play reverse"
            },
            y: 0, opacity: 1, duration: 1, stagger: 0.1, ease: "power3.out"
        });
        
        gsap.to(".edu-item", {
            scrollTrigger: { 
                trigger: "#education", 
                start: "top 70%",
                toggleActions: "play reverse play reverse"
            },
            y: 0, opacity: 1, duration: 1, stagger: 0.3, ease: "power2.out"
        });

        gsap.from(".edu-timeline-line", {
            scrollTrigger: {
                trigger: "#education",
                start: "top center",
                end: "bottom center",
                scrub: true
            },
            scaleY: 0,
            transformOrigin: "top"
        });
        
        lucide.createIcons();
    });
</script>


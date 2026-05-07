<?php
require_once 'config/db.php';

// Fetch services from database
$stmt = $pdo->query("SELECT * FROM services");
$services = $stmt->fetchAll();
?>

<!-- Services Section -->
<section id="services" class="py-24 bg-gray-50 relative overflow-hidden">
  <!-- Interactive Connectivity Background -->
  <div class="absolute inset-0 z-0 pointer-events-none opacity-20">
    <div class="absolute inset-0" style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 50px 50px;"></div>
    <div class="service-beam beam-v-1 absolute top-0 left-[20%] w-[1px] h-full bg-gradient-to-b from-transparent via-google-blue to-transparent opacity-30"></div>
    <div class="service-beam beam-v-2 absolute top-0 right-[25%] w-[1px] h-full bg-gradient-to-b from-transparent via-google-red to-transparent opacity-30"></div>
    <div class="service-beam beam-h-1 absolute top-[30%] -left-full w-full h-[1px] bg-gradient-to-r from-transparent via-google-yellow to-transparent opacity-30"></div>
  </div>

  <div class="container mx-auto px-6 relative z-10">
    <div class="text-center mb-16">
      <span class="service-header text-google-blue font-bold tracking-widest uppercase text-sm mb-2 block opacity-0 translate-y-10">What We Do</span>
      <h2 class="service-header text-4xl md:text-6xl font-display font-bold mb-4 text-gray-900 opacity-0 translate-y-10">
        Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-google-blue via-google-red to-google-yellow">Expertise</span>
      </h2>
      <p class="service-header text-xl text-gray-600 max-w-2xl mx-auto opacity-0 translate-y-10">
        Hover over a card to explore our core capabilities.
      </p>
    </div>

    <div class="services-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <?php foreach ($services as $service): ?>
        <?php $borderColor = str_replace('text-', 'border-', $service['color']); ?>
        <div class="service-card-wrapper h-full opacity-0 translate-y-10">
            <div class="service-card group h-full cursor-pointer relative">
                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 border-2 border-transparent hover:<?php echo $borderColor; ?> flex flex-col h-full">
                    
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-gray-50 mb-6 group-hover:scale-110 transition-transform duration-300">
                      <i data-lucide="<?php echo $service['icon_name']; ?>" class="w-8 h-8 <?php echo $service['color']; ?>"></i>
                    </div>
                    
                    <h3 class="text-2xl font-bold mb-4 text-gray-900"><?php echo $service['title']; ?></h3>
                    <p class="text-gray-600 leading-relaxed mb-8 flex-grow">
                      <?php echo $service['description']; ?>
                    </p>

                    <!-- Booking Button -->
                    <button 
                      onclick='window.openBookingModal(<?php echo json_encode($service["title"]); ?>, <?php echo json_encode($service["description"]); ?>)'
                      class="mt-auto w-full py-3 rounded-xl font-bold text-sm uppercase tracking-wide flex items-center justify-center gap-2 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 bg-gray-900 text-white hover:bg-google-blue"
                    >
                      Book Consultation <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- View All Button -->
    <div class="mt-20 text-center service-header opacity-0 translate-y-10">
      <a 
        href="index.php?view=services" 
        class="inline-flex items-center gap-3 px-10 py-5 bg-white border-2 border-gray-900 text-gray-900 rounded-full font-bold text-lg hover:bg-gray-900 hover:text-white transition-all duration-300 shadow-xl shadow-gray-200"
      >
        View All Services <i data-lucide="layout-grid" class="w-5 h-5"></i>
      </a>
    </div>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Scroll Animations for Services
        gsap.to(".service-header", {
            scrollTrigger: {
                trigger: "#services",
                start: "top 80%",
                toggleActions: "play reverse play reverse"
            },
            y: 0,
            opacity: 1,
            duration: 0.8,
            stagger: 0.1,
            ease: "power3.out"
        });

        gsap.to(".service-card-wrapper", {
            scrollTrigger: {
                trigger: ".services-grid",
                start: "top 80%",
                toggleActions: "play reverse play reverse"
            },
            y: 0,
            opacity: 1,
            duration: 0.8,
            stagger: 0.1,
            ease: "power3.out"
        });

        // Beam Animations for Services
        gsap.to(".beam-v-1", {
            top: "100%", duration: 6, repeat: -1, ease: "none"
        });
        gsap.to(".beam-v-2", {
            top: "-100%", duration: 7, repeat: -1, ease: "none", delay: 1
        });
        gsap.to(".beam-h-1", {
            left: "100%", duration: 12, repeat: -1, ease: "none", delay: 0.5
        });

        // Initialize Lucide Icons
        lucide.createIcons();
    });
</script>

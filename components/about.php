<?php
require_once 'config/db.php';

// Fetch settings from database
$stmt = $pdo->query("SELECT * FROM settings LIMIT 1");
$settings = $stmt->fetch();

// Default values if settings not found
$aboutTitle = $settings['about_title'] ?? 'Bridging enterprise ambition with reliable digital execution.';
$aboutDesc = $settings['about_description'] ?? 'PrimeOrbit delivers scalable software, automation, and digital transformation programs for ambitious organizations.';
$aboutMission = $settings['about_mission'] ?? 'Our mission is to help organizations modernize operations, launch resilient products, and scale with confidence.';
$statsClients = $settings['stats_clients'] ?? '50+';
$statsProjects = $settings['stats_projects'] ?? '120+';
$statsAwards = $settings['stats_awards'] ?? '15+';
?>

<!-- About Section -->
<section id="about" class="py-24 bg-white relative overflow-hidden">
  <!-- Interactive Mesh Background -->
  <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
    <div
      class="about-blob blob-1 absolute top-[10%] -left-[10%] w-[50%] h-[50%] bg-google-blue/5 rounded-full blur-[100px]">
    </div>
    <div
      class="about-blob blob-2 absolute bottom-[10%] -right-[10%] w-[50%] h-[50%] bg-google-red/5 rounded-full blur-[100px]">
    </div>
    <div
      class="about-blob blob-3 absolute top-[40%] left-[20%] w-[40%] h-[40%] bg-google-yellow/5 rounded-full blur-[100px]">
    </div>
  </div>

  <!-- Decorative background elements -->
  <div class="absolute top-0 right-0 w-1/3 h-full bg-gray-50/50 -z-10 transform skew-x-12 translate-x-20"></div>

  <div class="container mx-auto px-6">
    <div class="flex flex-col lg:flex-row gap-16 items-center">

      <div class="lg:w-1/2 relative order-2 lg:order-1">
        <div
          class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[4/5] about-animate translate-y-10 opacity-0 group">
          <img src="assets/images/team.png" alt="PrimeOrbit Corporate Platform"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy"
            decoding="async" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
          <div class="absolute bottom-8 left-8 text-white z-10">
            <p class="font-display font-bold text-2xl">Built for Enterprise Scale</p>
            <p class="opacity-90">Specializing in Secure Digital Systems</p>
          </div>
        </div>

        <!-- Floating badge -->
        <div
          class="absolute -bottom-6 -right-6 bg-white p-6 rounded-2xl shadow-xl max-w-xs about-animate translate-y-10 opacity-0 border border-gray-100 hidden md:block z-20">
          <div class="flex items-center gap-2 mb-2">
            <div class="w-3 h-3 rounded-full bg-google-blue"></div>
            <p class="text-gray-900 font-bold">Enterprise Partner</p>
          </div>
          <p class="text-sm text-gray-500">Certified Delivery Excellence</p>
        </div>
      </div>

      <div class="lg:w-1/2 order-1 lg:order-2">
        <h2
          class="text-sm font-bold tracking-widest text-google-blue mb-4 uppercase about-animate translate-y-10 opacity-0">
          Corporate Engineering Philosophy</h2>
        <h3
          class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-8 leading-tight about-animate translate-y-10 opacity-0">
          Bridging business strategy with <br />Scalable Digital Systems.
        </h3>

        <p class="text-xl text-gray-600 mb-6 leading-relaxed about-animate translate-y-10 opacity-0">
          PrimeOrbit is a corporate technology partner dedicated to crafting digital ecosystems that are secure,
          scalable, and intuitive. Our approach merges strategic product thinking with rigorous engineering standards.
        </p>

        <p class="text-lg text-gray-500 mb-12 about-animate translate-y-10 opacity-0">
          From enterprise modernization to startup acceleration, we turn high-level concepts into scalable realities for
          teams that need dependable execution.
        </p>

        <div
          class="stats-container grid grid-cols-2 md:grid-cols-3 gap-8 border-t border-gray-100 pt-8 about-animate translate-y-10 opacity-0">
          <div class="stat-item">
            <h4 class="text-4xl font-display font-bold text-gray-900 mb-1">05+</h4>
            <p class="text-sm text-gray-500 font-medium">Years Delivery</p>
          </div>
          <div class="stat-item">
            <h4 class="text-4xl font-display font-bold text-gray-900 mb-1">80+</h4>
            <p class="text-sm text-gray-500 font-medium">Solutions Delivered</p>
          </div>
          <div class="stat-item">
            <h4 class="text-4xl font-display font-bold text-gray-900 mb-1">12+</h4>
            <p class="text-sm text-gray-500 font-medium">Industry Verticals</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    gsap.to(".about-animate", {
      scrollTrigger: {
        trigger: "#about",
        start: "top 80%",
        toggleActions: "play reverse play reverse"
      },
      y: 0,
      opacity: 1,
      duration: 1,
      stagger: 0.1,
      ease: "power3.out"
    });

    gsap.from(".stat-item", {
      scrollTrigger: {
        trigger: ".stats-container",
        start: "top 90%",
        toggleActions: "play none none reverse"
      },
      y: 30,
      opacity: 0,
      stagger: 0.2,
      duration: 0.8,
      ease: "back.out(1.7)"
    });

    // Floating Blobs Animation for About
    gsap.to(".about-blob.blob-1", {
      x: '20%', y: '10%', duration: 12, repeat: -1, yoyo: true, ease: "sine.inOut"
    });
    gsap.to(".about-blob.blob-2", {
      x: '-15%', y: '-20%', duration: 15, repeat: -1, yoyo: true, ease: "sine.inOut", delay: 1
    });
    gsap.to(".about-blob.blob-3", {
      x: '10%', y: '-10%', duration: 18, repeat: -1, yoyo: true, ease: "sine.inOut", delay: 2
    });
  });
</script>
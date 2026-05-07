<!-- Hero Component -->
<section id="hero"
  class="relative min-h-[100svh] w-full flex items-center justify-center overflow-hidden pt-[140px] pb-16 md:pt-0 md:pb-0"
  style="background: radial-gradient(ellipse 120% 100% at 50% 130%, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 25%, rgba(230,210,255,1) 38%, rgba(170,100,255,0.97) 52%, rgba(70,20,160,1) 70%, #04010c 100%), #04010c;">

  <!-- Mesh Gradient Background Blobs (Refined to match new gradient) -->
  <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
    <div
      class="blob blob-1 absolute -bottom-[20%] -left-[10%] w-[60%] h-[60%] bg-purple-500/20 rounded-full blur-[120px] mix-blend-screen">
    </div>
    <div
      class="blob blob-2 absolute -bottom-[10%] left-[20%] w-[50%] h-[50%] bg-blue-500/15 rounded-full blur-[140px] mix-blend-screen">
    </div>
    <div
      class="blob blob-3 absolute -bottom-[15%] right-[10%] w-[55%] h-[55%] bg-indigo-500/10 rounded-full blur-[130px] mix-blend-screen">
    </div>
  </div>

  <div class="container mx-auto px-4 sm:px-6 relative z-10 text-center">
    <div
      class="inline-block mb-6 md:mb-4 px-4 py-1.5 rounded-full border border-white/10 bg-white/5 backdrop-blur-md hero-animate translate-y-20 opacity-0">
      <span
        class="bg-gradient-to-r from-google-blue via-google-red to-google-yellow bg-clip-text text-transparent font-medium text-[clamp(0.85rem,2.5vw,1rem)]">
        Corporate Technology Partner
      </span>
    </div>

    <h1
      class="text-[clamp(2.5rem,7.5vw,5.5rem)] font-display font-bold leading-[1.1] mb-6 md:mb-8 text-white hero-animate translate-y-20 opacity-0 tracking-tight">
      Engineering
      <span
        class="inline-block align-middle w-[clamp(3rem,8vw,7rem)] h-[clamp(3.5rem,9vw,6.5rem)] rounded-3xl overflow-hidden border-4 border-orange-500 shadow-2xl mx-1 md:mx-3 -mt-2 transform hover:scale-105 transition-all duration-500">
        <img src="assets/images/wale.png" class="w-full h-full object-cover object-top"
          style="object-position: center 20%;" alt="PrimeOrbit" decoding="async" fetchpriority="high">
      </span>
      Enterprise Platforms <br />
      <span class="text-google-blue">with Operational</span> Precision.
    </h1>

    <p
      class="text-[clamp(1rem,4vw,1.5rem)] text-gray-400 max-w-2xl mx-auto mb-10 md:mb-12 hero-animate translate-y-20 opacity-0 font-light px-2 sm:px-0">
      We combine enterprise engineering, product strategy, and human-centered design to build high-performance digital ecosystems.
    </p>

    <div
      class="flex flex-col sm:flex-row gap-4 justify-center items-center hero-animate translate-y-20 opacity-0 w-full px-4 sm:px-0">
      <a href="#contact"
        class="hero-btn group relative px-8 py-4 bg-white text-black rounded-full font-medium text-[clamp(1rem,2vw,1.125rem)] overflow-hidden transition-all hover:scale-105 active:scale-95 w-full sm:w-auto">
        <span class="relative z-10 flex items-center justify-center gap-2">
          Start a Partnership
          <i data-lucide="message-square" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
        </span>
        <div
          class="absolute inset-0 bg-google-blue/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        </div>
      </a>

      <a href="#projects"
        class="hero-btn px-8 py-4 rounded-full font-medium text-[clamp(1rem,2vw,1.125rem)] text-white/70 hover:text-white border border-white/10 hover:border-white/20 hover:bg-white/5 backdrop-blur-sm transition-all active:scale-95 w-full sm:w-auto mt-2 sm:mt-0">
        Explore Work
      </a>
    </div>
  </div>

  <div
    class="absolute bottom-6 md:bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-50 scroll-indicator">
    <span class="text-xs md:text-sm font-medium text-white/50">Scroll to explore</span>
    <div class="w-1 h-6 md:h-8 rounded-full bg-gradient-to-b from-google-blue to-transparent"></div>
  </div>
</section>

<script>
  // Hero Animation Logic
  document.addEventListener('DOMContentLoaded', function () {
    if (typeof gsap === 'undefined') {
      document.querySelectorAll('.hero-animate').forEach(function (el) {
        el.classList.remove('opacity-0', 'translate-y-20');
      });
      return;
    }

    // Entrance Animation
    const tl = gsap.timeline({ delay: 0.3 });

    tl.to(".hero-animate", {
      y: 0,
      opacity: 1,
      duration: 1.4,
      stagger: 0.2,
      ease: "expo.out"
    });

    // Scroll Trigger Logic for Hero
    gsap.to("#hero .container", {
      scrollTrigger: {
        trigger: "#hero",
        start: "top top",
        end: "bottom top",
        scrub: true,
      },
      opacity: 0,
      y: -100,
      scale: 0.95,
      ease: "none"
    });

    // Scroll Indicator Bounce
    gsap.to(".scroll-indicator", {
      y: 15,
      repeat: -1,
      yoyo: true,
      duration: 1.5,
      ease: "sine.inOut"
    });

    // Floating Blobs Animation
    gsap.to(".blob-1", {
      x: '30%', y: '20%', duration: 15, repeat: -1, yoyo: true, ease: "sine.inOut"
    });
    gsap.to(".blob-2", {
      x: '-20%', y: '-10%', duration: 18, repeat: -1, yoyo: true, ease: "sine.inOut", delay: 1
    });
    gsap.to(".blob-3", {
      x: '15%', y: '-15%', duration: 20, repeat: -1, yoyo: true, ease: "sine.inOut", delay: 2
    });

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  });
</script>

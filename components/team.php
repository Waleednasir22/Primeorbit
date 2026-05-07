<!-- Team Section -->
<section id="expert" class="py-24 bg-gray-50 overflow-hidden">
  <div class="container mx-auto px-6">
    <div class="text-center mb-16 md:mb-20">
      <span
        class="text-google-red font-bold tracking-widest uppercase text-sm mb-2 block expert-header opacity-0 translate-y-10">The
        Team Behind the Work</span>
      <h2 class="text-4xl md:text-6xl font-display font-bold mb-4 text-gray-900 expert-header opacity-0 translate-y-10">
        Meet <span class="text-google-red">PrimeOrbit</span>
      </h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto expert-header opacity-0 translate-y-10">
        A focused leadership team building secure, scalable, and measurable digital products for modern companies.
      </p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 expert-card opacity-0 translate-y-20">
      <article
        class="team-card group bg-white rounded-[32px] overflow-hidden shadow-xl shadow-gray-200/70 border border-gray-100 flex flex-col">
        <div class="relative h-[420px] overflow-hidden bg-gray-100">
          <img src="assets/images/team-wale.jpg" alt="Waleed - PrimeOrbit Lead Architect"
            class="absolute inset-0 w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105"
            loading="lazy" decoding="async">
          <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
          <div
            class="absolute top-5 left-5 flex items-center gap-2 rounded-full bg-white/90 backdrop-blur px-4 py-2 text-[11px] font-bold uppercase tracking-widest text-gray-700">
            <span class="h-2 w-2 rounded-full bg-google-blue"></span>
            Lead Vision
          </div>
        </div>
        <div class="p-7 md:p-8 flex flex-col flex-1">
          <p class="text-google-yellow font-bold uppercase tracking-[0.2em] text-xs mb-3">Founder & CEO</p>
          <h3 class="text-3xl font-display font-bold text-gray-900 mb-4">Waleed</h3>
          <p class="text-gray-600 leading-relaxed flex-1">
            Defines the engineering direction, product architecture, and delivery standards behind PrimeOrbit platforms.
          </p>
        </div>
      </article>

      <article
        class="team-card group bg-white rounded-[32px] overflow-hidden shadow-xl shadow-gray-200/70 border border-gray-100 flex flex-col">
        <div class="relative h-[420px] overflow-hidden bg-gray-100">
          <img src="assets/images/team-khizar.jpg" alt="Khizar - PrimeOrbit Co-Founder & Engineering Lead"
            class="absolute inset-0 w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105"
            loading="lazy" decoding="async">
          <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
          <div
            class="absolute top-5 left-5 flex items-center gap-2 rounded-full bg-white/90 backdrop-blur px-4 py-2 text-[11px] font-bold uppercase tracking-widest text-gray-700">
            <span class="h-2 w-2 rounded-full bg-google-blue"></span>
            Systems
          </div>
        </div>
        <div class="p-7 md:p-8 flex flex-col flex-1">
          <p class="text-google-blue font-bold uppercase tracking-[0.2em] text-xs mb-3">Co-Founder & CTO</p>
          <h3 class="text-3xl font-display font-bold text-gray-900 mb-4">Khizar</h3>
          <p class="text-gray-600 leading-relaxed flex-1">
            Builds reliable backend systems, integrations, and automation workflows that keep business operations
            moving.
          </p>
        </div>
      </article>

      <article
        class="team-card group bg-white rounded-[32px] overflow-hidden shadow-xl shadow-gray-200/70 border border-gray-100 flex flex-col">
        <div class="relative h-[420px] overflow-hidden bg-gray-100">
          <img src="assets/images/team-hifza.jpg" alt="Hifza - PrimeOrbit Experience Lead"
            class="absolute inset-0 w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105"
            loading="lazy" decoding="async">
          <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
          <div
            class="absolute top-5 left-5 flex items-center gap-2 rounded-full bg-white/90 backdrop-blur px-4 py-2 text-[11px] font-bold uppercase tracking-widest text-gray-700">
            <span class="h-2 w-2 rounded-full bg-google-red"></span>
            Experience
          </div>
        </div>
        <div class="p-7 md:p-8 flex flex-col flex-1">
          <p class="text-google-red font-bold uppercase tracking-[0.2em] text-xs mb-3">Experience Lead</p>
          <h3 class="text-3xl font-display font-bold text-gray-900 mb-4">Hifza</h3>
          <p class="text-gray-600 leading-relaxed flex-1">
            Shapes user journeys, interface clarity, and launch polish so every PrimeOrbit product feels easy to trust.
          </p>
        </div>
      </article>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    if (typeof gsap !== 'undefined') {
      gsap.to(".expert-header", {
        scrollTrigger: {
          trigger: "#expert",
          start: "top 80%",
          toggleActions: "play reverse play reverse"
        },
        y: 0, opacity: 1, duration: 1, stagger: 0.1, ease: "power3.out"
      });
      gsap.to(".expert-card", {
        scrollTrigger: {
          trigger: "#expert",
          start: "top 70%",
          toggleActions: "play reverse play reverse"
        },
        y: 0, opacity: 1, duration: 1.2, ease: "expo.out"
      });
    } else {
      document.querySelectorAll('.expert-header, .expert-card').forEach(function (el) {
        el.classList.remove('opacity-0', 'translate-y-10', 'translate-y-20');
      });
    }

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  });
</script>
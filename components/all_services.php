<?php
require_once 'config/db.php';
$stmt = $pdo->query("SELECT * FROM services");
$services = $stmt->fetchAll();
?>

<!-- Enhanced All Services Page -->
<div class="bg-white selection:bg-google-blue selection:text-white overflow-hidden">
    
    <!-- Dynamic Background Elements -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] bg-google-blue/5 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-google-red/5 rounded-full blur-[100px] animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <!-- Section 1: Hero -->
    <section class="relative min-h-[90vh] flex items-center pt-32 pb-20 z-10">
        <div class="container mx-auto px-6">
            <div class="max-w-5xl">
                <a href="index.php?view=home" class="group inline-flex items-center gap-2 text-google-blue font-bold mb-12 hover:translate-x-[-5px] transition-transform">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i> Back to HQ
                </a>
                <h1 class="text-7xl md:text-9xl font-display font-bold text-gray-900 mb-10 leading-[0.9] tracking-tighter hero-text">
                    Next-Gen <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-google-blue via-google-red to-google-yellow">Capabilities.</span>
                </h1>
                <p class="text-2xl md:text-3xl text-gray-500 max-w-3xl leading-relaxed hero-sub">
                    We bridge the gap between enterprise ambition and technical reality through rigorous engineering and strategic design.
                </p>
                <div class="mt-12 flex flex-wrap gap-6 hero-sub">
                    <div class="flex items-center gap-3 bg-gray-50 px-6 py-3 rounded-full border border-gray-100">
                        <span class="w-2 h-2 rounded-full bg-google-green animate-ping"></span>
                        <span class="text-sm font-bold uppercase tracking-widest text-gray-600">Available for Scale</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Industrial Marquee (Premium Dark) -->
    <section class="bg-gray-950 py-20 relative overflow-hidden z-10">
        <div class="absolute inset-y-0 left-0 w-40 bg-gradient-to-r from-gray-950 to-transparent z-20"></div>
        <div class="absolute inset-y-0 right-0 w-40 bg-gradient-to-l from-gray-950 to-transparent z-20"></div>
        <div class="flex whitespace-nowrap marquee-container">
            <?php 
                $labels = ["SCALABLE ARCHITECTURE", "AI INTEGRATION", "CLOUD NATIVE", "CYBER RESILIENCE", "DATA PIPELINES", "UX PRECISION"];
                $labels = array_merge($labels, $labels, $labels); 
                foreach($labels as $label): 
            ?>
                <div class="flex items-center px-10">
                    <span class="text-5xl md:text-7xl font-display font-bold text-white/10 hover:text-google-blue/40 transition-colors cursor-default"><?php echo $label; ?></span>
                    <i data-lucide="zap" class="w-8 h-8 text-google-yellow mx-10 opacity-30"></i>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Section 3: The Grid -->
    <section id="service-grid" class="py-32 relative z-10">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
                <div class="max-w-2xl">
                    <h2 class="text-4xl md:text-6xl font-display font-bold text-gray-900 mb-6">Core <span class="text-google-blue">Verticals</span></h2>
                    <p class="text-xl text-gray-500">Our specialized units focus on high-impact areas of the modern digital stack.</p>
                </div>
                <div class="text-right">
                    <span class="text-8xl font-display font-bold text-gray-50 leading-none">0<?php echo count($services); ?></span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <?php foreach ($services as $index => $service): ?>
                <div class="service-reveal-card group bg-white rounded-[3rem] p-12 border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-700 flex flex-col h-full relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-16 -mt-16 group-hover:scale-[10] group-hover:bg-gray-900 transition-transform duration-1000 -z-0"></div>
                    
                    <div class="relative z-10">
                        <div class="w-20 h-20 rounded-2xl flex items-center justify-center bg-gray-50 mb-10 group-hover:bg-white/10 transition-colors">
                            <i data-lucide="<?php echo $service['icon_name']; ?>" class="w-10 h-10 <?php echo $service['color']; ?>"></i>
                        </div>
                        <h3 class="text-3xl font-bold mb-6 text-gray-900 group-hover:text-white transition-colors"><?php echo $service['title']; ?></h3>
                        <p class="text-gray-500 text-lg leading-relaxed mb-10 group-hover:text-gray-300 transition-colors">
                            <?php echo $service['description']; ?>
                        </p>
                        
                        <div class="flex gap-3 mb-10 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                             <span class="px-4 py-1 border border-gray-200 group-hover:border-white/20 text-[10px] font-bold uppercase text-gray-400 rounded-full">Secure</span>
                             <span class="px-4 py-1 border border-gray-200 group-hover:border-white/20 text-[10px] font-bold uppercase text-gray-400 rounded-full">Scalable</span>
                        </div>

                        <button 
                            onclick='window.openBookingModal(<?php echo json_encode($service["title"]); ?>, <?php echo json_encode($service["description"]); ?>)'
                            class="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold group-hover:bg-google-blue transition-all flex items-center justify-center gap-3"
                        >
                            Deploy Consultation <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Section 4: Horizontal Methodology -->
    <section id="methodology-trigger" class="bg-gray-50 py-32 overflow-hidden z-10 relative">
        <div class="container mx-auto px-6 mb-20">
            <h2 class="text-4xl md:text-6xl font-display font-bold text-gray-900">The <span class="text-google-red">Workflow</span></h2>
        </div>
        
        <div class="flex gap-12 px-6 methodology-track">
            <?php 
                $steps = [
                    ["01", "Inquiry & Audit", "We dissect your current technical debt and business goals."],
                    ["02", "Strategic Design", "Architecting systems that don't just work, but scale."],
                    ["03", "Precision Build", "Agile execution with daily quality benchmarks."],
                    ["04", "Global Launch", "Seamless deployment with 24/7 reliability monitoring."],
                    ["05", "Infinite Loop", "Continuous optimization based on real-world data."]
                ];
                foreach($steps as $step):
            ?>
            <div class="min-w-[350px] md:min-w-[500px] bg-white p-12 rounded-[3rem] shadow-xl border border-gray-100 method-step opacity-0">
                <div class="text-8xl font-display font-bold text-gray-50 mb-8"><?php echo $step[0]; ?></div>
                <h4 class="text-3xl font-bold mb-6"><?php echo $step[1]; ?></h4>
                <p class="text-xl text-gray-500 leading-relaxed"><?php echo $step[2]; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Section 5: Trust Banner -->
    <section class="py-32 bg-white z-10 relative">
        <div class="container mx-auto px-6 text-center">
            <div class="inline-block p-4 bg-google-blue/5 rounded-3xl mb-10">
                <i data-lucide="shield-check" class="w-12 h-12 text-google-blue mx-auto"></i>
            </div>
            <h2 class="text-4xl md:text-6xl font-display font-bold text-gray-900 mb-10">Ready to <span class="text-google-yellow">Upgrade?</span></h2>
            <p class="text-2xl text-gray-500 max-w-2xl mx-auto mb-16">Join 120+ companies scaling their digital presence with PrimeOrbit engineering.</p>
            <div class="flex flex-col md:flex-row justify-center gap-6">
                <button onclick="window.openChat()" class="px-12 py-6 bg-gray-900 text-white rounded-full font-bold text-xl hover:bg-google-blue transition-all shadow-2xl">Start a Conversation</button>
                <a href="index.php?view=projects" class="px-12 py-6 bg-white border-2 border-gray-900 text-gray-900 rounded-full font-bold text-xl hover:bg-gray-100 transition-all flex items-center justify-center gap-2">
                    Explore Our Work <i data-lucide="arrow-up-right" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </section>

</div>

<style>
    .marquee-container {
        animation: marquee-scroll 40s linear infinite;
        width: fit-content;
    }
    @keyframes marquee-scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-33.33%); }
    }
    .methodology-track {
        will-change: transform;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);

            // Hero Animations
            gsap.from(".hero-text", { y: 100, opacity: 0, duration: 1.2, ease: "power4.out", delay: 0.2 });
            gsap.from(".hero-sub", { y: 50, opacity: 0, duration: 1, stagger: 0.2, ease: "power3.out", delay: 0.8 });

            // Service Cards Stagger
            gsap.from(".service-reveal-card", {
                scrollTrigger: {
                    trigger: "#service-grid",
                    start: "top 70%"
                },
                y: 100,
                opacity: 0,
                duration: 1,
                stagger: 0.15,
                ease: "expo.out"
            });

            // Methodology Animation (Slide in from right)
            gsap.to(".method-step", {
                scrollTrigger: {
                    trigger: "#methodology-trigger",
                    start: "top 60%"
                },
                x: 0,
                opacity: 1,
                duration: 1.2,
                stagger: 0.2,
                ease: "power4.out"
            });

            // Parallax on track
            gsap.to(".methodology-track", {
                scrollTrigger: {
                    trigger: "#methodology-trigger",
                    start: "top bottom",
                    end: "bottom top",
                    scrub: 1
                },
                x: -200,
                ease: "none"
            });
        }
        
        lucide.createIcons();
    });
</script>

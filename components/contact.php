<?php
require_once 'config/db.php';

// Fetch settings for contact info
$stmt = $pdo->query("SELECT * FROM settings LIMIT 1");
$settings = $stmt->fetch();

$contactEmail = $settings['contact_email'] ?? 'hello@PrimeOrbitandco.com';
$address = $settings['address'] ?? '123 Innovation Dr, Silicon Valley, CA';
?>

<!-- Contact Section -->
<section id="contact" class="py-24 bg-white overflow-hidden">
  <div class="container mx-auto px-6">
    <div class="flex flex-col lg:flex-row gap-16">
      
      <div class="lg:w-3/5">
        <h2 class="text-5xl md:text-6xl font-display font-bold mb-6 leading-tight contact-animate opacity-0 translate-y-10">
          Start your <br/> <span class="text-google-blue">Project</span>
        </h2>
        <p class="text-xl text-gray-600 mb-10 contact-animate opacity-0 translate-y-10">
          Fill out the form below to book a consultation. Our specialists will reach out to you within 24 hours.
        </p>

        <form id="contact-form" class="space-y-8 contact-animate opacity-0 translate-y-10">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="relative group">
              <i data-lucide="user" class="absolute top-4 left-4 text-gray-400 group-focus-within:text-google-blue transition-colors w-5 h-5"></i>
              <input 
                type="text" 
                name="name"
                placeholder="Your Name"
                required
                class="w-full pl-12 pr-4 py-4 bg-gray-50 rounded-2xl border border-gray-200 focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all"
              />
            </div>
            <div class="relative group">
              <i data-lucide="mail" class="absolute top-4 left-4 text-gray-400 group-focus-within:text-google-blue transition-colors w-5 h-5"></i>
              <input 
                type="email" 
                name="email"
                placeholder="Email Address"
                required
                class="w-full pl-12 pr-4 py-4 bg-gray-50 rounded-2xl border border-gray-200 focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all"
              />
            </div>
          </div>

          <div>
            <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">Project Type</label>
            <div class="flex flex-wrap gap-3" id="project-type-container">
              <?php 
                $projectTypes = ["Web Development", "Mobile App", "AI Integration", "UI/UX Design", "Consulting"];
                foreach($projectTypes as $type):
              ?>
                <button
                  type="button"
                  data-value="<?php echo $type; ?>"
                  class="project-type-btn px-6 py-3 rounded-full text-sm font-medium border border-gray-200 bg-white text-gray-600 hover:border-google-blue hover:text-google-blue transition-all"
                >
                  <?php echo $type; ?>
                </button>
              <?php endforeach; ?>
              <input type="hidden" name="projectType" id="projectTypeInput" value="">
            </div>
          </div>

          <div>
            <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">Budget Range (USD)</label>
            <div class="relative group">
              <i data-lucide="dollar-sign" class="absolute top-4 left-4 text-gray-400 group-focus-within:text-google-green transition-colors w-5 h-5"></i>
              <select
                name="budget"
                class="w-full pl-12 pr-10 py-4 bg-gray-50 rounded-2xl border border-gray-200 focus:border-google-green focus:ring-4 focus:ring-google-green/10 outline-none transition-all appearance-none text-gray-600 cursor-pointer"
              >
                <option value="" disabled selected>Select a budget range</option>
                <option value="$5k - $10k">$5k - $10k</option>
                <option value="$10k - $25k">$10k - $25k</option>
                <option value="$25k - $50k">$25k - $50k</option>
                <option value="$50k+">$50k+</option>
              </select>
            </div>
          </div>

          <div class="relative group">
            <label class="block text-sm font-bold text-gray-700 mb-3 ml-1 flex justify-between items-center">
              Project Details
              <span class="text-xs font-normal text-google-blue flex items-center gap-1">
                <i data-lucide="sparkles" class="w-3 h-3"></i> AI Assisted
              </span>
            </label>
            <div class="relative">
              <textarea
                id="project-brief"
                name="brief"
                required
                class="w-full p-6 bg-gray-50 rounded-3xl border border-gray-200 focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all resize-none h-48 text-base placeholder:text-gray-400"
                placeholder="Tell us about your project goals..."
              ></textarea>
              
              <button 
                id="analyze-btn"
                type="button"
                className="absolute bottom-4 right-4 bg-white text-google-blue p-3 rounded-2xl shadow-lg border border-gray-100 hover:bg-google-blue hover:text-white hover:scale-105 active:scale-95 transition-all z-10"
                title="Analyze Brief with AI"
              >
                <i data-lucide="sparkles" id="analyze-icon" class="w-5 h-5"></i>
              </button>
            </div>
          </div>

          <!-- Analysis Result -->
          <div id="analysis-result" class="hidden overflow-hidden bg-gradient-to-br from-white to-blue-50 p-8 rounded-3xl border border-blue-100 shadow-xl shadow-blue-900/5 relative mb-8">
            <i data-lucide="bot" class="absolute -right-6 -bottom-6 w-32 h-32 text-blue-100/50 transform rotate-12"></i>
            <div class="flex items-center gap-3 mb-6 border-b border-blue-100 pb-4">
              <div class="p-2 bg-blue-100 rounded-lg">
                <i data-lucide="sparkles" class="text-google-blue w-5 h-5"></i>
              </div>
              <span class="font-bold text-google-blue text-sm uppercase tracking-wide">AI Project Analysis</span>
            </div>
            <div id="analysis-content" class="prose prose-blue text-gray-700 relative z-10"></div>
          </div>

          <button 
            type="submit"
            id="submit-btn"
            class="w-full py-5 bg-gray-900 text-white rounded-full font-bold text-xl hover:bg-google-blue transition-colors flex items-center justify-center gap-3 shadow-xl shadow-gray-200 hover:shadow-google-blue/30 transform hover:-translate-y-1 duration-300 disabled:opacity-70"
          >
            Submit Booking <i data-lucide="send" class="w-5 h-5"></i>
          </button>
        </form>
      </div>

      <div class="lg:w-2/5 flex items-start justify-center pt-12 contact-animate opacity-0 translate-y-10">
         <div class="relative w-full">
           <div class="absolute inset-0 bg-gradient-to-tr from-google-blue/20 via-google-red/20 to-google-yellow/20 rounded-full blur-3xl opacity-30 animate-pulse"></div>
           <div class="bg-white/80 backdrop-blur-xl p-8 md:p-10 rounded-[3rem] shadow-2xl border border-white/50 relative w-full sticky top-24">
             <h3 class="text-3xl font-display font-bold mb-8 text-gray-900">Contact Info</h3>
             <div class="space-y-8">
               <div class="group flex items-start gap-4">
                 <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-google-blue group-hover:scale-110 transition-transform">
                   <i data-lucide="mail" class="w-6 h-6"></i>
                 </div>
                 <div>
                   <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1 block">Email</label>
                   <a href="mailto:<?php echo $contactEmail; ?>" class="text-lg font-medium text-gray-900 group-hover:text-google-blue transition-colors"><?php echo $contactEmail; ?></a>
                 </div>
               </div>
               
               <div class="group flex items-start gap-4">
                 <div class="w-12 h-12 rounded-2xl bg-yellow-50 flex items-center justify-center text-google-yellow group-hover:scale-110 transition-transform">
                   <i data-lucide="map-pin" class="w-6 h-6"></i>
                 </div>
                 <div>
                   <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1 block">Visit Us</label>
                   <p class="text-lg font-medium text-gray-900"><?php echo nl2br($address); ?></p>
                 </div>
               </div>
             </div>
           </div>
         </div>
      </div>

    </div>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Scroll Animations
        gsap.to(".contact-animate", {
            scrollTrigger: {
                trigger: "#contact",
                start: "top 80%",
            },
            y: 0,
            opacity: 1,
            duration: 1,
            stagger: 0.15,
            ease: "power3.out"
        });

        // Project Type Selection
        const typeBtns = document.querySelectorAll('.project-type-btn');
        const typeInput = document.getElementById('projectTypeInput');

        typeBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                typeBtns.forEach(b => b.classList.remove('bg-gray-900', 'text-white', 'border-gray-900'));
                typeBtns.forEach(b => b.classList.add('bg-white', 'text-gray-600', 'border-gray-200'));
                
                btn.classList.add('bg-gray-900', 'text-white', 'border-gray-900');
                btn.classList.remove('bg-white', 'text-gray-600', 'border-gray-200');
                typeInput.value = btn.getAttribute('data-value');
            });
        });

        // AI Brief Analysis
        const analyzeBtn = document.getElementById('analyze-btn');
        const briefTextArea = document.getElementById('project-brief');
        const analysisResult = document.getElementById('analysis-result');
        const analysisContent = document.getElementById('analysis-content');
        const analyzeIcon = document.getElementById('analyze-icon');

        analyzeBtn.addEventListener('click', async () => {
            const brief = briefTextArea.value.trim();
            if (!brief) {
                alert("Please enter some project details first.");
                return;
            }

            analyzeBtn.disabled = true;
            analyzeIcon.classList.add('animate-spin');
            
            try {
                const response = await fetch('api/analyze_brief.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ brief })
                });
                const data = await response.json();

                if (data.analysis) {
                    analysisResult.classList.remove('hidden');
                    analysisContent.innerHTML = data.analysis;
                    
                    gsap.fromTo(analysisResult, 
                        { height: 0, opacity: 0, y: 20 },
                        { height: 'auto', opacity: 1, y: 0, duration: 0.6, ease: "power3.out" }
                    );
                }
            } catch (error) {
                console.error("Analysis failed", error);
            } finally {
                analyzeBtn.disabled = false;
                analyzeIcon.classList.remove('animate-spin');
            }
        });

        // Form Submission
        const form = document.getElementById('contact-form');
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            const originalText = btn.innerHTML;
            btn.innerHTML = 'Sending... <i data-lucide="loader-2" class="animate-spin w-5 h-5"></i>';
            lucide.createIcons();

            // Simulate submission
            setTimeout(() => {
                alert('Thank you! Your project request has been submitted. Nexus AI will review it shortly.');
                form.reset();
                analysisResult.classList.add('hidden');
                typeBtns.forEach(b => b.classList.remove('bg-gray-900', 'text-white', 'border-gray-900'));
                btn.disabled = false;
                btn.innerHTML = originalText;
                lucide.createIcons();
            }, 1500);
        });

        // Initialize Lucide Icons
        lucide.createIcons();
    });
</script>


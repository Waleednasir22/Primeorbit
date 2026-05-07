<!-- Audio Controller -->
<div id="audio-controller-container" class="fixed bottom-6 left-6 z-[90] flex items-center gap-4 opacity-0 -translate-x-10">
  <button 
    id="audio-toggle-btn"
    class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-gray-900 shadow-lg border border-gray-100 hover:scale-110 transition-transform active:scale-95"
  >
    <i data-lucide="volume-x" id="volume-icon" class="w-5 h-5 text-gray-400"></i>
  </button>

  <!-- Visualizer -->
  <div id="visualizer-wrapper" class="transition-all duration-500 overflow-hidden w-0 opacity-0 bg-white/10 backdrop-blur-sm rounded-full p-2 px-4 border border-white/20">
    <canvas id="audio-visualizer" width="128" height="32" class="w-32 h-8"></canvas>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const audio = new Audio("https://cdn.pixabay.com/download/audio/2022/05/27/audio_1808fbf07a.mp3?filename=lofi-study-112191.mp3");
        audio.loop = true;
        audio.volume = 0.3;

        const btn = document.getElementById('audio-toggle-btn');
        const icon = document.getElementById('volume-icon');
        const wrapper = document.getElementById('visualizer-wrapper');
        const canvas = document.getElementById('audio-visualizer');
        const ctx = canvas.getContext('2d');
        
        let isPlaying = false;
        let animationId;

        // Entrance Animation
        gsap.to("#audio-controller-container", {
            x: 0,
            opacity: 1,
            duration: 1,
            delay: 2,
            ease: "power3.out"
        });

        function renderVisualizer() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = '#4285F4'; // Google Blue

            const bars = 16;
            const barWidth = canvas.width / bars;
            
            for (let i = 0; i < bars; i++) {
                const height = Math.random() * canvas.height * 0.8 + 2;
                ctx.fillRect(i * barWidth, (canvas.height - height) / 2, barWidth - 2, height);
            }

            animationId = requestAnimationFrame(renderVisualizer);
        }

        btn.addEventListener('click', () => {
            if (isPlaying) {
                audio.pause();
                wrapper.classList.replace('w-32', 'w-0');
                wrapper.classList.replace('opacity-100', 'opacity-0');
                icon.setAttribute('data-lucide', 'volume-x');
                icon.classList.replace('text-google-blue', 'text-gray-400');
                cancelAnimationFrame(animationId);
            } else {
                audio.play().catch(err => console.log("Autoplay blocked", err));
                wrapper.classList.replace('w-0', 'w-32');
                wrapper.classList.replace('opacity-0', 'opacity-100');
                icon.setAttribute('data-lucide', 'volume-2');
                icon.classList.replace('text-gray-400', 'text-google-blue');
                renderVisualizer();
            }
            isPlaying = !isPlaying;
            lucide.createIcons();
        });

        lucide.createIcons();
    });
</script>

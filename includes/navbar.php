<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full z-50 px-6 py-6 transition-all duration-300 pointer-events-none <?php echo ($view === 'article') ? 'hidden' : ''; ?>">
  <div class="container mx-auto flex justify-between items-center bg-white/70 backdrop-blur-md p-4 rounded-full border border-gray-100 shadow-sm pointer-events-auto">
    <a 
      href="index.php" 
      class="text-xl font-bold font-display tracking-tight cursor-pointer"
    >
      PrimeOrbit<span class="text-google-blue">.</span>
    </a>
    
    <div class="hidden md:flex gap-8 text-sm font-medium text-gray-600">
      <a href="index.php#hero" class="hover:text-google-blue transition-colors">Home</a>
      <a href="index.php#about" class="hover:text-google-blue transition-colors">About</a>
      <a href="index.php?view=services" class="hover:text-google-blue transition-colors">Services</a>
      <a href="index.php?view=projects" class="hover:text-google-blue transition-colors">Projects</a>
      <a href="index.php#expert" class="hover:text-google-blue transition-colors">Team</a>
      <a href="index.php?view=blog" class="hover:text-google-blue transition-colors">Insights</a>
      <a href="index.php#contact" class="hover:text-google-blue transition-colors">Contact</a>
    </div>

    <button 
      id="open-chat-btn"
      class="bg-gray-900 text-white px-6 py-2 rounded-full text-sm font-medium hover:bg-google-blue transition-colors flex items-center gap-2 group"
    >
      Contact Sales
      <i data-lucide="message-square" class="w-4 h-4 group-hover:animate-bounce"></i>
    </button>
  </div>
</nav>

<script>
    // Initialize Lucide icons when the CDN has loaded.
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Basic Navbar Scroll Logic (Could be expanded)
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('nav');
        if (window.scrollY > 50) {
            nav.classList.add('py-4');
        } else {
            nav.classList.remove('py-4');
        }
    });

    // Chat Action
    document.getElementById('open-chat-btn').addEventListener('click', function() {
        if (window.openChat) {
            window.openChat();
        } else {
            console.error('Chat system not initialized');
        }
    });
</script>


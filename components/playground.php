<!-- Code Playground Section -->
<section id="playground" class="py-24 bg-gray-50 overflow-hidden relative">
  <div class="container mx-auto px-6">
    <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
      <div class="text-left">
        <span class="text-google-blue font-bold tracking-widest uppercase text-sm mb-2 block playground-anim opacity-0 translate-y-10">Interactive Sandbox</span>
        <h2 class="text-4xl md:text-6xl font-display font-bold mb-4 text-gray-900 playground-anim opacity-0 translate-y-10">
          Code <span class="text-google-blue">Playground</span>
        </h2>
        <p class="text-xl text-gray-600 max-w-xl playground-anim opacity-0 translate-y-10">
          Test ideas instantly. Write HTML, CSS, and JavaScript on the left, and watch the output render live on the right.
        </p>
      </div>
    </div>

    <div class="bg-[#1e1e1e] rounded-3xl border border-gray-200 overflow-hidden shadow-2xl playground-anim opacity-0 translate-y-10 flex flex-col lg:flex-row min-h-[600px] xl:min-h-[700px]">
      
      <!-- Editors Column -->
      <div class="w-full lg:w-1/2 flex flex-col border-b lg:border-b-0 lg:border-r border-[#333] relative">
        <!-- Editor Tabs -->
        <div class="flex border-b border-[#333] bg-[#252526] sticky top-0 z-20">
          <button class="px-6 py-4 text-sm font-medium text-white border-b-2 border-google-blue focus:outline-none flex items-center gap-2 tab-btn transition-colors hover:bg-white/5 active" data-lang="html">
            <i data-lucide="file-code-2" class="w-4 h-4 text-google-red"></i> index.html
          </button>
          <button class="px-6 py-4 text-sm font-medium text-gray-400 border-b-2 border-transparent hover:text-white cursor-pointer focus:outline-none flex items-center gap-2 tab-btn transition-colors hover:bg-white/5" data-lang="css">
            <i data-lucide="file-json" class="w-4 h-4 text-google-blue"></i> style.css
          </button>
          <button class="px-6 py-4 text-sm font-medium text-gray-400 border-b-2 border-transparent hover:text-white cursor-pointer focus:outline-none flex items-center gap-2 tab-btn transition-colors hover:bg-white/5" data-lang="js">
            <i data-lucide="brackets" class="w-4 h-4 text-google-yellow"></i> script.js
          </button>
        </div>
        
        <!-- Textareas -->
        <div class="relative flex-grow min-h-[300px] lg:h-auto">
          
          <!-- Line Numbers Overlay Simulator (Aesthetic) -->
          <div class="absolute left-0 top-0 bottom-0 w-12 bg-[#1e1e1e] border-r border-[#333] flex flex-col items-center py-4 text-[#858585] text-xs font-mono opacity-50 select-none z-0 pointer-events-none">
             <?php for($i=1; $i<=30; $i++): ?>
                <span class="mb-1 leading-relaxed"><?php echo $i; ?></span>
             <?php endfor; ?>
          </div>

          <!-- HTML Editor -->
          <textarea id="editor-html" class="absolute inset-0 w-full h-full pl-16 pr-4 py-4 bg-transparent text-[#d4d4d4] font-mono text-sm md:text-base resize-none focus:outline-none font-light leading-relaxed whitespace-pre z-10 custom-scrollbar" spellcheck="false">&lt;div class="glass-orb"&gt;&lt;/div&gt;
&lt;div class="content"&gt;
  &lt;h1&gt;Live Workspace&lt;/h1&gt;
  &lt;p&gt;Hover over this card&lt;/p&gt;
&lt;/div&gt;</textarea>
          
          <!-- CSS Editor -->
          <textarea id="editor-css" class="absolute inset-0 w-full h-full pl-16 pr-4 py-4 bg-transparent text-[#d4d4d4] font-mono text-sm md:text-base resize-none focus:outline-none font-light leading-relaxed opacity-0 pointer-events-none whitespace-pre z-10 custom-scrollbar" spellcheck="false">body {
  margin: 0;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #04010c;
  font-family: "Outfit", sans-serif;
  overflow: hidden;
}

.content {
  position: relative;
  z-index: 10;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  padding: 3rem 4rem;
  border-radius: 24px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  text-align: center;
  color: white;
  transition: transform 0.4s ease, border-color 0.4s ease;
  cursor: pointer;
}

.content:hover {
  transform: translateY(-10px);
  border-color: rgba(66, 133, 244, 0.5); /* Google Blue */
}

h1 {
  font-size: 2.5rem;
  margin: 0 0 10px 0;
  background: linear-gradient(to right, #4285F4, #EA4335);
  -webkit-background-clip: text;
  color: transparent;
}

p {
  color: #a0aec0;
  margin: 0;
  font-size: 1.1rem;
}

.glass-orb {
  position: absolute;
  width: 200px;
  height: 200px;
  background: #4285F4;
  border-radius: 50%;
  filter: blur(60px);
  z-index: 1;
  transition: all 0.5s ease;
}</textarea>
          
          <!-- JS Editor -->
          <textarea id="editor-js" class="absolute inset-0 w-full h-full pl-16 pr-4 py-4 bg-transparent text-[#d4d4d4] font-mono text-sm md:text-base resize-none focus:outline-none font-light leading-relaxed opacity-0 pointer-events-none whitespace-pre z-10 custom-scrollbar" spellcheck="false">const card = document.querySelector('.content');
const orb = document.querySelector('.glass-orb');

// Add interactive mouse tracking
document.addEventListener('mousemove', (e) => {
  const x = e.clientX;
  const y = e.clientY;
  
  // Follow cursor with delay
  orb.style.transform = `translate(${x - 100}px, ${y - 100}px)`;
});

card.addEventListener('mouseenter', () => {
  orb.style.background = '#EA4335'; // Turns red on hover
  orb.style.filter = 'blur(80px)';
});

card.addEventListener('mouseleave', () => {
  orb.style.background = '#4285F4'; // Back to blue
  orb.style.filter = 'blur(60px)';
});</textarea>
        </div>
      </div>

      <!-- Preview Column -->
      <div class="w-full lg:w-1/2 bg-white relative flex flex-col">
        <div class="absolute top-4 right-4 z-10">
            <span class="bg-gray-900/50 backdrop-blur-md text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg flex items-center gap-2 border border-white/10 uppercase tracking-widest"><span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>Live Preview</span>
        </div>
        <div class="flex-grow relative h-full min-h-[400px]">
            <iframe id="playground-preview" class="absolute inset-0 w-full h-full border-none bg-white" title="Live Preview"></iframe>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
/* Syntax highlighting colors simulation */
#editor-html { color: #569cd6; } /* Blueish tags */
#editor-css { color: #ce9178; }  /* Orange strings/values */
#editor-js { color: #9cdcfe; }   /* Light blue variables */

.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #444;
    border-radius: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #666;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll Animation
    gsap.to(".playground-anim", {
        scrollTrigger: {
            trigger: "#playground",
            start: "top 75%"
        },
        y: 0,
        opacity: 1,
        duration: 1,
        stagger: 0.2,
        ease: "power4.out"
    });

    const htmlEditor = document.getElementById('editor-html');
    const cssEditor = document.getElementById('editor-css');
    const jsEditor = document.getElementById('editor-js');
    const preview = document.getElementById('playground-preview');
    const tabBtns = document.querySelectorAll('.tab-btn');
    const editors = {
        'html': htmlEditor,
        'css': cssEditor,
        'js': jsEditor
    };

    function updatePreview() {
        const html = htmlEditor.value;
        const css = `<style>${cssEditor.value}</style>`;
        const jsObj = jsEditor.value;
        
        try {
            const doc = preview.contentDocument || preview.contentWindow.document;
            doc.open();
            doc.write(`
              <!DOCTYPE html>
              <html>
                <head>
                  <meta charset="utf-8">
                  ${css}
                </head>
                <body style="margin:0; width:100%; height:100%; overflow:hidden;">
                  ${html}
                  <script>
                    window.onerror = function(e){ console.error(e); };
                    try {
                      ${jsObj}
                    } catch(e) {
                      console.error(e);
                    }
                  <\/script>
                </body>
              </html>
            `);
            doc.close();
        } catch(e) {
            console.error("Iframe write error: ", e);
        }
    }

    // Tab Switching Logic
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const lang = btn.getAttribute('data-lang');
            
            // Reset active states
            tabBtns.forEach(b => {
                b.classList.remove('text-white', 'border-google-blue', 'active');
                b.classList.add('text-gray-400', 'border-transparent');
            });
            
            // Set active state
            btn.classList.add('text-white', 'border-google-blue', 'active');
            btn.classList.remove('text-gray-400', 'border-transparent');

            // Hide all editors
            Object.values(editors).forEach(editor => {
                editor.classList.add('opacity-0', 'pointer-events-none');
                editor.style.zIndex = '0';
            });

            // Show selected editor
            editors[lang].classList.remove('opacity-0', 'pointer-events-none');
            editors[lang].style.zIndex = '10';
            editors[lang].focus();
        });
    });

    // Handle Tab Key for Indentation
    [htmlEditor, cssEditor, jsEditor].forEach(editor => {
        editor.addEventListener('keydown', function(e) {
            if (e.key == 'Tab') {
                e.preventDefault();
                let start = this.selectionStart;
                let end = this.selectionEnd;
                // set textarea value to: text before caret + tab + text after caret
                this.value = this.value.substring(0, start) + "\t" + this.value.substring(end);
                // put caret at right position again
                this.selectionStart = this.selectionEnd = start + 1;
                updatePreview();
            }
        });
        
        // Debounce update for performance
        let timeout;
        editor.addEventListener('keyup', () => {
            clearTimeout(timeout);
            timeout = setTimeout(updatePreview, 300);
        });
    });

    // Initial Render
    setTimeout(updatePreview, 500);
});
</script>

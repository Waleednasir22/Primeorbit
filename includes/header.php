<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="PrimeOrbit - A premier corporate technology partner specializing in secure digital systems, enterprise modernization, and scalable software solutions for modern companies." />
    <meta name="keywords" content="PrimeOrbit, Corporate Technology, Software Engineering, AI Integration, UI/UX Design, Digital Transformation, Secure Systems, Scalable Solutions" />
    <meta name="author" content="PrimeOrbit Team" />
    <meta name="robots" content="index, follow" />
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://primeorbit.infinityfree.me/" />
    <meta property="og:title" content="PrimeOrbit - Corporate Technology & Scalable Systems" />
    <meta property="og:description" content="Building secure, scalable, and measurable digital products for modern enterprises. Explore PrimeOrbit's corporate technology solutions." />
    <meta property="og:image" content="assets/images/team.png" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://primeorbit.infinityfree.me/" />
    <meta property="twitter:title" content="PrimeOrbit - Corporate Technology & Scalable Systems" />
    <meta property="twitter:description" content="Building secure, scalable, and measurable digital products for modern enterprises. Explore PrimeOrbit's corporate technology solutions." />
    <meta property="twitter:image" content="assets/images/team.png" />

    <!-- Canonical Link -->
    <link rel="canonical" href="https://primeorbit.infinityfree.me/" />

    <!-- Theme Color for Browser UI -->
    <meta name="theme-color" content="#4285F4" />

    <title><?php echo isset($pageTitle) ? $pageTitle : "PrimeOrbit - Corporate Technology & Scalable Systems"; ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="favicon.ico" />

    <!-- Performance: Preconnect to CDNs -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="preconnect" href="https://pub-8c02bb0f8aa04c19b7b7ee44644801fd.r2.dev">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="preload" as="image" href="assets/images/wale.png" fetchpriority="high">

    <!-- Google Fonts, loaded without blocking first paint -->
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&family=Space+Grotesk:wght@300;400;500;700&display=swap" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&family=Space+Grotesk:wght@300;400;500;700&display=swap" rel="stylesheet"></noscript>

    <!-- Tailwind CSS (CDN for performance & quick iteration) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        google: {
                            blue: '#4285F4',
                                red: '#EA4335',
                            yellow: '#FBBC05',
                            green: '#34A853',
                            gray: '#F1F3F4'
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            background-color: #ffffff;
            color: #202124;
            overflow-x: hidden;
            font-family: 'Outfit', sans-serif;
        }

        img,
        video {
            max-width: 100%;
        }

        img {
            height: auto;
        }

        .hero-animate {
            will-change: transform, opacity;
        }
        
        /* Custom Scrollbar for Premium Feel */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .font-display {
            font-family: 'Space Grotesk', sans-serif;
        }

        /* Glassmorphism Classes */
        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Smooth Transitions */
        .transition-all-custom {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Selection Colors */
        ::selection {
            background-color: #4285F4;
            color: white;
        }

        /* Preloader Styles */
        #preloader {
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .loader-dots div {
            animation: loader-dots 0.6s infinite alternate;
        }
        .loader-dots div:nth-child(2) { animation-delay: 0.2s; }
        .loader-dots div:nth-child(3) { animation-delay: 0.4s; }
        @keyframes loader-dots {
            from { transform: translateY(0); opacity: 1; }
            to { transform: translateY(-10px); opacity: 0.3; }
        }
    </style>

    <!-- Animation Libraries (Optimized with defer) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js" defer></script>
    <script src="https://unpkg.com/lucide@latest" defer></script>
    <script>
        // Initialize GSAP plugins after scripts load
        window.addEventListener('DOMContentLoaded', () => {
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);
            }
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            // Never let animation CDN delays leave content invisible.
            window.setTimeout(() => {
                if (typeof gsap === 'undefined') {
                    document
                        .querySelectorAll('[class*="opacity-0"], [class*="translate-y-"], [class*="translate-x-"]')
                        .forEach((el) => {
                            el.classList.remove(
                                'opacity-0',
                                'translate-y-10',
                                'translate-y-20',
                                'translate-x-full',
                                '-translate-x-full'
                            );
                        });
                }
            }, 1200);
        });

        // Preloader Logic
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }, 600);
            }
        });
    </script>
</head>
<body class="antialiased selection:bg-google-blue selection:text-white relative" style="overflow: hidden;">

    <!-- Premium Preloader -->
    <div id="preloader" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white">
        <div class="flex flex-col items-center">
            <div class="loader-dots flex gap-2 mb-6">
                <div class="w-4 h-4 bg-google-blue rounded-full"></div>
                <div class="w-4 h-4 bg-google-red rounded-full"></div>
                <div class="w-4 h-4 bg-google-yellow rounded-full"></div>
            </div>
            <p class="font-display font-bold text-3xl tracking-tighter text-gray-900">
                Prime<span class="text-google-blue">Orbit</span>
            </p>
            <div class="mt-4 h-[1px] w-12 bg-gray-100 overflow-hidden">
                <div class="h-full bg-google-blue w-1/2 animate-[progress_1.5s_infinite_linear]"></div>
            </div>
        </div>
    </div>

    <style>
        @keyframes progress {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(200%); }
        }
    </style>


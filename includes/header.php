<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo isset($pageTitle) ? $pageTitle : "PrimeOrbit - Corporate Technology Company"; ?></title>

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
    </script>
</head>
<body class="antialiased selection:bg-google-blue selection:text-white relative">


<?php
// Comprehensive script to populate the database with all initial data from constants.ts
require_once __DIR__ . '/db.php';

// Enable error reporting for seeding
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Clear existing data safely
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $tables = [
        'projects', 'services', 'reviews', 'articles', 'team_members', 
        'faqs', 'job_postings', 'case_studies', 'lab_experiments', 
        'process_steps', 'tech_stack', 'company_stats', 'settings', 'users'
    ];
    foreach ($tables as $table) {
        $pdo->exec("TRUNCATE TABLE $table;");
    }
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

    echo "Tables truncated. Starting seeding...<br>";

    // 1. PROJECTS
    $projects = [
        [
            'title' => "PitchnPurge", 
            'category' => "Eco-Friendly Junk Removal", 
            'description' => "A premium, eco-conscious junk removal service designed to streamline property decluttering with Operational precision.", 
            'image_url' => "https://picsum.photos/800/600?random=11", 
            'color' => "bg-google-blue", 
            'challenges' => "Optimizing multi-route logistics for same-day removal while maintaining high recycling rates.", 
            'solution' => "Developed a proprietary scheduling algorithm that minimizes transit time and maximizes salvageable material recovery.", 
            'technologies' => json_encode(["Next.js", "Node.js", "Google Maps API", "PostgreSQL"]),
            'website_url' => "https://pitchnpurge.com"
        ],
        [
            'title' => "Health Consultation", 
            'category' => "Telemedicine", 
            'description' => "Seamless telemedicine portal connecting patients with top-tier specialists globally via secure video.", 
            'image_url' => "https://picsum.photos/800/600?random=12", 
            'color' => "bg-google-red", 
            'challenges' => "Maintaining ultra-low latency video streams with HIPAA-grade security.", 
            'solution' => "Deployed a custom WebRTC signaling server with end-to-end encryption protocols.", 
            'technologies' => json_encode(["Next.js", "WebRTC", "Socket.io", "AWS"]),
            'website_url' => "https://healthconsult.io"
        ],
        [
            'title' => "PathSeeker", 
            'category' => "EdTech Platform", 
            'description' => "Adaptive career pathfinding platform using AI to graph and navigate personalized learning journeys.", 
            'image_url' => "https://picsum.photos/800/600?random=13", 
            'color' => "bg-google-yellow", 
            'challenges' => "Visualizing non-linear career data in a user-friendly, interactive graph.", 
            'solution' => "Developed a dynamic graph visualization engine using D3.js and Neo4j.", 
            'technologies' => json_encode(["Vue.js", "D3.js", "Python", "Neo4j"]),
            'website_url' => "https://pathseeker.edu"
        ],
        [
            'title' => "Tranquility-home", 
            'category' => "Real Estate", 
            'description' => "Premium property ecosystem for high-end residential transactions featuring immersive virtual tours.", 
            'image_url' => "https://picsum.photos/800/600?random=14", 
            'color' => "bg-google-green", 
            'challenges' => "Rendering high-fidelity 3D floor plans directly in the web browser.", 
            'solution' => "Leveraged Three.js and specialized shaders to deliver smooth, photorealistic walkthroughs.", 
            'technologies' => json_encode(["Next.js", "Three.js", "GSAP", "Firebase"]),
            'website_url' => "https://tranquilityhomes.com"
        ],
        [
            'title' => "Sn store", 
            'category' => "Luxury Fashion", 
            'description' => "E-commerce storefront for a premier clothing brand with personalized style agents and AR try-on.", 
            'image_url' => "https://picsum.photos/800/600?random=15", 
            'color' => "bg-purple-600", 
            'challenges' => "Synchronizing real-time inventory across global retail locations.", 
            'solution' => "Architected a distributed microservices system on AWS with Redis caching.", 
            'technologies' => json_encode(["React", "Shopify Engine", "Tailwind CSS", "Redis"]),
            'website_url' => "https://snstore.luxury"
        ],
        [
            'title' => "Smart Travel", 
            'category' => "TravelTech", 
            'description' => "AI-powered travel logistics engine that predicts transit delays and automates multi-leg re-bookings.", 
            'image_url' => "https://picsum.photos/800/600?random=16", 
            'color' => "bg-slate-800", 
            'challenges' => "Aggregating and normalizing real-time data from hundreds of airline APIs.", 
            'solution' => "Implemented a scalable data ingestion layer using Go routines and gRPC.", 
            'technologies' => json_encode(["Angular", "Go", "Kubernetes", "Google Maps API"]),
            'website_url' => "https://smarttravel.ai"
        ]
    ];
    $stmt = $pdo->prepare("INSERT INTO projects (title, category, description, image_url, color, challenges, solution, technologies, website_url) VALUES (?,?,?,?,?,?,?,?,?)");
    foreach ($projects as $p) $stmt->execute(array_values($p));

    // 2. SERVICES
    $services = [
        ['title' => "Digital Transformation", 'description' => "Modernizing legacy systems with cloud-native architectures.", 'icon_name' => "code", 'color' => "text-google-blue"],
        ['title' => "AI & Machine Learning", 'description' => "Predictive analytics and generative AI integration.", 'icon_name' => "cpu", 'color' => "text-google-red"],
        ['title' => "Immersive UX/UI", 'description' => "Award-winning design centered on human behavior.", 'icon_name' => "layout", 'color' => "text-google-yellow"],
        ['title' => "Cybersecurity", 'description' => "Enterprise-grade protection for sensitive data assets.", 'icon_name' => "shield", 'color' => "text-google-green"]
    ];
    $stmt = $pdo->prepare("INSERT INTO services (title, description, icon_name, color) VALUES (?,?,?,?)");
    foreach ($services as $s) $stmt->execute(array_values($s));

    // 3. REVIEWS
    $reviews = [
        ['author' => "Sarah Jenkins", 'role' => "CTO", 'company' => "TechFlow Inc.", 'feedback_text' => "PrimeOrbit transformed our infrastructure overnight. The level of detail and engineering prowess is unmatched.", 'rating' => 5, 'status' => 'approved', 'author_image' => 'https://i.pravatar.cc/150?u=sarah'],
        ['author' => "Michael Chen", 'role' => "Director of Product", 'company' => "Innovate Global", 'feedback_text' => "Their understanding of user experience combined with technical excellence delivered a product that our users love.", 'rating' => 5, 'status' => 'approved', 'author_image' => 'https://i.pravatar.cc/150?u=michael'],
        ['author' => "Elena Rodriguez", 'role' => "CEO", 'company' => "GreenStart", 'feedback_text' => "We needed a partner who understood sustainability and tech. PrimeOrbit was the perfect match.", 'rating' => 5, 'status' => 'approved', 'author_image' => 'https://i.pravatar.cc/150?u=elena']
    ];
    $stmt = $pdo->prepare("INSERT INTO reviews (author, role, company, feedback_text, rating, status, author_image) VALUES (?,?,?,?,?,?,?)");
    foreach ($reviews as $r) $stmt->execute(array_values($r));

    // 4. ARTICLES
    $articles = [
        [
            'title' => "The Rise of Generative AI in Enterprise Workflows",
            'excerpt' => "How large language models are reshaping the way businesses automate complex tasks and decision-making processes.",
            'category' => "Artificial Intelligence",
            'date' => "Oct 12, 2024",
            'image' => "https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&q=80&w=800",
            'readTime' => "5 min read",
            'author_name' => "Elena Rodriguez",
            'author_role' => "AI Specialist",
            'author_image' => "https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=100",
            'content' => "<h3>Introduction</h3><p>In the rapidly evolving landscape... "
        ]
        // ... more articles can be added here
    ];
    $stmt = $pdo->prepare("INSERT INTO articles (title, excerpt, category, publish_date, image_url, read_time, author_name, author_role, author_image, content) VALUES (?,?,?,?,?,?,?,?,?,?)");
    foreach ($articles as $a) $stmt->execute(array_values($a));

    // 5. TEAM MEMBERS
    $team = [
        ['name' => "Ayan Malik", 'role' => "Executive Strategy Lead", 'image' => "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=800", 'bio' => "Corporate technology leader focused on digital strategy, product delivery, and scalable engineering systems."],
        ['name' => "Sarah Chen", 'role' => "Head of Engineering", 'image' => "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=800", 'bio' => "Full-stack architect specializing in scalable cloud infrastructure."],
        ['name' => "Marcus Johnson", 'role' => "Lead UX Designer", 'image' => "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=800", 'bio' => "Obsessed with micro-interactions and accessible user experiences."],
        ['name' => "Elena Rodriguez", 'role' => "AI Specialist", 'image' => "https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=800", 'bio' => "Machine learning expert focused on generative AI integration."]
    ];
    $stmt = $pdo->prepare("INSERT INTO team_members (name, role, image_url, bio) VALUES (?,?,?,?)");
    foreach ($team as $t) $stmt->execute(array_values($t));

    // 6. FAQS
    $faqs = [
        ['question' => "What is your typical project timeline?", 'answer' => "Project timelines vary by complexity. A standard corporate website typically takes 4-6 weeks..."],
        ['question' => "Do you work with startups?", 'answer' => "We partner with ambitious companies of all sizes."],
        ['question' => "How do you handle post-launch support?", 'answer' => "We offer comprehensive retainer packages including server monitoring..."]
    ];
    $stmt = $pdo->prepare("INSERT INTO faqs (question, answer) VALUES (?,?)");
    foreach ($faqs as $f) $stmt->execute(array_values($f));

    // 7. JOB POSTINGS
    $jobs = [
        ['title' => "Senior Frontend Engineer", 'dept' => "Engineering", 'loc' => "Remote / San Francisco", 'type' => "Full-time", 'desc' => "We are looking for a React expert...", 'req' => json_encode(["5+ years React experience", "Expertise in GSAP", "Performance optimization"])],
        ['title' => "AI Solutions Architect", 'dept' => "Artificial Intelligence", 'loc' => "Remote / New York", 'type' => "Full-time", 'desc' => "Design and implement generative AI solutions...", 'req' => json_encode(["Python & TensorFlow", "RAG architectures", "Strong backend"])]
    ];
    $stmt = $pdo->prepare("INSERT INTO job_postings (title, department, location, type, description, requirements) VALUES (?,?,?,?,?,?)");
    foreach ($jobs as $j) $stmt->execute(array_values($j));

    // 8. CASE STUDIES
    $cases = [
        [
            'client' => "CityClean Solutions", 
            'title' => "Optimizing Urban Waste Logistics", 
            'cat' => "Eco-Friendly Junk Removal", 
            'problem' => "Managing hundreds of daily removal requests across multiple city zones with inefficient routing and poor tracking led to high overhead.", 
            'solution' => "Built a real-time logistics dashboard that clusters requests based on geography and salvage type, automating the entire dispatch workflow.", 
            'result' => "Reduced fuel costs by 32% and increased recycling efficiency by 40% in the first quarter of operations.", 
            'image_url' => "https://picsum.photos/1200/800?random=21", 
            'metrics' => json_encode([['label' => "Fuel Savings", 'value' => "32%"], ['label' => "Recycling Rate", 'value' => "40%"]]), 
            'color' => "bg-google-blue"
        ],
        [
            'client' => "GlobalHealth Network", 
            'title' => "Virtual Care Transformation", 
            'cat' => "Telemedicine", 
            'problem' => "Patients in remote regions faced weeks of waiting for specialist consultations due to a lack of secure, high-quality video infrastructure.", 
            'solution' => "Developed a proprietary WebRTC-based telemedicine portal with low-bandwidth optimization and fully integrated patient record management.", 
            'result' => "Average waiting time dropped from 14 days to 48 hours for over 50,000 active users.", 
            'image_url' => "https://picsum.photos/1200/800?random=22", 
            'metrics' => json_encode([['label' => "Wait Time Red.", 'value' => "85%"], ['label' => "Active Users", 'value' => "50k+"]]), 
            'color' => "bg-google-red"
        ],
        [
            'client' => "CareerPath Academy", 
            'title' => "AI-Driven Learning Journeys", 
            'cat' => "EdTech Platform", 
            'problem' => "Learners were overwhelmed by the abundance of educational content, leading to high drop-out rates and fragmented knowledge.", 
            'solution' => "Implemented an intelligent 'knowledge graph' that analyzes student skills and goals to create adaptive, non-linear learning paths.", 
            'result' => "Course completion rate increased by 55%, and user engagement doubled within the first six months.", 
            'image_url' => "https://picsum.photos/1200/800?random=23", 
            'metrics' => json_encode([['label' => "Completion Rate", 'value' => "+55%"], ['label' => "Engagement", 'value' => "2x"]]), 
            'color' => "bg-google-yellow"
        ],
        [
            'client' => "Elite Living Properties", 
            'title' => "Immersive Real Estate Sales", 
            'cat' => "Real Estate", 
            'problem' => "High-end property buyers often struggled to visit locations internationally, leading to slow sales cycles for luxury apartments.", 
            'solution' => "Engineered a photorealistic 3D virtual tour system using Three.js that allowed buyers to customize furniture and finishes in real-time.", 
            'result' => "Closed 15+ multi-million dollar deals entirely through virtual walkthroughs, cutting average sales time by 25%.", 
            'image_url' => "https://picsum.photos/1200/800?random=24", 
            'metrics' => json_encode([['label' => "Sales Cycle Red.", 'value' => "25%"], ['label' => "Digital Deals", 'value' => "15+"]]), 
            'color' => "bg-google-green"
        ],
        [
            'client' => "Noir Couture", 
            'title' => "Disrupting Digital Retail", 
            'cat' => "Luxury Fashion", 
            'problem' => "The client's legacy e-commerce platform couldn't handle seasonal spikes in traffic and lacked a premium checkout experience.", 
            'solution' => "Refactored the core architecture into a headless, microservices-based system with a React frontend and Shopify backend integration.", 
            'result' => "System uptime reached 99.99% during 'Black Friday' with a 30% increase in average order value.", 
            'image_url' => "https://picsum.photos/1200/800?random=25", 
            'metrics' => json_encode([['label' => "Uptime", 'value' => "99.99%"], ['label' => "Order Value", 'value' => "+30%"]]), 
            'color' => "bg-purple-600"
        ],
        [
            'client' => "TerraBound Travel", 
            'title' => "Predictive Journey Management", 
            'cat' => "TravelTech", 
            'problem' => "Persistent flight delays and connections were costing the agency thousands in manual re-booking expenses and customer dissatisfaction.", 
            'solution' => "Deployed an AI engine that consumes real-time transit data to predict disruptions, automatically re-booking optimal routes.", 
            'result' => "Saved $200k in annual operational overhead and improved customer CSAT scores by 45 points.", 
            'image_url' => "https://picsum.photos/1200/800?random=26", 
            'metrics' => json_encode([['label' => "Ops Savings", 'value' => "$200k"], ['label' => "CSAT Increase", 'value' => "+45"]]), 
            'color' => "bg-slate-800"
        ]
    ];
    $stmt = $pdo->prepare("INSERT INTO case_studies (client, title, category, problem, solution, result, image_url, metrics, color) VALUES (?,?,?,?,?,?,?,?,?)");
    foreach ($cases as $c) $stmt->execute(array_values($c));

    // 9. LAB EXPERIMENTS
    $labs = [
        ['title' => "Neural Style Transfer", 'type' => "AI Research", 'desc' => "Real-time artistic style transfer in the browser.", 'img' => "https://images.unsplash.com/photo-1620712943543-bcc4688e7485?auto=format&fit=crop&q=80&w=800", 'tech' => "TensorFlow.js"],
        ['title' => "Fluid Simulation", 'type' => "WebGL Experiment", 'desc' => "High-performance physics simulation.", 'img' => "https://images.unsplash.com/photo-1478760329108-5c3ed9d495a0?auto=format&fit=crop&q=80&w=800", 'tech' => "Three.js / GLSL"]
    ];
    $stmt = $pdo->prepare("INSERT INTO lab_experiments (title, type, description, image_url, technology) VALUES (?,?,?,?,?)");
    foreach ($labs as $l) $stmt->execute(array_values($l));

    // 10. PROCESS STEPS
    $steps = [
        ['title' => "Discovery & Strategy", 'desc' => "We dive deep into your business goals...", 'icon' => "search", 'color' => "bg-google-blue", 'text' => "text-google-blue", 'order' => 1],
        ['title' => "Design & Prototyping", 'desc' => "Crafting intuitive, high-fidelity interfaces...", 'icon' => "pen-tool", 'color' => "bg-google-red", 'text' => "text-google-red", 'order' => 2],
        ['title' => "Agile Development", 'desc' => "Our engineering team builds with scalable architecture...", 'icon' => "code-2", 'color' => "bg-google-yellow", 'text' => "text-google-yellow", 'order' => 3],
        ['title' => "Launch & Deployment", 'desc' => "Seamless deployment protocols using CI/CD...", 'icon' => "rocket", 'color' => "bg-google-green", 'text' => "text-google-green", 'order' => 4],
        ['title' => "Growth & Optimization", 'desc' => "Post-launch analytics and iteration...", 'icon' => "line-chart", 'color' => "bg-purple-500", 'text' => "text-purple-500", 'order' => 5]
    ];
    $stmt = $pdo->prepare("INSERT INTO process_steps (title, description, icon_name, color_class, text_class, step_order) VALUES (?,?,?,?,?,?)");
    foreach ($steps as $s) $stmt->execute(array_values($s));

    // 11. TECH STACK
    $tech1 = ["React", "TypeScript", "Node.js", "Python", "TensorFlow", "Three.js", "WebGL", "AWS", "Docker", "GraphQL"];
    $tech2 = ["Next.js", "TailwindCSS", "Figma", "Blender", "PostgreSQL", "Redis", "Kubernetes", "Google Cloud", "OpenAI", "GSAP"];
    
    $stmt = $pdo->prepare("INSERT INTO tech_stack (name, row_num) VALUES (?,?)");
    foreach ($tech1 as $t) $stmt->execute([$t, 1]);
    foreach ($tech2 as $t) $stmt->execute([$t, 2]);

    // 12. COMPANY STATS
    $stats = [
        ['label' => "Global Offices", 'value' => 12, 'suffix' => "", 'icon' => "building-2"],
        ['label' => "Employees", 'value' => 500, 'suffix' => "+", 'icon' => "users"],
        ['label' => "Countries Served", 'value' => 42, 'suffix' => "", 'icon' => "globe"],
        ['label' => "Revenue Generated", 'value' => 1, 'suffix' => "B+", 'icon' => "trending-up"]
    ];
    $stmt = $pdo->prepare("INSERT INTO company_stats (label, value, suffix, icon_name) VALUES (?,?,?,?)");
    foreach ($stats as $s) $stmt->execute(array_values($s));

    // 13. SETTINGS
    $pdo->exec("INSERT INTO settings (site_name, site_tagline, about_title, about_description, stats_clients, stats_projects, stats_awards) VALUES 
    ('PrimeOrbit', 'Corporate Technology Company', 'Bridging enterprise ambition with reliable digital execution.', 'PrimeOrbit delivers scalable software, automation, and digital transformation programs.', '50+', '120+', '15+')");

    // 14. ADMIN USER
    $adminEmail    = 'admin@primeorbit.com';
    $adminPassword = password_hash('PrimeOrbit@1234', PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$adminEmail, $adminPassword]);

    echo "<h2 style='color:green'>Database Seeded Successfully With All Data!</h2>";

} catch (Exception $e) {
    echo "<h2 style='color:red'>Seeding Failed: " . $e->getMessage() . "</h2>";
}
?>




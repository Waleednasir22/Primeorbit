// Vanilla Three.js for Hero Background Scene
// Recreates the React-Three-fiber sphere distortion effect

let scene, camera, renderer, globe;
let clock = new THREE.Clock();

function initHeroScene() {
    const container = document.getElementById('hero-canvas-container');
    if (!container) return;

    // Scene Setup
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.z = 5;

    renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    container.appendChild(renderer.domElement);

    // Lights
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(ambientLight);

    const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
    directionalLight.position.set(10, 10, 5);
    scene.add(directionalLight);

    // Sphere with Distortion (Simplified for speed)
    const geometry = new THREE.SphereGeometry(1.5, 64, 64);
    const material = new THREE.MeshStandardMaterial({
        color: 0x4285F4,
        roughness: 0.2,
        metalness: 0.8,
        wireframe: false
    });

    globe = new THREE.Mesh(geometry, material);
    scene.add(globe);

    // Animation Loop
    function animate() {
        requestAnimationFrame(animate);
        
        const elapsed = clock.getElapsedTime();
        
        // Basic rotation logic
        globe.rotation.y = elapsed * 0.2;
        globe.rotation.x = elapsed * 0.1;

        // Blobby effect (Simplification of MeshDistortMaterial)
        const position = geometry.attributes.position;
        const vector = new THREE.Vector3();
        
        for (let i = 0; i < position.count; i++) {
            vector.fromBufferAttribute(position, i);
            const noise = Math.sin(vector.x * 2 + elapsed) * 0.1 + 
                          Math.sin(vector.y * 2 + elapsed * 1.5) * 0.1 + 
                          Math.sin(vector.z * 2 + elapsed * 2) * 0.1;
            vector.normalize().multiplyScalar(1.5 + noise);
            position.setXYZ(i, vector.x, vector.y, vector.z);
        }
        position.needsUpdate = true;

        renderer.render(scene, camera);
    }

    animate();

    // Handle Resize
    window.addEventListener('resize', onWindowResize, false);
}

function onWindowResize() {
    const container = document.getElementById('hero-canvas-container');
    if(!container) return;
    camera.aspect = container.clientWidth / container.clientHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(container.clientWidth, container.clientHeight);
}

// Start when document is ready
document.addEventListener('DOMContentLoaded', initHeroScene);

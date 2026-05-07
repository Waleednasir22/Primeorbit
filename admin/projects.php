<?php
require_once 'includes/header.php';
require_once '../config/db.php';

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$message = '';

// Handle Delete
if ($action === 'delete' && $id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: projects.php?message=deleted');
        exit;
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Handle Form Submission (Add/Edit)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $color = $_POST['color'];
    $challenges = $_POST['challenges'];
    $solution = $_POST['solution'];
    $technologies = json_encode(explode(',', $_POST['technologies']));
    $website_url = $_POST['website_url'] ?? null;

    // Handle Image Upload
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/projects/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_name = time() . '_' . basename($_FILES['project_image']['name']);
        $target_file = $upload_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow certain file formats
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES['project_image']['tmp_name'], $target_file)) {
                $image_url = 'uploads/projects/' . $file_name;
            }
        }
    }

    if ($id) {
        // Edit
        $stmt = $pdo->prepare("UPDATE projects SET title=?, category=?, description=?, image_url=?, color=?, challenges=?, solution=?, technologies=?, website_url=? WHERE id=?");
        $stmt->execute([$title, $category, $description, $image_url, $color, $challenges, $solution, $technologies, $website_url, $id]);
        $message = "Project updated successfully!";
    } else {
        // Add
        $stmt = $pdo->prepare("INSERT INTO projects (title, category, description, image_url, color, challenges, solution, technologies, website_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $category, $description, $image_url, $color, $challenges, $solution, $technologies, $website_url]);
        $message = "Project added successfully!";
    }
    $action = 'list';
}

// Success Messages from redirects
if (isset($_GET['message']) && $_GET['message'] === 'deleted') {
    $message = "Project deleted successfully!";
}
?>

<div class="flex justify-between items-center mb-8">
    <h3 class="text-2xl font-bold text-gray-900">Manage <span class="text-google-blue">Projects</span></h3>
    <?php if ($action === 'list'): ?>
        <a href="projects.php?action=add" class="px-6 py-3 bg-gray-900 text-white rounded-full font-bold hover:bg-google-blue transition-all flex items-center gap-2">
            <i data-lucide="plus" class="w-5 h-5"></i> Add New Project
        </a>
    <?php else: ?>
        <a href="projects.php" class="px-6 py-3 bg-white border border-gray-200 rounded-full font-bold hover:bg-gray-50 transition-all flex items-center gap-2">
            <i data-lucide="arrow-left" class="w-5 h-5"></i> Back to List
        </a>
    <?php endif; ?>
</div>

<?php if ($message): ?>
    <div class="bg-green-50 text-green-600 p-6 rounded-2xl mb-8 border border-green-100 font-bold flex items-center gap-3">
        <i data-lucide="check-circle" class="w-6 h-6"></i>
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<?php if ($action === 'list'): ?>
    <!-- Project List -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-400 text-xs font-bold uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-6">Project</th>
                    <th class="px-8 py-6">Category</th>
                    <th class="px-8 py-6">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php
                $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
                while ($row = $stmt->fetch()):
                    // Handle image path correctly for display
                    $display_img = $row['image_url'];
                    if (!str_starts_with($display_img, 'http')) {
                        $display_img = '../' . $display_img;
                    }
                ?>
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <img src="<?php echo $display_img; ?>" class="w-12 h-12 rounded-xl object-cover shadow-sm">
                                <span class="font-bold text-gray-900"><?php echo $row['title']; ?></span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-gray-600"><?php echo $row['category']; ?></td>
                        <td class="px-8 py-6">
                            <?php if ($row['website_url']): ?>
                                <a href="<?php echo $row['website_url']; ?>" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-google-blue hover:underline">
                                    <i data-lucide="external-link" class="w-3 h-3"></i> View Site
                                </a>
                            <?php else: ?>
                                <span class="text-xs text-gray-400 italic">No link</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <a href="projects.php?action=edit&id=<?php echo $row['id']; ?>" class="p-2 text-google-blue hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                    <i data-lucide="edit" class="w-5 h-5"></i>
                                </a>
                                <a href="projects.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this project?')" class="p-2 text-google-red hover:bg-red-50 rounded-lg transition-all" title="Delete">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

<?php elseif ($action === 'add' || $action === 'edit'): 
    $project = ['title'=>'', 'category'=>'', 'description'=>'', 'image_url'=>'', 'color'=>'bg-google-blue', 'challenges'=>'', 'solution'=>'', 'technologies'=>'', 'website_url'=>''];
    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->execute([$id]);
        $project = $stmt->fetch();
        if ($project['technologies']) {
            $project['technologies'] = implode(',', json_decode($project['technologies']));
        } else {
            $project['technologies'] = '';
        }
    }
?>
    <!-- Add/Edit Form -->
    <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm max-w-4xl">
        <form action="projects.php<?php echo $id ? '?id='.$id : ''; ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Project Title</label>
                    <input type="text" name="title" value="<?php echo $project['title']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Category</label>
                    <input type="text" name="category" value="<?php echo $project['category']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-1 gap-8">
                <div class="bg-blue-50/50 p-6 rounded-2xl border border-blue-100">
                    <label class="block text-sm font-bold text-google-blue mb-4">Project Imagery</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-2">Upload from Local</label>
                            <input type="file" name="project_image" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-google-blue outline-none transition-all text-sm">
                        </div>
                        <div class="flex items-center justify-center text-gray-400 font-bold">OR</div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-2">Provide Image URL</label>
                            <input type="text" name="image_url" value="<?php echo $project['image_url']; ?>" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-google-blue outline-none transition-all text-sm" placeholder="https://...">
                        </div>
                    </div>
                    <?php if ($project['image_url']): ?>
                        <div class="mt-4 p-2 bg-white rounded-xl border border-blue-100 flex items-center gap-3">
                            <?php 
                                $preview_img = $project['image_url'];
                                if (!str_starts_with($preview_img, 'http')) $preview_img = '../' . $preview_img;
                            ?>
                            <img src="<?php echo $preview_img; ?>" class="w-16 h-16 rounded-lg object-cover">
                            <div class="text-xs text-gray-500 truncate">Current: <?php echo $project['image_url']; ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Accent Color (CSS Class)</label>
                    <input type="text" name="color" value="<?php echo $project['color']; ?>" placeholder="bg-google-blue" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Website URL (Add 'http://' or 'https://')</label>
                    <input type="url" name="website_url" value="<?php echo $project['website_url']; ?>" placeholder="https://example.com" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
                </div>
            </div>
            
            <div>
                 <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Technologies (Comma separated)</label>
                <input type="text" name="technologies" value="<?php echo $project['technologies']; ?>" placeholder="React, PHP, Tailwind" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Description</label>
                <textarea name="description" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all h-32"><?php echo $project['description']; ?></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Challenges</label>
                    <textarea name="challenges" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all h-32"><?php echo $project['challenges']; ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Solution</label>
                    <textarea name="solution" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all h-32"><?php echo $project['solution']; ?></textarea>
                </div>
            </div>

            <button type="submit" class="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-xl hover:bg-google-blue transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-google-blue/20">
                <?php echo $id ? 'Update Project' : 'Add Project'; ?>
            </button>
        </form>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>

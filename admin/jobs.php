<?php
require_once 'includes/header.php';
require_once '../config/db.php';

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$message = '';

// Handle Delete
if ($action === 'delete' && $id) {
    $stmt = $pdo->prepare("DELETE FROM job_postings WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: jobs.php?message=deleted');
    exit;
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $department = $_POST['department'];
    $location = $_POST['location'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $requirements = json_encode(explode("\n", str_replace("\r", "", $_POST['requirements'])));

    if ($id) {
        $stmt = $pdo->prepare("UPDATE job_postings SET title=?, department=?, location=?, type=?, description=?, requirements=? WHERE id=?");
        $stmt->execute([$title, $department, $location, $type, $description, $requirements, $id]);
        $message = "Job updated!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO job_postings (title, department, location, type, description, requirements) VALUES (?,?,?,?,?,?)");
        $stmt->execute([$title, $department, $location, $type, $description, $requirements]);
        $message = "Job posted!";
    }
    $action = 'list';
}

if (isset($_GET['message'])) $message = "Action completed!";
?>

<div class="flex justify-between items-center mb-8">
    <h3 class="text-2xl font-bold text-gray-900">Manage <span class="text-google-red">Jobs</span></h3>
    <a href="jobs.php?action=<?php echo $action === 'list' ? 'add' : 'list'; ?>" class="px-6 py-3 bg-gray-900 text-white rounded-full font-bold hover:bg-google-red transition-all flex items-center gap-2">
        <i data-lucide="<?php echo $action === 'list' ? 'plus' : 'arrow-left'; ?>" class="w-5 h-5"></i> 
        <?php echo $action === 'list' ? 'Post Job' : 'Back to List'; ?>
    </a>
</div>

<?php if ($message): ?>
    <div class="bg-green-50 text-green-600 p-4 rounded-xl mb-8 border border-green-100 font-bold"><?php echo $message; ?></div>
<?php endif; ?>

<?php if ($action === 'list'): ?>
    <div class="space-y-4">
        <?php
        $stmt = $pdo->query("SELECT * FROM job_postings ORDER BY id DESC");
        while ($row = $stmt->fetch()):
        ?>
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6 hover:border-google-red transition-all group">
                <div class="flex-grow">
                    <div class="flex flex-wrap gap-2 mb-2">
                        <span class="text-[10px] bg-red-50 text-google-red px-2 py-0.5 rounded-full font-bold uppercase tracking-widest"><?php echo $row['department']; ?></span>
                        <span class="text-[10px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full font-bold uppercase tracking-widest"><?php echo $row['location']; ?></span>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 group-hover:text-google-red transition-colors"><?php echo $row['title']; ?></h4>
                </div>
                <div class="flex items-center gap-2">
                    <a href="jobs.php?action=edit&id=<?php echo $row['id']; ?>" class="p-2 text-google-blue hover:bg-blue-50 rounded-lg transition-all" title="Edit"><i data-lucide="edit" class="w-5 h-5"></i></a>
                    <a href="jobs.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')" class="p-2 text-google-red hover:bg-red-50 rounded-lg transition-all" title="Delete"><i data-lucide="trash-2" class="w-5 h-5"></i></a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: 
    $job = ['title'=>'', 'department'=>'Engineering', 'location'=>'Remote', 'type'=>'Full-time', 'description'=>'', 'requirements'=>''];
    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM job_postings WHERE id = ?");
        $stmt->execute([$id]);
        $job = $stmt->fetch();
        $job['requirements'] = implode("\n", json_decode($job['requirements'], true));
    }
?>
    <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm max-w-4xl mx-auto">
        <form action="jobs.php<?php echo $id ? '?id='.$id : ''; ?>" method="POST" class="space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                  <label class="block text-sm font-bold text-gray-700 mb-2">Job Title</label>
                  <input type="text" name="title" value="<?php echo $job['title']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-red focus:ring-4 focus:ring-google-red/10 outline-none transition-all">
                </div>
                <div>
                  <label class="block text-sm font-bold text-gray-700 mb-2">Department</label>
                  <input type="text" name="department" value="<?php echo $job['department']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-red focus:ring-4 focus:ring-google-red/10 outline-none transition-all">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div>
                  <label class="block text-sm font-bold text-gray-700 mb-2">Location</label>
                  <input type="text" name="location" value="<?php echo $job['location']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-red focus:ring-4 focus:ring-google-red/10 outline-none transition-all">
                </div>
                <div>
                  <label class="block text-sm font-bold text-gray-700 mb-2">Work Type</label>
                  <input type="text" name="type" value="<?php echo $job['type']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-red focus:ring-4 focus:ring-google-red/10 outline-none transition-all">
                </div>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                <textarea name="description" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl h-24 outline-none focus:border-google-red transition-all"><?php echo $job['description']; ?></textarea>
            </div>
             <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Requirements (Each line is a separate requirement)</label>
                <textarea name="requirements" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl h-48 outline-none focus:border-google-red transition-all"><?php echo $job['requirements']; ?></textarea>
            </div>
            <button type="submit" class="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-xl hover:bg-google-red transition-all transform hover:-translate-y-1">
                <?php echo $id ? 'Update Job' : 'Post Job'; ?>
            </button>
        </form>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>

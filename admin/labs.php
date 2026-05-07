<?php
require_once 'includes/header.php';
require_once '../config/db.php';

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$message = '';

// Handle Delete
if ($action === 'delete' && $id) {
    $stmt = $pdo->prepare("DELETE FROM lab_experiments WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: labs.php?message=deleted');
    exit;
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $technology = $_POST['technology'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE lab_experiments SET title=?, type=?, description=?, image_url=?, technology=? WHERE id=?");
        $stmt->execute([$title, $type, $description, $image_url, $technology, $id]);
        $message = "Experiment updated!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO lab_experiments (title, type, description, image_url, technology) VALUES (?,?,?,?,?)");
        $stmt->execute([$title, $type, $description, $image_url, $technology]);
        $message = "Experiment added!";
    }
    $action = 'list';
}

if (isset($_GET['message'])) $message = "Action completed!";
?>

<div class="flex justify-between items-center mb-8">
    <h3 class="text-2xl font-bold text-gray-900">Manage <span class="text-google-blue">Labs</span></h3>
    <a href="labs.php?action=<?php echo $action === 'list' ? 'add' : 'list'; ?>" class="px-6 py-3 bg-gray-900 text-white rounded-full font-bold hover:bg-google-blue transition-all flex items-center gap-2">
        <i data-lucide="<?php echo $action === 'list' ? 'plus' : 'arrow-left'; ?>" class="w-5 h-5"></i> 
        <?php echo $action === 'list' ? 'Add Experiment' : 'Back to List'; ?>
    </a>
</div>

<?php if ($message): ?>
    <div class="bg-green-50 text-green-600 p-4 rounded-xl mb-8 border border-green-100 font-bold"><?php echo $message; ?></div>
<?php endif; ?>

<?php if ($action === 'list'): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        $stmt = $pdo->query("SELECT * FROM lab_experiments ORDER BY id DESC");
        while ($row = $stmt->fetch()):
        ?>
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col hover:border-google-blue transition-all group">
                <img src="<?php echo $row['image_url']; ?>" class="h-48 w-full object-cover group-hover:scale-105 transition-transform">
                <div class="p-6 flex-grow">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="text-xl font-bold"><?php echo $row['title']; ?></h4>
                        <span class="text-xs bg-blue-50 text-google-blue px-2 py-1 rounded-full font-bold uppercase"><?php echo $row['type']; ?></span>
                    </div>
                    <p class="text-gray-500 text-sm mb-4"><?php echo $row['description']; ?></p>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest"><i data-lucide="cpu" class="w-3 h-3 inline-block mr-1"></i> <?php echo $row['technology']; ?></p>
                </div>
                <div class="p-4 border-t border-gray-50 flex justify-end gap-3">
                    <a href="labs.php?action=edit&id=<?php echo $row['id']; ?>" class="p-2 text-google-blue hover:bg-blue-50 rounded-lg"><i data-lucide="edit" class="w-5 h-5"></i></a>
                    <a href="labs.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')" class="p-2 text-google-red hover:bg-red-50 rounded-lg"><i data-lucide="trash-2" class="w-5 h-5"></i></a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: 
    $lab = ['title'=>'', 'type'=>'', 'description'=>'', 'image_url'=>'', 'technology'=>''];
    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM lab_experiments WHERE id = ?");
        $stmt->execute([$id]);
        $lab = $stmt->fetch();
    }
?>
    <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm max-w-2xl mx-auto">
        <form action="labs.php<?php echo $id ? '?id='.$id : ''; ?>" method="POST" class="space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                  <label class="block text-sm font-bold text-gray-700 mb-2">Title</label>
                  <input type="text" name="title" value="<?php echo $lab['title']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
                </div>
                <div>
                  <label class="block text-sm font-bold text-gray-700 mb-2">Type</label>
                  <input type="text" name="type" value="<?php echo $lab['type']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div>
                  <label class="block text-sm font-bold text-gray-700 mb-2">Image URL</label>
                  <input type="text" name="image_url" value="<?php echo $lab['image_url']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
                </div>
                <div>
                  <label class="block text-sm font-bold text-gray-700 mb-2">Technology</label>
                  <input type="text" name="technology" value="<?php echo $lab['technology']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
                </div>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                <textarea name="description" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl h-32 outline-none focus:border-google-blue transition-all"><?php echo $lab['description']; ?></textarea>
            </div>
            <button type="submit" class="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-xl hover:bg-google-blue transition-all transform hover:-translate-y-1">
                <?php echo $id ? 'Update Experiment' : 'Add Experiment'; ?>
            </button>
        </form>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>

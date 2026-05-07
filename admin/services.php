<?php
require_once 'includes/header.php';
require_once '../config/db.php';

$action = $_GET['action'] ?? 'list';
$id     = $_GET['id'] ?? null;
$message = '';

// Handle Delete
if ($action === 'delete' && $id) {
    $pdo->prepare("DELETE FROM services WHERE id = ?")->execute([$id]);
    header('Location: services.php?message=deleted');
    exit;
}

// Handle Add / Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = $_POST['title'];
    $description = $_POST['description'];
    $icon_name   = $_POST['icon_name'];
    $color       = $_POST['color'];

    if ($id) {
        $pdo->prepare("UPDATE services SET title=?, description=?, icon_name=?, color=? WHERE id=?")
            ->execute([$title, $description, $icon_name, $color, $id]);
        $message = "Service updated successfully!";
    } else {
        $pdo->prepare("INSERT INTO services (title, description, icon_name, color) VALUES (?,?,?,?)")
            ->execute([$title, $description, $icon_name, $color]);
        $message = "Service added successfully!";
    }
    $action = 'list';
}

if (isset($_GET['message']) && $_GET['message'] === 'deleted') {
    $message = "Service deleted successfully!";
}
?>

<div class="flex justify-between items-center mb-8">
    <h3 class="text-2xl font-bold text-gray-900">Manage <span class="text-google-blue">Services</span></h3>
    <?php if ($action === 'list'): ?>
        <a href="services.php?action=add" class="px-6 py-3 bg-gray-900 text-white rounded-full font-bold hover:bg-google-blue transition-all flex items-center gap-2">
            <i data-lucide="plus" class="w-5 h-5"></i> Add Service
        </a>
    <?php else: ?>
        <a href="services.php" class="px-6 py-3 bg-white border border-gray-200 rounded-full font-bold hover:bg-gray-50 transition-all flex items-center gap-2">
            <i data-lucide="arrow-left" class="w-5 h-5"></i> Back to List
        </a>
    <?php endif; ?>
</div>

<?php if ($message): ?>
    <div class="bg-green-50 text-green-600 p-5 rounded-2xl mb-8 border border-green-100 font-bold flex items-center gap-3">
        <i data-lucide="check-circle" class="w-5 h-5"></i> <?php echo $message; ?>
    </div>
<?php endif; ?>

<?php if ($action === 'list'): ?>
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-400 text-xs font-bold uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-5">Service</th>
                    <th class="px-8 py-5">Icon</th>
                    <th class="px-8 py-5">Color</th>
                    <th class="px-8 py-5">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php
                $stmt = $pdo->query("SELECT * FROM services ORDER BY id ASC");
                while ($row = $stmt->fetch()):
                ?>
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-8 py-5">
                        <p class="font-bold text-gray-900"><?php echo htmlspecialchars($row['title']); ?></p>
                        <p class="text-sm text-gray-400 mt-1"><?php echo htmlspecialchars(substr($row['description'], 0, 60)); ?>...</p>
                    </td>
                    <td class="px-8 py-5 text-gray-600 font-mono text-sm"><?php echo htmlspecialchars($row['icon_name']); ?></td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600"><?php echo htmlspecialchars($row['color']); ?></span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <a href="services.php?action=edit&id=<?php echo $row['id']; ?>" class="p-2 text-google-blue hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                <i data-lucide="edit" class="w-5 h-5"></i>
                            </a>
                            <a href="services.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this service?')" class="p-2 text-google-red hover:bg-red-50 rounded-lg transition-all" title="Delete">
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
    $svc = ['title' => '', 'description' => '', 'icon_name' => 'cpu', 'color' => 'text-google-blue'];
    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
        $stmt->execute([$id]);
        $svc = $stmt->fetch();
    }
?>
    <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm max-w-2xl">
        <form action="services.php<?php echo $id ? '?id='.$id : ''; ?>" method="POST" class="space-y-7">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Service Title</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($svc['title']); ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Description</label>
                <textarea name="description" required rows="3" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all"><?php echo htmlspecialchars($svc['description']); ?></textarea>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Lucide Icon Name</label>
                    <input type="text" name="icon_name" value="<?php echo htmlspecialchars($svc['icon_name']); ?>" placeholder="cpu, code, shield..." class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Color Class</label>
                    <select name="color" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue outline-none">
                        <?php foreach (['text-google-blue','text-google-red','text-google-yellow','text-google-green'] as $c): ?>
                            <option value="<?php echo $c; ?>" <?php echo $svc['color'] === $c ? 'selected' : ''; ?>><?php echo $c; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-lg hover:bg-google-blue transition-all shadow-lg">
                <?php echo $id ? 'Update Service' : 'Add Service'; ?>
            </button>
        </form>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>

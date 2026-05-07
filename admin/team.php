<?php
require_once 'includes/header.php';
require_once '../config/db.php';

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$message = '';

// Handle Delete
if ($action === 'delete' && $id) {
    $stmt = $pdo->prepare("DELETE FROM team_members WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: team.php?message=deleted');
    exit;
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $image_url = $_POST['image_url'];
    $bio = $_POST['bio'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE team_members SET name=?, role=?, image_url=?, bio=? WHERE id=?");
        $stmt->execute([$name, $role, $image_url, $bio, $id]);
        $message = "Member updated!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO team_members (name, role, image_url, bio) VALUES (?,?,?,?)");
        $stmt->execute([$name, $role, $image_url, $bio]);
        $message = "Member added!";
    }
    $action = 'list';
}

if (isset($_GET['message'])) $message = "Action completed!";
?>

<div class="flex justify-between items-center mb-8">
    <h3 class="text-2xl font-bold text-gray-900">Manage <span class="text-google-red">Team</span></h3>
    <a href="team.php?action=<?php echo $action === 'list' ? 'add' : 'list'; ?>" class="px-6 py-3 bg-gray-900 text-white rounded-full font-bold hover:bg-google-red transition-all flex items-center gap-2">
        <i data-lucide="<?php echo $action === 'list' ? 'plus' : 'arrow-left'; ?>" class="w-5 h-5"></i> 
        <?php echo $action === 'list' ? 'Add Member' : 'Back to List'; ?>
    </a>
</div>

<?php if ($message): ?>
    <div class="bg-green-50 text-green-600 p-4 rounded-xl mb-8 border border-green-100 font-bold"><?php echo $message; ?></div>
<?php endif; ?>

<?php if ($action === 'list'): ?>
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-400 text-xs font-bold uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-6">Member</th>
                    <th class="px-8 py-6">Role</th>
                    <th class="px-8 py-6">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php
                $stmt = $pdo->query("SELECT * FROM team_members ORDER BY id ASC");
                while ($row = $stmt->fetch()):
                ?>
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <img src="<?php echo $row['image_url']; ?>" class="w-12 h-12 rounded-full object-cover shadow-sm">
                                <span class="font-bold text-gray-900"><?php echo $row['name']; ?></span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-gray-500 font-medium"><?php echo $row['role']; ?></td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <a href="team.php?action=edit&id=<?php echo $row['id']; ?>" class="p-2 text-google-blue hover:bg-blue-50 rounded-lg transition-all" title="Edit"><i data-lucide="edit" class="w-5 h-5"></i></a>
                                <a href="team.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Remove member?')" class="p-2 text-google-red hover:bg-red-50 rounded-lg transition-all" title="Delete"><i data-lucide="trash-2" class="w-5 h-5"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php else: 
    $mem = ['name'=>'', 'role'=>'', 'image_url'=>'', 'bio'=>''];
    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM team_members WHERE id = ?");
        $stmt->execute([$id]);
        $mem = $stmt->fetch();
    }
?>
    <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm max-w-2xl mx-auto">
        <form action="team.php<?php echo $id ? '?id='.$id : ''; ?>" method="POST" class="space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                  <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                  <input type="text" name="name" value="<?php echo $mem['name']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-red focus:ring-4 focus:ring-google-red/10 outline-none transition-all">
                </div>
                <div>
                  <label class="block text-sm font-bold text-gray-700 mb-2">Role</label>
                  <input type="text" name="role" value="<?php echo $mem['role']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-red focus:ring-4 focus:ring-google-red/10 outline-none transition-all">
                </div>
            </div>
            <div>
              <label class="block text-sm font-bold text-gray-700 mb-2">Avatar URL</label>
              <input type="text" name="image_url" value="<?php echo $mem['image_url']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-red focus:ring-4 focus:ring-google-red/10 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Biography</label>
                <textarea name="bio" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl h-32 outline-none focus:border-google-red transition-all"><?php echo $mem['bio']; ?></textarea>
            </div>
            <button type="submit" class="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-xl hover:bg-google-red transition-all transform hover:-translate-y-1">
                <?php echo $id ? 'Update Member' : 'Add Member'; ?>
            </button>
        </form>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>

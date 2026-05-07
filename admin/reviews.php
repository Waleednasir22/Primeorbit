<?php
require_once 'includes/header.php';
require_once '../config/db.php';

$action  = $_GET['action'] ?? 'list';
$id      = $_GET['id'] ?? null;
$message = '';

// Handle Delete
if ($action === 'delete' && $id) {
    $pdo->prepare("DELETE FROM reviews WHERE id = ?")->execute([$id]);
    header('Location: reviews.php?message=deleted');
    exit;
}

// Handle Approve
if ($action === 'approve' && $id) {
    $pdo->prepare("UPDATE reviews SET status = 'approved' WHERE id = ?")->execute([$id]);
    header('Location: reviews.php?message=approved');
    exit;
}

// Handle Add / Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author        = $_POST['author'];
    $role          = $_POST['role'];
    $company       = $_POST['company'];
    $feedback_text = $_POST['feedback_text'];
    $rating        = (int) $_POST['rating'];
    $status        = $_POST['status'] ?? 'pending';

    $author_image  = $_POST['author_image'] ?? null;

    if ($id) {
        $pdo->prepare("UPDATE reviews SET author=?, role=?, company=?, author_image=?, feedback_text=?, rating=?, status=? WHERE id=?")
            ->execute([$author, $role, $company, $author_image, $feedback_text, $rating, $status, $id]);
        $message = "Review updated successfully!";
    } else {
        $pdo->prepare("INSERT INTO reviews (author, role, company, author_image, feedback_text, rating, status) VALUES (?,?,?,?,?,?,?)")
            ->execute([$author, $role, $company, $author_image, $feedback_text, $rating, $status]);
        $message = "Review added successfully!";
    }
    $action = 'list';
}

if (isset($_GET['message'])) {
    if ($_GET['message'] === 'deleted') $message = "Review deleted successfully!";
    if ($_GET['message'] === 'approved') $message = "Review approved successfully!";
}
?>

<div class="flex justify-between items-center mb-8">
    <h3 class="text-2xl font-bold text-gray-900">Manage <span class="text-google-green">Reviews</span></h3>
    <?php if ($action === 'list'): ?>
        <a href="reviews.php?action=add" class="px-6 py-3 bg-gray-900 text-white rounded-full font-bold hover:bg-google-green transition-all flex items-center gap-2">
            <i data-lucide="plus" class="w-5 h-5"></i> Add Review
        </a>
    <?php else: ?>
        <a href="reviews.php" class="px-6 py-3 bg-white border border-gray-200 rounded-full font-bold hover:bg-gray-50 transition-all flex items-center gap-2">
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
                    <th class="px-8 py-5">Author</th>
                    <th class="px-8 py-5">Company</th>
                    <th class="px-8 py-5">Rating</th>
                    <th class="px-8 py-5">Status</th>
                    <th class="px-8 py-5">Feedback</th>
                    <th class="px-8 py-5">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php
                $stmt = $pdo->query("SELECT * FROM reviews ORDER BY id DESC");
                while ($row = $stmt->fetch()):
                ?>
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-8 py-5">
                        <p class="font-bold text-gray-900"><?php echo htmlspecialchars($row['author']); ?></p>
                        <p class="text-xs text-gray-400 mt-1"><?php echo htmlspecialchars($row['role']); ?></p>
                    </td>
                    <td class="px-8 py-5 text-gray-600"><?php echo htmlspecialchars($row['company']); ?></td>
                    <td class="px-8 py-5">
                        <div class="flex gap-0.5 text-yellow-400">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i data-lucide="star" class="w-4 h-4 <?php echo $i <= $row['rating'] ? 'fill-yellow-400' : 'opacity-20'; ?>"></i>
                            <?php endfor; ?>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <?php if ($row['status'] === 'approved'): ?>
                            <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-bold uppercase tracking-widest">Approved</span>
                        <?php else: ?>
                            <span class="px-3 py-1 bg-yellow-50 text-yellow-600 rounded-full text-xs font-bold uppercase tracking-widest">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-8 py-5 text-gray-600 text-sm max-w-xs"><?php echo htmlspecialchars(substr($row['feedback_text'], 0, 80)); ?>...</td>
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <?php if ($row['status'] === 'pending'): ?>
                                <a href="reviews.php?action=approve&id=<?php echo $row['id']; ?>" class="p-2 text-google-green hover:bg-green-50 rounded-lg transition-all" title="Approve">
                                    <i data-lucide="check" class="w-5 h-5"></i>
                                </a>
                            <?php endif; ?>
                            <a href="reviews.php?action=edit&id=<?php echo $row['id']; ?>" class="p-2 text-google-blue hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                <i data-lucide="edit" class="w-5 h-5"></i>
                            </a>
                            <a href="reviews.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this review?')" class="p-2 text-google-red hover:bg-red-50 rounded-lg transition-all" title="Delete">
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
    $rev = ['author' => '', 'role' => '', 'company' => '', 'feedback_text' => '', 'rating' => 5];
    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM reviews WHERE id = ?");
        $stmt->execute([$id]);
        $rev = $stmt->fetch();
    }
?>
    <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm max-w-2xl">
        <form action="reviews.php<?php echo $id ? '?id='.$id : ''; ?>" method="POST" class="space-y-7">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Author Name</label>
                    <input type="text" name="author" value="<?php echo htmlspecialchars($rev['author']); ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Role / Title</label>
                    <input type="text" name="role" value="<?php echo htmlspecialchars($rev['role']); ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Company</label>
                    <input type="text" name="company" value="<?php echo htmlspecialchars($rev['company']); ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Rating (1–5)</label>
                    <select name="rating" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue outline-none">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <option value="<?php echo $i; ?>" <?php echo (int)$rev['rating'] === $i ? 'selected' : ''; ?>><?php echo $i; ?> ★</option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Author Image (URL)</label>
                <input type="url" name="author_image" value="<?php echo htmlspecialchars($rev['author_image'] ?? ''); ?>" placeholder="https://example.com/avatar.jpg" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Feedback</label>
                <textarea name="feedback_text" required rows="5" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue focus:ring-4 focus:ring-google-blue/10 outline-none transition-all"><?php echo htmlspecialchars($rev['feedback_text']); ?></textarea>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Status</label>
                <select name="status" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-blue outline-none">
                    <option value="pending" <?php echo ($rev['status'] ?? 'pending') === 'pending' ? 'selected' : ''; ?>>Pending Approval</option>
                    <option value="approved" <?php echo ($rev['status'] ?? 'pending') === 'approved' ? 'selected' : ''; ?>>Approved / Published</option>
                </select>
            </div>
            <button type="submit" class="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-lg hover:bg-google-green transition-all shadow-lg">
                <?php echo $id ? 'Update Review' : 'Add Review'; ?>
            </button>
        </form>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>

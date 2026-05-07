<?php
require_once 'includes/header.php';
require_once '../config/db.php';

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$message = '';

// Handle Delete
if ($action === 'delete' && $id) {
    $stmt = $pdo->prepare("DELETE FROM faqs WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: faqs.php?message=deleted');
    exit;
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE faqs SET question=?, answer=? WHERE id=?");
        $stmt->execute([$question, $answer, $id]);
        $message = "FAQ updated!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO faqs (question, answer) VALUES (?,?)");
        $stmt->execute([$question, $answer]);
        $message = "FAQ added!";
    }
    $action = 'list';
}

if (isset($_GET['message'])) $message = "Action completed!";
?>

<div class="flex justify-between items-center mb-8">
    <h3 class="text-2xl font-bold text-gray-900">Manage <span class="text-google-yellow">FAQs</span></h3>
    <a href="faqs.php?action=<?php echo $action === 'list' ? 'add' : 'list'; ?>" class="px-6 py-3 bg-gray-900 text-white rounded-full font-bold hover:bg-google-yellow hover:text-gray-900 transition-all flex items-center gap-2">
        <i data-lucide="<?php echo $action === 'list' ? 'plus' : 'arrow-left'; ?>" class="w-5 h-5"></i> 
        <?php echo $action === 'list' ? 'Add FAQ' : 'Back to List'; ?>
    </a>
</div>

<?php if ($message): ?>
    <div class="bg-green-50 text-green-600 p-4 rounded-xl mb-8 border border-green-100 font-bold"><?php echo $message; ?></div>
<?php endif; ?>

<?php if ($action === 'list'): ?>
    <div class="space-y-4">
        <?php
        $stmt = $pdo->query("SELECT * FROM faqs ORDER BY id DESC");
        while ($row = $stmt->fetch()):
        ?>
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex justify-between items-start gap-6 hover:border-google-yellow transition-all">
                <div class="flex-grow">
                    <h4 class="text-lg font-bold text-gray-900 mb-2"><?php echo $row['question']; ?></h4>
                    <p class="text-gray-500 text-sm line-clamp-2"><?php echo $row['answer']; ?></p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <a href="faqs.php?action=edit&id=<?php echo $row['id']; ?>" class="p-2 text-google-blue hover:bg-blue-50 rounded-lg transition-all"><i data-lucide="edit" class="w-5 h-5"></i></a>
                    <a href="faqs.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')" class="p-2 text-google-red hover:bg-red-50 rounded-lg transition-all"><i data-lucide="trash-2" class="w-5 h-5"></i></a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: 
    $faq = ['question'=>'', 'answer'=>''];
    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM faqs WHERE id = ?");
        $stmt->execute([$id]);
        $faq = $stmt->fetch();
    }
?>
    <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm max-w-2xl mx-auto">
        <form action="faqs.php<?php echo $id ? '?id='.$id : ''; ?>" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Question</label>
                <input type="text" name="question" value="<?php echo $faq['question']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-yellow outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Answer</label>
                <textarea name="answer" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl h-48 outline-none focus:border-google-yellow transition-all"><?php echo $faq['answer']; ?></textarea>
            </div>
            <button type="submit" class="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-xl hover:bg-google-yellow hover:text-gray-900 transition-all transform hover:-translate-y-1">
                <?php echo $id ? 'Update FAQ' : 'Add FAQ'; ?>
            </button>
        </form>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>

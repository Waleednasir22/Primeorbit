<?php
require_once 'includes/header.php';
require_once '../config/db.php';

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$message = '';

// Handle Delete
if ($action === 'delete' && $id) {
    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: blog.php?message=deleted');
    exit;
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $excerpt = $_POST['excerpt'];
    $category = $_POST['category'];
    $publish_date = $_POST['publish_date'];
    $image_url = $_POST['image_url'];
    $read_time = $_POST['read_time'];
    $author_name = $_POST['author_name'];
    $author_role = $_POST['author_role'];
    $author_image = $_POST['author_image'];
    $content = $_POST['content'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE articles SET title=?, excerpt=?, category=?, publish_date=?, image_url=?, read_time=?, author_name=?, author_role=?, author_image=?, content=? WHERE id=?");
        $stmt->execute([$title, $excerpt, $category, $publish_date, $image_url, $read_time, $author_name, $author_role, $author_image, $content, $id]);
        $message = "Article updated!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO articles (title, excerpt, category, publish_date, image_url, read_time, author_name, author_role, author_image, content) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$title, $excerpt, $category, $publish_date, $image_url, $read_time, $author_name, $author_role, $author_image, $content]);
        $message = "Article created!";
    }
    $action = 'list';
}

if (isset($_GET['message'])) $message = "Action completed!";
?>

<div class="flex justify-between items-center mb-8">
    <h3 class="text-2xl font-bold text-gray-900">Manage <span class="text-google-red">Articles</span></h3>
    <a href="blog.php?action=<?php echo $action === 'list' ? 'add' : 'list'; ?>" class="px-6 py-3 bg-gray-900 text-white rounded-full font-bold hover:bg-google-red transition-all flex items-center gap-2">
        <i data-lucide="<?php echo $action === 'list' ? 'plus' : 'arrow-left'; ?>" class="w-5 h-5"></i> 
        <?php echo $action === 'list' ? 'New Article' : 'Back to List'; ?>
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
                    <th class="px-8 py-6">Article</th>
                    <th class="px-8 py-6">Category</th>
                    <th class="px-8 py-6">Date</th>
                    <th class="px-8 py-6">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php
                $stmt = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC");
                while ($row = $stmt->fetch()):
                ?>
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <img src="<?php echo $row['image_url']; ?>" class="w-12 h-12 rounded-xl object-cover shadow-sm">
                                <span class="font-bold text-gray-900"><?php echo $row['title']; ?></span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-gray-500"><?php echo $row['category']; ?></td>
                        <td class="px-8 py-6 text-gray-400"><?php echo $row['publish_date']; ?></td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <a href="blog.php?action=edit&id=<?php echo $row['id']; ?>" class="p-2 text-google-blue hover:bg-blue-50 rounded-lg transition-all"><i data-lucide="edit" class="w-5 h-5"></i></a>
                                <a href="blog.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')" class="p-2 text-google-red hover:bg-red-50 rounded-lg transition-all"><i data-lucide="trash-2" class="w-5 h-5"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php else: 
    $art = ['title'=>'', 'excerpt'=>'', 'category'=>'', 'publish_date'=>date('M d, Y'), 'image_url'=>'', 'read_time'=>'5 min read', 'author_name'=>'', 'author_role'=>'', 'author_image'=>'', 'content'=>''];
    if ($id) {
        $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        $art = $stmt->fetch();
    }
?>
    <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm max-w-4xl mx-auto">
        <form action="blog.php<?php echo $id ? '?id='.$id : ''; ?>" method="POST" class="space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                   <label class="block text-sm font-bold text-gray-700 mb-2">Title</label>
                   <input type="text" name="title" value="<?php echo $art['title']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-red focus:ring-4 focus:ring-google-red/10 outline-none transition-all">
                </div>
                <div>
                   <label class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                   <input type="text" name="category" value="<?php echo $art['category']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-red focus:ring-4 focus:ring-google-red/10 outline-none transition-all">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div>
                   <label class="block text-sm font-bold text-gray-700 mb-2">Image URL</label>
                   <input type="text" name="image_url" value="<?php echo $art['image_url']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-red focus:ring-4 focus:ring-google-red/10 outline-none transition-all">
                </div>
                <div>
                   <label class="block text-sm font-bold text-gray-700 mb-2">Publish Date</label>
                   <input type="text" name="publish_date" value="<?php echo $art['publish_date']; ?>" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl">
                </div>
                <div>
                   <label class="block text-sm font-bold text-gray-700 mb-2">Read Time</label>
                   <input type="text" name="read_time" value="<?php echo $art['read_time']; ?>" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div>
                   <label class="block text-sm font-bold text-gray-700 mb-2">Author Name</label>
                   <input type="text" name="author_name" value="<?php echo $art['author_name']; ?>" required class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:border-google-red focus:ring-4 focus:ring-google-red/10 outline-none transition-all">
                </div>
                <div>
                   <label class="block text-sm font-bold text-gray-700 mb-2">Author Role</label>
                   <input type="text" name="author_role" value="<?php echo $art['author_role']; ?>" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl">
                </div>
                <div>
                   <label class="block text-sm font-bold text-gray-700 mb-2">Author Image</label>
                   <input type="text" name="author_image" value="<?php echo $art['author_image']; ?>" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl">
                </div>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Excerpt</label>
                <textarea name="excerpt" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl h-24"><?php echo $art['excerpt']; ?></textarea>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Content (HTML allowed)</label>
                <textarea name="content" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl h-64"><?php echo $art['content']; ?></textarea>
            </div>
            <button type="submit" class="w-full py-5 bg-gray-900 text-white rounded-2xl font-bold text-xl hover:bg-google-red transition-all transform hover:-translate-y-1">
                <?php echo $id ? 'Update Article' : 'Create Article'; ?>
            </button>
        </form>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>

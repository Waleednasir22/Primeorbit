<?php
require_once 'includes/header.php';
require_once '../config/db.php';

$message = '';
$messageType = 'green';

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'], $_POST['status'])) {
    $allowed = ['new', 'contacted', 'confirmed', 'closed'];
    $newStatus = $_POST['status'];
    if (in_array($newStatus, $allowed)) {
        $pdo->prepare("UPDATE bookings SET status = ? WHERE id = ?")
            ->execute([$newStatus, (int)$_POST['booking_id']]);
        $message = "Booking status updated to <strong>" . ucfirst($newStatus) . "</strong>.";
    }
}

// Handle delete
if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'delete') {
    $pdo->prepare("DELETE FROM bookings WHERE id = ?")->execute([(int)$_GET['id']]);
    header('Location: bookings.php?deleted=1');
    exit;
}
if (isset($_GET['deleted'])) {
    $message = "Booking deleted.";
    $messageType = 'red';
}

// Filter & fetch
$statusFilter = $_GET['status'] ?? 'all';
$sql = "SELECT * FROM bookings";
if ($statusFilter !== 'all') {
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE status = ? ORDER BY created_at DESC");
    $stmt->execute([$statusFilter]);
} else {
    $stmt = $pdo->query("SELECT * FROM bookings ORDER BY created_at DESC");
}
$bookings = $stmt->fetchAll();

// Counts per status
$counts = $pdo->query("SELECT status, COUNT(*) as cnt FROM bookings GROUP BY status")->fetchAll(PDO::FETCH_KEY_PAIR);
$total  = array_sum($counts);
?>

<div class="flex justify-between items-center mb-8">
    <div>
        <h3 class="text-2xl font-bold text-gray-900">Consultation <span class="text-google-blue">Bookings</span></h3>
        <p class="text-gray-500 mt-1"><?php echo $total; ?> total booking<?php echo $total != 1 ? 's' : ''; ?> received</p>
    </div>
    <div class="flex items-center gap-2 text-sm">
        <?php
        $statuses = ['all' => 'All', 'new' => 'New', 'contacted' => 'Contacted', 'confirmed' => 'Confirmed', 'closed' => 'Closed'];
        $colors   = ['all' => 'gray', 'new' => 'blue', 'contacted' => 'yellow', 'confirmed' => 'green', 'closed' => 'red'];
        foreach ($statuses as $key => $label):
            $isActive = $statusFilter === $key;
            $cnt = ($key === 'all') ? $total : ($counts[$key] ?? 0);
        ?>
        <a href="bookings.php?status=<?php echo $key; ?>"
           class="px-4 py-2 rounded-full font-bold transition-all <?php echo $isActive ? 'bg-gray-900 text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-gray-900'; ?>">
           <?php echo $label; ?> <?php if ($cnt > 0): ?><span class="ml-1 opacity-60"><?php echo $cnt; ?></span><?php endif; ?>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?php if ($message): ?>
<div class="bg-<?php echo $messageType; ?>-50 text-<?php echo $messageType; ?>-700 border border-<?php echo $messageType; ?>-100 p-4 rounded-2xl mb-6 font-medium flex items-center gap-2">
    <i data-lucide="check-circle" class="w-5 h-5"></i> <?php echo $message; ?>
</div>
<?php endif; ?>

<?php if (empty($bookings)): ?>
<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-20 text-center">
    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i data-lucide="calendar-x" class="w-8 h-8 text-gray-400"></i>
    </div>
    <h4 class="text-xl font-bold text-gray-900 mb-2">No bookings yet</h4>
    <p class="text-gray-400">When users fill the consultation form, their bookings will appear here.</p>
</div>
<?php else: ?>
<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-gray-400 text-xs font-bold uppercase tracking-widest border-b border-gray-100">
            <tr>
                <th class="px-8 py-5">#</th>
                <th class="px-8 py-5">Client</th>
                <th class="px-8 py-5">Service</th>
                <th class="px-8 py-5">Preferred Date</th>
                <th class="px-8 py-5">Submitted</th>
                <th class="px-8 py-5">Status</th>
                <th class="px-8 py-5">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            <?php foreach ($bookings as $b): 
                $statusColors = [
                    'new'       => 'bg-blue-50 text-blue-700 border-blue-100',
                    'contacted' => 'bg-yellow-50 text-yellow-700 border-yellow-100',
                    'confirmed' => 'bg-green-50 text-green-700 border-green-100',
                    'closed'    => 'bg-red-50 text-red-600 border-red-100',
                ];
                $sc = $statusColors[$b['status']] ?? 'bg-gray-50 text-gray-600';
            ?>
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="px-8 py-5 text-gray-400 font-mono text-sm">#<?php echo $b['id']; ?></td>

                <td class="px-8 py-5">
                    <p class="font-bold text-gray-900"><?php echo htmlspecialchars($b['name']); ?></p>
                    <a href="mailto:<?php echo htmlspecialchars($b['email']); ?>" class="text-sm text-google-blue hover:underline"><?php echo htmlspecialchars($b['email']); ?></a>
                </td>

                <td class="px-8 py-5">
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold"><?php echo htmlspecialchars($b['service']); ?></span>
                </td>

                <td class="px-8 py-5 text-gray-700 font-medium"><?php echo date('M d, Y', strtotime($b['preferred_date'])); ?></td>

                <td class="px-8 py-5 text-gray-400 text-sm"><?php echo date('M d, Y · g:ia', strtotime($b['created_at'])); ?></td>

                <td class="px-8 py-5">
                    <form method="POST" action="bookings.php" class="flex items-center gap-2">
                        <input type="hidden" name="booking_id" value="<?php echo $b['id']; ?>">
                        <select name="status" onchange="this.form.submit()"
                            class="px-3 py-2 text-xs font-bold border rounded-xl outline-none cursor-pointer <?php echo $sc; ?>">
                            <?php foreach (['new','contacted','confirmed','closed'] as $s): ?>
                                <option value="<?php echo $s; ?>" <?php echo $b['status'] === $s ? 'selected' : ''; ?>>
                                    <?php echo ucfirst($s); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </td>

                <td class="px-8 py-5">
                    <div class="flex items-center gap-3">
                        <!-- View details -->
                        <button onclick="toggleDetails(<?php echo $b['id']; ?>)"
                            class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-all" title="View Details">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                        <!-- Delete -->
                        <a href="bookings.php?action=delete&id=<?php echo $b['id']; ?>"
                            onclick="return confirm('Delete this booking? This cannot be undone.')"
                            class="p-2 text-google-red hover:bg-red-50 rounded-lg transition-all" title="Delete">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <!-- Details Expandable Row -->
            <tr id="details-<?php echo $b['id']; ?>" class="hidden bg-blue-50/40">
                <td colspan="7" class="px-8 py-5">
                    <div class="flex gap-8">
                        <div class="flex-1">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Project Details</p>
                            <p class="text-gray-700 leading-relaxed"><?php echo nl2br(htmlspecialchars($b['details'])); ?></p>
                        </div>
                        <div class="text-right text-sm text-gray-400 shrink-0">
                            <p>Booking <span class="font-mono font-bold text-gray-600">#<?php echo $b['id']; ?></span></p>
                            <a href="mailto:<?php echo htmlspecialchars($b['email']); ?>?subject=Re: Your Consultation Request for <?php echo urlencode($b['service']); ?>"
                                class="mt-3 inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 text-white rounded-full text-xs font-bold hover:bg-google-blue transition-all">
                                <i data-lucide="mail" class="w-4 h-4"></i> Reply via Email
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<script>
function toggleDetails(id) {
    var row = document.getElementById('details-' + id);
    row.classList.toggle('hidden');
}
</script>

<?php require_once 'includes/footer.php'; ?>

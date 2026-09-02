<!-- views/orders/checks.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Order Checks</title>
    <link rel="stylesheet" href="/public/css/orders.css">
</head>
<body>
    <div class="container">
        <h1>📊 Order Checks</h1>
        
        <!-- Filters -->
        <form method="GET" action="/admin/checks" class="filters">
            <div class="filter-group">
                <label>From Date:</label>
                <input type="date" name="from_date" value="<?= htmlspecialchars($fromDate) ?>">
            </div>
            
            <div class="filter-group">
                <label>To Date:</label>
                <input type="date" name="to_date" value="<?= htmlspecialchars($toDate) ?>">
            </div>
            
            <div class="filter-group">
                <label>User:</label>
                <select name="user_id">
                    <option value="all" <?= $userId === 'all' ? 'selected' : '' ?>>All Users</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>" <?= $userId == $user['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($user['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit">Apply Filters</button>
        </form>
        
        <!-- Results -->
        <table class="checks-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Orders Count</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($reportData)): ?>
                    <tr><td colspan="4">No orders found</td></tr>
                <?php else: ?>
                    <?php foreach ($reportData as $userId => $data): ?>
                        <tr>
                            <td>
                                <a href="/admin/order-details/user/<?= $userId ?>" class="user-link">
                                    <?= htmlspecialchars($data['user_name']) ?>
                                </a>
                            </td>
                            <td><?= $data['order_count'] ?></td>
                            <td><?= number_format($data['total_amount'], 2) ?> EGP</td>
                            <td>
                                <button onclick="viewUserOrders(<?= $userId ?>, '<?= $fromDate ?>', '<?= $toDate ?>')">
                                    View Orders
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <script src="/public/js/orders.js"></script>
</body>
</html>
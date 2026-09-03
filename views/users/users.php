<?php require BASE_PATH . "/views/layouts/header.php"; ?>
<link rel="stylesheet" href="public/css/users.css">
<?php require BASE_PATH . "/views/layouts/navbar.php"; ?>

<main class="main-content" style="padding-top: 120px; padding-bottom: 60px;">
    <div class="header-actions">
        <h2>User List</h2>
        <a href="/add-user" class="btn-add">+ Add New User</a>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>USER</th>
                    <th>EMAIL</th>
                    <th>ROOM</th>
                    <th>EXT.</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td>
                        <div class="user-info">
                            <?php if (!empty($u['user_image'])): ?>
                                <img src="/<?php echo htmlspecialchars($u['user_image']); ?>" alt="Avatar" 
                                class="avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            <?php else: ?>
                                <div class="avatar">User</div>
                            <?php endif; ?>
                            <span><?php echo htmlspecialchars($u['user_name']); ?></span>
                        </div>
                    </td>
                    <td><?php echo htmlspecialchars($u['user_email']); ?></td>
                    <td><?php echo htmlspecialchars($u['room_number'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($u['ext'] ?? 'N/A'); ?></td>
                    <td>
                        <a href="/add-user?id=<?php echo $u['user_id']; ?>" class="btn-edit">Edit</a>
                        <a href="/delete-user?id=<?php echo $u['user_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require BASE_PATH . "/views/layouts/footer.php"; ?>
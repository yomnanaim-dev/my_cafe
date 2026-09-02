<?php require BASE_PATH . "/views/layouts/header.php"; ?>
<link rel="stylesheet" href="public/css/add_users.css">
<?php require BASE_PATH . "/views/layouts/navbar.php"; ?>

<main class="main-content" style="padding-top: 100px; padding-bottom: 40px;">
    <div class="form-card">
        <div class="header-nav">
            <h2 class="form-title"><?php echo isset($user) ? 'Edit User' : 'Add New User'; ?></h2>
            <a href="/users" class="btn-back">← All Users</a>
        </div>

        <form id="userForm" action="" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter user name" value="<?php echo $user['user_name'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="user@example.com" value="<?php echo $user['user_email'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" minlength="6" <?php echo isset($user) ? '' : 'required'; ?>>
            </div>

            <div class="form-group">
                <label for="room_no">Room No.</label>
                <select id="room_no" name="room_no" class="form-control" required>
                    <option value="">Select Room</option>
                    <?php foreach ($rooms as $room): ?>
                        <?php $selected = (isset($user) && $user['room_id'] == $room['room_id']) ? 'selected' : ''; ?>
                        <option value="<?php echo $room['room_id']; ?>" <?php echo $selected; ?>>
                            <?php echo $room['room_number']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="ext">Ext.</label>
                <input type="text" id="ext" name="ext" class="form-control" placeholder="e.g. 102" value="<?php echo $user['ext'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="profile_pic">User Image</label>
                <input type="file" id="profile_pic" name="profile_pic" class="form-control" accept="image/*" onchange="previewImage(event)">
                <img id="imagePreview" class="img-preview" src="/<?php echo $user['user_image'] ?? ''; ?>" alt="User Image Preview" style="<?php echo (!empty($user['user_image'])) ? 'display:block; width:100px; height:100px; margin-top:10px; border-radius:8px; object-fit:cover;' : 'display:none;'; ?>">
            </div>

            <div class="btn-container">
                <button type="submit" class="btn-submit"><?php echo isset($user) ? 'Update User' : 'Save User'; ?></button>
                <a href="/users" class="btn-reset">Cancel</a>
            </div>

        </form>
    </div>
</main>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
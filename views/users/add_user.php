<?php require "views/layouts/header.php"; ?>
<link rel="stylesheet" href="public/css/add_users.css">
<?php require "views/layouts/navbar.php"; ?>

<main class="main-content" style="padding-top: 100px; padding-bottom: 40px;">
    <div class="form-card">
        <div class="header-nav">
            <h2 class="form-title">Add New User</h2>
            <a href="/users" class="btn-back">← All Users</a>
        </div>

        <form id="userForm" action="" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter user name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="user@example.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" minlength="6" required>
            </div>

            <div class="form-group">
                <label for="room_no">Room No.</label>
                <select id="room_no" name="room_no" class="form-control" required>
                    <option value="">Select Room</option>
                    <option value="Application1">Application1</option>
                    <option value="Application2">Application2</option>
                    <option value="Cloud">Cloud</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ext">Ext.</label>
                <input type="text" id="ext" name="ext" class="form-control" placeholder="e.g. 102" required>
            </div>

            <div class="form-group">
                <label for="profile_pic">User Image</label>
                <input type="file" id="profile_pic" name="profile_pic" class="form-control" accept="image/*" onchange="previewImage(event)">
                <img id="imagePreview" class="img-preview" alt="User Image Preview">
            </div>

            <div class="btn-container">
                <button type="submit" class="btn-submit">Save User</button>
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
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
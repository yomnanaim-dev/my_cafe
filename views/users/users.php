
<?php require "views/layouts/header.php"; ?>
<link rel="stylesheet" href="public/css/users.css">
<?php require "views/layouts/navbar.php"; ?>

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
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="avatar">User</div>
                            <span>Abdulrahman Hamdy</span>
                        </div>
                    </td>
                    <td>mohamed@example.com</td>
                    <td>302</td>
                    <td>105</td>
                    <td>
                        <a href="/add-user?id=1" class="btn-edit">Edit</a>
                        <a href="#" class="btn-delete">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="avatar">User</div>
                            <span>Sarah Jenkins</span>
                        </div>
                    </td>
                    <td>sarah@example.com</td>
                    <td>201</td>
                    <td>102</td>
                    <td>
                        <a href="/add-user?id=2" class="btn-edit">Edit</a>
                        <a href="#" class="btn-delete">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
<?php require "views/layouts/footer.php"; ?>
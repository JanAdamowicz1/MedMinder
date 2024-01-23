<!DOCTYPE html>
<html>
<body>
    <a href="account">
    <button class="button"><i class="fa-solid fa-user"></i> Account</button>
    </a>
    <a href="settings">
        <button class="button"><i class="fa-solid fa-cog"></i> Settings</button>
    </a>
    <button class="button help"><i class="fa-solid fa-question"></i> Help</button>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
    <a href="adminPanel">
        <button class="button"><i class="fa-solid fa-tools"></i> Admin Panel</button>
    </a>
    <?php endif; ?>
    <button class="button"><a href="logout"><i class="fa-solid fa-right-from-bracket"></i></i> Log out</a></button>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Masters Maintenance</title>
<!--Scripts-->
    <script src="script1.js"></script>
    
<!--Stylesheets-->
    <link rel="stylesheet" href="superPage.css">

<!--Font and Icons-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

</head>

<body>
<!--Header-->
<div class="panel">
    <header class="top-bar">
        <div class="left-section">
            <img src="" alt="Open" class="icon " title="Open Sidebar" />
            <p class="page-title">The Masters Maintenance</p>
        </div>
        
        <div class="account-section">
            <span>User-Type</span>
            <img src="" alt="user"  class="icon" title="User">
            <div class="dropdown">
                <img src="" id="trigger-popup" class="icon" alt="options" title="Options" onclick="toggleDropdown()">
                <div id="dropdown-menu" class="dropdown-content">
                    <a href="#" class="dropdown-item">Help</a>
                    <a href="#" class="dropdown-item">Logout</a>
                </div>
            </div>
    </header>
    <!--Background image section, just under top bar-->
    <section class="Under-Top-Bar-section">
        <div class="utbs-text">
            <p class="utbs-title">Report A Maintenance Issue</p>
            <p class="utbs-subtitle">Name of Residence</p><!--This name will be set using php-->
        </div>
    </section>
    <!-- Main content area -->
    <div class="content">
    </div>
</div>
</body>
</html>

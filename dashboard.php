<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Masters Maintenance</title>
<!--Scripts-->
    <script src="mainScript.js"></script>
<!--Stylesheets-->

    <link rel="stylesheet" href="superPage.css">
    <link rel="stylesheet" href="EditButtonModal.css">
    <link rel="stylesheet" href="MyDashboard.css">

<!--Font and Icons-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
<!--Header-->
<div class="panel">
<header>
        <div class="header-panel">
            <div id="mySidebar" class="sidebar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <a class="roboto-bold" href="#">Dashboard</a>
                <a class="roboto-bold" href="#">My Tickets</a>
                
              </div>
              
              <div id="main">
                <button class="openbtn" onclick="openNav()"><i class="fa-solid fa-bars"></i></button>  
              
              </div>

        <h1 class="roboto-bold">MasterFix</h1>

        <div class="right-bar">
            <ul class="navigation">
                <li><li><a href="#">User-Type</a></li></li>
                <li><a href="login/create.php"><i class="fa-solid fa-user" style="font-size: 20px;"></i></a></li>
                <li>
                    <div>
                        <i class="fa-solid fa-ellipsis-vertical" style="font-size: 20px;"></i>
                        <div class="dropdown-content">
                            <a href="#">Option 1</a>
                            <a href="#">Option 2</a>
                            <a href="#">Option 3</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        </div>   
    </header>
    <!--Background image section, just under top bar-->
    <section class="Under-Top-Bar-section">
        <div class="utbs-text">
            <p class="utbs-title">My Dashboard</p>
            <p class="utbs-subtitle">Name of Residence</p><!--This name will be set using php-->
        </div>
    </section>

    <section class="segmented-buttons">
        <button class="segment-btn left">Resolved</button>
        <button class="segment-btn right">Pending/Other</button>
    </section>

    <!-- Main content area -->
    <div class="content">
        <div class="tickets-list">
            <div class="ticket-separator"></div>        <!--this is the line that separates the tickets-->
            <div class="ticket-item">
                <div class="ticket-icon">
                    <img src="path_to_icon.png" alt="Icon" />
                </div>
                <div class="ticket-info"><!--This will be dynamically generated from the database-->
                    <h4>Faulty Wall Socket</h4>
                    <p>Category · Electrical · Reported on 10 June 2024</p>
                    <p>Maintenance issue resolved on 23 June 2024</p>
                </div>
                <div class="ticket-actions">
                    <button class="edit-btn"><i class="fa-solid fa-pen"></i></button>
                    <button class="delete-btn"><i class="fa-solid fa-trash"></i></button>
                    <!--<button class="edit-btn" data-ticket-id="?php echo $ticket['id']; ?>"><img src="edit_icon.png" alt="Edit"></button>-->
                    <!--<button class="delete-btn" data-ticket-id="?php echo $ticket['id']; ?>"><img src="delete_icon.png" alt="Delete"></button>-->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Ticket Popup Modal -->
    <div id="editTicketModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Ticket</h2>
            <p>Use the form below to resubmit the ticket if issue has reoccured</p>
            <form id="editTicketForm">
                <!-- Ticket details will be dynamically inserted here -->
                <input type="hidden" name="ticket_id" id="ticketId">
                <label for="ticketTitle">Maintenance Issue:</label>
                <input type="text" name="title" id="ticketTitle" readonly>
                <label for="ticketCategory">Category:</label>
                <input type="text" name="category" id="ticketCategory" readonly>
                <label for="ticketDescription">Description:</label>
                <textarea name="description" id="ticketDescription" ></textarea>
                <button type="submit">Resubmit Ticket</button>
            </form>
        </div>
</div>
<!--Scripts-->
<script src="DashboardItemModal.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="superPage.css">
    <link rel="stylesheet" href="modal.css">
    <link rel="stylesheet" href="mydashboard.css">
    <script src="mainScript.js"></script>
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
          <div id="options" class="dropdown-content">
            <a href="#" class="dropdown-item">Help</a>
            <a href="#" class="dropdown-item">Logout</a>
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
      <div class="card">
        <div class="tickets-list">
          <div class="ticket-separator"></div>        <!--this is the line that separates the tickets-->
          <div class="ticket-item">
              <div class="ticket-icon">
                  <img src="images/light-bulb-with-electrical.jpg" alt="icon" class="icon" >
              </div>
              <div class="ticket-info">
                  <h4>Faulty Wall Socket</h4>
                  <p>Category · Electrical · Reported on 10 June 2024</p>
                  <p>Maintenance issue resolved on 23 June 2024</p>
              </div>
              <div class="ticket-actions">
                  <button class="edit-btn"><img src="edit_icon.png" alt="Edit"></button>
                  <button class="delete-btn"><img src="delete_icon.png" alt="Delete"></button>
                  <!--<button class="edit-btn" data-ticket-id="?php echo $ticket['id']; ?>"><img src="edit_icon.png" alt="Edit"></button>-->
                  <!--<button class="delete-btn" data-ticket-id="?php echo $ticket['id']; ?>"><img src="delete_icon.png" alt="Delete"></button>-->
              </div>
          </div>
        </div>
      </div>

    </div>
    <!-- Popups -->
    <div id="editTicketModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Ticket</h2>
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



<!-- javascript -->
<script src="script1.js"></script>
</body>
</html>
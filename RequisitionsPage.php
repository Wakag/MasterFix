<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Requisitions</title> 
<!--Stylesheets-->
    <link rel="stylesheet" href="superPage.css">
    <link rel="stylesheet" href="RequisitionsPageTable.css">
<!--Font and Icons-->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
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
          <img src="" id="trigger-popup" class="icon" alt="options" title="Options" onclick="toggleDropdown('options')">
          <div id="options" class="dropdown-content">
            <a href="#" class="dropdown-item">Help</a>
            <a href="#" class="dropdown-item">Logout</a>
          </div>
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
    <!-- Table Manipulation Controls -->
    <div class="table-controls">
      <div class="dropdown">
          <p id="filter" class="filter" onclick="toggleDropdown('filter-menu')">Filter by</p>
          <div id="filter-menu" class="dropdown-content">
              <a href="#" class="dropdown-item" onclick="updateText('filter', 'My Tickets')">My Tickets</a>
              <a href="#" class="dropdown-item" onclick="updateText('filter', 'General Maintenance')">General Maintenance</a>
              <a href="#" class="dropdown-item" onclick="updateText('filter', 'Electrical')">Electrical</a>
              <a href="#" class="dropdown-item" onclick="updateText('filter', 'Plumbing')">Plumbing</a>
              <a href="#" class="dropdown-item" onclick="updateText('filter', 'Carpentry')">Carpentry</a>
          </div>
      </div>
      <div class="dropdown">
          <p id="sort" class="sort" onclick="toggleDropdown('sort-menu')">Sort by</p>
          <div id="sort-menu" class="dropdown-content">
              <a href="#" class="dropdown-item" onclick="updateText('sort', 'Sort by Name')">Sort by Name</a>
              <a href="#" class="dropdown-item" onclick="updateText('sort', 'Sort by Date')">Sort by Date</a>
              <a href="#" class="dropdown-item" onclick="updateText('sort', 'Sort by Priority')">Sort by Priority</a>
          </div>
      </div>
    </div>

    <!-- Main content area -->
    <div class="content">
      <div class="table">
        <?php
          require_once("config.php");
          $conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error );
          }
          
          $sql = "SELECT 
                    t.TicketID, 
                    t.Status, 
                    t.CreationDate, 
                    t.Description, 
                    t.TicketStudentID, 
                    r.ResName, 
                    t.TicketCategory, 
                    t.ResolutionDate, 
                    w.Name,
                    w.LastName
                  FROM
                    ticket t
                  JOIN
                    residence r ON t.TicketResID = r.ResID
                  JOIN
                    warden w ON t.TicketWardenID = w.wardenID
                  ORDER BY TicketID";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              echo "<table border='1'>";
              echo "<tr>
              <th>Requisition Number</th>
              <th>Status</th>
              <th>Requisitioned On</th>
              <th>Title</th>
              <th>Student ID</th>
              <th>Residence Name</th>
              <th>Issue Category</th>
              <th>Resolved On</th>
              <th>Warden Name</th>
              </tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<tr onclick=\"window.location.href='ViewRequisitionPage.php?id=" . $row["TicketID"] . "'\">
                          <td>" . ($row["TicketID"]) . "</td>
                          <td>" . ($row["Status"]) . "</td>
                          <td>" . ($row["CreationDate"]) . "</td>
                          <td>" . ($row["Description"]) . "</td>
                          <td>" . ($row["TicketStudentID"]) . "</td>
                          <td>" . ($row["ResName"]) . "</td>
                          <td>" . ($row["TicketCategory"]) . "</td>
                          <td>" . ($row["ResolutionDate"]) . "</td>
                          <td>" . ($row["Name"]." ".$row["LastName"]). "</td>
                          </tr>";
              }
              echo "</table>";
          } else {
              echo "No tickets found";
          }
          $conn->close();  
        ?>
      </div>
    </div>
</div>
<!--Scripts-->

<script src="RequisitionsTable.js"></script>
</body>
</html>

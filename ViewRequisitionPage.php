<?php
require_once("config.php");

if (isset($_GET['id'])) {
    $ticketID = $_GET['id'];
    $conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT 
                s.Name,
                s.LastName, 
                s.RoomNumber, 
                r.ResName, 
                t.TicketStudentID,
                t.Description,
                t.TicketCategory,
                t.CreationDate,
                t.Status 
            FROM 
                ticket t
            JOIN 
                student s ON t.TicketStudentID= s.StudentID
            JOIN
                residence r ON t.TicketResID= r.ResID
            WHERE ticketID = ?";
    $stmt = $conn->prepare($sql);
    // Check if the prepare() function failed
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $ticketID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
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
    <style>
        /* Container styling */
        /* Input and label styling */
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #f9f9f9;
            resize: none; /* For textarea */
        }
        textarea {
            grid-column: span 2;
            height: 100px;
        }
        /* Buttons styling */
.buttons {
    grid-column: span 2;
    text-align: right;
}

/* Buttons*/
.primary {
    width: 140px;
    padding: 10px;
    margin-top: 20px;
    background-color: #65558F;
    color: white;
    text-align: center;
    border-radius: 40px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.secondary{
    width: 140px;
    padding: 10px;
    margin-top: 20px;
    background-color: #21005d;
    color: white;
    text-align: center;
    border-radius: 40px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.primary:hover {
    background-color: #CE93D8;
}
    </style>
<!--Font and Icons-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600&display=swap" rel="stylesheet">

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
    <div class="content" >
        
    <!--<h1>Manage Requisition</h1>-->
    <form>
    <h2><?php echo "Showing Requisition ".$ticketID?></h2>
        <label for="studentName">Student Name</label>
        <input type="text" id="studentName" name="studentName" value="<?php echo htmlspecialchars($row['Name']." ".$row['LastName']); ?>" readonly><br>

        <label for="studentNumber">Student Number</label>
        <input type="text" id="studentNumber" name="studentNumber" value="<?php echo htmlspecialchars($row['TicketStudentID']); ?>" readonly><br>

        <label for="ResName">Residence Name</label>
        <input type="text" id="resName" name="resName" value="<?php echo htmlspecialchars($row['ResName']); ?>" readonly><br>

        <label for="RoomNumber">Room Number</label>
        <input type="text" id="RoomNumber" name="RoomNumber" value="<?php echo htmlspecialchars($row['RoomNumber']); ?>" readonly><br>

        <label for="MaintenanceIssue">Maintenance Issue</label>
        <input type="text" id="MaintenanceIssue" name="MaintenanceIssue" value="<?php echo htmlspecialchars($row['Description']); ?>" readonly><br>

        <label for="Category">Category</label>
        <input type="text" id="Category" name="Category" value="<?php echo htmlspecialchars($row['TicketCategory']); ?>" readonly><br>

        <label for="requisitionDate">Date of Requisition</label>
        <input type="text" id="requisitionDate" name="requisitionDate" value="<?php echo htmlspecialchars($row['CreationDate']); ?>" readonly><br>
    
        <label for="status">Ticket Status</label>
        <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($row['Status']); ?>" readonly><br>

        <label for="StudentComments">Student's Comments</label>
        <textarea id="StudentComments" name="StudentComments" placeholder="Student's comments here" readonly ></textarea><br>

        <div class="buttons">
            <button class="primary" onclick="openPopup('editCommentsPopup')" title="Add/edit a comment">Add/Edit comments</button>
            <button class="primary" onclick="openPopup('editStatusPopup')" title="Change this ticket's status">Edit Status</button>
            <button class="secondary" title="Close this ticket">Close Ticket</button>
        </div>
    </form>
    </div>
</div>
</body>
</html>
<?php
    } else {
        echo "No record found";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
               
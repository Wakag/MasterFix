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
    <link rel="stylesheet" href="NewTicketFormPage.css">
<!--Font and Icons-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
<?php
    // Include your database connection
    require 'config.php';

    // Define a variable to hold success or error messages
    $message = '';

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collect form data
        $title = $_POST['title'];
        $category = $_POST['category'];
        $description = $_POST['description'];
    
        $studentId = "22M6578"; // Assuming student ID is fetched from session or elsewhere
        $residenceId = 1; // Assuming residence ID is known
        $status = 'submitted'; // Default status for a new ticket
    
        // Handle file upload
        if (!empty($_FILES['upload']['name'])) {
            $targetDir = "uploads/";
            $fileName = basename($_FILES["upload"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
            // Allow only specific file formats
            $allowedTypes = array('jpg', 'png', 'jpeg');
            if (in_array($fileType, $allowedTypes)) {
                // Move file to the server
                if (move_uploaded_file($_FILES["upload"]["tmp_name"], $targetFilePath)) {
                    // Insert ticket into the 'ticket' table
                    $stmt = $mysqli->prepare("INSERT INTO ticket (TicketID, Status, CreationDate, TicketStudentID, TicketCategory, Description, TicketResID, Title) 
                                              VALUES (UUID(), ?, NOW(), ?, ?, ?, ?, ?)");
                    if (!$stmt) {
                        die("SQL error: " . $mysqli->error);
                    }
                    $stmt->bind_param("ssssss", $status, $studentId, $category, $description, $residenceId, $title);
                    $stmt->execute();
    
                    // Get the last inserted ticket ID
                    $ticketId = $mysqli->insert_id;
    
                    // Insert picture into 'picture' table
                    $stmt = $mysqli->prepare("INSERT INTO picture (PictureID, Path, TicketID) VALUES (UUID(), ?, ?)");
                    $stmt->bind_param("si", $targetFilePath, $ticketId);
                    $stmt->execute();
    
                    $message = "Ticket submitted successfully!";
                } else {
                    $message = "Sorry, there was an error uploading your file.";
                }
            } else {
                $message = "Sorry, only JPG, JPEG, & PNG files are allowed.";
            }
        } else {
            // If no file uploaded, still insert the ticket without a picture
            $stmt = $mysqli->prepare("INSERT INTO ticket (TicketID, Status, CreationDate, TicketStudentID, TicketCategory, Description, TicketResID, Title) 
                                      VALUES (UUID(), ?, NOW(), ?, ?, ?, ?, ?)");
            if (!$stmt) {
                die("SQL error: " . $mysqli->error);
            }
            $stmt->bind_param("ssssss", $status, $studentId, $category, $description, $residenceId, $title);
            $stmt->execute();
    
            $message = "Ticket submitted successfully without a picture!";
        }
    }
    ?>
    <!--Header-->
    <div class="panel">
    <header class="top-bar">
        <div class="left-section">
            <img src="" alt="Open" class="icon " title="Open Sidebar" />
            <p class="page-title">The Masters Maintenance</p>
        </div>
        
        <div class="account-section">
            <span>User-Type</span>
            <img src=" " alt="user"  class="icon" title="User">
            <div class="dropdown">
              <img src=" " id="trigger-popup" class="icon" alt="options" title="Options" onclick="toggleDropdown()">
              <div id="options" class="dropdown-content">
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
    <form action="" method="POST" class="form-container" enctype="multipart/form-data">
        <div class="form-content">
            <div class="title">Please fill complete the form to submit a requisition</div>
            <div class="form-group">
                <div class="half-width">
                    <label for="title">Maintenance Issue</label>
                    <input type="text" id="title" name="title" placeholder="Enter a title for the issue, e.g. Broken window" required>
                </div>
                <div class="half-width">
                    <label for="category">Problem Category</label>
                    <select name="category" id="category" required>
                        <option value="general">General Maintenance</option>
                        <option value="plumbing">Plumbing</option>
                        <option value="electrical">Electrical</option>
                        <option value="carpentry">Carpentry</option>
                    </select>
                </div>
            </div>
            <div class="full-width">
                <label for="description">Please give a short description of the problem</label>
                <textarea id="description" name="description" placeholder="Enter a description of the issue here" required></textarea>
            </div>
            <div class="button-container">
                <div class="upload-section">
                    <label for="upload" class="upload-label">Upload a picture of the problem</label>
                    <input id="upload" name="upload" type="file" accept=".jpg, .jpeg, .png">
                </div>
                <button name="submit" id="submit" type="submit">Submit</button>
            </div>
        </div>
    </form>
    </div>

</html>
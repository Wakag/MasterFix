<?php
session_start(); // Start the session

// Check if the user is logged in and fetch the Student_UserID
if (!isset($_SESSION['Student_UserID'])) {
    // Redirect to login page or show an error if the user is not logged in
    header('Location: login.php');
    exit();
}
// Get the Student_UserID from the session
$studentUserId = $_SESSION['Student_UserID'];
// include the config file
require_once 'config.php';
$conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare to fetch StudentID and ResID using Student_UserID from session
if ($stmt = $conn->prepare("SELECT StudentID, ResID FROM Students WHERE Student_UserID = ?")) {
    $stmt->bind_param("i", $studentUserId);
    $stmt->execute();
    $stmt->bind_result($TicketStudentID, $TicketResID);
    $stmt->fetch();
    $stmt->close();

    // Prepare to fetch WardenID using ResID
    if ($stmt = $conn->prepare("SELECT WardenID FROM Wardens WHERE ResID = ?")) {
        $stmt->bind_param("i", $TicketResID);
        $stmt->execute();
        $stmt->bind_result($TicketWardenID);
        $stmt->fetch();
        $stmt->close();
    }
}
?>
<!DOCTYPE html>

<html>
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
        .form-container * {
    box-sizing: border-box;
    font-family: Inter, sans-serif;
}
.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
    padding: 0;
}

.form-container .form-content {
    padding: 20px;
    width: 976px;
    background: #fff;
    border-radius: 8px;
    position: relative;
}
.form-container .title {
    text-align: center;
    font-size: 20px;
    color: #1E1E1E;
    margin-bottom: 50px;
}
.form-container .form-group {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
    gap: 20px; /* Adjust gap between elements */
}
.form-container .form-group.full-width {
    flex-direction: column; /* Ensure label is above textarea */
}
.form-container .form-group label, .form-container .upload-label {
    display: block;
    color: #1E1E1E;
    font-size: 12px;
    margin-bottom: 5px;
}

.form-container input[type="text"], .form-container input[type="file"], .form-container select, .form-container textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 12px;
}
.form-container .half-width {
    width: 250px; /* Set the width to 250px */
}
.form-container button {
    width: 160px;
    padding: 10px;
    margin-top: 20px;
    background-color: #65558F;
    color: white;
    text-align: center;
    border-radius: 100px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.form-container button:hover {
    background-color: #CE93D8;
}
.form-container .upload-section {
    width: 192px;
}
.form-container .button-container {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}
#description{
    height: 4.5em; /* Adjust based on font size and line height */
    overflow-y: auto; /* Adds scroll if content exceeds height */
}

    </style>

<!--Font and Icons-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>
    <body>
    <!--Header-->
    <div class="panel">
    <header class="top-bar">
        <div class="left-section">
            <img src="" alt="Back" class="icon back-icon" title="Back" />
          <p class="page-title">The Masters Maintenance</p>
        </div>
        
        <div class="account-section">
            <span>User-Type</span>
            <img src=" " alt="user"  class="icon" title="User">
            <div class="dropdown">
              <img src=" " id="trigger-popup" class="icon" alt="options" title="Options" onclick="toggleDropdown()">
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
        <div class="form-container">
            <div class="form-content">
                <div class="title">Please fill complete the form to submit a maintenance ticket</div>
                <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
                <input type="hidden" name="resID" value="<?php echo $resID; ?>">
                <input type="hidden" name="wardenID" value="<?php echo $wardenID; ?>">
                <div class="form-group">
                    <div class="half-width">
                        <label for="issue">Maintenance Issue</label>
                        <input type="text" id="issue" placeholder="Describe the issue">
                    </div>
                    <div class="half-width ">
                        <label for="category">Problem Category</label>
                        <select>
                            <option id="category" value="general">General Maintenance</option>
                            <option id="category" value="plumbing">Plumbing</option>
                            <option id="category" value="electrical">Electrical</option>
                            <option id="category" value="carpentry">Carpentry</option>
                        </select>
                    </div>
                </div>
                <div class="form-group full-width">
                    <label for="description">Please give a short description of the problem</label>
                    <textarea id="description" name="description" placeholder="Enter Description here" ></textarea>
                </div>
                <div class="button-container">
                    <div class="upload-section">
                        <label for="upload" class="upload-label">Upload a picture of the problem</label>
                        <input id="upload" type="file" accept=".jpg, .jpeg, .png">
                    </div>
                    <button name="submit" id="submit" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>    
    </body>
</html>
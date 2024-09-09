function toggleDropdown(menuId) {
    // Close all dropdowns
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.id !== menuId) {
            openDropdown.classList.remove('show');
        }
    }

    // Toggle the selected dropdown
    document.getElementById(menuId).classList.toggle("show");
}

function updateText(controlId, text) {
    // Update the text of the triggering element
    document.getElementById(controlId).innerText = text;

    // Close all dropdowns
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
        dropdowns[i].classList.remove('show');
    }
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.filter') && !event.target.matches('.sort') && !event.target.matches('.dropdown-content')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
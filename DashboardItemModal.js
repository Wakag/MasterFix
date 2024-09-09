// Get all buttons within the segmented-buttons container
    const buttons = document.querySelectorAll('.segment-btn');

    // Add click event listener to each button
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove 'active' class from all buttons
            buttons.forEach(btn => btn.classList.remove('active'));
            // Add 'active' class to the clicked button
            this.classList.add('active');
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get the parent ticket item element
                const ticketItem = this.closest('.ticket-item');

                // Optionally, you can confirm before deleting
                if (confirm('Are you sure you want to remove this ticket from the list?')) {
                    // Remove the ticket item from the DOM
                    ticketItem.remove();
                    ticketItem.nextElementSibling.remove(); // Remove the separator
                }
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-btn');
    const modal = document.getElementById('editTicketModal');
    const closeBtn = document.querySelector('.modal .close');

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            

            // Show the modal
            modal.style.display = 'block';
        });
    });

    // Close the modal
    closeBtn.onclick = function() {
        modal.style.display = 'none';
    }

    // Close the modal if user clicks outside of it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

});
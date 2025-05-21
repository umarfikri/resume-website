// Sidebar toggle
const toggler = document.querySelector(".toggler-btn");
toggler.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

// Confirm Delete button (SweetAlert)
document.querySelectorAll(".btn-delete").forEach((button) => {
    button.addEventListener("click", function (e) {
        e.preventDefault(); // Prevent form submission

        const form = this.closest("form"); // Find the closest form element

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to undo this!",
            icon: "warning",
            iconColor: "#2c3e50",
            showCancelButton: true,
            confirmButtonColor: "#1b3785",
            cancelButtonColor: "#2c3e50",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit the form if confirmed
            }
        });
    });
});

// Enlarge Picture
function openFullscreenImage(src) {
    const overlay = document.getElementById("fullscreenOverlay");
    const image = document.getElementById("fullscreenImage");
    image.src = src;
    overlay.classList.add("active");
}

function closeFullscreenImage() {
    const overlay = document.getElementById("fullscreenOverlay");
    overlay.classList.remove("active");
}

function openImageInModal(src) {
    const modalImage = document.getElementById("modalImage");
    modalImage.src = src;
    const modal = new bootstrap.Modal(document.getElementById("imageModal"));
    modal.show();
}

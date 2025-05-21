@include('cms.Partials.header')

    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-dark">Add Project</h1>
        <p class="lead text-secondary">Add a new project in this section.</p>                
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded-4">   
                <div class="card-header bg-dark text-white rounded-top-4 d-flex align-items-center justify-content-between px-4 py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-person-gear me-2"></i>Add Project
                    </h5>
                </div>           
                <div class="card-body">
                    <form action="/addProjectSubmit" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Project Name -->
                        <div class="mb-3">
                            <label for="projectName" class="form-label fw-semibold">Project Name</label>
                            <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Enter the project's name..." required>
                        </div>

                        <!-- Project Summary -->
                        <div class="mb-3">
                            <label for="projectSummary" class="form-label fw-semibold">Summary</label>
                            <textarea class="form-control rounded-3" id="projectSummary" name="projectSummary" rows="4" placeholder="Enter the project's summary..."></textarea>
                        </div>

                        <!-- Project Description -->
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label fw-semibold">Description</label>
                            <textarea class="form-control rounded-3" id="projectDescription" name="projectDescription" rows="4" placeholder="Enter the project's description..."></textarea>
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="projectURL" class="form-label fw-semibold">Project Website Link</label>
                            <input type="text" class="form-control" id="projectURL" name="projectURL" placeholder="Enter the project's website link...">
                        </div>  
                        
                        <!-- Main Image Upload -->
                        <div class="mb-3">
                            <label for="mainImage" class="form-label fw-semibold mb-0">Upload Main Image</label>
                            <span class="text-muted small d-block mb-1">Choose one image to display as the main project image</span>
                            <input class="form-control" type="file" id="mainImage" name="mainImage">
                        </div>

                        <!-- Main Preview Area -->
                        <div class="d-flex justify-content-center">
                            <div id="mainImagePreview" class="d-flex flex-wrap gap-3"></div>
                        </div>

                        <!-- Multiple Image Upload -->
                        <div class="mb-3">
                            <label for="projectImages" class="form-label fw-semibold mb-0">Upload Project Images</label>
                            <span class="text-muted small d-block mb-1">Choose multiple images for gallery display</span>
                            <input class="form-control" type="file" id="projectImages" name="projectImages[]" accept="image/*" multiple>
                        </div>

                        <!-- Preview Area -->
                        <div class="d-flex justify-content-center">
                            <div id="imagePreview" class="d-flex flex-wrap gap-3"></div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('project') }}" type="button" class="btn btn-dark rounded-3 px-4">
                                <i class="fa-solid fa-eject text-light me-2"></i> Return
                            </a>
                            <button type="submit" class="btn btn-dark rounded-3 px-4 mx-3">
                                <i class="fa-solid fa-floppy-disk text-light me-2"></i> Save Changes
                            </button>                           
                        </div>
                    </form>
                </div>
            </div>

            <!-- Fullscreen Image Modal -->
            <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
                    <div class="modal-content bg-dark">
                        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" 
                                data-bs-dismiss="modal" 
                                aria-label="Close"
                                style="z-index: 1056;"></button>
                        <div class="modal-body p-0 text-center">
                            <img id="modalImage" src="" class="img-fluid rounded" alt="Full View" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Script for Preview Project Main Images -->
            <script>
                document.getElementById('mainImage').addEventListener('change', function (event) {
                    const preview = document.getElementById('mainImagePreview');
                    preview.innerHTML = ''; // Clear previous

                    const file = event.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'position-relative';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail rounded-3';
                            img.style.height = '150px';
                            img.style.cursor = 'pointer';

                            // Fullscreen on click
                            img.addEventListener('click', function () {
                                document.getElementById('modalImage').src = img.src;
                                const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                                modal.show();
                            });

                            // Remove button
                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.innerHTML = '<i class="fa-solid fa-trash"></i>';
                            removeBtn.className = 'btn btn-sm btn-dark rounded-circle position-absolute top-0 end-0 d-flex justify-content-center align-items-center';
                            removeBtn.style.width = '32px';
                            removeBtn.style.height = '32px';
                            removeBtn.style.fontSize = '0.85rem';
                            removeBtn.style.padding = '0';
                            removeBtn.style.transform = 'translate(30%, -30%)';
                            removeBtn.style.zIndex = '10';

                            removeBtn.addEventListener('click', function () {
                                // Clear input and preview
                                document.getElementById('mainImage').value = '';
                                preview.innerHTML = '';
                            });

                            wrapper.appendChild(img);
                            wrapper.appendChild(removeBtn);
                            preview.appendChild(wrapper);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            </script>

            <!-- Script for Preview Project Images -->
            <script>
                let selectedFiles = [];

                document.getElementById('projectImages').addEventListener('change', function (event) {
                    const imagePreview = document.getElementById('imagePreview');
                    selectedFiles = Array.from(event.target.files);

                    // Clear previous previews
                    imagePreview.innerHTML = '';

                    selectedFiles.forEach((file, index) => {
                        if (!file.type.startsWith('image/')) return;

                        // Read Image File
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            // Create Wrapper for Image and Remove Button
                            const wrapper = document.createElement('div');
                            wrapper.className = 'position-relative';

                            // Create Image Element and Style
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail rounded-3';
                            img.style.width = 'auto';
                            img.style.height = '150px';
                            img.style.cursor = 'pointer';

                            // Add "Click Image to view fullscreen"
                            img.addEventListener('click', function () {
                                document.getElementById('modalImage').src = img.src;
                                const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                                modal.show();
                            });

                            // Create and Style Remove Button
                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.innerHTML = '<i class="fa-solid fa-trash"></i>';
                            removeBtn.className = 'btn btn-sm btn-dark rounded-circle position-absolute top-0 end-0 d-flex justify-content-center align-items-center';
                            removeBtn.style.width = '32px';
                            removeBtn.style.height = '32px';
                            removeBtn.style.fontSize = '0.85rem';
                            removeBtn.style.padding = '0';
                            removeBtn.style.transform = 'translate(30%, -30%)';
                            removeBtn.style.zIndex = '10';

                            // Remove image preview when the remove button is clicked and update file list
                            removeBtn.addEventListener('click', function () {
                                e.preventDefault(); // 🔒 Prevent form submission
                                selectedFiles.splice(index, 1); // Remove this file from array
                                updatePreview(); // Refresh preview
                            });

                            // Append the image and remove button inside the wrapper
                            wrapper.appendChild(img);
                            wrapper.appendChild(removeBtn);
                            imagePreview.appendChild(wrapper);
                        };
                        reader.readAsDataURL(file);
                    });

                    // Update the input's FileList
                    const dataTransfer = new DataTransfer();
                    selectedFiles.forEach(file => dataTransfer.items.add(file));
                    document.getElementById('projectImages').files = dataTransfer.files;
                });

                function updatePreview() {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.innerHTML = '';

                    selectedFiles.forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'position-relative';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail rounded-3';
                            img.style.height = '150px';
                            img.style.cursor = 'pointer';

                            img.addEventListener('click', function () {
                                document.getElementById('modalImage').src = img.src;
                                const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                                modal.show();
                            });

                            const removeBtn = document.createElement('button');
                            removeBtn.innerHTML = '<i class="fa-solid fa-trash"></i>';
                            removeBtn.className = 'btn btn-sm btn-dark rounded-circle position-absolute top-0 end-0 d-flex justify-content-center align-items-center';
                            removeBtn.style.width = '32px';
                            removeBtn.style.height = '32px';
                            removeBtn.style.fontSize = '0.85rem';
                            removeBtn.style.padding = '0';
                            removeBtn.style.transform = 'translate(30%, -30%)';
                            removeBtn.style.zIndex = '10';

                            removeBtn.addEventListener('click', function () {
                                selectedFiles.splice(index, 1);
                                updatePreview();
                            });

                            wrapper.appendChild(img);
                            wrapper.appendChild(removeBtn);
                            imagePreview.appendChild(wrapper);
                        };
                        reader.readAsDataURL(file);
                    });

                    // Update FileList
                    const dataTransfer = new DataTransfer();
                    selectedFiles.forEach(file => dataTransfer.items.add(file));
                    document.getElementById('projectImages').files = dataTransfer.files;
                }
            </script>            

        </div>
    </div>
@include('cms.Partials.footer')
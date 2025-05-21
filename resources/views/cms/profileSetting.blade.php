@include('cms.Partials.header')

    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-dark">Profile Settings</h1>
        <p class="lead text-secondary">View, manage or edit your profile in this section.</p>                
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded-4">   
                <div class="card-header bg-dark text-white rounded-top-4 d-flex align-items-center justify-content-between px-4 py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-person-gear me-2"></i>Update Account
                    </h5>
                </div>           
                <div class="card-body">
                    <form action="/updateProfile" method="POST">
                        @csrf
                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" readonly required>
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-dark rounded-3 px-4">
                                <i class="fa-solid fa-floppy-disk text-light me-2"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@include('cms.Partials.footer')
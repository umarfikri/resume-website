@include('cms.Partials.header')

    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-dark">Account List</h1>
        <p class="lead text-secondary">View, manage or edit non-admin users through the account form.</p>    
        <div class="add-account">
            <!-- Button to open add account modal -->
            <button type="button" class="btn btn-sm btn-primary rounded-4 text-light" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                Add Account
            </button>                            
        </div>            
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Datatable -->
            <div class="mb-3">
                <div class="table-responsive-sm">
                    <table id="datatableResume" class="table table-striped" >
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>User Level Access</th>
                                <th class="text-center">Action</th>                            
                            </tr>
                        </thead>
                        <tbody>                            
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>********</td> 
                                    <td>{{ ucfirst($user->userLevel) }}</td>
                                    <td class="align-middle text-center">
                                        <div class="add-account" style="display:inline-block;">
                                            <!-- Button to open add account modal -->
                                            <button type="button" class="btn btn-sm btn-warning rounded-4 text-light my-1" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#updateAccountModal"
                                                    data-id="{{ $user->id }}"
                                                    data-username="{{ $user->username }}"
                                                    data-userlevel="{{ $user->userLevel }}"
                                                    >
                                                Edit Account
                                            </button>                            
                                        </div>               
                                        <!-- Delete Button-->
                                        <form action="{{ route('deleteAccount', $user->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-delete rounded-4 text-light my-1">Delete Account</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach                                                           
                        </tbody>
                        <tfoot class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>User Level Access</th>
                                <th class="text-center">Action</th>                                                       
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Add Account -->
    <div class="modal fade mt-8" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header position-relative">
                    <h5 class="modal-title w-100 text-center text-dark" id="addAccountLabel">Add Account</h5>
                    <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Form For Add Account -->
                <div class="modal-body">
                    <form action="/addAccount" method="POST" id="quoteForm" class="d-flex flex-column justify-content-center">
                        @csrf
                        <div class="mb-3 text-dark text-center">
                            <label for="add-username" class="form-label ">Username</label>
                            <input type="text" name="add-username" id="add-username" class="form-control" required>
                        </div>

                        <div class="mb-3 text-dark text-center">
                            <label for="add-password" class="form-label ">Password</label>
                            <input type="password" name="add-password" id="add-password" class="form-control" required>
                        </div>

                        <div class="mb-3 text-dark text-center">
                            <label for="add-confirm-password" class="form-label ">Confirm Password</label>
                            <input type="password" name="add-confirm-password" id="add-confirm-password" class="form-control" required>
                        </div>

                        <div class="mb-3 text-dark text-center">
                            <label for="add-userLevel" class="form-label">User Level Access</label>
                            <select class="form-select text-center" name="add-userLevel" id="add-userLevel" required>
                                <option value="" selected disabled >Please select user level access</option>
                                <option value="viewer">Viewer</option>
                                <option value="editor">Editor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-sm btn-primary rounded-4 text-light w-50">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Account -->
    <div class="modal fade mt-8" id="updateAccountModal" tabindex="-1" aria-labelledby="updateAccountLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header position-relative">
                    <h5 class="modal-title w-100 text-center text-dark" id="updateAccountLabel">Update Account</h5>
                    <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Form For Update Account -->
                <div class="modal-body">
                    <form action="/editAccount" method="POST" id="quoteForm" class="d-flex flex-column justify-content-center">
                        @csrf
                        <input type="hidden" name="update-id" id="update-id"> <!-- Hidden user id -->
                        <div class="mb-3 text-dark text-center">
                            <label for="update-username" class="form-label ">Username</label>
                            <input type="text" name="update-username" id="update-username" class="form-control" value="data-username" readonly required>
                        </div>

                        <div class="mb-3 text-dark text-center">
                            <label for="update-password" class="form-label ">Password</label>
                            <input type="password" name="update-password" id="update-password" class="form-control" required>
                        </div>

                        <div class="mb-3 text-dark text-center">
                            <label for="update-confirm-password" class="form-label ">Confirm Password</label>
                            <input type="password" name="update-confirm-password" id="update-confirm-password" class="form-control" required>
                        </div>

                        <div class="mb-3 text-dark text-center">
                            <label for="update-userLevel" class="form-label">User Level Access</label>
                            <select class="form-select" name="update-userLevel" id="update-userLevel" required>
                                <option value="" selected disabled >Please select user level access</option>
                                <option value="viewer">Viewer</option>
                                <option value="editor">Editor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-sm btn-primary rounded-4 text-light w-50">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            var updateModal = document.getElementById('updateAccountModal');

            updateModal.addEventListener('show.bs.modal', function (event){
                var button = event.relatedTarget;

                var id = button.getAttribute('data-id');
                document.getElementById('update-id').value = id;

                var username = button.getAttribute('data-username');
                document.getElementById('update-username').value = username;

                var userlevel = button.getAttribute('data-userlevel');
                document.getElementById('update-userLevel').value = userlevel;
            });
        });
    </script>
@include('cms.Partials.footer')
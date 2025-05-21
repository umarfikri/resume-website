@include('cms.Partials.header')

    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-dark">Contact</h1>
        <p class="lead text-secondary">View, respond to, or manage messages and suggestions submitted through the contact form.</p>                
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Datatable -->
            <div class="mb-3">
                @if($contact->count() > 0)
                <div class="table-responsive-sm">
                    <table id="datatableResume" class="table table-striped" >
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Message</th>
                                @if(session('userLevel') === 'admin' || session('userLevel') === 'editor')
                                <th>Action</th> 
                                @endif                           
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contact as $index => $contact)
                                <tr>                                
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{$contact -> contactName}}</td>
                                    <td>{{ !empty($contact->contactEmail) ? $contact->contactEmail : 'Not provided' }}</td>
                                    <td>{{ !empty($contact->contactPhone) ? $contact->contactPhone : 'Not provided' }}</td>
                                    <td class="text-center">                                    
                                        <button type="button" 
                                            class="btn btn-sm btn-dark rounded-4 text-light my-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewMessageModal"
                                            data-id="{{ $contact->id }}"
                                            data-user="{{ $contact->contactName }}"
                                            data-message="{{ $contact->contactMessage }}"
                                            >
                                            View Message
                                        </button>                                   
                                    </td>
                                    @if(session('userLevel') === 'admin' || session('userLevel') === 'editor')
                                    <td class="text-center text-nowrap">
                                        <form action="{{ route('deleteContact', $contact->id) }}" method="POST" style="display: inline;"> 
                                            @csrf
                                            @method('DELETE')    
                                            <button type="submit" class="btn btn-sm btn-danger btn-delete rounded-4 text-light my-1">Delete Message</button>                                   
                                        </form>
                                    </td>
                                    @endif                                    
                                </tr>  
                            @endforeach                                                      
                        </tbody>
                        <tfoot class="table-dark">
                            <tr>
                            <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Message</th>
                                @if(session('userLevel') === 'admin' || session('userLevel') === 'editor')
                                <th>Action</th> 
                                @endif                            
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal View Message -->
    <div class="modal fade mt-8" id="viewMessageModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header position-relative">
                    <h5 class="modal-title w-100 text-center text-dark" id="quoteModalLabel"><span class="modal-user-name"></span>'s Message</h5>
                    <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Message Content -->
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <p id="view-message" class="form-control-plaintext text-center"></p>
                    </div>
                </div>                            
            </div>
        </div>
    </div>  
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const viewMessageModal = document.getElementById('viewMessageModal');

            viewMessageModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const userName = button.getAttribute('data-user');
                const message = button.getAttribute('data-message');

                const messageField = viewMessageModal.querySelector('#view-message');
                messageField.textContent = message || 'No message provided.';

                const userField = viewMessageModal.querySelector('.modal-user-name');
                userField.textContent = userName;

            });
        });
    </script>


@include('cms.Partials.footer')
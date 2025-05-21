@include('cms.Partials.header')

    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-dark">Document</h1>
        <p class="lead text-secondary">Configure your documents in this section.</p>        
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
                                <th>Document Name</th>
                                <th>Document</th>
                                <th>Action</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($document as $index => $document)
                                <tr>
                                    <td>{{ $index + 1}}</td>
                                    <td>{{ ucfirst($document -> documentName)}}</td>
                                    <td class="text-center">                                       
                                        <a 
                                            href="{{ asset($document -> documentUrl) }}" 
                                            class="btn btn-sm btn-dark rounded-4 text-light" 
                                            target="_blank" rel="noopener noreferrer"
                                            >
                                            View {{ ucfirst($document -> documentName)}}
                                        </a>
                                    </td>
                                    <td class="text-center">                                
                                        <!-- Upload New Document Button -->                                  
                                        <button type="button" 
                                                class="btn btn-sm btn-dark rounded-4 text-light" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#newDocumentModal"
                                                data-doc-id="{{$document->id}}"
                                                data-doc-name="{{$document->documentName}}"
                                                >
                                            Upload New {{ ucfirst($document -> documentName)}}
                                        </button>                                 
                                    </td>
                                </tr>  
                            @endforeach                                          
                        </tbody>
                        <tfoot class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Document Name</th>
                                <th>Document</th>
                                <th>Action</th>                            
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal New File -->
    <div class="modal fade mt-8" id="newDocumentModal" tabindex="-1" aria-labelledby="newDocumentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header position-relative">
                    <h5 class="modal-title w-100 text-center text-dark" id="newDocumentLabel">Update File For <span class="modal-doc-name"></span></h5>
                    <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Form For New File -->
                <div class="modal-body">
                    <form action="" method="POST" id="quoteForm" class="d-flex flex-column justify-content-center" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="document-name" id="document-name"> <!-- Hidden document name -->
                        <div class="mb-3 text-dark text-center">
                            <label for="new-file" class="form-label"><span class="modal-doc-name"></span> File</label>
                            <span class="text-muted small d-block mb-2">Please upload a file in PDF format only.</span>
                            <input type="file" name="new-file" id="new-file" class="form-control" required>
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

    <!-- File Name Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const newDocumentModal = document.getElementById('newDocumentModal');                  

            newDocumentModal.addEventListener('show.bs.modal', function (event) {
                // var docName = button.getAttribute('data-doc-name');
                // document.getElementById('document-name').value = docName;  

                const button = event.relatedTarget;
                if (!button) return;

                let docId = button.getAttribute('data-doc-id') || '';
                let docName = button.getAttribute('data-doc-name') || '';
                const formattedName = docName.charAt(0).toUpperCase() + docName.slice(1);

                const labelSpans = newDocumentModal.querySelectorAll('.modal-doc-name');
                labelSpans.forEach(span => {
                    span.textContent = formattedName;
                });

                document.getElementById('document-name').value = docName;

                // Update form action dynamically
                const form = document.getElementById('quoteForm');
                form.action = `/updateDocument/${docId}`;
            });
        });        
    </script>

@include('cms.Partials.footer')
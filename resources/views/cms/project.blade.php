@include('cms.Partials.header')

    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-dark">Project</h1>
        <p class="lead text-secondary">Add, update, or organize your projects from this section.</p>        
        <div class="add-project">
            <!-- Button to open add quote modal -->
            <a href="/cms/addProject" type="button" class="btn btn-sm btn-primary rounded-4 text-light">
                Add Project
            </a>                            
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Datatable -->
            @if($project->count() > 0)
            <div class="mb-3">
                <div class="table-responsive-sm">
                    <table id="datatableResume" class="table table-striped" >
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Project Name</th>
                                <th>Project Image</th>
                                <th>Project Link</th>
                                <th>Action</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($project as $index => $project)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $project -> projectName }}</td>
                                    <td class="align-middle text-center">
                                        @php
                                            $imagePath = $project->mainImagePath 
                                                ? asset($project->mainImagePath) 
                                                : asset('image/Main-Resume/no-image-placeholder.png');
                                        @endphp
                                        <img loading="lazy" src="{{ $imagePath }}" 
                                            alt="Background" class="img-fluid rounded mx-auto d-block" 
                                            style="max-height: 100px; height: auto; aspect-ratio: 16 / 9; width: auto; object-fit: cover;"
                                            onclick="openFullscreenImage('{{ $imagePath }}')">
                                    </td>
                                    <td class="text-center align-middle">     
                                        @if ($project -> projectURL)                               
                                        <a type="button" href="{{ $project -> projectURL }}" class="btn btn-sm btn-dark rounded-4 text-light my-1"
                                            target="_blank" rel="noopener noreferrer">
                                            View Website
                                        </a>  
                                        @else
                                        <button type="button" class="btn btn-sm btn-secondary rounded-4 text-light my-1" disabled>
                                            No Website Link
                                        </button>
                                        @endif                              
                                    </td>
                                    <td class="text-center align-middle">     
                                        <a href="{{ route('editProject', ['projectid' => $project->id]) }}" class="btn btn-sm btn-warning rounded-4 text-light my-1" style="display:inline-block;">
                                            Edit Project
                                        </a>
                                        <!-- Delete button -->
                                        <form action="{{ route('deleteProject', $project->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-delete rounded-4 text-light my-1">Delete Project</button>
                                        </form>
                                    </td>
                                </tr>  
                            @endforeach                          
                        </tbody>
                        <tfoot class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Project Name</th>
                                <th>Project Image</th>
                                <th>Project Link</th>
                                <th>Action</th>                            
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Modal For Fullscreen Background Image -->
    <div class="fullscreen-img-overlay" id="fullscreenOverlay" onclick="closeFullscreenImage()">
        <img id="fullscreenImage" src="" alt="Fullscreen Preview">
    </div>

@include('cms.Partials.footer')
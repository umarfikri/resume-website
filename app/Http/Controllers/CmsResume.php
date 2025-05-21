<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use App\Models\Contact;
use App\Models\Project;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CmsResume extends Controller
{   

    /* Main CMS Page */
    public function mainCms()
    {       
        return view('cms/mainCms');
    }

    /* Document */
    public function resumePortfolio()
    {
        // if (!session('is_logged_in')) {
        //     return redirect()->route('loginPage')->with('error', 'Please log in to access this page.');
        // }
        
        $document = Document::all(); //Make model first

        return view('cms/resumePortfolio', compact('document'));
    }

    public function updateDocument(Request $request, Document $document)
    {
        $request->validate([
            'new-file' => 'required|mimes:pdf|max:51200',
        ]); 

        try {
            // Get from input
            $documentName = $request->input('document-name'); // Get from hidden
            $file = $request->file('new-file');

            // Path to the directory where you want to store the file
            // $documentPath = base_path('../public_html/document/'); // Path at server
            $documentPath = public_path('document/');

            // Check if a file already exists and delete it
            $existingFilePath = $documentPath . $documentName . '.pdf';

            if (File::exists($existingFilePath)) {
                // Delete the existing file
                File::delete($existingFilePath);
            }        

            // Move the uploaded file to the desired location
            $fileName = $documentName . '.pdf'; // Rename the file
            $file->move($documentPath, $fileName);

            // Update document url at database
            $document->update([
                'documentUrl' => 'document/' . $fileName,
            ]);
            return redirect()->back()->with('success', ucfirst($documentName) . ' uploaded successfully!');
        } catch (\Exception $e) {
            // Optional: Log the error for debugging
            Log::error('Failed to update quote: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Failed to update the document. Please try again.');
        }   
    }

    /* Project */
    public function project()
    {
        $project = Project::all();
        return view('cms/project', compact('project'));
    }

    public function deleteProject($projectid){
        $project = Project::findOrFail($projectid);

        try {
            // Delete the main image file if it exists
            // $mainImagePath = base_path('../public_html/' . $project->mainImagePath); // Path at server
            $mainImagePath = public_path($project->mainImagePath);
            if (File::exists($mainImagePath)) {
                File::delete($mainImagePath);
            }

            // Delete all projectImages (if any)
            $imagePaths = json_decode($project->imagePaths, true);
            if ($imagePaths && is_array($imagePaths)) {
                foreach ($imagePaths as $path) {
                    // $fullPath = base_path('../public_html/' . $path); // Path at server
                    $fullPath = public_path($path);
                    if (File::exists($fullPath)) {
                        File::delete($fullPath);
                    }
                }
            }

            // Delete the whole folder if it exists
            // $folderPath = base_path('../public_html/project/' . preg_replace('/\s+/', '', $project->projectName));// Path at server
            $folderPath = public_path('project/' . preg_replace('/\s+/', '', $project->projectName));
            if (File::exists($folderPath)) {
                File::deleteDirectory($folderPath);
            }

            // Delete the project from the database
            $project->delete();

            return redirect()->route('project')->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            \Log::error("Delete failed: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete project.');
        }

    }

    public function addProject() //Page only
    {
        return view('cms/addProject');
    }

    public function addProjectSubmit(Request $request)
    {
        $request->validate([
            'projectName' => 'required|string|max:255|unique:projects,projectName',
            'projectSummary' => 'nullable|string',
            'projectDescription' => 'nullable|string',
            'projectURL' => 'nullable|url',
            'mainImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'projectImages.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ], [
            'projectName.unique' => 'This project name is already in use. Please choose a different one.',
        ]);        

        try{
            $projectName = $request->projectName; //Eg. Project Name
            $cleanProjectName = preg_replace('/\s+/', '', $projectName); //Eg. ProjectName  
            
            $mainImagePath = null;
            $imagePaths = [];

            // Folder path to save images
            $folderPath = 'project/' . $cleanProjectName;
            // $basePath = base_path('../public_html/' . $folderPath); // Path at server
            $basePath = public_path($folderPath);  
                
            // Make directory folder if it doesn't exist
            if ($request->hasFile('mainImage') || $request->hasFile('projectImages')) {
                if (!File::exists($basePath) && !File::makeDirectory($basePath, 0755, true)) {
                    return redirect()->back()->with('error', 'Failed to create folder.');
                }            
            }

            // Upload main image
            if ($request->hasFile('mainImage')) { 
                $mainImage = $request->file('mainImage');
                $mainImageExtension = $mainImage->getClientOriginalExtension(); // Get file extension
                $mainImageName = $cleanProjectName . 'Main.' . $mainImageExtension;

                $mainImage->move($basePath, $mainImageName);

                $mainImagePath = $folderPath . '/' . $mainImageName;
            }

            // Upload multiple images
            if ($request->hasFile('projectImages')) {                             
                $imagePaths = [];
                $index = 1;

                foreach ($request->file('projectImages') as $image) {
                    $extension = $image->getClientOriginalExtension(); // Get file extension
                    $filename = $cleanProjectName . $index . '.' . $extension;

                    $path = $image->move($basePath, $filename); //Store
                    
                    $imagePaths[] = $folderPath . '/' . $filename;
                    $index++;
                }
            }
        
            // Store to the database
            $project = Project::create([
                'projectName' => $request->projectName,
                'projectSummary' => $request->projectSummary,
                'projectDescription' => $request->projectDescription,
                'projectURL' => $request->projectURL,
                'mainImagePath' => $mainImagePath ?? null,
                'imagePaths' => json_encode($imagePaths), // Save array as JSON string
            ]);
        
            return redirect()->route('project')->with('success', 'Project created successfully!');

        } catch (\Exception $e) {
            \Log::error('Failed to add a new project', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
                
            return redirect()->back()->with('error', 'Failed to add a new project. Please try again.');
        }

    }

    public function editProject($projectid) //Page only
    {
        $project = Project::findOrFail($projectid);
        return view('cms/editProject', compact('project'));
    }

    public function editProjectSubmit(Request $request)
    {
        $request->validate([
            'projectName' => 'required|string|max:255|unique:projects,projectName,' . $request->projectId,
            'projectSummary' => 'nullable|string',
            'projectDescription' => 'nullable|string',
            'projectURL' => 'nullable|url',
            'mainImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'projectImages.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120', 
        ], [
            'projectName.unique' => 'This project name is already in use. Please choose a different one.',       
        ]);    
        
        try{
            $projectName = $request->projectName; //Eg. Project Name
            $cleanProjectName = preg_replace('/\s+/', '', $projectName);

            // Retrieve the project
            $project = Project::findOrFail($request->projectId);

            // Update fields
            $project->projectName = $request->projectName;
            $project->projectSummary = $request->projectSummary;
            $project->projectDescription = $request->projectDescription;
            $project->projectURL = $request->projectURL;

            // Handle main image upload
            if ($request->hasFile('mainImage')) {            
                $oldImagePath  = public_path($project->mainImagePath);
                // Delete old main image
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                } 

                $mainImage = $request->file('mainImage');
                $mainImageExtension = $mainImage->getClientOriginalExtension(); // Get file extension
                $mainImageName = $cleanProjectName . 'Main.' . $mainImageExtension;

                // Save New Image
                // $destinationPath = base_path('../public_html/project/' . $cleanProjectName); // Path at server
                $destinationPath = public_path('project/' . $cleanProjectName);            
                if (!File::exists($destinationPath)) {  // Make directory if not exist
                    File::makeDirectory($destinationPath, 0755, true);
                }
                    
                $mainImage->move($destinationPath, $mainImageName); // File store to the folder
                $project->mainImagePath = 'project/' . $cleanProjectName . '/' . $mainImageName; // Save to the database
            }

            // Handle multiple image upload        
            if ($request->hasFile('projectImages')) {                             
                $imagePaths = [];
                $index = 1;

                // $destinationPath = base_path('../public_html/project/' . $cleanProjectName); // Path at server
                $destinationPath = public_path('project/' . $cleanProjectName);  
                foreach ($request->file('projectImages') as $image) {
                    $extension = $image->getClientOriginalExtension(); // Get file extension
                    $filename = $cleanProjectName . $index . '.' . $extension;

                    $path = $image->move($destinationPath, $filename); //Store
                    
                    $imagePaths[] = 'project/' . $cleanProjectName . '/' . $filename;
                    $index++;
                }
                $project->imagePaths = json_encode($imagePaths);
            }
            $project->save();

            return redirect()->route('project')->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to edit project: ' . $e->getMessage());
                
            return redirect()->back()->with('error', 'Failed to edit project. Please try again.');
        }
    }

    public function deleteMainImage($projectid)
    {
        $project = Project::findOrFail($projectid);

        try {
            // $imagePath = base_path('../public_html/' . $project->mainImagePath); // Path at server
            $imagePath = public_path($project->mainImagePath);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $project->mainImagePath = null;
            $project->save();

            return back()->with('success', 'Main image deleted successfully.');
        } catch (\Exception $e) {
            \Log::error("Delete failed: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete main image.');
        }
    }

    public function deleteGalleryImage($projectid, $imageFilename)
    {
        $project = Project::findOrFail($projectid);
        $imagePaths = json_decode($project->imagePaths, true);

        $filteredPaths = [];

        foreach ($imagePaths as $path) {
            if (basename($path) === $imageFilename) {
                // $fullPath = base_path('../public_html/' . $path); // Path at server
                $fullPath = public_path($path);
                if (File::exists($fullPath)) {
                    File::delete($fullPath);
                }
            } else {
                $filteredPaths[] = $path; // Keep other images
            }
        }

        $project->imagePaths = json_encode($filteredPaths);
        $project->save();

        return back()->with('success', 'Gallery image deleted successfully.');
    }

    /* Contact */
    public function contact()
    {
        $contact = Contact::all();
        return view('cms/contact', compact('contact'));
    }

    public function deleteContact(Contact $contact)
    {
        try{
            $contact->delete();
            return redirect()->back()->with('success', 'Contact deleted successfully!');            
        } catch (\Exception $e) {
            Log::error('Failed to delete contact: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Failed to delete the contact. Please try again.');
        }
    }

    /** Profile Settings */
    public function profileSetting()
    {
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->route('loginPage')->with('error', 'User not found.');
        }

        return view('cms/profileSetting', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'password_confirmation' => ['required']
        ]);        

        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        
        if ($credentials['password'] == $credentials['password_confirmation']){
            // Hash and update the password
            $user->password = Hash::make($credentials['password']);
            $user->save();
            return redirect()->back()->with('success', 'Success to update password');
        }

        return redirect()->back()->with('error', 'Fail to update password');
    }

    /** Account Settings */
    public function accountList()
    {
        $users = User::all();
        return view('cms/accountList', compact('users'));
    }

    public function addAccount(Request $request)
    {
        $credentials = $request->validate([
            'add-username' => ['required', 'unique:users,username'],
            'add-password' => ['required'],
            'add-confirm-password' => ['required'],
            'add-userLevel' => ['required'],
        ], [
            'add-username.unique' => 'This username is already in use. Please choose a different one.',
        ]);        
        
        try {
            if ($credentials['add-password'] == $credentials['add-confirm-password']){
                User::create([
                    'username' => $credentials['add-username'],
                    'password' => Hash::make($credentials['add-password']), //Hash password
                    'userLevel' => $credentials['add-userLevel'],
                ]);

                return redirect()->back()->with('success', 'Account successfully created.');
            }
            else{
                return redirect()->back()->with('error', 'Passwords do not match.');
            }
        } catch (\Exception $e) {
            Log::error('Failed to add quote: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Fail to create account.');
        }
    }

    public function editAccount(Request $request)
    {
        $credentials = $request->validate([
            'update-id' => 'required|integer',
            'update-username' => ['required'],
            'update-password' => ['required'],
            'update-confirm-password' => ['required'],
            'update-userLevel' => ['required'],
        ]);        
        
        try {
            if ($credentials['update-password'] == $credentials['update-confirm-password']){
                
                $user = User::findOrFail($credentials['update-id']);
                $user->username = $credentials['update-username'];
                $user->password = Hash::make($credentials['update-password']);
                $user->userLevel = $credentials['update-userLevel'];
                $user->save();

                return redirect()->back()->with('success', 'Account successfully updated.');
            }
            else{
                return redirect()->back()->with('error', 'Passwords do not match.');
            }
        } catch (\Exception $e) {
            Log::error('Failed to add quote: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Fail to update account');
        }
    }

    public function deleteAccount(User $userid)
    {
        try {
            // Delete the quote
            $userid->delete();
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Account deleted successfully!');
        } catch (\Exception $e) {
            // Optional: Log the error for debugging
            Log::error('Failed to update quote: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Failed to delete account. Please try again.');
        }   
    }
}

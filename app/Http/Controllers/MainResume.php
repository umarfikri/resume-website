<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Project;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainResume extends Controller
{
    public function mainResume()
    {
        $project = Project::all();
        return view('mainResume', compact('project'));
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'contactName' => 'required|string|max:255',
            'contactEmail' => 'nullable|email|max:255',
            'contactPhone' => 'nullable|string|max:20',
            'contactMessage' => 'nullable|string',
        ]);

        try {
            Contact::create($request->all());

            return redirect()->back()->with('success', 'Message sent successfully!');
        } catch (\Exception $e) {
            // Optional: Log the error for debugging
            Log::error('Failed to add quote: ' . $e->getMessage());
    
            // Redirect back with a error message
            return redirect()->back()->with('error', 'Failed to send message: Please try again.');
        }   
        
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::all();
        return view('experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('experiences.create');
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validatedData = $request->validate([
            'id' => 'nullable|integer',
            'profession' => 'required|string',
            'company_name' => 'required|string',
            'job_type' => 'required|string',
            'experience' => 'nullable|string',
            'join_date' => 'required|date',
            'retire_date' => 'nullable|date|after_or_equal:join_date',
            'short_description' => 'required|string',
        ]);

        $validatedData['user_id'] = Auth::id(); // Associate the authenticated user
        $id = $validatedData['id'];
        unset($validatedData['id']);

        if ($id) {
            // Update the existing record if id is provided
            Experience::where('id', $id)->update($validatedData);
            $message = 'Experience updated successfully.';
        } else {
            // Create a new record if id is not provided
            Experience::create($validatedData);
            $message = 'Experience created successfully.';
        }

        return redirect('instructor/profile/myprofile')->with('success', $message);
    }

    public function edit(Experience $experience)
    {
        // Check if the authenticated user has permission to edit the experience
        if ($this->canEdit($experience)) {
            return view('experiences.edit', compact('experience'));
        } else {
            return redirect()->route('experiences.index')
                ->with('error', 'You do not have permission to edit this experience.');
        }
    }

    public function update(Request $request, Experience $experience)
    {
        // return 123456789;
        // Check if the authenticated user has permission to update the experience
        if ($this->canEdit($experience)) {
            $validatedData = $request->validate([
                'profession' => 'required|string',
                'company_name' => 'required|string',
                'job_type' => 'required|string',
                'experience' => 'nullable|string',
                'join_date' => 'required|date',
                'retire_date' => [
                    'nullable',
                    'date',
                    'after_or_equal:join_date',
                    Rule::requiredIf($request->has('retire_date')),
                ],
                'short_description' => 'required|string',
            ]);

            $experience->update($validatedData);

            return redirect()->route('experiences.index')
                ->with('success', 'Experience updated successfully.');
        } else {
            return redirect()->route('experiences.index')
                ->with('error', 'You do not have permission to update this experience.');
        }
    }

    public function destroy(Experience $experience)
    {
        // Check if the authenticated user has permission to delete the experience
        if ($this->canEdit($experience)) {
            $experience->delete();

            return redirect()->route('experiences.index')
                ->with('success', 'Experience deleted successfully.');
        } else {
            return redirect()->route('experiences.index')
                ->with('error', 'You do not have permission to delete this experience.');
        }
    }

    // Check if the authenticated user has permission to edit or delete the experience
    private function canEdit(Experience $experience)
    {
        $userRole = Auth::user()->user_role;
        return ($userRole === 'admin' || $userRole === 'instructor' || $experience->user_id === Auth::id());
    }
}

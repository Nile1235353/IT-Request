<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\It_Request;

class ItRequestController extends Controller
{
    //
    // Index
    public function index() 
    {
        $services = It_Request::orderBy('id', 'desc')->paginate(10);
        // dd($movies);
        // return view('dashboard',compact('services'));

        $today = Carbon::today();

        $stats = [
            'today'       => It_Request::whereDate('created_at', $today)->count(),
            'open'        => It_Request::where('status', 'open')->count(),
            'in progress' => It_Request::where('status', 'in progress')->count(),
            'completed'   => It_Request::where('status', 'completed')->count(),
        ];

        return view('dashboard', compact('services','stats'));
    }

    // Create Request

    // public function store(request $request) {
    //     // dd($request->all());
    //     $service = It_Request::create($request->all());
    //     return redirect(route('dashboard'));
    // }

    public function store(Request $request)
    {
        $request->validate([
            'Requester_Name' => 'required|string|max:255',
            'Employee_ID' => 'required|string|max:50',
            'Requester_Phone' => 'nullable|string|max:20',
            'Department' => 'required|string',
            'Issue_Category' => 'required|string',
            'Request_Description' => 'required|string|max:500',
            'Remark' => 'nullable|string|max:1000',
            'Other_Category' => 'nullable|string|max:255',
        ]);

        // If "Other" is selected, use the text input value
        $issueCategory = $request->Issue_Category;
        if ($issueCategory === 'Other' && $request->Other_Category) {
            $issueCategory = $request->Other_Category;
        }

        It_Request::create([
            'Requester_Name' => $request->Requester_Name,
            'Employee_ID' => $request->Employee_ID,
            'Requester_Phone' => $request->Requester_Phone,
            'Department' => $request->Department,
            'Issue_Category' => $issueCategory, // <-- overwrite if Other
            'Request_Description' => $request->Request_Description,
            'Remark' => $request->Remark,
        ]);

        return redirect()->back()->with('success', 'Service request added successfully.');
    }


    // Change Status

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $req =It_Request::findOrFail($id);
        $req->status = $request->status;
        $req->save();

        return redirect()->back()->with('success', 'Status updated!');
    }

}

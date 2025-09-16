<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\It_Request;
use App\Models\Software_Request;
use App\Models\DataCenter_Request;
use Illuminate\Support\Str;

class ItRequestController extends Controller
{
    //
    // Index
    public function index() 
    {
        // for Infra
        $services = It_Request::orderBy('id', 'desc')->paginate(10);

        //For Software
        $software_services = Software_Request::orderBy('id', 'desc')->paginate(10);

        //For Software
        $datacenter_services = DataCenter_Request::orderBy('id', 'desc')->paginate(10);
        
        // dd($movies);
        // return view('dashboard',compact('services'));

        $today = Carbon::today();
        
        //For Infra
        $stats = [
            'today'       => It_Request::whereDate('created_at', $today)->count(),
            'open'        => It_Request::where('status', 'open')->count(),
            'in progress' => It_Request::where('status', 'in progress')->count(),
            'completed'   => It_Request::where('status', 'completed')->count(),
        ];

        //For Software
        $software_stats = [
            'today'       => Software_Request::whereDate('created_at', $today)->count(),
            'open'        => Software_Request::where('status', 'open')->count(),
            'in progress' => Software_Request::where('status', 'in progress')->count(),
            'completed'   => Software_Request::where('status', 'completed')->count(),
        ];

        //For Software
        $datacenter_stats = [
            'today'       => DataCenter_Request::whereDate('created_at', $today)->count(),
            'open'        => DataCenter_Request::where('status', 'open')->count(),
            'in progress' => DataCenter_Request::where('status', 'in progress')->count(),
            'completed'   => DataCenter_Request::where('status', 'completed')->count(),
        ];

        return view('dashboard', compact('services','stats','software_services','software_stats','datacenter_services','datacenter_stats'));
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
            'Location' => 'nullable|string|max:255',
            // 'Priority' => 'required|in:Low,Medium,High,Critical',
            'Issue_Category' => 'required|string',
            // 'is_fixed' => 'nullable|string|in:Yes,No',
            // 'Fixed_Details' => 'nullable|string|max:1000',
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
            'Location' => $request->Location,
            // 'Priority' => $request->Priority,
            'Issue_Category' => $issueCategory, // <-- overwrite if Other
            // 'is_fixed' => $request->is_fixed ?? 'No', // default to 'No' if not provided
            // 'Fixed_Details' => $request->Fixed_Details,
            'Request_Description' => $request->Request_Description,
            'Remark' => $request->Remark,
        ]);

        return redirect()->back()->with('success', 'Service request added successfully.');
        //  return back()->withInput(); // old() helper သုံးဖို့
    }

    // For Softare Request Store

    public function softwareStore(Request $request)
    {
        $request->validate([
            'Requester_Name'      => 'required|string|max:255',
            'Employee_ID'         => 'required|string|max:50',
            'Requester_Email'     => 'nullable|email|max:255',
            'Requester_Phone'     => 'nullable|string|max:20',
            'Department'          => 'required|string|max:100',
            'Location'            => 'nullable|string|max:255',

            'Request_Date'        => 'nullable|date',
            'Priority'            => 'required|in:Low,Medium,High,Critical',
            'System'              => 'nullable|string|max:100',
            'Type'                => 'nullable|string|max:100',

            'Issue_Category'      => 'required|string|max:100',
            'Other_Category'      => 'nullable|string|max:255',

            'Request_Description' => 'required|string|max:500',

            'Assignee'            => 'nullable|string|max:100',
            'Software_Comment'    => 'nullable|string|max:1000',
            'Testers'             => 'nullable|string|max:255',

            'Launched_Date'       => 'nullable|date',
            'Job_Done_Date'       => 'nullable|date',

            'User_Feedback'       => 'nullable|string|max:1000',
            'Remark'              => 'nullable|string|max:1000',
        ]);

        // If "Other" is selected, use the text input value
        $issueCategory = $request->Issue_Category;
        if ($issueCategory === 'Other' && $request->Other_Category) {
            $issueCategory = $request->Other_Category;
        }

        // Auto generate Ticket ID (TCKT-20250914-xxxx)
        $ticketId = 'TCKT-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));

        Software_Request::create([
            'ticket_id'            => $ticketId,
            'requester_name'       => $request->Requester_Name,
            'employee_id'          => $request->Employee_ID,
            'requester_email'      => $request->Requester_Email,
            'requester_phone'      => $request->Requester_Phone,
            'department'           => $request->Department,
            'location'             => $request->Location,

            'request_date'         => $request->Request_Date,
            'priority'             => $request->Priority,
            'system'               => $request->System,
            'type'                 => $request->Type,
            'issue_category'       => $issueCategory,
            'other_category'       => $request->Other_Category,

            'request_description'  => $request->Request_Description,
            'assignee'             => $request->Assignee,
            'software_comment'     => $request->Software_Comment,
            'testers'              => $request->Testers,

            'launched_date'        => $request->Launched_Date,
            'job_done_date'        => $request->Job_Done_Date,

            'user_feedback'        => $request->User_Feedback,
            'remark'               => $request->Remark,
            'status'               => 'Open', // default
        ]);

        return redirect()->back()->with('success', 'Software request added successfully.');
    }

    // For Data Center Request Store

    public function dataCenterStore(Request $request)
    {
        // 1. Validate the incoming request data
        $validated = $request->validate([
            'Requester_Name'      => 'required|string|max:255',
            'Employee_ID'         => 'required|string|max:255',
            'Requester_Phone'     => 'required|string|max:255',
            'Department'          => 'required|string|max:255',
            'Location'           => 'nullable|string|max:255',
            // 'Priority'            => 'required|in:Low,Medium,High,Critical',
            'Issue_Category'      => 'required|string|max:255',
            'Other_Category'      => 'nullable|string|max:255',
            'Request_Description' => 'required|string|max:255',
            'Remark'              => 'nullable|string',
        ]);

        // 2. Handle the 'Other' category logic
        $issueCategory = $request->input('Issue_Category');
        $finalCategory = ($issueCategory === 'Other') 
                         ? $request->input('Other_Category') 
                         : $issueCategory;

        // 3. Create a new service request record
        DataCenter_Request::create([
            'Requester_Name'      => $validated['Requester_Name'],
            'Employee_ID'         => $validated['Employee_ID'],
            'Requester_Phone'     => $validated['Requester_Phone'],
            'Department'          => $validated['Department'],
            'Location'            => $validated['Location'],
            // 'Priority'            => $validated['Priority'],
            'Issue_Category'      => $finalCategory,
            'Request_Description' => $validated['Request_Description'],
            'Remark'              => $validated['Remark'],
            // Add any other fields, like 'status', if needed
            'status'              => 'Open',
        ]);

        // 4. Redirect with a success message
        return redirect()->back()->with('success', 'Service request submitted successfully!');
    }

    

    // Change Status

    public function updateStatus(Request $request, $id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', '❌ Access Denied: Admin role only.');
        }

        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $req = It_Request::findOrFail($id);
        $req->status = $request->status;
        $req->save();

        return redirect()->back()->with('success', '✅ Status updated!');
    }



    //For Software

    public function softwareUpdateStatus(Request $request, $id)
    {

        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', '❌ Access Denied: Admin role only.');
        }

        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $req =Software_Request::findOrFail($id);
        $req->status = $request->status;
        $req->save();

        return redirect()->back()->with('success', 'Status updated!');
    }

    //For Data Center

    public function dataCenterUpdateStatus(Request $request, $id)
    {

        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', '❌ Access Denied: Admin role only.');
        }

        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $req =DataCenter_Request::findOrFail($id);
        $req->status = $request->status;
        $req->save();

        return redirect()->back()->with('success', 'Status updated!');
    }

}

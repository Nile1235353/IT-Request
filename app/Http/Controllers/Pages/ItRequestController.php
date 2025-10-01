<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\It_Request;
use App\Models\Software_Request;
use App\Models\DataCenter_Request;
use Illuminate\Support\Str;
use App\Mail\SoftwareRequestCreateMail; // သင့် Mailable class
use Illuminate\Support\Facades\Mail;
use App\Mail\SoftwareRequestProgressMail; 
use Illuminate\Support\Facades\Config; 
use Illuminate\Support\Facades\Log;
use App\Mail\SoftwareJobDoneMail;
use App\Mail\SoftwareLaunchedMail;
use App\Mail\SoftwareCompletedMail;

class ItRequestController extends Controller
{
    //
    // Index

    public function index() 
    {
        // for Infra
        $services = It_Request::orderBy('id', 'desc')->paginate(5);
        // အရင်ဆုံး It_Request Model ကို သုံးတဲ့အတွက် Auth ကို စစ်ဆေးပါ
        // if (auth()->check()) {
            
        //     // User ရဲ့ Role ကို စစ်ဆေးပါ
        //     if (auth()->user()->role === 'admin') {
        //         // 1. ADMIN ဆိုရင် - Data အားလုံးကို ဆွဲထုတ်ပါ
        //         $services = It_Request::orderBy('id', 'desc')->paginate(5);
                
        //     } else {
        //         // 2. ADMIN မဟုတ်ရင် - Location AND Department နှစ်ခုလုံးကို စစ်ဆေးပြီး ဆွဲထုတ်ပါ
        //         $userLocation = auth()->user()->location;
        //         $userDepartment = auth()->user()->department; // User ရဲ့ Department ကို ယူပါ
                
        //         $services = It_Request::where('Location', $userLocation)
        //                             ->where('Department', $userDepartment) // Department ကို ထပ်စစ်ပါ
        //                             ->orderBy('id', 'desc')
        //                             ->paginate(5);
        //     }
        // } else {
        //     // Login မဝင်ထားရင် - (Optional: Middleware က ကာကွယ်ပြီးသားဖြစ်သင့်သည်)
        //     $services = It_Request::where('id', null)->paginate(5); 
        // }

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

        //For Data Center
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
            'IT_Officer' => 'nullable|string|max:100',
            'Remark' => 'nullable|string|max:1000',
            'Other_Category' => 'nullable|string|max:255',
        ]);

        // If "Other" is selected, use the text input value
        $issueCategory = $request->Issue_Category;
        if ($issueCategory === 'Other' && $request->Other_Category) {
            $issueCategory = $request->Other_Category;
        }

        // Use submitted location or fallback to current user's location
        $location = $request->Location ?? auth()->user()->location;

        It_Request::create([
            'Requester_Name' => $request->Requester_Name,
            'Employee_ID' => $request->Employee_ID,
            'Requester_Phone' => $request->Requester_Phone,
            'Department' => $request->Department,
            // 'Location' => $request->Location,
            'Location' => $location, // <-- default to logged-in user location if null
            // 'Priority' => $request->Priority,
            'Issue_Category' => $issueCategory, // <-- overwrite if Other
            // 'is_fixed' => $request->is_fixed ?? 'No', // default to 'No' if not provided
            // 'Fixed_Details' => $request->Fixed_Details,
            'Request_Description' => $request->Request_Description,
            // 'Remark' => $request->Remark,
            'IT_Officer' => $request->IT_Officer ?? 'Null',
            'Remark' => $request->Remark ?? 'Null', // default to empty string if not provided
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
            'In_Progress_Date'    => 'nullable|date',
            'Priority'            => 'nullable|in:Low,Medium,High,Critical',
            'System'              => 'nullable|string|max:100',
            'Type'                => 'nullable|string|max:100',
            'Issue_Category'      => 'nullable|string|max:100',
            'Other_Category'      => 'nullable|string|max:255',
            'Request_Description' => 'required|string|max:500',
            'Assignee'            => 'nullable|string|max:100',
            'Software_Comment'    => 'nullable|string|max:1000',
            'Testers'             => 'nullable|string|max:255',
            'Launched_Date'       => 'nullable|date',
            'Job_Done_Date'       => 'nullable|date', // ❗️ တစ်ခုကို ဖယ်လိုက်ပါပြီ
            'User_Feedback'       => 'nullable|string|max:1000',
            'Remark'              => 'nullable|string|max:1000',
        ]);

        $issueCategory = $request->Issue_Category;
        if ($issueCategory === 'Other' && $request->Other_Category) {
            $issueCategory = $request->Other_Category;
        }

        $ticketId = 'TCKT-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));

        // ❗️ 1. Data create လုပ်ပြီး $softwareRequest variable ထဲကို သိမ်းလိုက်ပါ
        $softwareRequest = Software_Request::create([
            'ticket_id'           => $ticketId,
            'requester_name'      => $request->Requester_Name,
            'employee_id'         => $request->Employee_ID,
            'requester_email'     => $request->Requester_Email,
            'requester_phone'     => $request->Requester_Phone,
            'department'          => $request->Department,
            'location'            => $request->Location,
            'request_date'        => now()->toDateString(),
            'in_progress_date'    => null,
            'priority'            => $request->Priority ?? 'Low', // ❗️ 2. '?? Null' ကို ဖယ်လိုက်ပါ
            'system'              => $request->System,
            'type'                => $request->Type,
            'issue_category'      => $issueCategory ?? 'Null',
            'other_category'      => $request->Other_Category ?? 'Null',
            'request_description' => $request->Request_Description,
            'assignee'            => $request->Assignee ?? 'Null',
            'software_comment'    => $request->Software_Comment ?? 'Null',
            'testers'             => $request->Testers ?? 'Null',
            'launched_date'       => null,
            'job_done_date'       => null,
            'job_close_date'      => null,
            'user_feedback'       => $request->User_Feedback ?? 'Null',
            'remark'              => $request->Remark ?? 'Null',
            'status'              => 'Open',
        ]);

        // Send Email to Request Receiver
        // try {
        //     // ❗️ 3. .env file ကနေ email ကို ခေါ်သုံးတာ ပိုကောင်းပါတယ်
        //     $receiverEmail = env('MAIL_RECEIVER_ADDRESS', 'rglscanner9@gmail.com');
        //     Mail::to($receiverEmail)->send(new SoftwareRequestNotification($softwareRequest));

        // } catch (\Exception $e) {
        //     // Email ပို့တာ မအောင်မြင်ရင်တောင် request ကိုတော့ သိမ်းပြီးသားဖြစ်ကြောင်း message ပြနိုင်ပါတယ်
        //     return redirect()->back()->with('warning', 'Request saved successfully, but failed to send notification email. Error: ' . $e->getMessage());
        // }

        // Mail ပို့မည့် Logic
        // $adminEmail = config('mail.admin_address'); // .env ကနေယူထားတဲ့ admin email
        
        $adminEmail = 'ppnyein@rgldryport.com'; // သင့် admin email ကို ဒီမှာ ထည့်ပါ
        $gmEmail = 'ktmoe@rgldryport.com'; // သင့် GM email ကို ဒီမှာ ထည့်ပါ
        $ttEmail = 'tttin@rgldryport.com'; // သင့် TT email ကို ဒီမှာ ထည့်ပါ

        // Admin ကို Mail ပို့ပါ
        Mail::to($adminEmail)->send(new SoftwareRequestCreateMail($request));
        if($request->Location === 'Mandalay') {
            Mail::to($ttEmail)->send(new SoftwareRequestCreateMail($request));
        }
        elseif($request->Location === 'Yangon'){
            Mail::to($gmEmail)->send(new SoftwareRequestCreateMail($request));
        }

        return redirect()->back()->with('success', 'Software request added successfully and notification sent.');
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
            'category'      => 'required|string|max:255',
            // 'Other_Category'      => 'nullable|string|max:255',
            'Request_Description' => 'required|string|max:255',
            'Remark'              => 'nullable|string',
        ]);

        // 2. Handle the 'Other' category logic
        $issueCategory = $request->category;
        if ($issueCategory === 'Other' && $request->otherCategoryDiv) {
            $issueCategory = $request->otherCategoryDiv;
        }

        // 3. Create a new service request record
        DataCenter_Request::create([
            'Requester_Name'      => $validated['Requester_Name'],
            'Employee_ID'         => $validated['Employee_ID'],
            'Requester_Phone'     => $validated['Requester_Phone'],
            'Department'          => $validated['Department'],
            'Location'            => $validated['Location'],
            // 'Priority'            => $validated['Priority'],
            'Issue_Category'      => $issueCategory,
            'Request_Description' => $validated['Request_Description'],
            // 'Remark'              => $validated['Remark'],
            'Remark'            => $validated['Remark'] ?? 'Null', // default to 'Null' if not provided
            // Add any other fields, like 'status', if needed
            'status'              => 'Open',
        ]);

        // 4. Redirect with a success message
        return redirect()->back()->with('success', 'Service request submitted successfully!');
    }

    

    // Change Status

    public function updateStatus(Request $request, $id)
    {
        // Only admins can change status
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', '❌ Access Denied: Admin role only.');
        }

        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $req = It_Request::findOrFail($id);
        $req->status = $request->status;

        // If status is "In Progress", assign to currently logged-in user
        if ($request->status === 'In Progress') {
            $req->IT_Officer = auth()->user()->name; // or use 'name' if you store username
        }

        $req->save();

        return redirect()->back()->with('success', '✅ Status updated!');
    }

    // public function updateStatus(Request $request, $id)
    // {
    //     // 1. Only admins can change status (General Check)
    //     if (!auth()->check() || auth()->user()->role !== 'admin') {
    //         return redirect()->back()->with('error', '❌ Access Denied: Admin role only.');
    //     }

    //     $request->validate([
    //         'status' => 'required|string|max:255',
    //     ]);

    //     $req = It_Request::findOrFail($id);

    //     // 2. If status is being changed to "Completed", check for matching IT Officer
    //     if ($request->status === 'Completed') {
    //         // If the IT Officer name does NOT match the logged-in user's name
    //         if ($req->IT_Officer !== auth()->user()->name) {
    //             return redirect()->back()->with('error', '❌ This request can only be completed by the assigned IT Officer.');
    //         }
    //     }

    //     // 3. If status is "In Progress", assign the current user
    //     if ($request->status === 'In Progress') {
    //         $req->IT_Officer = auth()->user()->name;
    //     }

    //     $req->status = $request->status;
    //     $req->save();

    //     return redirect()->back()->with('success', '✅ Status updated!');
    // }




    //For Software

    public function softwareUpdateStatus(Request $request, $id)
{
    // Authorization Check (Admin Role)
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        return redirect()->back()->with('error', '❌ Access Denied: Admin role only.');
    }

    $request->validate([
        'status' => 'required|string|max:255',
        'priority' => 'nullable|in:Low,Medium,High,Critical',
        'software_comment' => 'nullable|string|max:1000',
        'assignee' => 'nullable|string|max:100',
        'testers' => 'nullable|string|max:100',
    ]);

    $req = Software_Request::findOrFail($id);
    $req->status = $request->status;
    
    $shouldSendDeptMail = false; // Mail ပို့ဖို့အတွက် flag
    $shouldSendJobDoneMail = false; // Job Done Mail ပို့ဖို့ အတွက်ပါ။
    $shouldSendLaunchedMail = false; // Job Launched Mail ပို့ဖို့ အတွက် ပါ။
    $shouldSendCompleteMail = false;


    // Status is being set to 'In Progress'
    if ($request->status === 'In Progress') {
        // ... [Data and Assignee update logic] ...
        
        if (is_null($req->in_progress_date)) {
            $req->in_progress_date = now();
        }
        if (is_null($req->assignee)) {
            $req->assignee = auth()->user()->name;
        } 
        
        $req->assignee = $request->assignee ?? $req->assignee;
        $req->priority = $request->priority ?? $req->priority ?? 'Low';
        $req->software_comment = $request->software_comment ?? $req->software_comment ?? null;
        
        $shouldSendDeptMail = true; // Mail ပို့ရန် Flag
    }
    
    // ... [Date Updates for Launched / Job Done] ...

    // if ($request->status === 'Launched' && is_null($req->launched_date)) {
    //     $req->launched_date = now();
    // }

    if ($request->status === 'Launched') {
        // ... [Data and Assignee update logic] ...
        
        if (is_null($req->launched_date)) {
            $req->launched_date = now();
        }

        $req->testers = $request->testers ?? $req->testers;

        // if (is_null($req->assignee)) {
        //     $req->assignee = auth()->user()->name;
        // } 
        
        // $req->assignee = $request->assignee ?? $req->assignee;
        // $req->priority = $request->priority ?? $req->priority ?? 'Low';
        // $req->software_comment = $request->software_comment ?? $req->software_comment ?? null;
        
        $shouldSendLaunchedMail = true; // Mail ပို့ရန် Flag
    }

    // if ($request->status === 'Job Done' && is_null($req->job_done_date)) {
    //     $req->job_done_date = now();
    // }

    if ($request->status === 'Job Done') {
        // ... [Data and Assignee update logic] ...
        
        if (is_null($req->job_done_date)) {
            $req->job_done_date = now();
        }
        // if (is_null($req->assignee)) {
        //     $req->assignee = auth()->user()->name;
        // } 
        
        // $req->assignee = $request->assignee ?? $req->assignee;
        // $req->priority = $request->priority ?? $req->priority ?? 'Low';
        // $req->software_comment = $request->software_comment ?? $req->software_comment ?? null;
        
        $shouldSendJobDoneMail = true; // Mail ပို့ရန် Flag
    }

    if ($request->status === 'Completed') {
        // ... [Data and Assignee update logic] ...
        
        if (is_null($req->job_close_date)) {
            $req->job_close_date = now();
        }
        // if (is_null($req->assignee)) {
        //     $req->assignee = auth()->user()->name;
        // } 
        
        // $req->assignee = $request->assignee ?? $req->assignee;
        // $req->priority = $request->priority ?? $req->priority ?? 'Low';
        // $req->software_comment = $request->software_comment ?? $req->software_comment ?? null;
        
        $shouldSendCompleteMail = true; // Mail ပို့ရန် Flag
    }

    $req->save(); // Database ကို Save လုပ်သည်
    
    
    // 🔔 Department Mail Routing Logic
    if ($shouldSendDeptMail) {
        $departmentName = $req->department; // Request ရဲ့ Department ကို ယူပါ
        $location = $req->location;
        
        // 1. Config file ကနေ Receiver Email ကို ရှာဖွေပါ
        // $receiverEmail = Config::get('department_emails.mapping.' . $departmentName);
        if($location === 'Mandalay'){
            $receiverEmail = Config::get('department_emails.mandalay_mapping.' . $departmentName);
        }
        elseif($location === 'Yangon'){
            $receiverEmail = Config::get('department_emails.mapping.' . $departmentName);
        }
        
        // 2. Email ကို Config မှာ ရှာမတွေ့ခဲ့ရင် default admin ကို သုံးပါ
        if (empty($receiverEmail)) {
            $receiverEmail = Config::get('department_emails.default_receiver');
        }
        
        try {
            // Mail ကို သက်ဆိုင်ရာ Receiver Email ဆီသို့ ပို့သည်
            Mail::to($receiverEmail)->send(new SoftwareRequestProgressMail($req));
            if($location === 'Mandalay'){
                Mail::to('tttin@rgldryport.com')->send(new SoftwareRequestProgressMail($req));
            }
            elseif($location === 'Yangon'){
                Mail::to('ktmoe@rgldryport.com')->send(new SoftwareRequestProgressMail($req));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send In Progress notification to Dept Admin: ' . $departmentName . ' Error: ' . $e->getMessage());
            return redirect()->back()->with('warning', 'Status updated successfully, but departmental notification email failed to send.');
        }
    }

    if ($shouldSendLaunchedMail) {
        $departmentName = $req->department; // Request ရဲ့ Department ကို ယူပါ
        $location = $req->location; // Request ရဲ့ Location ကို ယူပါ
        
        // 1. Config file ကနေ Receiver Email ကို ရှာဖွေပါ
        // $receiverEmail = Config::get('department_emails.mapping.' . $departmentName);
        if($location === 'Mandalay'){
            $receiverEmail = Config::get('department_emails.mandalay_mapping.' . $departmentName);
        }
        elseif($location === 'Yangon'){
            $receiverEmail = Config::get('department_emails.mapping.' . $departmentName);
        }
        
        // 2. Email ကို Config မှာ ရှာမတွေ့ခဲ့ရင် default admin ကို သုံးပါ
        if (empty($receiverEmail)) {
            $receiverEmail = Config::get('department_emails.default_receiver');
        }
        
        try {
            // Mail ကို သက်ဆိုင်ရာ Receiver Email ဆီသို့ ပို့သည်
            Mail::to($receiverEmail)->send(new SoftwareLaunchedMail($req));
            if($location === 'Mandalay'){
                Mail::to('tttin@rgldryport.com')->send(new SoftwareLaunchedMail($req));
            }
            elseif($location === 'Yangon'){
                Mail::to('ktmoe@rgldryport.com')->send(new SoftwareLaunchedMail($req));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send In Progress notification to Dept Admin: ' . $departmentName . ' Error: ' . $e->getMessage());
            return redirect()->back()->with('warning', 'Status updated successfully, but departmental notification email failed to send.');
        }
    }

    if ($shouldSendJobDoneMail) {
        $departmentName = $req->department; // Request ရဲ့ Department ကို ယူပါ
        $location = $req->location; // Request ရဲ့ Location ကို ယူပါ

        // 1. Config file ကနေ Receiver Email ကို ရှာဖွေပါ
        // $receiverEmail = Config::get('department_emails.mapping.' . $departmentName);
        if($location === 'Mandalay'){
            $receiverEmail = Config::get('department_emails.mandalay_mapping.' . $departmentName);
        }
        elseif($location === 'Yangon'){
            $receiverEmail = Config::get('department_emails.mapping.' . $departmentName);
        }
        
        // 2. Email ကို Config မှာ ရှာမတွေ့ခဲ့ရင် default admin ကို သုံးပါ
        if (empty($receiverEmail)) {
            $receiverEmail = Config::get('department_emails.default_receiver');
        }
        
        try {
            // Mail ကို သက်ဆိုင်ရာ Receiver Email ဆီသို့ ပို့သည်
            Mail::to($receiverEmail)->send(new SoftwareJobDoneMail($req));
            if($location === 'Mandalay'){
                Mail::to('tttin@rgldryport.com')->send(new SoftwareJobDoneMail($req));
            }
            elseif($location === 'Yangon'){
                Mail::to('ktmoe@rgldryport.com')->send(new SoftwareJobDoneMail($req));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send In Progress notification to Dept Admin: ' . $departmentName . ' Error: ' . $e->getMessage());
            return redirect()->back()->with('warning', 'Status updated successfully, but departmental notification email failed to send.');
        }
    }

    if ($shouldSendCompleteMail) {
        $departmentName = $req->department; // Request ရဲ့ Department ကို ယူပါ
        $location = $req->location; // Request ရဲ့ Location ကို ယူပါ
        
        // 1. Config file ကနေ Receiver Email ကို ရှာဖွေပါ
        // $receiverEmail = Config::get('department_emails.mapping.' . $departmentName);
        if($location === 'Mandalay'){
            $receiverEmail = Config::get('department_emails.mandalay_mapping.' . $departmentName);
        }
        elseif($location === 'Yangon'){
            $receiverEmail = Config::get('department_emails.mapping.' . $departmentName);
        }
        
        // 2. Email ကို Config မှာ ရှာမတွေ့ခဲ့ရင် default admin ကို သုံးပါ
        if (empty($receiverEmail)) {
            $receiverEmail = Config::get('department_emails.default_receiver');
        }
        
        try {
            // Mail ကို သက်ဆိုင်ရာ Receiver Email ဆီသို့ ပို့သည်
            Mail::to($receiverEmail)->send(new SoftwareCompletedMail($req));
            if($location === 'Mandalay'){
                Mail::to('tttin@rgldryport.com')->send(new SoftwareCompletedMail($req));
            }
            elseif($location === 'Yangon'){
                Mail::to('ktmoe@rgldryport.com')->send(new SoftwareCompletedMail($req));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send In Progress notification to Dept Admin: ' . $departmentName . ' Error: ' . $e->getMessage());
            return redirect()->back()->with('warning', 'Status updated successfully, but departmental notification email failed to send.');
        }
    }

    return redirect()->back()->with('success', '✅ Status updated successfully!');
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




    // For IT INfra


    public function updateDescription(Request $request, $id)
    {
        // Admin only
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }

        $request->validate([
            'Request_Description' => 'required|string|max:255',
        ]);

        $service = It_Request::findOrFail($id);
        $service->Request_Description = $request->Request_Description;
        $service->save();

        return redirect()->back()->with('success', 'Request Description updated successfully!');
    }

    // Update Issue Category
    public function updateCategory(Request $request, $id)
    {

        // Check if the user is authenticated and has the 'admin' role
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }

        $request->validate([
            'Issue_Category' => 'required|string|max:255',
            // 'Other' ကို ရွေးမှသာ Other_Category ကို စစ်ပါမယ်။
            'Other_Category' => 'required_if:Issue_Category,Other|nullable|string|max:255',
        ]);

        $service = It_Request::findOrFail($id);

        // Issue_Category က 'Other' ဖြစ်ရင် Other_Category ရဲ့ တန်ဖိုးကို ယူပါ
        if ($request->input('Issue_Category') === 'Other') {
            $service->Issue_Category = $request->input('Other_Category');
        } else {
            // 'Other' မဟုတ်ရင် ပုံမှန်အတိုင်း Issue_Category ရဲ့ တန်ဖိုးကို ယူပါ
            $service->Issue_Category = $request->input('Issue_Category');
        }

        $service->save();

        return redirect()->back()->with('success', 'Issue Category updated successfully!');
    }

    public function updateLocation(Request $request, $id)
    {
        // Check if the user is authenticated and has the 'admin' role
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }

        $request->validate([
            'Location' => 'required|string|in:Yangon,Mandalay',
        ]);

        $service = It_Request::findOrFail($id);
        $service->Location = $request->input('Location');
        $service->save();

        return redirect()->back()->with('success', 'Location updated successfully!');
    }

    public function updateRemark(Request $request, $id)
    {
        // Check if the user is authenticated and has the 'admin' role
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }

        $request->validate([
            'Remark' => 'nullable|string',
        ]);

        $service = It_Request::findOrFail($id);
        $service->Remark = $request->input('Remark');
        $service->save();

        return redirect()->back()->with('success', 'Comment updated successfully!');
    }


    //For Data Center

    // Update Data Center Issue Category
    public function DataCenterupdateCategory(Request $request, $id)
    {

        // Check if the user is authenticated and has the 'admin' role
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }

        $request->validate([
            'Issue_Category' => 'required|string|max:255',
            // 'Other' ကို ရွေးမှသာ Other_Category ကို စစ်ပါမယ်။
            'Other_Category' => 'required_if:Issue_Category,Other|nullable|string|max:255',
        ]);

        $service = DataCenter_Request::findOrFail($id);

        // Issue_Category က 'Other' ဖြစ်ရင် Other_Category ရဲ့ တန်ဖိုးကို ယူပါ
        if ($request->input('Issue_Category') === 'Other') {
            $service->Issue_Category = $request->input('Other_Category');
        } else {
            // 'Other' မဟုတ်ရင် ပုံမှန်အတိုင်း Issue_Category ရဲ့ တန်ဖိုးကို ယူပါ
            $service->Issue_Category = $request->input('Issue_Category');
        }

        $service->save();

        return redirect()->back()->with('success', 'Issue Category updated successfully!');
    }

    // Data Center Update Description

    public function DataCenterUpdateDescription(Request $request, $id)
    {
        // Admin only
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }

        $request->validate([
            'Request_Description' => 'required|string|max:255',
        ]);

        $service = DataCenter_Request::findOrFail($id);
        $service->Request_Description = $request->Request_Description;
        $service->save();

        return redirect()->back()->with('success', 'Request Description updated successfully!');
    }

    public function DataCenterUpdateRemark(Request $request, $id)
    {

        // Admin only
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }

        $request->validate([
            'Remark' => 'nullable|string', // Remark is nullable, so no 'required'
        ]);

        $service = DataCenter_Request::findOrFail($id);
        $service->Remark = $request->input('Remark');
        $service->save();

        return redirect()->back()->with('success', 'Comment updated successfully!');
    }



    public function showForm($id) {
        return view('feedback.form', ['job_id' => $id]);
    }

    // public function submit(Request $request, $id) {
    //     // Validate & Save feedback
    //     // Software_Request::create([
    //     //     'job_id' => $id,
    //     //     'user_id' => auth()->id(),
    //     //     'feedback' => $request->feedback,
    //     // ]);

    //     // return redirect()->route('feedback.form', $id)->with('success', 'Thanks for your feedback!');
    //     $request->validate([
    //         'user_feedback' => 'nullable|string', // Remark is nullable, so no 'required'
    //     ]);

    //     $service = Software_Request::findOrFail($id);
    //     $service->user_feedback = $request->user_feedback;
    //     $service->save();

    //     return redirect()->back()->with('success', 'Comment updated successfully!');
    // }

    // App\Http\Controllers\Pages\ItRequestController.php ထဲက submit function

    // App\Http\Controllers\Pages\ItRequestController.php ထဲက submit function

public function submit(Request $request, $id)
{
    // 1. Validation
    $request->validate([
        // user_feedback ကို မဖြစ်မနေ ဖြည့်ခိုင်းရန်
        'user_feedback' => 'required|string|max:1000', 
    ]);

    $service = Software_Request::findOrFail($id);

    // 2. CRITICAL CHECK: Job ပြီးဆုံးပြီးသားဆိုရင် ထပ်မံလုပ်ဆောင်ခြင်းကို ပိတ်ပင်ပါ
    if ($service->status === 'Completed') {
        // Completed ဖြစ်ပြီးသားဖြစ်ကြောင်း Dashboard မှာ ပြသမည်
        return redirect()->route('dashboard')->with('info', '✅ This request is already completed. Thank you for your feedback.');
    }

    // 3. Data Update
    $service->user_feedback = $request->input('user_feedback');
    
    // 4. Status ကို 'Completed' သို့ မပြောင်းဘဲ၊ Job Close Date ကိုလည်း မသတ်မှတ်တော့ပါ။
    // Status သည် 'Launched' သို့မဟုတ် 'Job Done' အတိုင်း ဆက်ရှိနေမည်။
    
    $service->save();

    // 5. Redirect: Feedback ရရှိပြီးကြောင်း ပြသပြီး Dashboard ကို ပြန်ပို့ပါ
    return redirect()->route('dashboard')->with('success', '✅ Feedback recorded successfully! An Admin will finalize the request soon.');
}



}

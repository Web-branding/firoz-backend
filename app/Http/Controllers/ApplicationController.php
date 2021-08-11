<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Education;
use App\Models\Marriage;
use App\Models\Treatment;
use App\Models\House;
use App\Models\Slide;
use ZipArchive;
use Illuminate\Support\Facades\FILE;

class ApplicationController extends Controller
{
    public function application()
    {
        $applications = Application::latest()->paginate(25);
        return view('applications.applications', compact('applications'));
    }
    public function edit($id) {
        $data = Application::find($id);
        return view('applications.edit_application', compact('data'));
    } 
    public function update(Request $request, Application $application) {
        $id = $request->id;
        $reason = $request->reason;
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'place' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'aadhar' => 'required',
            'ration' => 'required',
            'amount' => 'required',
            'priority' => 'required',
        ]);
        $application->find($id)->update($request->all());
        if($reason) {
            Application::where('id', $id)->update(array('reason' => $reason));
        }
        return redirect()->route('application.view')->with('updated', 'Applicant updated successfully.');
    }
    public function show($id) {
        $data = Application::find($id);
        $ed = Education::where('application_id', $data->application_id)->get()->all();
        $ma = Marriage::where('application_id', $data->application_id)->get()->all();
        $tr = Treatment::where('application_id', $data->application_id)->get()->all();
        $ho = House::where('application_id', $data->application_id)->get()->all();
        $data['data'] = $data;
        $data['ed'] = $ed;
        $data['ma'] = $ma;
        $data['tr'] = $tr;
        $data['ho'] = $ho;
        return view('applications.detail_application', $data);
    }
    public function view($id)
    {
        $data = $id;
        return view('applications.view_file',compact('data'));
    }
     public function download(Request $request,$file)
    {
        return response()->download(storage_path('app/public/files/'.$file));
    }
    public function accept(Request $request) {
        $accept_id = $request->id;
        $reject_id = $request->reject_id;
        $approve = $request->approve;
        $reject = $request->reason;
        if($approve) {
            Application::where('id', $accept_id)->update(array('status' => 'Approved','reason' => ''));
        }
        if($reject) {
            Application::where('id', $reject_id)->update(array('status' => 'Rejected','reason' => $reject));
        }
        return redirect()->route('application.view')->with('accept_reject', 'Applicant status updated successfully.');
    }
    public function destroy(Request $request, Application $application) {
        $id = $request->delete_id;
        $application->find($id)->delete();
        return redirect()->route('application.view')->with('delete', 'Applicant deleted successfully.');
    }
    public function index() {
        $slides = Slide::get()->all();
        return view('slide', compact('slides'));
    }
    public function slide() {
        return view('add_slide');
    }
    public function add_slide(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'required',
        ]); 
        $filename = $request->file('file')->getClientOriginalName();
        $request->file('file')->move(public_path('slides'), $filename);  

        $data=new Slide();
        $data->title=$request->title;
        $data->description=$request->description;
        $data->file=$filename;
        $data->save();
        return redirect()->route('slides.view')->with('add', 'Slide added successfully!');     
    }
    public function destroy_slide(Request $request, Slide $slide) {
        $id = $request->delete_id;
        $slide->find($id)->delete();
        return redirect()->route('slides.view')->with('delete', 'Slide deleted successfully.');
    }

    // public function index() {
    //     // $applications = Application::get()->all();
    //     // $applications = Application::orderBy('id', 'DESC')->get();
    //     $applications = Application::latest()->paginate(25);
    //     return view('application', compact('applications'));
    // }

    // public function add_fn() {
    //     return view('add_applicant');
    // }

    // public function add(Request $request) {
    //     // echo "hai";
    //     $request->validate([
    //         'fname' => 'required',
    //         'lname' => 'required',
    //         'place' => 'required',
    //         'address' => 'required',
    //         'reason' => 'required',
    //         'amount' => 'required',
    //         'priority' => 'required',
    //         'file' => 'required',
    //         'file.*' => 'required|mimes:pdf,xlx,csv|max:2048'
    //     ]); 
    //     // $files = [];
    //     if($request->hasfile('file'))
    //      {
    //         foreach($request->file('file') as $file)
    //         {
    //             // $name = time().rand(1,100).'.'.$file->extension();
    //             $name = $file->getClientOriginalName();
    //             $file->move(public_path('files'), $name);  
    //             $files[] = $name;  
    //         }
    //      }
    
        
    //     $data=new Application();
    //     $data->fname=$request->fname;
    //     $data->lname=$request->lname;
    //     $data->place=$request->place;
    //     $data->address=$request->address;
    //     $data->reason=$request->reason;
    //     $data->amount=$request->amount;
    //     $data->priority=$request->priority;
    //     $data->file = $files;
    //     $data->save();
    //     // Application::create($request->all());
    //     return redirect()->route('application.view')->with('add', 'Applicant added successfully!');     
    // }

    // public function edit($id) {
    //     // $data = Application::where('id', $id)->get();
    //     $data = Application::find($id);
    //     return view('edit_application', compact('data'));
    // } 

    // public function update(Request $request, Application $application) {
    //     $id = $request->id;
    //     // echo $id;
    //     $request->validate([
    //         'fname' => 'required',
    //         'lname' => 'required',
    //         'place' => 'required',
    //         'address' => 'required',
    //         'reason' => 'required',
    //         'amount' => 'required',
    //         'priority' => 'required'
    //     ]);
    //     $application->find($id)->update($request->all());
    //     return redirect()->route('application.view')->with('updated', 'Applicant updated successfully.');
    // }

    // public function show($id) {
    //     $data = Application::find($id);
    //     // $file['files'] = $data->file;
    //     // return view('view_file', $file); 
    //     return view('detail_application', compact('data'));
    // }

    // public function accept(Request $request) {
    //     $id = $request->id;
    //     $approve = $request->approve;
    //     $reject = $request->reject;
    //     if($approve) {
    //         Application::where('id', $id)->update(array('status' => 'Approved'));
    //     }
    //     if($reject) {
    //         Application::where('id', $id)->update(array('status' => 'Rejected'));
    //     }
    //     return redirect()->route('application.view')->with('accept_reject', 'Applicant status updated successfully.');
    // }

    // public function download(Request $request,$file)
    // {
    //     return response()->download(public_path('files/'.$file));
    // }

    // public function view($id)
    // {
    //     $data = $id;
    //     return view('view_file',compact('data'));
    // }

    // public function destroy(Request $request, Application $application) {
    //     $id = $request->delete_id;
    //     $application->find($id)->delete();
    //     return redirect()->route('application.view')->with('delete', 'Applicant deleted successfully.');
    // }

    // public function search(Request $request) {
    //     // $id = $request->id;
    //     // $data =  Application::find($id);
    //     $application_id = $request->id;
    //     $datas =  Application::where('application_id', $application_id)->get();
    //     return view('search', compact('datas'));
    // }
            
    // public function sort(Request $request) {
    //     $status = $request->status;
    //     if( $status === 'Pending') {
    //         $applications =  Application::where('status', $status)->get();
    //     }
    //     else if( $status === 'Approved') {
    //         $applications =  Application::where('status', $status)->get();
    //     }
    //     else if( $status === 'Rejected') {
    //         $applications =  Application::where('status', $status)->get();
    //     }
    //     else {
    //         $applications =  Application::where('priority', $status)->get();
    //     }
    //     return view('sort_status', compact('applications'));   
    // }
}

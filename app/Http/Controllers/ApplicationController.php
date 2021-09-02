<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Education;
use App\Models\Marriage;
use App\Models\Treatment;
use App\Models\House;
use App\Models\Slide;
use App\Models\Video;
use ZipArchive;
use Illuminate\Support\Facades\FILE;

class ApplicationController extends Controller
{
    public function application()
    {
        $applications = Application::latest()->paginate(10);
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
        return response()->download(public_path('files/'.$file));
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
        $data = Application::find($id);
        $application->find($id)->delete();
        Education::where('application_id', $data->application_id)->delete();
        Marriage::where('application_id', $data->application_id)->delete();
        Treatment::where('application_id', $data->application_id)->delete();
        House::where('application_id', $data->application_id)->delete();
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
        $data->path=asset('public/slides/' . $filename);
        $data->save();
        return redirect()->route('slides.view')->with('add', 'Slide added successfully!');     
    }
    public function destroy_slide(Request $request, Slide $slide) {
        $id = $request->delete_id;
        $slide->find($id)->delete();
        return redirect()->route('slides.view')->with('delete', 'Slide deleted successfully.');
    }

    public function search(Request $request) {
        $application_id = $request->id;
        $data =  Application::where('application_id', $application_id)->get();
        return view('search', compact('data'));
    }
            
    public function sort(Request $request) {
        $status = $request->status;
        if( $status === 'Pending') {
            $applications = Application::where('status', $status)->latest()->paginate(10);
            // $applications =  Application::where('status', $status)->get();
        }
        else if( $status === 'Approved') {
            $applications =  Application::where('status', $status)->latest()->paginate(10);
        }
        else if( $status === 'Rejected') {
            $applications =  Application::where('status', $status)->latest()->paginate(10);
        }
        else {
            $applications =  Application::where('priority', $status)->latest()->paginate(10);
        }
        return view('sort_status', compact('applications'));   
    }
    public function videolist() {
        $video = Video::get()->all();
        return view('video.video', compact('video'));
    }
    public function video() {
        return view('video.add_video');
    }
    // public function add_video(Request $request) {
    //     $request->validate([
    //         'title' => 'required',
    //         'description' => 'required',
    //         'video' => 'required|mimes:mp4',
    //         'file' => 'required',
    //         'file.*' => 'required|mimes:pdf,xlx,csv',  
    //     ]);

    //     if($request->hasfile('file'))
    //     {
    //        foreach($request->file('file') as $file)
    //        {
    //            $name = $file->getClientOriginalName();
    //            $file->move(public_path('files'), $name);  
    //            $files[] = $name;  
    //        }
    //     }
        
    //     $filename = $request->file('video')->getClientOriginalName();
    //     $request->file('video')->move(public_path('videos'), $filename);  

    //     $data=new Video();
    //     $data->title=$request->title;
    //     $data->description=$request->description;
    //     $data->video=$filename;
    //     $data->file=$files;
    //     $data->save();
    //     return redirect()->route('video.view')->with('add', 'Video added successfully!');     
    // }

    public function add_video(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'video' => 'required|mimes:mp4',
            'file' => 'required',
            'file.*' => 'required|mimes:pdf,xlx,csv',  
        ]);

        if($request->hasfile('file'))
        {
           foreach($request->file('file') as $file)
           {
               $name = $file->getClientOriginalName();
               $file->move(public_path('files'), $name);  
               $files[] = $name;  
               $files_path[] = asset('files/' . $name);
           }
        }
        
        $filename = $request->file('video')->getClientOriginalName();
        $request->file('video')->move(public_path('videos'), $filename);  

        $data=new Video();
        $data->title=$request->title;
        $data->description=$request->description;
        $data->video=$filename;
        $data->file=$files;
        $data->video_path=asset('videos/' . $filename);
        // $data->file_path=json_encode($files_path);
        $data->file_path=implode(',',$files_path);
        $data->save();
        return redirect()->route('video.view')->with('add', 'Video added successfully!');     
    }

    public function destroy_video(Request $request, Video $video) {
        $id = $request->delete_id;
        $video->find($id)->delete();
        return redirect()->route('video.view')->with('delete', 'Video deleted successfully.');
    }
    public function display($id)
    {
        $data = $id;
        return view('video.view_file',compact('data'));
    }

    public function searchs_id($id) {
        $application_id = $id;
        $data =  Application::where('application_id', $application_id)->get();
        return view('search', compact('data'));
    }
}
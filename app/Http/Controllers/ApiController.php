<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Device;
use App\Helpers\Helper;
use App\Models\Education;
use App\Models\Marriage;
use App\Models\Treatment;
use App\Models\House;
use App\Models\Other;
use App\Models\Slide;

class ApiController extends Controller
{

    public function application(Request $request)
    {
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
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'file' => 'required|mimes:pdf,xlx,csv',
            'category' => 'required',
        ]); 

        $image = $request->file('image');
        $imagename = $image->getClientOriginalName();
        $image->move(storage_path('app/public/images'), $imagename); 

        $file = $request->file('file');
        $filename=$file->getClientOriginalName();
        $file->move(storage_path('app/public/files'), $filename);  
        
        $application_id = Helper::IDGenerator(new Application, 'application_id', 5, 'ID');
 
        $data=new Application();
        $data->application_id=$application_id;
        $data->fname=$request->fname;
        $data->lname=$request->lname;
        $data->place=$request->place;
        $data->address=$request->address;
        $data->phone=$request->phone;
        $data->aadhar=$request->aadhar;
        $data->ration=$request->ration;
        $data->amount=$request->amount;
        $data->priority=$request->priority;
        $data->image=$imagename;
        $data->file = $filename;
        $data->category=$request->category;
        $results = $data->save();
        if($results) {
            return response()->json([
                'status' => 200,
                'message' => "Data has been saved",
                'id' => $application_id
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'error' => 'Please fill all the mandatory fields',
            ]);
        }   
    }

    public function education(Request $request)
    {
        $request->validate([
            'fee' => 'required',
            'scholarship' => 'required',
            'college' => 'required',
            'course' => 'required',
            'college_place' => 'required',
            'certification_no' => 'required',
        ]); 
 
        $data=new Education();
        $data->application_id=$request->application_id;
        $data->fee=$request->fee;
        $data->scholarship=$request->scholarship;
        $data->college=$request->college;
        $data->course=$request->course;
        $data->college_place=$request->college_place;
        $data->certification_no=$request->certification_no;
        $results = $data->save();
        if($results) {
            return response()->json([
                'status' => 200,
                'message' => "Data has been saved",
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'error' => 'Please fill all the mandatory fields',
            ]);
        }   
    }

    public function marriage(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv',
        ]); 

        $file = $request->file('file');
        $filename=$file->getClientOriginalName();
        $file->move(storage_path('app/public/files'), $filename); 
 
        $data=new Marriage();
        $data->application_id=$request->application_id;
        $data->file = $filename;
        $results = $data->save();
        if($results) {
            return response()->json([
                'status' => 200,
                'message' => "Data has been saved",
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'error' => 'Please fill all the mandatory fields',
            ]);
        }   
    }

    public function treatment(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'file.*' => 'required|mimes:pdf,xlx,csv'
        ]); 

        // $files = [];
        if($request->hasfile('file'))
         {
            foreach($request->file('file') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move(storage_path('app/public/files'), $name);  
                $files[] = $name;  
            }
         }

        $data=new Treatment();
        $data->application_id=$request->application_id;
        $data->file = $files;
        $results = $data->save();
        if($results) {
            return response()->json([
                'status' => 200,
                'message' => "Data has been saved",
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'error' => 'Please fill all the mandatory fields',
            ]);
        }   
    }

    public function house(Request $request)
    {
        $request->validate([
            'property' => 'required',
        ]); 
       
        $data=new House();
        $data->application_id=$request->application_id;
        $data->property=$request->property;
        if($request->cent)
        {
            $data->cent=$request->cent;
        }
        $results = $data->save();
        if($results) {
            return response()->json([
                'status' => 200,
                'message' => "Data has been saved",
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'error' => 'Please fill all the mandatory fields',
            ]);
        }   
    }

    // public function other(Request $request)
    // {
    //     $request->validate([
    //         'fname' => 'required',
    //         'lname' => 'required',
    //         'place' => 'required',
    //         'address' => 'required',
    //         'amount' => 'required',
    //         'priority' => 'required',
    //         'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //         'ref_file' => 'required|mimes:pdf|max:2048',
    //         'file' => 'required',
    //         'file.*' => 'required|mimes:pdf,xlx,csv|max:2048'
    //     ]); 

    //     $image = $request->file('image');
    //     $imagename = $image->getClientOriginalName();
    //     $image->move(public_path('images'), $imagename);

    //     $ref_file = $request->file('ref_file');
    //     $ref_filename = $ref_file->getClientOriginalName();
    //     $ref_file->move(public_path('files'), $ref_filename);

    //     if($request->hasfile('file'))
    //     {
    //         $files = [];
    //        foreach($request->file('file') as $file)
    //        {
    //             $filename=$file->getClientOriginalName();
    //             $file->move(public_path('files'), $filename);  
    //             $files[] = $filename;  
    //         }
    //     }
    //     $application_id = Helper::IDGenerator(new Other, 'application_id', 5, 'OTH');
 
    //     $data=new Other();
    //     $data->application_id=$application_id;
    //     $data->fname=$request->fname;
    //     $data->lname=$request->lname;
    //     $data->place=$request->place;
    //     $data->address=$request->address;
    //     $data->amount=$request->amount;
    //     $data->priority=$request->priority;
    //     $data->image=$imagename;
    //     $data->ref_file=$ref_filename;
    //     $data->file = $files;
    //     $results = $data->save();
    //     if($results) {
    //         return ["Result" => "Data has been saved"];
    //     }
    //     else {
    //         return ["Result" => $files];
    //     }   
    // }

    // public function search($id) {
    //     $application_id = Application::where('application_id', $id)->get();
    //     if($application_id) {
    //         return response()->json([
    //             'status' => 200,
    //             'result' => $application_id
    //         ]);
    //     }
    //     // return response()->json(['message' => 'Applicant Not Found', 404]);
    //     return response()->json([
    //         'status' => 404,
    //         'message' => 'Applicant Not Found'
    //     ]);
    // }

    public function search($id) {
        $ed_id = Education::where('application_id', $id)->get();
        $m_id = Marriage::where('application_id', $id)->get();
        $trt_id = Treatment::where('application_id', $id)->get();
        $oth_id = Other::where('application_id', $id)->get();
        // return response()->json([
        //     'status' => 404,
        //     'message' => $oth_id
        // ]);
        if(!$ed_id->isEmpty()) {
            return response()->json([
                'status' => 200,
                'result' => $ed_id
            ]);
        }
        else if(!$m_id->isEmpty()) {
            return response()->json([
                'status' => 200,
                'result' => $m_id
            ]);
        }
        else if(!$trt_id->isEmpty()) {
            return response()->json([
                'status' => 200,
                'result' => $trt_id
            ]);
        }
        else if(!$oth_id->isEmpty()) {
            return response()->json([
                'status' => 200,
                'result' => $oth_id
            ]);
        }
        // return response()->json(['message' => 'Applicant Not Found', 404]);
        return response()->json([
            'status' => 404,
            'message' => 'Applicant Not Found'
        ]);
    }

    public function slide() {
        $slides = Slide::get()->all();
        // foreach($slides as $slide)
        // {
        //     return response()->json([
        //         'title' => $slide->title,
        //         'description' => $slide->description,
        //         'image' => asset('slides/' . $slide->file),
        //         'status' => 200
        //     ]);
        // }

        foreach($slides as $slide)
        {
            $image[] = asset('slides/' . $slide->file);   
        }
        
        return response()->json([
            $slides,
            'image' => $image,
            'status' => 200,
        ]);
    }
}
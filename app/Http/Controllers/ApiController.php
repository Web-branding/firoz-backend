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
use App\Models\Video;
use App\Notifications\NewApplication;

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
        $image->move(public_path('images'), $imagename); 

        $file = $request->file('file');
        $filename=$file->getClientOriginalName();
        $file->move(public_path('files'), $filename);  
        
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

        $user = \App\Models\User::find(1);
        $details = [
            'id' => $application_id,
            'category' => $request->category,
            'fname' => $request->fname,
            'lname' => $request->lname,
        ];
        $user->notify(new NewApplication($details));

        if(!$results) {
            return response()->json([
                'status' => 400,
                'error' => 'Please fill all the mandatory fields',
            ]);
        }   
        $category = $request->category;
        if($category == 'Education')
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
            $data->application_id=$application_id;
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

        if($category == 'Marriage')
        {
            $request->validate([
                'mfile' => 'required|mimes:pdf,xlx,csv',
            ]); 
    
            $file = $request->file('mfile');
            $filename=$file->getClientOriginalName();
            $file->move(public_path('files'), $filename); 
     
            $data=new Marriage();
            $data->application_id=$application_id;
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

        if($category == 'Treatment')
        {
            $request->validate([
                'tfile' => 'required',
                'tfile.*' => 'required|mimes:pdf,xlx,csv'
            ]); 
    
            // $files = [];
            if($request->hasfile('tfile'))
             {
                foreach($request->file('tfile') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('files'), $name);  
                    $files[] = $name;  
                }
             }
    
            $data=new Treatment();
            $data->application_id=$application_id;
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

        if($category == 'Housing')
        {
            $request->validate([
                'property' => 'required',
            ]); 
           
            $data=new House();
            $data->application_id=$application_id;
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
    }

    public function search($id) {
        $app = Application::where('application_id', $id)->get();
        $ed_id = Education::where('application_id', $id)->get();
        $m_id = Marriage::where('application_id', $id)->get();
        $trt_id = Treatment::where('application_id', $id)->get();
        $ho_id = House::where('application_id', $id)->get();

        foreach($app as $ap)
        {
            $application[] = $ap;
        }

        // $resultArray[] = $app;
        // $result[] = $ed_id;
        // $res = array_merge((array)$resultArray, (array)$result);

        // foreach($app as $ap)
        // {
        //     $application[] = $ap;
        // }
        // foreach($ed_id as $ap)
        // {
        //     $b[] = $ap;
        // }
        // $MergeArr = array_merge($a,$b);

        

        if(!$ed_id->isEmpty()) {
            foreach($ed_id as $ed)
            {
                $education[] = $ed;
            }
            $MergeArray = array_merge($application,$education);
            return response()->json([
                'status' => 200,
                'data' => $MergeArray,
            ]);
        }
        else if(!$m_id->isEmpty()) {
            foreach($m_id as $m)
            {
                $marriage[] = $m;
            }
            $MergeArray = array_merge($application,$marriage);
            return response()->json([
                'status' => 200,
                'data' => $MergeArray,
            ]);
        }
        else if(!$trt_id->isEmpty()) {
            foreach($trt_id as $trt)
            {
                $treatment[] = $trt;
            }
            $MergeArray = array_merge($application,$treatment);
            return response()->json([
                'status' => 200,
                'data' => $MergeArray,
            ]);
        }
        else if(!$ho_id->isEmpty()) {
            foreach($ho_id as $ho)
            {
                $housing[] = $ho;
            }
            $MergeArray = array_merge($application,$housing);
            return response()->json([
                'status' => 200,
                'data' => $MergeArray,
            ]);
        }
      
        return response()->json([
            'status' => 404,
            'message' => 'Applicant Not Found'
        ]);
    }

    public function slide() {
        $slides = Slide::get()->all();

        // foreach($slides as $slide)
        // {
        //     $image[] = asset('public/slides/' . $slide->file);   
        // }
        
        return response()->json([
            'status' => 200,
            'data' => $slides,
        ]);
    }

    public function videos()
    {
        $data = Video::get()->all();
    
        foreach($data as $file)
        {
            $values[] = explode(',', $file->file_path);
        }
      
        $MergeArray = array_merge($data,$values);
  
        return response()->json([
            'status' => 200,
            'data' => $MergeArray
        ]);
    }
}

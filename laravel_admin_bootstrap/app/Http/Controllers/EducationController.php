<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;

class EducationController extends Controller
{
    public function education() {
        $applications = Education::latest()->paginate(25);
        return view('education.education', compact('applications'));
    }

    public function edit($id) {
        $data = Education::find($id);
        return view('education.edit_education', compact('data'));
    } 

    public function update(Request $request, Education $application) {
        $id = $request->id;
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'place' => 'required',
            'address' => 'required',
            'reason' => 'required',
            'amount' => 'required',
            'priority' => 'required'
        ]);
        $application->find($id)->update($request->all());
        return redirect()->route('education.view')->with('updated', 'Applicant updated successfully.');
    }

    public function show($id) {
        $data = Education::find($id);
        return view('education.detail_education', compact('data'));
    }

    public function accept(Request $request) {
        $accept_id = $request->id;
        $reject_id = $request->reject_id;
        $approve = $request->approve;
        $reject = $request->reason;
        if($approve) {
            Education::where('id', $accept_id)->update(array('status' => 'Approved','reason' => ''));
        }
        if($reject) {
            Education::where('id', $reject_id)->update(array('status' => 'Rejected','reason' => $reject));
        }
        return redirect()->route('education.view')->with('accept_reject', 'Applicant status updated successfully.');
    }

    public function destroy(Request $request, Education $application) {
        $id = $request->delete_id;
        $application->find($id)->delete();
        return redirect()->route('education.view')->with('delete', 'Applicant deleted successfully.');
    }

    public function search(Request $request) {
        $application_id = $request->id;
        $datas =  Education::where('application_id', $application_id)->get();
        return view('education.search', compact('datas'));
    }

    public function sort(Request $request) {
        $status = $request->status;
        if( $status === 'Pending') {
            $applications =  Education::where('status', $status)->get();
            // $applications = Education::latest()->paginate(1);
        }
        else if( $status === 'Approved') {
            $applications =  Education::where('status', $status)->get();
        }
        else if( $status === 'Rejected') {
            $applications =  Education::where('status', $status)->get();
        }
        else {
            $applications =  Education::where('priority', $status)->get();
        }
        return view('education.sort_status', compact('applications'));   
    }
}

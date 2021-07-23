<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marriage;

class MarriageController extends Controller
{
    public function marriage() {
        $applications = Marriage::latest()->paginate(25);
        return view('marriage.marriage', compact('applications'));
    }

    public function edit($id) {
        $data = Marriage::find($id);
        return view('marriage.edit_marriage', compact('data'));
    } 

    public function update(Request $request, Marriage $application) {
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
        return redirect()->route('marriage.view')->with('updated', 'Applicant updated successfully.');
    }

    public function show($id) {
        $data = Marriage::find($id);
        return view('marriage.detail_marriage', compact('data'));
    }

    public function accept(Request $request) {
        $accept_id = $request->id;
        $reject_id = $request->reject_id;
        $approve = $request->approve;
        $reject = $request->reason;
        if($approve) {
            Marriage::where('id', $accept_id)->update(array('status' => 'Approved','reason' => ''));
        }
        if($reject) {
            Marriage::where('id', $reject_id)->update(array('status' => 'Rejected','reason' => $reject));
        }
        return redirect()->route('marriage.view')->with('accept_reject', 'Applicant status updated successfully.');
    }

    public function destroy(Request $request, Marriage $application) {
        $id = $request->delete_id;
        $application->find($id)->delete();
        return redirect()->route('marriage.view')->with('delete', 'Applicant deleted successfully.');
    }

    public function search(Request $request) {
        $application_id = $request->id;
        $datas =  Marriage::where('application_id', $application_id)->get();
        return view('marriage.search', compact('datas'));
    }

    public function sort(Request $request) {
        $status = $request->status;
        if( $status === 'Pending') {
            $applications =  Marriage::where('status', $status)->get();
        }
        else if( $status === 'Approved') {
            $applications =  Marriage::where('status', $status)->get();
        }
        else if( $status === 'Rejected') {
            $applications =  Marriage::where('status', $status)->get();
        }
        else {
            $applications =  Marriage::where('priority', $status)->get();
        }
        return view('marriage.sort_status', compact('applications'));   
    }
}

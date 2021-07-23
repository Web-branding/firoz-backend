<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Other;

class OtherController extends Controller
{
    public function other() {
        $applications = Other::latest()->paginate(25);
        return view('other.other', compact('applications'));
    }

    public function edit($id) {
        $data = Other::find($id);
        return view('other.edit_other', compact('data'));
    } 

    public function update(Request $request, Other $application) {
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
        return redirect()->route('other.view')->with('updated', 'Applicant updated successfully.');
    }

    public function show($id) {
        $data = Other::find($id);
        return view('other.detail_other', compact('data'));
    }

    public function accept(Request $request) {
        $accept_id = $request->id;
        $reject_id = $request->reject_id;
        $approve = $request->approve;
        $reject = $request->reason;
        if($approve) {
            Other::where('id', $accept_id)->update(array('status' => 'Approved','reason' => ''));
        }
        if($reject) {
            Other::where('id', $reject_id)->update(array('status' => 'Rejected','reason' => $reject));
        }
        return redirect()->route('other.view')->with('accept_reject', 'Applicant status updated successfully.');
    }

    public function destroy(Request $request, Other $application) {
        $id = $request->delete_id;
        $application->find($id)->delete();
        return redirect()->route('other.view')->with('delete', 'Applicant deleted successfully.');
    }

    public function search(Request $request) {
        $application_id = $request->id;
        $datas =  Other::where('application_id', $application_id)->get();
        return view('other.search', compact('datas'));
    }

    public function sort(Request $request) {
        $status = $request->status;
        if( $status === 'Pending') {
            $applications =  Other::where('status', $status)->get();
        }
        else if( $status === 'Approved') {
            $applications =  Other::where('status', $status)->get();
        }
        else if( $status === 'Rejected') {
            $applications =  Other::where('status', $status)->get();
        }
        else {
            $applications =  Other::where('priority', $status)->get();
        }
        return view('other.sort_status', compact('applications'));   
    }
}

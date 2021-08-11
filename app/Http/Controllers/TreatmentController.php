<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;

class TreatmentController extends Controller
{
    public function treatment() {
        $applications = Treatment::latest()->paginate(25);
        return view('treatment.treatment', compact('applications'));
    }

    public function edit($id) {
        $data = Treatment::find($id);
        return view('treatment.edit_treatment', compact('data'));
    } 

    public function update(Request $request, Treatment $application) {
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
        return redirect()->route('treatment.view')->with('updated', 'Applicant updated successfully.');
    }

    public function show($id) {
        $data = Treatment::find($id);
        return view('treatment.detail_treatment', compact('data'));
    }

    public function accept(Request $request) {
        $accept_id = $request->id;
        $reject_id = $request->reject_id;
        $approve = $request->approve;
        $reject = $request->reason;
        if($approve) {
            Treatment::where('id', $accept_id)->update(array('status' => 'Approved','reason' => ''));
        }
        if($reject) {
            Treatment::where('id', $reject_id)->update(array('status' => 'Rejected','reason' => $reject));
        }
        return redirect()->route('treatment.view')->with('accept_reject', 'Applicant status updated successfully.');
    }

    public function destroy(Request $request, Treatment $application) {
        $id = $request->delete_id;
        $application->find($id)->delete();
        return redirect()->route('treatment.view')->with('delete', 'Applicant deleted successfully.');
    }

    public function search(Request $request) {
        $application_id = $request->id;
        $datas =  Treatment::where('application_id', $application_id)->get();
        return view('treatment.search', compact('datas'));
    }

    public function sort(Request $request) {
        $status = $request->status;
        if( $status === 'Pending') {
            $applications =  Treatment::where('status', $status)->get();
        }
        else if( $status === 'Approved') {
            $applications =  Treatment::where('status', $status)->get();
        }
        else if( $status === 'Rejected') {
            $applications =  Treatment::where('status', $status)->get();
        }
        else {
            $applications =  Treatment::where('priority', $status)->get();
        }
        return view('treatment.sort_status', compact('applications'));   
    }
}

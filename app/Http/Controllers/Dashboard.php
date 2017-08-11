<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use DB;
// Models
use App\Cases;
use App\CaseApply;
use App\ChatBox;
// Events
use App\Events\userLoggedIn;


class Dashboard extends Controller
{
    public function getDashboard(){
    	if (Auth::check()) {            
    		if(session('userType') == "Client"){
                $userId = session('userId');
                $Cases = Cases::where('userId',$userId)->get();
                // Common Data ------------------
                $UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
                // ------------------------------
    			return view('Pages.Vidhikarya.Client.Dashboard', compact('Cases','UnreadMessagegs'));
    		}
    		elseif (session('userType') == "Lawyer") {

                event(new userLoggedIn(Auth::id()));

                $userId = session("userId");

                // Common Data ------------------
                $UnreadMessagegs = ChatBox::where('receiverId',$userId)->where('hasRead',0)->get();
                // ------------------------------

                $OpenCases = Cases::
                            leftJoin('CaseApply','Cases.id','=','CaseApply.caseId')
                            ->where('Cases.caseStatus','Open')
                            ->latest()->get(['Cases.id','Cases.created_at','Cases.userId','Cases.caseTitle','Cases.caseCategory','Cases.caseDueDate','Cases.caseDescription','isOnlyAdvisable','attachmentPrivacy','postAsAnonymous','displayId','caseStatus','CaseApply.lawyerId']);
                $AppliedCases = DB::table('caseApply')->where('lawyerId',$userId)->where('status','Applied')->join('Cases','Cases.id','=','CaseApply.caseId')->get();
                $ApprovedCases = DB::table('caseApply')->where('lawyerId',$userId)->where('status','Approved')->join('Cases','Cases.id', '=', 'CaseApply.caseId')->get();
                $ActiveCases = DB::table('caseApply')->where('lawyerId',$userId)->where('status','Active')->join('Cases','Cases.id', '=', 'CaseApply.caseId')->get();
                $ClosedCases = DB::table('caseApply')->where('lawyerId',$userId)->where('status','Closed')->join('Cases','Cases.id', '=', 'CaseApply.caseId')->get();
                return view('Pages.Vidhikarya.Lawyer.Dashboard', compact('OpenCases','AppliedCases','ApprovedCases','ActiveCases','ClosedCases','UnreadMessagegs'));
    		}
    		elseif (session('userType') == "Admin") {
                return view('Pages.Vidhikarya.Admin.Dashboard');    			
    		}
    		elseif (session('userType') == "Org") {
                return view('Pages.Vidhikarya.Organization.Dashboard');    			
    		}
    	}
    }
}
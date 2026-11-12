<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function showContact()
    {
        if (view()->exists('contact')) {
            return view('contact');
        }
        return response('Contact page coming up in Task 7', 200);
    }

    public function storeStrategyCall(Request $request)
    {
        return response()->json(['success' => true, 'message' => 'Brief Received.']);
    }

    public function showCreators()
    {
        if (view()->exists('creators')) {
            return view('creators');
        }
        return response('Creators page coming up in Task 7', 200);
    }

    public function storeCreatorApplication(Request $request)
    {
        return response()->json(['success' => true, 'message' => 'Application Received.']);
    }
}

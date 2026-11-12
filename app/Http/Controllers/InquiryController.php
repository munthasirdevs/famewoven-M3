<?php

namespace App\Http\Controllers;

use App\Models\StrategyCall;
use App\Models\CreatorApplication;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function showContact()
    {
        return view('contact');
    }

    public function storeStrategyCall(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'goal' => 'required|string|max:255',
            'budget' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        $call = StrategyCall::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Brief Received.',
                'ticket' => 'FW-STRATEGY-' . now()->year . '-' . str_pad((string)$call->id, 4, '0', STR_PAD_LEFT),
            ]);
        }

        return redirect()->route('contact')->with('success', 'Brief Received.');
    }

    public function showCreators()
    {
        return view('creators');
    }

    public function storeCreatorApplication(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'platform' => 'required|string|max:50',
            'handle' => 'required|string|max:255',
            'niche' => 'required|string|max:100',
            'audience_size' => 'required|string|max:100',
            'email' => 'required|email|max:255',
        ]);

        $application = CreatorApplication::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Application Received.',
                'application_id' => $application->id,
            ]);
        }

        return redirect()->route('creators')->with('success', 'Application Received.');
    }
}

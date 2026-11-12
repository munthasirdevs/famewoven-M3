<?php

namespace App\Http\Controllers;

use App\Models\StrategyCall;
use App\Models\CreatorApplication;
use App\Services\ActivityLogger;
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

        ActivityLogger::log(
            'inquiry.strategy_call',
            "New Strategy Call request from {$call->name} ({$call->company_name})",
            [
                'id' => $call->id,
                'name' => $call->name,
                'company' => $call->company_name,
                'email' => $call->email,
                'budget' => $call->budget,
                'goal' => $call->goal,
            ]
        );

        $ticket = 'FW-STRATEGY-' . now()->year . '-' . str_pad((string)$call->id, 4, '0', STR_PAD_LEFT);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Brief Received.',
                'ticket' => $ticket,
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

        ActivityLogger::log(
            'inquiry.creator_application',
            "New Creator Application from {$application->name} (@{$application->handle})",
            [
                'id' => $application->id,
                'name' => $application->name,
                'platform' => $application->platform,
                'handle' => $application->handle,
                'niche' => $application->niche,
                'audience_size' => $application->audience_size,
            ]
        );

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

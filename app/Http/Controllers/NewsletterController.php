<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Handle incoming newsletter subscription.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $subscription = NewsletterSubscription::updateOrCreate(
            ['email' => strtolower(trim($validated['email']))],
            [
                'ip_address' => $request->ip(),
                'status' => NewsletterSubscription::STATUS_SUBSCRIBED,
            ]
        );

        ActivityLogger::log(
            'inquiry.newsletter',
            "New subscriber added to Famewoven Insights: {$subscription->email}",
            ['email' => $subscription->email, 'id' => $subscription->id]
        );

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully subscribed to Famewoven Insights.',
            ]);
        }

        return back()->with('newsletter_success', 'Successfully subscribed to Famewoven Insights.');
    }
}

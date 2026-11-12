<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $query = NewsletterSubscription::latest();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . trim($request->search) . '%');
        }

        $subscribers = $query->paginate(20)->withQueryString();

        $counts = [
            'all' => NewsletterSubscription::count(),
            'subscribed' => NewsletterSubscription::where('status', 'subscribed')->count(),
            'unsubscribed' => NewsletterSubscription::where('status', 'unsubscribed')->count(),
        ];

        return view('admin.subscribers.index', compact('subscribers', 'counts'));
    }

    public function toggle(NewsletterSubscription $subscriber)
    {
        $newStatus = $subscriber->status === 'subscribed' ? 'unsubscribed' : 'subscribed';
        $subscriber->update(['status' => $newStatus]);

        ActivityLogger::log(
            'admin.subscriber_toggle',
            "Toggled newsletter subscriber {$subscriber->email} to {$newStatus}",
            ['id' => $subscriber->id, 'email' => $subscriber->email, 'status' => $newStatus]
        );

        return back()->with('success', "Subscriber {$subscriber->email} marked as {$newStatus}.");
    }

    public function destroy(NewsletterSubscription $subscriber)
    {
        $email = $subscriber->email;
        $subscriber->delete();

        ActivityLogger::log('admin.subscriber_delete', "Deleted subscriber {$email}");

        return back()->with('success', "Subscriber {$email} removed.");
    }

    public function export()
    {
        $subscribers = NewsletterSubscription::latest()->get();

        $csvHeader = ['ID', 'Email', 'Status', 'IP Address', 'Subscribed At'];
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $csvHeader);

        foreach ($subscribers as $s) {
            fputcsv($handle, [
                $s->id,
                $s->email,
                $s->status,
                $s->ip_address,
                $s->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        ActivityLogger::log('admin.export_subscribers', 'Exported Newsletter Subscribers CSV');

        return response($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="famewoven-subscribers-' . date('Ymd-His') . '.csv"',
        ]);
    }
}

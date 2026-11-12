<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrategyCall;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class StrategyCallController extends Controller
{
    public function index(Request $request)
    {
        $query = StrategyCall::latest();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $calls = $query->paginate(15)->withQueryString();

        $counts = [
            'all' => StrategyCall::count(),
            'pending' => StrategyCall::where('status', 'pending')->count(),
            'reviewed' => StrategyCall::where('status', 'reviewed')->count(),
            'contacted' => StrategyCall::where('status', 'contacted')->count(),
            'closed' => StrategyCall::where('status', 'closed')->count(),
        ];

        return view('admin.strategy-calls.index', compact('calls', 'counts'));
    }

    public function show(StrategyCall $strategyCall)
    {
        return view('admin.strategy-calls.show', compact('strategyCall'));
    }

    public function update(Request $request, StrategyCall $strategyCall)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,reviewed,contacted,closed',
            'notes' => 'nullable|string',
        ]);

        $oldStatus = $strategyCall->status;
        $strategyCall->update($validated);

        ActivityLogger::log(
            'admin.strategy_call_update',
            "Updated Strategy Call #{$strategyCall->id} ({$strategyCall->company_name}) status from '{$oldStatus}' to '{$strategyCall->status}'",
            [
                'id' => $strategyCall->id,
                'old_status' => $oldStatus,
                'new_status' => $strategyCall->status,
            ]
        );

        return back()->with('success', "Strategy Call #{$strategyCall->id} updated successfully.");
    }

    public function export()
    {
        $calls = StrategyCall::latest()->get();

        $csvHeader = ['ID', 'Name', 'Company', 'Email', 'Phone', 'Goal', 'Budget', 'Status', 'Notes', 'Submitted At'];
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $csvHeader);

        foreach ($calls as $call) {
            fputcsv($handle, [
                $call->id,
                $call->name,
                $call->company_name,
                $call->email,
                $call->phone,
                $call->goal,
                $call->budget,
                $call->status,
                $call->notes,
                $call->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        ActivityLogger::log('admin.export_strategy_calls', 'Exported Strategy Calls CSV');

        return response($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="famewoven-strategy-calls-' . date('Ymd-His') . '.csv"',
        ]);
    }
}

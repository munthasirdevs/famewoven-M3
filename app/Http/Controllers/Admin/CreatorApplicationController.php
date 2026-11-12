<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreatorApplication;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class CreatorApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = CreatorApplication::latest();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('niche') && $request->niche !== 'all') {
            $query->where('niche', $request->niche);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('handle', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $creators = $query->paginate(15)->withQueryString();

        $counts = [
            'all' => CreatorApplication::count(),
            'pending' => CreatorApplication::where('status', 'pending')->count(),
            'accepted' => CreatorApplication::where('status', 'accepted')->count(),
            'rejected' => CreatorApplication::where('status', 'rejected')->count(),
            'active' => CreatorApplication::where('status', 'active')->count(),
        ];

        return view('admin.creators.index', compact('creators', 'counts'));
    }

    public function show(CreatorApplication $creator)
    {
        return view('admin.creators.show', compact('creator'));
    }

    public function update(Request $request, CreatorApplication $creator)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,accepted,rejected,active',
            'notes' => 'nullable|string',
        ]);

        $oldStatus = $creator->status;
        $creator->update($validated);

        ActivityLogger::log(
            'admin.creator_update',
            "Updated Creator Application #{$creator->id} (@{$creator->handle}) status from '{$oldStatus}' to '{$creator->status}'",
            [
                'id' => $creator->id,
                'handle' => $creator->handle,
                'old_status' => $oldStatus,
                'new_status' => $creator->status,
            ]
        );

        return back()->with('success', "Creator application for @{$creator->handle} updated successfully.");
    }

    public function export()
    {
        $creators = CreatorApplication::latest()->get();

        $csvHeader = ['ID', 'Name', 'Platform', 'Handle', 'Niche', 'Audience Size', 'Email', 'Status', 'Notes', 'Submitted At'];
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $csvHeader);

        foreach ($creators as $c) {
            fputcsv($handle, [
                $c->id,
                $c->name,
                $c->platform,
                $c->handle,
                $c->niche,
                $c->audience_size,
                $c->email,
                $c->status,
                $c->notes,
                $c->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        ActivityLogger::log('admin.export_creators', 'Exported Creator Network CSV');

        return response($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="famewoven-creators-' . date('Ymd-His') . '.csv"',
        ]);
    }
}

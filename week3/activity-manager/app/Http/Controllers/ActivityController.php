<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Services\ActivityService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request): View
    {
        $categories = \App\Models\Category::all();

        $activities = Activity::query()
            ->with('category')
            ->when($request->search, fn($q, $search) =>
                $q->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
                })
            )
            ->when($request->category_id, fn($q, $id) =>
                $q->where('category_id', $id)
            )
            ->when($request->status, fn($q, $status) =>
                $q->where('status', $status)
            )
            ->when($request->sort === 'terlama',
                fn($q) => $q->orderBy('start_at', 'asc'),
                fn($q) => $q->orderBy('start_at', 'desc')
            )
            ->paginate(10)
            ->withQueryString();

        return view('activities.index', compact('activities', 'categories'));
    }

    public function create(): View
    {
        $categories = \App\Models\Category::all();
        return view('activities.create', compact('categories'));
    }

    public function store(
        StoreActivityRequest $request,
        ActivityService $service
    ): RedirectResponse {
        $service->create($request->validated());

        return to_route('activities.index')
            ->with('success', 'Kegiatan berhasil dibuat.');
    }

    public function show(Activity $activity): View
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        $categories = \App\Models\Category::all();
        return view('activities.edit', compact('activity', 'categories'));
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity,
        ActivityService $service
    ): RedirectResponse {
        try {
            $service->update($activity, $request->validated());
        } catch (DomainException $e) {
            return back()
                ->withErrors(['status' => $e->getMessage()])
                ->withInput();
        }

        return to_route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();

        return to_route('activities.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function trashed(): View
    {
        $activities = Activity::onlyTrashed()
            ->with('category')
            ->latest('deleted_at')
            ->paginate(10);

        return view('activities.trashed', compact('activities'));
    }

    public function restore(Activity $activity): RedirectResponse
    {
        $activity->restore();

        return to_route('activities.index')
            ->with('success', 'Kegiatan berhasil dipulihkan.');
    }
}

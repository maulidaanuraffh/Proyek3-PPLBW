<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Services\RegistrationService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function create(Activity $activity): View
    {
        return view('registrations.create', compact('activity'));
    }

    public function store(
        Request $request,
        Activity $activity,
        RegistrationService $service
    ): RedirectResponse {
        $request->validate([
            'participant_name' => ['required', 'string', 'max:150'],
            'email'            => ['required', 'email', 'max:150'],
        ]);

        try {
            $service->register($activity, $request->only('participant_name', 'email'));
        } catch (DomainException $e) {
            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        }

        return to_route('activities.show', $activity)
            ->with('success', 'Pendaftaran berhasil.');
    }
}

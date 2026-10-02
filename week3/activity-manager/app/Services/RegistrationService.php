<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Registration;
use DomainException;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    public function register(Activity $activity, array $data): Registration
    {
        // BR-10A: hanya activity published
        if ($activity->status !== 'published') {
            throw new DomainException(
                'Pendaftaran hanya dapat dilakukan untuk kegiatan yang sudah dipublikasikan.'
            );
        }

        // BR-10B: kegiatan belum dimulai
        if ($activity->start_at <= now()) {
            throw new DomainException(
                'Pendaftaran sudah ditutup karena kegiatan telah dimulai.'
            );
        }

        // BR-10C: email belum terdaftar
        $sudahDaftar = $activity->registrations()
            ->where('email', $data['email'])
            ->exists();

        if ($sudahDaftar) {
            throw new DomainException(
                'Email ini sudah terdaftar pada kegiatan yang sama.'
            );
        }

        // BR-10D: kapasitas tersedia
        if ($activity->registered_count >= $activity->capacity) {
            throw new DomainException(
                'Pendaftaran ditutup karena kapasitas sudah penuh.'
            );
        }

        // Transaction: Registration + increment harus berhasil bersama
        return DB::transaction(function () use ($activity, $data) {
            $registration = $activity->registrations()->create([
                'participant_name' => $data['participant_name'],
                'email'            => $data['email'],
                'registered_at'    => now(),
            ]);

            $activity->increment('registered_count');

            return $registration;
        });
    }
}
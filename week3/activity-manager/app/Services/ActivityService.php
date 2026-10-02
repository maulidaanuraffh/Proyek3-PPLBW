<?php

namespace App\Services;

use App\Models\Activity;
use DomainException;

class ActivityService
{
    // Matriks transisi yang diizinkan:
    // key = status saat ini, value = daftar status yang boleh dituju
    private const TRANSITIONS = [
        'Planned' => ['Planned', 'Ongoing'],
        'Ongoing' => ['Ongoing', 'Done'],
        'Done'    => ['Done'],
    ];

    public function create(array $data): Activity
    {
        return Activity::create($data);
    }

    public function update(Activity $activity, array $data): Activity
    {
        $nextStatus = $data['status'] ?? $activity->status;

        $this->ensureValidTransition($activity->status, $nextStatus);

        $activity->update($data);

        return $activity->refresh();
    }

    public function publish(Activity $activity): Activity
    {
        if ($activity->status !== 'draft') {
            throw new \DomainException(
                'Hanya kegiatan berstatus draft yang dapat dipublikasikan.'
            );
        }

        $requiredFields = ['category_id', 'code', 'title', 'location', 'start_at', 'end_at', 'capacity'];
        foreach ($requiredFields as $field) {
            if (empty($activity->$field)) {
                throw new \DomainException(
                    "Field {$field} wajib diisi sebelum kegiatan dapat dipublikasikan."
                );
            }
        }

        $activity->update(['status' => 'published']);
        return $activity->refresh();
    }

    public function complete(Activity $activity): Activity
    {
        if ($activity->status !== 'published') {
            throw new \DomainException(
                'Hanya kegiatan berstatus published yang dapat diselesaikan.'
            );
        }

        $activity->update(['status' => 'completed']);
        return $activity->refresh();
    }

    private function ensureValidTransition(string $current, string $next): void
    {
        $allowed = self::TRANSITIONS[$current] ?? [];

        if (! in_array($next, $allowed, true)) {
            throw new DomainException(
                "Transisi status dari {$current} ke {$next} tidak diizinkan."
            );
        }
    }
}
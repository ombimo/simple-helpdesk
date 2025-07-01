<?php

namespace App\Services;

use App\Models\Ticket;
use Carbon\Carbon;

class TicketService
{
    public function generateTicketNumber(string $categoryPrefix, string $periode): string
    {
        $periodePrefix = Carbon::parse($periode)->format('ym');
        $prefix = "{$categoryPrefix}-{$periodePrefix}-";
        $maxNumber = Ticket::query()
            ->where('no', 'like', "{$prefix}%")
            ->where('periode', $periode)
            ->max('no');

        $nextNumber = $maxNumber ? (int) substr($maxNumber, strlen($prefix)) + 1 : 1;

        return "{$prefix}{$nextNumber}";
    }
}

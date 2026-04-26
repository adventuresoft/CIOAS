<?php
namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Models\CertificateType;

trait SystemIdGenerator
{
    public static function generateSystemId($table)
    {
        // $date = now()->format('Ymd');
        $date = now()->format('ymd');

        // Get certificate type
        $type = CertificateType::where('table_name', $table)->first();

        if (!$type) {
            throw new \Exception("Certificate type not found!");
        }

        $code = $type->code;

        // Count today + type
        $count = DB::table($table)
            ->whereDate('created_at', now()->toDateString())
            ->where('system_id', 'like', $date . $code . '%')
            ->count() + 1;

        $serial = str_pad($count, 3, '0', STR_PAD_LEFT);

        return $date . $code . $serial;
    }
}
<?php

namespace App\Models\BasicSettings;

use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use App\Models\Union;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'villages';
    protected $fillable = ['division_id', 'district_id', 'thana_id', 'union_id', 'en_name', 'bn_name', 'slug', 'status', 'created_by', 'updated_by'];


    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class, 'thana_id', 'id');
    }

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id', 'id');
    }

}

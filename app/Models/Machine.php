<?php
// app/Models/Machine.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Machine extends Model
{
    use LogsActivity;

    protected $fillable = [
        'floor_id', 'production_line_id', 'name', 'asset_code',
        'brand', 'model_no', 'purchase_date', 'purchase_price', 'status',
    ];
    protected $casts = ['purchase_date' => 'date', 'purchase_price' => 'decimal:2'];

    public function floor() { return $this->belongsTo(Floor::class); }
    public function productionLine() { return $this->belongsTo(ProductionLine::class); }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnlyDirty()->useLogName('machine');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_ops',
        'calidad',
        'operation_id',
        'customer_id',
        'operation_sub_type_id',
        'warehouse_id',
        'statu_id',
        'user_id',
        'concentrate_id',
        'tonnage',
        'staff_amount',
        'date_start',
        'date_start_operation',
        'observations'
    ];

    /**
     * Relación 1 a 1
     * Obtenga la operacion asociado a un servicio
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function operation()
    {
        return $this->belongsTo(Operation::class,'operation_id');
    }

    /**
     * Relación 1 a 1
     * Obtenga la operation_sub_type asociado a un servicio
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operationSubType()
    {
        return $this->belongsTo(Operation::class,'operation_sub_type');
    }

    /**
     * Relación 1 a 1
     * Obtenga WoreHouse (Deposito) asociado a un servicio
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wareHouse()
    {
        return $this->belongsTo(WareHouse::class,'warehouse_id');
    }

    /**
     * Relación 1 a 1
     * Obtenga Concentrate (Concentrado) asociado a un servicio
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function concentraded()
    {
        return $this->belongsTo(Concentrate::class,'concentrated_id');
    }

    public function statu(){

        return $this->belongsTo(Statu::class,'statu_id');

    }


    public function scopeSearchWarehouse($query,$wareHouse)
    {
        if ($wareHouse <> 0 ){
            $query->where('services.warehouse_id','=', $wareHouse );
        }

    }

}

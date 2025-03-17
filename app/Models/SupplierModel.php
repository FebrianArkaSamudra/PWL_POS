<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupplierModel extends Model
{
    use HasFactory;

    protected $table = 'm_supplier'; // Explicitly define the correct table name
    protected $primaryKey = 'supplier_id'; // Define the primary key

    public $timestamps = false; // Jika tidak ada timestamps (created_at, updated_at)

    protected $fillable = ['supplier_id', 'nama_supplier', 'email','telepon','alamat']; // Pastikan kolom bisa diisi

    public function users(): HasMany
    {
        return $this->hasMany(UserModel::class, 'supplier_id', 'supplier_id');
    }
}
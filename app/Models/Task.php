<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = "task";
    protected $fillable = ['name', 'deadline', 'status', 'description'];

    //mendefinisakan data tugas 
    // protected static $tasks = [
    //     [
    //         'id' => 1,
    //         'name' => 'Bahasa Inggris',
    //         'deadline' => '2024-11-29',
    //         'status' => 'Belum Selesai',
    //         'description' => 'Belajar Bahasa Inggris di buku lks di halaman 1-30',
    //     ], [
    //         'id' => 2,
    //         'name' => 'Matematika',
    //         'deadline' => '2024-10-29',
    //         'status' => 'Belum Selesai',
    //         'description' => 'Belajar Bahasa Matematika di buku lks di halaman 31-50',
    //     ], [
    //         'id' => 3,
    //         'name' => 'IPA',
    //         'deadline' => '2024-09-29',
    //         'status' => 'Belum Selesai',
    //         'description' => 'Belajar Bahasa IPA di buku lks di halaman 51-70',
    //         ], [
    //             'id' => 4,
    //             'name' => 'Bahasa Indonesia',       
    //             'deadline' => '2024-06-29',
    //             'status' => 'Belum Selesai',
    //             'description' => 'Belajar Bahasa Indonesia di buku lks di halaman 71-90',
    //             ], [
    //                 'id' => 5,
    //                 'name' => 'Agama',
    //                 'deadline' => '2024-07-29',
    //                 'status' => 'Belum Selesai',
    //                 'description' => 'Belajar Bahasa Agama di buku lks di halaman 91-100',
    //             ], [
    //                 'id' => 6,
    //                 'name' => 'Pendidikan Kewarganegaraan',
    //                 'deadline' => '2024-05-29',
    //                 'status' => 'Belum Selesai',
    //                 'description' => 'Belajar Bahasa Pendidikan Kewarganegaraan di buku lks di halaman 101-200',
    //                 ], [
    //                     'id' => 7,
    //                     'name' => 'Seni Budaya',
    //                     'deadline' => '2024-04-29',
    //                     'status' => 'Belum Selesai',
    //                     'description' => 'Belajar Bahasa Seni Budaya di buku lks di halaman 201-300',
    //                     ], [
    //                         'id' => 8,
    //                         'name' => 'Pendidikan Jasmani',
    //                         'deadline' => '2024-03-29',
    //                         'status' => 'Belum Selesai',
    //                         'description' => 'Belajar Bahasa Pendidikan Jasmani di buku lks di halaman 301-400',
    //                         ], [
    //                             'id' => 9,
    //                             'name' => 'Pendidikan Kimia',
    //                             'deadline' => '2024-02-29',
    //                             'status' => 'Belum Selesai',
    //                             'description' => 'Belajar kimia di buku lks di halaman 401-500',
    //             ]
    // ];

    // //method untuk mendapatkan semua data tugas
    // public static function getAll(){
    //     return self::$tasks;
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailKK;
use App\Models\Student;
use App\Models\RoomClass;
use App\Models\Major;



class Tunggakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'student_id',
        'class_id',
        'status',
        'total'
    ];
    protected $table = "tunggakans";

    public function getNameStudent($id)
    {
        // return DetailKK::find($id)->name;
        $student = Student::find($id);
        return DetailKK::find($student->kkdetail_id)->name;
    }
    public function getNameParent($id)
    {
        $student = Parents::find($id);
        return DetailKK::find($student->kkdetail_id)->name;
    }
    public function getClassStudent($id)
    {
        $class = RoomClass::find($id);
        return $class->classes . ' ' . $class->name;
    }
    public function getMajorName($id)
    {
        $class = RoomClass::find($id)->major_id;
        return Major::find($class)->name;
    }
    public function getEmailParent($id)
    {
        return Parents::find($id)->email;
    }
    public function getEmailStudent($id)
    {
        return Student::find($id)->email;
    }
}

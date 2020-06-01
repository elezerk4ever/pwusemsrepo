<?php

namespace App\Imports;

use App\Grade;
use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class GradesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
        protected $_year = null;
        protected $_semester = null;
        protected $_code = null;
        protected $_description = null;
        protected $_unit = null;
        protected $_is_ojt = null;
    public function __construct($year,$semester,$code,$description,$unit,$is_ojt){
        $this->_year = strtoupper($year);
        $this->_semester = strtoupper($semester);
        $this->_code = strtoupper($code);
        $this->_description = strtoupper($description);
        $this->_unit = $unit;
        $this->_is_ojt = $is_ojt;
    }
    public function model(array $row)
    {
        if(!isset($row['grade'])) return null;
        $student = Student::where(['idnumber'=>$row['id'],'firstname'=>strtoupper($row['firstname']),'lastname'=>strtoupper($row['lastname'])])->first();
        if(!$student) return null;
        return new Grade([
            'year'=>$this->_year,
            'semester'=>$this->_semester,
            'code'=>$this->_code,
            'description'=>$this->_description,
            'unit'=>$this->_unit,
            'is_ojt'=>$this->_is_ojt ?? false,
            'grade'=>$row['grade'],
            'student_id'=>$student->id
        ]);
    }
}

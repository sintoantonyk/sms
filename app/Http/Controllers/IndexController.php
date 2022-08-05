<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndexModel;
use App\Models\MarkModel;

class IndexController extends Controller
{
   public function index(Request $request){
        $segment = $request->segment(1);
        $all_students = IndexModel::all();
        return view('view_students')->with(['all_students' => $all_students,"segment"=>$segment]);
   }

   public function addStudent(Request $request){
        $segment = $request->segment(1);
        $all_teachers = $this->getTeachers();
        $all_genders = $this->getGender();
        return view('add_student')->with(['all_teachers' => $all_teachers,'all_genders'=>$all_genders,"segment"=>$segment]);
   }


   public function saveStudent(Request $request){
    $this->validate($request,[
        '_token' => 'required',
        'name' => 'required',
        'age' => 'required',
        'gender' => 'required',
        'teacher' => 'required',
    ]);

    IndexModel::create($request->all());

    return redirect()->back()->with(['msg' => __('New Student Added...'),'type' => 'success']);
   }


   public function editStudent(Request $request,$id){
    $segment = $request->segment(1);
    $data = IndexModel::find($id);
    $all_teachers = $this->getTeachers();
    $all_genders = $this->getGender();
    return view('edit_student')->with(['all_teachers' => $all_teachers,"segment"=>$segment,
    'all_genders'=>$all_genders,
    "data"=>$data]);

    }

    public function updateStudent(Request $request,$id){
        $this->validate($request,[
            '_token' => 'required',
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'teacher' => 'required',
        ]);

        IndexModel::where('id', $id)->update([
            'name' =>  $request->name,
            'age' =>  $request->age,
            'gender' => $request->gender,
            'teacher' => $request->teacher
        ]);
        return redirect()->back()->with(['msg' => __('Student Updated...'),'type' => 'success']);
    }


   public function deleteStudent(Request $request){
    IndexModel::find($request->id)->delete();
   }



   public function viewStudentMark(Request $request){
    $segment = $request->segment(1);
        $all_student_mark = MarkModel::all();
        return view('view_students_mark')->with(['all_student_mark' => $all_student_mark,"segment"=>$segment]);
   }

   public function addStudentMark(Request $request){
    $segment = $request->segment(1);
        $all_students = IndexModel::all();
        $all_terms = $this->terms();
        return view('add_student_mark')->with(['all_terms' => $all_terms,
        'all_students'=>$all_students,"segment"=>$segment
    ]);
   }


   public function saveStudentMark(Request $request){
    $this->validate($request,[
        '_token' => 'required',
        'student_id' => 'required',
        'term' => 'required',
        'maths_mark' => 'required',
        'science_mark' => 'required',
        'history_mark' => 'required',
    ]);

    $prev_combination =MarkModel::where(['student_id' => $request->student_id, 'term' => $request->term])->first();
    if(!empty($prev_combination)){
        return redirect()->back()->with(['msg' => __('This student marks already added under '.$request->term.' term...'),'type' => 'danger']);
    }else{
        $total_mark  = $request->maths_mark + $request->science_mark + $request->history_mark;
    MarkModel::create([
        'student_id' =>  $request->student_id,
        'term' =>  $request->term,
        'maths_mark' => $request->maths_mark,
        'science_mark' => $request->science_mark,
        'history_mark' => $request->history_mark,
        'total_mark' => $total_mark,
    ]);

    return redirect()->back()->with(['msg' => __('Mark Added...'),'type' => 'success']);
    }


   }


   public function editStudentMark(Request $request,$id){
    $segment = $request->segment(1);
    $data = MarkModel::find($id);
    $all_students = IndexModel::all();
    $all_terms = $this->terms();

    return view('edit_student_mark')->with(['all_students' => $all_students,
    'all_terms'=>$all_terms,
    "data"=>$data,"segment"=>$segment]);

    }

    public function updateStudentMark(Request $request,$id){
        $this->validate($request,[
            '_token' => 'required',
            'student_id' => 'required',
            'term' => 'required',
            'maths_mark' => 'required',
            'science_mark' => 'required',
            'history_mark' => 'required',
        ]);

        $prev_combination = MarkModel::where(['student_id' => $request->student_id, 'term' => $request->term])->where('id', '!=' , $id)->first();

        if(!empty($prev_combination)){

            return redirect()->back()->with(['msg' => __('This student marks already added under '.$request->term.' term...'),'type' => 'danger']);
        }else{

            $total_mark  = $request->maths_mark + $request->science_mark + $request->history_mark;
            MarkModel::where('id', $id)->update([
                'student_id' =>  $request->student_id,
                'term' =>  $request->term,
                'maths_mark' => $request->maths_mark,
                'science_mark' => $request->science_mark,
                'history_mark' => $request->history_mark,
                'total_mark' => $total_mark,
            ]);
            return redirect()->back()->with(['msg' => __('Mark Updated...'),'type' => 'success']);
        }



    }


   public function deleteStudentMark(Request $request){
    MarkModel::find($request->id)->delete();
   }

   public static function getTeachers(){
    return array("nisha"=>"Nisha","leena"=>"Leena","meenu"=>"Meenu");

   }

   public static function getGender(){
    return array("male"=>"Male","female"=>"Female","others"=>"Others");

   }

   public static function terms(){
    return array("first"=>"First","second"=>"Second","third"=>"Third");

   }
}

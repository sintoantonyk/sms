@extends('master')
@section('site-title')
    {{__('Student Management System')}}
@endsection
@section('content')
<x-headnav segment="{{$segment}}"></x-headnav>
<h1>Edit Mark</h1>
<div class="container">
<form  action="{{route('update.student.mark',$data->id)}}" method="POST">
    @csrf
    <div class="form-group">
      <label  for="student_id">Student Name:</label>
      <select name="student_id" class="form-control" required>
        <option value="">Select a Student</option>
        @if(count($all_students)>0)
            @foreach($all_students as $s_key=>$student)
                <option value="{{$student->id}}" @if($data->student_id==$student->id){{"selected";}}@endif>{{ucwords($student->name)}}</option>
            @endforeach
        @endif
      </select>
    </div>
    <div class="form-group">
      <label  for="term">Term:</label>
      <select name="term" class="form-control" required>
        <option value="">Select a Term</option>
        @if(count($all_terms)>0)
            @foreach($all_terms as $t_key=>$term)
                <option value="{{$t_key}}" @if($data->term==$t_key){{"selected";}}@endif>{{ucwords($term)}}</option>
            @endforeach
        @endif
      </select>
    </div>

  <div class="form-group">
    <label  for="maths_mark">Maths Mark:</label>
    <input type="number" class="form-control" min="0" id="maths_mark" name="maths_mark" required value="{{$data->maths_mark}}">
  </div>
  <div class="form-group">
    <label  for="science_mark">Science Mark:</label>
    <input type="number" class="form-control" min="0" id="science_mark" name="science_mark" required  value="{{$data->science_mark}}">
  </div>
  <div class="form-group">
    <label  for="history_mark">History Mark:</label>
    <input type="number" class="form-control" min="0" id="history_mark" name="history_mark" required   value="{{$data->history_mark}}">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
@endsection

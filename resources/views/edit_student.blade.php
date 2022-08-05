@extends('master')
@section('site-title')
    {{__('Student Management System')}}
@endsection
@section('content')
<x-headnav segment="{{$segment}}"></x-headnav>
<h1>Edit Student - {{ucwords($data->name)}}</h1>
<div class="container">
<form  action="{{route('update.student',$data->id)}}" method="POST">
    @csrf
    <div class="form-group">
      <label  for="name">Student Name</label>
      <input type="text" class="form-control" id="name" name="name" required value="{{$data->name}}">
    </div>
    <div class="form-group">
      <label  for="age">Age:</label>
      <input type="number" class="form-control" id="age" name="age" required value="{{$data->age}}">
    </div>
    <div class="form-group">
      <label  for="gender">Gender:</label>
      <select name="gender" class="form-control" required>
        <option value="">Select a Gender</option>
        @if(count($all_genders)>0)
            @foreach($all_genders as $g_key=>$gender)
                <option value="{{$g_key}}" @if($data->gender==$g_key){{"selected";}}@endif>{{ucwords($gender)}}</option>
            @endforeach
        @endif
      </select>
    </div>
    <div class="form-group">
      <label for="teacher">Reporting Teacher:</label>
      <select name="teacher" class="form-control" required>
        <option value="">Select a Teacher</option>
        @if(count($all_teachers)>0)
            @foreach($all_teachers as $tkey=>$teacher)
                <option value="{{$tkey}}" @if($data->teacher==$tkey){{"selected";}}@endif>{{ucwords($teacher)}}</option>
            @endforeach
        @endif
      </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
@endsection

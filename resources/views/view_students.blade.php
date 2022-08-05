@extends('master')
@section('site-title')
    {{__('Student Management System')}}
@endsection
@section('style')
<style>
    table.GeneratedTable {
      width: 100%;
      background-color: #ffffff;
      border-collapse: collapse;
      border-width: 2px;
      border-color: #141414;
      border-style: solid;
      color: #faf4f4;
    }

    table.GeneratedTable td, table.GeneratedTable th {
      border-width: 2px;
      border-color: #141414;
      border-style: solid;
      padding: 3px;
    }

    table.GeneratedTable thead {
      background-color: #1a1a19;
    }
    table.GeneratedTable tbody tr{
      background-color: #5c5757;

    }
</style>
@endsection
@section('content')
<x-headnav segment="{{$segment}}"></x-headnav>
<h1>View Students</h1>
    @if(count($all_students)>0)
    <table class="GeneratedTable">
      <thead>
        <tr>
          <th>SINo</th>
          <th>Name</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Reporting Teacher</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php
            $i=1;
        @endphp
        @foreach($all_students as $data)
        @php
            $all_teachers = App\Http\Controllers\indexController::getTeachers();
            $all_genders = App\Http\Controllers\indexController::getGender();
        @endphp
        <tr>
            <td>{{$i}}</td>
            <td>{{ucwords($data->name)}}</td>
            <td>{{$data->age}}</td>
            <td>{{ucwords($all_genders[$data->gender])}}</td>
            <td>{{ucwords($all_teachers[$data->teacher])}}</td>
            <td><a href="{{route('edit.student',$data->id)}}">Edit</a>/ <a href="javascript:void(0)"
                 data-id="{{$data->id}}" class="sa_delete">Delete</a></td>
          </tr>
          @php
            $i++;
        @endphp
        @endforeach
    </tbody>
</table>
@else
    {{"No Data Found";}}
@endif
@endsection
@section('script')
<script>
    $("body").on("click",".sa_delete",function(){
            if (confirm('Are You Sure Remove This Item')) {
                var id = $(this).attr("data-id");
                $.ajax({
                    'type' : "POST",
                    'url' : "{{route('delete.student')}}",
                    'data' : {
                        _token: "{{csrf_token()}}",
                        id: id
                    },
                    success:function (data) {
                        location.reload();
                    }
                });
            }
    });
</script>
@endsection

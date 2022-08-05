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
<h1>View Student Marks</h1>
    @if(count($all_student_mark)>0)
    <table class="GeneratedTable">
      <thead>
        <tr>
          <th>SINo</th>
          <th>Student Name</th>
          <th>Term</th>
          <th>Maths</th>
          <th>Science</th>
          <th>History</th>
          <th>Total Mark</th>
          <th>Created On</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php
            $i=1;
        @endphp
        @foreach($all_student_mark as $data)
        @php
        $student_data = DB::table('students')->where('id', $data->student_id)->first();
       @endphp
        <tr>
            <td>{{$i}}</td>
            <td>{{ucwords($student_data->name)}}</td>
            <td>{{ucwords($data->term)}}</td>
            <td>{{$data->maths_mark}}</td>
            <td>{{$data->science_mark}}</td>
            <td>{{$data->history_mark}}</td>
            <td>{{$data->total_mark}}</td>
            <td>{{date("M d,Y h:i A", strtotime($data->created_at))}}</td>
            <td><a href="{{route('edit.student.mark',$data->id)}}">Edit</a>/ <a href="javascript:void(0)"
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
                    'url' : "{{route('delete.student.mark')}}",
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

<div class="topnav">
    <a class="@if($segment=="add-student"){{"active"}}@endif" href="{{route('add.student')}}">Add Student</a>
    <a class="@if($segment=="" || $segment=="home"){{"active"}}@endif" href="{{url('/')}}">View Students</a>
    <a class="@if($segment=="add-student-mark"){{"active"}}@endif" href="{{route('add.student.mark')}}">Add Student Mark</a>
    <a class="@if($segment=="view-student-mark"){{"active"}}@endif" href="{{route('view.student.mark')}}">View Students Mark</a>
</div>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
 @endif
 @if(session()->has('msg'))
    <div class="alert alert-{{session('type')}}">
        {!! session('msg') !!}
    </div>
@endif

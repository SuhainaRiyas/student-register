@extends('layouts.dashboard')

@section('title')
<title>Add Student</title>
@endsecton

@section('content')

<div class="user  mt-5">

@if (isset($student))
<form method="post" action="{{ route('students.update', $student->id) }}">
    @method('PUT')

@else   
<form role="form" method="post" action="{{ route('students.store') }}" enctype="multipart/form-data"> 
@endif         
            @csrf
                <div class="row">
                    <div class="col-md-6 col-xl-6">
                        <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" title="Please Enter Name." pattern="[0-9a-zA-Z]+{1,20}" id="name" value="{{$student->name ?? ''}}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-xl-6">
                        <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" title="Please Enter Email." id="email" value="{{$student->email ?? ''}}" required>
                        </div>
                    </div>
                   
                   
                    <div class="col-md-6 col-xl-6">
                        <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" pattern="[1-9]{1}[0-9]{9}" title="Please enter the 10 Digit." class="form-control" id="phone_no" value="{{$student->phone ?? ''}}" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-6">
                        <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" title="Please enter address." class="form-control" id="address" value="{{$student->address ?? '' }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-6">
                        <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" title="Please enter city." class="form-control" id="city" value="{{$student->city ?? '' }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-6">
                        <div class="form-group">
                        <label>State</label>
                        <input type="text" name="state" title="Please enter state." class="form-control" id="state" value="{{$student->state ?? '' }}" required>
                        </div>
                    </div>
                   
                   <div class="col-md-6 col-xl-6">
                        <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" title="Please enter counrty." class="form-control" id="country" value="{{$student->country ?? '' }}" required>
                        </div>
                    </div>

                   
                    <div class="col-md-12 col-xl-12  center-block text-center">
                        <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-times"> Cancel</i></a>
                        @if (isset($student))
                            <button type="submit" class="btn btn-success"><i class="ion ion-paper-airplane"> Update</i></button>
                        @else
                            <button type="submit" class="btn btn-success"><i class="ion ion-paper-airplane"> Save</i></button>
                        @endif
                    </div>
                </div>    
            </form>   
</div>   
@endsection

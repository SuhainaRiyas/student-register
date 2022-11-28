@extends('layouts.dashboard')

@section('title')
<title>View Student Record</title>
@endsecton

@section('content')

<div class="user  mt-5">
    <div class="row">
        <div class="col-md-12 col-xl-12 text-right mb-3">
                        <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-caret-left"> Back</i></a>                      
        </div>
    </div> 
    
    <div class="row">
        <div class="col-md-6">
                <table class="table table-bordered ">
               <tbody>
                    <tr>  
                        <td class="font-weight-bold">Name</td>                        
                        <td>{{$student->name }}</td>                       
                    </tr>
                    <tr>  
                        <td class="font-weight-bold">Email</td>                        
                        <td>{{$student->email }}</td>                       
                    </tr>
                    <tr>  
                        <td class="font-weight-bold">Phone No.</td>                        
                        <td>{{$student->phone }}</td>                       
                    </tr>
                    <tr>  
                        <td class="font-weight-bold">Address</td>                        
                        <td>{{$student->address }}</td>                       
                    </tr>
                    <tr>  
                        <td class="font-weight-bold">City</td>                        
                        <td>{{$student->city }}</td>                       
                    </tr>
                    <tr>  
                        <td class="font-weight-bold">State</td>                        
                        <td>{{$student->state }}</td>                       
                    </tr>
                    <tr>  
                        <td class="font-weight-bold">Country</td>                        
                        <td>{{$student->country }}</td>                       
                    </tr>
                    <tr class="font-weight-bold">
                        @if($student->status == 1)
                          <td class="text-success">Status</td>
                          <td class="text-success">Active</span>
                        @else
                          <td class="text-danger">Status</td>
                          <td class="text-danger">Inactive</span>                           
                        @endif
                        
                    </tr>
               </tbody>
            </table>
        </div>

        

        <div class="col-md-6">
            <table class="table table-bordered table-striped text-center">
               <thead>
                      <tr>
                         <th>Subjects</th>
                         <th>Marks</th>
                         <th>Grade</th>                     
                      </tr>
               </thead>
               <tbody>
                    @foreach($subjects as $data)
                        <tr>
                            <td>{{$data->subject_name }}</td>
                            <td>{{$data->marks }}</td>
                            <td>{{$data->grade }}</td>
                        </tr>
                    @endforeach
               </tbody>
            </table>
        </div>


    </div>
    
                                           
                
</div>   
@endsection

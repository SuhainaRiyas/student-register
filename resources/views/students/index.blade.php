@extends('layouts.dashboard')

@section('title')
<title>Students List</title>
@endsection

@section('link')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

@endsection

@section('content')

<div class="user  mt-5">
    <div class="d-flex align-items-center">
			<div class="mr-auto">
				<h4 class="page-title">Students List</h4>
			</div>
            <div class="row justify-content-end mb-3">
                <div class="col-auto">           
                    <a href="{{ asset('/students/create') }}"><span class="btn btn-info">Add Student</span></a>           
                </div>
            </div>
            <!-- <div class="alert alert-success">
            </div>
            <div class="alert alert-danger">
            </div> -->
    </div>

    <table class="table table-bordered text-center">
           <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Name</th>
                     <th>Email</th>                     
                     <th>Phone No</th>
                     <th>Address</th>
                     <th>City</th>
                     <th>State</th>
                     <th>Country</th>
                     <th>Subjects</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
           </thead>
           <tbody>
             <?php $sno = 1; ?>
               @foreach($students as $student)
                  <tr>
                     <td><?=$sno++; ?></td>
                     <td>{{ $student->name }}</td>
                     <td>{{ $student->email }}</td>
                     <td>{{ $student->phone }}</td>
                     <td>{{ $student->address }}</td>
                     <td>{{ $student->city }}</td>
                     <td>{{ $student->state }}</td>
                     <td>{{ $student->country }}</td>
                     <?php  
                        $subjects = App\Models\Subject::where('student_id',$student->id)->pluck('subject_name')->toArray();
                        $sub = implode(',',$subjects);
                     ?>
                     <td>{{$sub}}</td>
                     <td>
                        <input data-id="{{$student->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $student->status=='1' ? 'checked' : '' }}>
                     </td>
                     <td>
                        <a href="{{ route('addsubject',$student->id) }}" title="Add subjects" class="text-i"><span class="label label-primary mr-2 text-info"><i class="fa fa-plus-square"></i></span></a>
                         <a href="{{ route('students.show',$student->id) }}" title="View"><span class="label label-dark mr-2 text-dark"><i class="fa fa-eye"></i></span></a>
                         <a href="{{ route('students.edit',$student->id) }}" title="Edit"><span class="label label-info mr-2"><i class="fa fa-edit"></i></span></a> 
                         <a onclick="del('{{$student->id}}')" title="Delete"><span class="label label-warning text-danger"><i class="fa fa-trash"></i></span></a>
                     </td>
                  </tr>
               @endforeach
            </tbody>
    </table>
</div>


@endsection


@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
   $(document).ready( function () {
    });

   $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
         
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "PATCH",
            url: "{{ url('statuschange') }}",
            data: {'status': status, 'id': id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  
     function del(id){
    // Confirm alert start //
    // alert('ah');
    bootbox.confirm({
      message: "Are You Sure Want To Delete?",
    buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
      },
    callback: function (result) { 
     if(result){  
    $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
               type:'DELETE', 
               url:'{{ asset('/students/') }}/'+id,
               data:{id:id},
               success: function (data) {
                if(data == 'success'){ 
                    window.location.reload();
                }
                
               },
               error: function (data) {
                     alert(data);
               }
             });
     }else{
        return;
     }
    }
}); 
}

  </script>
@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('id','DESC')->get();
        return view('students.index',compact('students'));
    }

    public function statuschange(Request $request)
    {
        $student = Student::find($request->id);
        $student->status = $request->status;
        $student->save();
  
        return response()->json(['success'=>'Status changed successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data=$request->all();
        $data['status'] = 1;
        $student = Student::create($data);
        return redirect('students');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        $subjects = $student->subjects()->where('student_id', $id)->get();
        return view('students.view',compact('student','subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('students.create',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $student = Student::find($id);
        $student->fill($data)->save();
        return redirect('students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return 'success';
    }
    public function addsubject($id){
        $subjects = Subject::where('student_id',$id)->get();
        return view('students.addSubject',compact('subjects','id'));
    }

    public function subjectstore(Request $request){

          $oldsubjects = Subject::where('student_id',$request->student_id)->get();
           $oldsubjectid = $newsubjectid = array();
            foreach($oldsubjects as $data){
                array_push( $oldsubjectid,$data->id);
            }           
  
         if($request->input('moreFields')){
            foreach($request->input('moreFields') as $key => $value) {
                    if(isset($value['subject']) && isset($value['marks']) && isset($value['grade'])){   
                       if(isset($value['subject_id'])){                         
                                array_push($newsubjectid,$value['subject_id']);                            
                           
                         $subjects=Subject::where('id',$value['subject_id'])->first();
                         
                        
                            $subjects->update([                               
                                 'subject_name'=>$value['subject'],
                                 'marks'=>$value['marks'],
                                 'grade' => $value['grade'],
                             ]);
                            $error = 0;
                        }else{
                            Subject::create([
                                 'student_id' => $request->student_id,
                                 'subject_name'=>$value['subject'],
                                 'marks'=>$value['marks'],
                                 'grade' => $value['grade'],
                            ]);
                            $error = 0;
                        }
                    }else{
                        $error = 1;
                        $error_msg = 'All fields are mandotory. Please enter data';
                    }
            }
         }

         $rem = array_diff($oldsubjectid,$newsubjectid);
                            
             if(!empty($rem)){
                 foreach($rem as $value){
                     $subject=Subject::find($value);                                  
                     $subject->delete();
                 }                                
             }
        if($error){
            return $error_msg;
        }else{
            return 'success';
        }
        
    }
}

@extends('layouts.master')
@section('main-body')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2><i class="fa fa-plus"></i> EDIT USER</h2>        
    </div>
</div>        


 <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">    



        <div class="col-md-9 animated flash">
            @if(count($errors) > 0 )
                <div class="alert alert-danger alert-dismissible flash" role="alert">            
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
                    <center><h4>Oh snap! You got an error!</h4></center>   
                </div>
            @endif
        </div>   





        <div class="col-lg-4" >
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="background-color:#009688">
                    <h5 style="color:white"><i class="fa fa-plus"></i> Profile Picture</h5>
                </div>
                <div class="ibox-content">                    
              
              {!!Form::open(array('route'=>array('users.update',$user->id),'method'=>'PUT','files'=>true))!!}
                
                 
                    <div class="form-group " style="display: flex; justify-content: center;">
                        <?php $imgURL = (!$user->image ? 'default.jpg' : $user->image);?>         
                        @if(!empty($user->image))                                           
                        {!! Html::image('uploads/users/'.$user->employee_number.'/'.$imgURL,'',['style'=>'height:200px; width:240px; ']) !!}
                                                
                       @else                                          
                    <img src="{{asset('uploads/users/default.jpg')}}" class="zoom" style="width:240px; height:200px;"></img>
                        @endif  


                    </div>    
                           
                            
                    <div class="form-group">
                        <div id="dvPreview"></div></br>                 
                        {!!Form::label('Image','Upload Image')!!}   
                        <span>{{ Form::file('image', array('id' => 'fileupload','accept' => 'gif|jpg|png|jpeg|bmp')) }}</span>  
                    </div> 


                                          
                </div>                
             
            </div>
        </div>

        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="background-color:#009688">
                    <h5 style="color:white"><i class="fa fa-plus"></i> User info <small></small></h5>          
                </div> 
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">                            
                        	
                                
                                <div class="form-group">  
                                                                 
                                </div>      
								



                        <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                           
                                    {!!Form::label('first_name','First Name')!!}                        
                                    {!!Form::text('first_name',$user->first_name,['class'=>'form-control','placeholder'=>'Enter First Name'])!!}                                                
                                    @if ($errors->has('first_name')) <p class="help-block" style="color:red;">{{ $errors->first('first_name') }}</p> @endif
                                
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                    {!!Form::label('last_name','Last Name')!!}                        
                                    {!!Form::text('last_name',$user->last_name,['class'=>'form-control','placeholder'=>'Enter Last Name'])!!}                                               
                                    @if ($errors->has('last_name')) <p class="help-block" style="color:red;">{{ $errors->first('last_name') }}</p> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>






                        <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                    {!!Form::label('email','Email')!!}                        
                                    {!!Form::text('email',$user->email,['class'=>'form-control','placeholder'=>'Enter Email'])!!}                                    
                                    @if ($errors->has('email')) <p class="help-block" style="color:red;">{{ $errors->first('email') }}</p> @endif 
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                    {!!Form::label('username','Username')!!}                        
                                    {!!Form::text('username',$user->username,['class'=>'form-control','placeholder'=>'Enter Username','required'=>'required'])!!}
                                    @if ($errors->has('username')) <p class="help-block" style="color:red;">{{ $errors->first('username') }}</p> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>



                        <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                    {!!Form::label('empid','Employee Number')!!}                        
                                    {!!Form::text('empid',$user->empid,['class'=>'form-control','placeholder'=>'Enter Employee Number','required'=>'required'])!!}                
                                    @if ($errors->has('empid')) <p class="help-block" style="color:red;">{{ $errors->first('empid') }}</p> @endif    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                    {!!Form::label('position_id','Position')!!}                        
                                    {!!Form::select('position_id',$positions,$user->position_id,['class'=>'form-control','required'=>'required'])!!}    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                    {!!Form::label('dept_id','Industry')!!}                        
                                    {!!Form::select('dept_id[]',$departments,$myIndus,['class'=>'form-control','required'=>'required','multiple'=>'multiple','id'=>'industryID'])!!}
                                        </div>
                                    </div>
                                </div>
                            </div>

								<div class="form-group pull-right">
									{!! Html::decode(link_to_Route('users.index', '<i class="fa fa-arrow-left"></i> Cancel', [], ['class' => 'btn btn-default'])) !!}
									{!! Form::button('<i class="fa fa-save"></i> Submit', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
								</div>					
                        	{!! Form::close() !!}
                        </div>                        
                    </div>
                </div>                   
           






            </div>             	                        
        </div>              
    </div>    
</div>    
@stop
@section('page-script')

    $('#industryID').multiselect({
        maxHeight: 200,    
        includeSelectAllOption: true,
        enableCaseInsensitiveFiltering: true,
        enableFiltering: true,
        buttonWidth: '100%',
        buttonClass: 'form-control',
    });  
@endsection
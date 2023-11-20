@extends('layouts.master')
@section('main-body')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2><i class="fa fa-plus"></i> NEW USER</h2>        
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
        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-title"style="background-color:#009688">
                    <h5 style="color:white"><i class="fa fa-plus"></i> User Form <small></small></h5>          
                </div> 
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">                            
                            {!!Form::open(array('route'=>'users.store','method'=>'POST','files'=>true))!!}
                                <div class="form-group">  
                                    <div id="dvPreview"></div></br>                 
                                    {!!Form::label('Image','Upload Image')!!}   
                                    <span>{{ Form::file('image', array('id' => 'fileupload','accept' => 'gif|jpg|png|jpeg|bmp')) }}</span>                               
                                </div>      

                                <div class="form-group">
                                    {!!Form::label('empid','Employee Number')!!}                        
                                    {!!Form::text('empid','',['class'=>'form-control','placeholder'=>'Enter Employee Number','required'=>'required'])!!}                
                                    @if ($errors->has('empid')) <p class="help-block" style="color:red;">{{ $errors->first('empid') }}</p> @endif                               
                                </div> 
                                <div class="form-group">
                                    {!!Form::label('first_name','First Name')!!}                        
                                    {!!Form::text('first_name','',['class'=>'form-control','placeholder'=>'Enter First Name','required'=>'required'])!!}                                                
                                    @if ($errors->has('first_name')) <p class="help-block" style="color:red;">{{ $errors->first('first_name') }}</p> @endif
                                </div>      
                                <div class="form-group">
                                    {!!Form::label('last_name','Last Name')!!}                        
                                    {!!Form::text('last_name','',['class'=>'form-control','placeholder'=>'Enter Last Name','required'=>'required'])!!}                                               
                                    @if ($errors->has('last_name')) <p class="help-block" style="color:red;">{{ $errors->first('last_name') }}</p> @endif
                                </div>                                  
                                 
                                       <div class="form-group">
                                {!! Form::label('company','Company') !!}
                                {!! Form::select('company',$company,null,['class'=>'form-control','required'=>'required','onchange'=>'dcompany(this.value)'])!!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('branch_code','Branch') !!}
                                {!! Form::select('branch_code',$branches,null,['class'=>'form-control','required'=>'required']) !!} 
                            </div>                       
                                                                        
                                <div class="form-group">
                                    {!!Form::label('username','Username')!!}                        
                                    {!!Form::text('username','',['class'=>'form-control','placeholder'=>'Enter Username','required'=>'required'])!!}
                                    @if ($errors->has('username')) <p class="help-block" style="color:red;">{{ $errors->first('username') }}</p> @endif
                                </div>  
                                <div class="form-group">
                                    {!!Form::label('password','Password')!!}              
                                    <input type="password" name="password" class="form-control" placeholder="Enter Password" required=""></input>                      
                                    @if ($errors->has('password')) <p class="help-block" style="color:red;">{{ $errors->first('password') }}</p> @endif              
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

<script type="text/javascript">
    


    function dcompany(val) {
                                
                                var x = val;
                            
                                $.ajax({
                                    url: "{{Route('getbranches')}}",
                                    type:"POST",
                                    data:{deptid:x},
                                    success: function(data){
                                         $("#branch_code").empty();
                                         var len = data.length;
                                           if(len > 0){
                                                 for(var i=0; i<len; i++){
                                                     
                                                var id = data[i].company_code;
                                                var name = data[i].branch_name;
                                                
                                         var option = "<option value='"+id+"'>"+name+"</option>"; 
                                                     $("#branch_code").append(option);   
                                                     
                                                 }
                                               
                                           }
                                        
            
                                    }    
                                });
                                
                                }
    
</script>
@extends('layouts.master')
@section('main-body')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2><i class="fa fa-plus"></i> NEW MODULE</h2>
        <ol class="breadcrumb">
            <li><a href="index.html">Dashboard</a></li>            
            <li><a href="index.html">Module List</a></li>            
            <li class="active"><strong>Create</strong></li>
        </ol>
    </div>
</div>        
 <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-7 animated flash">
            @if(count($errors) > 0)
                <div class="alert alert-danger alert-dismissible flash" role="alert">            
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
                    <center><h4>Oh snap! You got an error!</h4></center>   
                </div>
            @endif
        </div>    
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title"style="background-color:#009688">
                    <h5 style="color:white"><i class="fa fa-plus"></i> Module Form <small></small></h5>          
                </div> 
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">                            
                            {!!Form::open(array('route'=>array('modules.update',$module->id),'method'=>'PUT'))!!}
                               
                            <div class="col-sm-12"> 
                                      
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                    {!!Form::label('module','New Module')!!}                        
                                    {!!Form::text('module',$module->module,['class'=>'form-control','placeholder'=>'Enter Name of Module'])!!}                                              
                                    @if ($errors->has('module')) <p class="help-block" style="color:red;">{{ $errors->first('module') }}</p> @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                    {!!Form::label('icon','Icon')!!}                        
                                    {!!Form::text('icon',$module->icon,['class'=>'form-control','placeholder'=>'Enter Icon of Module'])!!}                                               
                                    @if ($errors->has('icon')) <p class="help-block" style="color:red;">{{ $errors->first('icon') }}</p> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                    {!!Form::label('description','Description')!!}                        
                                    {!!Form::textarea('description',$module->description,['class'=>'form-control','placeholder'=>'Enter Module Descripiton'])!!}                                               
                                    @if ($errors->has('description')) <p class="help-block" style="color:red;">{{ $errors->first('description') }}</p> @endif
                                </div> 


                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                    {!!Form::label('routeUri','Route Name')!!}                        
                                    {!!Form::text('routeUri',$module->routeUri,['class'=>'form-control','placeholder'=>'Enter Name of Route'])!!}                                               
                                    @if ($errors->has('routeUri')) <p class="help-block" style="color:red;">{{ $errors->first('routeUri') }}</p> @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                    {!!Form::label('default_url','Default Url')!!}                        
                                    {!!Form::text('default_url',$module->default_url,['class'=>'form-control','placeholder'=>'Enter Default Url'])!!}                                               
                                    @if ($errors->has('default_url')) <p class="help-block" style="color:red;">{{ $errors->first('default_url') }}</p> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>





                                <div class="form-group pull-right">
                                    {!! Html::decode(link_to_Route('modules.index', '<i class="fa fa-arrow-left"></i> Cancel', [], ['class' => 'btn btn-default'])) !!}
                                    {!! Form::button('<i class="fa fa-save"></i> Update', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
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
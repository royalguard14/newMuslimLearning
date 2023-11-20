@extends('layouts.master')
@section('main-body')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2><i class="fa fa-users"></i> ACCESS OF {!! strtoupper($user->first_name.' '.$user->last_name) !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Dashboard</a>
            </li>                
            <li>
                <strong>Access Control</strong>
            </li>
            <li class="active">
                <strong>Manage</strong>
            </li>
        </ol>
    </div>
</div>        
<div class="wrapper wrapper-content animated fadeInRight">		
    <div class="row">
    	<div class="col-md-12 animated flash">
            @if(count($errors) > 0)
                <div class="alert alert-danger alert-dismissible flash" role="alert">            
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
                    <center><h4>Oh snap! You got an error!</h4></center>   
                    <center><h4>Select a module before you save!</h4></center>
                </div>
            @endif
        </div>    
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
	            <div class="ibox-title" style="background-color:#009688">
	                <h5 style="color:white"><i class="fa fa-users"></i> Modules List</h5>	                     
	            </div>
	            <div class="ibox-content">
	            	<div class="table-responsive">
		            	<table class="table table-striped table-hover" >
			            <thead>
				            <tr>				                
				            	<th></th>	
				                <th>#</th>
				                <th>Module</th>
				                <th>Description</th>				           						                		              
				            </tr>
			            </thead>
			            <tbody>
			            	{!! Form::open(array('route'=>'access_controls.store', 'method'=>'POST','enctype'=>'multipart/form-data')) !!}
					            @forelse($modules as $module)				           				           								
				           			<tr>
				           				@if(count($access_control) < 1)				           			
						           			<td><input type="checkbox" name="module_id[]" value="{!! $module->id !!}"></td>
						           			<td>{!! $module->id !!}</td>
						           			<td>{!! $module->module !!}</td>
						           			<td>{!! $module->description !!}</td>						           		
						           		@elseif(count($access_control) > 0)
						           			
					           				@if(in_array($module->id, $access_control))
						           				<td><input type="checkbox" name="module_id[]" value="{!! $module->id !!}" checked></td>							           			
						           			@else
						           				<td><input type="checkbox" name="module_id[]" value="{!! $module->id !!}"></td>							           			
						           			@endif						
						           			<td>{!! $module->id !!}</td>
						           			<td>{!! $module->module !!}</td>
						           			<td>{!! $module->description !!}</td>	           		
						           		@endif
					           			
					           		</tr>
					           	@empty
					           	@endforelse
					        
			            </tbody>			            
		            	</table>
		            </div>		            
		            <div class="ibox-footer">		         
		            	{!! Form::hidden('uid',$uid) !!}   	
						{!! Html::decode(link_to_Route('users.index', '<i class="fa fa-arrow-left"></i> Cancel', [], ['class' => 'btn btn-default'])) !!}
						{!! Form::button('<i class="fa fa-save"></i> Save', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}						
					</div>		
	            </div>	            
				{!! Form::close() !!}	
	        </div>
	    </div>	    
    </div>
</div>	
@stop
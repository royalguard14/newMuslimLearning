		@extends('layouts.master')
		@section('body')

	<div class="card card-tabs">
		<div class="card-header p-0 pt-1">
			<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="c_basic_info-tab" data-toggle="pill" href="#c_basic_info" role="tab" aria-controls="c_basic_info" aria-selected="true">Company</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="c_des_info-tab" data-toggle="pill" href="#c_des_info" role="tab" aria-controls="c_des_info" aria-selected="false">Information</a>
				</li>
				
			</ul>
		</div>
		<div class="card-body">
			<div class="tab-content" id="custom-tabs-one-tabContent">
				<div class="tab-pane fade show active" id="c_basic_info" role="tabpanel" aria-labelledby="c_basic_info-tab">
					 {!!Form::open(array('route'=>'users.store','method'=>'POST','files'=>true))!!}
					<div class="row">
						<div class="col-lg-12">

							<div class="form-group">
								{!! Form::label('company_name','Company Name') !!}
								{!! Form::text('company_name','',['class'=>'form-control','required'=>'required','placeholder'=>'Enter Company Name Here']) !!} 
							</div>   

						</div>

					</div>

					<div class="row">

						<div class="col-lg-6">


							<div class="form-group">
								{!! Form::label('company_address','Company Address') !!}
								{!! Form::textarea('company_address','',['class'=>'form-control','rows'=>'8','required'=>'required','placeholder'=>'Enter Company Address Here']) !!} 
							</div> 

						</div>


						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										{!! Form::label('company_contact','Company Contact') !!}
										{!! Form::text('company_contact','',['class'=>'form-control','required'=>'required','placeholder'=>'Enter Company Contact Here']) !!} 
									</div>   

								</div>
							</div>

							<div class="row">

								<div class="col-lg-12">

									<div class="form-group">
										{!! Form::label('dayswork','Work per Year') !!}
										{!! Form::number('dayswork','',['class'=>'form-control','required'=>'required','placeholder'=>'5days = 313']) !!} 
									</div> 

								</div>

							</div>
							<div class="row">
								<div class="col-lg-6">

									<div class="form-group">
										{!! Form::label('d_timein','Default Time In') !!}
										{!! Form::time('d_timein','',['class'=>'form-control','required'=>'required']) !!} 
									</div>   

								</div>
								<div class="col-lg-6">


									<div class="form-group">
										{!! Form::label('d_timeout','Default Time Out') !!}
										{!! Form::time('d_timeout','',['class'=>'form-control','required'=>'required']) !!} 
									</div>   				

								</div>
							</div>
						</div>
					</div>
				</div>



				<div class="tab-pane fade" id="c_des_info" role="tabpanel" aria-labelledby="c_des_info-tab">
					






					<div class="row">
                        <div class="col-sm-12">                            
                           
                               


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
                                    {!!Form::label('username','Username')!!}                        
                                    {!!Form::text('username','',['class'=>'form-control','placeholder'=>'Enter Username','required'=>'required'])!!}
                                    @if ($errors->has('username')) <p class="help-block" style="color:red;">{{ $errors->first('username') }}</p> @endif
                                </div> 

                                <div class="form-group">
                                    {!!Form::label('password','Password')!!}              
                                    <input type="password" name="password" class="form-control" placeholder="Enter Password" required>            
                                </div>



                        </div>                       
</div> 





				</div>
				<!-- End of tab2 --> 
			
				</div>
			</div>
			<!-- /.card -->
		</div>
		<!-- end of body na -->

		
                                <div class="form-group pull-right">
                                    {!! Html::decode(link_to_Route('users.index', '<i class="fa fa-arrow-left"></i> Cancel', [], ['class' => 'btn btn-default'])) !!}
                                    {!! Form::button('<i class="fa fa-save"></i> Submit', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
                                </div> 


                            {!! Form::close() !!}

		@section('page-script')
		$('.deptccs').multiselect({
			maxHeight: 200,    
			includeSelectAllOption: true,
			enableCaseInsensitiveFiltering: true,
			enableFiltering: true,
			buttonWidth: '100%',
			buttonClass: 'form-control',
		});  



		$('#industryID').multiselect({
			maxHeight: 200,    
			includeSelectAllOption: true,
			enableCaseInsensitiveFiltering: true,
			enableFiltering: true,
			buttonWidth: '100%',
			buttonClass: 'form-control',
		});  
		@endsection

@stop
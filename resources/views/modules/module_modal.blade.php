




<div class="modal fade" id="addModal">
  {!!Form::open(array('route'=>'modules.store','method'=>'POST'))!!}
  { csrf_field() }
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="titlehead">Create Module</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="ops()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row clearfix">
          <div class="col-md-6">
            <div class="form-group">
              <div class="form-line">
                {!!Form::label('module','Module')!!}                        
                {!!Form::text('module','',['class'=>'form-control','placeholder'=>'Enter Name of Module', 'id' => 'mods'])!!}                                               
                @if ($errors->has('module')) <p class="help-block" style="color:red;">{{ $errors->first('module') }}</p> @endif
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <div class="form-line">
               {!!Form::label('icon','Icon')!!}                        
               {!! Form::select('icon',$icons,'',['class'=>'form-control select2bs4','required'=>'required','placeholder'=>'Select Icon of the Module', 'id' =>'icons']) !!}                                             
               @if ($errors->has('icon')) <p class="help-block" style="color:red;">{{ $errors->first('icon') }}</p> @endif
             </div>
           </div>
         </div>
       </div>

       <div class="form-group">
        {!!Form::label('description','Description')!!}                        
        {!!Form::textarea('description','',['class'=>'form-control','placeholder'=>'Enter Module Descripiton','id' => 'desc'])!!}                                               
        @if ($errors->has('description')) <p class="help-block" style="color:red;">{{ $errors->first('description') }}</p> @endif
      </div>  

      <div class="row clearfix">
        <div class="col-md-6">
          <div class="form-group">
            <div class="form-line">
              {!!Form::label('routeUri','Route Name')!!}                        
              {!!Form::text('routeUri','',['class'=>'form-control','placeholder'=>'Enter Name of Route','id' => 'ruri'])!!}                                               
              @if ($errors->has('routeUri')) <p class="help-block" style="color:red;">{{ $errors->first('routeUri') }}</p> @endif
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <div class="form-line">
              {!!Form::label('default_url','Default Url')!!}                        
              {!!Form::text('default_url','',['class'=>'form-control','placeholder'=>'Enter Default Url','id' => 'durl'])!!}                                               
              @if ($errors->has('default_url')) <p class="help-block" style="color:red;">{{ $errors->first('default_url') }}</p> @endif
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer float-right">
        <input type="hidden" name="id" id="ids">
        {!! Form::button('<i class="fa fa-save"></i> Save', array('type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'action_button')) !!}
      </div>
    </div>
    <!-- /.modal-content -->
    {!! Form::close() !!}
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


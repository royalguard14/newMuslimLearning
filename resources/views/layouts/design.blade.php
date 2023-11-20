{--  <div class="modal fade" id="addtimein">
        <div class="modal-dialog">
          <div class="modal-content">
            {!! Form::open(array('route'=>'attendance.addtimein','method'=>'POST')) !!}
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                     <div class="form-group">
          {!! Form::label('employee_id','EMPLOYEE') !!}
          {!!Form::select('employee_id',$employee,null,['class'=>'form-control empccs','required'=>'required','placeholder'=>'Select Employee'])!!}  
        </div>  
        <div class="form-group">
          {!! Form::label('date','Date') !!}
          {!! Form::date('date','',['class'=>'form-control','required'=>'required']) !!} 
        </div>                    
        <div class="form-group">
          {!! Form::label('time_in','Time IN:') !!}
          {!! Form::time('time_in','',['class'=>'form-control','required'=>'required']) !!} 
        </div>    
        <div class="form-group">
          {!! Form::label('time_out','Time OUT:') !!}
          {!! Form::time('time_out','',['class'=>'form-control','required'=>'required']) !!} 
        </div> 
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
           {!!Form::close()!!}
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
 --}
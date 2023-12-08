<?php 
use App\Models\AccessControl;
use App\Models\Modules;

?>

<?php $routeUri = Route::currentRouteName();
?>
<?php $user = Auth::user(); ?> 
<?php 
$guard = Auth::user();
$role = DB::table('role')->Where('id',$guard->role)->first();
$ids = explode (",", $role->modules);
$modules = DB::table('modules')->whereIn('id',$ids)->get();

$accccc = [];
foreach ($ids as $id) {
 $accccc[]= $id;}
?>
<?php 


$fmng = [5,6];            
$fmngs = array_intersect($fmng, $accccc);

$fmng1 = [8];            
$fmngs1 = array_intersect($fmng1, $accccc);


$admn = [1,2,4];
$admns = array_intersect($admn, $accccc);



?> 



      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
      
                <li class="nav-item">
                <a href="{{url('dashboard')}}" class="nav-link  <?php echo ($routeUri=='dashboard.index') ? 'active' : '' ?>">
                <i class="nav-icon fa fa-dashboard fa-2x "></i>
                <p>Dashboard</p>
                </a>
                </li>





                 



                 @if(count($fmngs1) > 0)
                        <!-- Manage -->
             
                           <?php $filemngaccess = DB::table('modules')->whereIn('id',$fmngs1)->orderByRaw("field(id,".implode(',',$fmngs1).")")->get();
                           $manage=DB::table('modules')->whereIn('id',$fmngs1)->pluck('default_url');
                           ?>

                        <li class="nav-item" >
                          <a href="#" class="nav-link <?php echo (in_array($routeUri, json_decode($manage,true))) ? 'active' : '' ?> ">
                            <i class="nav-icon fa fa-folder"></i>
                              <p>Playlist</p>
                                 <i class="right fas fa-angle-left"></i>
                           </a>
                           
                        <ul class="nav nav-treeview">       
                            @foreach($filemngaccess as $row)  
                            <li class="nav-item {{ ( $routeUri == $row->routeUri) ? 'active' : ' ' }}" style="text-indent: 15px;">
                                <a href="{{url($row->routeUri)}}" class="nav-link">
                                  <i class="far fa-circle"></i>
                                  <p>{{$row->module}}  </p>
                                </a>
                              </li>                    
                          @endforeach

                            </ul>

                        </li>
                 @endif


                
                 @if(count($fmngs) > 0)
                        <!-- Manage -->
             
                           <?php $filemngaccess = DB::table('modules')->whereIn('id',$fmngs)->orderByRaw("field(id,".implode(',',$fmngs).")")->get();
                           $manage=DB::table('modules')->whereIn('id',$fmngs)->pluck('default_url');
                           ?>

                        <li class="nav-item" >
                          <a href="#" class="nav-link <?php echo (in_array($routeUri, json_decode($manage,true))) ? 'active' : '' ?> ">
                            <i class="nav-icon fa fa-film fa-2x"></i>
                              <p>Library</p>
                                 <i class="right fas fa-angle-left"></i>
                           </a>
                           
                        <ul class="nav nav-treeview">       
                            @foreach($filemngaccess as $row)  
                            <li class="nav-item {{ ( $routeUri == $row->routeUri) ? 'active' : ' ' }}" style="text-indent: 15px;">
                                <a href="{{url($row->routeUri)}}" class="nav-link">
                                  <i class="far fa-circle"></i>
                                  <p>{{$row->module}}  </p>
                                </a>
                              </li>                    
                          @endforeach

                            </ul>

                        </li>
                 @endif


                 @if(count($admns) > 0)
                 
                        <!-- Admin -->
             
                            <?php 
                            $fileadccess = DB::table('modules')->whereIn('id',$admns)->orderByRaw("field(id,".implode(',',$admns).")")->get(); 
                            $adminarray=DB::table('modules')->whereIn('id',$admns)->pluck('default_url');

                            ?>


                        <li class="nav-item  nav-sidebar  ">
                          <a href="#" class="nav-link <?php echo (in_array($routeUri, json_decode($adminarray,true))) ? 'active' : '' ?> ">
                            <i class="nav-icon fa fa-life-ring fa-2x"></i>
                              <p>Admin Tools</p>
                                 <i class="right fas fa-angle-left"></i>
                           </a>
                           
                        <ul class="nav nav-treeview">       
                            @foreach($fileadccess as $row)  
                            <li class="nav-item" style="text-indent: 15px;">
                                <a href="{{url($row->routeUri)}}" class="nav-link <?php echo ($routeUri==$row->default_url) ? 'active' : '' ?>">
                                  <i class="far fa-circle"></i>
                                  <p>{{$row->module}}  </p>
                                </a>
                              </li>                    
                          @endforeach
                            </ul>
                        </li>
             
                 @endif



        </ul>
      </nav>
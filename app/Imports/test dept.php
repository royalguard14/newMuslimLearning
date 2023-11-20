$guard=DB::table('branches')->where('company_code','0002')->where('branch_arc',$row['branch'])->first();

            if($guard == null){
                \Log::channel('error_found')->info('No Branch '.$row['branch'].' found (Dept Job)');
            }else{

               $deptguard=DB::table('departments')->where('Company_code','0002')->where('Branch_code',$guard->branch_code)->where('department',$row['departmentdivision'])->first();
                    if($deptguard == null){

                         \Log::channel('error_found')->info('No Dept in  '.$row['branch'].'-'.$row['departmentdivision']);

                    }else{

                         $postguard=DB::table('positions')->where('company_code','0002')->where('branch_code',$deptguard->Branch_code)->where('department_id',$deptguard->id)->where('position',$row['position'])->first();

                            if($postguard == null){

                                \Log::channel('error_found')->info('No position in  '.$row['branch'].'-'.$row['departmentdivision'].'-'.$row['position']);

                            }else{

                                \Log::channel('error_found')->info('all set in  '.$row['branch'].'-'.$row['departmentdivision'].'-'.$row['position']);

                            }

                         
                    }


            }

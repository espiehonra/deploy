@extends('customlayouts.design')

@section('content')
  
<style>
        #overlay {
            position: fixed;
            display: none;
            width: 20%;
            height: 20%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 2;
            cursor: pointer;
        }
        
        #text{
            position: absolute;
            top: 50%;
            left: 50%;
            font-size: 10px;
            color: white;
            transform: translate(-50%,-50%);
            -ms-transform: translate(-50%,-50%);
        }
        </style><div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Users</h1>
    </div>
</div>
                <!-- /.row -->
 <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">List of Employees{{ $message }} <button type="button" class="btn btn-success" id="btnSaveUsers" style="float:right;margin-top:-7px;display:none;"><i class='fa fa-floppy-o'> &nbsp;Save All</i></button></div>
                            <!-- /.panel-heading -->
                <div class="panel-body"> 
                        <div id="overlay">
                            <div id="text">Overlay Text</div>
                            </div>
                        </div>
                                                @if(count($employees)>0)
                        <table width="100%" class="table table-bordered table-hover" id="dataTables-users">
                            <thead>
                                <tr>
                                    <th style="width:50px">Employee No.</th>
                                    <th>First Name</th>
                                    <th>Surname</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Region</th>
                                    <th style="width:50px">Account Status</th>
                                    <th style="width:130px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <?php if($employee->isDeactivated ==0){ $stat="Activated";} else { $stat="Deactivated";} ?>
                                    <tr class="odd gradeX">
                                        <td>{{ $employee->empno }}</td>
                                        <td><span id="fnameSpan_{{ $employee->id}}" class="fnameSpan">{{ ucfirst($employee->firstname ) }} </span>
                                            <input type="text"  class="form-control" value="{{ $employee->firstname}}" id="fnameInp_{{ $employee->id}}" name="fnameInp_{{ $employee->id}}" style="width:100%;display:none"/>
                                        </td>
                                        <td><span id="snameSpan_{{ $employee->id}}">{{ ucfirst($employee->surname ) }} </span>
                                            <input type="text" class="form-control"  value="{{ $employee->surname}}" id="snameInp_{{ $employee->id}}" name="snameInp_{{ $employee->id}}" style="width:100%;display:none"/>
                                        </td>
                                        <td class="center"><span id="posiSpan_{{ $employee->id}}"> {{ $employee->positionName }} </span>
                                            <select class="form-control" id="posiSel_{{ $employee->id}}" style="display:none">
                                                <option disabled selected> Select...</option>
                                                @foreach($positions as $position)
                                                    <option value="{{ $position->id }}">{{ $position->positionName }}</option>
                                                @endforeach
                                            </select>
                                        <td class="center"><span id="deptSpan_{{ $employee->id}}">{{ $employee->deptName }} </span>
                                            <select class="form-control" id="deptSel_{{ $employee->id}}" style="display:none">
                                                <option disabled selected> Select...</option>
                                                    @foreach($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->deptName }}</option>
                                                    @endforeach
                                            </select>
                                        </td>
                                        <td class="center"><span id="regionSpan_{{ $employee->id}}">{{ $employee->regionName }} </span>
                                            <select class="form-control" id="regionSel_{{ $employee->id}}" style="display:none">
                                                <option disabled selected> Select...</option>
                                                @foreach($regions as $region)
                                                    <option value="{{ $region->id }}">{{ $region->regionName }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="center">{{ $stat }}</td>
                                        <td class="center">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <a href='#' title="Edit" class="editIcon" data-id="{{ $employee->id }}"  data-tablename="employees" id="editIcon{{ $employee->id }}"><i class='fa fa-edit fa-fw' style='color:orange;'></i></a>&nbsp;&nbsp;
                                                    </td>
                                                    <td>
                                                        <a href='#' title="Cancel Edit" class="cancelIcon" data-id="{{ $employee->id }}"  data-tablename="employees" id="cancelIcon{{ $employee->id }}" style="display:none;text-decoration:none;margin-right:10px;"><i class='fa fa-edit fa-fw' style='color:orange'></i><span style="color:red;margin-left:-22px;font-weight:bold">X</span></a>&nbsp;&nbsp;
                                                    </td>
                                                    <td>
                                                        @if($employee->isDeactivated ==0)
                                                            <button type="button" class="btn btn-outline btn-danger activateBtn" data-type="1" data-id="{{ $employee->id }}"><i class='fa fa-times'> &nbsp;Deactivate</i></button>
                                                        @else
                                                            <button type="button" class="btn btn-outline btn-success activateBtn" data-type="0" data-id="{{ $employee->id }}"><i class='fa fa-plus'> &nbsp;Activate</i></button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="hiddenEmpno" value="{{ $empno }}"/>
<input type="hidden" id="hiddenPass" value="{{ $password }}"/>
<input type="hidden" id="userIdClicked" value=""/>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
    
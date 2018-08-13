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
                <div class="panel-body"> {{csrf_field()}}
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
                                    <th style="width:50px">Action</th>
                                </tr>
                            </thead>
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

@endsection
    
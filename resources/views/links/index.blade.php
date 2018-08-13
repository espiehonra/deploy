@extends('customlayouts.design')

@section('content')
  <style type="text/ccs">
    table.table-hover tbody tr td:hover { background-color: #fb9692!important; }
    .trcolor{ background-color:#ebdea0; }
    .trcolorOrig{ background-color:#fff; }

    </style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Links</h1>
    </div>
</div>
                <!-- /.row -->
 <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">                
                @if($userLevel==1)
                    <p><a id="fnClickAddRow">Click to add a new row</a></p>
                    @if(count($links)==0) <?php $style="block"; ?> @else  <?php $style="none"; ?>  @endif
            <button type="button" class="btn btn-success" style="float:right;margin-top:-30px;display:{{ $style }}" id="saveAllBtn">Save All</button></div>
                @endif
                <!-- /.panel-heading -->
                <div class="panel-body"> 
                    <table width="100%" class="table table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th style="width:35%">Link</th>
                                <th style="width:25%">Link Title</th>
                                <th style="width:25%">Link Description</th>
                                <th style="width:15%">Date Added</th>
                                @if($userLevel==1)
                                    <th style="width:50px;">Actions</th>  
                                @endif
                            </tr>
                        </thead>     
                        <tbody>
                            @if(count($links)>0) <?php $counter=1;?>
                                @foreach($links as $link) <?php $date=$link->dAdded;?>
                                    <tr id="tr_{{ $link->id}}" style="line-height:20px;">
                                        <td>
                                            <a href="{{ $link->link}}" onclick="window.open(this.href,'newwindow','width=800,height=550');return false;" id="link_{{ $link->id}}">{{ $link->link}}</a>
                                            <input type="text"  class="form-control" value="{{ $link->link}}" id="linkInp_{{ $link->id}}" name="linkInp_{{ $link->id}}" style="width:100%;display:none"/>
                                        </td>
                                        <td>
                                            <a href="{{ $link->link}}" onclick="window.open(this.href,'newwindow','width=800,height=550');return false;" id="vLinkTitle_{{ $link->id}}">{{ $link->vLinkTitle }}</a>
                                            <input type="text"  class="form-control" value="{{ $link->vLinkTitle}}" id="vLinkTitleInp_{{ $link->id}}" name="vLinkTitleInp_{{ $link->id}}" style="width:100%;display:none"/>
                                        </td>
                                        <td>
                                            <a href="{{ $link->link}}" onclick="window.open(this.href,'newwindow','width=800,height=550');return false;" id="vLinkDescription_{{ $link->id}}">{{ $link->vLinkDescription }}</a>
                                            <input type="text"  class="form-control" value="{{ $link->vLinkDescription}}" id="vLinkDescriptionInp_{{ $link->id}}"  name="vLinkDescriptionInp_{{ $link->id}}" style="width:100%;display:none"/>
                                        </td>
                                        <td class="center">
                                            <a href="{{ $link->link}}" onclick="window.open(this.href,'newwindow','width=800,height=550');return false;">{{ $date }}</a></td>
                                        @if($userLevel==1)
                                            <td><a href='#' title="Delete" class="deleteRowData" data-id="{{ $link->id}}" data-tablename="links"><i class='fa fa-trash-o fa-fw' style='color:red'></i></a>&nbsp;&nbsp;&nbsp;
                                                <a href='#' title="Edit" class="editIcon" data-id="{{ $link->id }}"  data-tablename="links" id="editIcon{{ $link->id }}"><i class='fa fa-edit fa-fw' style='color:orange'></i></a>
                                                <a href='#' title="Edit" class="cancelIcon" data-id="{{ $link->id }}"  data-tablename="links" id="cancelIcon{{ $link->id }}" style="display:none;text-decoration:none;margin-right:10px;"><i class='fa fa-edit fa-fw' style='color:orange'></i><span style="color:red;margin-left:-22px;font-weight:bold">X</span></a>
                                            </td>
                                        @endif
                                        </tr>
                                    <?php $counter++; ?>
                                @endforeach
                    @else
                        <tr>
                            <td><input type='text'  class="form-control"  name='link[]' style='width:100%'/></td>
                            <td><input type='text'  class="form-control"  name='linkTitle[]' style='width:100%'/></td>
                            <td><input type='text'  class="form-control"  name='linkDescription[]' style='width:100%'/></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                @if($userLevel==1)
                    <div class="panel-body" style="display:none" id="panelbottomMsg">
                    </div> 
                @endif           
            </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="{{$empno}}" id="empnohidden"/>
<input type="hidden" value="0" id="idcollhidden"/>
@endsection
    
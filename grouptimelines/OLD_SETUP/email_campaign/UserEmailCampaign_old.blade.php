@extends('layouts.app')
@section('title','Add new user | Optimus')

@section('content')
 <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
        rel="stylesheet" type="text/css" />
<div class="wrapper">
    @include('components.navigation')
    @include('components.sidebar')

    <div id="settingspage"></div>

    <div class="content-wrapper">
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border" align="center">
                            <h3 class="box-title"><i class="fa fa-user-plus"></i> User List</h3>
                            <div class="alldelete">
                                <form action="{{url('/campaign/user')}}" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo Auth::user()->id; ?>" >
                                </form>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Create Campaign User Group</button>
                            </div>
                            <div class="clearfix"></div>
                            @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{!! \Session::get('success') !!}</p>
                            </div>
                            @endif
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="text-center">Name</th>
                                  <th class="text-center">Email</th>
                                  <th class="text-center">Mobile No</th>
                                  <th class="text-center">City</th>
                                  <th class="text-center">Gender</th>
                                  <th class="text-center">Action</th>
                              </tr>
                          </thead>
                          <tbody>

                            @if($campaigns)
                            @foreach($campaigns as $campaign)
                            <tr>
                                <td class="text-center">{{$campaign->name}}</td>
                                <td class="text-center">{{$campaign->email}}</td>
                                <td class="text-center">{{$campaign->mobile_no}}</td>
                                <td class="text-center">{{$campaign->city}}</td>
                                <td class="text-center">{{$campaign->gender}}</td>
                                <td class="text-center">
                                    <a title="Delete" data-toggle="tooltip" onclick="if(!confirm('Want to delete this record?')) return false; else deleteRecord({{$campaign->id}}); " href="javascript:void(0)" title=""><i class="fa fa-trash"></i></a>    
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create User Group</h4>
        </div>
        <div class="modal-body">
            <h5 class="modal-title">Select Group</h5>
          <select name="group" id="group" class="form-control">
                    <option selected="selected"></option>
                    <?php
                    foreach($groups as $group) { ?>
                    <option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
                    
                    <?php
                  } ?>
                </select> 
        </div>
        <div class="modal-body">
            <h5 class="modal-title">Select User</h5>
            <select id="user" name="user" multiple="multiple" class="form-control" style="width: 300px">  
            @if($campaigns)
                @foreach($campaigns as $user)
                        <option class="form-control" id="<?php echo $user->id; ?>" value="{{$user->id}}">{{$user->name}}</option>
                @endforeach 
            @endif
            </select>
         <input type="hidden" name="userIds" id="userIds" value="" />
    </select>
</div>
<div class="modal-body">
    
    <!-- <input type="button" id="btnSelected" value="Get Selected" /> -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="save" >Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</section>{{--End content--}}
</div>{{--End content-wrapper--}}
@include('components.footer')
</div>{{--End wrapper--}}
@endsection


@section('css')
<script src="{{url('/opt/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css" -->
        <!-- rel="stylesheet" type="text/css" /> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>-->
   
    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
        type="text/javascript"></script>
    

<script type="text/javascript">



</script>

@endsection
@section('js')


@endsection


  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css"
        rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
    
    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
        type="text/javascript"></script> 
        
    <script type="text/javascript">



function deleteRecord(id) {
            //alert(id);
            $.ajax({
                url: '{{ url("campaign/delete") }}' + '/' + id,
                type: 'post',
                success: function(result) {
                    location.reload();
                // Do something with the result
                //$('#div' + id).hide();
            }
        });
        }

        // $('#save').click(function () {
         
        // })


        $(function () {
            $('#user').multiselect({
                includeSelectAllOption: true
            });
            $('#save').click(function () {
                var selected = $("#user option:selected");
                var ids = "";
                selected.each(function () {
                     // message += $(this).text() + " " + $(this).val() + "\n";
                     ids += + $(this).val() + ",";
                });
                $("#userIds").val(ids);


                   $.ajax({
                    type:'POST',
                    url:'{{url('user/group/save')}}',
                    data:{
                        'group_id':$('#group').val(),
                        'user_id':$('#userIds').val(),
                    },
                    success:function (data) {
                        if(data=='success'){
                            swal('Success','User Group Information added','success');
                            location.reload();
                        }
                        else{
                            swal('Error',data,'error');
                        }
                    },
                    error:function (data) {
                        swal('Error',data,'error');
                    }
                });
            });
        });
    </script>

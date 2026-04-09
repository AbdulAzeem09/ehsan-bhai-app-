@extends('layouts.app')
@section('title','Add new user | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border" align="center">
                                <h3 class="box-title"><i class="fa fa-user-plus"></i> Add SMS Campaign</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Campaign Name</label>
                                    <input class="form-control" id="name"
                                           placeholder="Name..." type="text" required>
                                </div>
                             <!--    <div class="form-group">
                                    <label for="text">Email</label>
                                    <input class="form-control"  id="email"
                                           placeholder="Email..." type="email">
                                </div> -->
                                <div class="form-group">
                                    <label for="text">Text Message</label>
                                    <textarea id="text" placeholder="Message..." class="form-control" rows="8" cols="30" maxlength="140" ></textarea>
                                    <div id="textarea_feedback">140 characters remaining</div>
                                </div>

                                <div class="form-group">
                                    <label for="pass">Date</label>
                                    <input class="form-control" value="" id="date"
                                           placeholder="Date..." type="text">
                                </div>

                                <div class="form-group">
                                    <label for="pass">Time</label>
                                    <select class="form-control" id="time">
                                    
                                    <?php
                                    $start = "00:00";
                                    $end = "23:59";

                                    $tStart = strtotime($start);
                                    $tEnd = strtotime($end);
                                    $tNow = $tStart;

                                    while($tNow <= $tEnd){
                                      echo '<option value="'.date("H:i",$tNow).'">'.date("H:i",$tNow).'</option>';
                                      $tNow = strtotime('+15 minutes',$tNow);
                                    }
                                    ?>

                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="pass">User / Group</label>
                                    <br>
                                    <label class="radio-inline">
                                      <input type="radio" name="user_group" id="userOption" value="user" checked>User
                                  </label>
                                  <label class="radio-inline">
                                      <input type="radio" name="user_group" id="groupOption" value="group">Group
                                  </label>
                              </div>
                              <div id="user">
                                  <div class="form-group">
                                    <h5 class="modal-title">Select User</h5>
                                    <select id="users" name="users" multiple="multiple" class="form-control" style="width: 300px">  
                                        @if( isset($users) )
                                            @foreach($users as $user)
                                            <option class="form-control" id="<?php echo $user->id; ?>" value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach 
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div id="group" style="display:none">
                                <div class="form-group">
                                    <h5 class="modal-title">Select Group</h5>
                                    <select id="groups" name="groups" multiple="multiple" class="form-control" style="width: 300px">  
                                        @if( isset($groups) )
                                        @foreach($groups as $group)
                                        <option class="form-control" id="<?php echo $group->id; ?>" value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach 
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="optionValue" id="optionValue" value="" />
                            <input type="hidden" name="Ids" id="Ids" value="" />
                             
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button id="save" class="btn btn-primary">Schedule</button>
                                <!-- <button id="sendEmail" class="btn btn-primary">Send SMS</button> -->
                                <input type="hidden" name="emails" id="emails" value="" />
                            </div>
                             <div class="box-footer">
                                <!-- <button id="import" class="btn btn-primary">Import</button> -->
                                        <!-- <a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
                                        <a href="{{ URL::to('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
                                        <a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a> -->
                                        <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('import/user') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                            <input type="file" name="import_file"  id="import_file"/>
                                            <br>
                                            <button class="btn btn-primary" id="import">Import File</button>
                                        </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border" align="center">
                            <h3 class="box-title"><i class="fa fa-user-plus"></i> Sms Campaign List</h3>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th class="text-center">Campaign Name</th>
                                  <th class="text-center">Created Date</th>
                                  <th class="text-center">Status</th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                                 
                                @if( isset($campaigns) )
                                    @foreach($campaigns as $campaign)
                                    <tr>
                                        <td class="text-center">{{$campaign->name}}</td>
                                        <td class="text-center">{{$campaign->date}}<br>{{date('H:i',strtotime($campaign->time))}}</td>
                                        <td class="text-center">
                                        <a href="{{url('save/sms')}}">
                                            @if($campaign->status=='pending')
                                               <font class="pending">{{$campaign->status}}</font>
                                            @endif
                                            @if($campaign->status=='Ok')
                                                 <font class="ok">{{$campaign->status}}</font>
                                            @endif
                                            @if($campaign->status=='progress')
                                                <font class="progress1">{{$campaign->status}}</font>
                                            @endif
                                            </a>
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

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}

     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
    rel="stylesheet" type="text/css" />
    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
    type="text/javascript"></script> 

@endsection


@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('js')

<script type="text/javascript">
$('#save').on('click', function () {

    $("#Ids").val('');
        var optionValue = $("#optionValue").val();
        // alert(encodeURI(optionValue) );
        if( optionValue == 'user'){
            var option = 'user';
            var selected = $("#user option:selected");
            var ids = "";
            selected.each(function () {
                 // message += $(this).text() + " " + $(this).val() + "\n";
                 ids += + $(this).val() + ",";
            });
            $("#Ids").val(ids);
        } else {
            var selected = $("#group option:selected");
            var ids = "";
            var option = 'group';
            selected.each(function () {
                 // message += $(this).text() + " " + $(this).val() + "\n";
                 ids += + $(this).val() + ",";
            });
            $("#Ids").val(ids);
        }

        
    $.ajax({
        type:'POST',
        url:'{{url('/add/sms/campaign')}}',
        data:{
            'name':$('#name').val(),
            'type':'Sms',
            // 'email':$('#email').val(),
            'text':$('#text').val(),
            'date':$('#date').val(),
            'time':$('#time').val(),
            'user_id':$('#user_id').val(),
            'user_or_group':option,
            'group_id':$('#groupOption').val(),
            'status':'pending',
            'Ids': $("#Ids").val(),

        },
        success:function (data) {
            if(data=='success'){
                swal('Success','Campaign added','success');
                $('#name').val(''),
                // $('#email').val(''),
                $('#text').val(''),
                $('#date').val(''),
                $('#time').val(''),
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
})

$('#sendEmail').on('click', function () {
    $.ajax({
        type:'POST',
        url:'{{url('/send/campaign/email')}}',
        data:{
            'emails':$('#emails').val(),
        },
        success:function (data) {
            if(data=='success'){
                swal('Success','Campaign added','success');
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
})

$("#import").click(function(){
    var filename = $("#import_file").val();
    if ( filename == '' ){
        swal('Error','Please select the file','error');
        return false;
    }

    var ext = $('#import_file').val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['xls','xlsx','csv']) == -1) {
            swal('Error','Invalid file choosen','error');
        return false;
        }
    
})
$(document).ready(function() {
    var text_max = 149;
    $('#textarea_feedback').html(text_max + ' characters remaining');

    $('#text').keyup(function() {
        var text_length = $('#text').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_feedback').html(text_remaining + ' characters remaining');
        });
    });
// $('#import').on('click', function () {
//     $.ajax({
//         type:'POST',
//         url:'{{url('/import/user')}}',
//         data:{
//             'import_file':$('#import_file').val(),
//         },
//         success:function (data) {
//             if(data=='success'){
//                 swal('Success','Imported ','success');
//                 location.reload();    
//             }
//             else{
//                 swal('Error',data,'error');
//             }
//         },
//         error:function (data) {
//             swal('Error',data,'error');
//         }
//     });
// })
$(function () {
    $('#users').multiselect({
        includeSelectAllOption: true
    });
    $('#groups').multiselect({
        includeSelectAllOption: true
    });
});


$("#userOption").change(function(){ 
    $("#optionValue").val('');
    $("#optionValue").val('user');
    $("#group").css('display','none');
    $("#user").css('display','');
});
$("#groupOption").change(function(){ 
    $("#optionValue").val('');
    $("#optionValue").val('group');
    $("#user").css('display','none');
    $("#group").css('display','');
});

</script> 
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$("#date").datepicker({ dateFormat: 'yy-mm-dd' });

</script>   
@endsection
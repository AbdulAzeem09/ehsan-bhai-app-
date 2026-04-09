@extends('layouts.app')
@section('title','Add new user | Optimus')

@section('content')
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css"
    rel="stylesheet" type="text/css" /> -->


    <script src="{{url('/opt/nicEdit-latest.js')}}"></script>
    <script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
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
                            <h3 class="box-title"><i class="fa fa-user-plus"></i> Add Email Campaign</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Subject</label>
                                <input class="form-control" id="name"
                                placeholder="Subject..." type="text" required>
                            </div>
                             <!--    <div class="form-group">
                                    <label for="text">Email</label>
                                    <input class="form-control"  id="email"
                                           placeholder="Email..." type="email">
                                       </div> -->
                                       <div class="form-group">
                                        <label for="text">Email Body</label>
                                        <textarea name="area2" id="text" placeholder="Email Body..." style="width: 100%; height:170px">

                                        </textarea>
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
                            <!--  <button id="sendEmail" class="btn btn-primary">Send Email</button> -->
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
                                        <h3 class="box-title"><i class="fa fa-user-plus"></i> Email Campaign List</h3>
                                        <table class="table">
                                          <thead>
                                            <tr>
                                              <th class="text-center">Subject</th>
                                              <th class="text-center">Created Date</th>
                                              <th class="text-center">Status</th>

                                          </tr>
                                      </thead>
                                      <tbody>
                                        @if($campaigns > 0)
                                        @foreach($campaigns as $campaign)
                                        <tr>
                                            <td class="text-center">{{$campaign->name}}</td>
                                            <td class="text-center">{{$campaign->date}}<br>{{date('H:i',strtotime($campaign->time))}}</td>
                                            <td class="text-center">
                                                @if($campaign->status=='pending')
                                                <font class="pending">{{$campaign->status}}</font>
                                                
                                                @endif
                                                @if($campaign->status=='Ok')
                                                <a href="{{url('sendgrid/stats')}}"><font class="ok">{{$campaign->status}}</font></a>
                                                @endif
                                                @if($campaign->status=='progress')
                                                <font class="progress1">{{$campaign->status}}</font>
                                                @endif
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
    @endsection


    @section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
    rel="stylesheet" type="text/css" />
    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
    type="text/javascript"></script> 

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

        var nicE = new nicEditors.findEditor('text');
        text = nicE.getContent();
        $.ajax({
            type:'POST',
            url:'{{url('/add/email/campaign')}}',
            data:{
                'name':$('#name').val(),
            // 'email':$('#email').val(),
            'text':text,
            'type':'Email',
            'date':$('#date').val(),
            'time':$('#time').val(),
            'user_id':$('#user_id').val(),
            'user_id':$('#userOption').val(),
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
                swal('Success','Campaign email sent','success');
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
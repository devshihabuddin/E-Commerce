@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> SMTP Settings</h2>
                       
                    </div>
                </div>
            </div>

            <div class="row clearfix">
            @include('backend.layouts.notification')
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form id="basic-form" action="{{route('smtp.update')}}" method="post">
                                @csrf
                                
                                <div class="form-group">
                                <input type="hidden" name="types[]" value="MAIL_DRIVER">
                                    <label for="">Type</label>
                                    <select class="form-control" name="MAIL_DRIVER" id="" onchange="checkMailDriver()">
                                        <option value="sendmail" @if(env('MAIL_DRIVER')== 'sendmail') selected @endif>Sendmail</option>
                                        <option value="smtp" @if(env('MAIL_DRIVER')== 'smtp') selected @endif>SMTP</option>
                                        <option value="mailgun" @if(env('MAIL_DRIVER')== 'mailgun') selected @endif>Mailgun</option>
                                    </select>
                                </div>
                                
                                <div id="smtp" class="form-group"> 
                                    <div class="form-group">
                                    <input type="hidden" name="types[]" value="MAIL_HOST">
                                        <label for="">MAIL HOST</label>
                                        <input type="text" class="form-control" name="MAIL_HOST" value="{{env('MAIL_HOST')}}">
                                    </div>                                 
                                    <div class="form-group">
                                    <input type="hidden" name="types[]" value="MAIL_PORT">
                                        <label for="">MAIL PORT</label>
                                        <input type="text" class="form-control" name="MAIL_PORT" value="{{env('MAIL_PORT')}}">
                                    </div>
                                    <div class="form-group">
                                    <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                                        <label for="">MAIL ENCRYPTION</label>
                                        <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{env('MAIL_ENCRYPTION')}}">
                                    </div>
                                    <div class="form-group">
                                    <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                                        <label for="">MAIL PASSWORD</label>
                                        <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{env('MAIL_PASSWORD')}}">
                                    </div>
                                    <div class="form-group">
                                    <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                                        <label for="">MAIL FROM ADDRESS</label>
                                        <input type="text" class="form-control" name="MAIL_FROM_ADDRESS" value="{{env('MAIL_FROM_ADDRESS')}}">
                                    </div>
                                </div>

                                <div id="mailgun">
                                    <div class="form-group">
                                    <input type="hidden" name="types[]" value="MAILGUN_DUMAIN">
                                        <label for="">MAILGUN_DUMAIN</label>
                                        <input type="text" class="form-control" name="MAILGUN_DUMAIN" value="{{env('MAILGUN_DUMAIN')}}">
                                    </div>
                                    <div class="form-group">
                                    <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                                        <label for="">MAILGUN_SECRET</label>
                                        <input type="text" class="form-control" name="MAILGUN_SECRET" value="{{env('MAILGUN_SECRET')}}">
                                    </div>
                                </div>
                                
                              
                                <br>
                                <input type="submit" class="btn btn-primary" value="Update">
                                <button type="submit" class="btn btn-outline-secondary">Cancle</button>
                            </form>
                        </div>
                    </div>
                </div>
             
            </div>
            
        </div>
    </div>
@endsection
@push('js')
  <script>
      $('#document').change(function(e){
        checkMailDriver();
      });

      function checkMailDriver(){
          if($('select[name=MAIL_DRIVER]').val()=='mailgun'){
              $('#mailgun').show();
              $('#smtp').hide();
          }
          else{
            $('#mailgun').hide();
              $('#smtp').show();
          }
      }
  </script>
@endpush
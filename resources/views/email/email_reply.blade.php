@extends('adminlte::page')

@section('title', ' | New Email')

@section('content_header')
<h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa fa-fw fa-arrow-left"></i></a></h1>
 
@stop

@section('content')

<div class="row">
        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><i class="fa fa-envelope-o"></i> New</a></li>
                <li class=""><a href="{{url('email/all')}}"><i class="fa fa-envelope-o"></i> ALL<span class="label label-danger pull-right">{{$sent+$drafts}}</span></a></li>
                <li class=""><a href="{{url('email/inbox')}}"><i class="fa fa-inbox"></i> Inbox <span class="label label-info pull-right">{{$inbox}}</span></a></li>
                <li class=""><a href="#"><i class="fa fa-envelope-o"></i> Sent<span class="label label-warning pull-right">{{$sent}}</span></a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts <span class="label label-primary pull-right">{{$drafts}}</span></a></li>
                <li><a href="#"><i class="fa fa-filter"></i> Junk </a>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
         <form action="{{ url('enviaremail') }}" method="post">
              {{ csrf_field() }}

           <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" />
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <input class="form-control" placeholder="To:"  id="to" name="to" value="{{$data->email}}"  required>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Subject:" id="assunto" name="assunto" value="{{$data->subject}}"  required>
              </div>
              <div class="form-group">
                <input class="form-control" type="text" id="name_cliente" name="name_cliente" placeholder="Name:" value="{{$data->name}}"  required>
              </div>
              <div class="form-group">
               <textarea id="message" class="textarea" name="message" placeholder="Escreva aqui o seu email..." style="height:200px;height: 100px;">{!!old('subject')!!}</textarea>
              </div>
                <div class="form-group">
                <!--
                <div class="btn btn-default btn-file">
                    <i class="fa fa-paperclip"></i> Attachment
                    <input type="file" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
                </div>
                -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="pull-right">
                <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div>
            <!-- /.box-footer -->
            </div>
            <!-- /. box -->
          </form>
        </div>
        <!-- /.col -->
      </div>
<script>
        $('.textarea').ckeditor();
</script>
@stop
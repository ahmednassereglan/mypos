@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

                <ol class="breadcrumb">
                    <li ><i class="fa fa-dashboard" aria-hidden="true"></i><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
                    <li><a href="{{ route('dashboard.users.index') }}">@lang('site.users')</a></li>
                    <li class="active">@lang('site.add')</li>
                </ol>

        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                              <h3 class="box-title">@lang('site.create')</h3> 
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                @include('partials._errors')


                                <form action="{{ route('dashboard.users.store') }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('post') }}
                                    <div class="form-group">
                                        <label>@lang('site.first_name')</label>
                                        <input class="form-control" type="text"  value="{{ old('first_name') }}" name="first_name">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.last_name')</label>
                                        <input class="form-control" type="text"  value="{{ old('last_name') }}" name="last_name">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.email')</label>
                                        <input class="form-control" type="email"  value="{{ old('email') }}" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.password')</label>
                                        <input class="form-control" type="password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.password_confirmation')</label>
                                        <input class="form-control" type="password" name="password_confirmation">
                                    </div>

                                    <div class="form-group">
                                        <label for="">@lang('site.permissions')</label>
                                        <div class="card card-primary card-outline card-outline-tabs">
                                            <div class="card-header p-0 border-bottom-0">
                                            @php
                                                $models=['users','categories','products'];
                                                $maps=['create','read','update','delete']
                                            @endphp
                                              <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                                @foreach($models as $index => $model)
                                                    <li class="nav-item">
                                                        <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="{{$model}}-tab" data-toggle="pill" href="#{{$model}}" role="tab" aria-controls="{{$model}}" aria-selected="true">@lang('site.'. $model)</a>
                                                    </li>
                                                @endforeach
                                                
                                                
                                              </ul>
                                            </div>
                                            <div class="card-body">
                                              <div class="tab-content" id="custom-tabs-four-tabContent">
                                               @foreach($models as $index => $model)
                                                    <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{$model}}" role="tabpanel" aria-labelledby="{{$model}}-tab">
                                                        @foreach($maps as $key => $map)
                                                            <label><input type="checkbox" value="{{ $model .'-'. $map }}" name="permissions[]"> @lang('site.'.$map)</label><br>
                                                        @endforeach
                                                        
                                                    </div><!-- /.tab-pane -->
                                                @endforeach
                                                
                                                
                                              </div><!-- /.tab-content -->
                                            </div><!-- /.card-body -->
                                          </div><!-- /.card -->
                                    </div>
                                
                                    
        
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> @lang('site.add')</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                          <!-- /.card -->
                    </div>
                </div>
            </div>
        
        </section>

    </div>

@endsection

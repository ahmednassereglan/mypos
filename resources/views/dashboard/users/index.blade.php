@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')
                
            </h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard" aria-hidden="true"></i><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
                <li>@lang('site.users')</li>
            </ol>

        </section>

        <section class="content">

            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                              <h3 class="box-title">@lang('site.users')</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            @if ($users->count() > 0)
                              <div class="box-body">
                                <table class="table table-bordered">
                                  <thead>
                                    <th>#</th>
                                    <th>@lang('site.first_name')</th>
                                    <th>@lang('site.last_name')</th>
                                    <th>@lang('site.email')</th>
                                    <th>@lang('site.action')</th>
                                    
                                  </thead>
                                  <tbody>
                                    @foreach ($users as $index=>$user )
                                      <tr>
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                          <a class="btn btn-info" href="{{ route('dashboard.users.edit', $user->id) }}">@lang('site.edit')</a>
                                          <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger">@lang('site.delete')</button>
                                          </form>
                                        </td>
                                        
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>

                              </div><!-- /.box-body -->
                            @else
                              @lang('site.no_data_found')
                            @endif
                        </div>
                          <!-- /.card -->
                    </div>
                </div>
            </div>
            
        </section>

    </div>

@endsection

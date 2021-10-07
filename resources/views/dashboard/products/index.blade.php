@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.categories')
                
            </h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard" aria-hidden="true"></i><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
                <li>@lang('site.categories')</li>
            </ol>

            <br>
            <form action="{{ route('dashboard.categories.index') }}" method="get">
              <div class="row">
                <div class="col-md-4">
                  <input type="text" name="search" placeholder="@lang('site.search')" class="form-control" value="{{ request()->search }}">
                </div>
                <div class="col-md-4">
                  <button class="btn btn-primary" type="submit"> @lang('site.search') <i class="fa fa-search" aria-hidden="true"></i></button>
                  
                  @if(auth()->user()->hasPermission('categories-create'))
                    <a class="btn btn-success" href="{{ route('dashboard.categories.create') }}"> @lang('site.add') <i class="fa fa-plus" aria-hidden="true"></i></a>
                  @else
                    <button class="btn btn-success disabled"> @lang('site.create') <i class="fa fa-plus" aria-hidden="true"></i></button>
                  @endif
                </div>
              </div>
            </form>
            

        </section>

        <section class="content">

            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                              <h3 class="box-title">@lang('site.categories')  <small>{ {{ $categories->total() }} }</small></h3> 
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            @if ($categories->count() > 0)
                              <div class="box-body">
                                <table class="table table-hover">
                                  <thead>
                                    <th>#</th>
                                    <th>@lang('site.name')</th>
                                    
                                  </thead>
                                  <tbody>
                                    @foreach ($categories as $index=>$category )
                                      <tr>
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                          @if(auth()->user()->hasPermission('categories-update'))
                                            <a class="btn btn-info" href="{{ route('dashboard.categories.edit', $category->id) }}">@lang('site.edit') <i class="fa fa-edit" aria-hidden="true"></i></a>
                                          @else
                                            <button class="btn btn-info disabled">@lang('site.edit') <i class="fa fa-edit" aria-hidden="true"></i></button>
                                          @endif
                                          @if(auth()->user()->hasPermission('categories-delete'))
                                            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST" style="display: inline-block">
                                              {{ csrf_field() }}
                                              {{ method_field('delete') }}
                                              <button type="submit" class="btn btn-danger delete">@lang('site.delete') <i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </form>
                                          @else
                                            <button class="btn btn-danger disabled"> @lang('site.delete') <i class="fa fa-trash" aria-hidden="true"></i></button>
                                          @endif
                                        </td>
                                        
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>

                                {{ $categories->appends(request()->query())->links() }}

                              </div><!-- /.box-body -->
                            @else
                              <h2 style="padding-bottom: 20px;padding-right: 10px">@lang('site.no_data_found')</h2> 
                            @endif
                        </div>
                          <!-- /.card -->
                    </div>
                </div>
            </div>
            
        </section>

    </div>

@endsection

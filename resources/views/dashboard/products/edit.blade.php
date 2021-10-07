@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.categories')</h1>

                <ol class="breadcrumb">
                    <li ><i class="fa fa-dashboard" aria-hidden="true"></i><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
                    <li><a href="{{ route('dashboard.categories.index') }}">@lang('site.categories')</a></li>
                    <li class="active">@lang('site.edit')</li>
                </ol>

        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                              <h3 class="box-title">@lang('site.edit')</h3> 
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                @include('partials._errors')
 

                                <form action="{{ route('dashboard.categories.update' , $category->id ) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}

                                    @foreach(config('translatable.locales') as $locale)
                                        <div class="form-group">
                                            <label>@lang('site.'. $locale .'.name')</label>
                                            <input class="form-control" type="text"  value="{{ $category->translate($locale)->name }}" name="{{$locale}}[name]" required>
                                        </div>
                                    @endforeach
                                    

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-edit" aria-hidden="true"></i> @lang('site.edit')</button>
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

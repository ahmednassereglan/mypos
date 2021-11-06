@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.products')</h1>

                <ol class="breadcrumb">
                    <li ><i class="fa fa-dashboard" aria-hidden="true"></i><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
                    <li><a href="{{ route('dashboard.products.index') }}">@lang('site.products')</a></li>
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


                                <form action="{{ route('dashboard.products.update', $product->id ) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}


                                    <div class="form-group">
                                        <label>@lang('site.categories')</label>
                                        <select  class="form-control" name="category_id" id="">
                                            <option value="">@lang('site.all_categories')</option>
                                        @foreach($categories as $index => $category)
                                            <option value="{{ $category->id }}"  {{ $product->category_id == $category->id ? 'selected' : ''  }}>{{ $category->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    @foreach(config('translatable.locales') as $locale)

                                        <div class="form-group">
                                            <label>@lang('site.'. $locale .'.name')</label>
                                            <input class="form-control" type="text"  value="{{ $product->name }}" name="{{$locale}}[name]">
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.'. $locale .'.description')</label>
                                            <textarea class="form-control ckeditor" name="{{$locale}}[description]" cols="20" rows="10">{{ $product->description }}</textarea>
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <label>@lang('site.image')</label>
                                        <input class="form-control image" type="file"  name="image">
                                    </div>
                                    <div class="form-group">
                                        <img src="{{ $product->image_path }}" style="width: 200px" class="image-preview img-thumbnail"  alt="">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.purchase_price')</label>
                                        <input class="form-control" type="number" name="purchase_price" value="{{ $product->purchase_price }}">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.sale_price')</label>
                                        <input class="form-control" type="number" name="sale_price" value="{{ $product->sale_price }}">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.stock')</label>
                                        <input class="form-control" type="number" name="stock" value="{{ $product->stock }}">
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

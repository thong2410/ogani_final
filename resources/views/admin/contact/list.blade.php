@extends('layouts.admin')

@section('title', trans('admin.contact.contact'))

@section('content')
<h3 class="mb-4">@lang('admin.contact.contact')</h3>
@if (session('msg'))
 <div class="alert alert-success">
  {{ session('msg') }}
 </div>
 
 @endif
<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('admin.contact.fullname')</th>
                <th scope="col">@lang('admin.contact.email')</th>
                <th scope="col">@lang('admin.contact.content')</th>
               
                <th scope="col"></th>
                
                
            </tr>
        </thead>
        <tbody>
           
                @foreach ($db as $dbs)
                <tr>
                <td>{{ $dbs->id }}</td>
                <td><b>{{ $dbs->name }}</b></td>
                <td>{{ $dbs->email }}</td>     
                <td>{{str_limit ($dbs->note,50)}}</td>      
                <td><a class="btn btn-sm btn-outline-danger mr-1 mb-1" href="contact/del/{{ $dbs->id }}"><i class="fa fa-trash" ></i></a></td> 
                </tr>
                @endforeach
          
        </tbody>
    </table>
</div>
@endsection
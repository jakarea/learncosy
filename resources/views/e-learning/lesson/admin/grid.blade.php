@extends('layouts.latest.admin')
@section('title') Lesson List @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/subscription.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== module list page @S ==== --}}
<main class="module-list-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- session message @S --}}
                @include('partials/session-message')
                {{-- session message @E --}}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="package-list-header">
                    <h5>Lesson List</h5>
                    <div class="form-group">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search module" class="form-control">
                    </div>
                    <div class="form-filter">
                        <select class="form-control">
                            <option value="">All</option>
                            <option value="Publish">Publish</option>
                            <option value="Unpublish">Unpublish</option>
                        </select>
                        <i class="fas fa-angle-down"></i>
                    </div>
                    <div class="bttn">
                        <a href="{{ url('admin/lessons/create') }}" class="common-bttn"><i class="fas fa-plus"></i> Create Lesson</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="subscription-table-wrap">
                    <table>
                        <tr>
                            <th>
                                Title
                            </th> 
                            <th>Short Desc</th> 
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                         @foreach ($lessons as $lesson) 
                        <tr>
                            <td>
                                <h5>{{$lesson->title}}</h5>
                            </td>
                            <td>
                                <p>{{$lesson->short_description}}</p>
                            </td> 
                            <td class="module-status">
                                @if ($lesson->status == 'pending')
                                <span class="badge text-bg-danger">Unpublish</span>
                                @elseif ($lesson->status == 'draft')
                                    <span class="badge text-bg-warning">Draft</span>
                                @elseif ($lesson->status == 'published')
                                    <span class="badge text-bg-primary">Publish</span>
                                @endif 
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ url('admin/lessons/'.$lesson->slug.'/edit') }}" class="me-r"><img src="{{ asset('latest/assets/images/icons/edit.svg') }}" alt="Icon" class="img-fluid"></a>

                                    <form method="post" class="d-inline" action="{{ url('admin/lessons/'.$lesson->slug.'/destroy') }}">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger d-inline"><img src="{{ asset('latest/assets/images/icons/trash.svg') }}" alt="Icon" class="img-fluid"> </button>
                                    </form> 
                                </div>
                               
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- pagginate --}}
            <div class="paggination-wrap mt-4">
                {{ $lessons->links('pagination::bootstrap-5') }}
            </div>
            {{-- pagginate --}}
        </div>
    </div>
</main>
{{-- ==== module list page @E ==== --}}
@endsection
{{-- page content @E --}}
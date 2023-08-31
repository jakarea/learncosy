@extends('layouts.latest.instructor')
@section('title') Module List @endsection

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
            <div class="col-lg-12">
                <form action="" method="GET">
                    <div class="package-list-header"> 
                        <h5>Module List</h5>
                        <div class="form-group">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search Modules" class="form-control" name="title"
                                value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}">
                        </div>
                        <div class="form-filter"> 
                            @php 
                            $modul_status = isset($_GET['status']) ? $_GET['status'] : '';
                            @endphp
                            <select class="form-control" name="status">
                                <option value="">All</option> 
                                <option value="pending" {{ $modul_status == 'pending' ? 'selected' : ''}}>Pending</option>
                                <option value="published" {{ $modul_status == 'published' ? 'selected' : ''}}>Published</option>
                            </select>
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <div class="bttn">
                            <a href="{{ url('instructor/modules/create') }}" class="common-bttn"><i class="fas fa-plus"></i> Add Module</a>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="subscription-table-wrap module-list-table">
                    <table>
                        <tr>
                            <th>
                                Title
                            </th>
                            <th>Lessons</th>
                            <th>Duration</th>
                            <th>Files</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                        {{-- @if ($modules > 0)  --}}
                         @foreach ($modules as $module) 
                        <tr>
                            <td>
                                <h5>{{$module->title}}</h5>
                            </td>
                            <td>
                                <p>{{$module->number_of_lesson}}</p>
                            </td>
                            <td>
                                <p>{{$module->duration}}</p>
                            </td>
                            <td>
                                <p>{{$module->number_of_attachment}}</p>
                            </td> 
                            <td class="module-status">
                                @if ($module->status == 'pending')
                                <span class="badge text-bg-danger">Pending</span>
                                @elseif ($module->status == 'published')
                                    <span class="badge text-bg-primary">Published</span>
                                @endif 
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ url('instructor/modules/'.$module->slug.'/edit') }}" class="me-r"><img src="{{ asset('latest/assets/images/icons/edit.svg') }}" alt="Icon" class="img-fluid"></a>
                                    
                                    <form method="post" class="d-inline" action="{{ url('instructor/modules/'.$module->slug.'/destroy') }}">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger d-inline"><img src="{{ asset('latest/assets/images/icons/trash.svg') }}" alt="Icon" class="img-fluid"> </button>
                                    </form> 
                                </div>
                               
                            </td>
                        </tr>
                        @endforeach
                        {{-- @else 
                        <tr>
                            <td colspan="6">
                                <p>No Module Found!</p>
                            </td>
                        </tr>
                        @endif --}}
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- pagginate --}}
            <div class="paggination-wrap mt-4">
                {{ $modules->links('pagination::bootstrap-5') }}
            </div>
            {{-- pagginate --}}
        </div>
    </div>
</main>
{{-- ==== module list page @E ==== --}}
@endsection
{{-- page content @E --}}
@extends('crm.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit project: {{ $project->title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('crm.main.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('crm.project.index') }}">Projects</a></li>
                            <li class="breadcrumb-item active">{{ $project->title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('crm.project.update', $project->id) }}" method="POST" class="w-50">
                            @csrf
                            @method('PATCH')
                            <label for="title">Title</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ $project->title }}" placeholder="project title">
                            </div>

                            <label for="description">Description</label>
                            <div class="form-group">
                                <textarea type="text" class="form-control" id="description" name="description" placeholder="description">{{ $project->description }}</textarea>
                            </div>

                            <label for="deadline">Deadline</label>
                            <div class="form-group">
                                <input type="date" id="deadline" class="form-control" name="deadline" data-provider="flatpickr" data-date-format="d M, Y" value="{{ $project->deadline }}">
                            </div>

                            <label for="client">Client</label>
                            <div class="form-group">
                                <select name="client_id" id="client" class="form-control">
                                    @foreach($clients as $client)
                                        <option
                                            {{ $client->id === $project->category_id ? ' selected' : '' }}
                                            value="{{ $client->id }}">{{ $client->title_company }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="user">Assigned user</label>
                            <div class="form-group">
                                <select name="user_id" id="user" class="form-control">
                                    @foreach($users as $user)
                                        <option
                                            {{ $user->id === $project->user_id ? ' selected' : '' }}
                                            value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="status">Status</label>
                            <div class="form-group">
                                <select name="status" id="status" class="form-control">
                                    @foreach($statuses as $status)
                                        <option
                                            {{ $status === $project->status ? ' selected' : '' }}
                                            value="{{ $status->value }}">{{ $status->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Create">
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

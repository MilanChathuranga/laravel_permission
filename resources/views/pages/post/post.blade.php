@extends('layouts.app')

@section('content')
    @can('publish post')
        <div class="container">
            <div class="mt-2 mb-3">
                <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="mb-sm-0">Title<code> *</code></label>
                                    <input type="text"
                                           class="form-control form-control-sm form-control-border border-width-2"
                                           name="title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="mb-sm-0">Description<code> *</code></label>
                                    <textarea rows="2"
                                              class="form-control form-control-sm form-control-border border-width-2"
                                              name="description"></textarea>
                                </div>
                            </div>
                        </div>

                        <button class="form-control-sm btn btn-success mt-3" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan
    <div>

        @if(count($posts))
        <table class="table table-success table-striped">
            <thead>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
            </thead>
            <tbody>
            @foreach($posts as $key=> $post)
                <tr>
                    <th scope="row">{{++$key}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{$post->description}}</td>
                    <td>
                        @if($post->status === 1)
                            @can('delete post')
                                <a href="{{route('post.delete',$post->id)}}" class="btn btn-danger m-lg-3">
                                    delete
                                </a>
                            @endcan
                        @elseif($post->status === 0)
                            @can('active post')
                                <a href="{{route('post.active',$post->id)}}" class="btn btn-danger m-lg-3">
                                    active
                            @endcan
                        @endif
                        @can('edit post')
                            <a href="{{route('post.edit',$post->id)}}" class="btn btn-warning">
                                <i class="far fa-trash-alt">edit</i>
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection

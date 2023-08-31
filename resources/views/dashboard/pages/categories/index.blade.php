@extends('dashboard.layout.dashboard')


@section('content')
    <div class="tab-content padding-4">
        <div class="widget-toolbar">
            <div class="d-none d-md-block">

                <a href="{{ route('category.create') }}" class="btn btn-primary btn-xs"><i
                        class="ace-icon fa fa-plus"></i>Create</a>
                <a href="{{ route('category.soft') }}" class="btn btn-xs btn-danger">
                    <i class="ace-icon fa fa-trash-o bigger-120"></i>RecycleBin
                </a>
            </div>
        </div>

        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th width="100" class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>

                    <th width="100">Uuid</th>
                    <th width="100">Name</th>
                    <th width="130">Actions</th>
                </tr>
            <tbody>

                @foreach ($Categories as $data)
                    <tr class="categoryRow{{ $data->id }}">
                        <td class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </td>

                        <td>{{ $data->uuid }}</td>
                        <td>{{ $data->name }}</td>


                        <td>
                            <div class="hidden-sm hidden-xs action-buttons" style="display:flex;">

                                <a class="green" href="{{ route('category.edit', $data->uuid) }}">
                                    <i class="ace-icon fa fa-pencil bigger-120"> </i>
                                </a>
                                <a class="blue" href="{{ route('category.show', $data->uuid) }}">
                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                </a>
                                <form method="POST" action="{{ route('category.destroy', $data->uuid) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="red"><i class="ace-icon fa fa-trash-o bigger-120">
                                        </i></button>

                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach



            </tbody>
        </table>


    </div>

    </div>
@endsection

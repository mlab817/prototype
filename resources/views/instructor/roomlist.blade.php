<div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Key</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rlist as $item)

                                @if(Auth::user()->id == Auth::room()->user_id)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->rname }}</td>
                                    <td>{{ $item->rkey }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>

                </div>
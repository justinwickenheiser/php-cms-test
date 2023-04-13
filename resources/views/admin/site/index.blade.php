<x-cms::layout.admin.template>
   <h1>Sites</h1>

    <table class="table table-striped table-action">
        <thead>
            <tr>
                <th>Site</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sites as $site)
                <tr>
                    <td>
                        {{ $site->title }}
                    </td>
                    <td>
                        {{-- <a href="{{ route('cms.admin.site.edit', $site) }}" class="btn btn-primary">Edit</a> --}}
                        {{-- <a href="{{ route('cms.admin.site.content.index', $site->path) }}" class="btn btn-info">Content</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-cms::layout.admin.template>

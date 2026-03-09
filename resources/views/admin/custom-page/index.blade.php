@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Custom Pages</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.custom-page.create') }}" class="btn btn-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Add new
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Show at Nav.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customPages as $page)
                                    <tr>
                                        <td>{{ $page->title }}</td>
                                        <td><code class="text-danger">{{ url('/') }}/page/{{ $page->slug }}</code></td>
                                        <td class="col-1 text-center">
                                            @if ($page->status)
                                                <span class="badge bg-lime text-lime-fg">Yes</span>
                                            @else
                                                <span class="badge bg-pink text-pink-fg">No</span>
                                            @endif
                                        </td>
                                        <td class="col-1 text-center">
                                            @if ($page->show_at_nav)
                                                <span class="badge bg-lime text-lime-fg">Yes</span>
                                            @else
                                                <span class="badge bg-pink text-pink-fg">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.custom-page.edit', $page->id) }}" class="btn-sm btn-primary">
                                                <x-tabler-icon icon="edit" class="icon-tabler" sprite="outline"/>
                                            </a>
                                            <a href="{{ route('admin.custom-page.destroy', $page->id) }}" class="text-red delete__item">
                                                <x-tabler-icon icon="trash" class="icon-tabler" sprite="outline"/>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center">No data found!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- <div class="mt-5">
                            {{ $customPages->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

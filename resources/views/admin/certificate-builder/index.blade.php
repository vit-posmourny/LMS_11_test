@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Certificate Content</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.certificate-builder.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <fieldset class="form-fieldset">
                                    <div class="mt-1">
                                        <label class="form-label">Certificate Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ $certificate->title }}" placeholder="Enter certificate title">
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>
                                    <div class="mt-3">
                                        <label class="form-label">Certificate Subtitle</label>
                                        <input type="text" class="form-control" name="subtitle" value="{{ $certificate->subtitle }}" placeholder="Enter certificate subtitle">
                                        <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                                    </div>
                                    <div class="mt-3">
                                        <label class="form-label">Certificate Description</label>
                                        <textarea class="form-control" name="description" placeholder="Enter certificate description">{{ $certificate->description }}</textarea>
                                    </div>
                                    <div class="mt-3">
                                        @if ($certificate->background)
                                            <x-image-preview src="{{ asset($certificate->background) }}" alt="background_img"></x-image-preview>
                                        @endif
                                        <label class="form-label">Certificate Background</label>
                                        <input type="file" class="form-control" name="background" placeholder="Enter certificate background"/>
                                    </div>
                                    <div class="mt-3">
                                        @if ($certificate->signature)
                                            <x-image-preview src="{{ asset($certificate->signature) }}" alt="signature_img"></x-image-preview>
                                        @endif
                                        <label class="form-label">Certificate Signature</label>
                                        <input type="file" class="form-control" name="signature" placeholder="Enter certificate signature"/>
                                        <x-input-error :messages="$errors->get('signature')" class="mt-2" />
                                    </div>
                                </fieldset>
                                <div class="d-flex justify-content-end pe-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Certificate Builder</h3>
                        </div>
                        <div class="card-body">
                            <div class="_certificate_body container-fluid" style="background-image: url({{ asset($certificate->background) }})">
                                <div class="_text_box">
                                    <h1>{{ $certificate->title }}</h1>
                                    <h4>{{ $certificate->subtitle }}</h4>
                                    <p class="pt-3">{{ $certificate->description }}</p>
                                </div>
                                <div style="
                                        width: 10%;
                                        position: absolute;
                                        text-align: center;
                                        top: 58%;
                                        left: 47%;
                                        transform: translate(-50%, -50%);"
                                    class="d-flex flex-row align-items-center gap-3 _draggable_element _signature_box">
                                        <span>signature: </span>
                                        <img src="{{ asset($certificate->signature) }}" alt="signature-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

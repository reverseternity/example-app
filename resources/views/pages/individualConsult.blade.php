@extends('my templates.main')

@section('main')
    <div class="row mt-4">
        <h1 style="...">Индивидуальная консультация Любови Гордеевой</h1>
    </div>
    <div class="row mt-4">
        <a href="{{ route('iconsultForm') }}">
            <h1 style="...">Перейти в форму (служебное)</h1>
        </a>
    </div>
@endsection


@extends('layouts.main')

@section('titulo', 'Relatórios')

@section('content-center')
    <div class="content-center">
        <div class="dashboard">
            <div class="title-content">
                <div class="title-text">
                    <span>
                        <a href="{{ route('page.dashboard') }}">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                    </span>
                    <span>/</span>
                    <span>
                        <i class="fas fa-chart-bar me-2"></i>Relatórios
                    </span>
                </div>
            </div>

            <div class="item-area d-flex justify-content-center">
                <div class="text-center pt-5 mt-5" style="color: #25767B">
                    <h1>
                        <p>Não disponível...</p>
                        <i class="fas fa-tools fa-3x"></i>
                    </h1>
                    
                </div>
            </div>

        </div>
    </div>
@endsection
        
@push('scripts')
    <script>
        
    </script>
@endpush

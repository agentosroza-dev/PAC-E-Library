<!-- Footer Design 1: Simple & Clean -->
<footer class=" py-4 mt-16">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="text-muted small mb-0">
                    <i class="fas fa-copyright me-1"></i>
                    {{ date('Y') }} {{ config('app.name') }}.
                    រក្សាសិទ្ធិគ្រប់យ៉ាង។
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                    <i class="fas fa-code-branch me-1"></i>
                    v{{ config('app.version', '1.0.0') }}
                </span>
            </div>
        </div>
    </div>
</footer>

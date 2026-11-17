@if (session('success') || session('error') || $errors->any())
    <div style="position:fixed;left:0;right:0;top:72px;z-index:70;display:flex;justify-content:center;padding:0 1rem;pointer-events:none;">
        <div style="width:100%;max-width:36rem;pointer-events:auto;">
            @if (session('success'))
                <div id="flash-success" role="alert" style="display:flex;gap:0.75rem;align-items:flex-start;margin-bottom:0.5rem;padding:0.75rem 1rem;border:1px solid #86efac;border-radius:0.5rem;background:#f0fdf4;color:#14532d;box-shadow:0 10px 25px rgba(0,0,0,.12);">
                    <span style="display:inline-flex;width:1.5rem;height:1.5rem;align-items:center;justify-content:center;border-radius:9999px;background:#16a34a;color:#fff;font-weight:700;font-size:0.85rem;">✓</span>
                    <div style="flex:1;font-size:0.875rem;font-weight:600;">{{ session('success') }}</div>
                    <button type="button" onclick="this.closest('#flash-success').remove()" aria-label="{{ __('Close') }}" style="border:0;background:transparent;cursor:pointer;color:#15803d;">✕</button>
                </div>
            @endif

            @if (session('error'))
                <div id="flash-error" role="alert" style="display:flex;gap:0.75rem;align-items:flex-start;margin-bottom:0.5rem;padding:0.75rem 1rem;border:1px solid #fca5a5;border-radius:0.5rem;background:#fef2f2;color:#7f1d1d;box-shadow:0 10px 25px rgba(0,0,0,.12);">
                    <span style="display:inline-flex;width:1.5rem;height:1.5rem;align-items:center;justify-content:center;border-radius:9999px;background:#dc2626;color:#fff;font-weight:700;font-size:0.85rem;">!</span>
                    <div style="flex:1;font-size:0.875rem;font-weight:600;">{{ session('error') }}</div>
                    <button type="button" onclick="this.closest('#flash-error').remove()" aria-label="{{ __('Close') }}" style="border:0;background:transparent;cursor:pointer;color:#b91c1c;">✕</button>
                </div>
            @endif

            @if ($errors->any())
                <div role="alert" style="margin-bottom:0.5rem;padding:0.75rem 1rem;border:1px solid #fca5a5;border-radius:0.5rem;background:#fef2f2;color:#7f1d1d;box-shadow:0 10px 25px rgba(0,0,0,.12);">
                    <p style="margin:0 0 0.35rem;font-size:0.875rem;font-weight:600;">{{ __('Please fix the highlighted fields.') }}</p>
                    <ul style="margin:0;padding-left:1.1rem;font-size:0.875rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    @if (session('success'))
        <script>
            setTimeout(function () {
                var el = document.getElementById('flash-success');
                if (el) {
                    el.style.transition = 'opacity .4s ease, transform .4s ease';
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(-8px)';
                    setTimeout(function () { el.remove(); }, 400);
                }
            }, 4500);
        </script>
    @endif
@endif

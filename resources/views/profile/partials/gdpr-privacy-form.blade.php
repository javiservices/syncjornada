<div class="card">
    <div class="card-hd">
        <div class="card-hd-title">
            <span class="card-icon bg-emerald-50 text-emerald-600"><i class="fas fa-shield-halved"></i></span>
            <span class="card-title">Privacidad RGPD</span>
        </div>
    </div>
    <div class="card-body space-y-6">
        {{-- Geolocation --}}
        <div class="flex items-start justify-between gap-6 py-4 border-b border-slate-100">
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-800 mb-1">
                    <i class="fas fa-location-dot mr-1.5 text-slate-400"></i> Geolocalización GPS
                </p>
                <p class="text-sm text-slate-500 leading-relaxed">
                    SyncJornada puede registrar tu ubicación GPS al fichar entrada/salida para verificar presencia.
                    Puedes revocar este consentimiento en cualquier momento (Art. 7.3 RGPD).
                </p>
            </div>
            <form method="post" action="{{ route('profile.geolocation-consent') }}" class="flex-shrink-0">
                @csrf @method('patch')
                <label class="relative inline-flex items-center cursor-pointer select-none">
                    <input type="checkbox" name="geolocation_consent" value="1"
                           {{ auth()->user()->geolocation_consent ? 'checked' : '' }}
                           onchange="this.form.submit()" class="sr-only peer">
                    <input type="hidden" name="geolocation_consent" value="0">
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer
                                peer-checked:bg-blue-600
                                after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                after:bg-white after:border-slate-300 after:border after:rounded-full
                                after:h-5 after:w-5 after:transition-all
                                peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    <span class="ml-2.5 text-sm font-medium text-slate-600">
                        {{ auth()->user()->geolocation_consent ? 'Activado' : 'Desactivado' }}
                    </span>
                </label>
            </form>
        </div>

        {{-- RGPD rights --}}
        <div>
            <p class="text-sm font-semibold text-slate-800 mb-3">
                <i class="fas fa-scale-balanced mr-1.5 text-slate-400"></i> Tus derechos RGPD
            </p>
            <div class="grid sm:grid-cols-2 gap-3">
                @foreach([
                    ['icon'=>'fa-eye','right'=>'Acceso','desc'=>'Ver todos tus datos personales','route'=>'profile.export-data'],
                    ['icon'=>'fa-pen','right'=>'Rectificación','desc'=>'Corregir datos incorrectos','route'=>null],
                    ['icon'=>'fa-trash','right'=>'Supresión','desc'=>'Solicitar eliminación de datos','route'=>null,'action'=>'delete'],
                    ['icon'=>'fa-file-export','right'=>'Portabilidad','desc'=>'Exportar tus datos en JSON','route'=>'profile.export-data'],
                ] as $right)
                <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                    <div class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center flex-shrink-0">
                        <i class="fas {{ $right['icon'] }} text-blue-600 text-xs"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-slate-700">{{ $right['right'] }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $right['desc'] }}</p>
                        @if(!empty($right['route']))
                        <a href="{{ route($right['route']) }}" class="text-xs text-blue-600 hover:underline font-medium mt-1 inline-block">Ejercer →</a>
                        @elseif(!empty($right['action']) && $right['action'] === 'delete')
                        <button type="button" x-data @click="$dispatch('open-modal', 'confirm-user-deletion')" class="text-xs text-red-600 hover:underline font-medium mt-1 inline-block bg-transparent border-0 p-0">Ejercer →</button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="pt-2 border-t border-slate-100">
            <p class="text-xs text-slate-400 flex items-center gap-2">
                <i class="fas fa-lock text-slate-300"></i>
                Tus datos están protegidos conforme al Reglamento (UE) 2016/679 (RGPD) y la LOPDGDD.
            </p>
        </div>
    </div>
</div>

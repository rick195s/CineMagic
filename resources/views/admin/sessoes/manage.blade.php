@extends('layouts.dashboard')

@section('title', __('Manage Session') . ' - ' . $sessao->filme->titulo)

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>
@endsection

@section('content')

    <div class="col-12">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('storage/cartazes/' . $sessao->filme->cartaz_url) }}" class="img-fluid rounded-start"
                        alt="{{ $sessao->filme->titulo }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body h-100">
                        <h1>{{ $sessao->filme->titulo }}</h1>
                        <h3 class="card-text">
                            {{ $sessao->data . ' ' . $sessao->horario_inicio }}
                        </h3>
                        <input type="hidden" id="sessao_id" name="sessao_id" value="{{ $sessao->id }}">

                        <div class=" mt-5">
                            <a data-bs-toggle="modal" href="#qrScannerModal" role="button" class="btn btn-lg btn-info">
                                {{ __('Scan QRCode') }}
                            </a>
                        </div>

                        <table class="table my-3 table-hover">
                            <thead>
                                <tr>
                                    <th class="d-none d-xl-table-cell">{{ __('Ticket ID') }}</th>
                                    <th class="d-none d-xl-table-cell">{{ __('Users') }}</th>
                                    <th class="d-none d-xl-table-cell">{{ __('State') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bilhetes as $bilhete)
                                    <tr>
                                        <td>{{ $bilhete->id }}</td>
                                        <td>
                                            <a
                                                href="{{ route('admin.users.show', $bilhete->cliente->id) }}">{{ $bilhete->cliente->user->name }}</a>
                                        </td>
                                        <td>
                                            @if (!$bilhete->usado())
                                                <form action="{{ route('admin.bilhetes.use', $bilhete->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="sessao_id" value="{{ $sessao->id }}">

                                                    <button class="btn btn-success">{{ __('Mark as Used') }}</button>

                                                </form>
                                            @else
                                                <p>{{ __('Ticket already used') }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $bilhetes->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal para ler qrcode --}}
    <div class="modal fade" id="qrScannerModal" aria-hidden="true" aria-labelledby="qrScannerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <video id="preview" width="100%"></video>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="qrScannerModal2" aria-hidden="true" aria-labelledby="qrScannerModalLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" id="qrScannerModal2Content">
                <div class="modal-body">
                    <h3 class="text-white"></h3>
                </div>
                <div class="modal-footer" style="border-top: none">
                    <button class="btn btn-light" data-bs-target="#qrScannerModal" data-bs-toggle="modal"
                        data-bs-dismiss="modal">{{ __('Scan another QRCode') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- fim modal para ler qrcode --}}

    <script type="text/javascript" src="{{ asset('js/qrscanner.js') }}"></script>

@endsection

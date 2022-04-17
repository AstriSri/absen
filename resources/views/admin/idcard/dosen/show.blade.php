@extends('layouts.masteradmin')

@push('css')
    <style>
        :root {
            --lebar-card: 60mm;
            --lebar-foto: 40mm;
            --tinggi: 82mm;
            --ukuran-text:12pt;
            --ukuran-text-homebase:11pt;
            --margin-card-y: 20mm;
            --margin-card-x: 4mm;
        }
        .col-md-6{
            max-width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
            margin-right: -0.75rem;
            margin-left: -0.75rem;
        }

        .idcard-image-front{
            min-width: var(--lebar-card);
            max-width: var(--lebar-card);
        }
        
        .universitas{
            width: 100%;
            position: absolute;
            top: 17%;
            text-align: center;
            display: block;
            margin: 0;
            font-size: var(--ukuran-text);
            font-weight: 700;
            color: white;
        }
        .idcard-image-profil-border{
            width: var(--lebar-foto);
            height: var(--lebar-foto);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            display: block;
            border-radius: 50%;
            border: 2px orange solid !important;
        }
        .idcard-image-profil{
            width: var(--lebar-foto);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            display: block;
            margin: 0;
            border-radius: 50%;
        }

        .nama-dosen{
            position: absolute;
            top: 75%;
            width: 100%;
            text-align: center;
            display: block;
            margin: 0;
            font-size: var(--ukuran-text);
            font-weight: 700;
            color: black;
        }

        .homebase-dosen{
            position: absolute;
            top: 85%;
            width: 100%;
            text-align: center;
            display: block;
            margin: 0;
            font-size: var(--ukuran-text-homebase);
            font-weight: 400;
            color: black;
        }

        .hr-dosen{
            position: absolute;
            top: 82%;
            width: 90%;
            text-align: center;
            display: block;
            margin: 0;
            font-size: 11pt;
            font-weight: 400;
            color: black;
        }

        .idcard-container{
            display: flex;
            position: inherit;
            align-items: center;
            flex-direction:column;
        }

        .idcard-container-content {
            width: var(--lebar-card);
            display: flex;
            flex-direction: column; 
            position: relative;
            align-items: center;
            color: white;
            margin: var(--margin-card-y) var(--margin-card-x);
        }
    </style>
@endpush
@section('content')
<x-function/>
<div class="card">
    <div class="card-header">
        <h2>
            Id Card {{ $dosen->namagelar }}
            <a class="btn btn-primary mx-1 float-right" href="{{ route('dosen.show', $dosen->id) }}"><i class="fas fa-arrow-left"></i></a>
        </h2>
    </div>
    <div class="card-body">
        <div class="flex row">
            <div class="col-md-6">
                <div class="idcard-container">
                    <div class="idcard-container-content" id="idcard-depan">
                        <img class="idcard-image-front" src="{{asset('images/idcard/front.png')}}" alt="img">
                        <img class="idcard-image-profil" src="{{ url($dosen->userz->foto.'/display_foto')}}" onerror="this.src='{{ asset('images/default_profil.png') }}'" alt="img">
                        <div class="idcard-image-profil-border"></div>
                        <div class="universitas">UNIVERSITAS BALIKPAPAN</div>
                        <div class="nama-dosen">{{ShortName($dosen->userz->name) ?? ''}}</div>
                        <hr class="hr-dosen">
                        <div class="jabatan-dosen">{{$dosen->Jabatan_fungsional->jabatan ?? ""}}</div>
                        <div class="homebase-dosen">{{$dosen->Homebase->homebase ?? ''}}</div>
                    </div>
                    <p></p>
                    <button class="btn btn-primary" id="download-front">Download</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="idcard-container" >
                    <div class="idcard-container-content" id="idcard-belakang">
                        <img class="idcard-image-front" src="{{asset('images/idcard/back.png')}}" alt="img">
                    </div>
                    <p></p>
                    <button class="btn btn-primary" id="download-back" >Download</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script src="{{ asset('sbadmin/vendor/jquery/jquery.html2canvas.min.js') }}"></script>
    <script>
        
        $("#download-front").on('click', function() {
            html2canvas(document.querySelector("#idcard-depan")).then(canvas => {
                // document.body.appendChild(canvas)
                saveAs(canvas.toDataURL(), '{{ $dosen->userz->username }}-depan');
            });
        });

        $("#download-back").on('click', function() {
            html2canvas(document.querySelector("#idcard-belakang")).then(canvas => {
                // document.body.appendChild(canvas)
                saveAs(canvas.toDataURL(), '{{ $dosen->userz->username }}-belakang');
            });
        });

        function saveAs(uri, filename) {
            var link = document.createElement('a');
            if (typeof link.download === 'string') {
                link.href = uri;
                link.download = filename;

                //Firefox requires the link to be in the body
                // document.body.appendChild(link);

                //simulate click
                link.click();

                //remove the link when done
                document.body.removeChild(link);
            } else {
                window.open(uri);
            }
        }
    </script>
@endpush
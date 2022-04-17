@extends('layouts.masteruser')

@push('css')
    <style>
        :root {
            --lebar-card: 54mm;
            --lebar-foto: 35mm;
            --tinggi-card: 85mm;
            --ukuran-text:10.5pt;
            --ukuran-text-divisi:9pt;
            --margin-card-y: 20mm;
            --margin-card-x: 10mm;
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
            min-height: var(--tinggi-card);
            max-height: var(--tinggi-card);
        }
        
        .universitas{
            width: 100%;
            position: absolute;
            top: 17.8%;
            text-align: center;
            display: block;
            margin: 0;
            font-size: var(--ukuran-text);
            font-weight: 700;
            color: white;
            font-family: "Times New Roman", Times, serif;
        }
        .idcard-image-profil-border{
            width: var(--lebar-foto);
            height: var(--lebar-foto);
            position: absolute;
            top: 49%;
            left: 50%;
            transform: translate(-50%,-50%);
            display: block;
            border-radius: 50%;
            border: 2px orange solid !important;
        }
        .idcard-image-profil{
            width: var(--lebar-foto);
            position: absolute;
            top: 49%;
            left: 50%;
            transform: translate(-50%,-50%);
            display: block;
            margin: 0;
            border-radius: 50%;
        }

        .nama-pegawai{
            position: absolute;
            top: 73%;
            width: 97%;
            text-align: center;
            display: block;
            margin: 0;
            font-size: var(--ukuran-text);
            font-weight: 700;
            color: black;
            font-family: "Times New Roman", Times, serif;
        }

        .jabatan-pegawai{
            position: absolute;
            top: 81%;
            width: 97%;
            text-align: center;
            display: block;
            margin: 0;
            font-size: var(--ukuran-text-divisi);
            font-weight: 700;
            color: black;
            font-family: "Times New Roman", Times, serif;
        }
        .divisi-pegawai{
            position: absolute;
            top: 86%;
            width: 97%;
            text-align: center;
            display: block;
            margin: 0;
            font-size: var(--ukuran-text-divisi);
            font-weight: 400;
            color: black;
            font-family: "Times New Roman", Times, serif;
        }

        .hr-pegawai{
            position: absolute;
            top: 79%;
            width: 93%;
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
            Id Card {{ $pegawai->namagelar }}
            <a class="btn btn-primary mx-1 float-right" href="{{ route('profil') }}"><i class="fas fa-arrow-left"></i></a>
        </h2>
    </div>
    <div class="card-body">
        <div class="flex row">
            <div class="col-md-6">
                <div class="idcard-container">
                    <div class="idcard-container-content" id="idcard-depan">
                        <img class="idcard-image-front" src="{{asset('images/idcard/front.png')}}" alt="img">
                        <img class="idcard-image-profil" src="{{ url($pegawai->userz->foto.'/display_foto')}}" onerror="this.src='{{ asset('images/default_profil.png') }}'" alt="img">
                        <div class="idcard-image-profil-border"></div>
                        <div class="universitas">UNIVERSITAS BALIKPAPAN</div>
                        <div class="nama-pegawai">{{ ShortName($pegawai->userz->name) ?? ""}}</div>
                        <hr class="hr-pegawai">
                        <div class="jabatan-pegawai">{{$pegawai->Jabatan->jabatan ?? ''}}</div>
                        <div class="divisi-pegawai">{{$pegawai->Divisi->divisi ?? ''}}</div>
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
                saveAs(canvas.toDataURL(), '{{ $pegawai->userz->username }}-depan');
            });
        });

        $("#download-back").on('click', function() {
            html2canvas(document.querySelector("#idcard-belakang")).then(canvas => {
                // document.body.appendChild(canvas)
                saveAs(canvas.toDataURL(), '{{ $pegawai->userz->username }}-belakang');
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
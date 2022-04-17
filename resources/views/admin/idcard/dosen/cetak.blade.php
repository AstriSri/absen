<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- {{dd($id)}} --}}
    <style>
        body{
            max-width: 201mm;
        }
        :root {
            --lebar-card: 54mm;
            --lebar-foto: 35mm;
            --tinggi-card: 85mm;
            --ukuran-text:10.5pt;
            --ukuran-text-homebase:9pt;
            --margin-card-y: 20mm;
            --margin-card-x: 10mm;
        }
        .col-md-6{
            max-width: 33.333333333333333%;
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

        .nama-dosen{
            position: absolute;
            top: 73%;
            width: 97%;
            text-align: center;
            display: block;
            margin: 0;
            font-size: var(--ukuran-text);
            font-weight: 700;
            color: black;
        }

        .jabatan-dosen{
            position: absolute;
            top: 81%;
            width: 97%;
            text-align: center;
            display: block;
            margin: 0;
            font-size: var(--ukuran-text-homebase);
            font-weight: 700;
            color: black;
        }
        .homebase-dosen{
            position: absolute;
            top: 86%;
            width: 97%;
            text-align: center;
            display: block;
            margin: 0;
            font-size: var(--ukuran-text-homebase);
            font-weight: 400;
            color: black;
        }

        .hr-dosen{
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
        @media print {
            footer {
                page-break-after: always;
            }

            @page {
                size: A4; /* DIN A4 standard, Europe */
                margin:0;
            }
            html, body {
                width: 210mm;
                /* height: 297mm; */
                height: 282mm;
                font-size: 11px;
                background: #FFF;
                overflow:visible;
            }
            body {
                padding-top:15mm;
            }
        }
    </style>
<x-function/>
<div class="flex row">
    @foreach ($id as $dosen)
    
        <div class="col-md-6">
            <div class="idcard-container">
                <div class="idcard-container-content" id="idcard-depan">
                    <img class="idcard-image-front" src="{{asset('images/idcard/front.png')}}" alt="img">
                    <img class="idcard-image-profil" src="{{ url($dosen->userz->foto.'/display_foto')}}" onerror="this.src='{{ asset('images/default_profil.png') }}'" alt="img">
                    <div class="idcard-image-profil-border"></div>
                    <div class="universitas">UNIVERSITAS BALIKPAPAN</div>
                    <div class="nama-dosen">{{ShortName($dosen->userz->name) ?? ""}}</div>
                    <hr class="hr-dosen">
                    <div class="jabatan-dosen">{{$dosen->Jabatan_fungsional->jabatan ?? ""}}</div>
                    <div class="homebase-dosen">{{$dosen->Homebase->homebase ?? ""}}</div>
                </div>
                <p></p>
            </div>
        </div>
        @if ($loop->iteration % 6 == 0)
            @if ($loop->last)
                </div>
            @else
                <footer></footer>
                <div class="flex row">
            @endif

        @endif
    @endforeach
</div>

    <script src="{{ asset('sbadmin/vendor/jquery/jquery.html2canvas.min.js') }}"></script>
    <script type="text/javascript">
        window.onload = function() { window.print(); }
    </script>
</body>
</html>
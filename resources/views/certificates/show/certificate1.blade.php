<!DOCTYPE html>
<html>

<head>
    <title>Certificate of Completion</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Rakkas&display=swap" rel="stylesheet">


    <style> 

        * {
            padding: 0;
            margin: 0;
            outline: none;
            list-style-type: none;
            text-decoration: none;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-family: Rakkas;
        }

        .main-wrapper {
            width: 100%;
            height: 100vh;
        }

        .container {
            width: 845px;
            height: 590px;
            margin: 0 auto;
            position: relative; 
        } 

        .main-bg{
            width: 845px;
            height: 590px;
            position: absolute; 
        }

        .certficate-content {
            width: 845px;
            height: 590px;
            position: absolute;
            left: 0;
            top: 0;
            z-index: 9999;
            padding: 2.5rem;
            text-align: center;
            padding-top: 3rem;
            /* margin-left: -2rem; */
        }

        .certficate-content h2 {
            color: #047580;
            font-size: 2.75rem;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            letter-spacing: 0.1375rem;
        }

        .certficate-content h5.badge {
            color: #FFF;
            font-size: 1rem;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            letter-spacing: 0.05rem;
            font-family: Poppins; 
            background-repeat: no-repeat; 
            background-position: center center;
            padding: 0px 3px;
            padding-bottom: 6px;
            background-image: url({{ asset('latest/assets/images/certificate/one/curved-bg.png') }});
        }

        .certficate-content h6 {
            color: var(--neutral-color-neutral-70, #2F3A4C);
            font-size: 1.125rem;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            margin-top: 5rem;
        }

        .name-box h1 {
            color: #047580;
            font-size: 2rem;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            letter-spacing: 0.29rem;
            text-transform: uppercase; 
            display: inline-block;
            position: relative;
            border-bottom: 1px solid #878787; 
            padding-bottom: 0.25rem;
        }

        .name-box h1:before {
            position: absolute;
            content: '';
            left: -2rem;
            top: 2rem;
            width: 1rem;
            height: 1rem;
            z-index: 999;
            background-repeat: no-repeat;
            background-position: center left;
            background-size: contain; 
            background-image: url({{ asset('latest/assets/images/certificate/one/left-arrow.png') }});  
        }

        .name-box h1:after {
            position: absolute;
            content: '';
            right: -2rem;
            top: 2rem;
            width: 1rem;
            height: 1rem;
            z-index: 999;
            background-repeat: no-repeat;
            background-position: center right;
            background-size: contain; 
            background-image: url({{ asset('latest/assets/images/certificate/one/right-arrow.png') }}); 
            
        }

        .details {
            width: 70%;
            margin: 0 auto;
            text-align: center; 
            margin-top: 16px;
            min-height: 6rem
        }

        .details p {
            color: var(--neutral-color-neutral-70, #2F3A4C);
            font-size: 1.125rem;
            font-style: normal;
            line-height: 100%;
            font-weight: 400;
        }

        .course-date{ 
            position: absolute;
            right: 7rem;
            bottom: 3rem; 
            text-align: center; 
            width: 30%;
        } 
        .signature {
            position: absolute;
            left: 3rem;
            bottom: 3rem; 
            text-align: center; 
            width: 30%; 
        }
        .course-date p{
            color: var(--neutral-color-neutral-70, #2F3A4C);
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: 120%;
            font-family: Poppins;
            display: inline-block;
            border-top: 1px solid #314E85; 
            padding-left: 1rem;
            padding-right: 1rem;
            min-width: 10rem;
            padding-top: 10px;
        }
        .signature p {
            color: var(--neutral-color-neutral-70, #2F3A4C);
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: 120%;
            font-family: Poppins;
            display: inline-block;
            border-top: 1px solid #314E85; 
            padding-left: 1rem;
            padding-right: 1rem;
            min-width: 12.25rem;
            padding-top: 10px;
        }

        .course-date h5{
            color: var(--neutral-color-neutral-70, #2F3A4C);
            font-size: 1rem;
            font-style: normal;
            font-weight: 500;
            line-height: 150%;
            font-family: Poppins;
            padding-bottom: 0.5rem;
        }

        .signature img {
            mix-blend-mode: darken;
            max-width: 6.375rem;
            max-height: 4.875rem;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .logo-area{
            position: absolute;
            right: 2.8rem;
            top: 2.8rem;
            z-index: 999;
        }
        .logo-area img{
            max-width: 9rem;
            max-height: 2.6875rem; 
            object-fit: contain;
        }
        .asset-area{
            position: absolute;
            right: 3rem;
            top: 6.8rem;
            z-index: 999;
        } 
       
        @page { size: 842px 590px }

    </style>
</head>
<body> 

    <div class="main-wrapper">
        <div class="container" style="margin-top: 2rem">
            <div class="main-bg">
                <img src="{{ asset('latest/assets/images/certificate/one/one.png') }}" alt="Certificate-bg"
                    class="img-fluid main-certificate">
            </div>
            <div class="logo-area">
                @if (!empty($logo))
                    <img src="{{ asset($logo) }}" alt="Logo" class="img-fluid">   
                @else 
                    <img src="{{ asset('latest/assets/images/certificate/one/logo.png') }}" alt="Logo" class="img-fluid">
                @endif 
            </div>
            <div class="asset-area">
                <img src="{{ asset('latest/assets/images/certificate/one/checkmark.png') }}" alt="CHK" class="img-fluid">
            </div>
            <div class="certficate-content">
                <h2>CERTIFICATE</h2>

                <h5 class="badge">OF ACHIEVEMENT</h5>

                <h6>This is certify that</h6> 

                <div class="name-box">
                    <h1>{{ Auth::user()->name }}</h1>
                </div>

                <div class="details">
                    <p>has successfully completed the {{$course->title}} Course on {{ date('d M Y', strtotime($courseDate)) }} through
                        Learncosy.</p>
                </div>

                <div class="signature">
                    @if (!empty($signature))
                    <img src="{{ asset($signature) }}" alt="Logo" class="img-fluid">   
                    @else 
                        <img src="{{ asset('latest/assets/images/certificate/one/signature.png') }}" alt="Logo" class="img-fluid">
                    @endif

                    <p>INSTRUCTOR SIGNATURE</p>
                </div>

                <div class="course-date">
                    <h5>{{ date('d M Y') }}</h5>
                    <p>DATE</p>
                </div>

            </div>

        </div>
    </div>

</body>

</html>
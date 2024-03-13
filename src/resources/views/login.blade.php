<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
    <style>
    .cardFront,
    .cardBack {
      box-sizing: border-box;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08), 0 2px 4px -1px rgba(0, 0, 0, 0.04);
      width: 100%;
      min-height: 650px;
    }

    .cardBack {
      display: none;
    }

    .cardBack.flipped {
      display: block;
    }

    .cardFront.flipped {
      display: none;
    }

    .shield {
      margin: 0;
      padding: 3px 0 3px 23px;
      list-style: none;
      display: flex;
      align-items: center;
    }

    .spinner {
      -webkit-animation: rotator 1.4s linear infinite;
      animation: rotator 1.4s linear infinite;
    }
    </style>
</head>
<body>
    <div class="authentication-bg min-vh-100">
        <div class="bg-overlay bg-white"></div>
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-lg-10">
                        <div class="py-5">
                            <div class="card auth-cover-card overflow-hidden">
                                <div class="row g-0">
                                    <div class="col-lg-6">

                                    <div id="cardFront" class="card mb-0 cardFront" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                                        <div class="card-body">
                                        <div class="auth-full-page-content rounded d-flex p-3 my-2" bis_skin_checked="1">
                                            <div class="w-100" bis_skin_checked="1">
                                            <div class="d-flex flex-column h-100" bis_skin_checked="1">
                                                <div class="auth-content my-auto" bis_skin_checked="1">
                                                <div class="text-center" bis_skin_checked="1">
                                                    <h5 class="mb-0 fw-semibold" style="font-size: 40px; color: #ed1c24;">Welcome</h5>
                                                    <p style="font-size: 20px;" class="text-muted">
                                                    Scan with our <a class="fw-semibold" id="flip-btn" style="color: #ed1c24;" href="#">app</a> to securely log in.
                                                    </p>
                                                </div>

                                                <div class="mt-4 pt-3 text-center" bis_skin_checked="1">
                              
                                                    <div class="d-flex justify-content-center mt-3">
                                                        <div class="p-2 border rounded">
                                                        @livewire('q-r-login')
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                                <div class="mt-4 pt-3 text-center" bis_skin_checked="1">
                                                    <p style="font-size: 15px;" class="text-muted mb-1">
                                                    No account yet?
                                                    </p>
                                                    <a class="link-primary" id="flip-btn4" style="cursor: pointer; font-size: 15px;">
                                                    Sign up with ByteWallet App
                                                    </a>
                                                </div>

                                            </div>

                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="text-left" bis_skin_checked="1">
                                        <img src="https://img.freepik.com/free-icon/smartphone_318-548779.jpg" style="float: right;height: 46px;margin-right: 6px;/* margin-bottom: 10px; */margin: 19px;">
                                        <p style="font-size: 10px;margin: 20px;" class="text-muted ">Biometrically Secured<br> FastAuth
                                            Login</p>
                                        </div>
                                    </div>
                                    <div id="cardBack" class="card mb-0 cardBack" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                                         <div class="card-body">
                                        <div class="auth-full-page-content rounded d-flex p-3 my-2" bis_skin_checked="1">
                                            <div class="w-100" bis_skin_checked="1">
                                            <div class="d-flex flex-column h-100" bis_skin_checked="1">
                                                <div class="auth-content my-auto" bis_skin_checked="1">
                                                <h5 class="mb-0">
                                                    <span id="flip-btn2" class="align-items-center" style="color:#ed1c24; cursor: pointer; display: inline-flex;">
                                                    <i class="bx bx-chevron-left me-1"></i> Return
                                                    </span>
                                                </h5>

                                                <div class="text-center" bis_skin_checked="1">
                                                    <h5 class="mb-0 mt-4" style="color: #ed1c24;">Don't have ByteWallet yet?</h5>
                                                    <p class="text-muted mt-2">Download from your phone's app store for free!</p>

                                                    <div class="d-flex" style="margin-left: -40px;" bis_skin_checked="1">
                                                    <ul class="mx-auto justify-content-left" style="text-align: left;">
                                                        <li class="shield">
                                                        <i class="bx bxs-check-shield me-2 fs-5 text-body"></i>
                                                        Secure biometric Registration
                                                        </li>
                                                        <li class="shield">
                                                        <i class="bx bxs-check-shield me-2 fs-5 text-body"></i>
                                                        Prevent Identity Theft
                                                        </li>
                                                        <li class="shield">
                                                        <i class="bx bxs-check-shield me-2 fs-5 text-body"></i>
                                                        Prevent unauthorized access
                                                        </li>
                                                        <li class="shield">
                                                        <i class="bx bxs-check-shield me-2 fs-5 text-body"></i>
                                                        No username/password needed
                                                        </li>
                                                    </ul>
                                                    </div>

                                                    <div class="btn-group-vertical mt-3" bis_skin_checked="1">
                                                    <a href="https://apps.apple.com/us/app/bytewallet/id1569062610" class="d-flex align-items-center ios-button" target="_blank" bis_size="{&quot;x&quot;:844,&quot;y&quot;:432,&quot;w&quot;:230,&quot;h&quot;:71,&quot;abs_x&quot;:844,&quot;abs_y&quot;:432}">
                                                        <img src="https://viewer.bytefederal.com/assets/images/b-300x87.png" style=" width: 230px;" alt="icon" bis_size="{&quot;x&quot;:844,&quot;y&quot;:432,&quot;w&quot;:230,&quot;h&quot;:71,&quot;abs_x&quot;:844,&quot;abs_y&quot;:432}" bis_id="bn_6tk2p6m7eyvujr24fwhzyi">
                                                    </a>

                                                    <a href="https://play.google.com/store/apps/details?id=io.bytewallet.bytewallet&amp;hl=en_US&amp;gl=US" class="d-flex align-items-center windows-button mt-2" target="_blank">
                                                        <img src="https://viewer.bytefederal.com/assets/images/a-300x85.png" alt="icon" style="width: 230px;">

                                                    </a>
                                                    </div>

                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div
                                            class="p-4 p-lg-5 h-100 d-flex align-items-center justify-content-center" style="    background-color: #10111E !important;">
                                            <div class="w-100">
                                                <img src="https://viewer.bytefederal.com/assets/images/rightside.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  @livewireScripts
    <script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        const front = document.getElementById('cardFront')
        const back = document.getElementById('cardBack')
        const btn = document.getElementById('flip-btn')
        const btn2 = document.getElementById('flip-btn2')
        const btn4 = document.getElementById('flip-btn4')

        function handleFlip() {
            front.classList.toggle('flipped')
            back.classList.toggle('flipped')
        }

        btn.addEventListener('click', handleFlip)
        btn2.addEventListener('click', handleFlip)
        btn4.addEventListener('click', handleFlip)

    </script>
    <script>
    let currentSid = '';

    document.addEventListener('DOMContentLoaded', () => {
        window.Livewire.on('sidUpdated', (sid) => {
            currentSid = sid; // Update the current SID whenever the event is emitted
        });

        const checkAuthStatus = () => {
            if (!currentSid) return; // Don't proceed if SID is empty

            fetch(`/api/check?sid=${currentSid}`) // Use the current SID
                .then(response => response.json())
                .then(data => {
                    if (data.authenticated) {
                        window.location.href = `/bwauth?sid=${currentSid}`;
                    }
                })
                .catch(error => console.error('Error checking authentication status:', error));
        };

        setInterval(checkAuthStatus, 5000);
    });
    </script>
   </body>
</html> 

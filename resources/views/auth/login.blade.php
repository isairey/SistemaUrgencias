<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Félix Bulnes</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
    <script data-cfasync="false" nonce="ad1075ae-44e0-4de5-b1af-1fad74803fdc">
        try {
            (function(w, d) {
                ! function(fv, fw, fx, fy) {
                    if (fv.zaraz) console.error("zaraz is loaded twice");
                    else {
                        fv[fx] = fv[fx] || {};
                        fv[fx].executed = [];
                        fv.zaraz = {
                            deferred: [],
                            listeners: []
                        };
                        fv.zaraz._v = "5858";
                        fv.zaraz._n = "ad1075ae-44e0-4de5-b1af-1fad74803fdc";
                        fv.zaraz.q = [];
                        fv.zaraz._f = function(fz) {
                            return async function() {
                                var fA = Array.prototype.slice.call(arguments);
                                fv.zaraz.q.push({
                                    m: fz,
                                    a: fA
                                })
                            }
                        };
                        for (const fB of ["track", "set", "debug"]) fv.zaraz[fB] = fv.zaraz._f(fB);
                        fv.zaraz.init = () => {
                            var fC = fw.getElementsByTagName(fy)[0],
                                fD = fw.createElement(fy),
                                fE = fw.getElementsByTagName("title")[0];
                            fE && (fv[fx].t = fw.getElementsByTagName("title")[0].text);
                            fv[fx].x = Math.random();
                            fv[fx].w = fv.screen.width;
                            fv[fx].h = fv.screen.height;
                            fv[fx].j = fv.innerHeight;
                            fv[fx].e = fv.innerWidth;
                            fv[fx].l = fv.location.href;
                            fv[fx].r = fw.referrer;
                            fv[fx].k = fv.screen.colorDepth;
                            fv[fx].n = fw.characterSet;
                            fv[fx].o = (new Date).getTimezoneOffset();
                            if (fv.dataLayer)
                                for (const fF of Object.entries(Object.entries(dataLayer).reduce(((fG, fH) => ({
                                        ...fG[1],
                                        ...fH[1]
                                    })), {}))) zaraz.set(fF[0], fF[1], {
                                    scope: "page"
                                });
                            fv[fx].q = [];
                            for (; fv.zaraz.q.length;) {
                                const fI = fv.zaraz.q.shift();
                                fv[fx].q.push(fI)
                            }
                            fD.defer = !0;
                            for (const fJ of [localStorage, sessionStorage]) Object.keys(fJ || {}).filter((fL => fL
                                .startsWith("_zaraz_"))).forEach((fK => {
                                try {
                                    fv[fx]["z_" + fK.slice(7)] = JSON.parse(fJ.getItem(fK))
                                } catch {
                                    fv[fx]["z_" + fK.slice(7)] = fJ.getItem(fK)
                                }
                            }));
                            fD.referrerPolicy = "origin";
                            fD.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(fv[fx])));
                            fC.parentNode.insertBefore(fD, fC)
                        };
                        ["complete", "interactive"].includes(fw.readyState) ? zaraz.init() : fv.addEventListener(
                            "DOMContentLoaded", zaraz.init)
                    }
                }(w, d, "zarazData", "script");
                window.zaraz._p = async eC => new Promise((eD => {
                    if (eC) {
                        eC.e && eC.e.forEach((eE => {
                            try {
                                const eF = d.querySelector("script[nonce]"),
                                    eG = eF?.nonce || eF?.getAttribute("nonce"),
                                    eH = d.createElement("script");
                                eG && (eH.nonce = eG);
                                eH.innerHTML = eE;
                                eH.onload = () => {
                                    d.head.removeChild(eH)
                                };
                                d.head.appendChild(eH)
                            } catch (eI) {
                                console.error(`Error executing script: ${eE}\n`, eI)
                            }
                        }));
                        Promise.allSettled((eC.f || []).map((eJ => fetch(eJ[0], eJ[1]))))
                    }
                    eD()
                }));
                zaraz._p({
                    "e": ["(function(w,d){})(window,document)"]
                });
            })(window, document)
        } catch (e) {
            throw fetch("/cdn-cgi/zaraz/t"), e;
        };
    </script>
</head>

<body class="hold-transition login-page"
    style="background-image: url({{ asset('assets/img/gallery/background.png') }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Inicio de sesión SUA </b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg"></p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email" class="col-form-label text-md-end">Usuario</label>
                                <div class="">
                                    <input placeholder="RUT sin punto ni guión con DV" id="rut" type="text" class="form-control @error('rut') is-invalid @enderror" name="rut" value="{{ old('rut') }}" required autocomplete="rut" autofocus>
                                    @error('rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="col-form-label text-md-end">Contraseña</label>
                                <div class="">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                            <br>
                            <p>¿Olvidaste tu contraseña? Comunicate con jefatura de Unidad de Urgencia Adulto o TI</p>
                        </div>
                    </div>
                </form>
                <br>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js?v=3.2.0"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"rayId":"963365476d902752","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.7.0","token":"2437d112162f4ec4b63c3ca0eb38fb20"}'
        crossorigin="anonymous">
    </script>
</body>

</html>

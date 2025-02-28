<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Trilha do Java - 5ª Edição</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/glide.min.js"></script>

        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

        <style>
            .ticket-button {
                width: 100%; /* Ocupa toda a largura */
                background: orange; /* Cor de fundo */
                color: black; /* Cor do texto */
                padding: 12px; /* Espaçamento interno */
                border: none; /* Remove bordas */
                border-radius: 8px; /* Bordas arredondadas */
                font-size: 16px; /* Tamanho do texto */
                font-weight: bold; /* Texto em negrito */
                cursor: pointer; /* Mostra o cursor de clique */
                animation: pulse-scale 1.5s infinite; /* Aplica a animação */
                transform-origin: center; /* Define o ponto de origem do efeito */
            }

            @keyframes pulse-scale {
                0%, 100% {
                    transform: scale(1); /* Tamanho normal */
                }
                50% {
                    transform: scale(1.05); /* Cresce 10% */
                }
            }


            .event-images {
                position: relative;
            }

            @media (max-width: 768px) {
                .event-images {
                    position: relative;
                    width: 200px;
                }
            }

            .swiper-slide img {
                width: 100%; /* Largura total do contêiner */
                height: 200px; /* Altura fixa para todas as imagens */
                border-radius: 10px; /* Adiciona cantos arredondados */
            }
        </style>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                *,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.absolute{position:absolute}.relative{position:relative}.-left-20{left:-5rem}.top-0{top:0px}.-bottom-16{bottom:-4rem}.-left-16{left:-4rem}.-mx-3{margin-left:-0.75rem;margin-right:-0.75rem}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.flex{display:flex}.grid{display:grid}.hidden{display:none}.aspect-video{aspect-ratio:16 / 9}.size-12{width:3rem;height:3rem}.size-5{width:1.25rem;height:1.25rem}.size-6{width:1.5rem;height:1.5rem}.h-12{height:3rem}.h-40{height:10rem}.h-full{height:100%}.min-h-screen{min-height:100vh}.w-full{width:100%}.w-\[calc\(100\%\+8rem\)\]{width:calc(100% + 8rem)}.w-auto{width:auto}.max-w-\[877px\]{max-width:877px}.max-w-2xl{max-width:42rem}.flex-1{flex:1 1 0%}.shrink-0{flex-shrink:0}.grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.flex-col{flex-direction:column}.items-start{align-items:flex-start}.items-center{align-items:center}.items-stretch{align-items:stretch}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.gap-2{gap:0.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.self-center{align-self:center}.overflow-hidden{overflow:hidden}.rounded-\[10px\]{border-radius:10px}.rounded-full{border-radius:9999px}.rounded-lg{border-radius:0.5rem}.rounded-md{border-radius:0.375rem}.rounded-sm{border-radius:0.125rem}.bg-\[\#FF2D20\]\/10{background-color:rgb(255 45 32 / 0.1)}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gradient-to-b{background-image:linear-gradient(to bottom, var(--tw-gradient-stops))}.from-transparent{--tw-gradient-from:transparent var(--tw-gradient-from-position);--tw-gradient-to:rgb(0 0 0 / 0) var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-white{--tw-gradient-to:rgb(255 255 255 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)}.to-white{--tw-gradient-to:#fff var(--tw-gradient-to-position)}.stroke-\[\#FF2D20\]{stroke:#FF2D20}.object-cover{object-fit:cover}.object-top{object-position:top}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.px-3{padding-left:0.75rem;padding-right:0.75rem}.py-16{padding-top:4rem;padding-bottom:4rem}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}.pt-3{padding-top:0.75rem}.text-center{text-align:center}.font-sans{font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji}.text-sm{font-size:0.875rem;line-height:1.25rem}.text-sm\/relaxed{font-size:0.875rem;line-height:1.625}.text-xl{font-size:1.25rem;line-height:1.75rem}.font-semibold{font-weight:600}.text-black{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\]{--tw-shadow:0px 14px 34px 0px rgba(0,0,0,0.08);--tw-shadow-colored:0px 14px 34px 0px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.ring-transparent{--tw-ring-color:transparent}.ring-white\/\[0\.05\]{--tw-ring-color:rgb(255 255 255 / 0.05)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.06));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.25));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.transition{transition-property:color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.duration-300{transition-duration:300ms}.selection\:bg-\[\#FF2D20\] *::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-\[\#FF2D20\]::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-black:hover{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.hover\:text-black\/70:hover{color:rgb(0 0 0 / 0.7)}.hover\:ring-black\/20:hover{--tw-ring-color:rgb(0 0 0 / 0.2)}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.focus-visible\:ring-1:focus-visible{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}@media (min-width: 640px){.sm\:size-16{width:4rem;height:4rem}.sm\:size-6{width:1.5rem;height:1.5rem}.sm\:pt-5{padding-top:1.25rem}}@media (min-width: 768px){.md\:row-span-3{grid-row:span 3 / span 3}}@media (min-width: 1024px){.lg\:col-start-2{grid-column-start:2}.lg\:h-16{height:4rem}.lg\:max-w-7xl{max-width:80rem}.lg\:grid-cols-3{grid-template-columns:repeat(3, minmax(0, 1fr))}.lg\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.lg\:flex-col{flex-direction:column}.lg\:items-end{align-items:flex-end}.lg\:justify-center{justify-content:center}.lg\:gap-8{gap:2rem}.lg\:p-10{padding:2.5rem}.lg\:pb-10{padding-bottom:2.5rem}.lg\:pt-0{padding-top:0px}.lg\:text-\[\#FF2D20\]{--tw-text-opacity:1;color:rgb(255 45 32 / var(--tw-text-opacity))}}@media (prefers-color-scheme: dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:bg-black{--tw-bg-opacity:1;background-color:rgb(0 0 0 / var(--tw-bg-opacity))}.dark\:bg-zinc-900{--tw-bg-opacity:1;background-color:rgb(24 24 27 / var(--tw-bg-opacity))}.dark\:via-zinc-900{--tw-gradient-to:rgb(24 24 27 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)}.dark\:to-zinc-900{--tw-gradient-to:#18181b var(--tw-gradient-to-position)}.dark\:text-white\/50{color:rgb(255 255 255 / 0.5)}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-white\/70{color:rgb(255 255 255 / 0.7)}.dark\:ring-zinc-800{--tw-ring-opacity:1;--tw-ring-color:rgb(39 39 42 / var(--tw-ring-opacity))}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:hover\:text-white\/70:hover{color:rgb(255 255 255 / 0.7)}.dark\:hover\:text-white\/80:hover{color:rgb(255 255 255 / 0.8)}.dark\:hover\:ring-zinc-700:hover{--tw-ring-opacity:1;--tw-ring-color:rgb(63 63 70 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-white:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 255 255 / var(--tw-ring-opacity))}}
            </style>
        @endif
    </head>
    @include('layouts.navigation')
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="container mx-auto px-4 py-8">
            <!-- Título -->
            <h1 class="text-2xl font-bold text-start mb-8 dark:text-white">
                Inscrição Trilha do Java - 5ª Edição
            </h1>

            <!-- Container principal -->
            <div class="flex flex-col lg:flex-row items-start gap-8">
                <!-- Imagem do evento -->
                <div class="lg:sticky lg:top-8 flex-1 flex justify-center">
                    <div class="bg-white rounded-[10px] overflow-hidden shadow-lg border-2 border-orange-300 transition-transform transform hover:scale-105 hover:shadow-md">
                        <img src="{{ asset('images/logos/logo-principal.jpg') }}" alt="Trilhão do Queixada" class="object-cover">
                    </div>
                </div>


                <!-- Informações do evento -->
                <div class="flex-1 bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-lg space-y-6 h-screen overflow-y-auto">
                    <!-- Informações do organizador -->
                    <div>
                        <h2 class="flex items-center text-xl font-bold dark:text-white mb-4 gap-2">
                            <x-application-logo width="40" height="40" />
                            Por Javalis do Norte
                        </h2>
                        <ul class="space-y-4">
                            <li class="flex items-center dark:text-white">
                                <span class="text-yellow-500 material-icons mr-2">
                                    <x-location-icon width="20" height="20" color="orange"/>
                                </span>
                                Vera - Mato Grosso
                            </li>
                            <li class="flex items-center dark:text-white">
                                <span class="text-yellow-500 material-icons mr-2">
                                    <x-race-icon width="20" height="20" color="orange"/>
                                </span>
                                Posto San Raphael (Las Veras) as 08:00
                            </li>
                            <li class="flex items-center dark:text-white">
                                <span class="text-yellow-500 material-icons mr-2">
                                    <x-calendar-icon width="20" height="20" color="orange"/>
                                </span>
                                11 de Janeiro de 2025
                            </li>
                            <li class="flex items-center dark:text-white">
                                <a class="text-yellow-500 material-icons mr-2" href="https://www.instagram.com/jipe_clube_javalis_do_norte/" target="_blank">
                                    <x-instagram-icon width="20" height="20" color="orange"/>
                                </a>
                                <a href="https://www.instagram.com/jipe_clube_javalis_do_norte/" target="_blank"><strong>Jipe Clube Javalis do Norte</strong></a>
                            </li>
                        </ul>
                    </div>

                    <x-divider color="orange" height="1px" width="100%" />

                    <!-- Detalhes do evento -->
                    <div>
                        <h2 class="flex items-center text-xl font-bold dark:text-white mb-4 gap-2">
                            <x-details-icon width="30" height="30" color="currentColor"/>
                            Detalhes Da Programação Do Evento
                        </h2>
                        <ul class="space-y-2">
                            <li class="flex items-start dark:text-white">
                                <span class="text-yellow-500 material-icons mr-2 mt-1">
                                    <x-arrow-right-icon width="20" height="20" color="orange"/>
                                </span>
                                Deslocamento de 18 km até o ponto de início da trilha,
                                com percurso exclusivo para veículos 4x4. Durante a trilha,
                                haverá momentos de confraternização, proporcionando interação, diversão e uma experiência única.
                            </li>
                        </ul>
                    </div>

                    <x-divider color="orange" height="1px" width="100%" />

                    <!-- Informações de contato -->
                    <div>
                        <h2 class="flex items-center text-xl font-bold dark:text-white mb-4 gap-2">
                            <x-phone-icon width="25" height="25" color="currentColor"/>
                            Telefones para contato
                        </h2>
                        <ul class="space-y-3">
                            <li class="flex items-start mt-0 dark:text-white">
                                <span class="text-yellow-500 material-icons mr-2 mt-0.5">
                                    <x-arrow-right-icon width="20" height="20" color="orange"/>
                                </span>
                                (66) 9 9926-0742 - Guilherme
                            </li>

                            <li class="flex items-start mt-0 dark:text-white">
                                <span class="text-yellow-500 material-icons mr-2 mt-0.5">
                                    <x-arrow-right-icon width="20" height="20" color="orange"/>
                                </span>
                                (66) 9 8124-1918 - Cicero
                            </li>

                            <li class="flex items-start mt-0 dark:text-white">
                                <span class="text-yellow-500 material-icons mr-2 mt-0.5">
                                    <x-arrow-right-icon width="20" height="20" color="orange"/>
                                </span>
                                (66) 9 9602-3002 - Marcio
                            </li>
                        </ul>
                    </div>

                    <x-divider color="orange" height="1px" width="100%" />

                    <!-- Informacoes sobre ingressos -->
                    <div>
                        <h2 class="flex items-center text-xl font-bold dark:text-white mb-4 gap-2">
                            <x-ticket-icon width="30" height="30" color="currentColor"/>
                            Informações sobre ingressos
                        </h2>
                        <ul class="space-y-2">
                            <li class="flex items-start dark:text-white">
                                <span class="text-yellow-500 material-icons mr-2 mt-0.5">
                                    <x-arrow-right-icon width="20" height="20" color="orange"/>
                                </span>
                                <p>
                                    <strong class="mr-0.5">Valor inscrição do veículo: </strong><strong  class="mr-0.5">R$350,00</strong> por veículo com direito à <strong  class="mr-0.5 ml-1">2 camisetas e  adesivos.</strong>

                                </p>
                            </li>
                            <li class="flex items-start dark:text-white">
                                <span class="text-yellow-500 material-icons mr-2 mt-0.5">
                                    <x-arrow-right-icon width="20" height="20" color="orange"/>
                                </span>
                                <p>
                                    <strong class="mr-0.5">Camiseta/Passageiro adicional:</strong>
                                    <strong class="mr-0.5">R$100,00.</strong>
                                    É permitido no
                                    <strong class="mr-0.5">máximo 4 passageiros por veículo.</strong>
                                </p>
                            </li>
                        </ul>
                    </div>

                    <div class="w-full text-center">
                        <button class="ticket-button"
                                onclick="window.location.href='{{ auth()->check() ? route('login') : route('login') }}'">
                            Adquira Já seu ingresso!
                        </button>
                        <small class="mt-1"> Faça login/registre-se para comprar seu ingresso!</small>
                    </div>

                    <x-divider color="orange" height="1px" width="100%" />

                    <!-- Detalhes sobre camisetas -->
                    <div>
                        <h2 class="flex items-center text-xl font-bold dark:text-white mb-4 gap-2">
                            <x-shirt-icon width="30" height="30" color="currentColor"/>
                            Mais detalhes sobre as camisetas
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="p-4 bg-white border-2 border-orange-300 dark:bg-gray-700 rounded-lg shadow-md flex flex-col items-center justify-center">
                                <h3 class="text-lg font-bold text-orange-400">PP</h3>
                                <p class="text-sm dark:text-white">Busto: 48cm</p>
                                <p class="text-sm dark:text-white">Comprimento: 71cm</p>
                            </div>
                            <div class="p-4 bg-white border-2 border-orange-300 dark:bg-gray-700 rounded-lg shadow-md flex flex-col items-center justify-center">
                                <h3 class="text-lg font-bold text-orange-400">P</h3>
                                <p class="text-sm dark:text-white">Busto: 51cm</p>
                                <p class="text-sm dark:text-white">Comprimento: 73cm</p>
                            </div>
                            <div class="p-4 bg-white border-2 border-orange-300 dark:bg-gray-700 rounded-lg shadow-md flex flex-col items-center justify-center">
                                <h3 class="text-lg font-bold text-orange-400">M</h3>
                                <p class="text-sm dark:text-white">Busto: 54cm</p>
                                <p class="text-sm dark:text-white">Comprimento: 75cm</p>
                            </div>
                            <div class="p-4 bg-white border-2 border-orange-300 dark:bg-gray-700 rounded-lg shadow-md flex flex-col items-center justify-center">
                                <h3 class="text-lg font-bold text-orange-400">G</h3>
                                <p class="text-sm dark:text-white">Busto: 57cm</p>
                                <p class="text-sm dark:text-white">Comprimento: 77cm</p>
                            </div>
                            <div class="p-4 bg-white border-2 border-orange-300 dark:bg-gray-700 rounded-lg shadow-md flex flex-col items-center justify-center">
                                <h3 class="text-lg font-bold text-orange-400">GG</h3>
                                <p class="text-sm dark:text-white">Busto: 59cm</p>
                                <p class="text-sm dark:text-white">Comprimento: 79cm</p>
                            </div>
                        </div>
                    </div>

                    <x-divider color="orange" height="1px" width="100%" />

                    <!-- Imagens do evento -->
                    <div>
                        <a class="flex items-center text-xl font-bold dark:text-white mb-4 gap-2" href="https://www.instagram.com/jipe_clube_javalis_do_norte/" target="_blank">
                            <x-instagram-icon width="30" height="30" color="currentColor"/>
                            Imagens dos Últimos Eventos
                        </a>

                        <div class="event-images">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="https://www.instagram.com/p/DCKvgnCpY03/">
                                            <img src="/images/insta/img_1.jpeg" alt="Evento 1" class="w-full rounded-lg shadow">
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="https://www.instagram.com/p/C2Kga7CMOd1/">
                                            <img src="/images/insta/img_2.jpeg" alt="Evento 2" class="w-full rounded-lg shadow">
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="https://www.instagram.com/p/C3hqQBLu_O-/">
                                            <img src="/images/insta/img_3.jpeg" alt="Evento 3" class="w-full rounded-lg shadow">
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="https://www.instagram.com/p/C4Jj5-Nvxye/">
                                            <img src="/images/insta/img_4.jpeg" alt="Evento 3" class="w-full rounded-lg shadow">
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="https://www.instagram.com/p/C2I3ZuVstzo/">
                                            <img src="/images/insta/img_5.jpeg" alt="Evento 3" class="w-full rounded-lg shadow">
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="https://www.instagram.com/p/C2JZH_ftU7_/">
                                            <img src="/images/insta/img_6.jpeg" alt="Evento 3" class="w-full rounded-lg shadow">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="w-full text-center">
                        <button class="ticket-button"
                                onclick="window.location.href='{{ auth()->check() ? route('login') : route('login') }}'">
                            Adquira Já seu ingresso!
                        </button>
                        <small class="mt-1"> Faça login/registre-se para comprar seu ingresso!</small>
                    </div>

                </div>
            </div>
        </div>

    </body>

    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true, // Ativa o modo de loop
            autoplay: {
                delay: 5000, // Tempo entre slides (5 segundos neste exemplo)
                disableOnInteraction: false, // Mantém o autoplay após interações do usuário
                pauseOnMouseEnter: true, // Pausa o autoplay quando o mouse entra na área do slider
                pauseOnLastSlide: true, // Pausa o autoplay na última slide
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 3,
                }
            }
        });
    </script>


</html>

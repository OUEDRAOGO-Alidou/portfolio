<!DOCTYPE html>
<html lang="fr">

    <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Portfolio</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <style>
            footer {
        background: #0f172a;
        color: #fff;
        text-align: center;
        padding: 20px;
        }
        footer a {
            color: #25D366;
            font-size: 20px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #3A86FF, #00C6FF);
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        .btn-outline-light:hover {
            background: white;
            color: #0A2540;
        }

            /* Uniformisation des images dans les cartes projet */
        .portfolio-card img.card-img-top {
            width: 100%;
            height: 220px;          /* hauteur fixe, ajustable */
            object-fit: cover;      /* recadrage intelligent sans déformation */
            object-position: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .portfolio-card img.card-img-top {
                height: 180px;
            }
        }
    </style>

    <!-- =======================================================
    * Template Name: iPortfolio
    * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
    * Updated: Jun 29 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    </head>

    <body class="index-page">

        <header id="header" class="header dark-background d-flex flex-column">
            <i class="header-toggle d-xl-none bi bi-list"></i>

            <div class="profile-img">
                @if(isset($images['profile']))
                    <img src="{{ asset('images/profil1.png') }}" class="img-fluid rounded-circle" alt="Profil">
                @else
                    <img src="{{ asset('images/placeholder.png') }}" class="img-fluid rounded-circle" alt="Profil">
                @endif
            </div>

            <a href="index.html" class="logo d-flex align-items-center justify-content-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">{{ ucwords($information->name) }}</h1>
            </a>

            <div class="social-links text-center">
                <div class="social-links text-center">
                    @foreach(\App\Models\SocialLink::all() as $link)
                        <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-{{ $link->platform }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active"><i class="bi bi-house navicon"></i>Home</a></li>
                <li><a href="#about"><i class="bi bi-person navicon"></i> About</a></li>
                <li><a href="#resume"><i class="bi bi-file-earmark-text navicon"></i> Resume</a></li>
                <li><a href="#portfolio"><i class="bi bi-images navicon"></i> Portfolio</a></li>
                <li><a href="#services"><i class="bi bi-hdd-stack navicon"></i> Services</a></li>
                </li>
                <li><a href="#contact"><i class="bi bi-envelope navicon"></i> Contact</a></li>
            </ul>
            </nav>

        </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
                    {{-- Bannière --}}
            @if(isset($images['banner']))
                <img src="{{ asset('images/banniere.png') }}" alt="Bannière">
            @else
                <img src="{{ asset('images/placeholder.png') }}" alt="Bannière">
            @endif
            <div class="container" data-aos="fade-up" data-aos-delay="100">
            <h2>{{ ucwords($information->name) }}</h2>
            <p>Je suis
                <span class="typed" data-typed-items="Programmeur, Freelanceur, Data analyste, formateur excel "></span>
                <span class="typed-cursor typed-cursor--blink" aria-hidden="true"></span>
                <span class="typed-cursor typed-cursor--blink" aria-hidden="true"></span>
            </p>
                <div class="mt-10">
                    <a href="{{ route('documents.index')}}"
                    class="btn btn-primary btn-lg me-2"
                    target="_blank">
                    📄 Télécharger mon CV
                    </a>
                    <a href="#contact" class="btn btn-outline-light btn-lg">
                    Me contacter
                    </a>
                </div>
            </div>
        </section><!-- /Hero Section -->

        <!-- About Section -->

        <section id="about" class="about section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>À propos</h2>
                <div>{!! $info['intro_text'] !!}</div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 justify-content-center">
            <div class="col-lg-4">
                {{-- Image about --}}
                    @if(isset($images['about']))
                        <img src="{{ asset('images/photo1.png')}}" class="img-fluid" alt="About">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" class="img-fluid" alt="About">
                    @endif
            </div>
            <div class="col-lg-8 content">
                    <h2>{{ $info['job_title'] }}</h2>
                <div class="py-3"> {!! $info['intro_title'] !!}</div>
                <div class="row">
                <div class="col-lg-6">
                    <ul>
                    <li><i class="bi bi-chevron-right"></i> <strong>Date naissance:</strong> <span>{{ \Carbon\Carbon::parse($information->dateNaiss)->format('d-m-Y') }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Web:</strong> <span>
                        @if($information->site)
                            <a href="{{ $information->site }}" target="_blank" rel="noopener noreferrer">
                                {{ $information->site }}
                            </a>
                        @else
                            <span>Non renseigné</span>
                        @endif
                    </span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Téléphone:</strong> <span>{{ $information->phone }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span>{{ $information->city }}, Burkina Faso</span></li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul>
                    <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span>{{ $information->dateNaiss->age }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Dilpôme:</strong> <span>{{ $information->diplome }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span>{{ $information->email }}</span></li>
                    <li><i class="bi bi-chevron-right"></i> <strong>Freelance:</strong> <span>{{ $information->freelance == 'tru' ? 'Non disponible' : 'Disponible' }}</span></li>
                    </ul>
                </div>
                </div>
                <div  class="py-3">
                    {!! $info['expertise_text'] !!}
                    <div class="mt-4">
                       <a href="{{ route('documents.index')}}"
                        class="btn btn-primary btn-lg me-2"
                        target="_blank">
                        📄 Télécharger mon CV
                        </a>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </section><!-- /About Section -->

        <!-- Stats Section -->

        <section id="stats" class="stats section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Mes performances</h2>
                 <div>{!! $info['performance_text'] !!}</div>

            </div>
            <div class="container" data-aos="fade-up">
                <div class="row gy-4 text-center">

                    @foreach($stats as $stat)
                        <div class="col-lg-3 col-md-6">
                            <div class="stats-item">
                                @if($stat->link)
                                    <a href="{{ $stat->link }}">
                                        <i class="bi {{ $stat->icon }}"></i>
                                    </a>
                                @else
                                    <i class="bi {{ $stat->icon }}"></i>
                                @endif
                                <span class="purecounter" data-purecounter-end="{{ $stat->value }}"></span>
                                <p><strong>{{ $stat->title }}</strong></p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        <!-- ======= Projets Section ======= -->
<section id="portfolio" class="portfolio section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Mes réalisations</h2>
        <div> {!! $info['realisation_text'] !!} </div>
        <p>Découvrez une sélection de projets web, data et automatisation que j’ai menés avec succès.</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
       <!-- Filtres dynamiques -->
        <div class="portfolio-filters text-center mb-4">
            <ul class="filter-nav">
                <li class="filter-active" data-filter="*">Tous</li>
                @foreach($categories as $cat)
                    <li data-filter=".filter-{{ Str::slug($cat) }}">{{ $cat }}</li>
                @endforeach
            </ul>
        </div>

        <div class="row portfolio-container gy-4">
            @forelse($projects as $project)
                <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $project->categorie_slug }}">
                    <div class="portfolio-card h-100">

                        @if($project->image && file_exists(public_path($project->image)))
                        <img src="{{ asset($project->image) }}" class="card-img-top" style="height: 220px; object-fit: cover; width: 100%;" alt="{{ $project->title }}">
                        @else
                            <img src="{{ asset('images/project-placeholder.png') }}" class="card-img-top" alt="Placeholder" >
                        @endif
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">{{ $project->categorie }}</span>
                            <h4 class="card-title">{{ $project->title }}</h4>
                            <p class="card-text">{{ Str::limit($project->description, 100) }}</p>
                            <div class="technos mb-3">
                                @foreach($project->technologies as $tech)
                                    <span class="badge bg-light text-dark me-1">{{ $tech }}</span>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ $project->lien }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-box-arrow-up-right"></i> Voir le projet
                                </a>
                                @if($project->chiffre_cle)
                                    <small class="text-success"><i class="bi bi-graph-up"></i> {{ $project->chiffre_cle }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Aucun projet affiché pour le moment. Revenez bientôt !</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

        <!-- Skills Section -->

        <section id="skills" class="skills section light-background">
            <div class="container section-title" data-aos="fade-up">
                <h2>Compétences</h2>
                <div> {!! $info['competence_text'] !!}</div>
            </div>

            <div class="container">
                <div class="row">
                    @php
                        // Séparer les compétences en deux colonnes (moitié chacune)
                        $skillsChunk = $skills->chunk(ceil($skills->count() / 2));
                    @endphp

                    @foreach($skillsChunk as $chunk)
                        <div class="col-lg-6">
                            @foreach($chunk as $skill)
                                <div class="progress">
                                    <span class="skill">
                                        @if($skill->icon)<i class="{{ $skill->icon }} me-2"></i>@endif
                                        {{ $skill->name }}
                                        <i class="val">{{ $skill->percentage }}%</i>
                                    </span>
                                    <div class="progress-bar-wrap">
                                        <div class="progress-bar" style="width: {{ $skill->percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Resume Section -->

        <section id="resume" class="resume section">

            <div class="container section-title">
                <h2>Mon parcours</h2>
                <div> {!! $info['parcour_text'] !!}</div>
            </div>

            <div class="container">

                <div class="row">

                <div class="col-lg-6">
                    <h3 class="resume-title">Profil</h3>

                    <div class="resume-item pb-0">
                    <h4>{{ strtoupper($information->name) }}</h4>
                    <div> {!! $info['profile_text'] !!}</div>
                    <ul>
                        <li>{{ $information->city }}, Burkina Faso</li>
                        <li>{{ $information->phone }}</li>
                        <li>{{ $information->email }}</li>
                    </ul>
                    </div>

                    <h3 class="resume-title">Formation</h3>
                @forelse($formations as $formation)
                    <div class="resume-item">
                        @if($formation->icon)
                            <i class="{{ $formation->icon }} me-2"></i>
                        @endif
                        <h4>{{ $formation->diplome }}</h4>
                        <h5>{{ $formation->annee }}</h5>
                        <p>{{ $formation->description }}</p>
                    </div>
                    @empty
                    <div class="resume-item">
                        <p>Aucune formation renseignée.</p>
                    </div>
                    @endforelse

                </div>

                    <div class="col-lg-6">
                        <h3 class="resume-title">Expériences</h3>
                    @forelse($experiences as $experience)
                        <div class="resume-item">
                            @if($experience->icon)
                                <i class="{{ $experience->icon }} me-2"></i>
                            @endif
                        <h4>{{ $experience->titre }}</h4>
                            <p>{{ $experience->description }}</p>
                        </div>
                        @empty
                        <div class="resume-item">
                            <p>Aucune expérience renseignée.</p>
                        </div>
                    @endforelse
                    </div>


                </div>
                </div>
            </div>
        </section>

        <!-- Portfolio Section -->
        <section id="services" class="services section">

            <div class="container section-title">
                <h2>Mes services</h2>
                <div> {!! $info['service_text'] !!}</div>
            </div>

        <div class="container">
            <div class="row gy-4">
                @forelse($services as $service)
                    <div class="col-lg-4">
                        <div class="service-item">
                            @if($service->icon)
                                <i class="{{ $service->icon }}"></i>
                            @else
                                <i class="bi bi-tools"></i> {{-- icône par défaut --}}
                            @endif
                            <h4>{{ $service->title }}</h4>
                            <p>{{ $service->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">Aucun service disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
        </section>

        <section id="testimonials" class="testimonials section light-background">
            <div class="container section-title" data-aos="fade-up">
                <h2>Témoignages</h2>
                <div> {!! $info['temoin_text'] !!}</div>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": { "delay": 5000 },
                            "slidesPerView": "auto",
                            "pagination": { "el": ".swiper-pagination", "clickable": true },
                            "breakpoints": {
                                "320": { "slidesPerView": 1, "spaceBetween": 40 },
                                "1200": { "slidesPerView": 3, "spaceBetween": 1 }
                            }
                        }
                    </script>
                    <div class="swiper-wrapper">
                        @forelse($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>{{ $testimonial->message }}</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                @if($testimonial->image)
                                    <img src="{{ asset($testimonial->image) }}" class="testimonial-img" alt="{{ $testimonial->name }}">
                                @else
                                    <img src="https://via.placeholder.com/100" class="testimonial-img" alt="placeholder">
                                @endif
                                <h3>{{ $testimonial->name }}</h3>
                                <h4>{{ $testimonial->position }}</h4>
                            </div>
                        </div>
                        @empty
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p>Aucun témoignage pour le moment.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>



    <!-- Contact Section -->
        <section id="contact" class="contact section">

        <div class="container section-title">
            <h2>Contact</h2>
            <div> {!! $info['contact_text'] !!}</div>
        </div>
        <div class="container">
            <div class="row">
            <div class="col-lg-5">
                <div class="info-wrap">
                <p><strong>📍 Ville :</strong> {{ $information->city }}</p>
                <p><strong>📞 Téléphone :</strong> {{ $information->phone }}</p>
                <p><strong>📧 Email :</strong> {{ $information->email }}</p>
                <a href="{{ route('documents.index')}}"
                    class="btn btn-primary btn-lg me-2"
                    target="_blank">
                    📄 Télécharger mon CV
                    </a>
                <a href="https://wa.me/22667107210"
                    class="btn btn-success mt-3">
                    💬 Discuter sur WhatsApp
                </a>
                </div>
            </div>
            <div class="col-lg-7">
                <form action="{{ route('contact.store') }}" method="POST">
                @csrf

                <input type="text" name="name" placeholder="Nom" class="form-control mb-3" required>
                <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
                <textarea name="message" placeholder="Message" class="form-control mb-3" required></textarea>

                <button type="submit" class="btn btn-primary w-100">
                    Envoyer le message
                </button>

                </form>

            </div>

            </div>

        </div>

        </section>


    </main>

    <footer id="footer" class="footer position-relative light-background">

        <div class="container">
            <div class="copyright text-center ">
                <p>
        © <span>{{ date('Y') }}</span>
        <strong class="px-1 sitename">FlashNovaTech</strong>
        | Tous droits réservés
        </p>

        <p class="mt-2">
        Développé avec ❤️ par
        <strong>OUEDRAOGO ALIDOU</strong>
        | Développeur Web • Analyste de Données • Freelance
        </p>
        <p class="mt-2 text-muted">
            Disponible pour missions freelance et opportunités professionnelles
        </p>

        <div class="mt-3">
        <a href="https://wa.me/22667107210" target="_blank" class="me-2">
            <i class="bi bi-whatsapp"></i>
        </a>
        <a href="mailto:alidouaisti@gmail.com" class="me-2">
            <i class="bi bi-envelope"></i>
        </a>
        <a href="https://www.linkedin.com/in/alidou-ouedraogo-14855a278/" class="me-2">
            <i class="bi bi-linkedin"></i>
        </a>
        </div>
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- popup personalisé-->

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ (asset('vendor/typed.js/typed.umd.js')) }}"></script>
    <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Dans <head> ou avant la fermeture de </body> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

         // Init Isotope
        let portfolioContainer = document.querySelector('.portfolio-container');
        if (portfolioContainer) {
            let isotope = new Isotope(portfolioContainer, {
                itemSelector: '.portfolio-item',
                layoutMode: 'fitRows'
            });

            let filterNav = document.querySelectorAll('.portfolio-filters li');
            filterNav.forEach(button => {
                button.addEventListener('click', function(e) {
                    let filterValue = this.getAttribute('data-filter');
                    isotope.arrange({ filter: filterValue });
                    filterNav.forEach(btn => btn.classList.remove('filter-active'));
                    this.classList.add('filter-active');
                });
            });
        }

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès !',
                text: '{{ session('success') }}',
                confirmButtonColor: '#10b981',
                timer: 3000,
                showConfirmButton: true
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: '{{ session('error') }}',
                confirmButtonColor: '#ef4444',
                timer: 4000
            });
        @endif
    </script>
    </body>
</html>

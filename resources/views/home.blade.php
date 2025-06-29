<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Window & Door Replacement - Complete Page</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
</head>

<body>
    <header class="top-header">
        <div class="container-fluid">
            <div>
                <a href="./landing.html"><img src="{{ asset('frontend/img/logo.webp') }}" alt="Company Logo" class="header-logo"></a>
            </div>

            <div class="header-text-content">
                <span>Proudly Serving Houston Metroplex</span>
                <span class="discount-line">
                    <i class="bi bi-arrow-right"></i> Get 20% Off Your New Premium Vinyl Windows
                </span>
            </div>

            <div class="header-call-button">
                <a href="tel:910.240.2269" class="btn btn-danger">CALL NOW</a>
            </div>
        </div>
    </header>
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1>20% OFF</h1>
                    <h2>Your New Premium Vinyl Windows & Doors</h2>
                    <p class="lead">No Payments, No Interest for 12 Months*</p>
                    <div class="hero-form-container" id="hero-form">
                        <div class="discount-logo">
                            <img src="{{ asset('frontend/img/discount.webp') }}" alt="">
                        </div>
                        <h3>Request A Quote <br> with Store {{ $campaign->shop->name }}</h3>
                        <form action="{{ route('quote.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                            @if (!$fields->isEmpty())
                                @foreach ($fields as $field)
                                    <div class="mb-3">
                                        {{-- <label class="form-label">
                                                {{ $field->label }}
                                                @if ($field->required)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label> --}}

                                        @switch($field->type)
                                            @case('text')
                                            @case('email')

                                            @case('date')
                                                <input type="{{ $field->type }}" name="{{ $field->name }}" class="form-control" placeholder="{{ $field->label }}"
                                                    value="{{ old($field->name) }}">
                                            @break

                                            @case('number')
                                                <input type="{{ $field->type }}" name="{{ $field->name }}" min="3" class="form-control" placeholder="{{ $field->label }}"
                                                    value="{{ old($field->name) }}">
                                            @break

                                            @case('textarea')
                                                <textarea name="{{ $field->name }}" class="form-control" placeholder="Enter {{ $field->label }} here" style="height: 100px">{{ old($field->name) }}</textarea>
                                            @break

                                            @case('select')
                                                <label class="form-label">
                                                    {{ $field->label }}
                                                    @if ($field->required)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>

                                                <select name="{{ $field->name }}" class="form-select form-control">
                                                    <option value="">--Select--</option>
                                                    @foreach ($field->options ?? [] as $opt)
                                                        <option value="{{ $opt }}">{{ $opt }}</option>
                                                    @endforeach
                                                </select>
                                            @break

                                            @case('radio')
                                                <label class="form-label">
                                                    {{ $field->label }}
                                                    @if ($field->required)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>

                                                @foreach ($field->options ?? [] as $opt)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="{{ $field->name }}" value="{{ $opt }}">
                                                        <label class="form-check-label">{{ $opt }}</label>
                                                    </div>
                                                @endforeach
                                            @break

                                            @case('checkbox')
                                                <label class="form-label">
                                                    {{ $field->label }}
                                                    @if ($field->required)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>

                                                @foreach ($field->options ?? [] as $opt)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="{{ $field->name }}[]" value="{{ $opt }}">
                                                        <label class="form-check-label">{{ $opt }}</label>
                                                    </div>
                                                @endforeach
                                            @break
                                        @endswitch

                                        @error($field->name)
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @endforeach
                            @endif
                            <button type="submit" class="btn btn-warning btn-lg w-100">Get Your Free Quote</button>
                        </form>
                    </div>
                    <p class="mt-3 text-white terms-modal" data-bs-toggle="modal" data-bs-target="#promoModal">
                        <small>Get a chance to win 3 free windows when you get your in-home quote!</small>
                    </p>

                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="promoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content position-relative p-4">
                <!-- Close button (X) in the top-right -->
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                    aria-label="Close"></button>

                <!-- Modal body with your content -->
                <div class="modal-body">
                    <p><strong>How to Win:</strong></p>
                    <ul>
                        <li>Schedule your free in-home quote.</li>
                        <li>Agree to a no-hassle demo.</li>
                        <li>You're entered into the drawing!</li>
                    </ul>

                    <p><strong>If You Win:</strong></p>
                    <ul>
                        <li>Choose from Double Hung, Single Hung, Sliders, or Picture Windows (up to 110 United Inches)
                        </li>
                        <li>Pick from Simonton, Gentek, or MI</li>
                        <li>White or Almond finish included (other colors +$200 each)</li>
                    </ul>

                    <p><strong>Good to Know:</strong></p>
                    <p>
                        Already bought? If you win, we’ll deduct 3 windows from your bill! Houston-area homeowners only.
                        Winner drawn live on Facebook – June 27th. No purchase necessary. Entry requires a free,
                        no-pressure demo & quote.
                        Shapes, Casements, Awnings, and specialty glass not included. Other conditions may apply.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <section class="master-linx-section">
        <div class="container">
            <h2 class="text-center">MASTER LINX WINDOW & DOOR SYSTEMS</h2>
            <div class="row align-items-center">
                <div class="col-md-6 order-md-1 order-2">
                    <div class="master-linx-main-image">
                        <img src="{{ asset('frontend/img/se1.jpg') }}" alt="House with Windows" class="img-fluid">
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="master-linx-thumbnail">
                                <img src="{{ asset('frontend/img/w1.webp') }}" alt="Window Style A" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="master-linx-thumbnail">
                                <img src="{{ asset('frontend/img/w2.webp') }}" alt="Window Style B" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="master-linx-thumbnail">
                                <img src="{{ asset('frontend/img/w3.webp') }}" alt="Window Style C" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-start order-md-2 order-1 mb-4 mb-md-0">
                    <h3 class="mb-3">Your #1 Window Replacement & Installation Experts In The Metro Area</h3>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Energy-Efficient Designs for Lower
                            Bills</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Durable, Low-Maintenance Vinyl
                            Materials</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Expert Installation by Certified
                            Professionals</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Wide Range of Styles to Match Your
                            Home</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Industry-Leading Warranties for
                            Peace of Mind</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Enhanced Home Security and Comfort
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </section>

    <section class="window-styles-section">
        <div class="container">
            <h2 class="text-center">Explore Our Window Styles</h2>
            <div class="window-grid-container">
                <div class="window-style-item">
                    <div class="window-style-icon">
                        <img src="{{ asset('frontend/img/p1.webp') }}" alt="Double & Single Hung" class="open-modal"
                            data-group="group1">
                    </div>
                    <p>Double &amp; Single Hung</p>
                </div>

                <div class="window-style-item">
                    <div class="window-style-icon">
                        <img src="{{ asset('frontend/img/p2.webp') }}" alt="Bay & Bow Windows" class="open-modal" data-group="group2">
                    </div>
                    <p>Bay &amp; Bow Windows</p>
                </div>

                <div class="window-style-item">
                    <div class="window-style-icon">
                        <img src="{{ asset('frontend/img/p3.webp') }}" alt="Casement & Awning" class="open-modal" data-group="group3">
                    </div>
                    <p>Casement &amp; Awning</p>
                </div>

                <div class="window-style-item">
                    <div class="window-style-icon">
                        <img src="{{ asset('frontend/img/p4.webp') }}" alt="Slider Windows" class="open-modal" data-group="group4">
                    </div>
                    <p>Slider Windows</p>
                </div>
                <div class="window-style-item">
                    <div class="window-style-icon">
                        <img src="{{ asset('frontend/img/p5.webp') }}" alt="Slider Windows" class="open-modal" data-group="group5">
                    </div>
                    <p>Picture Windows</p>
                </div>
                <div class="window-style-item">
                    <div class="window-style-icon">
                        <img src="{{ asset('frontend/img/p6.webp') }}" alt="Slider Windows" class="open-modal" data-group="group6">
                    </div>
                    <p>Architectural Windows</p>
                </div>

            </div>
        </div>
    </section>
    <!-- ✅ Bootstrap Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close btn-close-black img-close position-absolute top-0 end-0 m-3"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row g-3" id="modalImageGrid">
                        <!-- Images will be injected here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container certification-section">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12">
                    <div class="certification-text-content">
                        <h2>TOP-RATED &<br>CERTIFIED</h2>
                        <p>Because we care about the quality of service provided to each one of our valuable customers.
                        </p>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 mt-4 mt-lg-0">
                    <div class="badges-grid">
                        <div class="badge-item">
                            <img src="{{ asset('frontend/img/logo1.webp') }}" alt="BBB A+ Rating">
                        </div>
                        <div class="badge-item">
                            <img src="{{ asset('frontend/img/logo2.webp') }}" alt="Good Contractors">
                        </div>
                        <div class="badge-item">
                            <img src="{{ asset('frontend/img/logo3.webp') }}" alt="HomeAdvisor Top Rated">
                        </div>
                        <div class="badge-item">
                            <img src="{{ asset('frontend/img/logo4.webp') }}" alt="Elite Service">
                        </div>
                        <div class="badge-item">
                            <img src="{{ asset('frontend/img/logo5.webp') }}" alt="HomeAdvisor Screened & Approved">
                        </div>
                        <div class="badge-item">
                            <img src="{{ asset('frontend/img/logo6.webp') }}" alt="Best of 2018 Winner">
                        </div>
                        <div class="badge-item">
                            <img src="{{ asset('frontend/img/logo7.webp') }}" alt="5 Years HomeAdvisor Screened & Approved">
                        </div>
                        <div class="badge-item">
                            <img src="{{ asset('frontend/img/logo8.webp') }}" alt="Thumbtack Top Pro">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-dark-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2>20% OFF</h2>
                    <p class="lead">Your New Premium Vinyl Windows & Doors</p>
                    <p class="mb-4">No Payments, No Interest for 12 Months*</p>
                    <h3>Request Your Free In-Home Window Replacement Quote Today!</h3>
                    <div class="d-flex flex-column flex-md-row justify-content-center mt-4">
                        <a href="tel:910.240.2269" class="btn btn-warning btn-lg me-md-3 mb-3 mb-md-0">CALL NOW</a>
                        <a href="#hero-form" class="btn btn-outline-light btn-lg">Get A Free Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="company-info-section">
        <div class="container">
            <h2 class="text-center satisfaction">YOUR SATISFACTION<br> IS OUR #1 GOAL</h2>
            <div class="row justify-content-around">
                <div class="col-md-5 col-lg-4 company-info-item mb-4 mb-md-0">
                    <div class="company-info-icon">
                        <img src="{{ asset('frontend/img/setisfiction.webp') }}" alt="">
                    </div>
                    <p>Rest assured that the project is not complete until you’re <b>100% satisfied.</b></p>
                </div>
                <div class="col-md-5 col-lg-4 company-info-item">
                    <div class="company-info-icon">
                        <img src="{{ asset('frontend/img/warrenty.webp') }}" alt="">
                    </div>
                    <p>All of our products are backed by <b>lifetime transferable warranties</b> giving you peace of
                        mind</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonial-section">
        <div class="container">
            <h2 class="text-center">OUR CUSTOMERS RAVE ABOUT THE<br> QUALITY OF OUR PRODUCTS & SERVICES</h2>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5 mb-4 mb-md-0">
                    <div class="testimonial-image-placeholder">
                        <img src="{{ asset('frontend/img/picture-windows.jpg') }}" alt="Satisfied Customer 1" class="img-fluid">
                    </div>
                    <p class="testimonial-text text-center">"Great experience working with Bella Vista! Paco and his
                        crew did a great job installing the 11 windows I ordered. Very satisfied with the cost, the
                        production time (about 5-6 weeks), and the installation process. Would highly encourage anyone
                        to at least get bid from BV if you are looking to replace your windows." <br> <strong>P
                            A</strong> <span>Houston, TX</span></p>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="testimonial-image-placeholder">
                        <img src="{{ asset('frontend/img/review2.jpg') }}" alt="Satisfied Customer 2" class="img-fluid">
                    </div>
                    <p class="testimonial-text text-center">""Probably the best place in Houston for your windows in
                        terms of price-quality-service combination. We are very happy with what we got for the price (we
                        replaced all windows). Highly recommend!" <br> <strong>Denys Bulikhov</strong> <span>Houston,
                            TX</span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="offer-windows">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <p class="mb-1 text-white">20% OFF Your New Premium Vinyl Windows & Doors</p>
                    <p class="mb-1 text-white">No Payments, No Interest for 12 Months*</p>
                    <p class="mb-3 text-white">Request Your Free In-Home Window Replacement Quote Today!</p>
                    <div class="d-flex flex-column flex-md-row justify-content-center mt-3">
                        <a href="tel:910.240.2269" class="btn btn-warning btn-lg me-md-3 mb-3 mb-md-0">CALL NOW</a>
                        <a href="#hero-form" class="btn btn-outline-light btn-lg">GET MY FREE QUOTE</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <div class="footer-logo">
                            <img src="{{ asset('frontend/img/logo-black.webp') }}" alt="Bella Vista Windows and Doors Logo">
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="footer-copyright mb-0">2025 &copy; Bella Vista Windows and Doors | All rights reserved
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center">
                    <span class="please-note-icon">&#x24D8;</span>
                    <div class="please-note-text">
                        <strong>Please Note:</strong> We require a minimum of 3 windows per project. We do not repair broken glass, sell parts or materials, <br />or offer repairs
                        on products we have not installed.
                    </div>
                </div>
            </div>
        </div>

        <!-- On-Load Modal -->

    </footer>

    <!-- ✅ Bootstrap Bundle FIRST -->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>

    <!-- ✅ THEN your custom script -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

</body>

</html>

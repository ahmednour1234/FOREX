
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap');

    .search-container .form-control {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .search-container .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .search-container .btn {
        background-color: #E73780;
        border: none;
    }

    .page-header__inner {
        text-align: center;
        padding: 60px 0;
    }

    #typed-title {
        display: inline-block;
        overflow: hidden;
        white-space: nowrap;
        border-right: 3px solid #FFE986;
        font-family: 'Montserrat', sans-serif;
        font-size: 60px;
        background: linear-gradient(90deg, #FFE986 0%, #C48127 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: blink-caret 0.75s step-end infinite;
    }

    #typed-title.finished {
        border-right: none;
        animation: none;
    }

    @keyframes blink-caret {
        0%, 100% { border-color: transparent; }
        50% { border-color: #FFE986; }
    }

    .section-title-responsive {
        font-size: 60px;
        width: 80%;
        max-width: 800px;
        font-weight: 800;
        background: linear-gradient(90deg, #fff, #fff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 0 auto 40px auto;
        line-height: 1.3;
    }

    @media (max-width: 1365px) {
        #typed-title { font-size: 60px; }
    }

    @media (max-width: 1023px) {
        #typed-title { font-size: 42px; }
    }

    @media (max-width: 767.98px) {
        #typed-title { font-size: 32px; }
        .section-title-responsive { font-size: 40px !important; }
    }

    .desktop-only { display: none; }
    .mobile-only-page { display: none; }

    @media (min-width: 768px) {
        .desktop-only { display: block; }
    }

    @media (max-width: 767.98px) {
        .mobile-only-page { display: block; }
    }
     #searchInput {
    display: none !important;
}
</style>


<div class="desktop-only">
    @include('web.content.partials.voting-desktop', ['companies' => $companies])
</div>

<!-- Mobile Section -->
<div class="mobile-only-page">
    @include('web.content.partials.voting-mobile', ['companies' => $companies])
</div>

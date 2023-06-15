<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item waves-effect1"
    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php
            if (LaravelLocalization::getCurrentLocale() == 'en') {
                $flag = 'en.jpg';
            } else {
                $flag = 'ar.jpg';
            }
        ?>
        <img id="header-lang-img2" src="{{ asset('assets') }}/images/flags/{{$flag}}" alt="Header Language" height="16">
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <?php
                if ($localeCode == 'en') {
                    $newFlag = 'en.jpg';
                } else {
                    $newFlag = 'ar.jpg';
                }
            ?>
            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="dropdown-item language_itemw">
                <img src="{{ asset('assets') }}/images/flags/{{$newFlag}}" alt="user-image" height="12" style="margin-right: 5px;"> 
                <span class="align-middle">{{ $properties['native'] }}</span>
            </a>
        @endforeach
    </div>
</div>
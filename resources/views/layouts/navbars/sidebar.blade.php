<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo justify-content-center text-center">
            <a href="#" class="simple-text logo-normal">{{ __('LOGO') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-bar-32"></i>
                    <p>{{ __('Accueil') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="{{ route('profile.edit')  }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('Profile utilisateur') }}</p>
                </a>
            </li>
          
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="tim-icons icon-laptop" ></i>
                    <span class="nav-link-text" >{{ __('Gestion des départements') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'gm') class="active " @endif>
                            <a href="{{ route('gm')  }}">
                                <i class="tim-icons icon-minimal-right"></i>
                                <p>{{ __('Génie Mécanique') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'gp') class="active " @endif>
                            <a href="{{ route('gp')  }}">
                                <i class="tim-icons icon-minimal-right"></i>
                                <p>{{ __('Génie Procédés') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>

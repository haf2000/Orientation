<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo justify-content-center text-center">
            <a href="#" class="simple-text logo-normal">{{ __('LOGO') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-align-left-2"></i>
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

          <li>
                <a data-toggle="collapse" href="#laravel-exampl" aria-expanded="true">
                    <i class="tim-icons icon-laptop" ></i>
                    <span class="nav-link-text" >{{ __('Statistiques') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-exampl">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'stat') class="active " @endif>
                            <a href="{{ route('stat')  }}">
                                <i class="tim-icons icon-minimal-right"></i>
                                <p>{{ __('Statistiques GM') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'stat2') class="active " @endif>
                            <a href="{{ route('stat2')  }}">
                                <i class="tim-icons icon-minimal-right"></i>
                                <p>{{ __('Statistiques GP') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>

<section class="navbar custom-navbar navbar-fixed-top" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>

            <!-- lOGO TEXT HERE -->
            <p class="navbar-brand">True Friend Clinic</p>
        </div>

        <!-- MENU LINKS -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">


                @if(!session()->has('user'))
                    <li><a href="{{ url('/') }}" class="smoothScroll">Home</a></li>

                @elseif(session()->get("user")->idRole==1)
                    <li><a href="{{ url('/admin') }}" class="smoothScroll">Admin</a></li>
                    <li><a href="{{ url('/logout') }}" class="smoothScroll">Logout</a></li>
                @elseif(session()->get("user")->idRole==2)
                    <li><a href="{{ url('/doctor') }}" class="smoothScroll">{{ session()->get('user')->firstName }}</a></li>
                    <li><a href="{{ url('/logout') }}" class="smoothScroll">Logout</a></li>
                @else
                    <li><a href="{{ url('/user') }}" class="smoothScroll">{{ session()->get('user')->firstName }}</a></li>
                    <li><a href="{{ url('/logout') }}" class="smoothScroll">Logout</a></li>
                @endif
                <li><a href="{{ url('/contact') }}" class="smoothScroll">Contact</a></li>
                <li><a href="{{ url('/author') }}" class="smoothScroll">Author</a></li>
            </ul>
        </div>

    </div>
</section>

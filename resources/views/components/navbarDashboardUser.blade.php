<nav class="bg-white shadow-lg">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <!-- Logo -->
      <div class="flex-shrink-0 flex items-center">
        <img class="block h-8 w-auto" src="\img\logo2.png" alt="Logo">
      </div>

      <!-- Menu kanan untuk md ke atas -->
      <div class="hidden md:flex md:items-center space-x-6">
        <a href="#" class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">Home</a>
        <a href="#" class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">About Us</a>
        <a href="#" class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">Artikel</a>
        <a href="{{ route('pemesanan.create') }}" class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">Pricing</a>

        <!-- Dropdown Screening -->
        <div class="relative group">
          <button class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium flex items-center">
            Screening
            <svg class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
            <a href="{{ route('screening') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Screening Penyakit Durian</a>
            <a href="{{ route('screening.jenis') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Screening Jenis Durian</a>
          </div>
        </div>

        <!-- Dropdown Profile -->
        <div class="relative group">
          <button class="text-gray-900 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium flex items-center">
            Profile
            <svg class="ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Profil</a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Riwayat Pemesanan Tiket</a>
            <a href="#" id="logout-link" class="block px-3 py-2 text-base text-gray-600 hover:bg-gray-100">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            </div>
        </div>
      </div>

      <!-- Hamburger untuk mobile (md kebawah) -->
      <div class="md:hidden flex items-center">
        <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
          <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Menu Mobile -->
  <div class="md:hidden hidden" id="mobile-menu">
    <div class="px-2 pt-2 pb-3 space-y-1">
      <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-100">Home</a>
      <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-100">About Us</a>
      <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-100">Artikel</a>
      <a href="{{ route('pemesanan.create') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-100">Pricing</a>
      <button onclick="toggleDropdown('screening-dropdown')" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-100 flex items-center justify-between">
        Screening
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </button>
      <div id="screening-dropdown" class="hidden ml-4 space-y-1">
        <a href="{{ route('screening') }}" class="block px-3 py-2 text-base text-gray-600 hover:bg-gray-100">Screening Penyakit Durian</a>
        <a href="{{ route('screening.jenis') }}" class="block px-3 py-2 text-base text-gray-600 hover:bg-gray-100">Screening Jenis Durian</a>
      </div>

      <button onclick="toggleDropdown('profile-dropdown')" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-100 flex items-center justify-between">
        Profile
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </button>
      <div id="profile-dropdown" class="hidden ml-4 space-y-1">
        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-base text-gray-600 hover:bg-gray-100">Profil</a>
        <a href="#" class="block px-3 py-2 text-base text-gray-600 hover:bg-gray-100">Riwayat Pemesanan Tiket</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="block px-3 py-2 text-base text-gray-600 hover:bg-gray-100 w-full text-left">
                Logout
            </button>
        </form>

      </div>
    </div>
  </div>
</nav>

<script>
  const mobileButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  mobileButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });

  function toggleDropdown(id) {
    document.getElementById(id).classList.toggle('hidden');
  }

    document.addEventListener('DOMContentLoaded', function() {
        var logoutLink = document.getElementById('logout-link');
        logoutLink.addEventListener('click', function(e) {
            e.preventDefault(); // cegah href default
            document.getElementById('logout-form').submit();
        });
    });
</script>

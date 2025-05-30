<div
    id="sidebar"
    class="bg-green-600 h-screen p-5 pt-8 w-72 duration-300 relative text-white"
>
    <div
        id="toggleButton"
        class="bg-green-600 text-white text-xl rounded-sm absolute top-4 -right-8 cursor-pointer flex items-center justify-center w-9 h-8 shadow-md hover:bg-green-700 transition-colors z-50"
        style="border: none; outline: none"
    >
        <i class="fas fa-chevron-left"></i>
    </div>
    <div class="flex items-center gap-4">
        <img src="/img/logoDurian.png" alt="Logo Durian" class="w-10 h-10" />
        <h1
            id="sidebarTitle"
            class="text-white text-xl font-semibold transition-all duration-300"
        >
            D-Durens
        </h1>
    </div>

    <ul class="mt-10 space-y-2">
        <li>
            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-4 hover:bg-green-700 p-2 rounded-lg"
            >
                <i class="fas fa-home min-w-[24px] text-center"></i>
                <span
                    class="sidebar-label transition-all duration-300 overflow-hidden whitespace-nowrap"
                    >Dashboard</span
                >
            </a>
        </li>
        <li class="relative" data-dropdown="akun">
            <div
                class="flex items-center gap-4 hover:bg-green-700 p-2 rounded-lg"
            >
                <i class="fas fa-user min-w-[24px] text-center"></i>
                <span
                    class="sidebar-label transition-all duration-300 overflow-hidden whitespace-nowrap"
                    >Data Akun</span
                >
                <i
                    class="fas fa-chevron-down ml-auto sidebar-label transition-all duration-300"
                ></i>
            </div>
            <ul class="ml-8 mt-1 space-y-1 dropdown-menu hidden">
                <li>
                    <a href="{{ route('admin.akunUser') }}" class="block hover:bg-green-700 p-2 rounded-lg"
                        >Data Akun User</a
                    >
                </li>
                <li>
                    <a href="{{ route('admin.akunAdmin') }}" class="block hover:bg-green-700 p-2 rounded-lg"
                        >Data Akun Admin</a
                    >
                </li>
            </ul>
        </li>
        <li class="relative" data-dropdown="screening">
            <div
                class="flex items-center gap-4 hover:bg-green-700 p-2 rounded-lg"
            >
                <i class="fas fa-stethoscope min-w-[24px] text-center"></i>
                <span
                    class="sidebar-label transition-all duration-300 overflow-hidden whitespace-nowrap"
                    >Screening</span
                >
                <i
                    class="fas fa-chevron-down ml-auto sidebar-label transition-all duration-300"
                ></i>
            </div>
            <ul class="ml-8 mt-1 space-y-1 dropdown-menu hidden">
                <li>
                    <a href="{{ route('admin.screeningPenyakit') }}" class="block hover:bg-green-700 p-2 rounded-lg"
                        >Screening Penyakit Durian</a
                    >
                </li>
                <li>
                    <a href="#" class="block hover:bg-green-700 p-2 rounded-lg"
                        >Screening Jenis Durian</a
                    >
                </li>
            </ul>
        </li>
        <li>
            <a
                href="{{ route('admin.pemesanan') }}"
                class="flex items-center gap-4 hover:bg-green-700 p-2 rounded-lg"
                ><i class="fas fa-ticket-alt min-w-[24px] text-center"></i
                ><span
                    class="sidebar-label transition-all duration-300 overflow-hidden whitespace-nowrap"
                    >Log Pemesanan Tiket</span
                ></a
            >
        </li>
        <li>
            <a
                href="{{ route('inventaris.index') }}"
                class="flex items-center gap-4 hover:bg-green-700 p-2 rounded-lg"
                ><i class="fas fa-box min-w-[24px] text-center"></i
                ><span
                    class="sidebar-label transition-all duration-300 overflow-hidden whitespace-nowrap"
                    >Inventaris</span
                ></a
            >
        </li>
        <li>
            <a
                href="{{ route('admin.artikel') }}"
                class="flex items-center gap-4 hover:bg-green-700 p-2 rounded-lg"
                ><i class="fas fa-newspaper min-w-[24px] text-center"></i
                ><span
                    class="sidebar-label transition-all duration-300 overflow-hidden whitespace-nowrap"
                    >Artikel</span
                ></a
            >
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button
                    type="submit"
                    class="flex items-center gap-4 w-full text-left p-2 hover:bg-green-700 rounded-lg"
                >
                    <i class="fas fa-sign-out-alt min-w-[24px] text-center"></i>
                    <span
                        class="sidebar-label transition-all duration-300 overflow-hidden whitespace-nowrap"
                        >Logout</span
                    >
                </button>
            </form>
        </li>
    </ul>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const sidebar = document.getElementById("sidebar");
        const toggleButton = document.getElementById("toggleButton");
        const sidebarLabels = document.querySelectorAll(".sidebar-label");
        const sidebarTitle = document.getElementById("sidebarTitle");
        const icon = toggleButton.querySelector("i");
        let open = false;

        const isMobile = () => window.innerWidth <= 768;

        const updateSidebar = () => {
            if (open) {
                sidebar.classList.add("w-72");
                sidebar.classList.remove("w-20", "closed");
                icon.classList.add("fa-arrow-left");
                icon.classList.remove("fa-arrow-right");
                sidebarLabels.forEach((lbl) => lbl.classList.remove("hidden"));
                sidebarTitle.classList.remove("hidden");
            } else {
                sidebar.classList.remove("w-72");
                sidebar.classList.add("w-20");
                icon.classList.remove("fa-arrow-left");
                icon.classList.add("fa-arrow-right");
                sidebarLabels.forEach((lbl) => lbl.classList.add("hidden"));
                sidebarTitle.classList.add("hidden");

                if (isMobile()) {
                    sidebar.classList.add("closed");
                } else {
                    sidebar.classList.remove("closed");
                }

                // Tutup dropdown juga
                document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                    menu.classList.add("hidden");
                });
                document
                    .querySelectorAll(".dropdown-box")
                    .forEach((box) => box.remove());
            }
        };

        // Set awal state sidebar tertutup
        open = false;
        updateSidebar();

        toggleButton.addEventListener("click", () => {
            open = !open;
            updateSidebar();
        });

        // Optional: Tutup sidebar jika klik di luar sidebar saat di mobile
        document.addEventListener("click", (e) => {
            if (isMobile() && open) {
                if (
                    !sidebar.contains(e.target) &&
                    e.target !== toggleButton &&
                    !toggleButton.contains(e.target)
                ) {
                    open = false;
                    updateSidebar();
                }
            }
        });

        // Dropdown behavior (tidak berubah)
        document.querySelectorAll("[data-dropdown]").forEach((parent) => {
            const menu = parent.querySelector(".dropdown-menu");
            const toggleArea = parent.querySelector("div");
            let box = null;

            toggleArea.addEventListener("mouseenter", () => {
                if (open) {
                    menu.classList.remove("hidden");
                } else {
                    document
                        .querySelectorAll(".dropdown-box")
                        .forEach((b) => b.remove());
                    box = menu.cloneNode(true);
                    box.classList.add(
                        "absolute",
                        "dropdown-box",
                        "bg-green-600",
                        "p-2",
                        "rounded-lg",
                        "shadow-lg",
                        "text-white",
                    );
                    box.style.top = parent.getBoundingClientRect().top + "px";
                    box.style.left =
                        sidebar.getBoundingClientRect().right + "px";
                    box.classList.remove("ml-8", "mt-1", "hidden");
                    document.body.appendChild(box);
                    const boxRect = box.getBoundingClientRect();
                    if (boxRect.right > window.innerWidth) {
                        box.style.left =
                            sidebar.getBoundingClientRect().left -
                            boxRect.width +
                            "px";
                    }
                }
            });

            toggleArea.addEventListener("mouseleave", () => {
                if (open) {
                    setTimeout(() => {
                        if (!parent.matches(":hover")) {
                            menu.classList.add("hidden");
                        }
                    }, 150);
                }
            });

            parent.addEventListener("mouseleave", () => {
                if (!open && box) {
                    setTimeout(() => {
                        if (
                            !parent.matches(":hover") &&
                            !box.matches(":hover")
                        ) {
                            box.remove();
                            box = null;
                        }
                    }, 150);
                }
            });
        });
    });
</script>

<style>
    .dropdown-hidden {
        display: none;
    }
    .dropdown-visible {
        display: block;
    }

    @media (max-width: 768px) {
        #sidebar {
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            height: 100vh;
            transition: transform 0.3s ease;
        }
        #sidebar.closed {
            transform: translateX(-100%);
        }
    }
</style>

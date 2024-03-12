<template>
    <div
        :class="$page.props.showingMobileMenu ? 'block' : 'hidden'"
        @click="$page.props.showingMobileMenu = false"
        class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"
    ></div>

    <div
        :class="
            $page.props.showingMobileMenu
                ? 'translate-x-0 ease-out'
                : '-translate-x-full ease-in'
        "
        class="overflow-y-auto fixed inset-y-0 left-0 z-30 w-64 bg-gradient-to-br from-purple-800 via-blue-800 to-blue-400 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0"
    >
        <div class="flex justify-center items-center mt-5">
            <div class="flex items-center justify-center">
                <img :src="imglogo_w" class="w-5/6" alt="" />

                <!-- <span class="mx-2 text-2xl font-semibold text-white">Administrador</span> -->
            </div>
        </div>

        <nav class="mt-6" x-data="{ isMultiLevelMenuOpen: false }">
            <SeparadorMenu>Menú</SeparadorMenu>
            <!-- inicio -->
            <nav-link
                :href="route('dashboard')"
                :active="route().current('dashboard')"
            >
                <HomeIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Inicio</span>
            </nav-link>

            <SeparadorMenu>trabajos</SeparadorMenu>
            <!-- Busqueda empresas (campista) -->
            <nav-link
                v-if="
                    $page.props.user.permissions.includes('buscarOfertas-list')
                "
                :href="route('buscarOfertas')"
                :active="route().current('buscarOfertas')"
            >
                <MagnifyingGlassIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Busqueda de ofertas </span>
            </nav-link>
            <!-- Publicacion trabajo (campista) -->
            <nav-link :href="route('about')" :active="route().current('about')">
                <ClipboardDocumentCheckIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Mi perfil profesional</span>
            </nav-link>

            <!-- Busqueda empresas (empresa) -->
            <nav-link :href="route('about')" :active="route().current('about')">
                <ShareIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Mis ofertas de trabajo </span>
            </nav-link>

            <SeparadorMenu>Analisis</SeparadorMenu>
            <!--  Análisis de datos -->
            <nav-link
                v-if="$page.props.user.permissions.includes('usuarios-listar')"
                :href="route('users.index')"
                :active="route().current('users.index')"
            >
                <ChartPieIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Analítica de datos</span>
            </nav-link>

            <SeparadorMenu>Configuración</SeparadorMenu>
            <!-- publicacion de noticias -->
            <nav-link
                v-if="$page.props.user.permissions.includes('eventos-list')"
                :href="route('eventos.index')"
                :active="route().current('eventos.index')"
            >
                <BriefcaseIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Publicar eventos</span>
            </nav-link>
            <!-- usuarios -->
            <nav-link
                v-if="$page.props.user.permissions.includes('usuarios-listar')"
                :href="route('users.index')"
                :active="route().current('users.index')"
            >
                <UserGroupIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Usuarios</span>
            </nav-link>

            <nav-link
                class="flex items-center"
                v-if="$page.props.user.permissions.includes('rol-listar')"
                :href="route('roles.index')"
                :active="route().current('roles.index')"
            >
                <FingerPrintIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Roles</span>
            </nav-link>
        </nav>
    </div>
</template>

<script>
import NavLink from "@/Components/NavLink.vue";
import SeparadorMenu from "@/Components/SeparadorMenu.vue";
import { Link } from "@inertiajs/vue3";
import imglogo_w from "/public/assets/img/logo.png";
import { ref } from "vue";
import {
    HomeIcon,
    NewspaperIcon,
    MagnifyingGlassIcon,
    BriefcaseIcon,
    ShareIcon,
    ClipboardDocumentCheckIcon,
    FingerPrintIcon,
    UserGroupIcon,
    ChartPieIcon,
    BarsArrowDownIcon,
} from "@heroicons/vue/24/solid";

export default {
    components: {
        NavLink,
        Link,
        HomeIcon,
        NewspaperIcon,
        MagnifyingGlassIcon,
        BriefcaseIcon,
        ShareIcon,
        ClipboardDocumentCheckIcon,
        ChartPieIcon,
        FingerPrintIcon,
        UserGroupIcon,
        BarsArrowDownIcon,
        SeparadorMenu,
    },

    setup() {
        let showingTwoLevelMenu = ref(false);

        return {
            showingTwoLevelMenu,
            imglogo_w,
        };
    },
};
</script>

<style scoped></style>

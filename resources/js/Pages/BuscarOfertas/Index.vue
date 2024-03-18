<template>

    <Head title="Buscar Ofertas" />

    <AuthenticatedLayout>
        <template #header>
            Usuarios
        </template>

        <div class="inline-block min-w-full overflow-hidden mb-3 grid md:grid-cols-3 gap-4">

            <div class="...">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <MagnifyingGlassIcon class="w-4 h-4 text-gray-500" />
                    </div>
                    <input type="search" @keydown.enter="handleEnterKey" v-model="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-0 focus:border-transparent"
                        placeholder="Busqueda de usuarios" required>

                </div>
            </div>

            <div class="text-right p-4">
                filtros

            </div>

            <div class="flex">
                <button type="submit" @click="handleEnterKey"
                    class="m-auto text-white bg-sky-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Buscar</button>
            </div>


        </div>
        <div class="flex flex-col overflow-x-auto">
            <div class="inline-block rounded-lg shadow">

                <DataView :value="ofertas.data" paginator :rows="5">

                    <template #list="slotProps">
                        <div class="grid">
                            <div v-for="(item, index) in slotProps.items" :key="index" class="col-12">
                                <div class="flex flex-col sm:flex-row sm:align-items-center p-4 gap-3 pb-6 border-b"
                                    :class="{ 'border-top-1 surface-border': index !== 0 }">
                                    <div class="sm:w-36 relative flex">
                                        <img class="block xl:block mx-auto border-round w-full flex m-auto"
                                            :src="item.imagen != 'User' ? item.imagen : logo" :alt="item.name" />

                                    </div>
                                    <div
                                        class="flex flex-col md:flex-row justify-between md:align-items-center flex-1 gap-4 ms-2">
                                        <div class="flex flex-col md:flex-row justify-between align-items-start gap-2">
                                            <div>
                                                <div
                                                    class="surface-0 py-2 px-2 rounded-br-xl rounded-tl-xl shadow-xl bg-purple-200/60 flex inline-flex">
                                                    <span class="md:font-base text-sm text-gray-600 m-auto">
                                                        {{ item.categoria }}
                                                    </span>
                                                </div>

                                                <div class="md:text-xl text-base font-medium text-900 mt-2">
                                                    {{ item.titulo }}</div>
                                                <span class="font-medium md:text-lg text-sm"> Modalidad: {{
                        item.modalidad_trabajo
                    }}</span>

                                                <div class="surface-100 p-1" style="border-radius: 30px">
                                                    <div
                                                        class="surface-0 bg-gray-200 shadow-xl rounded-lg flex inline-flex align-items-center gap-2 justify-content-center py-1 px-2">
                                                        <span class="text-900 font-medium text-sm m-auto">{{ item.name
                                                            }}</span>

                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="flex flex-col md:align-items-end justify-end gap-2">
                                            <div class="surface-100 p-1 rounded-xl">
                                                <div
                                                    class="surface-0 flex align-items-center gap-2 justify-center py-1 px-2 rounded-xl">
                                                    <span class="font-medium text-secondary text-sm">
                                                        Horarios: {{ item.horarios }}
                                                    </span>
                                                </div>
                                            </div>


                                            <span class="text-xl font-semibold text-900">
                                                Salario: {{ formatNumber(item.salario) }}
                                            </span>

                                            <div class="flex flex-row gap-2">
                                                <button type="button" @click="moreDetails(item)"
                                                    class="text-white bg-sky-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                                                    Ver detalles
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </DataView>

            </div>
        </div>



        <!-- MODAL POSTULACIÓN -->
        <Dialog v-model:visible="visible" modal position="right" header="Oferta Empleo"
            class="w-full sm:w-4/6 md:w-3/6 h-screen">

            <!-- titulo -->
            <div class="">
                <h2 class="text-lg sm:text-xl md:text-2xl">{{ form.titulo }}</h2>
            </div>
            <!-- info empresa -->
            <div class="md:flex gap-2">
                <h3 class="text-base sm:text-lg md:text-xl font-bold">{{ form.name }}</h3>
                <p class="text-xs sm:text-base md:text-lg">{{ form.identificacion }}</p>
                <p class="text-xs sm:text-base md:text-lg">({{ form.ubicacion }})</p>
                <p class="text-xs sm:text-base md:text-lg">({{ form.fecha_init }})</p>
            </div>

            <!-- info Modalidad - jornada-->
            <div class="mt-12 flex gap-2">
                <BriefcaseIcon class="w-8" />
                <p class="text-sm sm:text-lg md:text-xl my-auto">
                    <span class="font-semibold">Modalidad:</span> {{ form.modalidad_trabajo }} <span
                        class="font-semibold">Jornada:</span> {{ form.jornada }}
                </p>
            </div>

            <!-- info Horario-->
            <div class="mt-4 flex gap-2">
                <ClockIcon class="w-8" />
                <p class="text-sm sm:text-lg md:text-xl my-auto">
                    {{ form.horarios }}
                </p>
            </div>

            <!-- info controato-->
            <div class="mt-4 flex gap-2">
                <ClipboardIcon class="w-8" />
                <p class="text-sm sm:text-lg md:text-xl my-auto">
                    <span class="font-semibold">Tipo:</span> {{ form.contrato }} <span
                        class="font-semibold">Salario:</span> {{
                        formatNumber(form.salario) }}
                </p>
            </div>

            <!-- info empresa contacto-->
            <div class="mt-4 flex gap-2">
                <NewspaperIcon class="w-8" />
                <p class="text-sm sm:text-lg md:text-xl my-auto">
                    <span class="font-semibold">Telefono:</span> {{ form.telefono }} <span
                        class="font-semibold">Correo:</span>
                    {{ form.empresa_email }}
                </p>
            </div>

            <!-- info categoria y cargo-->
            <div class="mt-4 flex gap-2">
                <RocketLaunchIcon class="w-8" />
                <p class="text-sm sm:text-lg md:text-xl my-auto">
                    <span class="font-semibold">Categoria:</span> {{ form.categoria }} <span
                        class="font-semibold">Cargo:</span>
                    {{ form.cargo }}
                </p>
            </div>

            <!-- descripción -->
            <div class="mt-12">
                <h2 class="text-lg sm:text-xl md:text-2xl">DESCRIPCIÓN</h2>
                <p class="text-xs sm:text-base md:text-lg">{{ form.descripcion }}</p>
            </div>



            <div class="flex justify-center items-center justify-end mt-16">
                <primaryButton class="md:text-xl" :class="{ 'opacity-25': isLoading }" :disabled="isLoading"
                    type="button" @click="postular()">
                    Postularme
                </primaryButton>
            </div>
        </Dialog>


    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from "vue";
import { watch } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryLink from '@/Components/PrimaryLink.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head, useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import primaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Avatar from 'primevue/avatar';
import { MagnifyingGlassIcon, BriefcaseIcon, ClockIcon, ClipboardIcon, NewspaperIcon, RocketLaunchIcon } from "@heroicons/vue/24/solid";
import DataView from 'primevue/dataview';
import DataViewLayoutOptions from 'primevue/dataviewlayoutoptions';
import logo from '/public/assets/img/logo.png';
import Dialog from 'primevue/dialog';



const props = defineProps({
    ofertas: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

console.log(props.ofertas);

//formulario para postulación
const form = useForm({
    oferta_id: 0,
    campista_id: 0,
    empresa_email: '',
    estado_post: '',
});


// pass filters in search
let search = ref(props.filters.search);
let estado_users = ref(props.filters.estado_users ?? "");

//abrir modal
const visible = ref(false);
//cargar boton 
const isLoading = ref(false);

const handleEnterKey = () => {
    router.get(
        "/buscarOfertas",
        { search: search.value, estado_users: estado_users.value },
        {
            preserveState: true,
            replace: true,
        }
    );
};
const getInitials = function (name) {
    let parts = name.split(' ');
    let initials = '';
    let count = 0;

    for (var i = 0; i < parts.length && count < 2; i++) {
        if (parts[i].length > 0 && parts[i] !== '') {
            initials += parts[i][0];
            count++;
        }
    }
    return initials;
};
watch(search, (value) => {
    console.log("Valor de búsqueda actualizado:", value)
});

//ABRIR MODAL DE INFO
const moreDetails = info => {
    visible.value = true;
    console.log(info);

    form.oferta_id = info.id;
    form.empresa_email = info.email;
    form.estado_post = 'postulado'

    //No se guarda, solo se muestra
    form.titulo = info.titulo;
    form.name = info.name;
    form.identificacion = info.identificacion;
    form.fecha_init = fechaInit(new Date(info.created_at));
    form.telefono = info.telefono;
    form.empresa_id = info.empresa_id;
    form.descripcion = info.descripcion;
    form.horarios = info.horarios;
    form.jornada = info.jornada;
    form.modalidad_trabajo = info.modalidad_trabajo;
    form.categoria = info.categoria;
    form.cargo = info.cargo;
    form.ubicacion = info.ubicacion;
    form.salario = info.salario;
    form.contrato = info.tipo_contrato;
    //FIN


};

const postular = () => {
    isLoading.value = true;

    form.post(route('buscarOfertas.create'), {
        onFinish: () => isLoading.value = false,
    });
}

const fechaInit = fecha => {

    let mensaje;

    // Diferencia en milisegundos entre las dos fechas
    let diferenciaEnMilisegundos = new Date().getTime() - fecha.getTime();
    // Convertir la diferencia de milisegundos a semanas
    let semanas = diferenciaEnMilisegundos / (1000 * 60 * 60 * 24 * 7);
    let dias = diferenciaEnMilisegundos / (1000 * 60 * 60 * 24);
    // Convertir la diferencia de milisegundos a meses
    let meses = new Date().getMonth() - fecha.getMonth() + (12 * (new Date().getFullYear() - fecha.getFullYear()));
    // Redondear el resultado a un número entero
    semanas = Math.round(semanas);
    let diasRestantes = Math.round(dias % 7);
    console.log("Han pasado aproximadamente " + meses + ' meses ' + semanas + " semanas y " + diasRestantes + " días desde la fecha inicial.");

    if (meses > 0) {

        if (meses == 1) {
            mensaje = `Hace ${meses} mes`;
        } else {
            mensaje = `Hace ${meses} meses`;
        }


    } else if (semanas > 0) {

        if (semanas == 1) {
            mensaje = `Hace ${semanas} semana`;
        } else {
            mensaje = `Hace ${semanas} semanas`;
        }

    } else {
        if (dias == 1) {
            mensaje = `Hace ${dias} día`;
        } else {
            mensaje = `Hace ${dias} días`;
        }
    } {

    }

    return mensaje

}



const formatNumber = value => {
    // Utilizar el filtro toLocaleString con el formato colombiano
    return value.toLocaleString('es-CO', {
        style: 'currency',
        currency: 'COP'
    });
}

</script>
